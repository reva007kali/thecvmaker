@php
    // Definisi Langkah & Icon SVG
    $steps = [
        1 => [
            'label' => 'Personal Info',
            'icon' => 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z',
        ],
        2 => [
            'label' => 'Education',
            'icon' =>
                'M12 14l9-5-9-5-9 5 9 5z M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z',
        ],
        3 => ['label' => 'Skills', 'icon' => 'M13 10V3L4 14h7v7l9-11h-7z'],
        4 => [
            'label' => 'Achievements',
            'icon' =>
                'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z',
        ],
        5 => [
            'label' => 'Sea Experience',
            'icon' =>
                'M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1',
        ],
        6 => [
            'label' => 'Review & Finish',
            'icon' =>
                'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4',
        ],
    ];

    // Logika Matematika Progress Lingkaran
    $totalSteps = count($steps);
    // Kalkulasi persentase (Step 1 = 0%, Step Terakhir = 100%)
    $percentage = $totalSteps > 1 ? round((($currentStep - 1) / ($totalSteps - 1)) * 100) : 0;

    // Setup SVG Circle (r=28, Keliling ≈ 176)
    $circumference = 176;
    $strokeOffset = $circumference - ($percentage / 100) * $circumference;
@endphp
<div>
    <div class="flex h-screen bg-gray-100 overflow-hidden font-sans">

        {{-- ===================================================
         BAGIAN 1: SIDEBAR NAVIGASI (KIRI)
         Fixed width, visual progress circle, step list.
         =================================================== --}}
        <aside class="hidden md:flex flex-col w-60 bg-white border-r border-gray-200 h-full shadow-sm z-20">

            {{-- Logo Header --}}
            <div class="h-16 flex items-center px-6 border-b border-gray-100 bg-white">
                <span class="text-xl font-bold text-gray-800 tracking-tight flex items-center gap-2">
                    <span class="bg-blue-600 text-white rounded p-1">CV</span> Builder
                </span>
            </div>

            {{-- Progress Circle Area --}}
            <div
                class="flex flex-col items-center justify-center py-6 px-6 bg-gradient-to-b from-white to-gray-50 border-b border-gray-100">
                <div class="relative w-20 h-20 mb-3">
                    {{-- SVG Circle --}}
                    <svg class="w-full h-full transform -rotate-90" viewBox="0 0 66 66">
                        <circle cx="33" cy="33" r="28" fill="none" stroke="#e5e7eb" stroke-width="5" />
                        <circle cx="33" cy="33" r="28" fill="none" stroke="#2563eb" stroke-width="5"
                            stroke-dasharray="{{ $circumference }}" stroke-dashoffset="{{ $strokeOffset }}"
                            stroke-linecap="round" class="transition-all duration-1000 ease-out" />
                    </svg>
                    <div class="absolute inset-0 flex flex-col items-center justify-center">
                        <span class="text-lg font-bold text-gray-800">{{ $percentage }}%</span>
                    </div>
                </div>
                <p class="text-xs text-gray-500 font-medium uppercase tracking-wide">Completion Status</p>
            </div>

            {{-- Navigation Menu (Scrollable) --}}
            <nav class="flex-1 overflow-y-auto p-4 space-y-1">
                @foreach ($steps as $key => $item)
                    <button type="button" wire:click="goToStep({{ $key }})"
                        class="w-full flex items-center gap-3 px-3 py-3 text-sm font-medium rounded-lg transition-all duration-200 group relative
                    {{ $currentStep == $key
                        ? 'bg-blue-50 text-blue-700 shadow-sm ring-1 ring-blue-100'
                        : ($currentStep > $key
                            ? 'text-gray-600 hover:bg-gray-50'
                            : 'text-gray-400 cursor-pointer hover:bg-gray-50') }}">

                        {{-- Icon Indicator --}}
                        <div class="flex-shrink-0 relative">
                            @if ($currentStep > $key)
                                {{-- Selesai (Checkmark Hijau) --}}
                                <div
                                    class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                </div>
                            @elseif ($currentStep == $key)
                                {{-- Aktif (Biru) --}}
                                <div
                                    class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-white shadow-md">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="{{ $item['icon'] }}" />
                                    </svg>
                                </div>
                            @else
                                {{-- Belum (Abu) --}}
                                <div
                                    class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-400 group-hover:bg-gray-200">
                                    <span class="text-xs font-bold">{{ $key }}</span>
                                </div>
                            @endif

                            {{-- Garis konektor vertical (Kecuali item terakhir) --}}
                            @if (!$loop->last)
                                <div class="absolute left-1/2 top-8 w-px h-6 bg-gray-200 -translate-x-1/2 -z-10 mt-1">
                                </div>
                            @endif
                        </div>

                        {{-- Label Text --}}
                        <div class="flex flex-col items-start">
                            <span class="text-sm font-semibold">{{ $item['label'] }}</span>
                            @if ($currentStep == $key)
                                <span class="text-[10px] text-blue-500 font-normal">Editing now...</span>
                            @elseif($currentStep > $key)
                                <span class="text-[10px] text-green-600 font-normal">Completed</span>
                            @endif
                        </div>
                    </button>
                @endforeach
            </nav>

            {{-- Footer Sidebar --}}
            <div class="p-4 border-t border-gray-100 text-center">
                <button type="button"
                    class="text-xs text-gray-400 hover:text-gray-600 transition flex items-center justify-center gap-1 mx-auto">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Dashboard
                </button>
            </div>
        </aside>

        {{-- ===================================================
         BAGIAN 2 & 3: MAIN AREA (FORM & PREVIEW)
         Menggunakan Flex-1 agar mengisi sisa layar.
         Menggunakan Grid untuk membagi Form & Preview.
         =================================================== --}}
        <main class="flex-1 flex flex-col min-w-0 bg-gray-50">

            {{-- MOBILE HEADER (Hanya muncul di HP) --}}
            <div
                class="md:hidden bg-white border-b border-gray-200 px-4 py-3 flex justify-between items-center shadow-sm z-30">
                <span class="font-bold text-gray-800">Step {{ $currentStep }}/{{ $totalSteps }}</span>
                <div class="w-24 bg-gray-200 rounded-full h-2">
                    <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                </div>
            </div>

            {{-- CONTENT GRID --}}
            {{-- Di layar besar (xl): Form ambil 2 kolom, Preview ambil 3 kolom --}}
            <div class="flex-1 grid grid-cols-1 xl:grid-cols-5 h-full overflow-hidden">

                {{-- >>>>> KOLOM TENGAH: FORM INPUT <<<<< --}}
                {{-- overflow-y-auto PENTING agar form bisa discroll independen --}}
                <div class="xl:col-span-2 h-full overflow-y-auto custom-scrollbar bg-white relative flex flex-col">

                    {{-- Notifikasi Toast Success --}}
                    @if (session()->has('status'))
                        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show"
                            x-transition:enter="transition ease-out duration-300 transform"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-300 transform"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 -translate-y-2"
                            class="absolute top-4 left-4 right-4 z-50 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg shadow-lg flex items-center gap-3">
                            <svg class="h-5 w-5 text-green-500" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="flex-1 text-sm font-medium">{{ session('status') }}</span>
                            <button @click="show = false" class="text-green-400 hover:text-green-600"><svg
                                    class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12" />
                                </svg></button>
                        </div>
                    @endif

                    <div class="p-6 md:p-8 pb-20"> <!-- pb-20 untuk memberi ruang di bawah -->

                        {{-- Judul Step Dinamis --}}
                        <div class="mb-6">
                            <h2 class="text-2xl font-bold text-gray-900">{{ $steps[$currentStep]['label'] }}</h2>
                            <p class="text-gray-500 text-sm mt-1">Please fill in the details below.</p>
                        </div>

                        {{-- Form Livewire --}}
                        <form wire:submit.prevent="save">
                            {{-- Include Step Components --}}
                            {{-- Logika @if ini lebih efisien daripada include semua lalu hide --}}

                            <div class="{{ $currentStep == 1 ? 'block' : 'hidden' }}">
                                @include('livewire.form-step.personal-information')
                            </div>
                            <div class="{{ $currentStep == 2 ? 'block' : 'hidden' }}">
                                @include('livewire.form-step.education')
                            </div>
                            <div class="{{ $currentStep == 3 ? 'block' : 'hidden' }}">
                                @include('livewire.form-step.skills')
                            </div>
                            <div class="{{ $currentStep == 4 ? 'block' : 'hidden' }}">
                                @include('livewire.form-step.achievements')
                            </div>
                            <div class="{{ $currentStep == 5 ? 'block' : 'hidden' }}">
                                @include('livewire.form-step.sea-experience')
                            </div>
                            <div class="{{ $currentStep == 6 ? 'block' : 'hidden' }}">
                                @include('livewire.form-step.review')
                            </div>

                            {{-- Tombol Navigasi Bawah Form --}}
                            <div class="mt-8 pt-6 border-t border-gray-100">
                                @include('livewire.form-step.navigation')
                            </div>
                        </form>
                    </div>
                </div>

                {{-- cv preview --}}
                @include('livewire.form-step.cv-preview')

            </div>
        </main>

        {{-- mobile cv preview --}}
        @include('livewire.form-step.mobile-cv-preview')

    </div>
</div>

</div>
