<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscribesTable extends Migration
{
    public function up()
    {
        Schema::create('subscribes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gym_id')->constrained();
            $table->foreignId('player_id')->constrained();
            $table->foreignId('plan_id')->constrained();
            $table->foreignId('coach_id')->constrained();
            $table->foreignId('discount_id')->constrained();
            $table->decimal('cost', 10, 2);
            $table->text('description');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('closet_number')->unsigned();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('subscribes');
    }
}
