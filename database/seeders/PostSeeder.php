<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    public function run(): void
    {
        // authors already exist because AuthorSeeder runs first
        $authors = Author::all();

        // 40 published posts, each given a random existing author
        Post::factory()->count(40)
            ->sequence(fn ($seq) => ['author_id' => $authors->random()->id])
            ->create();

        // 10 drafts (not visible on the public list)
        Post::factory()->count(10)->draft()
            ->sequence(fn ($seq) => ['author_id' => $authors->random()->id])
            ->create();

        // my pinned post, written by my Kagawad, on my birthday in 2026
        $kagawad = Author::where('email', 'kagawad.senajon@bulletin.test')->first();

        Post::create([
            'author_id'    => $kagawad->id,
            'title'        => 'Purok Senajon Clean-up Drive',
            'category'     => 'Announcement',
            'body'         => "Magtipon po ang lahat ng residente ng Purok Senajon sa Matina Crossing Hall para sa clean-up drive. Magdala ng walis, sako, at guwantes.\n\nMaglilinis tayo ng mga kanal at kalsada para makaiwas sa dengue at baha. Salamat po sa inyong pakikiisa!",
            'is_published' => true,
            'is_pinned'    => true,
            'published_at' => '2026-10-15 08:00:00',
        ]);
    }
}
