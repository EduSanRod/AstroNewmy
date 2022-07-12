<?php

namespace App\Http\Controllers\WhereToStart;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WhereToStartController extends Controller
{
    public function index(){
        return view("wheretostart/index");
    }
}
