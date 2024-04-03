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
        'featured',
        'status',
        'protection_password',
        'front_page_blog',
        'user_id',
        'blog_media_id',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function media()
    {
        return $this->belongsTo(Media::class, 'blog_media_id');
    }

}
