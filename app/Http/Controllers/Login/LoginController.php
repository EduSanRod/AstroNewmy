<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Article;
use App\Models\Comment;

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

    public function showUserSetting(){

        return view("user/setting");
    }

    public function userUpdate(Request $request){

        if (url()->previous() !=  url('user/settings') ) {
            return redirect()->to('/home'); 
        }

        $name = $request->input('username');
        $email = $request->input('email');

        $idUserToDelete = auth()->user()->id;

        if(isset($name)){
            User::where("id",$idUserToDelete)->update([
                "name" => $name,  
            ]);
        }

        if(isset($email)){
            User::where("id",$idUserToDelete)->update([
                "email" => $email,
            ]);
        }

        return redirect()->route('home.display');
    }

    public function userDelete(){

        //To prevent the user from writing the route /user/delete and deleting its own account, only delete if the previous route is the settings
        if (url()->previous() !=  url('user/settings') ) {
            return redirect()->to('/home'); 
        }

        $idUserToDelete = auth()->user()->id;

        if (Auth::check()) {
            Auth::logout();
        }

        User::where('id', $idUserToDelete)->delete();

        return redirect()->route('login.index');
    }

    public function showUserArticles(){

        $userId = auth()->user()->id;
        $articles = $this->getAllArticlesFromUser($userId);

        return view("user/articles", [
            "articles" => $articles,
        ]);
    }

    public function showUserComments(){

        $userId = auth()->user()->id;
        $articles = $this->getAllArticlesWithCommentsFromUser($userId);

        return view("user/comments", [
            "articles" => $articles,
        ]);
        
    }

    public function getAllArticlesFromUser($userId){
        $celestialObjects = Article::select("article.id as article_id", "article.title as article_title", "article.slug as article_slug", "article.description as article_description", "article.image as article_image", "article.user_id as article_user_id", "article.source as article_source", "article.celestial_object_id  as article_celestial_object_id ")
        ->where('article.user_id', $userId)
        ->orderBy('id', 'DESC')
		->get();

        return $celestialObjects;
    }

    public function getAllArticlesWithCommentsFromUser($userId){
        $celestialObjects = Article::join('comment', 'comment.article_id', '=', 'article.id')
        ->select("article.id as article_id", "article.title as article_title", "article.slug as article_slug", "article.description as article_description", "article.image as article_image", "article.user_id as article_user_id", "article.source as article_source", "article.celestial_object_id  as article_celestial_object_id ")
        ->where('comment.user_id', $userId)
        ->orderBy('comment.created_at', 'ASC')
        ->distinct()
		->get();

        return $celestialObjects;
    }

    
}
