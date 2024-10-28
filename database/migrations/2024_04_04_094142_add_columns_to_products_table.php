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
        Schema::table('product', function (Blueprint $table) {
            $table->boolean('is_urgent')->default(false);
            $table->unsignedInteger('total_review')->nullable()->default(0);
            $table->double('review_percentage')->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product', function (Blueprint $table) {
            $table->dropColumn('is_urgent');
            $table->dropColumn('total_review');
            $table->dropColumn('review_percentage');
        });
    }
};
