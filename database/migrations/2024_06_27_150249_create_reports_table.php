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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('site_id')->nullable()->references('id')->on('sites')->nullOnDelete();
            $table->foreignId('buyer_user_id')->nullable()->references('id')->on('users')->nullOnDelete();
            $table->foreignId('seller_user_id')->nullable()->references('id')->on('users')->nullOnDelete();

            $table->string('property')->nullable();
            $table->string('address')->nullable();
            $table->string('description')->nullable();

            $table->string('seller_name')->nullable();
            $table->string('seller_email')->nullable();
            $table->string('seller_phone')->nullable();

            $table->string('buyer_name')->nullable();
            $table->string('buyer_email')->nullable();
            $table->string('buyer_phone')->nullable();

            $table->decimal('price', 10, 2)->nullable();
            $table->decimal('service_fee', 10, 2)->nullable();
            $table->decimal('royalty_fee', 10, 2)->nullable();

            $table->date('selling_date')->nullable();
            $table->json('attachments')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
