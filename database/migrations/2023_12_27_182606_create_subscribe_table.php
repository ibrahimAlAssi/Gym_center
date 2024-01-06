<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscribeTable extends Migration
{
    public function up()
    {
        Schema::create('subscribe', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->bigInteger('player_id')->unsigned();
            $table->bigInteger('plan_id')->unsigned();
            $table->bigInteger('coach_Id')->unsigned();
            $table->bigInteger('offer_id')->unsigned();
            $table->double('cost');
            $table->text('description');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('closet_number')->unsigned();
        });
    }

    public function down()
    {
        Schema::drop('subscribe');
    }
}
