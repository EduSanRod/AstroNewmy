<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function displayHome(){

        $starredCelestialObject = $this->getRandomPlanet();

        return view("home/index", [
            "starredCelestialObject" => $starredCelestialObject,
        ]);
    }

    public function getRandomPlanet(){
        $listOfPlanets = array("Mercury", "Venus", "Earth", "Mars", "Jupiter", "Saturn", "Uranus", "Neptune");

        $starredCelestialObject = $listOfPlanets[rand(0, 7)];

        return $starredCelestialObject;
    }
}
