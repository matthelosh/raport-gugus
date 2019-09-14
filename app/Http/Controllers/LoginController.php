<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * 
     * Login 
     */
    
    public function authenticate(Request $request)
    {
        $credentials = $request->only('username', 'password');
        $username = $request->input('username');
        $password = $request->input('password');

        if (Auth::attempt(['username' => $username, 'password' => $password, 'isActive' => 1])) {
            return redirect()->intended('dashboard');
        } else {
            return redirect('/')->with(['status' => 'failed', 'err_msg'=>'Gagal masuk. Cek username / sandi.']);
        }
    }

   
}
