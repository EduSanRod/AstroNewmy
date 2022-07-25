<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

use App\Models\ArticleVotes;
use Illuminate\Http\Request;

class ArticleVotesController extends Controller
{
    public function likeArticle(Request $request){

        $user_id = Session::get('UserId');
        $article_id = $request->articleId;
        $vote = '1';

        //Check if there is already a vote with that user and that article.
        $idVoteFromArticle = $this->checkVoteFromArticle($article_id, $user_id);

        if($idVoteFromArticle === 0){
            //There is no previous vote, create it
            $this->likeArticleInBBDD($article_id, $user_id);

            return response()->json([
                'success' => true,
                'message' => 0,
                'messageText' => 'No habia ningun registro de voto',
            ]);

        }else{
            //There is a registry with the vote, update it to a like whatever it is
            ArticleVotes::where('id',$idVoteFromArticle)
            ->update(['vote'=>$vote]);

            return response()->json([
                'success' => true,
                'message' => 1,
                'messageText' => 'Habia un voto de dislike, se ha cambiado a Like',
            ]);
        }
    }

    public function dislikeArticle(Request $request){

        $user_id = Session::get('UserId');
        $article_id = $request->articleId;
        $vote = '-1';

        //Check if there is already a vote with that user and that article.
        $idVoteFromArticle = $this->checkVoteFromArticle($article_id, $user_id);

        if($idVoteFromArticle === 0){
            //There is no previous vote, create it
            $this->dislikeArticleInBBDD($article_id, $user_id);

            return response()->json([
                'success' => true,
                'message' => 0,
                'messageText' => 'No habia ningun registro de voto',
            ]);
        }else{
            //There is a registry with the vote, update it to a like whatever it is
            ArticleVotes::where('id',$idVoteFromArticle)
            ->update(['vote'=>$vote]);

            return response()->json([
                'success' => true,
                'message' => 1,
                'messageText' => 'Habia un voto de like, se ha cambiado a dislike',
            ]);
        }
    }

    public function removeVoteFromArticle(Request $request){
        $user_id = Session::get('UserId');
        $article_id = $request->articleId;

        //Check if there is already a vote with that user and that article.
        $checkVoteFromArticle = $this->checkVoteFromArticle($article_id, $user_id);

        if($checkVoteFromArticle){
            ArticleVotes::where([
                'article_id'=> $article_id,
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

    /*----- Query Functions -----*/

    public function checkVoteFromArticle($article_id, $user_id){
        $checkVoteArticle = ArticleVotes::where([
            'article_id'=> $article_id,
            'user_id'=> $user_id,
        ])->first();

        if($checkVoteArticle === null){
            return 0;
        }
        else{
            return $checkVoteArticle->id;
        }
    }

    public function likeArticleInBBDD($article_id, $user_id){
        ArticleVotes::firstOrCreate([
            'article_id'=> $article_id,
            'user_id'=> $user_id,
            'vote' => '1'
        ]);
        
    }

    public function dislikeArticleInBBDD($article_id, $user_id){
        ArticleVotes::firstOrCreate([
            'article_id'=> $article_id,
            'user_id'=> $user_id,
            'vote' => '-1'
        ]);
        
    }

    public function obtainVote($article_id, $user_id){
        $checkVoteArticle = ArticleVotes::where([
            'article_id'=> $article_id,
            'user_id'=> $user_id,
        ])->first();

        if($checkVoteArticle === null){
            return '0';
        }
        else{
            if($checkVoteArticle->vote === '1'){
                return '1';
            }
            else{
                return '-1';
            }
        }
    }

    public function countUpvotes($article_id){
        $upvoteCount = ArticleVotes::where('article_id', $article_id)->where('vote', '1')->count();

        return $upvoteCount;
    }

    public function countDownvotes($article_id){
        $downvoteCount = ArticleVotes::where('article_id', $article_id)->where('vote', '-1')->count();

        return $downvoteCount;
    }
}
