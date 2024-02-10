<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatesTable extends Migration
{
    public function up()
    {
        Schema::create('rates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained();
            $table->foreignId('player_id')->constrained();
            $table->string('content');
            $table->enum('rating', ['1', '2', '3', '4', '5']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('rates');
    }
}
