<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRatesTable extends Migration
{
    public function up()
    {
        Schema::create('rates', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->bigInteger('task_id')->unsigned();
            $table->bigInteger('player_id')->unsigned();
            $table->string('content');
            $table->tinyInteger('rating');
        });
    }

    public function down()
    {
        Schema::drop('rates');
    }
}
