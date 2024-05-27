<?php

require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/app/routes/main.php";

use App\Core\Core;
use App\Http\Route;
use App\Http\Request;
use App\Http\Response;

// User
use App\Controllers\UserController;
use App\Repositories\UserRepository;
use App\Services\UserService;

// Phone
use App\Controllers\PhoneController;
use App\Repositories\PhoneRepository;
use App\Services\PhoneService;

$userRepo = new UserRepository();
$userService = new UserService($userRepo);
$userController = new UserController($userService);

$phoneRepo = new PhoneRepository();
$phoneService = new PhoneService($phoneRepo);
$phoneController = new PhoneController($phoneService);

$dependencies = [
    'App\\Controllers\\UserController' => $userService,
    'App\\Controllers\\PhoneController' => $phoneService,
];

Core::dispatch(Route::routes(), $dependencies);
