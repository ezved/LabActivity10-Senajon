<?php

namespace Database\Factories;

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
            'name'     => fake()->name(),
            'position' => fake()->randomElement(['Kagawad', 'Barangay Secretary', 'BHW', 'Tanod']),
            // safeEmail uses example domains, unique() avoids duplicates
            'email'    => fake()->unique()->safeEmail(),
        ];
    }
}
