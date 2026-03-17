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
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->foreignId('artist_id')->constrained()->onDelete('cascade');
            $table->string('album')->nullable();
            $table->text('lyrics');
            $table->string('youtube_link')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('genre')->nullable();
            $table->integer('release_year')->nullable();
            $table->integer('views')->default(0);
            $table->string('status')->default('pending'); // pending, approved
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('songs');
    }
};
