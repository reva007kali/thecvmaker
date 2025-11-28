<div>
    <div class="mb-6 mt-10 p-4 bg-gradient-to-r from-purple-600 to-indigo-600 rounded-xl text-white shadow-lg">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="text-xl font-bold">AI CV Reviewer 🤖</h2>
                <p class="text-sm opacity-90">Cek seberapa kuat CV kamu di mata HRD.</p>
            </div>

            <button wire:click="analyzeCv" wire:loading.attr="disabled"
                class="bg-white text-indigo-700 font-bold py-2 px-6 rounded-full hover:bg-gray-100 transition flex items-center gap-2 disabled:opacity-50">

                <span wire:loading wire:target="analyzeCv">
                    <svg class="animate-spin h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z">
                        </path>
                    </svg>
                    Analysing...
                </span>

                <span wire:loading.remove wire:target="analyzeCv">
                    Review My CV
                </span>
            </button>
        </div>
    </div>

    @if ($aiAnalysis)
        <div class="bg-white border border-gray-200 rounded-xl shadow-lg p-6 mb-8 animate-fade-in-up">

            <div class="flex items-center gap-6 mb-6">
                <div
                    class="relative w-24 h-24 flex items-center justify-center bg-gray-100 rounded-full border-4 
            {{ $aiAnalysis['score'] >= 80 ? 'border-green-500 text-green-600' : ($aiAnalysis['score'] >= 50 ? 'border-yellow-500 text-yellow-600' : 'border-red-500 text-red-600') }}">
                    <span class="text-3xl font-bold">{{ $aiAnalysis['score'] }}</span>
                </div>
                <div>
                    <h3 class="text-lg font-bold text-gray-800">Hasil Analisa AI</h3>
                    <p class="text-gray-600">{{ $aiAnalysis['summary_feedback'] }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-green-50 p-4 rounded-lg">
                    <h4 class="font-bold text-green-800 mb-2 flex items-center gap-2">
                        ✅ Kekuatan (Strengths)
                    </h4>
                    <ul class="list-disc list-inside text-sm text-gray-700 space-y-1">
                        @foreach ($aiAnalysis['strengths'] as $strength)
                            <li>{{ $strength }}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="bg-red-50 p-4 rounded-lg">
                    <h4 class="font-bold text-red-800 mb-2 flex items-center gap-2">
                        ⚠️ Perlu Perbaikan (Weaknesses)
                    </h4>
                    <ul class="list-disc list-inside text-sm text-gray-700 space-y-1">
                        @foreach ($aiAnalysis['weaknesses'] as $weakness)
                            <li>{{ $weakness }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="mt-6 bg-blue-50 p-4 rounded-lg border border-blue-100">
                <h4 class="font-bold text-blue-800 mb-2">💡 Saran AI (Actionable Items)</h4>
                <ul class="space-y-2">
                    @foreach ($aiAnalysis['suggestions'] as $suggest)
                        <li class="flex items-start gap-2 text-sm text-gray-700">
                            <span class="text-blue-500 font-bold">→</span> {{ $suggest }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
</div>
