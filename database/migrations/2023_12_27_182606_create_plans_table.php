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
            $table->timestamps();
            $table->tinyInteger('type')->unsigned();
            $table->double('cost');
        });
    }

    public function down()
    {
        Schema::drop('plans');
    }
}
