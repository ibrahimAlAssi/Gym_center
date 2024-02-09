<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayerGameTable extends Migration
{
    public function up()
    {
        Schema::create('player_challenge', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->constrained();
            $table->foreignId('coach_id')->constrained();
            $table->foreignId('challenge_id')->constrained();
            $table->string('image_before');
            $table->string('image_after');
            $table->double('weight_before');
            $table->double('weight_after');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('player_game');
    }
}
