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
        Schema::create('listings', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable()->unique();
            $table->string('status')->default('draft');
            $table->text('content')->nullable();

            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);

            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            
            $table->foreignId('state_id')->nullable()->references('id')->on('states')->nullOnDelete();
            $table->foreignId('city_id')->nullable()->references('id')->on('cities')->nullOnDelete();
            $table->foreignId('district_id')->nullable()->references('id')->on('districts')->nullOnDelete();
            $table->foreignId('site_id')->nullable()->references('id')->on('sites')->nullOnDelete();
            $table->foreignId('user_id')->nullable()->references('id')->on('users')->nullOnDelete();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
