<?php

namespace App\Http\Controllers\Admin\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
class LoginController extends Controller
{
	use AuthenticatesUsers;
	protected $redirectTo='/admin/dashboard';

	protected function guard(){
		return Auth::guard();
	}
    public function showLoginForm(){
    	return view('admin.auth.login');
    }
    public function login(Request $request){    
    	
    	$auth=Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password,'active'=>1]); 

    	if($auth){
    	  //dd(Auth::guard('admin')->user());
    		return redirect($this->redirectTo);
        }
        return redirect()->back()->withErrors('Invalid Credentials!!!');
    }
    public function logout(){
    	Auth::guard('admin')->logout();
    	return redirect('admin/login');
    }
}