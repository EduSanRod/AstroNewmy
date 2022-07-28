<?php
 
namespace App\Http\Controllers\Login;

use Illuminate\Http\Request; 
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Session;
 
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

        if (Auth::attempt(['email' => $email, 'password' => $password]) || Auth::attempt(['name' => $email, 'password' => $password])) {
            //Create session variable with the id of the user
            Session::put('UserId', auth()->user()->id);
            
            return redirect()->route('home.display');
        }
        else{
            return view("login/index", [
                "message" => "Wrong credentials, try again.",
            ]);
        }
    }
    
}