<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/thread', 'ThreadController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
