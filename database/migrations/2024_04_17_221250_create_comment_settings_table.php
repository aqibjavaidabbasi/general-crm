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
        Schema::create('comment_settings', function (Blueprint $table) {
            $table->id();

            // Default Blog settings
            $table->boolean('allow_comments')->default(true);

            // Other comment settings
            $table->boolean('require_name_email')->default(true);
            $table->boolean('require_registration')->default(false);
            $table->boolean('close_comments_for_old_blogs')->default(false);
            $table->integer('close_comments_days_old')->nullable();
            $table->integer('nested_levels')->default(2);
            $table->integer('per_page')->default(8);
            $table->enum('order', ['newer', 'older'])->default('newer');

            // Email notifications
            $table->boolean('email_on_comment')->default(false);
            $table->boolean('moderation')->default(false);
            $table->boolean('manual_approval')->default(false);
            $table->boolean('previous_approval')->default(false);

            // Comment Moderation
            $table->integer('links_threshold')->nullable();
            $table->text('hold_keywords')->nullable();
            $table->text('disallowed_keywords')->nullable();

            // Avatars
            $table->boolean('display_avatars')->default(true);
            $table->enum('default_avatar', [
                'mystery',
                'blank',
                'gravatar',
                'identicon',
                'wavatar',
                'monsterid',
                'retro',
            ])->default('mystery');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment_settings');
    }
};
