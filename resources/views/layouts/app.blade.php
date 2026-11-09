<!DOCTYPE html>
<html lang="en">
<head>
    {{-- text encoding so Filipino characters and the dash show correctly --}}
    <meta charset="utf-8">
    {{-- makes the page fit phone screens --}}
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- each page can set its own title, default is the site title --}}
    <title>@yield('title', 'Barangay Bulletin – Purok Senajon')</title>
    {{-- loads Tailwind css and js through Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
{{-- full-height column: nav on top, content grows, footer at the bottom --}}
<body class="min-h-screen flex flex-col bg-slate-100 text-slate-800">
    {{-- top nav --}}
    <nav class="bg-emerald-700 text-white">
        {{-- centered container that wraps on small screens --}}
        <div class="max-w-5xl mx-auto px-4 py-3 flex flex-wrap items-center justify-between gap-2">
            {{-- site title links back to the list --}}
            <a href="{{ route('posts.index') }}" class="font-bold text-lg">Barangay Bulletin – Purok Senajon</a>
            {{-- small location text --}}
            <span class="text-sm text-emerald-100">Matina Crossing Hall, Davao City</span>
        </div>
    </nav>

    {{-- the page content goes here --}}
    <main class="flex-1 max-w-5xl w-full mx-auto px-4 py-6 lg:py-10">
        {{-- child pages fill this section --}}
        @yield('content')
    </main>

    {{-- footer --}}
    <footer class="bg-slate-800 text-slate-300 text-sm text-center py-4 px-4">
        Barangay Matina Crossing &middot; Davao City
    </footer>
</body>
</html>
