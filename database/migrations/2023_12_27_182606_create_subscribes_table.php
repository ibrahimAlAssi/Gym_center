<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscribesTable extends Migration
{
    public function up()
    {
        Schema::create('subscribes', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('player_id')->unsigned();
            $table->bigInteger('plan_id')->unsigned();
            $table->bigInteger('coach_Id')->unsigned();
            $table->bigInteger('offer_id')->unsigned();
            $table->decimal('cost', 10, 2);
            $table->text('description');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('closet_number')->unsigned();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('subscribe');
    }
}
