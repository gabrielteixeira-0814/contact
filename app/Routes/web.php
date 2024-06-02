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
 * Address
 */
webRoute('get', '/web/address/list', 'AddressController@list');
webRoute('get', '/web/address/{id}', 'AddressController@get');
webRoute('post', '/web/address/create', 'AddressController@store');
webRoute('put', '/web/address/update/{id}', 'AddressController@update');
webRoute('delete', '/web/address/{id}/delete', 'AddressController@delete');

/**
 * Contact
 */
webRoute('get', '/web/contact/list', 'ContactController@list');
webRoute('get', '/web/contact/{id}', 'ContactController@get');
webRoute('post', '/web/contact/create', 'ContactController@store');
webRoute('put', '/web/contact/update/{id}', 'ContactController@update');
webRoute('delete', '/web/contact/{id}/delete', 'ContactController@delete');

/**
 * Phones
 */
webRoute('get', '/web/phones/list', 'PhoneController@list');
webRoute('get', '/web/phones/{id}', 'PhoneController@get');
webRoute('post', '/web/phones/create', 'PhoneController@store');
webRoute('put', '/web/phones/update/{id}', 'PhoneController@update');
webRoute('delete', '/web/phones/{id}/delete', 'PhoneController@delete');
