<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Profil Instruktur: {{ $user->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h3 class="text-3xl font-bold text-white mb-8">Semua Kursus oleh {{ $user->name }}</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse ($courses as $course)
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
                        <p class="col-span-full text-center text-slate-500">Instruktur ini belum memiliki kursus.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
