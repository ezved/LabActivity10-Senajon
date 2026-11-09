<?php

// seeders live in this namespace
namespace Database\Seeders;

// base class for all seeders
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    // authors first, then posts (posts need an existing author)
    public function run(): void
    {
        // call each seeder in this exact order
        $this->call([
            AuthorSeeder::class,  // creates 5 authors
            PostSeeder::class,    // creates 51 posts
        ]);
    }
}
