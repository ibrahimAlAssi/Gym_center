<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('coaches', function (Blueprint $table) {
            $table->id();
            $table->char('name', 100);
            $table->foreignId('wallet_id');
            $table->string('specialization')->nullable();
            $table->double('experienceYears')->nullable();
            $table->double('subscribePrice')->nullable();
            $table->string('phone', 25)->nullable();
            $table->string('email')->unique();
            $table->string('password');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coaches');
    }
};
