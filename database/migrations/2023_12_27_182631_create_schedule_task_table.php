<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScheduleTaskTable extends Migration
{
    public function up()
    {
        Schema::create('schedule_task', function (Blueprint $table) {
            $table->id();
            $table->foreignId('schedule_id')->constrained();
            $table->foreignId('task_id')->constrained();
            $table->unsignedInteger('repeat');
            $table->double('weight');
            $table->boolean('is_complete');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('schedule_task');
    }
}
