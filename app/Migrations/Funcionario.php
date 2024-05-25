<?php

namespace App\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class Funcionario
{
    public function up() 
    {
        Capsule::schema()->create('funcionarios', function($table) {
            $table->increments("id");
            $table->string("nome");
            $table->enum("sexo", ["M", "F", "NB"])->nullable();
            $table->date("data_nascimento")->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Capsule::schema()->drop('funcionarios');
    }
}