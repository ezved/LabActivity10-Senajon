<?php

// seeders live in this namespace
namespace Database\Seeders;

// we read authors and create posts here
use App\Models\Author;
use App\Models\Post;
// base class for all seeders
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    // runs when we call db:seed
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

        // find my Kagawad by his email
        $kagawad = Author::where('email', 'kagawad.senajon@bulletin.test')->first();

        // my pinned post, written by my Kagawad, on my birthday in 2026
        Post::create([
            'author_id'    => $kagawad->id,                        // written by my Kagawad
            'title'        => 'Purok Senajon Clean-up Drive',      // required title
            'category'     => 'Announcement',                      // one of the 5 categories
            // the text of the announcement
            'body'         => "Magtipon po ang lahat ng residente ng Purok Senajon sa Matina Crossing Hall para sa clean-up drive. Magdala ng walis, sako, at guwantes.\n\nMaglilinis tayo ng mga kanal at kalsada para makaiwas sa dengue at baha. Salamat po sa inyong pakikiisa!",
            'is_published' => true,                                // visible to everyone
            'is_pinned'    => true,                                // shows first in the list
            'published_at' => '2026-10-15 08:00:00',               // my birthday in 2026
        ]);
    }
}
