<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Article;

class HomeController extends Controller
{
    public function displayHome(){

        $starredCelestialObject = $this->getRandomPlanet();
        $articles = $this->getLastThreeArticles();

        return view("home/index", [
            "starredCelestialObject" => $starredCelestialObject,
            "articles" => $articles,
        ]);
    }

    public function getRandomPlanet(){
        $listOfPlanets = array("Mercury", "Venus", "Earth", "Mars", "Jupiter", "Saturn", "Uranus", "Neptune");

        $starredCelestialObject = $listOfPlanets[rand(0, 7)];

        return $starredCelestialObject;
    }

    public function getLastThreeArticles(){
        
        $articles = Article::select("article.id as article_id", "article.title as article_title", "article.slug as article_slug", "article.description as article_description", "article.image as article_image", "article.user_id as article_user_id", "article.source as article_source", "article.celestial_object_id  as article_celestial_object_id ")
        ->orderBy('id', 'DESC')
        ->limit(3)
        ->get();
    
        return $articles;

    }
}
