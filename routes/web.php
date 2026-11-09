<?php

// the controller that handles the posts pages
use App\Http\Controllers\PostController;
// lets us define routes
use Illuminate\Support\Facades\Route;

// home goes straight to the bulletin list
Route::redirect('/', '/posts');

// list of posts (named so views can use route('posts.index'))
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
// one post by its id
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
