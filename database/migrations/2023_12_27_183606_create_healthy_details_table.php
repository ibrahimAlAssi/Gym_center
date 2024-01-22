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
            $table->timestamps();
            $table->bigInteger('player_id')->unsigned();
            $table->text('description');
        });
    }

    public function down()
    {
        Schema::drop('healthy_details');
    }
}
