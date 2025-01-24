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
        Schema::table('listings', function($table) {
            $table->foreignId('image_id')->nullable()->references('id')->on(app(config('curator.model'))->getTable())->nullOnDelete();
        });
        Schema::table('listing_categories', function($table) {
            $table->foreignId('image_id')->nullable()->references('id')->on(app(config('curator.model'))->getTable())->nullOnDelete();
        });
        Schema::table('posts', function($table) {
            $table->foreignId('image_id')->nullable()->references('id')->on(app(config('curator.model'))->getTable())->nullOnDelete();
        });
        Schema::table('post_categories', function($table) {
            $table->foreignId('image_id')->nullable()->references('id')->on(app(config('curator.model'))->getTable())->nullOnDelete();
        });
        Schema::table('sites', function($table) {
            $table->foreignId('image_id')->nullable()->references('id')->on(app(config('curator.model'))->getTable())->nullOnDelete();
        });

        Schema::create('listing_media', function (Blueprint $table) {
            $table->foreignId('listing_id')->nullable()->references('id')->on('listings')->onDelete('cascade');
            $table->foreignId('media_id')->nullable()->references('id')->on(app(config('curator.model'))->getTable())->onDelete('cascade');
            $table->foreignId('order')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('listings', function($table) {
            $table->dropForeign(['image_id']);
            $table->dropColumn('image_id');
        });
        Schema::table('listing_categories', function($table) {
            $table->dropForeign(['image_id']);
            $table->dropColumn('image_id');
        });
        Schema::table('posts', function($table) {
            $table->dropForeign(['image_id']);
            $table->dropColumn('image_id');
        });
        Schema::table('post_categories', function($table) {
            $table->dropForeign(['image_id']);
            $table->dropColumn('image_id');
        });
        Schema::table('sites', function($table) {
            $table->dropForeign(['image_id']);
            $table->dropColumn('image_id');
        });

        Schema::dropIfExists('listing_media');
    }
};
