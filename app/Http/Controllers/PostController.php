<?php

// controllers live in this namespace
namespace App\Http\Controllers;

// the Post model so we can query the posts table
use App\Models\Post;
// holds the data from the url (?q= and ?category=)
use Illuminate\Http\Request;

class PostController extends Controller
{
    // "Senajon" has 7 letters, so 7 posts per page
    private const PER_PAGE = 7;

    // list of published posts with search, category filter and pagination
    public function index(Request $request)
    {
        // start a new query on the posts table
        $posts = Post::query()
            // drafts are never shown
            ->where('is_published', true)
            // search by title only when the box is filled
            ->when($request->filled('q'), function ($query) use ($request) {
                // LIKE finds the text anywhere in the title
                $query->where('title', 'like', '%' . $request->q . '%');
            })
            // filter by category only when one is chosen
            ->when($request->filled('category'), function ($query) use ($request) {
                // exact match on the category
                $query->where('category', $request->category);
            })
            ->orderByDesc('is_pinned')   // pinned first
            ->latest('published_at')     // then newest
            ->paginate(self::PER_PAGE)   // 7 posts per page, not get() of everything
            ->withQueryString();         // keeps ?q= and ?category= on page links

        // category choices for the dropdown (published posts only)
        $categories = Post::query()->where('is_published', true)->distinct()
            ->orderBy('category')   // alphabetical
            ->pluck('category');    // just the category column

        // send both to the view
        return view('posts.index', compact('posts', 'categories'));
    }

    // show one post and count the view
    public function show($id)
    {
        // find the post or send a 404 if the id does not exist
        $post = Post::findOrFail($id);

        // drafts are hidden from the public
        abort_unless($post->is_published, 404);

        // add 1 to views and save
        $post->views += 1;
        $post->save();

        // show the single post page
        return view('posts.show', compact('post'));
    }
}
