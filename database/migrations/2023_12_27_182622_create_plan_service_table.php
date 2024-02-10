<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanServiceTable extends Migration
{
    public function up()
    {
        Schema::create('plan_service', function (Blueprint $table) {
            $table->id();
            $table->foreignId('plan_id')->constrained();
            $table->foreignId('service_id')->constrained();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('plan_service');
    }
}
