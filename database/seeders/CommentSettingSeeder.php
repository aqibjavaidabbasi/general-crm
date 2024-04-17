<?php

namespace Database\Seeders;

use App\Models\CommentSetting;
use Illuminate\Database\Seeder;

class CommentSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        CommentSetting::create([
            'allow_comments' => 1,
            'require_name_email' => 0,
            'require_registration' => 0,
            'close_days' => 1,
            'nested_levels' => 2,
            'per_page' => 8,
            'order' => 'newer',
            'email_on_comment' => 0,
            'moderation' => 0,
            'manual_approval' => 0,
            'previous_approval' => 0,
            'links_threshold' => 1,
            'hold_keywords' => '',
            'disallowed_keywords' => '',
            'display_avatars' => 1,
            'default_avatar' => 'mystery',
        ]);
    }
}
