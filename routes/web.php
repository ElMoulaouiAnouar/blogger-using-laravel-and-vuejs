<?php

use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;

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

define('PAGINATION_NUMBER',9);

Route::group(['prefix'=>'tag'],function(){
    Route::get('create',[TagController::class,'create'])->name('tag.create');
    Route::post('store',[TagController::class,'store'])->name('tag.store');
    Route::get('all',[TagController::class,'all'])->name('tag.all');
});

Route::group(['prefix'=>'categorie'],function(){
    Route::get('create',[CategorieController::class,'create'])->name('categorie.create');
    Route::post('store',[CategorieController::class,'store'])->name('categorie.store');
    Route::get('all',[CategorieController::class,'all'])->name('categorie.all');
});

Route::group(['prefix'=>'post'],function(){
    Route::get('create',[PostController::class,'create'])->name('post.create');
     Route::post('store',[PostController::class,'store'])->name('post.store');
     Route::get('all',[PostController::class,'all'])->name('post.all');
     Route::get('/show/{id}',[PostController::class,'show'])->name('post.show');
     Route::get('/populare',[PostController::class,'getPopularePosts']);
});
Route::group(['prefix','comment'],function(){
    Route::post('store',[CommentController::class,'store'])->name('comment.store');
});
Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');

Auth::routes(['verify'=>true]);


