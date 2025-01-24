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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('site_id')->nullable()->references('id')->on('sites')->nullOnDelete();
            $table->foreignId('banner_id')->nullable()->references('id')->on(app(config('curator.model'))->getTable())->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['site_id']);
            $table->dropColumn('site_id');
            $table->dropForeign(['banner_id']);
            $table->dropColumn('banner_id');
        });
    }
};
