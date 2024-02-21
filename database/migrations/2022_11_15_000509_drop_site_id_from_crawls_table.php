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
        Schema::table('crawls', function (Blueprint $table) {
            // Drop foreign constraints
            $table->dropForeign('crawls_site_id_foreign');

            // Drop columns
            $table->dropColumn('site_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('crawls', function (Blueprint $table) {
            // Add columns
            $table->foreignId('site_id');

            // Add foreign constraints
            $table->foreign('site_id')->references('id')->on('sites')->onDelete('cascade');
        });
    }
};
