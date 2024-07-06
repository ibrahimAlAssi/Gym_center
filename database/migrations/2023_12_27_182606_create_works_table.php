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
            $table->string('day');
            $table->string('man')->nullable();
            $table->string('woman')->nullable();
            $table->unique('day');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('works');
    }
}
