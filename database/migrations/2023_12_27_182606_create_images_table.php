<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('imagable_id')->unsigned();
            $table->string('imagable_type');
            $table->string('url');
        });
    }

    public function down()
    {
        Schema::drop('images');
    }
}
