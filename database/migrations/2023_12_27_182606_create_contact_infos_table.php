<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContactInfosTable extends Migration
{
    public function up()
    {
        Schema::create('contact_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->bigInteger('gym_id')->unsigned();
            $table->string('platform');
            $table->string('contact');
        });
    }

    public function down()
    {
        Schema::drop('contact_infos');
    }
}
