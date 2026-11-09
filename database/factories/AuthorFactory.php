<?php

// factories live in this namespace
namespace Database\Factories;

// base class for all factories
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Author>
 */
class AuthorFactory extends Factory
{
    // fake author data for seeding
    public function definition(): array
    {
        return [
            // random full name
            'name'     => fake()->name(),
            // pick one position from the list
            'position' => fake()->randomElement(['Kagawad', 'Barangay Secretary', 'BHW', 'Tanod']),
            // safeEmail uses example domains, unique() avoids duplicates
            'email'    => fake()->unique()->safeEmail(),
        ];
    }
}
