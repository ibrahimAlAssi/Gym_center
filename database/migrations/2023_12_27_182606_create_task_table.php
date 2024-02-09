<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskTable extends Migration
{
    public function up()
    {
        Schema::create('task', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gym_id')->constrained();
            $table->foreignId('type_id')->constrained();
            $table->string('name');
            $table->integer('number');
            $table->text('description');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('task');
    }
}
