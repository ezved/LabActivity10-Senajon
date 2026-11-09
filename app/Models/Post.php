<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // columns allowed for create([...]) mass assignment
    protected $fillable = ['author_id', 'title', 'category', 'body',
                           'is_published', 'is_pinned', 'published_at', 'views'];

    // turn database values into real PHP types
    protected $casts = [
        'is_published' => 'boolean',
        'is_pinned'    => 'boolean',
        'published_at' => 'datetime',
    ];
}
