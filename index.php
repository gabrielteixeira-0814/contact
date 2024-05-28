<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/app/Routes/api.php';

use Src\Router;

use App\Services\UserService;
use App\Controllers\UserController; 
use App\Repositories\UserRepository;

use App\Services\PhoneService;
use App\Controllers\PhoneController; 
use App\Repositories\PhoneRepository;

// Instancie os objetos necessários
$userRepo = new UserRepository();
$userService = new UserService($userRepo);
$userController = new UserController($userService);

// Instancie os objetos necessários
$phoneRepo = new PhoneRepository();
$phoneService = new PhoneService($phoneRepo);
$phoneController = new PhoneController($phoneService);

Router::setPrefix('/contact');
Router::dispatch();
