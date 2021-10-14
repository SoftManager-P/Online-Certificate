<?php
namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Users;
use App\Services;
use App\Evaluate;
use App\Service_details;
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
            return view('customer.services');
        } else {
            return redirect('login');
        } 
    }
    public function insert_serviceDetail(Request $request)
    {
        $user_id = Session::get('user')['id'];
        $service_detail = $request->detail;
        $service_detail_ara = $request->detail_ara;
        $sector_id = $request->sector;
        $detail = DB::select('SELECT *
                             FROM service_details
                             Where user_id = '.$user_id.' AND sector_id = '.$sector_id.' AND service_detail = "'.$service_detail.'"');
        $detail_ara = DB::select('SELECT *
                             FROM service_details
                             Where user_id = '.$user_id.' AND sector_id = '.$sector_id.' AND service_detail_ara = "'.$service_detail_ara.'"');
       
        $other_sector_detail = DB::select('SELECT *
                             FROM service_details
                             Where user_id = '.$user_id.' AND sector_id != '.$sector_id);

        if(count($detail)>0 || count($detail_ara)>0 || count($other_sector_detail)>0){
                echo json_encode('error');
        }else{

            $detail = new Service_details;
            $detail->service_detail = $request->detail;
            $detail->service_detail_ara = $request->detail_ara;
            $detail->sector_id = $sector_id;
            $detail->user_id = Session::get('user')['id'];
            $detail->created_at = date('Y-m-d H:i:s');
            $detail->save();
            $insertId = $detail->id;
            echo json_encode($insertId);  
            }
        
    }

     public function delete_service_detail(Request $request){
      $id = $request->detail_id;
      $detail = service_details::find($id);
      $detail->delete();    
      return redirect()->back(); 
    }

     public function service_list(Request $request){
      if($this->isLogged() && $this->isCustomer()){
            Session::put('nav','services');
            $user_id = Session::get('user')['id'];
            $services = DB::select('SELECT a.*,b.category_title
                                 FROM service a
                                 LEFT JOIN category b ON a.category_id = b.id
                                 WHERE a.user_id = '.$user_id.' AND del_flg <> 1');
            $service_detail = DB::select('SELECT id,service_detail 
                                    FROM service_details
                                    WHERE user_id = '.$user_id);
          
            $service_info = array();

            foreach ($services as $key => $item) {
                
                $details = json_decode($item->details,true);

                foreach ($details as $key1 => $item1) {
                    
                      $service_info[$key][$key1] = substr($item1,0,30);

                } 
                $service_info[$key]['name'] = $item->name_e;
                $service_info[$key]['id'] = $item->id;
                $service_info[$key]['document'] = $item->document;
                $service_info[$key]['category_title'] = $item->category_title;
  
            }

            view()->share("service_info", $service_info);
            view()->share("detail", $service_detail);
            return view('customer.service_list');
        } else {
            return redirect('login');
        } 
    }

    public function edit_service(Request $request,$id){
        if($this->isLogged() && $this->isCustomer()){
            Session::put('nav','services');
            $id = $request->id;
            $user_id = Session::get('user')['id'];
            $product = DB::select('SELECT a.*
                                 FROM service a
                                 WHERE id = '.$id);
            $detail = DB::select('SELECT id,service_detail 
                                    FROM service_details
                                    WHERE user_id = '.$user_id);
            if(count($detail)<1)
                return redirect()->back()->with('error_msg','Please Insert Your Product Detail Infomation'); 
            $product_info=array();
            if(count($product)>0){
                
                foreach ($product[0] as $key => $value) {
                    $product_info[$key] = $value;
                }
                $details = json_decode($product[0]->details,true);
                foreach ($details as $key1 => $item1) {
                    // $k = $key1." ";
                      $product_info[$key1] = $item1;
                } 
            }

            view()->share("product", $product_info);
            view()->share("detail", $detail);

            return view('customer.edit_service');
           
        } else {
            return redirect('login');
        } 
    }

    public function save_service(Request $request)
    {
        $user_id = Session::get('user')['id'];
        $details = DB::select('SELECT id,service_detail,sector_id
                                    FROM service_details
                                    WHERE user_id = '.$user_id);
        $sector_id = $details[0]->sector_id;
        $details_info = array();
        foreach ($details as $key => $item) {
            $val = $item->id;
            $data = 'detail_'.$val;
            $details_info[$val] = $request->$data;
        } 

        $detaildata = json_encode($details_info);
        $id = $request->product_id;
        if($id == '0'){
            $products = new Services;
            $products->sector_id = $sector_id;
            $products->name_e = $request->product_name;
            $products->name_a = $request->product_name_ara;
            $products->details = $detaildata;
            $products->user_id = Session::get('user')['id'];
            $products->created_at = date('Y-m-d H:i:s');
            $products->save();
            $insertId = $products->id;
        }else{
            $products = Services::find($id);
            $products->sector_id = $sector_id;
            $products->name_e = $request->product_name;
            $products->name_a = $request->product_name_ara;
            $products->details = $detaildata;
            $products->user_id = Session::get('user')['id'];
            $products->updated_at = date('Y-m-d H:i:s');
            $products->save();
            $insertId = $id;
        }
        
        if($file = $request->file('document')){
            $destinationPath = public_path() . '/uploads/pdf/';
            $safeName = time().str_shuffle('abcdefgh').'.'.'pdf';
                      
            $file->move($destinationPath, $safeName);

            $products = Services::find($insertId );
            $products->document = '/uploads/pdf/'.$safeName;
            $products->save();

        }
        return redirect('service_list'); 
    }
     public function delete_service(Request $request)
    {
        $id = $request->product_id;
        DB::table('service')->where('id', $id)->delete();
        return redirect()->back(); 
    }

    public function set_category(Request $request){
        $ids = $request->checked_ids;
        $category = $request->category;
        $category_id = DB::table('category')->insertGetId(
            ['category_title' => $category]
        );
        $product_id = explode(',', $ids);
        foreach ($product_id as $key => $item) {
            $products = Services::find($item);
            $products->category_id = $category_id;
            $products->updated_at = date('Y-m-d H:i:s');
            $products->save();
        }
        return redirect()->back(); 
    }
    public function submit_service(Request $request){
        $user_id = Session::get('user')['id'];
        $services = DB::select('SELECT id ,sector_id
                                    FROM service
                                    WHERE user_id = '.$user_id);
        $service_ids ='';
        if(count($services)>0){
            foreach ($services as $key => $value) {
                if($service_ids ==''){
                    $service_ids = $value->id;
                }else {
                    $service_ids .= ','.$value->id;
                }

                DB::table('service')
                    ->where('id', $value->id)
                    ->update(['del_flg' => 1]);
            }
            $sector_id = $services[0]->sector_id;
        }

        $submit = new Evaluate;
        $submit->customer_id = $user_id;
        $submit->sector_id = $sector_id;
        $submit->service_ids = $service_ids;
        $submit->cert_type = 'service';
        $submit->status = '1';
        $submit->created_at = date('Y-m-d H:i:s');
        $submit->save();
        $evlauate_id = $submit->id;
        return redirect('confirm/'.$evlauate_id.'');
        // return redirect()->back();
    }

    public function submit_product(Request $request){
        $user_id = Session::get('user')['id'];
        $products = DB::select('SELECT id ,sector_id
                                    FROM products
                                    WHERE company_id = '.$user_id);
        $product_ids ='';
        if(count($products)>0){
            foreach ($products as $key => $value) {
                if($product_ids ==''){
                    $product_ids = $value->id;
                }else {
                    $product_ids .= ','.$value->id;
                }

                // DB::table('service')
                //     ->where('id', $value->id)
                //     ->update(['del_flg' => 1]);
            }
            $sector_id = $products[0]->sector_id;
        }

        $submit = new Evaluate;
        $submit->customer_id = $user_id;
        $submit->sector_id = $sector_id;
        $submit->service_ids = $product_ids;
        $submit->cert_type = 'product';
        $submit->status = '1';
        $submit->created_at = date('Y-m-d H:i:s');
        $submit->save();
        $evlauate_id = $submit->id;
        return redirect('confirm/'.$evlauate_id.'');
        // return redirect()->back();
    }

    public function submitted_doc()
    {   
    
        if($this->isLogged() && $this->isCustomer()){
            Session::put('nav','services');
            $evlauate_history = DB::select('SELECT a.*,b.name as sector_name
                                            FROM evaluate_history a
                                            LEFT JOIN sector b ON a.sector_id = b.id
                                            WHERE a.customer_id = '.Session::get("user")["id"]. '
                                            AND a.status BETWEEN 1 AND 3 ');
           foreach ($evlauate_history as $key => $value) {
               $service = array();
               $service_ids = explode(',',$value->service_ids);
               foreach ($service_ids as $key1 => $value1) { 
                    if($value->cert_type == 'service')
                        $service_name = DB::table('service')->where('id', $value1)->first()->name_e;
                    elseif($value->cert_type == 'product')
                        $service_name = DB::table('products')->where('id', $value1)->first()->name_e;
                   // var_dump($key1);
                   // die();
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
}