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
            // Add new columns
            $table->string('url')->after('organization_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('crawls', function (Blueprint $table) {
            // Drop Columns
            $table->dropColumn('url');
        });
    }
};
