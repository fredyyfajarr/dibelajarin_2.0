<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Katalog Kursus') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Form Pencarian --}}
            <div class="mb-6 bg-slate-800 shadow-sm sm:rounded-lg p-4">
                <form action="{{ route('courses.index') }}" method="GET">
                    <label for="search" class="sr-only">Cari Kursus</label>
                    <div class="flex">
                        <input type="text" name="search" id="search"
                            placeholder="Cari kursus berdasarkan judul..." value="{{ request('search') }}"
                            class="w-full bg-slate-700 border-slate-600 text-white rounded-l-md focus:ring-sky-500 focus:border-sky-500">
                        <button type="submit"
                            class="bg-sky-500 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded-r-md">
                            Cari
                        </button>
                    </div>
                </form>
            </div>

            {{-- Filter Kategori --}}
            <div class="mb-6">
                <div class="flex flex-wrap items-center gap-2">
                    <a href="{{ route('courses.index') }}"
                        class="px-3 py-1 text-sm rounded-full {{ !request('category') ? 'bg-sky-500 text-white' : 'bg-slate-700 text-gray-300' }}">
                        Semua Kategori
                    </a>
                    @foreach ($categories as $category)
                        <a href="{{ route('courses.index', ['category' => $category->slug]) }}"
                            class="px-3 py-1 text-sm rounded-full {{ request('category') == $category->slug ? 'bg-sky-500 text-white' : 'bg-slate-700 text-gray-300' }}">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Daftar Kursus --}}
            <div x-data="{}" x-init="$nextTick(() => {
                document.querySelectorAll('.course-card').forEach((el, i) => {
                    el.style.setProperty('--delay', i * 100 + 'ms');
                });
            })"
                class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($courses as $course)
                    <div class="course-card opacity-0 animate-enter bg-slate-800 rounded-lg shadow-lg overflow-hidden
                                transform hover:-translate-y-2 transition-transform duration-300"
                        style="animation-delay: var(--delay)">

                        {{-- Thumbnail Gambar --}}
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
                                    <a href="{{ route('courses.index', ['category' => $course->category->slug]) }}"
                                        class="inline-block bg-slate-700 text-sky-400 text-xs font-semibold mb-2 px-2.5 py-1 rounded-full">{{ $course->category->name }}</a>
                                @endif
                                <h3 class="text-xl font-bold text-white">{{ $course->title }}</h3>
                                <p class="text-sm text-gray-400 mt-1">
                                    Oleh: <a href="{{ route('instructors.show', $course->instructor) }}"
                                        class="hover:underline">{{ $course->instructor->name }}</a>
                                </p>
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
                    <p class="col-span-full text-center">Tidak ada kursus yang ditemukan.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
