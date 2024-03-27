<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'content',
        'meta_title',
        'meta_description',
        'visibility',
        'visibilityOption',
        'published_date_time',
        'format',
        'category_ids',
        'tag_ids',
        'featured',
        'status',
        'protection_password',
        'front_page_blog',
        'user_id'
    ];

    protected $casts = [
        'category_ids' => 'json',
        'tag_ids' => 'json'
    ];

    public function author()
    {
        return $this->belongsTo(User::class);
    }
}
