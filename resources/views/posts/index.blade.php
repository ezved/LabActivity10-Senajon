@extends('layouts.app')

@section('title', 'Barangay Bulletin – Purok Senajon')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Latest Announcements</h1>

    {{-- search and category filter (GET so the url can be shared) --}}
    <form method="GET" action="{{ route('posts.index') }}" class="flex flex-col sm:flex-row gap-2 mb-6">
        <input name="q" value="{{ request('q') }}" placeholder="Search title"
               class="flex-1 rounded border border-slate-300 bg-white px-3 py-2">
        <select name="category" class="rounded border border-slate-300 bg-white px-3 py-2">
            <option value="">All categories</option>
            @foreach ($categories as $c)
                <option value="{{ $c }}" @selected(request('category') === $c)>{{ $c }}</option>
            @endforeach
        </select>
        <button class="rounded bg-emerald-700 text-white px-4 py-2 hover:bg-emerald-800">Filter</button>
    </form>

    {{-- card grid: 1 column on phones, 2 on md screens and up --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @forelse ($posts as $post)
            <article class="bg-white rounded-lg shadow p-4 flex flex-col gap-2">
                <div class="flex flex-wrap items-center gap-2 text-xs">
                    {{-- pinned badge only for pinned posts --}}
                    @if ($post->is_pinned)
                        <span class="bg-amber-100 text-amber-800 font-semibold px-2 py-1 rounded">Pinned</span>
                    @endif
                    <span class="bg-emerald-100 text-emerald-800 px-2 py-1 rounded">{{ $post->category }}</span>
                </div>
                <h2 class="text-lg font-semibold">
                    <a href="{{ route('posts.show', $post->id) }}" class="hover:underline">{{ $post->title }}</a>
                </h2>
                <p class="text-sm text-slate-500">
                    {{ $post->published_at->format('M d, Y') }}
                    &middot; Author #{{ $post->author_id }}
                    &middot; {{ $post->views }} views
                </p>
            </article>
        @empty
            <p class="md:col-span-2 text-slate-600">No posts match your search.</p>
        @endforelse
    </div>

    {{-- page links and the showing x-y of z line --}}
    <div class="mt-6">{{ $posts->links() }}</div>
    <p class="mt-2 text-sm text-slate-600">
        Showing {{ $posts->firstItem() }}–{{ $posts->lastItem() }} of {{ $posts->total() }} posts
    </p>
@endsection
