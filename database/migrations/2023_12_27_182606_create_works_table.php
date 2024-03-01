<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorksTable extends Migration
{
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gym_id')->constrained();
            $table->boolean('type')->comment('0 for male, 1 for female'); //male or female
            $table->tinyInteger('day')->unsigned();
            $table->boolean('working');
            $table->time('from');
            $table->time('to');
            // Add a composite unique index on 'day' and 'type'
            $table->unique(['day', 'type']);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('work');
    }
}
