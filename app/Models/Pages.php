<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'user_id',
        'parent_page',
        'page_title',
        'page_description',
        'content',
        'meta_title',
        'meta_description',
        'togle_status',
        'featured_image_id',
        'published_status',
        'make_homepage',
        'visibility',
        'published_date_time',
        'status',
    ];
    protected $casts = [
    'published_date_time' => 'datetime',
    ];
  public function media()
  {
  return $this->belongsTo(Media::class, 'featured_image_id', 'id');
  }
}
