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
            $table->boolean('is_archived')->nullable()->default(false);
            $table->boolean('is_sold')->nullable()->default(false);
            $table->unsignedBigInteger('sold_to_user_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product', function (Blueprint $table) {
            $table->dropColumn('is_archived');
            $table->dropColumn('is_sold');
            $table->dropColumn('sold_to_user_id');
        });
    }
};
