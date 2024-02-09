<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gym_id')->constrained()->index();
            $table->string('platform')->unique();
            $table->string('contact'); // link
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('contacts');
    }
}
