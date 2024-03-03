<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNutritionalValuesTable extends Migration
{
    public function up()
    {
        Schema::create('nutritional_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('food_id');
            $table->string('name');
            $table->double('value');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('nutritional_values');
    }
}
