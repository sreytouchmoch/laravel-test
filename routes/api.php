<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controller\PostController;
use App\Http\Controller\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//public route:
Route::post('/signup',[UserController::class,'signup']);// regitser, create new account
Route::post('/login',[UserController::class,'login']);

//
Route::get('/post',[PostController::class,'index']);
Route::get('/post/{id}',[PostController::class,'show']);

// private route:
Route::group(['middleware' =>['auth:sanctum']], function(){
    Route::post('/post',[PostController::class,'store']);
    Route::put('/post/{id}',[PostController::class,'update']);
    Route::delete('post/{id}',[PostController::class,'destroy']);
});