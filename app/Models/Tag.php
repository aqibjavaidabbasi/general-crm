<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'meta_title', 'meta_description', 'meta_media_id', 'slug', 'published'];

    public function media()
    {
        return $this->belongsTo(Media::class, 'meta_media_id');
    }
}
