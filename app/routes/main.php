<?php

use App\Http\Route;


/**
 * Users
 */
Route::get('/', 'UserController@list');
Route::get('/{id}', 'UserController@get');
Route::post('/users/create', 'UserController@store');
Route::put('/users/update/{id}', 'UserController@update');
Route::delete('/users/{id}/delete', 'UserController@delete');

// Route::post('/users/login',         'UserController@login');
// Route::get('/users/fetch',          'UserController@fetch');


/**
 * Phones
 */
Route::get('/', 'PhonesController@list');
Route::get('/{id}', 'PhonesController@get');
Route::post('/phones/create', 'PhonesController@store');
Route::put('/phones/update/{id}', 'PhonesController@update');
Route::delete('/phones/{id}/delete', 'PhonesController@delete');