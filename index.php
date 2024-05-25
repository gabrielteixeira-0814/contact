<?php

require "vendor/autoload.php";

use Illuminate\Database\Capsule\Manager as Capsule;
use App\Migrations\Funcionario;

$capsule = new Capsule();

$config = [
    "driver" => "mysql",
    "host" => "127.0.0.1",
    "database" => "contacts",
    "username" => "root",
    "password" => "",

    "charset" => "utf8",
    "collation" => "utf8_unicode_ci",
    "prefix" => ""
];

$capsule->addConnection($config);
$capsule->setAsGlobal();
$capsule->bootEloquent();


$funcionario = new Funcionario();
$funcionario->up();