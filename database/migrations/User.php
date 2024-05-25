<?php

namespace App\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;

class User
{
    public function up() 
    {
        Capsule::schema()->create('users', function($table) {
            $table->increments("id");
            $table->string("name");
            $table->string("email")->unique();
            $table->string("password");
            $table->timestamps();
        });
    }

    public function down()
    {
        Capsule::schema()->drop('users');
    }
}