<?php

require_once __DIR__ ."/vendor/autoload.php";
require_once __DIR__ ."/src/routes/main.php";

use App\Core\Core;
use App\Http\Route;


Core::dispatch(Route::routes());



// use App\Models\Funcionario;

// require "bootstrap.php";

// $funcionario = Funcionario::find(1);

// print_r($funcionario->nome);

// // Criar
// $funcionario = new Funcionario();
// // $funcionario->nome = "Paulo Reis";
// // $funcionario->sexo = "M";
// // $funcionario->data_nascimento = "1995-02-06";
// // $funcionario->save();