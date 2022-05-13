<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function displayLogin(){

        //If user is logged in, log them out.
        if (Auth::check()) {
            Auth::logout();
        }

        return view("login/index");
    }

    public function logout(){

        //If user is logged in, log them out.
        if (Auth::check()) {
            Auth::logout();
        }

        return redirect()->route('home.display');
    }

    
}
