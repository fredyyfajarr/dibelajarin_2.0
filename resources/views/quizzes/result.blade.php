<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Hasil Kuis
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 text-center">
            <div class="bg-slate-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 md:p-8 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold text-white mb-2">Skor Anda</h3>
                    <p class="text-6xl font-bold text-sky-500 my-4">
                        {{ $attempt->score }} <span class="text-3xl text-gray-400">/
                            {{ $attempt->total_questions }}</span>
                    </p>
                    <p class="text-lg text-gray-300">Anda berhasil menjawab benar {{ $attempt->score }} dari
                        {{ $attempt->total_questions }} pertanyaan.</p>
                    <div class="mt-8">
                        <a href="{{ route('dashboard') }}"
                            class="inline-block bg-sky-500 hover:bg-sky-600 text-white font-bold py-3 px-6 rounded-lg">
                            Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
