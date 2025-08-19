<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Kuis: {{ $quiz->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold text-white mb-2">Pelajaran: {{ $lesson->title }}</h3>
                    <p class="text-gray-400 mb-6">Jawablah pertanyaan-pertanyaan di bawah ini.</p>

                    <form action="{{ route('quizzes.submit', $lesson) }}" method="POST">
                        @csrf
                        <div class="space-y-8">
                            @foreach ($quiz->questions as $question)
                                <div class="p-4 bg-slate-700 rounded-lg">
                                    <p class="font-semibold text-lg text-white">
                                        {{ $loop->iteration }}. {{ $question->question_text }}
                                    </p>
                                    <div class="mt-4 space-y-2">
                                        @foreach ($question->options as $key => $option)
                                            <label
                                                class="flex items-center p-3 rounded-md bg-slate-800 hover:bg-slate-600 cursor-pointer">
                                                <input type="radio" name="answers[{{ $question->id }}]"
                                                    value="{{ chr(65 + $key) }}"
                                                    class="text-sky-500 focus:ring-sky-500">
                                                <span class="ms-3 text-white">{{ chr(65 + $key) }}.
                                                    {{ $option['option'] }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-8">
                            <button type="submit"
                                class="w-full text-center bg-sky-500 hover:bg-sky-600 text-white font-bold py-3 px-4 rounded-lg">
                                Kumpulkan Jawaban
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
