<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

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

    public function createLoginForm(){

        return view("login/create");
    }

    public function createLogin(Request $request){

        $username = $request->input('username');
        $email = $request->input('email');
        $password = $request->input('password');

        DB::table('users')->insert(['name'=> $username,'email'=> $email,'password'=>Hash::make($password)]);

        return redirect()->route('login.index');
    }

    
}
