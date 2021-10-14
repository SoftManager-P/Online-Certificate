<?php

namespace App\Http\Controllers\Employee;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Evaluate;
use App\Users;
use App\Services;
use App\Service_history;
use App\Sector;
use App\Food_client_inf;
use App\Products;
use App\product_details;
use Illuminate\Http\UploadedFile;
use PDF;
use stdClass;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
       if($this->isLogged() && $this->isEmployee()){
            Session::put('nav','evaluate');
            $sector = DB::select('SELECT a.*
                                 FROM sector a'); 
            view()->share("sector", $sector);
            return view('employee.evaluate.evaluate_history');
        } else {
            return redirect('login');
        } 
    }
    public function myprofile($id)
    {
        
            $user = DB::select('SELECT *
                                FROM users
                                WHERE id ='.$id);
            return view('employee.myprofile', compact('user'));
         
    }

    public function insert(Request $request)
    {   
        
        if($request->id==0){
             $users = DB::table('users')
            ->select('*')
            ->where('email', $request->email)
            ->get();
            if(count($users)>0){
                return redirect()->back()->with('error_msg', '')->withInput();
            }
            $user = new Users;
            $user->user_role = $request->user_role;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->company_name = $request->company_name;
            if($request->password !='')
                $user->password = md5($request->password);
            else 
            $user->created_at = date('Y-m-d H:i:s');
            $user->save();
            return redirect()->back()->with('msg', trans('user_message.success.create'))->withInput(); 
        }else{
            $id = $request->id; 
            $user = Users::find($id);
            $user->user_role = $request->user_role;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->company_name = $request->company_name;
            if($request->password !='')
                $user->password = md5($request->password);
            $user->updated_at = date('Y-m-d H:i:s');
            $user->save();
            return redirect()->back()->with('msg', trans('user_message.success.update'))->withInput(); 
        }
       
    }

    public function evaluate_historylist(Request $request)
    {
        
        $sector_id = $request->sector_id;
        $status_id = $request->status_id;
        $table_data['data'] = array();
        if($sector_id == '' && $status_id == ''){
            $evaluate = DB::select('SELECT a.*,b.name as sector_name, c.first_name,c.last_name, c.company_name
                                FROM evaluate_history a
                                LEFT JOIN sector b ON b.id = a.sector_id
                                LEFT JOIN users c ON c.id = a.customer_id
                                WHERE a.status < 4'); 
        }else if($sector_id != '' && $status_id == '') {
            $evaluate = DB::select('SELECT a.*,b.name as sector_name, c.first_name,c.last_name, c.company_name
                                FROM evaluate_history a
                                LEFT JOIN sector b ON b.id = a.sector_id
                                LEFT JOIN users c ON c.id = a.customer_id
                                WHERE a.status < 4 AND a.sector_id = '.$sector_id); 
        }else if($status_id !='' && $sector_id == '') {
            $evaluate = DB::select('SELECT a.*,b.name as sector_name, c.first_name,c.last_name, c.company_name
                                FROM evaluate_history a
                                LEFT JOIN sector b ON b.id = a.sector_id
                                LEFT JOIN users c ON c.id = a.customer_id
                                WHERE a.status = '.$status_id); 
        }else{
            $evaluate = DB::select('SELECT a.*,b.name as sector_name, c.first_name,c.last_name, c.company_name
                                FROM evaluate_history a
                                LEFT JOIN sector b ON b.id = a.sector_id
                                LEFT JOIN users c ON c.id = a.customer_id
                                WHERE a.sector_id = '.$sector_id.' AND a.status = '.$status_id); 
        }
       
        foreach ($evaluate as $e=> $value) {            
        //     $service = '';
        //     $service_ids = explode(',',$value->service_id);
        //     $i = 0;
        //     foreach ($service_ids as $key1 => $value1) {
        //            $service_name = DB::table('service')->where('id', $key1)->first()->name;
                   
        //             if(count($service_ids) > ($i+1))
        //                {$service = $service.$service_name.',  ';
        //             } 
        //             else
        //                 $service = $service.$service_name;
        //             $i++;
            // }

        //     $evaluate[$e]->service = $service;

            array_push($table_data['data'], $evaluate[$e]); 
            
        }
        foreach ($table_data['data'] as $key => $value) {
                    $table_data['data'][$key]->index = $key+1;
                }
      echo json_encode($table_data);  
        
      
    }
    public function editevaluate_history($id)
    {      
            Session::put('nav','evaluate');
        
            
            $evaluate = DB::select('SELECT a.*,b.name as sector_name
                                FROM evaluate_history a
                                LEFT JOIN sector b ON a.sector_id = b.id
                                WHERE a.id ='.$id);
                        
            if(count($evaluate)>0){
                $eval_his=$evaluate[0];
                if($evaluate[0]->cert_type=="service"){
                    $detail_name = DB::select('SELECT id,service_detail as detail_item 
                                    FROM service_details
                                    WHERE user_id = '.$evaluate[0]->customer_id);

                    $service_ids=explode(',',$evaluate[0]->service_ids);
                    $service_info=array();
                    foreach ($service_ids as $key => $value) {
                        $service= DB::select('SELECT a.*,b.category_title
                                    FROM service a
                                    LEFT JOIN category b ON a.category_id = b.id
                                    WHERE a.id = '.$value);

                        array_push($service_info, $service[0]);
                    }
                    
                }
                if($evaluate[0]->cert_type=="product"){
                    $detail_name = DB::select('SELECT id,detail_item 
                                    FROM product_details
                                    WHERE company_id = '.$evaluate[0]->customer_id);

                    $service_ids=explode(',',$evaluate[0]->service_ids);
                    $service_info=array();
                    foreach ($service_ids as $key => $value) {
                        $service= DB::select('SELECT a.*,b.category_title 
                                    FROM products a
                                    LEFT JOIN category b ON a.category_id= b.id
                                    WHERE a.id = '.$value);
                        
                        array_push($service_info, $service[0]);
                    }
                    
                }
            }
            
            $product_info = array();

            foreach ($service_info as $key => $item) {
                
                $details = json_decode($item->details,true);

                foreach ($details as $key1 => $item1) {
                    
                      $product_info[$key][$key1] = substr($item1,0,30);

                } 
                $product_info[$key]['name'] = $item->name_e;
                $product_info[$key]['id'] = $item->id;
                $product_info[$key]['document'] = $item->document;
                $product_info[$key]['category_title'] = $item->category_title;
  
            }

            view()->share("product_info", $product_info);
            view()->share("detail", $detail_name);
            
            return view('employee.evaluate.editevaluate_history',compact('eval_his'));
    }

    public function get_service_history(Request $request){
        $id = $request->id;
        $history = DB::table('service_history')->where('id', $id)->first(); 
        echo json_encode($history);
    }

    public function save_docname(Request $request){
        $history = Service_history::find($request->id);
        $history->doc_name_en = $request->doc_name_en;
        $history->doc_name_ar = $request->doc_name_ar;
        $history->updated_at = date('Y-m-d H:i:s');
        $history->save();
        return redirect()->back()->with('msg', 'Updated Successfully!')->withInput();
    }
    public function insert_evaluate(Request $request)
    {   

        $id = $request->id; 
        $evaluate = Evaluate::find($id);
        $evaluate->status = $request->status;
        // if($evaluate->status == '3'){
        $evaluate->review = $request->review;
        // }else if($evaluate->status == '2'){
        //     $evaluate->review = $request->review;
        // }
        $evaluate->updated_at = date('Y-m-d H:i:s');
        $evaluate->save();
        return redirect()->back()->with('msg', 'Updated Successfully!')->withInput(); 
        
       
    }
    public function delete(Request $request){
      $id = $request->id;
      $evaluate = evaluate::find($id);
      $evaluate->delete();    
      $res = [
              "success" => true,                    
          ]; 
      echo json_encode($res); 
    }
    
}