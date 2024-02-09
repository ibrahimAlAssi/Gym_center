<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->constrained();
            $table->tinyInteger('day')->unsigned();
            $table->boolean('complete');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('schedules');
    }
}
