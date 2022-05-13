<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CoordsFinder\CoordsFinderController;
use App\Http\Controllers\About\AboutController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Article\ArticleController;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Login\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//----------- Login Routes ----------//
Route::get("/login", [LoginController::class, 'displayLogin'])->name('login.index');
Route::get('/login-auth', [AuthController::class, 'authenticate'])->name('login.authenticate');
Route::get('/login-out', [LoginController::class, 'logout'])->name('login.logout');


Route::get("/coordenates_finder_form", [CoordsFinderController::class, 'displayForm'])->name('coords.form');
Route::post("/coordenates_finder_result", [CoordsFinderController::class, 'displayCoordenates'])->name('coords.display');
Route::get("/home", [HomeController::class, 'displayHome'])->name('home.display');
Route::get("/about", [AboutController::class, 'displayAbout'])->name('about.display');
Route::get("/send_mail", [AboutController::class, 'sendMessage'])->name('about.sendMessage');
Route::resource('/article', ArticleController::class)->shallow();

