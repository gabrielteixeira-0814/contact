<?php

use App\Http\Route;

Route::get('/{id}',                 'UserController@get');
Route::post('/users/create',        'UserController@store');
Route::put('/users/update/{id}',    'UserController@update');
Route::delete('/users/{id}/delete', 'UserController@delete');

// Route::post('/users/login',         'UserController@login');
// Route::get('/users/fetch',          'UserController@fetch');
