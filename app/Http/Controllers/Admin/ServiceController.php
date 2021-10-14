<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Services;
use stdClass;
class ServiceController extends Controller
{
    public function index(Request $request)
    {
      
            Session::put('nav','service');
            $sector = DB::select('SELECT a.*
                                 FROM sector a
                                 WHERE id > 0'); 
            view()->share("sector", $sector);
            return view('admin.service.service');
        
    }

    public function servicelist(Request $request)
    {
        $sector_id = $request->sector_id;
        $table_data['data'] = array();

        if ($sector_id ==''){ 
        $service = DB::select('SELECT a.*,b.name as sector_name
                             FROM service a
                             LEFT JOIN sector b ON b.id = a.sector_id
                             WHERE a.sector_id > 0'); 
        }else{
        $service = DB::select('SELECT a.*,b.name as sector_name
                             FROM service a
                             LEFT JOIN sector b ON b.id = a.sector_id
                             WHERE a.sector_id = '.$sector_id);    
        }
        foreach ($service as $s) {            
            array_push($table_data['data'], $s); 
        }
        foreach ($table_data['data'] as $key => $value) {
                    $table_data['data'][$key]->index = $key+1;
                }
      echo json_encode($table_data);   
      
    }
    public function editservice($id)
    {
        Session::put('nav','service');
        $sector = DB::select('SELECT *
                                FROM sector
                                WHERE id > 0');
        view()->share("sector", $sector);
        if($id == 0){
            return view('admin.service.editservice');
        } else {
            $service = DB::select('SELECT *
                                FROM service
                                WHERE id ='.$id);
            
            return view('admin.service.editservice', compact('service'));
        } 
    }
  
    public function insert_service(Request $request)
    {   
        $service_name =  DB::select('SELECT *
                                FROM service 
                                WHERE name = "'.$request->name.'" AND sector_id = '.$request->sector_id);
        if($request->id==0){
            if(count($service_name)>0)
                return redirect()->back()->with('msg', 'Service Name Already Exist!')->withInput();
            $service = new services;
            
            $service->name = $request->name;
            $service->name_a = $request->name_a;
            $service->sector_id = $request->sector_id;
            $service->description = $request->description;
            $service->price = $request->price;
            $service->created_at = date('Y-m-d H:i:s');
            $service->save();
            return redirect()->back()->with('msg', 'Insert Successfully!')->withInput(); 
        }else{
            $id = $request->id; 
            $service = services::find($id);
            $service->name = $request->name;
            $service->name_a = $request->name_a;
            $service->sector_id = $request->sector_id;
            $service->description = $request->description;
            $service->price = $request->price;
            $service->updated_at = date('Y-m-d H:i:s');
            $service->save();
            return redirect()->back()->with('msg', 'Update Successfully!')->withInput(); 
        }
       
    }
    public function delete(Request $request){
      $id = $request->id;
      $service = services::find($id);
      $service->delete();    
      $res = [
              "success" => true,                    
          ]; 
      echo json_encode($res); 
    }
    
    
}