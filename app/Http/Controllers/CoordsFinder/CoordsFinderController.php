<?php

namespace App\Http\Controllers\CoordsFinder;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Http\Controllers\QueryFunctions\QueryFunctionController;

class CoordsFinderController extends Controller
{
    // Display form to get the information to pass to the API.

    

    public function displayForm() {
        //Function to display the form.
        $query = new QueryFunctionController();

        $celestialObjects = $query->getAllCelestialObjects();

        return view("coordsFinder/Form", [
            "celestialObjects" => $celestialObjects,
        ]);
    }

    
}
