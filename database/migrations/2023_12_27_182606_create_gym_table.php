<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGymTable extends Migration
{
    public function up()
    {
        Schema::create('gym', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->string('location');
            $table->text('description');
        });
    }

    public function down()
    {
        Schema::drop('gym');
    }
}
