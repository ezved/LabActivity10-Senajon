<?php

// seeders live in this namespace
namespace Database\Seeders;

// we create Author rows here
use App\Models\Author;
// base class for all seeders
use Illuminate\Database\Seeder;

class AuthorSeeder extends Seeder
{
    // runs when we call db:seed
    public function run(): void
    {
        // my own Kagawad, made by hand (not by the factory)
        Author::create([
            'name'     => 'Kagawad Lourrence Ed Senajon',   // full display name
            'position' => 'Kagawad',                        // official position
            'email'    => 'kagawad.senajon@bulletin.test',  // unique email
        ]);

        // four more random officials from the factory
        Author::factory()->count(4)->create();
    }
}
