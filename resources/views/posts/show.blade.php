@extends('layouts.app')

{{-- page title is the post title --}}
@section('title', $post->title . ' – Barangay Bulletin – Purok Senajon')

@section('content')
    <a href="{{ route('posts.index') }}" class="text-sm text-emerald-700 hover:underline">&larr; Back to bulletin</a>

    <article class="bg-white rounded-lg shadow p-5 sm:p-8 mt-4">
        <div class="flex flex-wrap items-center gap-2 text-xs mb-3">
            @if ($post->is_pinned)
                <span class="bg-amber-100 text-amber-800 font-semibold px-2 py-1 rounded">Pinned</span>
            @endif
            <span class="bg-emerald-100 text-emerald-800 px-2 py-1 rounded">{{ $post->category }}</span>
        </div>

        <h1 class="text-2xl sm:text-3xl font-bold mb-2">{{ $post->title }}</h1>
        <p class="text-sm text-slate-500 mb-6">
            {{ $post->published_at->format('F d, Y') }}
            &middot; Author #{{ $post->author_id }}
            &middot; {{ $post->views }} views
        </p>

        {{-- keeps line breaks from the body text, still escaped --}}
        <div class="whitespace-pre-line leading-relaxed">{{ $post->body }}</div>
    </article>
@endsection
