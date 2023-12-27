<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateScheduleTaskTable extends Migration
{
    public function up()
    {
        Schema::create('schedule_task', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->bigInteger('schedule_id')->unsigned();
            $table->bigInteger('task_id')->unsigned();
            $table->integer('repeat')->unsigned();
            $table->double('weight');
            $table->boolean('complete');
        });
    }

    public function down()
    {
        Schema::drop('schedule_task');
    }
}
