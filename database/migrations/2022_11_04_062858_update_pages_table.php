<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            // Modify existing columns
            $table->foreignId('site_id')->nullable(true)->change();
            $table->renameColumn('status', 'http_status');

            // Add new columns
            $table->foreignId('organization_id')->default(1)->after('id');
            $table->foreignId('user_id')->nullable()->after('organization_id');
            $table->foreignId('category_id')->nullable()->after('site_id');

            // Foreign constraints
            $table->foreign('organization_id')->references('id')->on('organizations');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->foreignId('site_id')->nullable(false)->change();
            $table->renameColumn('http_status', 'status');

            $table->dropColumn('organization_id');
            $table->dropColumn('user_id');
            $table->dropColumn('category_id');

            $table->dropForeign('pages_organization_id_foreign');
            $table->dropForeign('pages_user_id_foreign');
            $table->dropForeign('pages_category_id_foreign');
        });
    }
};
