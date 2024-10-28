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
            $table->string('brand')->nullable()->after('color');
            $table->string('model')->nullable()->after('brand');
            $table->string('edition')->nullable()->after('model');
            $table->string('authenticity')->nullable()->after('edition');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $table->dropColumn('brand');
        $table->dropColumn('model');
        $table->dropColumn('edition');
        $table->dropColumn('authenticity');
    }
};
