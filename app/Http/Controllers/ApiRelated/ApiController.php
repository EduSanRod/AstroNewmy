<?php

namespace App\Http\Controllers\ApiRelated;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Andrmoel\AstronomyBundle\AstronomicalObjects\Planets\Jupiter;
use Andrmoel\AstronomyBundle\AstronomicalObjects\Planets\Mars;
use Andrmoel\AstronomyBundle\AstronomicalObjects\Planets\Mercury;
use Andrmoel\AstronomyBundle\AstronomicalObjects\Planets\Neptune;
use Andrmoel\AstronomyBundle\AstronomicalObjects\Planets\Saturn;
use Andrmoel\AstronomyBundle\AstronomicalObjects\Planets\Uranus;
use Andrmoel\AstronomyBundle\AstronomicalObjects\Planets\Venus;
use Andrmoel\AstronomyBundle\AstronomicalObjects\Sun;
use Andrmoel\AstronomyBundle\AstronomicalObjects\Moon;
use Andrmoel\AstronomyBundle\Location;
use Andrmoel\AstronomyBundle\TimeOfInterest;

class ApiController extends Controller
{
    //Controller to make all comunication with the API

    public function GetAltitudeAndAzimuth($celestialObject, $latitude, $longitude, $datehour){
        date_default_timezone_set('UTC');
        $location = Location::create($latitude, $longitude); 

        $toi = TimeOfInterest::createFromString($datehour); //'2018-05-13 16:15:00'

        $planet = null;

        switch ($celestialObject) {
            case "Mercury":
                $planet = Mercury::create($toi);
                break;
            case "Venus":
                $planet = Venus::create($toi);
                break;
            case "Mars":
                $planet = Mars::create($toi);
                break;
            case "Jupiter":
                $planet = Jupiter::create($toi);
                break;
            case "Saturn":
                $planet = Saturn::create($toi);
                break;
            case "Uranus":
                $planet = Uranus::create($toi);
            break;
            case "Neptune":
                $planet = Neptune::create($toi);
                break;
            case "Sun":
                $planet = Sun::create($toi);
                break;
            case "Moon":
                $planet = Moon::create($toi);
                break;
        }

        //Get altitude and Azimuth
        $locHorCoords = $planet->getLocalHorizontalCoordinates($location);
        $azimuth = $locHorCoords->getAzimuth();
        $altitude = $locHorCoords->getAltitude();

        $planetData = array();
        $planetData["celestialObject"] = $celestialObject;
        $planetData["datehour"] = $datehour;
        $planetData["azimuth"] = $azimuth;
        $planetData["altitude"] = $altitude;

        return $planetData;

    }

    public function getObserverCoords($city){

        $data=file_get_contents("http://localhost:8188/cgi-bin/ObserverCoords.py?city='". $city. "'");

        $decodedData = json_decode($data);

        return $decodedData;

    }
}
