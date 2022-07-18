<?php

namespace App\Http\Controllers\Article;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

use App\Models\Article;
use App\Models\Comment;
use DateTime;


class CommentController extends Controller
{
    public function addComment($articleId, Request $request){

        //Check if user is logged in
        if (!Auth::check()) {
            return redirect()->route('article.index');
        }

        date_default_timezone_set('Europe/Madrid');
        $comment_text = $request->input('comment_text');
        $user_id = Session::get('UserId');
        $article_id = $articleId;
        $now = new DateTime();
        $date = $now->format('H:i d/m/Y');

        // Insert new comment in Database
        Comment::insert([
            'comment_text'=> $comment_text,
            'likes'=> 0,
            'dislikes'=> 0,
            'user_id'=> $user_id,
            'article_id'=> $article_id,
            'created_at'=> $date,
        ]);

        return redirect()->back();
    }
}
