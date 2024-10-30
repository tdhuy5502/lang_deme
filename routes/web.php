<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ClientNewsController;

Route::get('/', function () {
    return redirect()->route('top-news.index');
});



Route::controller(PostController::class)
->prefix('/posts')
->as('posts.')
->group(function(){
    Route::get('','index')->name('index');
    Route::get('/data','getData')->name('getData');
    Route::get('/create','create')->name('create');
    Route::post('/store','store')->name('store');
    Route::get('/show/{id}','show')->name('show');
    Route::post('/{id}/update','update')->name('update');
    Route::delete('{id}','destroy')->name('delete');
});

Route::controller(ClientNewsController::class)
->prefix('/top-news')
->as('top-news.')
->group(function(){
    Route::get('index','index')->name('index');
})->middleware(['SetLocale']);
