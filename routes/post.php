<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/postBy/{id}', [\App\Http\Controllers\OneToManyController::class, 'OneToMany']);

Route::group(['middleware' => ['auth:flower']], function(){
    Route::post('/post', [\App\Http\Controllers\PostController::class, 'store']);
    Route::put('/post/update/{id}', [\App\Http\Controllers\PostController::class, 'update']);
    Route::delete('/post/update/{id}', [\App\Http\Controllers\PostController::class, 'destroy']);
});

Route::get('/post/index', [\App\Http\Controllers\PostController::class, 'index']);
Route::get('/post/show/{id}', [\App\Http\Controllers\PostController::class, 'show']);
