<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PostController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// Route::controller(NewsController::class)->prefix('/posts')->group(function(){
//     Route::post('/store','createPost')->name('createPost');
// });

// Route::controller(PostController::class)
// ->prefix('/posts')
// ->as('posts.')
// ->group(function(){
//     Route::get('','index')->name('index');
//     Route::get('/data','getData')->name('getData');
//     Route::get('/create','create')->name('create');
//     Route::post('/store','store')->name('store');
//     Route::get('/show/{id}','show')->name('show');
//     Route::post('/{id}/update','update')->name('update');
//     Route::delete('{id}','destroy')->name('delete');
// });