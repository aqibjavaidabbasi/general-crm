<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'name', 'url', 'type', 'size', 'extension', 'title', 'alt', 'caption', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
