<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link rel="icon" type="image/svg+xml" href="{{ asset('logo.svg') }}">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-slate-900 text-gray-200">
    <div class="min-h-screen">
        <nav class="bg-slate-800 border-b border-slate-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <a href="/" class="flex-shrink-0 flex items-center">
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-200" />
                        </a>
                    </div>
                    <div class="flex items-center">
                        @if (Route::has('login'))
                            @auth
                                <a href="{{ url('/dashboard') }}"
                                    class="text-sm text-gray-300 hover:text-white underline">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-sm text-gray-300 hover:text-white underline">Log
                                    in</a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}"
                                        class="ml-4 text-sm text-gray-300 hover:text-white underline">Register</a>
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </div>
        </nav>

        <section class="text-center py-20">
            <h1 class="text-5xl font-bold text-white">Mulai Perjalanan Belajar Anda</h1>
            <p class="mt-4 text-lg text-gray-400">Temukan kursus terbaik untuk meningkatkan keahlian Anda.</p>
            <a href="{{ route('courses.index') }}"
                class="mt-8 inline-block bg-sky-500 hover:bg-sky-600 text-white font-bold py-3 px-6 rounded-lg">
                Jelajahi Semua Kursus
            </a>
        </section>

        <section class="pb-20">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-center text-white mb-8">Kursus Terbaru</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse ($latestCourses as $course)
                        <div class="bg-slate-800 rounded-lg shadow-lg overflow-hidden">
                            @if ($course->thumbnail)
                                <img src="{{ asset('storage/' . $course->thumbnail) }}" alt="{{ $course->title }}"
                                    class="h-48 w-full object-cover">
                            @else
                                <div class="h-48 w-full bg-slate-700 flex items-center justify-center"><span
                                        class="text-slate-500">No Image</span></div>
                            @endif
                            <div class="p-5 flex flex-col justify-between flex-grow">
                                <div>
                                    @if ($course->category)
                                        <span
                                            class="inline-block bg-slate-700 text-sky-400 text-xs font-semibold mb-2 px-2.5 py-1 rounded-full">{{ $course->category->name }}</span>
                                    @endif
                                    <h3 class="text-xl font-bold text-white">{{ $course->title }}</h3>
                                    <p class="text-sm text-gray-400 mt-1">Oleh: <a
                                            href="{{ route('instructors.show', $course->instructor) }}"
                                            class="hover:underline">{{ $course->instructor->name }}</a></p>
                                </div>
                                <div class="mt-4">
                                    <a href="{{ route('courses.show', $course) }}"
                                        class="w-full text-center inline-block bg-sky-500 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="col-span-full text-center text-gray-500">Kursus terbaru akan segera hadir.</p>
                    @endforelse
                </div>
            </div>
        </section>
    </div>
</body>

</html>
