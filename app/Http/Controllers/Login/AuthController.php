<?php
 
namespace App\Http\Controllers\Login;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller;
use Auth;

 
class AuthController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @return Response
     */
    public function authenticate(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return redirect()->route('home.display');
        }
        else{
            return view("login/index", [
                "message" => "Wrong credentials, try again.",
            ]);
        }
    }
    
}