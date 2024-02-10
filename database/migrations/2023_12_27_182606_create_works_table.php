<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorksTable extends Migration
{
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('gym_id')->unsigned();
            $table->tinyInteger('type'); //male of female
            $table->tinyInteger('day')->unsigned();
            $table->boolean('working');
            $table->time('from');
            $table->time('to');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('work');
    }
}
