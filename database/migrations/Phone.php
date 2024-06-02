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
            $table->integer("contact_id")->unsigned();
            $table->string("number");
            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Capsule::schema()->table('phones', function(Blueprint $table) {
            $table->dropForeign(['contact_id']);
        });

        Capsule::schema()->dropIfExists('phones');
    }
}
