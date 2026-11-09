<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

// home goes straight to the bulletin list
Route::redirect('/', '/posts');

// list of posts and a single post
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
