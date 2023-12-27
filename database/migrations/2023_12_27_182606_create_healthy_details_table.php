<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateHealthyDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('healthy_details', function (Blueprint $table) {
            $table->increments('id');
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
