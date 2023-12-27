<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTaskTable extends Migration
{
    public function up()
    {
        Schema::create('task', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->string('name');
            $table->integer('number');
            $table->bigInteger('type_id')->unsigned();
            $table->text('description');
        });
    }

    public function down()
    {
        Schema::drop('task');
    }
}
