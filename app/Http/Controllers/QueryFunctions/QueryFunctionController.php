<?php

namespace App\Http\Controllers\QueryFunctions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\CelestialObject;

class QueryFunctionController extends Controller
{
    public function getAllCelestialObjects(){
        $celestialObjects = CelestialObject::select("celestialobject.id as celestialobject_id", "celestialobject.name as celestialobject_name", "celestialobject.description as celestialobject_description", "celestialobject.image as celestialobject_image")
		->get();

        return $celestialObjects;
    }
}
