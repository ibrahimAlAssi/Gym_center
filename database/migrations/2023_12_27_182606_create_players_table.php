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
            $table->foreignId('diet_id')->nullable()->constrained();
            $table->foreignId('coach_id')->nullable()->constrained();
            $table->foreignId('wallet_id')->nullable()->constrained();
            $table->string('name', 70);
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone', 25)->nullable();
            $table->boolean('active')->nullable()->default(1);
            $table->string('gender');
            $table->integer('attendance_days')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('players');
    }
}
