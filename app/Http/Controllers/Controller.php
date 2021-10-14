<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
	 * This function used to check the user is logged in or not
	 */
	protected function isLogged() {
		
		$isLoggedIn = Session::get('user')['isLoggedIn'];
		// $request->session()->get('user')['isLoggedIn'];
		
		if (! isset ( $isLoggedIn ) || $isLoggedIn != true ) 
		{
		// 	var_dump($isLoggedIn);
		// die();
			return false;
		} 
		else 
		{
			return true;
		}
	}
	
	/**
	 * This function is used to check the access
	 */
	protected function isAdmin() {
		if (Session::get('user')['role'] == "admin") 
		{
			return true;
		} 
		else 
		{
			return false;
		}
	}


	
	
	/**
	 * This function is used to check the access
	 */
	protected function isEmployee() {
		if (Session::get('user')['role'] == "employee") 
		{
			return true;
		} 
		else 
		{
			return false;
		}
	}

	/**
	 * This function is used to check the access
	 */
	protected function isCustomer() {
		if (Session::get('user')['role'] == "customer") 
		{
			return true;
		} 
		else 
		{
			return false;
		}
	}

	
}
