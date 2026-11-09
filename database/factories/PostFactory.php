<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    // fake published post
    public function definition(): array
    {
        return [
            'author_id'    => Author::factory(),
            'title'        => fake()->sentence(6),
            // only the five categories for this barangay
            'category'     => fake()->randomElement(['Announcement', 'Health',
                                'Peace & Order', 'Ayuda', 'Sports & Youth']),
            'body'         => fake()->paragraphs(3, true),
            'is_published' => true,
            'published_at' => fake()->dateTimeBetween('-3 months', 'now'),
        ];
    }

    // state: a draft has not been published yet
    public function draft(): static
    {
        return $this->state(fn () => ['is_published' => false, 'published_at' => null]);
    }
}
