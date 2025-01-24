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
        Schema::table('sites', function (Blueprint $table) {
            $table->foreignId('state_id')->nullable()->references('id')->on('states')->nullOnDelete();
            $table->foreignId('city_id')->nullable()->references('id')->on('cities')->nullOnDelete();
            $table->foreignId('district_id')->nullable()->references('id')->on('districts')->nullOnDelete();
            $table->string('address')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sites', function (Blueprint $table) {
            $table->dropForeign(['state_id']);
            $table->dropColumn('state_id');
            $table->dropForeign(['city_id']);
            $table->dropColumn('city_id');
            $table->dropForeign(['district_id']);
            $table->dropColumn('district_id');
            $table->dropColumn('address');
        });
    }
};
