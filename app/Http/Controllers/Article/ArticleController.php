<?php

namespace App\Http\Controllers\Article;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\Models\Article;
use App\Models\Comment;
use App\Models\Equipment;
use App\Models\ArticleEquipment;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($celestialObject = null)
    {
        if ($celestialObject == null) {
            //There is no filter for posts, show all of them.
            $articles = $this->getAllArticles();
        } else {
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
        return view("article/create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //Get all the information from the form

        $articleData = array();
        $articleData["article_title"] = $request->input('article_title');
        $articleData["article_description"] = $request->input('article_description');
        $articleData["article_source"] = $request->input('article_source');
        $articleData["article_user_id"] = $request->input('article_user_id');
        $articleData["article_slug"] = $this->generateRandomString();

        //-------- Store image ----------//

        //Define the image name and path /imagenes/article/<image-name>.jpg
        $imageName = $articleData["article_slug"] . ".jpg";
        $pathToSaveFile = 'imagenes/article/' . $imageName;

        // Move the file to the proper folder
        move_uploaded_file($_FILES['article_image']['tmp_name'], $pathToSaveFile);

        //Store in database the path to the image
        $articleData["article_image"] = $pathToSaveFile;

        //Create the new information with the stored information
        $this->createArticle($articleData);
        $article = DB::getPdo()->lastInsertId();

        //Create equipment

        //Check if the article has any equipment to add
        for ($i = 1; $i <= 5; $i++) {
            if ($request->filled('equipment_name_' . $i)) {
                //There is an input $equipment_name, so add all the fields.
                $equipmentData = array();
                $equipmentData['equipment_name'] = $request->input('equipment_name_' . $i);
                $equipmentData['equipment_type'] = $request->input('equipment_type_' . $i);

                //Create the equipment
                $this->createEquipment($equipmentData);
                $equipment = DB::getPdo()->lastInsertId();

                //add the equipment-article relationship table entry
                $data = array();
                $data["article_id"] = $article;
                $data["equipment_id"] = $equipment;

                $this->createArticleEquipment($data);
            }
        }

        //Return to the article index
        return redirect()->route('article.index');
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
        $comments = $this->getCommentsFromArticle($articleId);
        $equipments = $this->getEquipmentsFromArticle($articleId);

        return view("article/show", [
            "article" => $article,
            "comments" => $comments,
            "equipments" => $equipments,
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

    public function getAllArticles()
    {
        $celestialObjects = Article::select("article.id as article_id", "article.title as article_title", "article.slug as article_slug", "article.description as article_description", "article.image as article_image", "article.user_id as article_user_id", "article.source as article_source", "article.celestial_object_id  as article_celestial_object_id ")
            ->orderBy('id', 'DESC')
            ->get();

        return $celestialObjects;
    }

    public function getAllArticlesOf($celestialObject)
    {
        $celestialObjects = Article::select("article.id as article_id", "article.title as article_title", "article.slug as article_slug", "article.description as article_description", "article.image as article_image", "article.user_id as article_user_id", "article.source as article_source", "article.celestial_object_id  as article_celestial_object_id ")
            ->where('article.celestial_object_id', $celestialObject)
            ->orderBy('id', 'DESC')
            ->get();

        return $celestialObjects;
    }

    public function getArticle($articleId)
    {
        $celestialObject = Article::select("article.id as article_id", "article.title as article_title", "article.slug as article_slug", "article.description as article_description", "article.image as article_image", "article.user_id as article_user_id", "article.source as article_source", "article.celestial_object_id as article_celestial_object_id")
            ->where('article.id', $articleId)
            ->first();

        return $celestialObject;
    }

    public function getCommentsFromArticle($articleId)
    {
        $comments = Comment::join('users', 'comment.user_id', '=', 'users.id')
            ->select("comment.id as comment_id", "comment.comment_text as comment_comment_text", "comment.likes as comment_likes", "comment.dislikes as comment_dislikes", "users.name as comment_author", "comment.article_id as comment_article_id", "comment.created_at as comment_created_at")
            ->where('comment.article_id', $articleId)
            ->orderBy('comment.created_at', 'DESC')
            ->get();

        return $comments;
    }

    public function getEquipmentsFromArticle($articleId)
    {
        $equipment = Article::join('articleequipment', 'article.id', '=', 'articleequipment.article_id')
            ->join('equipment', 'articleequipment.equipment_id', '=', 'equipment.id')
            ->select('equipment.name as equipment_name', 'equipment.type as equipment_type')
            ->where('article.id', $articleId)
            ->get();

        return $equipment;
    }

    public function generateRandomString($length = 16)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }

    public function createArticle($articleData)
    {

        Article::insert([
            "title" => $articleData["article_title"],
            "slug" => $articleData["article_slug"],
            "description" => $articleData["article_description"],
            "image" => $articleData["article_image"],
            "user_id" => $articleData["article_user_id"],
            "source" => $articleData["article_source"],
            "celestial_object_id" => null,
        ]);
    }

    public function createEquipment($equipmentData)
    {

        Equipment::insert([
            "name" => $equipmentData["equipment_name"],
            "type" => $equipmentData["equipment_type"],
        ]);
    }

    public function createArticleEquipment($data)
    {

        ArticleEquipment::insert([
            "article_id" => $data["article_id"],
            "equipment_id" => $data["equipment_id"],
        ]);
    }
}
