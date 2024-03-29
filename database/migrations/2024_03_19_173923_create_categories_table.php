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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('categories')->onDelete('cascade');
            $table->integer('position')->default(0);
            $table->longText('description')->nullable();
            $table->boolean('featured')->default(false);
            $table->boolean('status')->default(true);
            $table->string('slug')->nullable();
            $table->string('meta_title')->nullable();;
            $table->longText('meta_description')->nullable();
            $table->unsignedBigInteger('meta_media_id')->nullable();
            $table->foreign('meta_media_id')->references('id')->on('media');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};