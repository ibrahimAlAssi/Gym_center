<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGameTable extends Migration
{
    public function up()
    {
        Schema::create('game', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('title');
            $table->text('description');
            $table->double('cost');
            $table->string('game');
            $table->date('start_date');
            $table->tinyInteger('type');
            $table->string('gift_value');
        });
    }

    public function down()
    {
        Schema::drop('game');
    }
}
