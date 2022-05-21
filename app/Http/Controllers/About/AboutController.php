<?php

namespace App\Http\Controllers\About;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Mail;

class AboutController extends Controller
{
    public function displayAbout(){
        return view("about/index");
    }

    public function sendMessage(Request $request){

        $data = array(
            'subject'=> $request->input('subject'),
            'firstName'=> $request->input('first-name'),
            'lastName'=> $request->input('last-name'),
            'email'=> $request->input('email'),
            'comment'=> $request->input('comment'),
        );
   
        Mail::send(['text'=>'mail'], $data, function($message) {
            $message
            ->to('edusanchez4bc@gmail.com', 'Reciber')
            ->subject("Contact Us Email");

            $message->from('astronewmymailer@gmail.com','AstroNewmy Emailer');
        });

        return redirect('/about');
    }

}