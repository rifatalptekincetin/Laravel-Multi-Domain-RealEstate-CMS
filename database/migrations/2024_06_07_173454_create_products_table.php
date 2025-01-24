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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->foreignId('image_id')->nullable()->references('id')->on(app(config('curator.model'))->getTable())->nullOnDelete();
            $table->text('content')->nullable();
            $table->decimal('price', 10, 2)->nullable();
            $table->string('status')->default('draft');
            $table->string('type')->default('training');
            $table->dateTime('event_time')->nullable();
            $table->string('address')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
