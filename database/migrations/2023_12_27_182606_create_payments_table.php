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
            $table->timestamps();
            $table->bigInteger('subscribe_id')->unsigned();
            $table->string('payment_method');
            $table->string('transation_data');
            $table->bigInteger('transaction_id');
        });
    }

    public function down()
    {
        Schema::drop('payments');
    }
}
