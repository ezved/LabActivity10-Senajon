{{-- use the shared layout --}}
@extends('layouts.app')

{{-- page title is the post title --}}
@section('title', $post->title . ' – Barangay Bulletin – Purok Senajon')

{{-- everything below goes into the layout's content area --}}
@section('content')
    {{-- link back to the list --}}
    <a href="{{ route('posts.index') }}" class="text-sm text-emerald-700 hover:underline">&larr; Back to bulletin</a>

    {{-- the post card, more padding from sm: screens up --}}
    <article class="bg-white rounded-lg shadow p-5 sm:p-8 mt-4">
        {{-- badges row --}}
        <div class="flex flex-wrap items-center gap-2 text-xs mb-3">
            {{-- pinned badge only for pinned posts --}}
            @if ($post->is_pinned)
                <span class="bg-amber-100 text-amber-800 font-semibold px-2 py-1 rounded">Pinned</span>
            @endif
            {{-- category badge --}}
            <span class="bg-emerald-100 text-emerald-800 px-2 py-1 rounded">{{ $post->category }}</span>
        </div>

        {{-- post title --}}
        <h1 class="text-2xl sm:text-3xl font-bold mb-2">{{ $post->title }}</h1>
        {{-- date, author id and the updated view count --}}
        <p class="text-sm text-slate-500 mb-6">
            {{ $post->published_at->format('F d, Y') }}
            &middot; Author #{{ $post->author_id }}
            &middot; {{ $post->views }} views
        </p>

        {{-- keeps line breaks from the body text, still escaped --}}
        <div class="whitespace-pre-line leading-relaxed">{{ $post->body }}</div>
    </article>
@endsection
