<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatsTable extends Migration
{
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->bigInteger('palyer_id')->unsigned();
            $table->bigInteger('admin_id')->unsigned();
        });
    }

    public function down()
    {
        Schema::drop('chats');
    }
}
