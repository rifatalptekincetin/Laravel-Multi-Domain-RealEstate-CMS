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
        Schema::create('listing_metas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('listing_id')->nullable()->references('id')->on('listings')->onDelete('cascade');
            $table->foreignId('listing_option_id')->nullable()->references('id')->on('listing_options')->onDelete('cascade');
            $table->json('meta_value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listing_metas');
    }
};
