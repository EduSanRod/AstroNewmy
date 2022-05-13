<?php

namespace App\Http\Controllers\ApiRelated;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
    //Controller to make all comunication with the API

    public function requestCoordsCelestialObject($celestialObject, $country, $city, $date){

        // Request the coords (altitude and azimuth) from a celestial object given a city and a date.

        $data=file_get_contents("http://localhost:8188/cgi-bin/AstroNewmy.py?celestialObject=". $celestialObject. "&country=". $country. "&city=". $city. "&date=". $date);

        $decodedData = json_decode($data);
        
        return $decodedData;
    }

    public function getObserverCoords($city){

        $data=file_get_contents("http://localhost:8188/cgi-bin/ObserverCoords.py?city='". $city. "'");

        $decodedData = json_decode($data);

        return $decodedData;

    }
}
