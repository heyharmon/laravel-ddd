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
        Schema::table('pages', function (Blueprint $table) {
            // Add new columns
            $table->boolean('redirected')->default(0)->after('wordcount');
            $table->string('requested_url')->after('redirected');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            // Drop Columns
            $table->dropColumn('redirected');
            $table->dropColumn('requested_url');
        });
    }
};
