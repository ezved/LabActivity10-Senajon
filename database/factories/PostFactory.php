<?php

// factories live in this namespace
namespace Database\Factories;

// we need Author so a post can create its own author if none is given
use App\Models\Author;
// base class for all factories
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
            // makes a new author unless the seeder passes one in
            'author_id'    => Author::factory(),
            // random sentence of 6 words
            'title'        => fake()->sentence(6),
            // only the five categories for this barangay
            'category'     => fake()->randomElement(['Announcement', 'Health',
                                'Peace & Order', 'Ayuda', 'Sports & Youth']),
            // three random paragraphs as text
            'body'         => fake()->paragraphs(3, true),
            // posts are published by default
            'is_published' => true,
            // random date within the last 3 months
            'published_at' => fake()->dateTimeBetween('-3 months', 'now'),
        ];
    }

    // state: a draft has not been published yet
    public function draft(): static
    {
        // override two fields: not published and no publish date
        return $this->state(fn () => ['is_published' => false, 'published_at' => null]);
    }
}
