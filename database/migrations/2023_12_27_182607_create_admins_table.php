<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gym_id')->constrained();
            // $table->foreignId('role_id')->constrained();
            $table->char('name', 100);
            $table->string('image')->nullable();
            $table->string('phone', 25)->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('admins');
    }
}
