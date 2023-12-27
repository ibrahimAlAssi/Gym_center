<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServicesTable extends Migration
{
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->bigInteger('plan_id')->unsigned();
            $table->string('name');
            $table->text('description');
            $table->string('permission_name');
        });
    }

    public function down()
    {
        Schema::drop('services');
    }
}
