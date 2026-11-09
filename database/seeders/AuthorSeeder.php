<?php

namespace Database\Seeders;

use App\Models\Author;
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    public function run(): void
    {
        // my own Kagawad, made by hand (not by the factory)
        Author::create([
            'name'     => 'Kagawad Lourrence Ed Senajon',
            'position' => 'Kagawad',
            'email'    => 'kagawad.senajon@bulletin.test',
        ]);

        // four more random officials from the factory
        Author::factory()->count(4)->create();
    }
}
