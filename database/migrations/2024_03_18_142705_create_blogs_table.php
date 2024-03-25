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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description')->nullable();
            $table->longText('content')->nullable();
            $table->string('meta_title')->nullable();;
            $table->longText('meta_description')->nullable();
            $table->string('format')->nullable();
            $table->json('category_ids')->nullable();
            $table->json('tag_ids')->nullable();
            $table->unsignedBigInteger('blog_media_id')->nullable();
            $table->foreign('blog_media_id')->references('id')->on('media');
            $table->string('status')->nullable()->comment("draft/pending/preview");
            $table->string('visibility')->nullable();
            $table->string('published_date_time')->nullable()->comment("sheduling the page / when it live/access");
            $table->boolean('featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
