<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Route::resource('users',AuthController::class);
Route::post('/signup',[AuthController::class,'signup']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[AuthController::class,'logout'])->middleware('auth:sanctum');


/* Route::resource('users',UserController::class);*/
Route::get('/users',[UserController::class,'index']);
Route::get('/users/{id}',[UserController::class,'show']);

/* Route::resource('posts',PostController::class);*/
Route::get('/posts',[PostController::class,'index']);
Route::get('/posts/{post}',[PostController::class,'show']);
Route::get('/posts/search/{title}',[PostController::class,'search']);
Route::post('/posts',[PostController::class,'store']);
Route::patch('/posts/{post}',[PostController::class,'update']);
Route::delete('/posts/{post}',[PostController::class,'destroy']);

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
