<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChallengesTable extends Migration
{
    public function up()
    {
        Schema::create('challenges', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gym_id')->constrained();
            $table->string('title');
            $table->text('description');
            $table->integer('cost');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('image_before');
            $table->string('image_after');
            $table->integer('gift_value');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('game');
    }
}
