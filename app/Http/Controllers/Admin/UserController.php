<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Users;
use stdClass;
class UserController extends Controller
{
    public function __construct()
    {
        Session::put('nav','user');
    }
    public function index()
    {
       if($this->isLogged() && $this->isAdmin()){
            Session::put('nav','user');
            Session::put('sub_nav','employee');
            return view('admin.user.employeelist');
        } else {
            return redirect('login');
        } 
    }

    public function employeelist()
    {
        $table_data['data'] = array();
        $employee = DB::select('SELECT a.*
                                 FROM users a
                                WHERE a.user_role = "employee"'); 

        foreach ($employee as $e) {            
            array_push($table_data['data'], $e); 
        }
        foreach ($table_data['data'] as $key => $value) {
                    $table_data['data'][$key]->index = $key+1;
                }
      echo json_encode($table_data);   
    }
    public function editemployee($id)
    {
        Session::put('nav','user');
        Session::put('sub_nav','employee');
        if($id == 0){
            return view('admin.user.editemployee');
        } else {
            $user = DB::select('SELECT *
                                FROM users
                                WHERE id ='.$id);
            return view('admin.user.editemployee', compact('user'));
        } 
    }
  
      public function customerview()
    {
        Session::put('nav','user');
        Session::put('sub_nav','customer');
        return view('admin.user.customerlist');
    }
     public function customerlist()
    {
        $table_data['data'] = array();
       
        $customer = DB::select('SELECT a.*
                                 FROM users a
                                WHERE a.user_role = "customer"'); 

        foreach ($customer as $c) {            
            array_push($table_data['data'], $c); 
        }
        foreach ($table_data['data'] as $key => $value) {
                    $table_data['data'][$key]->index = $key+1;
                }
      echo json_encode($table_data);   
      
    }
    public function editcustomer($id)
    {
        Session::put('nav','user');
        Session::put('sub_nav','customer');

        if($id == 0){
            return view('admin.user.editcustomer');
        } else {
            $user = DB::select('SELECT *
                                FROM users
                                WHERE id ='.$id);
            return view('admin.user.editcustomer', compact('user'));
        } 
    }
  
    public function insert(Request $request)
    {   
        
        if($request->password !== $request->password_confirmation)
            return redirect()->back()->with('pas_err','Recheck your password!')->withInput();

        if($request->id==0){
             $users = DB::table('users')
            ->select('*')
            ->where('email', $request->email)
            ->get();
            if(count($users)>0){
                return redirect()->back()->with('error_msg', trans('user_message.user_exists'))->withInput();
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
    public function delete(Request $request){
      $id = $request->user_id;
      $user = Users::find($id);
      $user->delete();    
      $res = [
              "success" => true,                    
          ]; 
      echo json_encode($res); 
    }
    public function myprofile($id)
    {
        
            $user = DB::select('SELECT *
                                FROM users
                                WHERE id ='.$id);
            return view('admin.myprofile', compact('user'));
         
    }
}