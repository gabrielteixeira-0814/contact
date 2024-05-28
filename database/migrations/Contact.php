<?php

namespace App\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

class Contact
{
    public function up() 
    {
        Capsule::schema()->create('contacts', function($table) {
            $table->increments("id");
            $table->integer("user_id")->unsigned();
            $table->integer("address_id")->unsigned();
            $table->integer("phone_id")->unsigned();
            $table->string("name");
            $table->string("email");
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('address_id')->references('id')->on('address');
            $table->foreign('phone_id')->references('id')->on('phones');
            $table->timestamps();
        });
    }

    public function down()
    {
        Capsule::schema()->table('contacts', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['address_id']);
            $table->dropForeign(['phone_id']);
        });

        Capsule::schema()->dropIfExists('contacts');
    }
}