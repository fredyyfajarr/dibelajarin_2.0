<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $course->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-4 gap-6">

            <div class="md:col-span-1">
                <div class="bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg p-4">
                    <h3 class="text-lg font-semibold text-gray-100 mb-4">Daftar Pelajaran</h3>
                    <ul class="space-y-2">
                        @foreach ($allLessons as $item)
                            <li>
                                <a href="{{ route('lessons.show', [$course, $item]) }}"
                                    class="flex justify-between items-center p-3 rounded-md
                                   {{ $item->id == $lesson->id ? 'bg-sky-500 text-white' : 'bg-slate-700 text-gray-300 hover:bg-slate-600' }}">
                                    <span>{{ $loop->iteration }}. {{ $item->title }}</span>
                                    @if (auth()->user()->completedLessons->contains($item))
                                        <span class="text-green-400">✅</span>
                                    @endif
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="md:col-span-3">
                <div class="bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h1 class="text-3xl font-bold text-white mb-4">{{ $lesson->title }}</h1>
                        <div class="prose dark:prose-invert max-w-none">
                            {!! $lesson->content !!}
                        </div>

                        @if ($lesson->quiz)
                            <div class="mt-6">
                                <a href="{{ route('quizzes.show', $lesson) }}"
                                    class="inline-flex items-center gap-2 bg-sky-500 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Kerjakan Kuis
                                </a>
                            </div>
                        @endif

                        @if ($lesson->attachment)
                            <div class="mt-6 pt-6 border-t border-slate-700">
                                <h4 class="text-lg font-semibold text-white mb-2">Materi Tambahan</h4>
                                <a href="{{ asset('storage/' . $lesson->attachment) }}" download
                                    class="inline-flex items-center gap-2 bg-slate-600 hover:bg-slate-500 text-white font-bold py-2 px-4 rounded-lg">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Download Materi
                                </a>
                            </div>
                        @endif

                        <div class="mt-6 pt-6 border-t border-slate-700">
                            @if (auth()->user()->completedLessons->contains($lesson))
                                <div class="text-center bg-green-500 text-white font-bold py-3 px-4 rounded">
                                    Pelajaran Telah Selesai ✅
                                </div>
                            @else
                                <form action="{{ route('lessons.complete', $lesson) }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        class="w-full text-center bg-sky-500 hover:bg-sky-600 text-white font-bold py-3 px-4 rounded">
                                        Tandai Selesai & Lanjutkan
                                    </button>
                                </form>
                            @endif
                        </div>

                        <div class="mt-8 pt-6 border-t border-slate-700">
                            <h3 class="text-xl font-bold text-white mb-4">Diskusi</h3>
                            <div class="mb-6">
                                <form action="{{ route('comments.store', $lesson) }}" method="POST">
                                    @csrf
                                    <textarea name="content" rows="3" placeholder="Tulis pertanyaan atau komentar Anda..."
                                        class="w-full bg-slate-900 border-slate-600 text-white rounded-md focus:ring-sky-500 focus:border-sky-500"></textarea>
                                    <button type="submit"
                                        class="mt-2 bg-sky-500 hover:bg-sky-600 text-white font-bold py-2 px-4 rounded-lg">Kirim</button>
                                </form>
                            </div>

                            <div class="space-y-6">
                                @forelse ($lesson->comments as $comment)
                                    <div x-data="{ openReply: false }">
                                        <div class="flex items-start gap-3">
                                            <div class="flex-shrink-0">
                                                <div
                                                    class="h-10 w-10 bg-slate-600 rounded-full flex items-center justify-center font-bold text-white">
                                                    {{ strtoupper(substr($comment->user->name, 0, 1)) }}</div>
                                            </div>
                                            <div class="flex-1 bg-slate-700 rounded-lg p-3">
                                                <div class="flex items-baseline justify-between">
                                                    <p class="font-semibold text-white">{{ $comment->user->name }}</p>
                                                    <p class="text-xs text-gray-400">
                                                        {{ $comment->created_at->diffForHumans() }}</p>
                                                </div>
                                                <p class="mt-1 text-gray-300">{{ $comment->content }}</p>
                                                <button @click="openReply = !openReply"
                                                    class="mt-2 text-sm text-sky-500 hover:underline">Balas</button>
                                            </div>
                                        </div>

                                        <div x-show="openReply" x-cloak class="ml-8 mt-2">
                                            <form action="{{ route('comments.store', $lesson) }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="parent_id" value="{{ $comment->id }}">
                                                <textarea name="content" rows="2" placeholder="Tulis balasan..."
                                                    class="w-full bg-slate-900 border-slate-600 text-white rounded-md focus:ring-sky-500 focus:border-sky-500 text-sm"></textarea>
                                                <button type="submit"
                                                    class="mt-2 bg-slate-600 hover:bg-slate-500 text-white font-bold py-1 px-3 rounded-lg text-sm">Kirim
                                                    Balasan</button>
                                            </form>
                                        </div>

                                        <div class="ml-8 mt-4 space-y-4 border-l-2 border-slate-700 pl-4">
                                            @foreach ($comment->replies as $reply)
                                                <div class="flex items-start gap-3">
                                                    <div class="flex-shrink-0">
                                                        <div
                                                            class="h-8 w-8 bg-slate-600 rounded-full flex items-center justify-center font-bold text-white text-sm">
                                                            {{ strtoupper(substr($reply->user->name, 0, 1)) }}</div>
                                                    </div>
                                                    <div class="flex-1 bg-slate-900 rounded-lg p-3">
                                                        <div class="flex items-baseline justify-between">
                                                            <p class="font-semibold text-white text-sm">
                                                                {{ $reply->user->name }}</p>
                                                            <p class="text-xs text-gray-400">
                                                                {{ $reply->created_at->diffForHumans() }}</p>
                                                        </div>
                                                        <p class="mt-1 text-gray-300 text-sm">{{ $reply->content }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-gray-400 text-center">Belum ada komentar. Jadilah yang pertama!</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
