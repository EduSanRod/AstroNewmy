<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

use App\Models\FavouriteArticles;
use Illuminate\Http\Request;


class FavouriteArticlesController extends Controller
{
    /*Add an article to Saved articles*/

    public function saveArticle(Request $request){
        $user_id = Session::get('UserId');
        $article_id = $request->articleId;

        $this->saveArticleBBDD($article_id, $user_id);

        return response()->json([
            'success' => true,
        ]);
    }

    /*Delete an article from Saved articles*/

    public function deleteFromSavedArticle(Request $request){
        $user_id = Session::get('UserId');
        $article_id = $request->articleId;

        $this->deleteSavedArticleBBDD($article_id, $user_id);

        return response()->json([
            'success' => true,
        ]);
    }

    public function checkSaveArticle($article_id){
        $user_id = Session::get('UserId');

        $checkFavouriteArticle = $this->checkSavedArticleBBDD($article_id, $user_id);

        return $checkFavouriteArticle;
    }

    /*------- MYSQL Functions ----------*/

    public function saveArticleBBDD($article_id, $user_id){
        FavouriteArticles::firstOrCreate([
            'article_id'=> $article_id,
            'user_id'=> $user_id,
        ]);
    }

    public function deleteSavedArticleBBDD($article_id, $user_id){
        $checkArticleIsFavourite = $this->checkSavedArticleBBDD($article_id, $user_id);

        if($checkArticleIsFavourite){
            FavouriteArticles::where([
                'article_id'=> $article_id,
                'user_id'=> $user_id,
            ])->delete();
        }
        
    }

    public function checkSavedArticleBBDD($article_id, $user_id){
        $checkFavouriteArticle = FavouriteArticles::where([
            'article_id'=> $article_id,
            'user_id'=> $user_id,
        ])->first();

        if($checkFavouriteArticle === null){
            return false;
        }
        else{
            return true;
        }

    }
}
