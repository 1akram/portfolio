<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller
{
    public function login(){
        
        return view('admin.login');
    }
    public function loginCheck(Request $request){
      

        if (Auth::attempt($request->only('email', 'password'),false)) {
            $request->session()->regenerate();

            return redirect()->intended('admin/dashboard');
        }

        return back()->withErrors([
            'email' => __('texts.LOGIN_INFO_DONT_MATCH_OUR_RECORDS_KEY'), 
        ]);
    
    }

    public function logout(Request $request){
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
    
}
