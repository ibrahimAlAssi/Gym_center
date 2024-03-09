<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration
{
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gym_id')->constrained();
            $table->string('type');
            $table->double('cost');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('plans');
    }
}
