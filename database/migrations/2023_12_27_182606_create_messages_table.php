<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->bigInteger('chat_id')->unsigned();
            $table->string('message');
            $table->bigInteger('owner_id')->unsigned();
            $table->string('owner_model');
        });
    }

    public function down()
    {
        Schema::drop('messages');
    }
}
