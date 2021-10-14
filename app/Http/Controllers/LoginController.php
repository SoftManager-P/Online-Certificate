<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
// use Validator;
use Illuminate\Support\Facades\Validator;
use App\Users;
use App\Service_history;
use App\Food_client_inf;
class LoginController extends Controller
{

    public function index(){
    	
    }
    public function signin(Request $request) { 

        $email = $request->email;
        $password = md5($request->password);
        $user = DB::table('users')
                ->select('*')
                ->Where('email', $request->email)
                ->get();
            
        if(count($user)>0){
        }else return redirect()->back()->with('log_err', 'Invalid Email!')->withInput();
        if($user[0]->password == $password){

            $user = [
                "id" =>$user[0]->id,
                "first_name" =>$user[0]->first_name,
                "last_name" =>$user[0]->last_name,
                "email" =>$user[0]->email,
                "role" =>$user[0]->user_role,
                "phone" =>$user[0]->phone,
                "password" => $password,
                "isLoggedIn" => true                   
            ];
                 
            Session::put('user',$user);
            
            if($this->isAdmin($request)){
                return redirect('admin'); 
            }
            
            if($this->isEmployee($request)){
                return redirect('employee'); 
            }

            if($this->isCustomer($request)){
                return redirect('home'); 
            }

        } else {
            return redirect()->back()->with('log_err', 'Invalid password!')->withInput();
        }

    }

    public function signup(Request $request) { 


        if($request->password !== $request->password_confirmation)
            return redirect()->back()->with('pas_err','Recheck your password!')->withInput();
        if($request->check !== 'checked')
            return redirect()->back()->with('signup_msg', 'Please check Terms & Policy!')->withInput();
        $users = DB::table('users')
            ->select('*')
            ->Where('email', $request->email)
            ->get();

        if(count($users)>0){
            return redirect()->back()->with('signup_msg', 'This E-mail is already exist!')->withInput();
        }else{
            $users = new Users;
            $users->first_name = $request->first_name;
            $users->last_name = $request->last_name;
            $users->email = $request->email;
            $users->phone = $request->phone;
            $users->company_name = $request->company_name;
            $users->password = md5($request->password);
            $users->user_role = 'customer';
            if($request->food_section == 'checked')
                $users->is_food_client = 1;
            $users->created_at = date('Y-m-d H:i:s');
            $users->save();
            $insertId = $users->id;
             $user = [
                "id" =>$insertId,
                "first_name" =>$request->first_name,
                "last_name" =>$request->last_name,
                "email" =>$request->email,
                "role" =>'customer',
                "phone" =>$request->phone,
                "password" => md5($request->password),
                "isLoggedIn" => true                   
            ];
                 
            Session::put('user',$user);
            return redirect('home'); 
       }

    }

    public function logout(Request $request) { 
        Session::forget('user');
         return redirect('login'); 
    }


}
