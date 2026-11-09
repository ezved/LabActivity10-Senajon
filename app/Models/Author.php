<?php

// this file lives in the App\Models namespace
namespace App\Models;

// lets us use Author::factory() in seeders
use Illuminate\Database\Eloquent\Factories\HasFactory;
// base class that gives us the Eloquent (ActiveRecord) methods
use Illuminate\Database\Eloquent\Model;

// Author maps to the "authors" table automatically
class Author extends Model
{
    // turn on the factory helper
    use HasFactory;

    // columns allowed for create([...]) mass assignment
    protected $fillable = ['name', 'position', 'email'];
}
