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
            $table->foreignId('chat_id')->constrained();
            $table->morphs('senderable');
            $table->string('message');
            $table->dateTime('read_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('messages');
    }
}
