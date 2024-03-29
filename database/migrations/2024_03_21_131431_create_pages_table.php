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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('category_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('parent_page')->nullable();
            $table->string('page_title')->nullable();
            $table->longText('page_description')->nullable();
            $table->longText('content')->nullable();
            $table->string('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->string('togle_status')->default(1)->comment("1 for normale page./0 for conent only");
            $table->unsignedBigInteger('featured_image_id')->nullable();
            $table->string('published_status')->default(1)->comment("1 for published/0 for unpublished");
            $table->string('make_homepage')->default(1)->comment("1 for normale page/0 for Home-page");
            $table->string('visibility')->nullable()->comment("private/public/password protected");
            $table->string('published_date_time')->nullable()->comment("sheduling the page / when it live/access");
            $table->string("status")->nullable()->comment("1 for active and 0 for not trash");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
