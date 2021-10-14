<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PDF;
use App\Users;
use App\Token;
class HomeController extends Controller
{	
    public function __construct()
    {
        Session::put('nav','customer');
    }
    public function home(Request $request)
    {   
        Session::put('nav','home');
        return view('index');
    }
    // public function services(Request $request)
    // {   
    //     Session::put('nav','services');
    //     return view('services');
    // }
    public function about_us(Request $request)

    {           
        Session::put('nav','about_us');
        return view('about_us');
    }

    public function contact_us(Request $request)
    {         
        Session::put('nav','contact_us');
        return view('contact_us');
    }

    public function login_page()
    {
        Session::put('nav','login');
        return view('login');
    }
     public function register_page()
    {
        Session::put('nav','register');
        return view('sign-up');
    }

    public function generatePDF()

    {

        $data = ['title' => 'Welcome'];

        $pdf = PDF::loadView('myPDF', $data);



        return $pdf->download('test.pdf');

    }
     public function forgot_password()
    {
        
        return view('forgot_password');

        
    }
    public function confirmEmail(Request $request)
    {
        
        $email = $request->email;
            
        $email = DB::table('users')
                ->select('id')
                ->Where('email', $request->email)
                ->get();
        if(count($email)>0){
            
            $userData =  DB::select('SELECT email
                                     FROM users');

            $userInfo = $userData[0];
            $characters = '0123456789';
            $charactersLength = strlen($characters);
            
            $token = $userInfo->email.time();
            for ($i = 0; $i < 16; $i++) {
                $token .= $characters[rand(0, $charactersLength - 1)];
            }
            $to = DB::table('token')
                    ->insert([
                
                'email' => $userInfo->email,
                'token'=>md5($token),
                'created_at'=>date('Y-m-d H:i:s')]
                );
            return redirect()->back()->with('success_msg', 'Reset link url sent your email already!')->withInput();
            
             
        }else return redirect()->back()->with('log_err', 'Invalid Email!')->withInput();
        // var_dump($email);
        //     die();
    }
    public function set_password($token)
    {    

        return view('set_password',compact('token'));
    }
    public function update_password(Request $request)
    {    
        
        $token = $request->token;
        
        $Data =  DB::select('SELECT email
                             FROM token
                             Where status = 0 AND token = "'.$token.'"');
        // var_dump( $Data);
        // die();
        if(count($Data)>0){
            if($request->password !== $request->password_confirmation)
                return redirect()->back()->with('pas_err','Recheck your password!')->withInput();
            $id = DB::select('SELECT id
                             FROM users
                             Where email = "'.$Data[0]->email.'"');

            $user = Users::find($id[0]->id);
            $user->password = md5($request->password);
            $user->updated_at = date('Y-m-d H:i:s');
            $user->save();
            
            DB::table('token')
            ->where('token', $token)
            ->update(['status' => 1]);
            

            return redirect()->back()->with('success_msg', 'Success!')->withInput();
        }else return redirect()->back()->with('forgot_err', 'error!')->withInput();
    
        
    }

}