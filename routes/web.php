<?php

use Illuminate\Support\Facades\Route;

Route::any('products/search', 'Admin\ProductController@search')->name('products.search')->middleware('auth');
Route::resource('products', 'Admin\ProductController')->middleware('auth');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
