<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListsTable extends Migration
{
    public function up()
    {
        Schema::create('lists', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->bigInteger('listable_id')->unsigned();
            $table->string('listable_type');
        });
    }

    public function down()
    {
        Schema::drop('lists');
    }
}
