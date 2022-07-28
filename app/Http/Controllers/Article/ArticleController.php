<?php

namespace App\Http\Controllers\Article;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Image;
use App\Http\Controllers\Article\FavouriteArticlesController;
use App\Http\Controllers\Article\ArticleVotesController;
use App\Http\Controllers\Article\CommentVotesController;

use App\Models\Article;
use App\Models\Comment;
use App\Models\CommentVotes;
use App\Models\Equipment;
use App\Models\ArticleEquipment;
use App\Models\ArticleVotes;
use App\Models\FavouriteArticles;

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

            $favouriteQuery = new FavouriteArticlesController();
            $voteQuery = new ArticleVotesController();

            foreach($articles as $article){
                // Attribute to check if the article is saved as favourite
                $checkfavourite = $favouriteQuery->checkSaveArticle($article->article_id);
                $article->check_favourite = $checkfavourite;

                // Attribute to check how many comments an article has
                $article->number_comments = $this->getNumberOfCommentsFrom($article->article_id);

                $article->vote = $voteQuery->obtainVote($article->article_id, Session::get('UserId'));

                //Get the number of upvotes and downvotes
                $article->upvotes_count = $voteQuery->countUpvotes($article->article_id);
                $article->downvotes_count = $voteQuery->countDownvotes($article->article_id);
            }
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
        //Check if user is logged in
        if (!Auth::check()) {
            return redirect()->route('article.index');
        }

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
        //Check if user is logged in
        if (!Auth::check()) {
            return redirect()->route('article.index');
        }

        //Get all the information from the form

        $articleData = array();
        $articleData["article_title"] = $request->input('article_title');
        $articleData["article_description"] = $request->input('article_description');
        $articleData["article_user_id"] = Session::get('UserId');
        $articleData["article_slug"] = $this->generateRandomString();

        //-------- Store image ----------//

        //Define the image name and path /imagenes/article/<image-name>.jpg
        $imageName = $articleData["article_slug"] . ".jpg";
        $pathToSaveFileOriginal = 'imagenes/article/original/' . $imageName;
        $pathToSaveFileResized = 'imagenes/article/standarized/' . $imageName;

        //Make a copy of the image to resize it to be 750px of width (so the image is not too large to slow down the web)
        $resizedImage = Image::make($_FILES['article_image']['tmp_name']); 
        $resizedImage->resize(750, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $resizedImage->save(public_path($pathToSaveFileResized));
        

        // Move the original file to the proper original folder
        move_uploaded_file($_FILES['article_image']['tmp_name'], $pathToSaveFileOriginal);

        //Store in database the path to the image
        $articleData["article_image"] = $articleData["article_slug"] . ".jpg";

        //------------------//

        //Create the new information with the stored information
        $this->createArticle($articleData);
        $article = DB::getPdo()->lastInsertId();

        //Create equipment

        //Check if the article has any equipment to add
        for ($i = 0; $i < 5; $i++) {
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

        // Attribute to check if the article is saved as favourite
        $favouriteQuery = new FavouriteArticlesController();

        $checkfavourite = $favouriteQuery->checkSaveArticle($article->article_id);
        $article->check_favourite = $checkfavourite;

        //Check if the article has an upvote or downvote
        $voteQuery = new ArticleVotesController();

        $article->vote = $voteQuery->obtainVote($article->article_id, Session::get('UserId'));

        //Get the number of upvotes and downvotes
        $article->upvotes_count = $voteQuery->countUpvotes($article->article_id);
        $article->downvotes_count = $voteQuery->countDownvotes($article->article_id);

        //Get the equipment from the article
        $equipments = $this->getEquipmentsFromArticle($articleId);

        //Get the comments from the article and the reply for each comment
        $comments = $this->getCommentsFromArticle($articleId);
        $voteComment = new CommentVotesController();

        foreach($comments as $comment){

            //Check if the user has voted the comment
            $comment->vote = $voteComment->obtainVoteFromComment($comment->comment_id, Session::get('UserId'));

            //Get the number of upvotes and downvotes
            $comment->upvotes_count = $voteComment->countUpvotes($comment->comment_id);
            $comment->downvotes_count = $voteComment->countDownvotes($comment->comment_id);

            $commentReplies = $this->getCommentsReplyFromArticle($comment->comment_id);
            foreach($commentReplies as $reply){
                //Check if the user has voted the comment
                
                $reply->vote = $voteComment->obtainVoteFromComment($reply->comment_id_reply, Session::get('UserId'));

                //Get the number of upvotes and downvotes
                $reply->upvotes_count = $voteComment->countUpvotes($reply->comment_id_reply);
                $reply->downvotes_count = $voteComment->countDownvotes($reply->comment_id_reply);
            }
            $comment->replies = $commentReplies;
        }

        // Attribute to check how many comments an article has
        $article->number_comments = $this->getNumberOfCommentsFrom($article->article_id);

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
    public function edit($articleId)
    {

        //Check if user is logged in
        if (!Auth::check()) {
            return redirect()->route('article.index');
        }

        $previousArticleData = $this->getArticle($articleId);
        $userId = Auth::id();

        if($userId != $previousArticleData->article_user_id){
            //Verify that the user logued is the same as the author of the article
            return redirect()->route('article.index');
        }

        //Get the data from the Article

        $articleData = $this->getArticle($articleId);

        //Get the equipments from the article.

        $equipmentsFromArticle = $this->getEquipmentsFromArticle($articleId);

        return view("article/edit", [
            "article" => $articleData,
            "equipments" => $equipmentsFromArticle,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $articleId)
    {
        //Check if user is logged in
        if (!Auth::check()) {
            return redirect()->route('article.index');
        }
        
        $previousArticleData = $this->getArticle($articleId);
        $userId = Auth::id();

        if($userId != $previousArticleData->article_user_id){
            //Verify that the user logued is the same as the author of the article
            return redirect()->route('article.index');
        }
        
        //Flag that checks if there is an image change
        $imageExists = false;

        //Update the data from article

        $articleData = array();
        $articleData["article_title"] = $request->input('article_title');
        $articleData["article_description"] = $request->input('article_description');

        //-------- Store image ----------//

        if(is_uploaded_file($_FILES['article_image']['tmp_name'])){
            //Flag to make the image change
            $imageExists = true;

            //New image has been uploaded, delete the previous image.
            unlink("imagenes/article/original/". $previousArticleData->article_image);
            unlink("imagenes/article/standarized/". $previousArticleData->article_image);

            //Define the image name and path /imagenes/article/<image-name>.jpg
            $newImageSlug = $this->generateRandomString();
            $newImageName = $newImageSlug. ".jpg";
            $pathToSaveFileOriginal = "imagenes/article/original/". $newImageName;
            $pathToSaveFileResized = "imagenes/article/standarized/". $newImageName;

            //Make a copy of the image to resize it to be 750px of width (so the image is not too large to slow down the web)
            $resizedImage = Image::make($_FILES['article_image']['tmp_name']); 
            $resizedImage->resize(750, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $resizedImage->save(public_path($pathToSaveFileResized));

            // Move the file to the proper folder
            move_uploaded_file($_FILES['article_image']['tmp_name'], $pathToSaveFileOriginal);

            //Store in database the path to the image
            $articleData["article_image"] = $newImageName;
            $articleData["article_slug"] = $newImageSlug;
        }
        
        //------------------//

        $this->updateArticle($articleId, $articleData, $imageExists);

        //To prevent keeping information that should be deleted related to article & equipment, delete all the information and re-create it

        //Delete the equipment related to the article

        $this->deleteEquipmentFromArticle($articleId);

        //Create the new equipment related to the article

        //Check if the article has any equipment to add
        for ($i = 0; $i < 5; $i++) {
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
                $data["article_id"] = $previousArticleData->article_id;
                $data["equipment_id"] = $equipment;

                $this->createArticleEquipment($data);
            }
        }

        //Return to the article index
        return redirect()->route('article.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($articleId)
    {
        //Check if the user is logged in and has the role of admin
        if (!Auth::check()) {
            return redirect()->route('article.index');
        }

        $userRole = Auth::user()->role;
        if($userRole !== 'admin'){
            return redirect()->route('article.index');
        }

        //Get the information from the article to be deleted
        $articleData = $this->getArticle($articleId);

        //Delete article equipment
        $this->deleteEquipmentFromArticle($articleId);

        //Delete article comments and votes
        $this->deleteCommentsFromArticle($articleId);
        $this->deleteCommentsVotesFromArticle($articleId);

        //Delete article likes and dislikes entries
        $this->deleteVotesFromArticle($articleId);

        //Delete article from saved
        $this->deleteArticleFromFavourites($articleId);

        //Delete article 
        $this->deleteArticle($articleId);

        //Delete article image from server
        unlink("imagenes/article/original/". $articleData->article_image);
        unlink("imagenes/article/standarized/". $articleData->article_image);

        return redirect()->route('article.index');
    }

    //------------ Query Functions ------------//

    public function getAllArticles()
    {
        $celestialObjects = Article::select("article.id as article_id", "article.title as article_title", "article.slug as article_slug", "article.description as article_description", "article.image as article_image", "article.user_id as article_user_id", "article.source as article_source", "article.celestial_object_id  as article_celestial_object_id")
            ->orderBy('id', 'DESC')
            ->get();

        return $celestialObjects;
    }

    public function getNumberOfCommentsFrom($article_id){
        $numberOfComments = Comment::where('article_id', $article_id)->count();
        
        return $numberOfComments;
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
            ->select("comment.id as comment_id", "comment.comment_text as comment_comment_text", "comment.user_id as comment_user_id", "users.name as comment_author", "comment.article_id as comment_article_id", "comment.created_at as comment_created_at")
            ->where('comment.article_id', $articleId)
            ->where('comment.comment_id', null)
            ->orderBy('comment.created_at', 'DESC')
            ->get();

        return $comments;
    }

    public function getCommentsReplyFromArticle($commentId)
    {
        $comments = Comment::join('users', 'comment.user_id', '=', 'users.id')
            ->select("comment.id as comment_id_reply", "comment.comment_text as comment_comment_text", "comment.user_id as comment_user_id_reply", "users.name as comment_author", "comment.article_id as comment_article_id", "comment.created_at as comment_created_at")
            ->where('comment.comment_id', $commentId)
            ->orderBy('comment.created_at', 'ASC')
            ->get();

            if($comments){
                return $comments;
            }
            else{
                return null;
            }
        
    }

    public function getEquipmentsFromArticle($articleId)
    {
        $equipment = Article::join('articleequipment', 'article.id', '=', 'articleequipment.article_id')
            ->join('equipment', 'articleequipment.equipment_id', '=', 'equipment.id')
            ->select('equipment.id as equipment_id', 'equipment.name as equipment_name', 'equipment.type as equipment_type')
            ->where('article.id', $articleId)
            ->get();

        return $equipment;
    }

    public function createArticle($articleData)
    {

        Article::insert([
            "title" => $articleData["article_title"],
            "slug" => $articleData["article_slug"],
            "description" => $articleData["article_description"],
            "image" => $articleData["article_image"],
            "user_id" => $articleData["article_user_id"],
            "celestial_object_id" => null,
        ]);
    }

    public function updateArticle($articleId, $articleData, $imageExists)
    {
        if ($imageExists){
            Article::where('id', $articleId)
            ->update([
                "title" => $articleData["article_title"],
                "description" => $articleData["article_description"],
                "image" => $articleData["article_image"],
                "slug" => $articleData["article_slug"],
            ]);
        }
        else{
            Article::where('id', $articleId)
            ->update([
                "title" => $articleData["article_title"],
                "description" => $articleData["article_description"],
            ]);
        }
        
    }

    public function deleteArticle($articleId){
        Article::where('id', $articleId)->delete();
    }

    public function deleteEquipmentFromArticle($articleId)
    {

        $equipments = $this->getEquipmentsFromArticle($articleId);

        ArticleEquipment::where('article_id', $articleId)->delete();

        foreach($equipments as $equipment){
            Equipment::where('id', $equipment->equipment_id)->delete();
        }
        
    }

    public function deleteCommentsFromArticle($articleId){
        Comment::where('article_id', $articleId)->delete();
    }

    public function deleteCommentsVotesFromArticle($articleId){
        CommentVotes::where('article_id', $articleId)->delete();
    }

    public function deleteVotesFromArticle($articleId){
        ArticleVotes::where('article_id', $articleId)->delete();
    }

    public function deleteArticleFromFavourites($articleId){
        FavouriteArticles::where('article_id', $articleId)->delete();
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

    public function generateRandomString($length = 16)
    {
        return substr(str_shuffle(str_repeat($x = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }

    
}
