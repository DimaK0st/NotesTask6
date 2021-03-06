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
Route::get('notes/getCsv', [NoteController::class,'getCsvFile']);
Route::get('notes/importCsv', [MainController::class,'importCsv']);
Route::post('notes/post/csv', [NoteController::class,'importCsvFile']);
Route::resource('notes', NoteController::class);

Route::get('/', [MainController::class,'home'])->name('home');;
Route::get('/post/logout', [MainController::class,'logout']);
//Route::get('/getNote/{id}', [NoteController::class,'getOneNote'])->name('getNote');

//Route::get('/addNote', [MainController::class,'addNote']);
//Route::post('/post/addNote', [NoteController::class,'addNote']);

//Route::get('/editNote/{id}', [NoteController::class,'editNote']);
//Route::post('/post/editNote', [NoteController::class,'editPostNote']);

//Route::post('/deleteNote', [NoteController::class,'deletePostNote']);



Route::get('/register', [MainController::class,'register']);
Route::post('/post/register', [UserController::class,'registerPost']);
Route::get('/authorization', [MainController::class,'authorization']);
Route::post('/post/authorization', [UserController::class,'authorizationPost']);



Route::get('/user/{id}/{name}', function ($id, $name) {
    return view('about');
});

