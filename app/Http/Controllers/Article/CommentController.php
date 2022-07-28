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
            'user_id'=> $user_id,
            'article_id'=> $article_id,
            'created_at'=> $date,
        ]);

        return redirect()->back();
    }

    public function addReplyToComment($commentToReplyTo, Request $request){
        //Check if user is logged in
        if (!Auth::check()) {
            return redirect()->route('article.index');
        }

        //Get the information from the comment to reply to fill the parameters missing
        $commentReplied = $this->getComment($commentToReplyTo);

        date_default_timezone_set('Europe/Madrid');
        $comment_text = $request->input('reply_comment_text');
        $user_id = Session::get('UserId');
        $article_id = $commentReplied->comment_article_id;
        $comment_id = $commentReplied->comment_id;
        $now = new DateTime();
        $date = $now->format('H:i d/m/Y');

        // Insert the reply in Database
        Comment::insert([
            'comment_text'=> $comment_text,
            'user_id'=> $user_id,
            'article_id'=> $article_id,
            'comment_id'=> $comment_id,
            'created_at'=> $date,
        ]);

        return redirect()->back();
    }

    public function deleteComment($commentId){
        Comment::where('id', $commentId)
        ->update([
            "comment_text" => null,
        ]);

        return redirect()->back();
    }

    public function getComment($comment_id){
        $comment = Comment::select("comment.id as comment_id", "comment.comment_text as comment_comment_text", "comment.article_id as comment_article_id", "comment.created_at as comment_created_at")
        ->where('id', $comment_id)
        ->first();

        return $comment;
    }
}
