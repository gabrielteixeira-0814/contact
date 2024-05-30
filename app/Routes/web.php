<?php

use Src\Router;

/**
 * Function to add API prefix to routes
 */
function webRoute($method, $route, $action) {
    $prefix = '';
    Router::$method($prefix . $route, $action);
}

/**
 * Home
 */
webRoute('get', '/web', 'HomeController@index');

/**
 * Users
 */
webRoute('get', '/web/users', 'UserController@list');
webRoute('get', '/web/users/{id}', 'UserController@get');
webRoute('post', '/web/users/create', 'UserController@store');
webRoute('put', '/web/users/update/{id}', 'UserController@update');
webRoute('delete', '/web/users/{id}/delete', 'UserController@delete');

/**
 * Phones
 */
// apiRoute('get', '/phones/list', 'PhoneController@list');
// apiRoute('get', '/phones/{id}', 'PhoneController@get');
// apiRoute('post', '/phones/create', 'PhoneController@store');
// apiRoute('put', '/phones/update/{id}', 'PhoneController@update');
// apiRoute('delete', '/phones/{id}/delete', 'PhoneController@delete');

/**
 * Address
 */
// apiRoute('get', '/address/list', 'AddressController@list');
// apiRoute('get', '/address/{id}', 'AddressController@get');
// apiRoute('post', '/address/create', 'AddressController@store');
// apiRoute('put', '/address/update/{id}', 'AddressController@update');
// apiRoute('delete', '/address/{id}/delete', 'AddressController@delete');

/**
 * Contact
 */
webRoute('get', '/web/contact/list', 'ContactController@list');
webRoute('get', '/web/contact/{id}', 'ContactController@get');
webRoute('post', '/web/contact/create', 'ContactController@store');
webRoute('put', '/web/contact/update/{id}', 'ContactController@update');
webRoute('delete', '/web/contact/{id}/delete', 'ContactController@delete');