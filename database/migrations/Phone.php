<?php

namespace App\Migrations;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Schema\Blueprint;

class Phone
{
    public function up() 
    {
        Capsule::schema()->create('phones', function(Blueprint $table) {
            $table->increments("id");
            $table->integer("user_id")->unsigned();
            $table->string("number");
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    public function down()
    {
        Capsule::schema()->table('phones', function(Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Capsule::schema()->dropIfExists('phones');
    }
}
