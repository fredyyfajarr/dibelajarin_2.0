<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $course->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h3 class="text-2xl font-semibold text-white">{{ $course->title }}</h3>
                    <p class="text-sm text-gray-400 mt-1">Oleh: <a
                            href="{{ route('instructors.show', $course->instructor) }}"
                            class="hover:underline">{{ $course->instructor->name }}</a></p>

                    <div class="mt-4 text-gray-300">
                        {!! $course->description !!}
                    </div>

                    <div class="mt-6">
                        @auth
                            @php
                                $isEnrolled = auth()->user()->enrolledCourses->contains($course);
                            @endphp

                            @if ($isEnrolled)
                                @if ($course->lessons->isNotEmpty())
                                    <a href="{{ route('lessons.show', [$course, $course->lessons->first()]) }}"
                                        class="w-full text-center inline-block bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-4 rounded">
                                        Mulai Belajar
                                    </a>
                                @else
                                    <div
                                        class="w-full text-center inline-block bg-slate-500 text-white font-bold py-3 px-4 rounded">
                                        Pelajaran Segera Hadir
                                    </div>
                                @endif
                            @else
                                <form action="{{ route('courses.enroll', $course) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-center inline-block bg-sky-500 hover:bg-sky-600 text-white font-bold py-3 px-4 rounded">
                                        Daftar ke Kursus Ini
                                    </button>
                                </form>
                            @endif
                        @else
                            <a href="{{ route('login') }}"
                                class="w-full text-center inline-block bg-sky-500 hover:bg-sky-600 text-white font-bold py-3 px-4 rounded">
                                Login untuk Mendaftar
                            </a>
                        @endauth
                    </div>

                    <div class="mt-8">
                        <h4 class="text-xl font-semibold text-white mb-4">Materi Pelajaran</h4>
                        <ol class="list-decimal list-inside bg-slate-700 p-4 rounded-lg">
                            @forelse ($course->lessons as $lesson)
                                <li class="py-2 border-b border-slate-600 last:border-b-0">
                                    {{ $lesson->title }}
                                </li>
                            @empty
                                <li class="text-gray-400">Belum ada pelajaran yang ditambahkan.</li>
                            @endforelse
                        </ol>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
