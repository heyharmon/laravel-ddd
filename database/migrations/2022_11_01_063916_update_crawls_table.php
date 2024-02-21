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
            $table->string('status')->default('READY')->change();
            $table->integer('total')->default(0)->after('status');
            $table->integer('handled')->default(0)->after('total');
            $table->integer('pending')->default(0)->after('handled');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('crawls', function (Blueprint $table) {
            $table->dropColumn('total');
            $table->dropColumn('handled');
            $table->dropColumn('pending');
        });
    }
};
