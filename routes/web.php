<?php

use App\Http\Controllers\ImageController;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UserController;
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

Route::get('/', [MainController::class,'home']);
Route::get('/addNote', [MainController::class,'addNote']);
Route::post('/post/addNote', [NoteController::class,'addNote']);


Route::get('/register', [MainController::class,'register']);
Route::post('/post/register', [UserController::class,'registerPost']);



Route::get('/authorization', [MainController::class,'authorization']);
Route::post('/post/authorization', [UserController::class,'authorizationPost']);


Route::get('/user/{id}/{name}', function ($id, $name) {
    return view('about');
});
