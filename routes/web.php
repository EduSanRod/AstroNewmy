<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CoordsFinder\CoordsFinderController;
use App\Http\Controllers\About\AboutController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Article\ArticleController;
use App\Http\Controllers\Article\CommentController;
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
Route::get('/register', [LoginController::class, 'createLoginForm'])->name('login.create-form');
Route::post('/login-create', [LoginController::class, 'createLogin'])->name('login.create');

//----------- User Routes ----------//
Route::get('/user/settings', [LoginController::class, 'showUserSetting'])->name('user.setting');
Route::post('/user/update', [LoginController::class, 'userUpdate'])->name('user.update');
Route::get('/user/delete', [LoginController::class, 'userDelete'])->name('user.delete');
Route::get('/user/profile/articles', [LoginController::class, 'showUserArticles'])->name('user.articles');
Route::get('/user/profile/comments', [LoginController::class, 'showUserComments'])->name('user.comments');

//----------- Home Routes ----------//
Route::get("/home", [HomeController::class, 'displayHome'])->name('home.display');

//----------- Coord Finder Routes ----------//
Route::get("/coordenates_finder_form", [CoordsFinderController::class, 'displayForm'])->name('coords.form');
Route::post("/coordenates_finder_result", [CoordsFinderController::class, 'displayCoordenates'])->name('coords.display');

//----------- Article & Comments Routes ----------//
Route::resource('article', ArticleController::class);
Route::get("/create-comment", [CommentController::class, 'addComment'])->name('article.create-comment');

//----------- About Routes ----------//
Route::get("/about", [AboutController::class, 'displayAbout'])->name('about.display');
Route::get("/send_mail", [AboutController::class, 'sendMessage'])->name('about.sendMessage');