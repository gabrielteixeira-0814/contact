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

/**
 * Address
 */
apiRoute('get', '/address/list', 'AddressController@list');
apiRoute('get', '/address/{id}', 'AddressController@get');
apiRoute('post', '/address/create', 'AddressController@store');
apiRoute('put', '/address/update/{id}', 'AddressController@update');
apiRoute('delete', '/address/{id}/delete', 'AddressController@delete');

/**
 * Contact
 */
apiRoute('get', '/contact/list', 'ContactController@list');
apiRoute('get', '/contact/{id}', 'ContactController@get');
apiRoute('post', '/contact/create', 'ContactController@store');
apiRoute('put', '/contact/update/{id}', 'ContactController@update');
apiRoute('delete', '/contact/{id}/delete', 'ContactController@delete');