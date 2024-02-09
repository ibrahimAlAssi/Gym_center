<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHealthyDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('healthy_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_id')->constrained();
            $table->text('description');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('healthy_details');
    }
}
