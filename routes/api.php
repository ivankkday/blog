<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
// Flower就是User
Route::post('/flower',[\App\Http\Controllers\FlowerController::class, 'store']);//註冊

Route::get('/flower', [\App\Http\Controllers\FlowerController::class, 'index']);

Route::group(['middleware' => ['auth:flower']], function(){
    Route::delete('/flower/{id}', [\App\Http\Controllers\FlowerController::class,'destroy']);
 });

Route::post('/admin',[\App\Http\Controllers\AdminController::class, 'store']);//註冊


Route::group(['middleware' => ['auth:api']], function(){
    Route::delete('/admin/{id}', [\App\Http\Controllers\AdminController::class,'destroy']);
});
 
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/postBy/{id}', [\App\Http\Controllers\OneToManyController::class, 'OneToMany']);

Route::group(['middleware' => ['auth:flower']], function(){
    Route::post('/post', [\App\Http\Controllers\PostController::class, 'store']);
    Route::put('/post/update/{id}', [\App\Http\Controllers\PostController::class, 'update']);
    Route::delete('/post/update/{id}', [\App\Http\Controllers\PostController::class, 'destroy']);
});

Route::get('/post/index', [\App\Http\Controllers\PostController::class, 'index']);
Route::get('/post/show/{id}', [\App\Http\Controllers\PostController::class, 'show']);

Route::group(['middleware' => ['auth:flower']], function(){
    Route::post('/like/{id}', [\App\Http\Controllers\LikeController::class, 'like']);
});
