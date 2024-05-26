<?php

require_once __DIR__ ."/vendor/autoload.php";
require_once __DIR__ ."/app/routes/main.php";

use App\Core\Core;
use App\Http\Route;
use App\Controllers\UserController;
use App\Repositories\UserRepository;
use App\Services\UserService;
use App\Http\Request;
use App\Http\Response;

// Criando a instância do repositório e serviço
$userRepo = new UserRepository();
$userService = new UserService($userRepo);
$userController = new UserController($userService);

// Mapeamento de controladores para dependências
$dependencies = [
    'App\\Controllers\\UserController' => $userService,
    // Adicione outras dependências de controladores aqui...
];

Core::dispatch(Route::routes(), $dependencies);
