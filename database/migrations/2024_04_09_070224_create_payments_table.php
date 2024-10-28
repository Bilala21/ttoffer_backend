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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->string('transaction_id')->nullable();
            $table->string('last_four')->nullable();
            $table->string('token')->nullable();
            $table->string('amount')->nullable();
            $table->string('currency')->nullable();
            $table->string('description')->nullable();
            $table->string('receipt_url')->nullable();
            $table->string('status')->nullable();
            $table->string('brand')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
