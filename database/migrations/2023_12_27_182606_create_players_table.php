<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayersTable extends Migration
{
    public function up()
    {
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gym_id')->constrained();
            $table->foreignId('diet_id')->constrained();
            $table->string('name', 70);
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('phone');
            $table->boolean('active');
            $table->float('wallet_value');
            $table->enum('gender', ['0', '1']);
            $table->string('description');
            $table->integer('attendance_days');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('players');
    }
}
