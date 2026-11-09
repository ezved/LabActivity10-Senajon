<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    // authors first, then posts (posts need an existing author)
    public function run(): void
    {
        $this->call([
            AuthorSeeder::class,
            PostSeeder::class,
        ]);
    }
}
