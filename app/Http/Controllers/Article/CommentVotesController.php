<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\CommentVotes;

class CommentVotesController extends Controller
{
    public function likeComment(Request $request){

        //Check if user is logged in    
        if (!Auth::check()) {
            return redirect()->route('article.index');
        }

        $user_id = Session::get('UserId');
        $comment_id = $request->commentId;
        $vote = '1';

        //Check if there is already a vote with that user and that comment.
        $idVoteFromComment = $this->checkVoteFromComment($comment_id, $user_id);

        if($idVoteFromComment === 0){
            //There is no previous vote, create it
            $this->likeCommentInBBDD($comment_id, $user_id);

            return response()->json([
                'success' => true,
                'message' => 0,
                'messageText' => 'No habia ningun registro de voto',
            ]);
        }else{
            //There is a registry with the vote, update it to a like whatever it is
            CommentVotes::where('id', $idVoteFromComment)
            ->update(['vote'=>$vote]);

            return response()->json([
                'success' => true,
                'message' => 1,
                'messageText' => 'Habia un voto de dislike, se ha cambiado a Like',
            ]);
        }
    }

    public function dislikeComment(Request $request){

        //Check if user is logged in    
        if (!Auth::check()) {
            return redirect()->route('article.index');
        }

        $user_id = Session::get('UserId');
        $comment_id = $request->commentId;
        $vote = '-1';

        //Check if there is already a vote with that user and that comment.
        $idVoteFromComment = $this->checkVoteFromComment($comment_id, $user_id);

        if($idVoteFromComment === 0){
            //There is no previous vote, create it
            $this->dislikeCommentInBBDD($comment_id, $user_id);

            return response()->json([
                'success' => true,
                'message' => 0,
                'messageText' => 'No habia ningun registro de voto',
            ]);
        }else{
            //There is a registry with the vote, update it to a like whatever it is
            CommentVotes::where('id', $idVoteFromComment)
            ->update(['vote'=>$vote]);

            return response()->json([
                'success' => true,
                'message' => 1,
                'messageText' => 'Habia un voto de dislike, se ha cambiado a Like',
            ]);
        }
    }

    public function removeVoteComment(Request $request){
        
        //Check if user is logged in    
        if (!Auth::check()) {
            return redirect()->route('article.index');
        }

        $user_id = Session::get('UserId');
        $comment_id = $request->commentId;

        //Check if there is already a vote with that user and that comment.
        $idVoteFromComment = $this->checkVoteFromComment($comment_id, $user_id);

        if($idVoteFromComment){
            CommentVotes::where([
                'comment_id'=> $comment_id,
                'user_id'=> $user_id,
            ])->delete();

            return response()->json([
                'success' => true,
                'message' => 0,
                'messageText' => 'Se ha borrado el voto',
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 1,
            'messageText' => 'No habia voto',
        ]);
    }

    //----------- Query Functions -------------

    public function checkVoteFromComment($comment_id, $user_id){
        $checkVoteComment = CommentVotes::where([
            'comment_id'=> $comment_id,
            'user_id'=> $user_id,
        ])->first();

        if($checkVoteComment === null){
            return 0;
        }
        else{
            return $checkVoteComment->id;
        }
    }

    public function likeCommentInBBDD($comment_id, $user_id){
        CommentVotes::firstOrCreate([
            'comment_id'=> $comment_id,
            'user_id'=> $user_id,
            'vote' => '1'
        ]);
    }

    public function dislikeCommentInBBDD($comment_id, $user_id){
        CommentVotes::firstOrCreate([
            'comment_id'=> $comment_id,
            'user_id'=> $user_id,
            'vote' => '-1'
        ]);
    }

    public function obtainVoteFromComment($comment_id, $user_id){
        $checkVoteComment = CommentVotes::where([
            'comment_id'=> $comment_id,
            'user_id'=> $user_id,
        ])->first();

        if($checkVoteComment === null){
            return '0';
        }
        else{
            if($checkVoteComment->vote === '1'){
                return '1';
            }
            else{
                return '-1';
            }
        }
    }

    public function countUpvotes($comment_id){
        $upvoteCount = CommentVotes::where('comment_id', $comment_id)->where('vote', '1')->count();

        return $upvoteCount;
    }

    public function countDownvotes($comment_id){
        $downvoteCount = CommentVotes::where('comment_id', $comment_id)->where('vote', '-1')->count();

        return $downvoteCount;
    }
}
