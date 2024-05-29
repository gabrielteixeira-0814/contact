<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/app/Routes/api.php';

use Src\Router;

// User
use App\Services\UserService;
use App\Controllers\UserController; 
use App\Repositories\UserRepository;

// Contact
use App\Services\ContactService;
use App\Controllers\ContactController; 
use App\Repositories\ContactRepository;

// Phone
use App\Services\PhoneService;
use App\Controllers\PhoneController; 
use App\Repositories\PhoneRepository;

// Address
use App\Services\AddressService;
use App\Controllers\AddressController; 
use App\Repositories\AddressRepository;

// User
$userRepo = new UserRepository();
$userService = new UserService($userRepo);
$userController = new UserController($userService);

// Contact
$contactRepo = new ContactRepository();
$contactService = new ContactService($contactRepo);
$contactController = new ContactController($contactService);

// Phone
$phoneRepo = new PhoneRepository();
$phoneService = new PhoneService($phoneRepo);
$phoneController = new PhoneController($phoneService);

// Address
$addressRepo = new AddressRepository();
$addressService = new AddressService($addressRepo, $contactRepo);
$addressController = new AddressController($addressService);

Router::setPrefix('/contact');
Router::dispatch();