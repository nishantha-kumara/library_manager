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

Route::get('/', 'user\BookUserController@index')->name('user.home');  
Route::post('/search', 'user\BookUserController@searchRelatedBooks')->name('book.search');  

Route::group(['as'=>'admin.','prefix' => 'admin','namespace'=>'Admin','middleware'=>['auth','admin']], function () {
	Route::get('dashboard', 'DashboardController@index')->name('dashboard'); 
    Route::get('/add-author', 'DashboardController@create')->name('author.add');
    Route::post('/post-author', 'DashboardController@store')->name('author.store');
    Route::post('/show-author', 'DashboardController@show')->name('author.get');
    Route::get('/edit-author/{id}', 'DashboardController@edit')->name('author.edit');
    Route::put('/update-author/{id}', 'DashboardController@update')->name('author.update');
    Route::post('/delete-author', 'DashboardController@destroy')->name('author.delete');
    Route::post('/active-author', 'DashboardController@restore')->name('author.active');
    Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');
});

Route::group(['as'=>'author.','prefix' => 'author','namespace'=>'Author','middleware'=>['auth','author']], function () {
	Route::get('dashboard', 'DashboardController@index')->name('dashboard');
	Route::get('/add-book', 'DashboardController@create')->name('book.add');
	Route::post('/post-book', 'DashboardController@store')->name('book.store');
    Route::post('/show-book', 'DashboardController@show')->name('book.get');
    Route::get('/edit-book/{id}', 'DashboardController@edit')->name('book.edit');
    Route::put('/update-book/{id}', 'DashboardController@update')->name('book.update');
    Route::post('/delete-book', 'DashboardController@destroy')->name('book.delete');
});

Auth::routes();

//Use resource routes like
// Route::resource('user', 'User\UserController'); -> this will handle index/create/store/update/delete
