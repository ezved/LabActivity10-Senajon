<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // "Senajon" has 7 letters, so 7 posts per page
    private const PER_PAGE = 7;

    // list of published posts with search, category filter and pagination
    public function index(Request $request)
    {
        $posts = Post::query()
            ->where('is_published', true)
            // search by title only when the box is filled
            ->when($request->filled('q'), function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->q . '%');
            })
            // filter by category only when one is chosen
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->where('category', $request->category);
            })
            ->orderByDesc('is_pinned')   // pinned first
            ->latest('published_at')     // then newest
            ->paginate(self::PER_PAGE)
            ->withQueryString();         // keeps ?q= and ?category= on page links

        // category choices for the dropdown (published posts only)
        $categories = Post::query()->where('is_published', true)->distinct()->orderBy('category')->pluck('category');

        return view('posts.index', compact('posts', 'categories'));
    }

    // show one post and count the view
    public function show($id)
    {
        $post = Post::findOrFail($id);

        // drafts are hidden from the public
        abort_unless($post->is_published, 404);

        // add 1 to views and save
        $post->views += 1;
        $post->save();

        return view('posts.show', compact('post'));
    }
}
