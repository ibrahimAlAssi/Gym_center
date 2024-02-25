<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffersTable extends Migration
{
    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gym_id')->constrained();
            $table->date('start_date');
            $table->date('end_date');
            $table->tinyInteger('type')->nullable();
            $table->double('value')->nullable();
            $table->date('extra_date')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('offers');
    }
}
