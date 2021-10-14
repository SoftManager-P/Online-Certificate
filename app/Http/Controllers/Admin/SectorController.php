<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Sectors;
use stdClass;
class SectorController extends Controller
{
    public function index(Request $request)
    {
      
            Session::put('nav','sector');
            
            return view('admin.sector.sector');
        
    }

    public function sectorlist(Request $request)
    {
        
        $table_data['data'] = array();
       
        $sector = DB::select('SELECT a.*
                                 FROM sector a'); 

        foreach ($sector as $s) {            
            array_push($table_data['data'], $s); 
        }
        foreach ($table_data['data'] as $key => $value) {
                    $table_data['data'][$key]->index = $key+1;
                }
      echo json_encode($table_data);   
      
    }
    public function editsector($id)
    {
        Session::put('nav','sector');

        if($id == 0){
            return view('admin.sector.editsector');
        } else {
            $sector = DB::select('SELECT *
                                FROM sector
                                WHERE id ='.$id);
            return view('admin.sector.editsector', compact('sector'));
        } 
    }
  
    public function insert_sector(Request $request)
    {   
        $sector_name = DB::select('SELECT *
                                FROM sector
                                WHERE name = "'.$request->name.'"');
        
        if($request->id==0){
            if(count($sector_name)>0) 
            return redirect()->back()->with('msg', 'Sector Name Already Exist!')->withInput(); 
            $sector = new Sectors;
            
            $sector->name = $request->name;
            $sector->name_a = $request->name_a;
            $sector->description = $request->description;
            $sector->created_at = date('Y-m-d H:i:s');
            $sector->save();
            return redirect()->back()->with('msg', 'Insert Successfully!')->withInput(); 
        }else{
            $id = $request->id; 
            $sector = Sectors::find($id);
            $sector->name = $request->name;
            $sector->name_a = $request->name_a;
            $sector->description = $request->description;
            $sector->updated_at = date('Y-m-d H:i:s');
            $sector->save();
            return redirect()->back()->with('msg', 'Update Successfully!')->withInput(); 
        }
       
    }
    public function delete(Request $request){
      $id = $request->id;
      $sector = Sectors::find($id);
      $sector->delete();    
      $res = [
              "success" => true,                    
          ]; 
      echo json_encode($res); 
    }
  
    
    
}