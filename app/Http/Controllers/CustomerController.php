<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Users;
use App\Services;
use App\Evaluate;
use App\Service_history;
use App\Food_client_inf;
use Illuminate\Http\UploadedFile;
use PDF;
use stdClass;
class CustomerController extends Controller
{	
    public function __construct()
    {

    }
    public function services(Request $request)
    {   
        if($this->isLogged() && $this->isCustomer()){
            Session::put('nav','services');
            $sector = DB::select('SELECT a.*
                                 FROM sector a
                                 WHERE id > 0');
            $detail = DB::select('SELECT *
                FROM service_details
                WHERE user_id = '.Session::get('user')['id']);
            view()->share("sector", $sector);
            view()->share("detail", $detail);
            return view('services');
        } else {
            return redirect('login');
        } 
    }
    public function edit_profile(Request $request)
    {   
        $id = Session::get('user')['id'];
        if($this->isLogged() && $this->isCustomer()){
            

            $user = DB::select('SELECT *
                                FROM users
                                WHERE id ='.$id);

            return view('edit_profile',compact('user'));
        } else {
            return redirect('login');
        } 
    }
    public function insert(Request $request)
    {   
        
            $id = $request->id; 
            $user = Users::find($id);
            $user->user_role = $request->user_role;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->company_name = $request->company_name;
            if($request->password !='')
                $user->password = md5($request->password);
            $user->updated_at = date('Y-m-d H:i:s');
            $user->save();
             
             
            return redirect()->back()->with('edit_success_msg', ' Successfull!')->withInput();  
    }
    public function get_otp(Request $request)
    {   
        if($this->isLogged() && $this->isCustomer()){
            
            
            return view('get_otp');
        } else {
            return redirect('login');
        } 
    }
    public function verify(Request $request)
    {   
        if($this->isLogged() && $this->isCustomer()){
            
            
            return view('verify');
        } else {
            return redirect('login');
        } 
    }

    public function getService(Request $request)
    {
       
        $sector_id = $request->sector_id;

        $services = DB::select('SELECT a.*
                                 FROM service a
                                 where a.sector_id ='.$sector_id);

        echo json_encode($services);
    }

    public function insert_service(Request $request){

        if(!isset($request->service_ids))
            return redirect()->back()->with('edit_success_msg', ' Successfull!')->withInput();  
        $service_ids = json_decode($request->service_ids,true);
        $service_id = array();
        foreach ($service_ids as $key => $value) {
            $ids = array();
            for ($i=0; $i < 5; $i++) { 
                if($file = $request->file('service_'.$value.'_'.$i)){
                    $destinationPath = public_path() . '/uploads/pdf/';
                    $safeName = time().str_shuffle('abcdefgh').'.'.'pdf';
                              
                    $file->move($destinationPath, $safeName);
                    $service_history = new Service_history;
                    $service_history->service_id = $value;
                    $service_history->user_id = Session::get('user')['id'];
                    $service_history->document_url = '/uploads/pdf/'.$safeName;
                    $service_history->save();
                    $id = $service_history->id;
                    array_push($ids, $id);
                }
            }
            
            $service_id[$value] = json_encode($ids);
            
        }

            $evlauate = new Evaluate;
            $evlauate->customer_id = Session::get('user')['id'];
            $evlauate->sector_id = $request->sector_id;

            $evlauate->service_id = json_encode($service_id);
           
            $evlauate->created_at = date('Y-m-d H:i:s');
            $evlauate->save();
            $evlauate_id = $evlauate->id;
        // return redirect()->route('pay-fees', [$service_id]);
        // return redirect('pay-fees/'.$evlauate_id.'');
        return redirect('confirm/'.$evlauate_id.'');
    }
    

    public function pay_fees($evlauate_id)
    {   
        if($this->isLogged() && $this->isCustomer()){
            Session::put('nav','services');
            $price = 0;
            $evlauate_history = DB::select('SELECT service_id
                                            FROM evaluate_history
                                            WHERE id = '.$evlauate_id);
            if(count($evlauate_history)>0)
                $service_id = $evlauate_history[0]->service_id;
            $service_ids = json_decode($service_id,true);
            foreach ($service_ids as $key => $item) {
                $ids = json_decode($item,true);

                foreach ($ids as $key1 => $id) {
                    $val = DB::select('SELECT b.price
                                        FROM service_history a
                                        LEFT JOIN service b ON a.service_id = b.id
                                        WHERE a.id = '.$id);
                    if(count($val)>0)
                    $price += $val[0]->price;
                }
            }

            return view('pay-fees',compact('price','evlauate_id'));
        } else {
            return redirect('login');
        } 
    }
    public function confirm($evlauate_id)
    {   
       $sector_name =Session::get('sector_name');
        if($this->isLogged() && $this->isCustomer()){
            Session::put('nav','services');
            DB::table('evaluate_history')
            ->where('id', $evlauate_id)
            ->update(['status' => 1]);
            $sector = DB::select('SELECT b.name
                                        FROM evaluate_history a
                                        LEFT JOIN sector b ON a.sector_id = b.id
                                        WHERE a.id = '.$evlauate_id);
            if(count($sector)>0){
                $sector_name = $sector[0]->name;
                return view('confirm',compact('sector_name'));
            }
        } else {
            return redirect('login');
        } 
    }

    public function submitted_doc()
    {   
        // var_dump($search);
        // die();
        if($this->isLogged() && $this->isCustomer()){
            Session::put('nav','services');
            $evlauate_history = DB::select('SELECT a.*,b.name as sector_name
                                            FROM evaluate_history a
                                            LEFT JOIN sector b ON a.sector_id = b.id
                                            WHERE a.customer_id = '.Session::get("user")["id"]. '
                                            AND a.status BETWEEN 1 AND 3 ');
           foreach ($evlauate_history as $key => $value) {
               $service = array();
               $service_ids = json_decode($value->service_id,true);
               foreach ($service_ids as $key1 => $value1) {
                   $service_name = DB::table('service')->where('id', $key1)->first()->name;
                   array_push($service, $service_name);
               }
               
               $evlauate_history[$key]->service = $service;
           }
           view()->share("evlauate_history", $evlauate_history);
            return view('submitted-documents');
        } else {
            return redirect('login');
        } 
    }
   
    public function view_print(Request $request)
    {
         $id = $request->eval_id;
         // pay check
         $pay_his = DB::table('pay_history')->where('evaluate_id',$id)->first();
         if(isset($pay_his) == false){
            $price = 50;
            $evlauate_id = $id;
             return view('pay-fees',compact('price','evlauate_id'));
         }
         //
         $evaluate = DB::select('SELECT a.service_id, b.name as sector_name,b.name_a as sector_name_a, a.id
                            FROM evaluate_history a
                            LEFT JOIN sector b ON a.sector_id = b.id
                            WHERE a.id ='.$id);

         DB::table('evaluate_history')
            ->where('id', $id)
            ->update(['status' => 4]);
        if(count($evaluate)>0){
            $eval_his = $evaluate[0];
            $service_ids = json_decode($evaluate[0]->service_id,true);
            $services = array();
            foreach ($service_ids as $key => $value) {
                $service_inf = array();
                $service =  DB::table('service')->where('id', $key)->first(); 
                $service_inf['service'] = $service;

                $service_history_ids = json_decode($value,true);
                $document = array();
                foreach ($service_history_ids as $service_history_id) {
                    $document_url =  DB::table('service_history')->where('id', $service_history_id)->first(); 
                    array_push($document, $document_url);
                }
                $service_inf['document_url'] = $document;

                array_push($services, $service_inf);
            }

        }
       
        $data = ['services' => $services,'eval_his'=> $eval_his];
        $pdf = PDF::loadView('myPDF', $data);
        return $pdf->download('Sertificate.pdf');
        // view()->share("services", $services);
        // return view('myPDF',compact('eval_his'));
       
    }

    // public function insert_foodservice(Request $request)
    // {
    //    $service_name = $request->service_name;
    //    $service = new services;
    //     $service->name = $request->service_name;
    //     $service->sector_id = -1;
    //     $service->description = '';
    //     // $service->price = $request->price;
    //     $service->created_at = date('Y-m-d H:i:s');
    //     $service->save();
    //     $insertId = $service->id;
    //     echo json_encode($insertId); 
    // }

    // public function food_report($user_id){
      
    //     if($this->isLogged() && $this->isCustomer()){
    //         Session::put('nav','services');
    //         $service = DB::select('SELECT *
    //                              FROM Food_client_inf
    //                              WHERE user_id = '.$user_id);
    //         if(count($service)>0){
    //             $service_ids = json_decode($service[0]->service_id,true);
    //             $service = array();
    //             foreach ($service_ids as $key => $value) {
    //                 $service_inf = array();
    //                 $service_name =  DB::table('service')->where('id', $key)->first(); 
    //                 $service_inf['service_name'] = $service_name;
    //                 $service_history_ids = json_decode($value,true);
    //                 $document = array();
    //                 foreach ($service_history_ids as $service_history_id) {
    //                     $document_url =  DB::table('service_history')->where('id', $service_history_id)->first(); 
    //                     array_push($document, $document_url);
    //                 }
    //                 $service_inf['document_url'] = $document;
    //                 array_push($service, $service_inf);
    //             }
    //         }
    //         view()->share("service", $service);
    //         return view('food_reports');
    //     } else {
    //         return redirect('login');
    //     } 
    
    // }

    public function insert_foodservice_history(Request $request){
        $service_ids = explode(",",$request->service_ids);

        $service_id = array();
        
        foreach ($service_ids as $key => $value) {
            $ids = array();
            if($key > (count($service_ids)-2)) break;

            if($file = $request->file('service_'.$value)){
                $destinationPath = public_path() . '/uploads/pdf/';
                $safeName = time().str_shuffle('abcdefgh').'.'.'pdf';
                          
                $file->move($destinationPath, $safeName);
                $service_history = new Service_history;
                $service_history->service_id = $value;
                $service_history->user_id = Session::get('user')['id'];
                $service_history->document_url = '/uploads/pdf/'.$safeName;
                $service_history->save();
                $id = $service_history->id;
                array_push($ids, $id);
            }
            $service_id[$value] = json_encode($ids);
        }
            $food_client_inf = DB::select('SELECT *
                                 FROM Food_client_inf
                                 WHERE user_id = '.Session::get('user')['id']);
        if(count($food_client_inf)>0){
            $old_service_ids = json_decode($food_client_inf[0]->service_id,true);
            $new_service_ids = array();
            foreach ($old_service_ids as $key => $value) {
                $service_id[$key] = $value;
            }

            $Food_client_inf = Food_client_inf::find($food_client_inf[0]->id);
            $Food_client_inf->user_id = Session::get('user')['id'];
            $Food_client_inf->service_id = json_encode($service_id);
           
            $Food_client_inf->updated_at = date('Y-m-d H:i:s');
            $Food_client_inf->save();
        }else{
            $Food_client_inf = new Food_client_inf;
            $Food_client_inf->user_id = Session::get('user')['id'];
            $Food_client_inf->service_id = json_encode($service_id);
           
            $Food_client_inf->created_at = date('Y-m-d H:i:s');
            $Food_client_inf->save();
        }
            // $Food_client_inf = $Food_client_inf->id;
        
        return redirect()->back()->with('evlauate_id', '')->withInput(); 
        // return redirect('pay-fees/'.$evlauate_id.'');
    }
    public function delete_foodservice(Request $request){
        $his_id = $request->his_id;
        $food_client_inf = DB::select('SELECT *
                                 FROM Food_client_inf
                                 WHERE user_id = '.Session::get('user')['id']);
        if(count($food_client_inf)>0){
            $service_id = $food_client_inf[0]->service_id;
        }
        $service_ids = json_decode($food_client_inf[0]->service_id,true);
        $new_service_ids = array();
        foreach ($service_ids as $key => $value) {
            $ids = array();
            $service_history_ids = json_decode($value);
            foreach ($service_history_ids as $key1 => $value1) {
                if($value1==$his_id){
                    continue;
                }
                array_push($ids, $value1);
            }
            

            if(count($ids)>0)
            $new_service_ids[$key] = json_encode($ids);
        }

            $Food_client_inf = Food_client_inf::find($food_client_inf[0]->id);
            $Food_client_inf->user_id = Session::get('user')['id'];
            $Food_client_inf->service_id = json_encode($new_service_ids);
           
            $Food_client_inf->updated_at = date('Y-m-d H:i:s');
            $Food_client_inf->save();
            // $Food_client_inf = $Food_client_inf->id;
        
        return redirect()->back()->with('evlauate_id', '')->withInput(); 
        // return redirect('pay-fees/'.$evlauate_id.'');
    }

    public function update_service_his(Request $request){
        $service_history_id = $request->his_id;
        if($file = $request->file('service_1')){
            $destinationPath = public_path() . '/uploads/pdf/';
            $safeName = time().str_shuffle('abcdefgh').'.'.'pdf';
            $file->move($destinationPath, $safeName);
            $service_history = Service_history::find($service_history_id);
            $service_history->document_url = '/uploads/pdf/'.$safeName;
            $service_history->save();
        }
        return redirect()->back()->with('evlauate_id', '')->withInput(); 
    }
    
    public function food_submit(Request $request){
        $service = DB::select('SELECT *
                                 FROM Food_client_inf
                                 WHERE user_id = '.Session::get('user')['id']);
        if(count($service)>0) $service_ids = $service[0]->service_id;
         $evlauate = new Evaluate;
            $evlauate->customer_id = Session::get('user')['id'];
            $evlauate->sector_id = -1;

            $evlauate->service_id = $service_ids;
           
            $evlauate->created_at = date('Y-m-d H:i:s');
            $evlauate->save();
            $evlauate_id = $evlauate->id;
        
        return redirect('pay-fees/'.$evlauate_id.'');
    }

    public function resubmit($id){

        if($this->isLogged() && $this->isCustomer()){
            Session::put('nav','services');
            $eval_his = DB::select('SELECT a.*,b.name as sector_name
                                 FROM evaluate_history a
                                 LEFT JOIN sector b ON a.sector_id = b.id
                                 WHERE a.id = '.$id);
            if(count($eval_his)>0){
                $service_ids = json_decode($eval_his[0]->service_id,true);
                $service = array();
                foreach ($service_ids as $key => $value) {
                    $service_inf = array();
                    $service_name =  DB::table('service')->where('id', $key)->first(); 
                    $service_inf['service_name'] = $service_name;
                    $service_history_ids = json_decode($value,true);
                    $document = array();
                    foreach ($service_history_ids as $service_history_id) {
                        $document_url =  DB::table('service_history')->where('id', $service_history_id)->first(); 
                        array_push($document, $document_url);
                    }
                    $service_inf['document_url'] = $document;
                    array_push($service, $service_inf);
                }
            }
            view()->share("service", $service);
            view()->share("eval_his", $eval_his[0]);
            return view('resubmit_page');
        } else {
            return redirect('login');
        } 
    
    }
    public function document_detail($id){

        if($this->isLogged() && $this->isCustomer()){
            Session::put('nav','services');
            $eval_his = DB::select('SELECT a.*,b.name as sector_name
                                 FROM evaluate_history a
                                 LEFT JOIN sector b ON a.sector_id = b.id
                                 WHERE a.id = '.$id);
            if(count($eval_his)>0){
                $service_ids = json_decode($eval_his[0]->service_id,true);
                $service = array();
                foreach ($service_ids as $key => $value) {
                    $service_inf = array();
                    $service_name =  DB::table('service')->where('id', $key)->first(); 
                    $service_inf['service_name'] = $service_name;
                    $service_history_ids = json_decode($value,true);
                    $document = array();
                    foreach ($service_history_ids as $service_history_id) {
                        $document_url =  DB::table('service_history')->where('id', $service_history_id)->first(); 
                        array_push($document, $document_url);
                    }
                    $service_inf['document_url'] = $document;
                    array_push($service, $service_inf);
                }
            }
            view()->share("service", $service);
            view()->share("eval_his", $eval_his[0]);
            return view('document_detail');
        } else {
            return redirect('login');
        } 
    
    }
    public function update_evaluate_history(Request $request){
        $evaluate_history = Evaluate::find($request->his_id);

        $evaluate_history->status = 1;

        $evaluate_history->save();
        return redirect('submitted');
    }
}