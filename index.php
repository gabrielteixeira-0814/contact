<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/app/Routes/api.php';

use Src\Router;

// User
use App\Services\UserService;
use App\Controllers\UserController; 
use App\Repositories\UserRepository;

// Phone
use App\Services\PhoneService;
use App\Controllers\PhoneController; 
use App\Repositories\PhoneRepository;

// Address
use App\Services\AddressService;
use App\Controllers\AddressController; 
use App\Repositories\AddressRepository;

$userRepo = new UserRepository();
$userService = new UserService($userRepo);
$userController = new UserController($userService);

$phoneRepo = new PhoneRepository();
$phoneService = new PhoneService($phoneRepo);
$phoneController = new PhoneController($phoneService);

$addressRepo = new AddressRepository();
$addressService = new AddressService($addressRepo);
$addressController = new AddressController($addressService);

Router::setPrefix('/contact');
Router::dispatch();
