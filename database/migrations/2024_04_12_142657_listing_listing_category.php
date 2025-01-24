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
        Schema::create('listing_listing_category', function (Blueprint $table) {
            $table->foreignId('listing_id')->nullable()->references('id')->on('listings')->onDelete('cascade');
            $table->foreignId('listing_category_id')->nullable()->references('id')->on('listing_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listing_listing_category');
    }
};
