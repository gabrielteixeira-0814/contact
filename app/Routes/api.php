<?php

use Src\Router;

/**
 * Function to add API prefix to routes
 */
function apiRoute($method, $route, $action) {
    $prefix = '/api';
    Router::$method($prefix . $route, $action);
}

/**
 * Users
 */
apiRoute('get', '/users', 'UserController@list');
apiRoute('get', '/users/{id}', 'UserController@get');
apiRoute('post', '/users/create', 'UserController@store');
apiRoute('put', '/users/update/{id}', 'UserController@update');
apiRoute('delete', '/users/{id}/delete', 'UserController@delete');

// apiRoute('post', '/users/login', 'UserController@login');
// apiRoute('get', '/users/fetch', 'UserController@fetch');

/**
 * Phones
 */
apiRoute('get', '/phones/list', 'PhoneController@list');
apiRoute('get', '/phones/{id}', 'PhoneController@get');
apiRoute('post', '/phones/create', 'PhoneController@store');
apiRoute('put', '/phones/update/{id}', 'PhoneController@update');
apiRoute('delete', '/phones/{id}/delete', 'PhoneController@delete');

// Router::get('/api/phones/list', 'PhoneController@list');
// Router::get('/api/phones/{id}', 'PhoneController@get');
// Router::post('/api/phones/create', 'PhoneController@store');
// Router::put('/api/phones/update/{id}', 'PhoneController@update');
// Router::delete('/api/phones/{id}/delete', 'PhoneController@delete');