<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TweetController;
use App\Http\Controllers\Api\UserRegistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware("auth:sanctum")
    ->prefix("/tweet")
    ->group(function(){
        Route::get("get",[TweetController::class,"get"]);
        Route::post("add",[TweetController::class,"add"]);
    });

Route::post("auth",[AuthController::class,"auth"]);

Route::post('/regist/store', [UserRegistController::class, 'store']);