<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactInfosTable extends Migration
{
    public function up()
    {
        Schema::create('contact_infos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('gym_id')->unsigned();
            $table->string('platform');
            $table->string('contact');
        });
    }

    public function down()
    {
        Schema::drop('contact_infos');
    }
}
