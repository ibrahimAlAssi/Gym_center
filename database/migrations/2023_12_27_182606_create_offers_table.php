<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateOffersTable extends Migration
{
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->bigInteger('gym_id')->unsigned();
            $table->date('start_date');
            $table->date('end_date');
            $table->tinyInteger('type');
            $table->double('value');
        });
    }

    public function down()
    {
        Schema::drop('offers');
    }
}
