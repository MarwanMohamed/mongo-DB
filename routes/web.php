<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'collectionsController@index');
Route::get('/documentation/{name}', 'collectionsController@documention');
Route::get('/documentation/{name}/id/{id}', 'collectionsController@byID');
Route::post('/documentation/{name}/{id}/delete', 'collectionsController@destroy');
Route::get('/documentation/{name}/{id}/edit', 'collectionsController@edit');
Route::post('/documentation/{name}/{id}/edit', 'collectionsController@update');
Route::get('/documentation/{name}/create', 'collectionsController@create');
Route::post('/documentation/{name}/create', 'collectionsController@store');
Auth::routes();

Route::get('/home', 'HomeController@index');
