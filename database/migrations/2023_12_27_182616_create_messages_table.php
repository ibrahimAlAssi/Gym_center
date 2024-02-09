<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('chat_id')->constrained();
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
