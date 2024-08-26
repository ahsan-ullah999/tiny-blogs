<?php

use App\Http\Controllers\API\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;





Route::get('/posts',[PostController::class,'index']);
Route::get('/posts/{post}',[PostController::class,'show']);
Route::get('/posts/search/{title}',[PostController::class,'search']);
Route::post('/posts',[PostController::class,'store']);
Route::patch('/posts/{post}',[PostController::class,'update']);
Route::delete('/posts/{post}',[PostController::class,'destroy']);

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
