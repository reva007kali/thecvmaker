<div x-data="{
    sidebarOpen: window.innerWidth >= 1024,
    mobileMenu: false,
    toggleSidebar() { this.sidebarOpen = !this.sidebarOpen }
}" {{-- PERBAIKAN 1: Gunakan h-[100dvh] untuk mobile agar pas dengan address bar browser --}}
    class="h-[100dvh] w-full bg-swiss-white font-sans overflow-hidden flex flex-col md:flex-row text-black">

    {{-- ===================================================
     1. SIDEBAR (Desktop Only)
     =================================================== --}}
    <aside :class="sidebarOpen ? 'w-52' : 'w-16'"
        class="hidden md:flex flex-col bg-white border-r-2 border-black transition-all duration-300 ease-[cubic-bezier(0.25,1,0.5,1)] z-30 relative shadow-[4px_0px_0px_0px_rgba(0,0,0,0.1)] h-full">

        {{-- Toggle Button --}}
        <button @click="toggleSidebar()"
            class="absolute -right-3 top-20 w-6 h-6 bg-white border-2 border-black rounded-full flex items-center justify-center hover:bg-black hover:text-white transition-colors z-50">
            <i data-lucide="chevron-left" class="w-3 h-3 transition-transform duration-300"
                :class="!sidebarOpen && 'rotate-180'"></i>
        </button>

        {{-- Logo Header --}}
        <div
            class="h-20 border-b-2 border-black flex items-center justify-center bg-accent-lime/20 overflow-hidden flex-shrink-0">
            <a href="/dashboard" wire:navigate class="flex items-center gap-2 group">
                <div
                    class="w-10 h-10 bg-black text-white flex items-center justify-center font-display font-bold text-xl group-hover:rotate-12 transition-transform">
                    CV
                </div>
                <span x-show="sidebarOpen" x-transition.opacity.duration.200ms
                    class="font-display font-bold text-xl tracking-tight whitespace-nowrap">
                    Maker.
                </span>
            </a>
        </div>

        {{-- Progress Indicator --}}
        <div class="p-6 border-b-2 border-black flex-shrink-0" :class="!sidebarOpen && 'px-2'">
            <div x-show="sidebarOpen" class="flex justify-between items-end mb-2">
                <span class="font-mono text-xs font-bold uppercase text-gray-500">Progress</span>
                <span class="font-display text-2xl font-bold">{{ $percentage }}%</span>
            </div>
            <div class="h-4 w-full bg-gray-100 border-2 border-black p-[2px]">
                <div class="h-full bg-black transition-all duration-500 relative group"
                    style="width: {{ $percentage }}%">
                    <div x-show="!sidebarOpen"
                        class="hidden group-hover:block absolute left-full ml-4 top-1/2 -translate-y-1/2 bg-black text-white text-xs px-2 py-1 whitespace-nowrap z-50">
                        {{ $percentage }}%
                    </div>
                </div>
            </div>
        </div>

        {{-- Navigation Steps --}}
        <nav class="flex-1 overflow-y-auto custom-scrollbar p-0">
            @foreach ($steps as $key => $item)
                <button type="button" wire:click="goToStep({{ $key }})"
                    class="w-full flex items-center gap-4 px-6 py-5 border-b border-gray-200 transition-all duration-200 group relative text-left outline-none
                    {{ $currentStep == $key ? 'bg-black text-white' : 'text-black hover:bg-accent-blue/10 focus:bg-gray-50' }}"
                    :class="!sidebarOpen && 'justify-center px-0'">

                    @if ($currentStep == $key)
                        <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-accent-blue"></div>
                    @elseif ($currentStep > $key)
                        <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-green-500"></div>
                    @endif

                    <div class="flex-shrink-0">
                        @if ($currentStep > $key)
                            <i data-lucide="check" class="w-5 h-5 text-green-500"></i>
                        @else
                            {{-- PERBAIKAN: Pastikan class text-inherit agar warna icon mengikuti text parent --}}
                            <i data-lucide="{{ $item['icon'] }}"
                                class="w-5 h-5 transition-transform group-hover:scale-110 text-inherit"></i>
                        @endif
                    </div>

                    <div x-show="sidebarOpen" class="flex flex-col overflow-hidden">
                        <span
                            class="font-display font-bold text-sm uppercase tracking-wide leading-none">{{ $item['label'] }}</span>
                        <span class="font-mono text-[10px] mt-1 opacity-70">
                            {{ $currentStep == $key ? 'Editing...' : ($currentStep > $key ? 'Done' : 'Pending') }}
                        </span>
                    </div>
                </button>
            @endforeach
        </nav>

        {{-- Footer --}}
        <div class="p-4 border-t-2 border-black bg-gray-50 text-center flex-shrink-0">
            <a href="/dashboard" wire:navigate
                class="inline-flex items-center justify-center w-full py-2 hover:bg-black hover:text-white border border-transparent hover:border-black transition-all rounded text-xs font-bold font-mono uppercase">
                <i data-lucide="arrow-left" class="w-3 h-3 mr-2"></i>
                <span x-show="sidebarOpen">Exit</span>
            </a>
        </div>
    </aside>

    {{-- ===================================================
     2. MOBILE HEADER & MENU
     =================================================== --}}
    <div
        class="md:hidden h-16 bg-white border-b-2 border-black flex items-center justify-between px-4 z-50 flex-shrink-0">
        <div class="flex items-center gap-2">
            <div class="w-8 h-8 bg-black text-white flex items-center justify-center font-bold">
                {{ $currentStep }}
            </div>
            <span class="font-display font-bold uppercase">{{ $steps[$currentStep]['label'] }}</span>
        </div>
        <button @click="mobileMenu = !mobileMenu"
            class="p-2 border-2 border-black hover:bg-black hover:text-white transition-colors">
            <i data-lucide="menu"></i>
        </button>
    </div>

    {{-- Mobile Dropdown --}}
    <div x-show="mobileMenu" x-collapse
        class="md:hidden bg-gray-100 border-b-2 border-black absolute top-16 left-0 w-full z-40 shadow-xl">
        <div class="p-4 grid grid-cols-2 gap-2 max-h-[60vh] overflow-y-auto">
            @foreach ($steps as $key => $item)
                <button wire:click="goToStep({{ $key }}); mobileMenu = false"
                    class="text-left px-3 py-2 text-sm font-bold border flex items-center gap-2
                    {{ $currentStep == $key ? 'bg-black text-white border-black' : 'bg-white border-gray-300' }}">
                    <span>{{ $loop->iteration }}.</span>
                    <span>{{ $item['label'] }}</span>
                </button>
            @endforeach
        </div>
    </div>

    {{-- ===================================================
     3. MAIN CONTENT (Scroll Fix Applied)
     =================================================== --}}
    {{-- PERBAIKAN 2: Gunakan min-h-0 pada parent flex agar child scroll berfungsi --}}
    <main class="flex-1 flex flex-col min-w-0 min-h-0 bg-white relative">
        <div class="flex-1 grid grid-cols-1 xl:grid-cols-12 h-full overflow-hidden">

            {{-- FORM AREA --}}
            {{-- PERBAIKAN 3: overflow-y-auto di sini menangani scroll form. 
                 pb-safe ensure bottom padding di iPhone --}}
            <div class="xl:col-span-5 h-full overflow-y-auto custom-scrollbar relative flex flex-col bg-white">

                {{-- Sticky Header Form --}}
                <div
                    class="sticky top-0 z-20 bg-white/95 backdrop-blur border-b border-black px-6 py-4 flex justify-between items-center shadow-sm">
                    <h2 class="font-display text-2xl md:text-3xl font-bold uppercase tracking-tighter leading-none">
                        <span class="text-transparent" style="-webkit-text-stroke: 1px black;">Step
                            0{{ $currentStep }}.</span><br>
                        {{ $steps[$currentStep]['label'] }}
                    </h2>
                    <div class="hidden sm:block">
                        <span
                            class="font-mono text-[10px] bg-accent-lime px-2 py-1 border border-black shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]">
                            Auto-saving...
                        </span>
                    </div>
                </div>

                <div class="p-6 md:p-8 pb-32">
                    <div class="max-w-2xl mx-auto space-y-8">
                        @if (session()->has('status'))
                            <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show"
                                class="mb-6 bg-green-100 border-2 border-black p-4 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] flex items-center gap-3">
                                <i data-lucide="check-circle" class="text-green-600 w-5 h-5"></i>
                                <span class="font-bold font-mono text-sm">{{ session('status') }}</span>
                            </div>
                        @endif

                        <form wire:submit.prevent="save">
                            <div class="space-y-6">
                                {{-- Render Steps --}}
                                @if ($currentStep === 1)
                                    @include('livewire.form-step.personal-information')
                                @endif
                                @if ($currentStep === 2)
                                    @include('livewire.form-step.education')
                                @endif
                                @if ($currentStep === 3)
                                    @include('livewire.form-step.skills')
                                @endif
                                @if ($currentStep === 4)
                                    @include('livewire.form-step.achievements')
                                @endif
                                @if ($currentStep === 5)
                                    @include('livewire.form-step.sea-experience')
                                @endif
                                @if ($currentStep === 6)
                                    @include('livewire.form-step.review')
                                @endif
                            </div>

                            <div class="mt-12 pt-8 border-t-2 border-black border-dashed">
                                @include('livewire.form-step.navigation')
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- PREVIEW AREA (Hidden on Mobile) --}}
            <div class="hidden xl:block xl:col-span-7 bg-gray-50 border-l-2 border-black relative overflow-hidden h-full flex flex-col"
                style="background-image: radial-gradient(#cbd5e1 1px, transparent 1px); background-size: 20px 20px;">
                <div class="h-16 border-b border-black bg-white flex justify-between items-center px-6 flex-shrink-0">
                    <div class="flex items-center gap-4">
                        <span class="font-mono text-xs font-bold uppercase text-gray-400">Preview Mode</span>
                        <div class="flex gap-2">
                            <div class="w-3 h-3 rounded-full bg-red-500 border border-black"></div>
                            <div class="w-3 h-3 rounded-full bg-yellow-500 border border-black"></div>
                            <div class="w-3 h-3 rounded-full bg-green-500 border border-black"></div>
                        </div>
                    </div>

                </div>
                <div class="flex-1 overflow-y-auto custom-scrollbar flex justify-center items-start">
                    <div
                        class="bg-white shadow-[10px_10px_0px_0px_rgba(0,0,0,0.2)] border border-gray-300 min-h-[297mm] w-[210mm] transform scale-90 origin-top">
                        @include('livewire.form-step.cv-preview')
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('livewire.form-step.mobile-cv-preview')
</div>

{{-- SCRIPT PENTING UNTUK REFRESH ICON LUCIDE --}}
<script>
    function initLucide() {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    }

    // Load awal
    document.addEventListener('DOMContentLoaded', initLucide);
    // Load saat navigasi SPA Livewire (wire:navigate)
    document.addEventListener('livewire:navigated', initLucide);
    // Load saat DOM diupdate oleh Livewire (wire:click)
    document.addEventListener('livewire:init', () => {
        Livewire.hook('morph.updated', ({
            el,
            component
        }) => {
            initLucide();
        });
    });
</script>
<script>
(function () {
  const SCROLL_HIDE_DELAY = 900; // ms sebelum thumb nge-fade out
  const elems = document.querySelectorAll('.custom-scrollbar');

  elems.forEach(el => {
    let timer = null;

    // helper: set class .scrolling dan CSS var
    const show = () => {
      el.classList.add('scrolling');
      el.style.setProperty('--thumb-opacity', '1');
      // clear pending hide
      if (timer) { clearTimeout(timer); timer = null; }
    };

    const hide = () => {
      // sedikit delay supaya terasa halus
      if (timer) clearTimeout(timer);
      timer = setTimeout(() => {
        el.classList.remove('scrolling');
        el.style.setProperty('--thumb-opacity', '0');
      }, SCROLL_HIDE_DELAY);
    };

    // events: user scrolls
    el.addEventListener('scroll', () => {
      show();
      hide();
    }, { passive: true });

    // events: kursor masuk / keluar (agar thumb muncul saat hover)
    el.addEventListener('mouseenter', () => {
      el.style.setProperty('--thumb-opacity', '1');
    });
    el.addEventListener('mouseleave', () => {
      // kalau sedang scrolling, biarkan JS yang hide
      if (!el.matches(':hover')) hide();
      else hide();
    });

    // inisialisasi: sembunyikan thumb kecuali saat hover
    el.style.setProperty('--thumb-opacity', '0');
  });
})();
</script>

