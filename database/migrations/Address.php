<?php

namespace App\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

class Address
{
    public function up() 
    {
        Capsule::schema()->create('address', function($table) {
            $table->increments("id");
            $table->integer("contact_id")->unsigned();
            $table->integer("number");
            $table->string("public_place");
            $table->string("neighborhood");
            $table->string("city");
            $table->string("state");
            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Capsule::schema()->table('address', function (Blueprint $table) {
            $table->dropForeign(['contact_id']);
        });

        Capsule::schema()->dropIfExists('address');
    }
}