<?php

use App\Http\Route;


/**
 * Users
 */
Route::get('/', 'UserController@list');
Route::get('/{id}', 'UserController@get');
Route::post('/users/create', 'UserController@store');
Route::put('/users/update/{id}', 'UserController@update');
Route::delete('/users/{id}/delete','UserController@delete');

// Route::post('/users/login',         'UserController@login');
// Route::get('/users/fetch',          'UserController@fetch');


/**
 * Phones
 */
// Route::get('/phones/list', 'PhoneController@list');
// Route::get('/phones/{id}', 'PhoneController@get');
// Route::post('/phones/create', 'PhoneController@store');
// Route::put('/phones/update/{id}', 'PhoneController@update');
// Route::delete('/phones/{id}/delete', 'PhoneController@delete');