{{-- use the shared layout --}}
@extends('layouts.app')

{{-- browser tab title --}}
@section('title', 'Barangay Bulletin – Purok Senajon')

{{-- everything below goes into the layout's content area --}}
@section('content')
    {{-- page heading --}}
    <h1 class="text-2xl font-bold mb-4">Latest Announcements</h1>

    {{-- search and category filter (GET so the url can be shared) --}}
    {{-- stacked on phones, side by side from sm: screens up --}}
    <form method="GET" action="{{ route('posts.index') }}" class="flex flex-col sm:flex-row gap-2 mb-6">
        {{-- search box, keeps what the user typed --}}
        <input name="q" value="{{ request('q') }}" placeholder="Search title"
               class="flex-1 rounded border border-slate-300 bg-white px-3 py-2">
        {{-- category dropdown --}}
        <select name="category" class="rounded border border-slate-300 bg-white px-3 py-2">
            {{-- empty value means no category filter --}}
            <option value="">All categories</option>
            {{-- one option per category from the controller --}}
            @foreach ($categories as $c)
                {{-- keeps the chosen category selected --}}
                <option value="{{ $c }}" @selected(request('category') === $c)>{{ $c }}</option>
            @endforeach
        </select>
        {{-- submit the filter --}}
        <button class="rounded bg-emerald-700 text-white px-4 py-2 hover:bg-emerald-800">Filter</button>
    </form>

    {{-- card grid: 1 column on phones, 2 on md screens and up --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        {{-- loop through the posts on this page --}}
        @forelse ($posts as $post)
            {{-- one card per post --}}
            <article class="bg-white rounded-lg shadow p-4 flex flex-col gap-2">
                {{-- badges row --}}
                <div class="flex flex-wrap items-center gap-2 text-xs">
                    {{-- pinned badge only for pinned posts --}}
                    @if ($post->is_pinned)
                        <span class="bg-amber-100 text-amber-800 font-semibold px-2 py-1 rounded">Pinned</span>
                    @endif
                    {{-- category badge --}}
                    <span class="bg-emerald-100 text-emerald-800 px-2 py-1 rounded">{{ $post->category }}</span>
                </div>
                {{-- title links to the show page --}}
                <h2 class="text-lg font-semibold">
                    <a href="{{ route('posts.show', $post->id) }}" class="hover:underline">{{ $post->title }}</a>
                </h2>
                {{-- date, author id (names need Week 11 relationships) and views --}}
                <p class="text-sm text-slate-500">
                    {{ $post->published_at->format('M d, Y') }}
                    &middot; Author #{{ $post->author_id }}
                    &middot; {{ $post->views }} views
                </p>
            </article>
        {{-- shown when no post matches the search --}}
        @empty
            <p class="md:col-span-2 text-slate-600">No posts match your search.</p>
        @endforelse
    </div>

    {{-- page links (Previous / Next / numbers) --}}
    <div class="mt-6">{{ $posts->links() }}</div>
    {{-- shows which posts are on this page and the total --}}
    <p class="mt-2 text-sm text-slate-600">
        Showing {{ $posts->firstItem() }}–{{ $posts->lastItem() }} of {{ $posts->total() }} posts
    </p>
@endsection
