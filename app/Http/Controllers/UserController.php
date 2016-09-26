<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use Flash;
class UserController extends Controller
{
    //
    public function __construct()
    {
        
    }
    public function index()
    {    

        
        return view('auth.login');
    }
    public function userSignin(Request $request){
    	
    	if(Auth::attempt(array('email'=>trim($request->input('user_email_id')), 'password'=> $request->input('user_password') ))) {
              //dd(Auth::user());
    		return redirect('dashboard');
  
        }
        else{
        	
        }
    }
}
