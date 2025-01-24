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
        Schema::create('listing_categories', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('slug')->nullable();
            $table->string('status')->default('draft');

            $table->text('content')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();

            //$table->foreignId('parent_id')->nullable();
            $table->integer('parent_id')->default(-1);
            $table->integer('order')->default(0)->index();
            
            $table->softDeletes();
            $table->timestamps();
        });

        //Schema::table('listing_categories',function (Blueprint $table){
        //    $table->foreign('parent_id')->references('id')->on('listing_categories')->onDelete('cascade');
        //});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listing_categories');
    }
};
