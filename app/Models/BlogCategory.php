<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'parent_id', 'description', 'meta_title', 'meta_description', 'meta_media_id', 'position', 'status', 'featured', 'slug'];

    public function parentCategory()
    {
        return $this->belongsTo(BlogCategory::class, 'parent_id');
    }

    public function getParentCategoryNameAttribute()
    {
        if ($this->parentCategory) {
            return $this->parentCategory->name;
        } else {
            return '-';
        }
    }

    public function media()
    {
        return $this->belongsTo(Media::class, 'meta_media_id', 'id');
    }

}
