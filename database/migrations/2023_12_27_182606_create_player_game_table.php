<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayerGameTable extends Migration
{
    public function up()
    {
        Schema::create('player_game', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->bigInteger('player_id')->unsigned();
            $table->bigInteger('game_id')->unsigned();
            $table->double('score');
        });
    }

    public function down()
    {
        Schema::drop('player_game');
    }
}
