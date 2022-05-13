<?php

namespace App\Http\Controllers\Article;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Article;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($celestialObject = null)
    {
        if($celestialObject == null){
            //There is no filter for posts, show all of them.
            $articles = $this->getAllArticles();

        }else{
            //There is a filter
            $articles = $this->getAllArticlesOf($celestialObject);
        }

        return view("article/index", [
            "articles" => $articles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($articleId)
    {
        $article = $this->getArticle($articleId);

        return view("article/show", [
            "article" => $article,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    //------------ Query Functions ------------//

    public function getAllArticles(){
        $celestialObjects = Article::select("article.id as article_id", "article.title as article_title", "article.slug as article_slug", "article.description as article_description", "article.image as article_image", "article.author as article_author", "article.source as article_source", "article.celestial_object_id  as article_celestial_object_id ")
        ->orderBy('id', 'DESC')
		->get();

        return $celestialObjects;
    }

    public function getAllArticlesOf($celestialObject){
        $celestialObjects = Article::select("article.id as article_id", "article.title as article_title", "article.slug as article_slug", "article.description as article_description", "article.image as article_image", "article.author as article_author", "article.source as article_source", "article.celestial_object_id  as article_celestial_object_id ")
        ->where('article.celestial_object_id', $celestialObject)
        ->orderBy('id', 'DESC')
		->get();

        return $celestialObjects;
    }

    public function getArticle($articleId){
        $celestialObject = Article::select("article.id as article_id", "article.title as article_title", "article.slug as article_slug", "article.description as article_description", "article.image as article_image", "article.author as article_author", "article.source as article_source", "article.celestial_object_id as article_celestial_object_id")
        ->where('article.id', $articleId)
		->first();

        return $celestialObject;
    }
}
