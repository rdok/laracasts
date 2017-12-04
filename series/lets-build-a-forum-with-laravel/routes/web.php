<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

\Illuminate\Support\Facades\Auth::routes();

Route::get('/thread', 'ThreadController@index');
Route::get('/thread/{thread}', 'ThreadController@show');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
