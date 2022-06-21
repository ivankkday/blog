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

Route::post('/flower/login',[\App\Http\Controllers\FlowerLoginController::class,'FlowerLogin']);//登入

Route::group(['middleware' => ['auth:api']], function(){
    Route::get('/flower', [\App\Http\Controllers\FlowerLoginController::class,'show']);
    Route::put('/flower', [\App\Http\Controllers\FlowerLoginController::class,'update']);
    Route::delete('/flower/{id}', [\App\Http\Controllers\FlowerLoginController::class,'destroy']);
    // Route::get('/flower','FlowerLogoutController@FlowerLogout');
 });

Route::post('/admin',[\App\Http\Controllers\AdminController::class, 'store']);//註冊

Route::post('/admin/login',[\App\Http\Controllers\FlowerLoginController::class,'FlowerLogin']);//登入

Route::group(['middleware' => ['auth:api']], function(){
    Route::get('/admin', [\App\Http\Controllers\AdminLoginController::class,'show']);
    Route::put('/admin', [\App\Http\Controllers\AdminLoginController::class,'update']);
    Route::delete('/admin/{id}', [\App\Http\Controllers\AdminLoginController::class,'destroy']);
    // Route::get('/flower','FlowerLogoutController@FlowerLogout');
});
 
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/flower/onetomany/{id}', [\App\Http\Controllers\OneToManyController::class, 'OneToMany']);