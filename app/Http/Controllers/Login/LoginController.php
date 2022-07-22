<?php

namespace App\Http\Controllers\Login;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Article\FavouriteArticlesController;

use App\Models\User;
use App\Models\Article;
use App\Models\Comment;

class LoginController extends Controller
{
    public function displayLogin()
    {

        //If user is logged in, log them out.
        if (Auth::check()) {
            Auth::logout();
        }

        return view("login/index");
    }

    public function logout()
    {

        //If user is logged in, log them out.
        if (Auth::check()) {
            Auth::logout();
        }

        return redirect()->route('home.display');
    }

    public function createLoginForm()
    {

        return view("login/create");
    }

    public function createLogin(Request $request)
    {

        $username = $request->input('username');
        $email = $request->input('email');
        $password = $request->input('password');

        DB::table('users')->insert(['name' => $username, 'email' => $email, 'password' => Hash::make($password)]);

        return redirect()->route('login.index');
    }

    public function showUserSetting()
    {
        //Check if user is logged in
        if (!Auth::check()) {
            return redirect()->route('article.index');
        }

        return view("user/setting");
    }

    public function userUpdate(Request $request)
    {
        //Check if user is logged in
        if (!Auth::check()) {
            return redirect()->route('article.index');
        }

        if (url()->previous() !=  url('user/settings') && url()->previous() !=  url('user/update')) {
            return redirect()->to('/home');
        }

        $name = $request->input('username');
        $email = $request->input('email');

        $idUserToUpdate = auth()->user()->id;

        if (isset($name)) {
            User::where("id", $idUserToUpdate)->update([
                "name" => $name,
            ]);
        }

        if (isset($email)) {
            User::where("id", $idUserToUpdate)->update([
                "email" => $email,
            ]);
        }

        //Change password from user
        $oldPassword = $request->input('old_password');
        $newPassword = $request->input('new_password');
        $confirmPassword = $request->input('confirm_password');

        if (isset($oldPassword) || isset($newPassword) || isset($confirmPassword)) {
            //If any of the fields is filled, invoke the process to change the password

            //Flag to check if the change of password is correct
            $validatePasswordChange = TRUE;

            //Var that contains the message to desplay the errors of changing password
            $message = "";

            //Check if any of the 3 fields is empty
            if (!isset($oldPassword) || !isset($newPassword) || !isset($confirmPassword)) {
                $validatePasswordChange = FALSE;
                $message = $message . "- The old password, the new password and the confirmation must be filled. \n";
            }

            //Check if the old password is the correct one
            $user = User::find(auth()->user()->id);
            if (!Hash::check($oldPassword, $user->password)) {
                $validatePasswordChange = FALSE;
                $message = $message . "- The old password does not match, try again. \n";
            }

            //Check if the new password and its confirmation are the same
            if ($newPassword != $confirmPassword) {
                $validatePasswordChange = FALSE;
                $message = $message . "- The new password and its confirmation does not match, try again. \n";
            }

            if ($validatePasswordChange) {
                //Process to change the password
                User::whereId(auth()->user()->id)->update([
                    'password' => Hash::make($newPassword)
                ]);

                return view("user/setting");
            } else {
                //The process has encounter an error, return to the settings and display the error message.
                return view("user/setting", [
                    "message" => $message,
                ]);
            }
        }

        return redirect()->route('user.setting');
    }

    public function userDelete()
    {
        //Check if user is logged in
        if (!Auth::check()) {
            return redirect()->route('article.index');
        }

        //To prevent the user from writing the route /user/delete and deleting its own account, only delete if the previous route is the settings
        if (url()->previous() !=  url('user/settings')) {
            return redirect()->to('/home');
        }

        $idUserToDelete = auth()->user()->id;

        if (Auth::check()) {
            Auth::logout();
        }

        User::where('id', $idUserToDelete)->delete();

        return redirect()->route('login.index');
    }

    public function showUserArticles()
    {
        //Check if user is logged in
        if (!Auth::check()) {
            return redirect()->route('article.index');
        }

        $userId = auth()->user()->id;
        $articles = $this->getAllArticlesFromUser($userId);

        $favouriteQuery = new FavouriteArticlesController();

        foreach ($articles as $article) {
            // Attribute to check if the article is saved as favourite
            $checkfavourite = $favouriteQuery->checkSaveArticle($article->article_id);
            $article->check_favourite = $checkfavourite;

            // Attribute to check how many comments an article has
            $article->number_comments = $this->getNumberOfCommentsFrom($article->article_id);
        }

        return view("user/articles", [
            "articles" => $articles,
        ]);
    }

    public function showUserComments()
    {
        //Check if user is logged in    
        if (!Auth::check()) {
            return redirect()->route('article.index');
        }

        $userId = auth()->user()->id;
        $articles = $this->getAllArticlesWithCommentsFromUser($userId);
        $favouriteQuery = new FavouriteArticlesController();

        foreach ($articles as $article) {
            // Attribute to check if the article is saved as favourite
            $checkfavourite = $favouriteQuery->checkSaveArticle($article->article_id);
            $article->check_favourite = $checkfavourite;

            // Attribute to check how many comments an article has
            $article->number_comments = $this->getNumberOfCommentsFrom($article->article_id);
        }

        return view("user/comments", [
            "articles" => $articles,
        ]);
    }

    public function showUserFavourites()
    {
        //Check if user is logged in    
        if (!Auth::check()) {
            return redirect()->route('article.index');
        }

        $userId = auth()->user()->id;
        $articles = $this->getAllFavouriteArticlesFromUser($userId);

        $favouriteQuery = new FavouriteArticlesController();

        foreach ($articles as $article) {
            // Attribute to check if the article is saved as favourite
            $checkfavourite = $favouriteQuery->checkSaveArticle($article->article_id);
            $article->check_favourite = $checkfavourite;

            // Attribute to check how many comments an article has
            $article->number_comments = $this->getNumberOfCommentsFrom($article->article_id);
        }

        return view("user/favourites", [
            "articles" => $articles,
        ]);
    }

    public function getAllArticlesFromUser($userId)
    {
        $celestialObjects = Article::select("article.id as article_id", "article.title as article_title", "article.slug as article_slug", "article.description as article_description", "article.image as article_image", "article.user_id as article_user_id", "article.source as article_source", "article.celestial_object_id  as article_celestial_object_id ")
            ->where('article.user_id', $userId)
            ->orderBy('id', 'DESC')
            ->get();

        return $celestialObjects;
    }

    public function getAllArticlesWithCommentsFromUser($userId)
    {
        $celestialObjects = Article::join('comment', 'comment.article_id', '=', 'article.id')
            ->select("article.id as article_id", "article.title as article_title", "article.slug as article_slug", "article.description as article_description", "article.image as article_image", "article.user_id as article_user_id", "article.source as article_source", "article.celestial_object_id  as article_celestial_object_id ")
            ->where('comment.user_id', $userId)
            ->orderBy('comment.created_at', 'DESC')
            ->distinct()
            ->get();

        return $celestialObjects;
    }

    public function getAllFavouriteArticlesFromUser($userId)
    {
        $celestialObjects = Article::join('savedarticles', 'savedarticles.article_id', '=', 'article.id')
            ->select("article.id as article_id", "article.title as article_title", "article.slug as article_slug", "article.description as article_description", "article.image as article_image", "article.user_id as article_user_id", "article.source as article_source", "article.celestial_object_id  as article_celestial_object_id ")
            ->where('savedarticles.user_id', $userId)
            ->orderBy('savedarticles.created_at', 'DESC')
            ->distinct()
            ->get();

        return $celestialObjects;
    }

    public function getNumberOfCommentsFrom($article_id){
        $numberOfComments = Comment::where('article_id', $article_id)->count();
        
        return $numberOfComments;
    }
}
