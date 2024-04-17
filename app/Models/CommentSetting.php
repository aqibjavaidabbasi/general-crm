<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'value',
        'allow_comments',
        'require_name_email',
        'require_registration',
        'close_days',
        'nested_levels',
        'per_page',
        'order',
        'email_on_comment',
        'moderation',
        'manual_approval',
        'previous_approval',
        'links_threshold',
        'hold_keywords',
        'disallowed_keywords',
        'display_avatars',
        'default_avatar',
    ];

}
