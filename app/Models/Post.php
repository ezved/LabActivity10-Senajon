<?php

// this file lives in the App\Models namespace
namespace App\Models;

// lets us use Post::factory() in seeders
use Illuminate\Database\Eloquent\Factories\HasFactory;
// base class that gives us the Eloquent (ActiveRecord) methods
use Illuminate\Database\Eloquent\Model;

// Post maps to the "posts" table automatically
class Post extends Model
{
    // turn on the factory helper
    use HasFactory;

    // columns allowed for create([...]) mass assignment
    protected $fillable = ['author_id', 'title', 'category', 'body',
                           'is_published', 'is_pinned', 'published_at', 'views'];

    // turn database values into real PHP types
    protected $casts = [
        'is_published' => 'boolean',   // 0/1 becomes false/true
        'is_pinned'    => 'boolean',   // 0/1 becomes false/true
        'published_at' => 'datetime',  // text becomes a Carbon date object
    ];
}
