<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subscription_id')->nullable()->constrained();
            $table->foreignId('player_id')->nullable()->constrained();
            $table->string('payment_method');
            $table->json('transaction_data');
            $table->bigInteger('transaction_id');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('payments');
    }
}
