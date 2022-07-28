<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CoordsFinder\CoordsFinderController;
use App\Http\Controllers\About\AboutController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Article\ArticleController;
use App\Http\Controllers\Article\CommentController;
use App\Http\Controllers\Article\CommentVotesController;
use App\Http\Controllers\Article\FavouriteArticlesController;
use App\Http\Controllers\Article\ArticleVotesController;
use App\Http\Controllers\Login\LoginController;
use App\Http\Controllers\Login\AuthController;
use App\Http\Controllers\WhereToStart\WhereToStartController;

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
Route::post('/login-auth', [AuthController::class, 'authenticate'])->name('login.authenticate');
Route::get('/login-out', [LoginController::class, 'logout'])->name('login.logout');
Route::get('/register', [LoginController::class, 'createLoginForm'])->name('login.create-form');
Route::post('/login-create', [LoginController::class, 'createLogin'])->name('login.create');

//----------- User Routes ----------//
Route::get('/user/settings', [LoginController::class, 'showUserSetting'])->name('user.setting');
Route::post('/user/update', [LoginController::class, 'userUpdate'])->name('user.update');
Route::get('/user/delete', [LoginController::class, 'userDelete'])->name('user.delete');
Route::get('/user/profile/articles', [LoginController::class, 'showUserArticles'])->name('user.articles');
Route::get('/user/profile/comments', [LoginController::class, 'showUserComments'])->name('user.comments');
Route::get('/user/profile/favourites', [LoginController::class, 'showUserFavourites'])->name('user.favourites');
Route::get("/user/profile/likes", [LoginController::class, 'showUserLikes'])->name('user.likes');

//----------- Home Routes ----------//
Route::get("/home", [HomeController::class, 'displayHome'])->name('home.display');

//----------- WhereToStart Routes ----------//
Route::get("/where-to-start", [WhereToStartController::class, 'index'])->name('wheretostart.index');

//----------- Article & Comments Routes ----------//
Route::resource('article', ArticleController::class);
//--- Article Favourites
Route::post("/save-as-favourite", [FavouriteArticlesController::class, 'saveArticle'])->name('article.saved-article');
Route::delete("/delete-from-favourite", [FavouriteArticlesController::class, 'deleteFromSavedArticle'])->name('article.delete-saved-article');
//--- Article Votes
Route::post("/like-article", [ArticleVotesController::class, 'likeArticle'])->name('article.like-article');
Route::post("/dislike-article", [ArticleVotesController::class, 'dislikeArticle'])->name('article.dislike-article');
Route::delete("/remove-vote-article", [ArticleVotesController::class, 'removeVoteFromArticle'])->name('article.remove-vote-article');
//--- Comments
Route::get("/create-comment/{articleId}", [CommentController::class, 'addComment'])->name('article.create-comment');
Route::get("/reply-comment/{commentId}", [CommentController::class, 'addReplyToComment'])->name('article.reply-comment');
Route::delete("/delete-comment/{commentId}", [CommentController::class, 'deleteComment'])->name('article.delete-comment');
//--- Comments Votes
Route::post("/like-comment", [CommentVotesController::class, 'likeComment'])->name('article.like-comment');
Route::post("/dislike-comment", [CommentVotesController::class, 'dislikeComment'])->name('article.dislike-comment');
Route::delete("/remove-vote-comment", [CommentVotesController::class, 'removeVoteComment'])->name('article.remove-vote-comment');


//----------- About Routes ----------//
Route::get("/about", [AboutController::class, 'displayAbout'])->name('about.display');
Route::get("/send_mail", [AboutController::class, 'sendMessage'])->name('about.sendMessage');





//----------- Coord Finder Routes ----------//
//Route::get("/coordenates_finder_form", [CoordsFinderController::class, 'displayForm'])->name('coords.form');
//Route::post("/coordenates_finder_result", [CoordsFinderController::class, 'displayCoordenates'])->name('coords.display');
