<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Categories routes
Route::post('/categories', 'CategoryController@store')->name('categories.store');
Route::patch('/categories/{category}', 'CategoryController@update')->name('categories.update');
Route::delete('/categories/{category}', 'CategoryController@destroy')->name('categories.destroy');

// News routes
Route::post('/news/search', 'NewsController@search')->name('news.search');
Route::resource('news', 'NewsController');

