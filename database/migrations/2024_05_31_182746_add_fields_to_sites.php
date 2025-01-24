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
            $table->foreignId('home_id')->nullable()->references('id')->on('pages')->nullOnDelete();
            $table->json('menu')->nullable();
            $table->json('footer')->nullable();
            $table->foreignId('logo_id')->nullable()->references('id')->on(app(config('curator.model'))->getTable())->nullOnDelete();

            $table->text('about')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('telegram')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('youtube')->nullable();
            $table->string('pinterest')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sites', function (Blueprint $table) {
            $table->dropForeign(['home_id']);
            $table->dropColumn('home_id');

            $table->dropColumn('menu');
            $table->dropColumn('footer');

            $table->dropForeign(['logo_id']);
            $table->dropColumn('logo_id');

            $table->dropColumn('about');
            $table->dropColumn('phone');
            $table->dropColumn('whatsapp');
            $table->dropColumn('telegram');
            $table->dropColumn('facebook');
            $table->dropColumn('instagram');
            $table->dropColumn('twitter');
            $table->dropColumn('tiktok');
            $table->dropColumn('linkedin');
            $table->dropColumn('youtube');
            $table->dropColumn('pinterest');

        });
    }
};
