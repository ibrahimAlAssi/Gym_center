<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->bigInteger('player_id')->unsigned();
            $table->tinyInteger('day')->unsigned();
            $table->boolean('complete');
        });
    }

    public function down()
    {
        Schema::drop('schedules');
    }
}
