<?php

namespace App\Http\Controllers\CoordsFinder;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\CelestialObject;
use App\Http\Controllers\ApiRelated\ApiController;
use DateTime;

class CoordsFinderController extends Controller
{
    // Display form to get the information to pass to the API.

    

    public function displayForm() {
        //Function to display the form.

        $celestialObjects = $this->getAllCelestialObjects();

        return view("coordsFinder/Form", [
            "celestialObjects" => $celestialObjects,
        ]);
    }

    public function displayCoordenates(Request $request) {
        //Function to display the results from the form.

        $country = $request->input('country');
        $city = $request->input('city');
        $datepick = $request->input('datepick');
        $timeStart = $request->input('timeStart');
        $timeEnd = $request->input('timeEnd');

        $apiQuery = new ApiController();

        $data = $apiQuery->getObserverCoords($city);

        $latitude = $data->latitude;
        $longitude = $data->longitude;


        $celestialObjects = array();

        $celestialObjectsData = $this->getAllCelestialObjects();

        foreach($celestialObjectsData as $celestialObjectSingleData){
            if(isset($_POST[$celestialObjectSingleData->celestialobject_name])){
                $celestialObjects[$celestialObjectSingleData->celestialobject_name] = $celestialObjectSingleData->celestialobject_name;
            }
        }

        $datetmp = DateTime::createFromFormat('m/d/Y', $datepick);
        $date = $datetmp->format('Y-m-d');

        $hourStart = date("H:i", strtotime($timeStart));
        $hourEnd = date("H:i", strtotime($timeEnd));

        $datehourStart = strval($date. " ". $hourStart);
        $datehourEnd = strval($date. " ". $hourEnd);

        $resultData = array();
        foreach($celestialObjects as $celestialObject){
            $planetData = array();
            $planetData[] = $apiQuery->GetAltitudeAndAzimuth($celestialObject, $latitude, $longitude, $datehourStart);
            $planetData[] = $apiQuery->GetAltitudeAndAzimuth($celestialObject, $latitude, $longitude, $datehourEnd);

            $resultData[] = $planetData;
        }
        /*
        echo "<pre>";
        var_dump($resultData);
        echo "</pre>";
        */
        return view("coordsFinder/displayCoords", [
            "country" => $country,
            "city" => $city,
            "datepick" => $datepick,
            "timeStart" => $timeStart,
            "timeEnd" => $timeEnd,
            "celestialObjects" => $celestialObjects,
            "latitude" => $latitude,
            "longitude" => $longitude,
            "resultData" => $resultData,
        ]);
    }

    //-------------- Query Functions --------------//

    public function getAllCelestialObjects(){
        $celestialObjects = CelestialObject::select("celestialobject.id as celestialobject_id", "celestialobject.name as celestialobject_name", "celestialobject.description as celestialobject_description", "celestialobject.image as celestialobject_image")
		->get();

        return $celestialObjects;
    }

}
