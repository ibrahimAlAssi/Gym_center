<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkTable extends Migration
{
    public function up()
    {
        Schema::create('work', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('gym_id')->unsigned();
            $table->tinyInteger('type');
            $table->tinyInteger('day')->unsigned();
            $table->boolean('working');
            $table->time('from');
            $table->time('to');
        });
    }

    public function down()
    {
        Schema::drop('work');
    }
}
