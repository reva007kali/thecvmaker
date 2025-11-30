<div>
    {{-- 1. CTA SECTION (The Prompt) --}}
    <div
        class="mb-10 mt-12 p-6 bg-white border-2 border-black shadow-[8px_8px_0px_0px_#a855f7] relative overflow-hidden">
        {{-- Background Pattern --}}
        <div class="absolute inset-0 opacity-5 pointer-events-none"
            style="background-image: radial-gradient(#a855f7 1px, transparent 1px); background-size: 16px 16px;">
        </div>

        <div class="relative z-10 flex flex-col md:flex-row justify-between items-center gap-6">
            <div class="flex items-start gap-4">
                <div
                    class="w-12 h-12 bg-black text-white flex items-center justify-center border-2 border-black shrink-0">
                    <i data-lucide="bot" class="w-6 h-6"></i>
                </div>
                <div>
                    <h2 class="font-display text-2xl font-bold uppercase tracking-tight">AI CV Reviewer</h2>
                    <p class="font-mono text-sm text-gray-600 mt-1 max-w-md">
                        Scan your data against 1,000+ successful resumes. See what HR really thinks.
                    </p>
                </div>
            </div>

            <button wire:click="analyzeCv" wire:loading.attr="disabled"
                class="group relative px-6 py-3 bg-purple-600 text-white border-2 border-black font-mono font-bold uppercase tracking-wider shadow-[4px_4px_0px_0px_black] transition-all hover:bg-purple-500 hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none disabled:opacity-50 disabled:cursor-not-allowed">

                {{-- Content Normal --}}
                <span wire:loading.remove wire:target="analyzeCv" class="flex items-center gap-2">
                    <i data-lucide="scan-search" class="w-4 h-4"></i>
                    Run Analysis
                </span>

                {{-- Content Loading --}}
                <span wire:loading wire:target="analyzeCv" class="flex items-center gap-2">
                    <i data-lucide="loader-2" class="w-4 h-4 animate-spin"></i>
                    Scanning...
                </span>
            </button>
        </div>
    </div>

    {{-- 2. ANALYSIS RESULT (The Report Card) --}}
    @if ($aiAnalysis)
        <div class="animate-fade-in-up border-2 border-black bg-white shadow-[12px_12px_0px_0px_black] relative mb-12">

            {{-- Decorative Header --}}
            <div class="bg-black text-white px-4 py-2 flex justify-between items-center border-b-2 border-black">
                <span class="font-mono text-xs uppercase">Analysis_Report_v1.0.json</span>
                <div class="flex gap-2">
                    <div class="w-3 h-3 rounded-full bg-red-500 border border-white"></div>
                    <div class="w-3 h-3 rounded-full bg-yellow-500 border border-white"></div>
                    <div class="w-3 h-3 rounded-full bg-green-500 border border-white"></div>
                </div>
            </div>

            <div class="p-8">
                {{-- Top Section: Score & Summary --}}
                <div class="flex flex-col md:flex-row gap-8 mb-8 border-b-2 border-black border-dashed pb-8">

                    {{-- Score Box --}}
                    <div
                        class="shrink-0 flex flex-col items-center justify-center p-6 border-2 border-black w-full md:w-48 text-center
                        {{ $aiAnalysis['score'] >= 80 ? 'bg-green-100' : ($aiAnalysis['score'] >= 50 ? 'bg-yellow-100' : 'bg-red-100') }}">
                        <span class="font-mono text-xs font-bold uppercase mb-2">Overall Score</span>
                        <span class="font-display text-7xl font-bold leading-none tracking-tighter">
                            {{ $aiAnalysis['score'] }}
                        </span>
                        <span class="font-mono text-[10px] uppercase mt-2 px-2 py-1 bg-black text-white">
                            {{ $aiAnalysis['score'] >= 80 ? 'Excellent' : ($aiAnalysis['score'] >= 50 ? 'Average' : 'Critical') }}
                        </span>
                    </div>

                    {{-- Summary Text --}}
                    <div class="flex-1">
                        <h3 class="font-display text-xl font-bold uppercase mb-3 flex items-center gap-2">
                            <i data-lucide="terminal" class="w-5 h-5"></i> Executive Summary
                        </h3>
                        <p class="font-sans text-sm leading-relaxed text-gray-700 border-l-4 border-black pl-4">
                            "{{ $aiAnalysis['summary_feedback'] }}"
                        </p>
                    </div>
                </div>

                {{-- Grid: Strengths vs Weaknesses --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">

                    {{-- Strengths --}}
                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-6 h-6 bg-green-500 border-2 border-black flex items-center justify-center">
                                <i data-lucide="check" class="w-4 h-4 text-white"></i>
                            </div>
                            <h4 class="font-display font-bold uppercase">Strengths</h4>
                        </div>
                        <ul class="space-y-2">
                            @foreach ($aiAnalysis['strengths'] as $strength)
                                <li
                                    class="flex items-start gap-3 text-sm font-medium p-3 bg-green-50 border-2 border-transparent hover:border-green-500 transition-colors">
                                    <span class="text-green-600 font-bold">>>></span>
                                    {{ $strength }}
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- Weaknesses --}}
                    <div>
                        <div class="flex items-center gap-2 mb-4">
                            <div class="w-6 h-6 bg-red-500 border-2 border-black flex items-center justify-center">
                                <i data-lucide="alert-triangle" class="w-4 h-4 text-white"></i>
                            </div>
                            <h4 class="font-display font-bold uppercase">Improvements</h4>
                        </div>
                        <ul class="space-y-2">
                            @foreach ($aiAnalysis['weaknesses'] as $weakness)
                                <li
                                    class="flex items-start gap-3 text-sm font-medium p-3 bg-red-50 border-2 border-transparent hover:border-red-500 transition-colors">
                                    <span class="text-red-600 font-bold">!!!</span>
                                    {{ $weakness }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                {{-- Actionable Suggestions --}}
                <div class="bg-blue-50 border-2 border-black p-6 relative">
                    <div
                        class="absolute -top-3 left-6 bg-black text-white px-3 py-1 font-mono text-xs font-bold uppercase">
                        AI Suggestions
                    </div>
                    <ul class="mt-2 space-y-3">
                        @foreach ($aiAnalysis['suggestions'] as $suggest)
                            <li class="flex items-start gap-3 text-sm text-gray-800">
                                <i data-lucide="arrow-right-circle" class="w-5 h-5 text-blue-600 shrink-0 mt-0.5"></i>
                                <span>{{ $suggest }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
        </div>
    @endif
</div>
