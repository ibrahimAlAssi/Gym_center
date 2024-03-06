<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodTable extends Migration
{
    public function up()
    {
        Schema::create('food', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gym_id')->constrained();
            $table->string('name');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('food');
    }
}
