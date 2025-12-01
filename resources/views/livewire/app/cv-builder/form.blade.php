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
                                @if ($currentStep == 1)
                                    <div class="animate-fade-in-up space-y-12">

                                        <!-- HEADER SECTION -->
                                        <div
                                            class="border-b-2 border-black pb-6 flex flex-col md:flex-row md:items-end justify-between gap-4">
                                            <div>
                                                <h3
                                                    class="font-display text-4xl font-bold uppercase tracking-tighter text-black leading-none">
                                                    Personal Info
                                                </h3>
                                                <p
                                                    class="font-mono text-sm text-gray-500 mt-2 bg-yellow-300 inline-block px-2 border border-black shadow-[2px_2px_0px_0px_black]">
                                                    Step 01: The Basics
                                                </p>
                                            </div>
                                            <div class="text-right hidden md:block">
                                                <p class="text-xs font-mono text-gray-400">Please ensure data accuracy.
                                                </p>
                                                <p class="text-xs font-mono text-gray-400">Mistakes = Rejection.</p>
                                            </div>
                                        </div>

                                        <!-- 1. VISUAL TEMPLATE SELECTOR -->
                                        <div>
                                            <label class="block font-display font-bold text-lg mb-4 uppercase">Select
                                                Style</label>
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                <!-- Simple Template Card -->
                                                <label class="cursor-pointer group relative">
                                                    <input type="radio" wire:model="template_id" value="1"
                                                        class="peer sr-only">
                                                    <div
                                                        class="p-5 border-2 border-black bg-white transition-all duration-200 
                                hover:-translate-y-1 hover:shadow-[6px_6px_0px_0px_black]
                                peer-checked:bg-black peer-checked:text-white peer-checked:shadow-[6px_6px_0px_0px_#d9f99d]">
                                                        <div class="flex items-center gap-4">
                                                            <div
                                                                class="w-12 h-12 border-2 border-black bg-gray-100 flex items-center justify-center peer-checked:bg-white peer-checked:text-black">
                                                                <i data-lucide="layout" class="w-6 h-6"></i>
                                                            </div>
                                                            <div>
                                                                <h4 class="font-bold font-display text-xl uppercase">
                                                                    Swiss Clean</h4>
                                                                <p class="text-xs font-mono opacity-70">Minimalist &
                                                                    Formal</p>
                                                            </div>
                                                            <div
                                                                class="ml-auto opacity-0 peer-checked:opacity-100 transition-opacity">
                                                                <i data-lucide="check-circle"
                                                                    class="w-6 h-6 text-accent-lime"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </label>

                                                <!-- Modern Template Card -->
                                                <label class="cursor-pointer group relative">
                                                    <input type="radio" wire:model="template_id"
                                                        value="2" class="peer sr-only">
                                                    <div
                                                        class="p-5 border-2 border-black bg-white transition-all duration-200 
                                hover:-translate-y-1 hover:shadow-[6px_6px_0px_0px_black]
                                peer-checked:bg-accent-blue peer-checked:text-white peer-checked:shadow-[6px_6px_0px_0px_black]">
                                                        <div class="flex items-center gap-4">
                                                            <div
                                                                class="w-12 h-12 border-2 border-black bg-blue-100 flex items-center justify-center peer-checked:bg-white peer-checked:text-blue-600">
                                                                <i data-lucide="layers" class="w-6 h-6"></i>
                                                            </div>
                                                            <div>
                                                                <h4 class="font-bold font-display text-xl uppercase">
                                                                    Neo Pop</h4>
                                                                <p class="text-xs font-mono opacity-70">Bold & Creative
                                                                </p>
                                                            </div>
                                                            <div
                                                                class="ml-auto opacity-0 peer-checked:opacity-100 transition-opacity">
                                                                <i data-lucide="check-circle"
                                                                    class="w-6 h-6 text-white"></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>
                                        </div>

                                        <!-- 2. PHOTO & BASIC INFO -->
                                        <div class="flex flex-col md:flex-row gap-8">
                                            <!-- Photo Uploader (Brutalist Style) -->
                                            <div class="shrink-0">
                                                <label class="block font-mono font-bold text-xs uppercase mb-2">Profile
                                                    Picture</label>
                                                <div class="relative group cursor-pointer w-40 h-40">
                                                    <div
                                                        class="w-full h-full border-2 border-black bg-gray-100 relative overflow-hidden shadow-[4px_4px_0px_0px_black]">
                                                        @if ($cv_photo)
                                                            <img src="{{ $cv_photo->temporaryUrl() }}"
                                                                class="w-full h-full object-cover">
                                                        @elseif($existingPhoto)
                                                            <img src="{{ Storage::url($existingPhoto) }}"
                                                                class="w-full h-full object-cover">
                                                        @else
                                                            <div
                                                                class="w-full h-full flex flex-col items-center justify-center text-gray-400 gap-2 bg-white">
                                                                <i data-lucide="camera" class="w-8 h-8"></i>
                                                                <span
                                                                    class="text-[10px] font-mono uppercase text-center px-2">Upload<br>Photo</span>
                                                            </div>
                                                        @endif

                                                        <!-- Hover Overlay -->
                                                        <div
                                                            class="absolute inset-0 bg-black/80 hidden group-hover:flex flex-col items-center justify-center transition-all text-white gap-2">
                                                            <i data-lucide="upload-cloud" class="w-8 h-8"></i>
                                                            <span class="font-mono text-xs uppercase">Change</span>
                                                        </div>
                                                    </div>

                                                    <input type="file" wire:model="cv_photo" accept="image/*"
                                                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">

                                                    <!-- Loading State -->
                                                    <div wire:loading wire:target="cv_photo"
                                                        class="absolute inset-0 flex items-center justify-center bg-white border-2 border-black z-20">
                                                        <i data-lucide="loader-2"
                                                            class="animate-spin w-8 h-8 text-black"></i>
                                                    </div>
                                                </div>
                                                @error('cv_photo')
                                                    <span
                                                        class="text-red-600 font-bold text-xs mt-2 block bg-red-100 p-1 border border-red-500">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <!-- Inputs -->
                                            <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-6">
                                                <!-- Job Title -->
                                                <div class="col-span-1 md:col-span-2">
                                                    <label
                                                        class="block font-mono font-bold text-xs uppercase mb-2">Target
                                                        Role / Job Title</label>
                                                    <input type="text" wire:model="job_title"
                                                        placeholder="E.g. Senior Product Designer"
                                                        class="w-full bg-white border-2 border-black p-3 font-bold placeholder:font-normal placeholder:text-gray-400 focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                                </div>

                                                <!-- First Name -->
                                                <div>
                                                    <label
                                                        class="block font-mono font-bold text-xs uppercase mb-2">First
                                                        Name <span class="text-red-500">*</span></label>
                                                    <input type="text" wire:model="first_name"
                                                        placeholder="John"
                                                        class="w-full bg-white border-2 border-black p-3 font-bold focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow @error('first_name') border-red-500 bg-red-50 @enderror">
                                                    @error('first_name')
                                                        <span
                                                            class="text-red-600 text-xs font-bold mt-1 block">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <!-- Last Name -->
                                                <div>
                                                    <label
                                                        class="block font-mono font-bold text-xs uppercase mb-2">Last
                                                        Name</label>
                                                    <input type="text" wire:model="last_name"
                                                        placeholder="Doe"
                                                        class="w-full bg-white border-2 border-black p-3 font-bold focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                                </div>

                                                <!-- Address -->
                                                <div class="col-span-1 md:col-span-2">
                                                    <label
                                                        class="block font-mono font-bold text-xs uppercase mb-2">Domicile
                                                        Address</label>
                                                    <div class="relative">
                                                        <div class="absolute top-3 left-3 pointer-events-none">
                                                            <i data-lucide="map-pin"
                                                                class="w-5 h-5 text-gray-400"></i>
                                                        </div>
                                                        <input type="text" wire:model="address"
                                                            placeholder="Jalan Jenderal Sudirman No. 1, Jakarta"
                                                            class="w-full bg-white border-2 border-black p-3 pl-10 font-medium focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- 3. CONTACT & DEMOGRAPHICS (Card Style) -->
                                        <div class="border-2 border-black p-6 bg-gray-50 relative">
                                            <div
                                                class="absolute -top-3 left-4 bg-black text-white px-2 py-1 text-xs font-mono font-bold uppercase">
                                                Contact & Details
                                            </div>

                                            <div class=" space-y-6 mt-2">
                                                <!-- Email -->
                                                <div>
                                                    <label
                                                        class="block font-mono font-bold text-xs uppercase mb-2">Email
                                                        <span class="text-red-500">*</span></label>
                                                    <input type="email" wire:model="email"
                                                        placeholder="you@example.com"
                                                        class="w-full bg-white border-2 border-black p-3 font-medium focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow @error('email') border-red-500 @enderror">
                                                    @error('email')
                                                        <span
                                                            class="text-red-600 text-xs font-bold mt-1 block">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <!-- Phone -->
                                                <div>
                                                    <label
                                                        class="block font-mono font-bold text-xs uppercase mb-2">Phone
                                                        <span class="text-red-500">*</span></label>
                                                    <input type="text" wire:model="phone"
                                                        placeholder="0812..."
                                                        class="w-full bg-white border-2 border-black p-3 font-medium focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow @error('phone') border-red-500 @enderror">
                                                    @error('phone')
                                                        <span
                                                            class="text-red-600 text-xs font-bold mt-1 block">{{ $message }}</span>
                                                    @enderror
                                                </div>

                                                <!-- Birthdate -->
                                                <div class="col-span-2 md:col-span-1">
                                                    {{-- Pastikan component x-date-selector juga menyesuaikan style jika bisa, atau bungkus div ini --}}
                                                    <div
                                                        class="[&_input]:border-2 [&_input]:border-black [&_input]:rounded-none [&_input]:p-3 [&_input]:w-full [&_input]:focus:shadow-[4px_4px_0px_0px_black] [&_label]:font-mono [&_label]:font-bold [&_label]:text-xs [&_label]:uppercase [&_label]:mb-2">
                                                        <x-date-selector label="Date of Birth"
                                                            wire:model="birthdate" />
                                                    </div>
                                                </div>

                                                <!-- Gender -->
                                                <div>
                                                    <label
                                                        class="block font-mono font-bold text-xs uppercase mb-2">Gender</label>
                                                    <div class="relative">
                                                        <select wire:model="gender"
                                                            class="w-full bg-white border-2 border-black p-3 appearance-none font-medium focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                                            <option value="">Select...</option>
                                                            <option value="male">Male</option>
                                                            <option value="female">Female</option>
                                                        </select>
                                                        <i data-lucide="chevron-down"
                                                            class="absolute right-3 top-3.5 w-5 h-5 pointer-events-none"></i>
                                                    </div>
                                                </div>

                                                <!-- Marital Status -->
                                                <div>
                                                    <label
                                                        class="block font-mono font-bold text-xs uppercase mb-2">Marital
                                                        Status</label>
                                                    <div class="relative">
                                                        <select wire:model="marital_status"
                                                            class="w-full bg-white border-2 border-black p-3 appearance-none font-medium focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                                            <option value="">Select...</option>
                                                            <option value="single">Single</option>
                                                            <option value="married">Married</option>
                                                            <option value="divorced">Divorced</option>
                                                        </select>
                                                        <i data-lucide="chevron-down"
                                                            class="absolute right-3 top-3.5 w-5 h-5 pointer-events-none"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- 4. SUMMARY SECTION -->
                                        <div x-data="{ pasted: false }">
                                            <div class="flex justify-between items-end mb-2">
                                                <label class="font-display font-bold text-xl uppercase">Professional
                                                    Summary</label>

                                                <button type="button"
                                                    @click="navigator.clipboard.readText().then(text => { $wire.set('summary', text); pasted = true; setTimeout(() => pasted = false, 2000); })"
                                                    class="group flex items-center gap-2 px-3 py-1 bg-white border-2 border-black text-xs font-mono font-bold hover:bg-black hover:text-white transition-all shadow-[2px_2px_0px_0px_black] active:translate-x-[1px] active:translate-y-[1px] active:shadow-none">
                                                    <template x-if="!pasted">
                                                        <div class="flex items-center gap-2">
                                                            <i data-lucide="clipboard" class="w-3 h-3"></i> PASTE
                                                        </div>
                                                    </template>
                                                    <template x-if="pasted">
                                                        <div
                                                            class="flex items-center gap-2 text-green-500 group-hover:text-green-300">
                                                            <i data-lucide="check" class="w-3 h-3"></i> DONE!
                                                        </div>
                                                    </template>
                                                </button>
                                            </div>

                                            <textarea wire:model.defer="summary" rows="6"
                                                placeholder="Briefly describe your experience, superpowers, and what you bring to the table..."
                                                class="w-full bg-white border-2 border-black p-4 font-sans text-sm leading-relaxed focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow"></textarea>

                                            <!-- AI Generator Wrapper -->
                                            <div class="mt-4 p-4 border-2 border-black border-dashed bg-gray-50">
                                                <div class="flex items-center gap-2 mb-2">
                                                    <i data-lucide="sparkles" class="w-4 h-4 text-accent-blue"></i>
                                                    <span
                                                        class="font-mono text-xs font-bold uppercase text-gray-500">Lazy?
                                                        Use AI</span>
                                                </div>
                                                @livewire('about-generator')
                                            </div>
                                        </div>

                                        <!-- 5. LINKS SECTION -->
                                        <div
                                            class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t-2 border-black">
                                            <div>
                                                <label class="block font-mono font-bold text-xs uppercase mb-2">Website
                                                    Link</label>
                                                <div class="relative">
                                                    <div class="absolute top-3 left-3 pointer-events-none">
                                                        <i data-lucide="globe" class="w-5 h-5 text-gray-400"></i>
                                                    </div>
                                                    <input type="url" wire:model="website_link"
                                                        placeholder="https://mysite.com"
                                                        class="w-full bg-white border-2 border-black p-3 pl-10 font-mono text-sm focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                                </div>
                                            </div>
                                            <div>
                                                <label
                                                    class="block font-mono font-bold text-xs uppercase mb-2">Portfolio
                                                    Link</label>
                                                <div class="relative">
                                                    <div class="absolute top-3 left-3 pointer-events-none">
                                                        <i data-lucide="briefcase" class="w-5 h-5 text-gray-400"></i>
                                                    </div>
                                                    <input type="url" wire:model="portfolio_link"
                                                        placeholder="https://behance.net/..."
                                                        class="w-full bg-white border-2 border-black p-3 pl-10 font-mono text-sm focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                @endif


                                @if ($currentStep == 2)
                                    <div class="animate-fade-in-up space-y-12">

                                        <!-- HEADER SECTION -->
                                        <div
                                            class="border-b-2 border-black pb-6 flex flex-col md:flex-row md:items-end justify-between gap-4">
                                            <div>
                                                <h3
                                                    class="font-display text-4xl font-bold uppercase tracking-tighter text-black leading-none">
                                                    History
                                                </h3>
                                                <p
                                                    class="font-mono text-sm text-gray-500 mt-2 bg-yellow-300 inline-block px-2 border border-black shadow-[2px_2px_0px_0px_black]">
                                                    Step 02: Education & Work
                                                </p>
                                            </div>
                                            <div class="text-right hidden md:block">
                                                <p class="text-xs font-mono text-gray-400">Chronological Order
                                                    Recommended.</p>
                                                <p class="text-xs font-mono text-gray-400">Be precise.</p>
                                            </div>
                                        </div>

                                        {{-- ===================================================
         SECTION 1: EDUCATION
         =================================================== --}}
                                        <div>
                                            {{-- Section Header --}}
                                            <div class="flex justify-between items-end mb-6">
                                                <div class="flex items-center gap-3">
                                                    <div
                                                        class="w-10 h-10 bg-black text-white flex items-center justify-center border-2 border-black">
                                                        <i data-lucide="graduation-cap" class="w-5 h-5"></i>
                                                    </div>
                                                    <h4 class="font-display text-2xl font-bold uppercase">Education
                                                    </h4>
                                                </div>

                                                <button type="button" wire:click="addEducation"
                                                    class="group flex items-center gap-2 px-4 py-2 bg-white border-2 border-black text-xs font-mono font-bold uppercase hover:bg-black hover:text-white transition-all shadow-[4px_4px_0px_0px_black] active:translate-x-[2px] active:translate-y-[2px] active:shadow-none">
                                                    <i data-lucide="plus" class="w-4 h-4"></i>
                                                    <span>Add New</span>
                                                </button>
                                            </div>

                                            {{-- Empty State --}}
                                            @if (count($educations) === 0)
                                                <div
                                                    class="border-2 border-black border-dashed bg-gray-50 p-8 text-center">
                                                    <p class="font-mono text-sm text-gray-500 mb-2">No education added
                                                        yet.</p>
                                                    <p class="font-mono text-xs text-gray-400">Click "Add New" to list
                                                        your degrees.</p>
                                                </div>
                                            @endif

                                            {{-- Education List (Accordion) --}}
                                            <div class="space-y-4">
                                                @foreach ($educations as $index => $education)
                                                    <div x-data="{
                                                        expanded: {{ empty($education['school']) ? 'true' : 'false' }},
                                                        schoolName: @entangle("educations.{$index}.school")
                                                    }"
                                                        class="border-2 border-black bg-white transition-all duration-200"
                                                        :class="expanded ? 'shadow-[8px_8px_0px_0px_black] -translate-y-1' :
                                                            'hover:shadow-[4px_4px_0px_0px_black] hover:-translate-y-[2px]'">

                                                        {{-- ACCORDION HEADER --}}
                                                        <div @click="expanded = !expanded"
                                                            class="flex justify-between items-center p-4 cursor-pointer select-none group"
                                                            :class="expanded ? 'bg-black text-white border-b-2 border-black' :
                                                                'bg-white text-black'">

                                                            <div class="flex items-center gap-4">
                                                                {{-- Chevron --}}
                                                                <div class="transition-transform duration-200"
                                                                    :class="expanded ? 'rotate-180' : ''">
                                                                    <i data-lucide="chevron-down" class="w-5 h-5"></i>
                                                                </div>

                                                                {{-- Title --}}
                                                                <div class="flex flex-col">
                                                                    <span
                                                                        class="font-display font-bold text-lg uppercase tracking-wide"
                                                                        x-text="schoolName || 'NEW EDUCATION'"></span>
                                                                    <span x-show="!expanded"
                                                                        class="font-mono text-[10px] opacity-60 uppercase">Click
                                                                        to
                                                                        edit details</span>
                                                                </div>
                                                            </div>

                                                            {{-- Remove Button --}}
                                                            <button type="button"
                                                                wire:click="removeEducation({{ $index }})"
                                                                @click.stop
                                                                class="p-2 border-2 border-transparent hover:border-red-500 hover:bg-red-500 hover:text-white transition-colors"
                                                                :class="expanded ? 'text-gray-400 hover:border-white' :
                                                                    'text-gray-400'">
                                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                            </button>
                                                        </div>

                                                        {{-- ACCORDION BODY --}}
                                                        <div x-show="expanded" x-collapse class="p-6 bg-white">
                                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                                                {{-- School --}}
                                                                <div class="md:col-span-2">
                                                                    <label
                                                                        class="block font-mono font-bold text-xs uppercase mb-2">School
                                                                        /
                                                                        University</label>
                                                                    <input type="text" x-model="schoolName"
                                                                        wire:model="educations.{{ $index }}.school"
                                                                        placeholder="Ex: Harvard University"
                                                                        class="w-full bg-white border-2 border-black p-3 font-bold focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                                                </div>

                                                                {{-- Degree --}}
                                                                <div>
                                                                    <label
                                                                        class="block font-mono font-bold text-xs uppercase mb-2">Degree
                                                                        /
                                                                        Major</label>
                                                                    <input type="text"
                                                                        wire:model="educations.{{ $index }}.degree"
                                                                        placeholder="Ex: Bachelor of Science"
                                                                        class="w-full bg-white border-2 border-black p-3 font-medium focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                                                </div>

                                                                {{-- Location --}}
                                                                <div>
                                                                    <label
                                                                        class="block font-mono font-bold text-xs uppercase mb-2">City,
                                                                        Country</label>
                                                                    <input type="text"
                                                                        wire:model="educations.{{ $index }}.location"
                                                                        placeholder="Ex: Boston, USA"
                                                                        class="w-full bg-white border-2 border-black p-3 font-medium focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                                                </div>

                                                                {{-- Date Selectors --}}
                                                                <div>
                                                                    <x-date-selector
                                                                        wire:model="educations.{{ $index }}.year_start"
                                                                        label="Start Date" :with-day="false" />
                                                                </div>
                                                                <div>
                                                                    <x-date-selector
                                                                        wire:model="educations.{{ $index }}.year_end"
                                                                        label="End Date (Or Expected)"
                                                                        :with-day="false" />
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        {{-- Separator Line --}}
                                        <div class="border-t-2 border-black border-dashed"></div>

                                        {{-- ===================================================
         SECTION 2: WORK EXPERIENCE
         =================================================== --}}
                                        <div>
                                            {{-- Section Header --}}
                                            <div class="flex justify-between items-end mb-6">
                                                <div class="flex items-center gap-3">
                                                    <div
                                                        class="w-10 h-10 bg-accent-blue text-white flex items-center justify-center border-2 border-black">
                                                        <i data-lucide="briefcase" class="w-5 h-5"></i>
                                                    </div>
                                                    <h4 class="font-display text-2xl font-bold uppercase">Work
                                                        Experience</h4>
                                                </div>

                                                <button type="button" wire:click="addExperience"
                                                    class="group flex items-center gap-2 px-4 py-2 bg-white border-2 border-black text-xs font-mono font-bold uppercase hover:bg-black hover:text-white transition-all shadow-[4px_4px_0px_0px_black] active:translate-x-[2px] active:translate-y-[2px] active:shadow-none">
                                                    <i data-lucide="plus" class="w-4 h-4"></i>
                                                    <span>Add New</span>
                                                </button>
                                            </div>

                                            {{-- Empty State --}}
                                            @if (count($experiences) === 0)
                                                <div
                                                    class="border-2 border-black border-dashed bg-gray-50 p-8 text-center">
                                                    <p class="font-mono text-sm text-gray-500 mb-2">No work experience
                                                        added.</p>
                                                    <p class="font-mono text-xs text-gray-400">Fresh graduate? Skip
                                                        this or add internships.</p>
                                                </div>
                                            @endif

                                            <div class="space-y-4">
                                                @foreach ($experiences as $index => $experience)
                                                    <div x-data="{
                                                        expanded: {{ empty($experience['company']) ? 'true' : 'false' }},
                                                        companyName: @entangle("experiences.{$index}.company"),
                                                        jobTitle: @entangle("experiences.{$index}.job_title"),
                                                        isPresent: @entangle("experiences.{$index}.is_present")
                                                    }"
                                                        class="border-2 border-black bg-white transition-all duration-200"
                                                        :class="expanded ? 'shadow-[8px_8px_0px_0px_black] -translate-y-1' :
                                                            'hover:shadow-[4px_4px_0px_0px_black] hover:-translate-y-[2px]'">

                                                        {{-- ACCORDION HEADER --}}
                                                        <div @click="expanded = !expanded"
                                                            class="flex justify-between items-center p-4 cursor-pointer select-none group"
                                                            :class="expanded ? 'bg-black text-white border-b-2 border-black' :
                                                                'bg-white text-black'">

                                                            <div class="flex items-center gap-4">
                                                                {{-- Chevron --}}
                                                                <div class="transition-transform duration-200"
                                                                    :class="expanded ? 'rotate-180' : ''">
                                                                    <i data-lucide="chevron-down" class="w-5 h-5"></i>
                                                                </div>

                                                                {{-- Titles --}}
                                                                <div class="flex flex-col">
                                                                    <span
                                                                        class="font-display font-bold text-lg uppercase tracking-wide"
                                                                        x-text="companyName || 'NEW EXPERIENCE'"></span>

                                                                    <div class="flex items-center gap-2"
                                                                        x-show="jobTitle">
                                                                        <span class="font-mono text-xs opacity-80"
                                                                            x-text="jobTitle"></span>
                                                                    </div>
                                                                    <span x-show="!jobTitle && !expanded"
                                                                        class="font-mono text-[10px] opacity-60 uppercase">Click
                                                                        to edit details</span>
                                                                </div>
                                                            </div>

                                                            {{-- Remove Button --}}
                                                            <button type="button"
                                                                wire:click="removeExperience({{ $index }})"
                                                                @click.stop
                                                                class="p-2 border-2 border-transparent hover:border-red-500 hover:bg-red-500 hover:text-white transition-colors"
                                                                :class="expanded ? 'text-gray-400 hover:border-white' :
                                                                    'text-gray-400'">
                                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                            </button>
                                                        </div>

                                                        {{-- ACCORDION BODY --}}
                                                        <div x-show="expanded" x-collapse class="p-6 bg-white">
                                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                                                {{-- Company --}}
                                                                <div>
                                                                    <label
                                                                        class="block font-mono font-bold text-xs uppercase mb-2">Company
                                                                        Name</label>
                                                                    <input type="text" x-model="companyName"
                                                                        wire:model="experiences.{{ $index }}.company"
                                                                        placeholder="Ex: Google Inc"
                                                                        class="w-full bg-white border-2 border-black p-3 font-bold focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                                                </div>

                                                                {{-- Job Title --}}
                                                                <div>
                                                                    <label
                                                                        class="block font-mono font-bold text-xs uppercase mb-2">Job
                                                                        Title</label>
                                                                    <input type="text" x-model="jobTitle"
                                                                        wire:model="experiences.{{ $index }}.job_title"
                                                                        placeholder="Ex: Senior Developer"
                                                                        class="w-full bg-white border-2 border-black p-3 font-medium focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                                                </div>

                                                                {{-- Location --}}
                                                                <div class="md:col-span-2">
                                                                    <label
                                                                        class="block font-mono font-bold text-xs uppercase mb-2">Location</label>
                                                                    <input type="text"
                                                                        wire:model="experiences.{{ $index }}.location"
                                                                        placeholder="Ex: Jakarta, Indonesia"
                                                                        class="w-full bg-white border-2 border-black p-3 font-medium focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                                                </div>

                                                                {{-- Dates --}}
                                                                <div
                                                                    class="md:col-span-2 border-2 border-black border-dashed p-4 bg-gray-50">
                                                                    <div
                                                                        class="flex items-center justify-between mb-4">
                                                                        <label
                                                                            class="font-mono font-bold text-xs uppercase">Employment
                                                                            Period</label>

                                                                        {{-- Checkbox Present --}}
                                                                        <label
                                                                            class="flex items-center gap-2 cursor-pointer">
                                                                            <input type="checkbox" x-model="isPresent"
                                                                                wire:model="experiences.{{ $index }}.is_present"
                                                                                class="w-4 h-4 text-black border-2 border-black rounded-none focus:ring-0 focus:ring-offset-0">
                                                                            <span
                                                                                class="font-mono text-xs font-bold uppercase">Currently
                                                                                Working
                                                                                Here</span>
                                                                        </label>
                                                                    </div>

                                                                    <div class="grid grid-cols-2 gap-4">
                                                                        {{-- Start Date (Native Date Picker with Brutalist Style) --}}
                                                                        <div>
                                                                            <label
                                                                                class="block font-mono font-bold text-[10px] uppercase mb-1 text-gray-500">Start
                                                                                Date</label>
                                                                            <input type="date"
                                                                                wire:model="experiences.{{ $index }}.start_date"
                                                                                class="w-full bg-white border-2 border-black p-2 font-mono text-sm focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                                                        </div>

                                                                        {{-- End Date --}}
                                                                        <div>
                                                                            <label
                                                                                class="block font-mono font-bold text-[10px] uppercase mb-1 text-gray-500">End
                                                                                Date</label>
                                                                            <input type="date"
                                                                                wire:model="experiences.{{ $index }}.end_date"
                                                                                :disabled="isPresent"
                                                                                class="w-full border-2 border-black p-2 font-mono text-sm focus:outline-none transition-all"
                                                                                :class="isPresent ?
                                                                                    'bg-gray-200 text-gray-400 cursor-not-allowed border-gray-300' :
                                                                                    'bg-white focus:shadow-[4px_4px_0px_0px_black]'">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                {{-- Description --}}
                                                                <div class="md:col-span-2">
                                                                    <label
                                                                        class="block font-mono font-bold text-xs uppercase mb-2">Job
                                                                        Description</label>
                                                                    <textarea wire:model="experiences.{{ $index }}.job_desk" rows="4"
                                                                        placeholder="Describe your responsibilities, achievements, and tech stack used..."
                                                                        class="w-full bg-white border-2 border-black p-3 font-sans text-sm leading-relaxed focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow"></textarea>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                    </div>
                                @endif


                                @if ($currentStep == 3)
                                    <div class="animate-fade-in-up space-y-12">

                                        <!-- HEADER SECTION -->
                                        <div
                                            class="border-b-2 border-black pb-6 flex flex-col md:flex-row md:items-end justify-between gap-4">
                                            <div>
                                                <h3
                                                    class="font-display text-4xl font-bold uppercase tracking-tighter text-black leading-none">
                                                    Abilities
                                                </h3>
                                                <p
                                                    class="font-mono text-sm text-gray-500 mt-2 bg-yellow-300 inline-block px-2 border border-black shadow-[2px_2px_0px_0px_black]">
                                                    Step 03: Skills & Languages
                                                </p>
                                            </div>
                                            <div class="text-right hidden md:block">
                                                <p class="text-xs font-mono text-gray-400">Be honest with levels.</p>
                                                <p class="text-xs font-mono text-gray-400">Showcase your strengths.</p>
                                            </div>
                                        </div>

                                        {{-- ===================================================
         1. HARD SKILLS (Blue Theme)
         =================================================== --}}
                                        <div>
                                            {{-- Header --}}
                                            <div class="flex justify-between items-end mb-6">
                                                <div class="flex items-center gap-3">
                                                    <div
                                                        class="w-10 h-10 bg-accent-blue text-white flex items-center justify-center border-2 border-black">
                                                        <i data-lucide="cpu" class="w-5 h-5"></i>
                                                    </div>
                                                    <div>
                                                        <h4
                                                            class="font-display text-2xl font-bold uppercase leading-none">
                                                            Hard Skills</h4>
                                                        <p class="font-mono text-[10px] text-gray-500 uppercase mt-1">
                                                            Technical & Tools</p>
                                                    </div>
                                                </div>

                                                <button type="button" wire:click="addHardSkill"
                                                    class="group flex items-center gap-2 px-4 py-2 bg-white border-2 border-black text-xs font-mono font-bold uppercase hover:bg-black hover:text-white transition-all shadow-[4px_4px_0px_0px_black] active:translate-x-[2px] active:translate-y-[2px] active:shadow-none">
                                                    <i data-lucide="plus" class="w-4 h-4"></i>
                                                    <span>Add New</span>
                                                </button>
                                            </div>

                                            {{-- List --}}
                                            <div class="space-y-4">
                                                @foreach ($hardSkills as $index => $skill)
                                                    <div x-data="{
                                                        expanded: {{ empty($skill['skill_name']) ? 'true' : 'false' }},
                                                        name: @entangle("hardSkills.{$index}.skill_name"),
                                                        level: @entangle("hardSkills.{$index}.level")
                                                    }"
                                                        class="border-2 border-black bg-white transition-all duration-200"
                                                        :class="expanded ? 'shadow-[8px_8px_0px_0px_black] -translate-y-1' :
                                                            'hover:shadow-[4px_4px_0px_0px_black] hover:-translate-y-[2px]'">

                                                        {{-- Accordion Header --}}
                                                        <div @click="expanded = !expanded"
                                                            class="flex justify-between items-center p-4 cursor-pointer select-none group"
                                                            :class="expanded ? 'bg-black text-white border-b-2 border-black' :
                                                                'bg-white text-black'">

                                                            <div class="flex items-center gap-4">
                                                                <div class="transition-transform duration-200"
                                                                    :class="expanded ? 'rotate-180' : ''">
                                                                    <i data-lucide="chevron-down" class="w-5 h-5"></i>
                                                                </div>
                                                                <div class="flex flex-col">
                                                                    <span
                                                                        class="font-display font-bold text-lg uppercase tracking-wide"
                                                                        x-text="name || 'NEW HARD SKILL'"></span>

                                                                    <div class="flex items-center gap-2 mt-1"
                                                                        x-show="!expanded">
                                                                        <span x-show="level" x-text="level"
                                                                            class="px-2 py-0.5 border border-black bg-accent-blue text-white font-mono text-[10px] font-bold uppercase">
                                                                        </span>
                                                                        <span x-show="!level && !expanded"
                                                                            class="font-mono text-[10px] opacity-60 uppercase">Click
                                                                            to edit</span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <button type="button"
                                                                wire:click="removeHardSkill({{ $index }})"
                                                                @click.stop
                                                                class="p-2 border-2 border-transparent hover:border-red-500 hover:bg-red-500 hover:text-white transition-colors"
                                                                :class="expanded ? 'text-gray-400 hover:border-white' :
                                                                    'text-gray-400'">
                                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                            </button>
                                                        </div>

                                                        {{-- Accordion Body --}}
                                                        <div x-show="expanded" x-collapse class="p-6 bg-white">
                                                            <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                                                                {{-- Name --}}
                                                                <div class="md:col-span-6">
                                                                    <label
                                                                        class="block font-mono font-bold text-xs uppercase mb-2">Skill
                                                                        Name</label>
                                                                    <input type="text" x-model="name"
                                                                        wire:model="hardSkills.{{ $index }}.skill_name"
                                                                        placeholder="e.g. Laravel, Photoshop"
                                                                        class="w-full bg-white border-2 border-black p-3 font-bold focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                                                </div>

                                                                {{-- Level --}}
                                                                <div class="md:col-span-4">
                                                                    <label
                                                                        class="block font-mono font-bold text-xs uppercase mb-2">Level</label>
                                                                    <div class="relative">
                                                                        <select x-model="level"
                                                                            wire:model="hardSkills.{{ $index }}.level"
                                                                            class="w-full bg-white border-2 border-black p-3 appearance-none font-medium focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                                                            <option value="">Select...</option>
                                                                            <option value="Beginner">Beginner</option>
                                                                            <option value="Intermediate">Intermediate
                                                                            </option>
                                                                            <option value="Advanced">Advanced</option>
                                                                            <option value="Expert">Expert</option>
                                                                        </select>
                                                                        <i data-lucide="chevron-down"
                                                                            class="absolute right-3 top-3.5 w-5 h-5 pointer-events-none"></i>
                                                                    </div>
                                                                </div>

                                                                {{-- Score (Range Slider) --}}
                                                                <div class="md:col-span-2">
                                                                    <label
                                                                        class="block font-mono font-bold text-xs uppercase mb-2">Score
                                                                        (1-10)
                                                                    </label>
                                                                    <div
                                                                        class="flex items-center gap-2 border-2 border-black p-3 bg-gray-50">
                                                                        <input type="number"
                                                                            wire:model="hardSkills.{{ $index }}.scale"
                                                                            min="1" max="10"
                                                                            class="w-full bg-transparent font-display font-bold text-lg text-center focus:outline-none">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        {{-- ===================================================
         2. SOFT SKILLS (Green Theme)
         =================================================== --}}
                                        <div>
                                            <div
                                                class="flex justify-between items-end mb-6 pt-8 border-t-2 border-black border-dashed">
                                                <div class="flex items-center gap-3">
                                                    <div
                                                        class="w-10 h-10 bg-green-500 text-black flex items-center justify-center border-2 border-black">
                                                        <i data-lucide="users" class="w-5 h-5"></i>
                                                    </div>
                                                    <div>
                                                        <h4
                                                            class="font-display text-2xl font-bold uppercase leading-none">
                                                            Soft Skills</h4>
                                                        <p class="font-mono text-[10px] text-gray-500 uppercase mt-1">
                                                            Interpersonal & Leadership</p>
                                                    </div>
                                                </div>

                                                <button type="button" wire:click="addSoftSkill"
                                                    class="group flex items-center gap-2 px-4 py-2 bg-white border-2 border-black text-xs font-mono font-bold uppercase hover:bg-black hover:text-white transition-all shadow-[4px_4px_0px_0px_black] active:translate-x-[2px] active:translate-y-[2px] active:shadow-none">
                                                    <i data-lucide="plus" class="w-4 h-4"></i>
                                                    <span>Add New</span>
                                                </button>
                                            </div>

                                            <div class="space-y-4">
                                                @foreach ($softSkills as $index => $skill)
                                                    <div x-data="{
                                                        expanded: {{ empty($skill['skill_name']) ? 'true' : 'false' }},
                                                        name: @entangle("softSkills.{$index}.skill_name"),
                                                        level: @entangle("softSkills.{$index}.level")
                                                    }"
                                                        class="border-2 border-black bg-white transition-all duration-200"
                                                        :class="expanded ? 'shadow-[8px_8px_0px_0px_black] -translate-y-1' :
                                                            'hover:shadow-[4px_4px_0px_0px_black] hover:-translate-y-[2px]'">

                                                        <div @click="expanded = !expanded"
                                                            class="flex justify-between items-center p-4 cursor-pointer select-none group"
                                                            :class="expanded ? 'bg-black text-white border-b-2 border-black' :
                                                                'bg-white text-black'">

                                                            <div class="flex items-center gap-4">
                                                                <div class="transition-transform duration-200"
                                                                    :class="expanded ? 'rotate-180' : ''">
                                                                    <i data-lucide="chevron-down" class="w-5 h-5"></i>
                                                                </div>
                                                                <div class="flex flex-col">
                                                                    <span
                                                                        class="font-display font-bold text-lg uppercase tracking-wide"
                                                                        x-text="name || 'NEW SOFT SKILL'"></span>

                                                                    <div class="flex items-center gap-2 mt-1"
                                                                        x-show="!expanded">
                                                                        <span x-show="level" x-text="level"
                                                                            class="px-2 py-0.5 border border-black bg-green-500 text-black font-mono text-[10px] font-bold uppercase">
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button type="button"
                                                                wire:click="removeSoftSkill({{ $index }})"
                                                                @click.stop
                                                                class="p-2 border-2 border-transparent hover:border-red-500 hover:bg-red-500 hover:text-white transition-colors"
                                                                :class="expanded ? 'text-gray-400 hover:border-white' :
                                                                    'text-gray-400'">
                                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                            </button>
                                                        </div>

                                                        <div x-show="expanded" x-collapse class="p-6 bg-white">
                                                            <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                                                                <div class="md:col-span-6">
                                                                    <label
                                                                        class="block font-mono font-bold text-xs uppercase mb-2">Skill
                                                                        Name</label>
                                                                    <input type="text" x-model="name"
                                                                        wire:model="softSkills.{{ $index }}.skill_name"
                                                                        placeholder="e.g. Leadership"
                                                                        class="w-full bg-white border-2 border-black p-3 font-bold focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                                                </div>
                                                                <div class="md:col-span-4">
                                                                    <label
                                                                        class="block font-mono font-bold text-xs uppercase mb-2">Level</label>
                                                                    <div class="relative">
                                                                        <select x-model="level"
                                                                            wire:model="softSkills.{{ $index }}.level"
                                                                            class="w-full bg-white border-2 border-black p-3 appearance-none font-medium focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                                                            <option value="">Select...</option>
                                                                            <option value="Beginner">Beginner</option>
                                                                            <option value="Intermediate">Intermediate
                                                                            </option>
                                                                            <option value="Advanced">Advanced</option>
                                                                            <option value="Expert">Expert</option>
                                                                        </select>
                                                                        <i data-lucide="chevron-down"
                                                                            class="absolute right-3 top-3.5 w-5 h-5 pointer-events-none"></i>
                                                                    </div>
                                                                </div>
                                                                <div class="md:col-span-2">
                                                                    <label
                                                                        class="block font-mono font-bold text-xs uppercase mb-2">Score</label>
                                                                    <div
                                                                        class="flex items-center gap-2 border-2 border-black p-3 bg-gray-50">
                                                                        <input type="number"
                                                                            wire:model="softSkills.{{ $index }}.scale"
                                                                            min="1" max="10"
                                                                            class="w-full bg-transparent font-display font-bold text-lg text-center focus:outline-none">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        {{-- ===================================================
         3. LANGUAGES (Purple Theme)
         =================================================== --}}
                                        <div>
                                            <div
                                                class="flex justify-between items-end mb-6 pt-8 border-t-2 border-black border-dashed">
                                                <div class="flex items-center gap-3">
                                                    <div
                                                        class="w-10 h-10 bg-purple-500 text-white flex items-center justify-center border-2 border-black">
                                                        <i data-lucide="languages" class="w-5 h-5"></i>
                                                    </div>
                                                    <div>
                                                        <h4
                                                            class="font-display text-2xl font-bold uppercase leading-none">
                                                            Languages</h4>
                                                        <p class="font-mono text-[10px] text-gray-500 uppercase mt-1">
                                                            Communication</p>
                                                    </div>
                                                </div>

                                                <button type="button" wire:click="addLanguage"
                                                    class="group flex items-center gap-2 px-4 py-2 bg-white border-2 border-black text-xs font-mono font-bold uppercase hover:bg-black hover:text-white transition-all shadow-[4px_4px_0px_0px_black] active:translate-x-[2px] active:translate-y-[2px] active:shadow-none">
                                                    <i data-lucide="plus" class="w-4 h-4"></i>
                                                    <span>Add New</span>
                                                </button>
                                            </div>

                                            <div class="space-y-4">
                                                @foreach ($languages as $index => $language)
                                                    <div x-data="{
                                                        expanded: {{ empty($language['language']) ? 'true' : 'false' }},
                                                        name: @entangle("languages.{$index}.language"),
                                                        level: @entangle("languages.{$index}.level")
                                                    }"
                                                        class="border-2 border-black bg-white transition-all duration-200"
                                                        :class="expanded ? 'shadow-[8px_8px_0px_0px_black] -translate-y-1' :
                                                            'hover:shadow-[4px_4px_0px_0px_black] hover:-translate-y-[2px]'">

                                                        <div @click="expanded = !expanded"
                                                            class="flex justify-between items-center p-4 cursor-pointer select-none group"
                                                            :class="expanded ? 'bg-black text-white border-b-2 border-black' :
                                                                'bg-white text-black'">

                                                            <div class="flex items-center gap-4">
                                                                <div class="transition-transform duration-200"
                                                                    :class="expanded ? 'rotate-180' : ''">
                                                                    <i data-lucide="chevron-down" class="w-5 h-5"></i>
                                                                </div>
                                                                <div class="flex flex-col">
                                                                    <span
                                                                        class="font-display font-bold text-lg uppercase tracking-wide"
                                                                        x-text="name || 'NEW LANGUAGE'"></span>

                                                                    <div class="flex items-center gap-2 mt-1"
                                                                        x-show="!expanded">
                                                                        <span x-show="level" x-text="level"
                                                                            class="px-2 py-0.5 border border-black bg-purple-500 text-white font-mono text-[10px] font-bold uppercase">
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button type="button"
                                                                wire:click="removeLanguage({{ $index }})"
                                                                @click.stop
                                                                class="p-2 border-2 border-transparent hover:border-red-500 hover:bg-red-500 hover:text-white transition-colors"
                                                                :class="expanded ? 'text-gray-400 hover:border-white' :
                                                                    'text-gray-400'">
                                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                            </button>
                                                        </div>

                                                        <div x-show="expanded" x-collapse class="p-6 bg-white">
                                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                                <div>
                                                                    <label
                                                                        class="block font-mono font-bold text-xs uppercase mb-2">Language
                                                                        Name</label>
                                                                    <input type="text" x-model="name"
                                                                        wire:model="languages.{{ $index }}.language"
                                                                        placeholder="e.g. English"
                                                                        class="w-full bg-white border-2 border-black p-3 font-bold focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                                                </div>
                                                                <div>
                                                                    <label
                                                                        class="block font-mono font-bold text-xs uppercase mb-2">Proficiency</label>
                                                                    <div class="relative">
                                                                        <select x-model="level"
                                                                            wire:model="languages.{{ $index }}.level"
                                                                            class="w-full bg-white border-2 border-black p-3 appearance-none font-medium focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                                                            <option value="">Select...</option>
                                                                            <option value="Basic">Basic</option>
                                                                            <option value="Conversational">
                                                                                Conversational</option>
                                                                            <option value="Fluent">Fluent</option>
                                                                            <option value="Native">Native</option>
                                                                        </select>
                                                                        <i data-lucide="chevron-down"
                                                                            class="absolute right-3 top-3.5 w-5 h-5 pointer-events-none"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                    </div>
                                @endif


                                @if ($currentStep == 4)
                                    <div class="animate-fade-in-up space-y-12">

                                        <!-- HEADER SECTION -->
                                        <div
                                            class="border-b-2 border-black pb-6 flex flex-col md:flex-row md:items-end justify-between gap-4">
                                            <div>
                                                <h3
                                                    class="font-display text-4xl font-bold uppercase tracking-tighter text-black leading-none">
                                                    Credentials
                                                </h3>
                                                <p
                                                    class="font-mono text-sm text-gray-500 mt-2 bg-yellow-300 inline-block px-2 border border-black shadow-[2px_2px_0px_0px_black]">
                                                    Step 04: Awards & Refs
                                                </p>
                                            </div>
                                            <div class="text-right hidden md:block">
                                                <p class="text-xs font-mono text-gray-400">Validate your skills.</p>
                                                <p class="text-xs font-mono text-gray-400">Build trust.</p>
                                            </div>
                                        </div>

                                        {{-- ===================================================
         1. ACHIEVEMENTS (Yellow Theme)
         =================================================== --}}
                                        <div>
                                            <div class="flex justify-between items-end mb-6">
                                                <div class="flex items-center gap-3">
                                                    <div
                                                        class="w-10 h-10 bg-yellow-400 text-black flex items-center justify-center border-2 border-black">
                                                        <i data-lucide="trophy" class="w-5 h-5"></i>
                                                    </div>
                                                    <div>
                                                        <h4
                                                            class="font-display text-2xl font-bold uppercase leading-none">
                                                            Achievements</h4>
                                                        <p class="font-mono text-[10px] text-gray-500 uppercase mt-1">
                                                            Awards & Honors</p>
                                                    </div>
                                                </div>

                                                <button type="button" wire:click="addAchievement"
                                                    class="group flex items-center gap-2 px-4 py-2 bg-white border-2 border-black text-xs font-mono font-bold uppercase hover:bg-black hover:text-white transition-all shadow-[4px_4px_0px_0px_black] active:translate-x-[2px] active:translate-y-[2px] active:shadow-none">
                                                    <i data-lucide="plus" class="w-4 h-4"></i>
                                                    <span>Add New</span>
                                                </button>
                                            </div>

                                            <div class="space-y-4">
                                                @foreach ($achievements as $index => $achievement)
                                                    <div x-data="{
                                                        expanded: {{ empty($achievement['name']) ? 'true' : 'false' }},
                                                        name: @entangle("achievements.{$index}.name")
                                                    }"
                                                        class="border-2 border-black bg-white transition-all duration-200"
                                                        :class="expanded ? 'shadow-[8px_8px_0px_0px_black] -translate-y-1' :
                                                            'hover:shadow-[4px_4px_0px_0px_black] hover:-translate-y-[2px]'">

                                                        {{-- Header --}}
                                                        <div @click="expanded = !expanded"
                                                            class="flex justify-between items-center p-4 cursor-pointer select-none group"
                                                            :class="expanded ? 'bg-black text-white border-b-2 border-black' :
                                                                'bg-white text-black'">

                                                            <div class="flex items-center gap-4">
                                                                <div class="transition-transform duration-200"
                                                                    :class="expanded ? 'rotate-180' : ''">
                                                                    <i data-lucide="chevron-down" class="w-5 h-5"></i>
                                                                </div>
                                                                <span
                                                                    class="font-display font-bold text-lg uppercase tracking-wide"
                                                                    x-text="name || 'NEW ACHIEVEMENT'"></span>
                                                            </div>

                                                            <button type="button"
                                                                wire:click="removeAchievement({{ $index }})"
                                                                @click.stop
                                                                class="p-2 border-2 border-transparent hover:border-red-500 hover:bg-red-500 hover:text-white transition-colors"
                                                                :class="expanded ? 'text-gray-400 hover:border-white' :
                                                                    'text-gray-400'">
                                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                            </button>
                                                        </div>

                                                        {{-- Body --}}
                                                        <div x-show="expanded" x-collapse class="p-6 bg-white">
                                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                                <div class="md:col-span-2">
                                                                    <label
                                                                        class="block font-mono font-bold text-xs uppercase mb-2">Achievement
                                                                        Name</label>
                                                                    <input type="text" x-model="name"
                                                                        wire:model="achievements.{{ $index }}.name"
                                                                        placeholder="e.g. Employee of the Year"
                                                                        class="w-full bg-white border-2 border-black p-3 font-bold focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                                                </div>
                                                                <div>
                                                                    <label
                                                                        class="block font-mono font-bold text-xs uppercase mb-2">Organization
                                                                        /
                                                                        Vendor</label>
                                                                    <input type="text"
                                                                        wire:model="achievements.{{ $index }}.vendor"
                                                                        placeholder="e.g. Google"
                                                                        class="w-full bg-white border-2 border-black p-3 font-medium focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                                                </div>
                                                                <div>
                                                                    <label
                                                                        class="block font-mono font-bold text-xs uppercase mb-2">Year</label>
                                                                    {{-- Menggunakan type="number" untuk tahun, atau date picker jika ingin full date --}}
                                                                    <input type="number"
                                                                        wire:model="achievements.{{ $index }}.year"
                                                                        placeholder="YYYY" min="1900"
                                                                        max="2099"
                                                                        class="w-full bg-white border-2 border-black p-3 font-mono font-bold focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        {{-- ===================================================
         2. CERTIFICATIONS (Cyan Theme)
         =================================================== --}}
                                        <div>
                                            <div
                                                class="flex justify-between items-end mb-6 pt-8 border-t-2 border-black border-dashed">
                                                <div class="flex items-center gap-3">
                                                    <div
                                                        class="w-10 h-10 bg-cyan-400 text-black flex items-center justify-center border-2 border-black">
                                                        <i data-lucide="award" class="w-5 h-5"></i>
                                                    </div>
                                                    <div>
                                                        <h4
                                                            class="font-display text-2xl font-bold uppercase leading-none">
                                                            Certifications</h4>
                                                        <p class="font-mono text-[10px] text-gray-500 uppercase mt-1">
                                                            Professional Licenses</p>
                                                    </div>
                                                </div>

                                                <button type="button" wire:click="addCertificate"
                                                    class="group flex items-center gap-2 px-4 py-2 bg-white border-2 border-black text-xs font-mono font-bold uppercase hover:bg-black hover:text-white transition-all shadow-[4px_4px_0px_0px_black] active:translate-x-[2px] active:translate-y-[2px] active:shadow-none">
                                                    <i data-lucide="plus" class="w-4 h-4"></i>
                                                    <span>Add New</span>
                                                </button>
                                            </div>

                                            <div class="space-y-4">
                                                @foreach ($certifications as $index => $certification)
                                                    <div x-data="{
                                                        expanded: {{ empty($certification['name']) ? 'true' : 'false' }},
                                                        name: @entangle("certifications.{$index}.name")
                                                    }"
                                                        class="border-2 border-black bg-white transition-all duration-200"
                                                        :class="expanded ? 'shadow-[8px_8px_0px_0px_black] -translate-y-1' :
                                                            'hover:shadow-[4px_4px_0px_0px_black] hover:-translate-y-[2px]'">

                                                        <div @click="expanded = !expanded"
                                                            class="flex justify-between items-center p-4 cursor-pointer select-none group"
                                                            :class="expanded ? 'bg-black text-white border-b-2 border-black' :
                                                                'bg-white text-black'">

                                                            <div class="flex items-center gap-4">
                                                                <div class="transition-transform duration-200"
                                                                    :class="expanded ? 'rotate-180' : ''">
                                                                    <i data-lucide="chevron-down" class="w-5 h-5"></i>
                                                                </div>
                                                                <span
                                                                    class="font-display font-bold text-lg uppercase tracking-wide"
                                                                    x-text="name || 'NEW CERTIFICATION'"></span>
                                                            </div>

                                                            <button type="button"
                                                                wire:click="removeCertificate({{ $index }})"
                                                                @click.stop
                                                                class="p-2 border-2 border-transparent hover:border-red-500 hover:bg-red-500 hover:text-white transition-colors"
                                                                :class="expanded ? 'text-gray-400 hover:border-white' :
                                                                    'text-gray-400'">
                                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                            </button>
                                                        </div>

                                                        <div x-show="expanded" x-collapse class="p-6 bg-white">
                                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                                <div class="md:col-span-2">
                                                                    <label
                                                                        class="block font-mono font-bold text-xs uppercase mb-2">Certification
                                                                        Name</label>
                                                                    <input type="text" x-model="name"
                                                                        wire:model="certifications.{{ $index }}.name"
                                                                        placeholder="e.g. AWS Certified Solutions Architect"
                                                                        class="w-full bg-white border-2 border-black p-3 font-bold focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                                                </div>
                                                                <div>
                                                                    <label
                                                                        class="block font-mono font-bold text-xs uppercase mb-2">Issuing
                                                                        Organization</label>
                                                                    <input type="text"
                                                                        wire:model="certifications.{{ $index }}.vendor"
                                                                        placeholder="e.g. Amazon Web Services"
                                                                        class="w-full bg-white border-2 border-black p-3 font-medium focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                                                </div>
                                                                <div>
                                                                    <label
                                                                        class="block font-mono font-bold text-xs uppercase mb-2">Year
                                                                        Obtained</label>
                                                                    <input type="number"
                                                                        wire:model="certifications.{{ $index }}.year"
                                                                        placeholder="YYYY" min="1900"
                                                                        max="2099"
                                                                        class="w-full bg-white border-2 border-black p-3 font-mono font-bold focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        {{-- ===================================================
         3. REFERENCES (Pink Theme)
         =================================================== --}}
                                        <div>
                                            <div
                                                class="flex justify-between items-end mb-6 pt-8 border-t-2 border-black border-dashed">
                                                <div class="flex items-center gap-3">
                                                    <div
                                                        class="w-10 h-10 bg-pink-400 text-black flex items-center justify-center border-2 border-black">
                                                        <i data-lucide="user-check" class="w-5 h-5"></i>
                                                    </div>
                                                    <div>
                                                        <h4
                                                            class="font-display text-2xl font-bold uppercase leading-none">
                                                            References</h4>
                                                        <p class="font-mono text-[10px] text-gray-500 uppercase mt-1">
                                                            Professional Contacts</p>
                                                    </div>
                                                </div>

                                                <button type="button" wire:click="addReference"
                                                    class="group flex items-center gap-2 px-4 py-2 bg-white border-2 border-black text-xs font-mono font-bold uppercase hover:bg-black hover:text-white transition-all shadow-[4px_4px_0px_0px_black] active:translate-x-[2px] active:translate-y-[2px] active:shadow-none">
                                                    <i data-lucide="plus" class="w-4 h-4"></i>
                                                    <span>Add New</span>
                                                </button>
                                            </div>

                                            <div class="space-y-4">
                                                @foreach ($references as $index => $reference)
                                                    <div x-data="{
                                                        expanded: {{ empty($reference['name']) ? 'true' : 'false' }},
                                                        name: @entangle("references.{$index}.name")
                                                    }"
                                                        class="border-2 border-black bg-white transition-all duration-200"
                                                        :class="expanded ? 'shadow-[8px_8px_0px_0px_black] -translate-y-1' :
                                                            'hover:shadow-[4px_4px_0px_0px_black] hover:-translate-y-[2px]'">

                                                        <div @click="expanded = !expanded"
                                                            class="flex justify-between items-center p-4 cursor-pointer select-none group"
                                                            :class="expanded ? 'bg-black text-white border-b-2 border-black' :
                                                                'bg-white text-black'">

                                                            <div class="flex items-center gap-4">
                                                                <div class="transition-transform duration-200"
                                                                    :class="expanded ? 'rotate-180' : ''">
                                                                    <i data-lucide="chevron-down" class="w-5 h-5"></i>
                                                                </div>
                                                                <span
                                                                    class="font-display font-bold text-lg uppercase tracking-wide"
                                                                    x-text="name || 'NEW REFERENCE'"></span>
                                                            </div>

                                                            <button type="button"
                                                                wire:click="removeReference({{ $index }})"
                                                                @click.stop
                                                                class="p-2 border-2 border-transparent hover:border-red-500 hover:bg-red-500 hover:text-white transition-colors"
                                                                :class="expanded ? 'text-gray-400 hover:border-white' :
                                                                    'text-gray-400'">
                                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                            </button>
                                                        </div>

                                                        <div x-show="expanded" x-collapse class="p-6 bg-white">
                                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                                <div>
                                                                    <label
                                                                        class="block font-mono font-bold text-xs uppercase mb-2">Full
                                                                        Name</label>
                                                                    <input type="text" x-model="name"
                                                                        wire:model="references.{{ $index }}.name"
                                                                        placeholder="e.g. John Doe"
                                                                        class="w-full bg-white border-2 border-black p-3 font-bold focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                                                </div>
                                                                <div>
                                                                    <label
                                                                        class="block font-mono font-bold text-xs uppercase mb-2">Company</label>
                                                                    <input type="text"
                                                                        wire:model="references.{{ $index }}.company"
                                                                        placeholder="e.g. Acme Corp"
                                                                        class="w-full bg-white border-2 border-black p-3 font-medium focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                                                </div>
                                                                <div>
                                                                    <label
                                                                        class="block font-mono font-bold text-xs uppercase mb-2">Email</label>
                                                                    <input type="email"
                                                                        wire:model="references.{{ $index }}.email"
                                                                        placeholder="email@example.com"
                                                                        class="w-full bg-white border-2 border-black p-3 font-medium focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                                                </div>
                                                                <div>
                                                                    <label
                                                                        class="block font-mono font-bold text-xs uppercase mb-2">Phone</label>
                                                                    <input type="text"
                                                                        wire:model="references.{{ $index }}.phone"
                                                                        placeholder="+62..."
                                                                        class="w-full bg-white border-2 border-black p-3 font-medium focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                                                </div>
                                                                <div class="md:col-span-2">
                                                                    <label
                                                                        class="block font-mono font-bold text-xs uppercase mb-2">Relationship</label>
                                                                    <input type="text"
                                                                        wire:model="references.{{ $index }}.relation"
                                                                        placeholder="e.g. Direct Manager, Team Lead"
                                                                        class="w-full bg-white border-2 border-black p-3 font-medium focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        {{-- ===================================================
         4. SOCIAL MEDIA (Gray Theme)
         =================================================== --}}
                                        <div>
                                            <div
                                                class="flex justify-between items-end mb-6 pt-8 border-t-2 border-black border-dashed">
                                                <div class="flex items-center gap-3">
                                                    <div
                                                        class="w-10 h-10 bg-gray-200 text-black flex items-center justify-center border-2 border-black">
                                                        <i data-lucide="share-2" class="w-5 h-5"></i>
                                                    </div>
                                                    <div>
                                                        <h4
                                                            class="font-display text-2xl font-bold uppercase leading-none">
                                                            Social Media</h4>
                                                        <p class="font-mono text-[10px] text-gray-500 uppercase mt-1">
                                                            Online Presence</p>
                                                    </div>
                                                </div>

                                                <button type="button" wire:click="addSocialMedia"
                                                    class="group flex items-center gap-2 px-4 py-2 bg-white border-2 border-black text-xs font-mono font-bold uppercase hover:bg-black hover:text-white transition-all shadow-[4px_4px_0px_0px_black] active:translate-x-[2px] active:translate-y-[2px] active:shadow-none">
                                                    <i data-lucide="plus" class="w-4 h-4"></i>
                                                    <span>Add New</span>
                                                </button>
                                            </div>

                                            <div class="space-y-4">
                                                @foreach ($socialMedia as $index => $sm)
                                                    <div x-data="{
                                                        expanded: {{ empty($sm['platform']) ? 'true' : 'false' }},
                                                        platform: @entangle("socialMedia.{$index}.platform")
                                                    }"
                                                        class="border-2 border-black bg-white transition-all duration-200"
                                                        :class="expanded ? 'shadow-[8px_8px_0px_0px_black] -translate-y-1' :
                                                            'hover:shadow-[4px_4px_0px_0px_black] hover:-translate-y-[2px]'">

                                                        <div @click="expanded = !expanded"
                                                            class="flex justify-between items-center p-4 cursor-pointer select-none group"
                                                            :class="expanded ? 'bg-black text-white border-b-2 border-black' :
                                                                'bg-white text-black'">

                                                            <div class="flex items-center gap-4">
                                                                <div class="transition-transform duration-200"
                                                                    :class="expanded ? 'rotate-180' : ''">
                                                                    <i data-lucide="chevron-down" class="w-5 h-5"></i>
                                                                </div>
                                                                <span
                                                                    class="font-display font-bold text-lg uppercase tracking-wide"
                                                                    x-text="platform || 'NEW SOCIAL'"></span>
                                                            </div>

                                                            <button type="button"
                                                                wire:click="removeSocialMedia({{ $index }})"
                                                                @click.stop
                                                                class="p-2 border-2 border-transparent hover:border-red-500 hover:bg-red-500 hover:text-white transition-colors"
                                                                :class="expanded ? 'text-gray-400 hover:border-white' :
                                                                    'text-gray-400'">
                                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                            </button>
                                                        </div>

                                                        <div x-show="expanded" x-collapse class="p-6 bg-white">
                                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                                                <div>
                                                                    <label
                                                                        class="block font-mono font-bold text-xs uppercase mb-2">Platform</label>
                                                                    <div class="relative">
                                                                        <select x-model="platform"
                                                                            wire:model="socialMedia.{{ $index }}.platform"
                                                                            class="w-full bg-white border-2 border-black p-3 appearance-none font-bold uppercase focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                                                            <option value="">Select...</option>
                                                                            <option value="linkedin">LinkedIn</option>
                                                                            <option value="github">GitHub</option>
                                                                            <option value="twitter">Twitter</option>
                                                                            <option value="instagram">Instagram
                                                                            </option>
                                                                            <option value="facebook">Facebook</option>
                                                                            <option value="website">Personal Website
                                                                            </option>
                                                                            <option value="other">Other</option>
                                                                        </select>
                                                                        <i data-lucide="chevron-down"
                                                                            class="absolute right-3 top-3.5 w-5 h-5 pointer-events-none"></i>
                                                                    </div>
                                                                </div>

                                                                <div>
                                                                    <label
                                                                        class="block font-mono font-bold text-xs uppercase mb-2">Username
                                                                        /
                                                                        Label</label>
                                                                    <input type="text"
                                                                        wire:model="socialMedia.{{ $index }}.name"
                                                                        placeholder="@username"
                                                                        class="w-full bg-white border-2 border-black p-3 font-medium focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                                                </div>

                                                                <div>
                                                                    <label
                                                                        class="block font-mono font-bold text-xs uppercase mb-2">URL
                                                                        Link</label>
                                                                    <input type="url"
                                                                        wire:model="socialMedia.{{ $index }}.link"
                                                                        placeholder="https://..."
                                                                        class="w-full bg-white border-2 border-black p-3 font-mono text-sm focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                    </div>
                                @endif


                                @if ($currentStep == 5)
                                    <div class="animate-fade-in-up space-y-12">

                                        <!-- HEADER SECTION -->
                                        <div
                                            class="border-b-2 border-black pb-6 flex flex-col md:flex-row md:items-end justify-between gap-4">
                                            <div>
                                                <h3
                                                    class="font-display text-4xl font-bold uppercase tracking-tighter text-black leading-none">
                                                    Maritime Data
                                                </h3>
                                                <p
                                                    class="font-mono text-sm text-gray-500 mt-2 bg-orange-300 inline-block px-2 border border-black shadow-[2px_2px_0px_0px_black]">
                                                    Step 05: Sea Service & Docs
                                                </p>
                                            </div>
                                            <div class="text-right hidden md:block">
                                                <p class="text-xs font-mono text-gray-400">Record sea time accurately.
                                                </p>
                                                <p class="text-xs font-mono text-gray-400">Valid documents only.</p>
                                            </div>
                                        </div>

                                        {{-- ===================================================
         1. SEA EXPERIENCE (Teal Theme)
         =================================================== --}}
                                        <div>
                                            {{-- Header --}}
                                            <div class="flex justify-between items-end mb-6">
                                                <div class="flex items-center gap-3">
                                                    <div
                                                        class="w-10 h-10 bg-teal-400 text-black flex items-center justify-center border-2 border-black">
                                                        <i data-lucide="anchor" class="w-5 h-5"></i>
                                                    </div>
                                                    <div>
                                                        <h4
                                                            class="font-display text-2xl font-bold uppercase leading-none">
                                                            Sea Experience</h4>
                                                        <p class="font-mono text-[10px] text-gray-500 uppercase mt-1">
                                                            Vessel & Contract History</p>
                                                    </div>
                                                </div>

                                                <button type="button" wire:click="addSeaExperience"
                                                    class="group flex items-center gap-2 px-4 py-2 bg-white border-2 border-black text-xs font-mono font-bold uppercase hover:bg-black hover:text-white transition-all shadow-[4px_4px_0px_0px_black] active:translate-x-[2px] active:translate-y-[2px] active:shadow-none">
                                                    <i data-lucide="plus" class="w-4 h-4"></i>
                                                    <span>Add New</span>
                                                </button>
                                            </div>

                                            {{-- Empty State --}}
                                            @if (count($seaExperiences) === 0)
                                                <div
                                                    class="border-2 border-black border-dashed bg-gray-50 p-8 text-center">
                                                    <p class="font-mono text-sm text-gray-500 mb-2">No sea service
                                                        recorded.</p>
                                                    <p class="font-mono text-xs text-gray-400">Add your vessel history
                                                        here.</p>
                                                </div>
                                            @endif

                                            <div class="space-y-4">
                                                @foreach ($seaExperiences as $index => $seaExp)
                                                    <div x-data="{
                                                        expanded: {{ empty($seaExp['vessel_name']) ? 'true' : 'false' }},
                                                        vessel: @entangle("seaExperiences.{$index}.vessel_name"),
                                                        rank: @entangle("seaExperiences.{$index}.rank"),
                                                        isCurrent: @entangle("seaExperiences.{$index}.is_current")
                                                    }"
                                                        class="border-2 border-black bg-white transition-all duration-200"
                                                        :class="expanded ? 'shadow-[8px_8px_0px_0px_black] -translate-y-1' :
                                                            'hover:shadow-[4px_4px_0px_0px_black] hover:-translate-y-[2px]'">

                                                        {{-- Accordion Header --}}
                                                        <div @click="expanded = !expanded"
                                                            class="flex justify-between items-center p-4 cursor-pointer select-none group"
                                                            :class="expanded ? 'bg-black text-white border-b-2 border-black' :
                                                                'bg-white text-black'">

                                                            <div class="flex items-center gap-4">
                                                                <div class="transition-transform duration-200"
                                                                    :class="expanded ? 'rotate-180' : ''">
                                                                    <i data-lucide="chevron-down" class="w-5 h-5"></i>
                                                                </div>
                                                                <div class="flex flex-col">
                                                                    <span
                                                                        class="font-display font-bold text-lg uppercase tracking-wide"
                                                                        x-text="vessel || 'NEW VESSEL RECORD'"></span>

                                                                    <div class="flex items-center gap-2"
                                                                        x-show="rank">
                                                                        <span
                                                                            class="font-mono text-xs opacity-80 uppercase"
                                                                            x-text="rank"></span>
                                                                    </div>
                                                                    <span x-show="!rank && !expanded"
                                                                        class="font-mono text-[10px] opacity-60 uppercase">Click
                                                                        to edit details</span>
                                                                </div>
                                                            </div>

                                                            <button type="button"
                                                                wire:click="removeSeaExperience({{ $index }})"
                                                                @click.stop
                                                                class="p-2 border-2 border-transparent hover:border-red-500 hover:bg-red-500 hover:text-white transition-colors"
                                                                :class="expanded ? 'text-gray-400 hover:border-white' :
                                                                    'text-gray-400'">
                                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                            </button>
                                                        </div>

                                                        {{-- Accordion Body --}}
                                                        <div x-show="expanded" x-collapse class="p-6 bg-white">
                                                            <div class="grid grid-cols-1 gap-6">

                                                                {{-- BLOCK 1: VESSEL INFO --}}
                                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                                    <div
                                                                        class="md:col-span-2 flex items-center gap-2 mb-2">
                                                                        <i data-lucide="ship"
                                                                            class="w-4 h-4 text-teal-600"></i>
                                                                        <span
                                                                            class="font-mono text-xs font-bold uppercase underline decoration-2 decoration-teal-400">Vessel
                                                                            Details</span>
                                                                    </div>

                                                                    <div>
                                                                        <label
                                                                            class="block font-mono font-bold text-[10px] uppercase mb-1">Vessel
                                                                            Name</label>
                                                                        <input type="text" x-model="vessel"
                                                                            wire:model="seaExperiences.{{ $index }}.vessel_name"
                                                                            placeholder="MV. Example"
                                                                            class="w-full bg-white border-2 border-black p-2 font-bold text-sm focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                                                    </div>
                                                                    <div>
                                                                        <label
                                                                            class="block font-mono font-bold text-[10px] uppercase mb-1">Vessel
                                                                            Type</label>
                                                                        <input type="text"
                                                                            wire:model="seaExperiences.{{ $index }}.vessel_type"
                                                                            placeholder="Bulk Carrier"
                                                                            class="w-full bg-white border-2 border-black p-2 font-medium text-sm focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                                                    </div>
                                                                    <div>
                                                                        <label
                                                                            class="block font-mono font-bold text-[10px] uppercase mb-1">Gross
                                                                            Tonnage (GT)</label>
                                                                        <input type="number"
                                                                            wire:model="seaExperiences.{{ $index }}.gross_tonnage"
                                                                            placeholder="50000"
                                                                            class="w-full bg-white border-2 border-black p-2 font-medium text-sm focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                                                    </div>
                                                                    <div>
                                                                        <label
                                                                            class="block font-mono font-bold text-[10px] uppercase mb-1">Rank
                                                                            /
                                                                            Position</label>
                                                                        <input type="text" x-model="rank"
                                                                            wire:model="seaExperiences.{{ $index }}.rank"
                                                                            placeholder="Chief Officer"
                                                                            class="w-full bg-white border-2 border-black p-2 font-medium text-sm focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                                                    </div>
                                                                </div>

                                                                {{-- BLOCK 2: TECH SPECS --}}
                                                                <div
                                                                    class="border-2 border-black border-dashed p-4 bg-gray-50">
                                                                    <div class="flex items-center gap-2 mb-3">
                                                                        <i data-lucide="settings"
                                                                            class="w-3 h-3 text-gray-500"></i>
                                                                        <span
                                                                            class="font-mono text-[10px] font-bold uppercase text-gray-500">Technical
                                                                            Specs</span>
                                                                    </div>
                                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                                        <div>
                                                                            <label
                                                                                class="block font-mono font-bold text-[10px] uppercase mb-1">Engine
                                                                                Type</label>
                                                                            <input type="text"
                                                                                wire:model="seaExperiences.{{ $index }}.engine_type"
                                                                                placeholder="B&W 6S60MC"
                                                                                class="w-full bg-white border-2 border-black p-2 text-sm focus:outline-none focus:shadow-[2px_2px_0px_0px_black]">
                                                                        </div>
                                                                        <div>
                                                                            <label
                                                                                class="block font-mono font-bold text-[10px] uppercase mb-1">Engine
                                                                                Power (KW)</label>
                                                                            <input type="text"
                                                                                wire:model="seaExperiences.{{ $index }}.engine_power"
                                                                                placeholder="12000"
                                                                                class="w-full bg-white border-2 border-black p-2 text-sm focus:outline-none focus:shadow-[2px_2px_0px_0px_black]">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                {{-- BLOCK 3: CONTRACT & DATES --}}
                                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                                    <div
                                                                        class="md:col-span-2 flex items-center gap-2 mb-2 mt-2">
                                                                        <i data-lucide="calendar-days"
                                                                            class="w-4 h-4 text-teal-600"></i>
                                                                        <span
                                                                            class="font-mono text-xs font-bold uppercase underline decoration-2 decoration-teal-400">Contract
                                                                            & Dates</span>
                                                                    </div>

                                                                    <div>
                                                                        <label
                                                                            class="block font-mono font-bold text-[10px] uppercase mb-1">Company
                                                                            /
                                                                            Owner</label>
                                                                        <input type="text"
                                                                            wire:model="seaExperiences.{{ $index }}.company"
                                                                            placeholder="Maersk Line"
                                                                            class="w-full bg-white border-2 border-black p-2 font-medium text-sm focus:outline-none focus:shadow-[4px_4px_0px_0px_black]">
                                                                    </div>
                                                                    <div>
                                                                        <label
                                                                            class="block font-mono font-bold text-[10px] uppercase mb-1">Contract
                                                                            Type</label>
                                                                        <input type="text"
                                                                            wire:model="seaExperiences.{{ $index }}.contract_type"
                                                                            placeholder="CBA / Private"
                                                                            class="w-full bg-white border-2 border-black p-2 font-medium text-sm focus:outline-none focus:shadow-[4px_4px_0px_0px_black]">
                                                                    </div>

                                                                    <div>
                                                                        <label
                                                                            class="block font-mono font-bold text-[10px] uppercase mb-1">Sign
                                                                            On
                                                                            Date</label>
                                                                        <input type="date"
                                                                            wire:model="seaExperiences.{{ $index }}.sign_on"
                                                                            class="w-full bg-white border-2 border-black p-2 font-mono text-sm focus:outline-none focus:shadow-[4px_4px_0px_0px_black]">
                                                                    </div>
                                                                    <div class="relative">
                                                                        <label
                                                                            class="block font-mono font-bold text-[10px] uppercase mb-1">Sign
                                                                            Off
                                                                            Date</label>
                                                                        <input type="date"
                                                                            wire:model="seaExperiences.{{ $index }}.sign_off"
                                                                            :disabled="isCurrent"
                                                                            class="w-full border-2 border-black p-2 font-mono text-sm focus:outline-none transition-all"
                                                                            :class="isCurrent ?
                                                                                'bg-gray-200 text-gray-400 cursor-not-allowed' :
                                                                                'bg-white focus:shadow-[4px_4px_0px_0px_black]'">
                                                                    </div>

                                                                    <div class="md:col-span-2">
                                                                        <label
                                                                            class="flex items-center gap-2 cursor-pointer bg-teal-50 border-2 border-black border-dashed p-3 hover:bg-teal-100 transition-colors w-fit">
                                                                            <input type="checkbox" x-model="isCurrent"
                                                                                wire:model="seaExperiences.{{ $index }}.is_current"
                                                                                class="w-4 h-4 text-teal-600 border-2 border-black rounded-none focus:ring-0">
                                                                            <span
                                                                                class="font-mono text-xs font-bold uppercase">Currently
                                                                                Onboard</span>
                                                                        </label>
                                                                    </div>
                                                                </div>

                                                                {{-- BLOCK 4: EXTRA INFO --}}
                                                                <div>
                                                                    <label
                                                                        class="block font-mono font-bold text-[10px] uppercase mb-1">Sailing
                                                                        Area</label>
                                                                    <input type="text"
                                                                        wire:model="seaExperiences.{{ $index }}.sailing_area"
                                                                        placeholder="Worldwide / South East Asia"
                                                                        class="w-full bg-white border-2 border-black p-2 text-sm mb-4 focus:outline-none focus:shadow-[4px_4px_0px_0px_black]">

                                                                    <label
                                                                        class="block font-mono font-bold text-[10px] uppercase mb-1">Duties
                                                                        &
                                                                        Responsibilities</label>
                                                                    <textarea wire:model="seaExperiences.{{ $index }}.duties" rows="2"
                                                                        placeholder="Watchkeeping, Cargo Operation..."
                                                                        class="w-full bg-white border-2 border-black p-2 text-sm mb-4 focus:outline-none focus:shadow-[4px_4px_0px_0px_black]"></textarea>

                                                                    <label
                                                                        class="block font-mono font-bold text-[10px] uppercase mb-1">Additional
                                                                        Notes</label>
                                                                    <textarea wire:model="seaExperiences.{{ $index }}.notes" rows="2"
                                                                        placeholder="Promoted during contract..."
                                                                        class="w-full bg-white border-2 border-black p-2 text-sm focus:outline-none focus:shadow-[4px_4px_0px_0px_black]"></textarea>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        {{-- ===================================================
         2. DOCUMENTS & CERTIFICATES (Orange Theme)
         =================================================== --}}
                                        <div>
                                            {{-- Header --}}
                                            <div
                                                class="flex justify-between items-end mb-6 pt-8 border-t-2 border-black border-dashed">
                                                <div class="flex items-center gap-3">
                                                    <div
                                                        class="w-10 h-10 bg-orange-400 text-black flex items-center justify-center border-2 border-black">
                                                        <i data-lucide="file-text" class="w-5 h-5"></i>
                                                    </div>
                                                    <div>
                                                        <h4
                                                            class="font-display text-2xl font-bold uppercase leading-none">
                                                            Documents</h4>
                                                        <p class="font-mono text-[10px] text-gray-500 uppercase mt-1">
                                                            Passports & COCs</p>
                                                    </div>
                                                </div>

                                                <button type="button" wire:click="addDocument"
                                                    class="group flex items-center gap-2 px-4 py-2 bg-white border-2 border-black text-xs font-mono font-bold uppercase hover:bg-black hover:text-white transition-all shadow-[4px_4px_0px_0px_black] active:translate-x-[2px] active:translate-y-[2px] active:shadow-none">
                                                    <i data-lucide="plus" class="w-4 h-4"></i>
                                                    <span>Add New</span>
                                                </button>
                                            </div>

                                            <div class="space-y-4">
                                                @foreach ($documents as $index => $document)
                                                    <div x-data="{
                                                        expanded: {{ empty($document['name']) ? 'true' : 'false' }},
                                                        name: @entangle("documents.{$index}.name")
                                                    }"
                                                        class="border-2 border-black bg-white transition-all duration-200"
                                                        :class="expanded ? 'shadow-[8px_8px_0px_0px_black] -translate-y-1' :
                                                            'hover:shadow-[4px_4px_0px_0px_black] hover:-translate-y-[2px]'">

                                                        <div @click="expanded = !expanded"
                                                            class="flex justify-between items-center p-4 cursor-pointer select-none group"
                                                            :class="expanded ? 'bg-black text-white border-b-2 border-black' :
                                                                'bg-white text-black'">

                                                            <div class="flex items-center gap-4">
                                                                <div class="transition-transform duration-200"
                                                                    :class="expanded ? 'rotate-180' : ''">
                                                                    <i data-lucide="chevron-down" class="w-5 h-5"></i>
                                                                </div>
                                                                <div class="flex flex-col">
                                                                    <span
                                                                        class="font-display font-bold text-lg uppercase tracking-wide"
                                                                        x-text="name || 'NEW DOCUMENT'"></span>
                                                                </div>
                                                            </div>

                                                            <button type="button"
                                                                wire:click="removeDocument({{ $index }})"
                                                                @click.stop
                                                                class="p-2 border-2 border-transparent hover:border-red-500 hover:bg-red-500 hover:text-white transition-colors"
                                                                :class="expanded ? 'text-gray-400 hover:border-white' :
                                                                    'text-gray-400'">
                                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                            </button>
                                                        </div>

                                                        <div x-show="expanded" x-collapse class="p-6 bg-white">
                                                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                                                <div>
                                                                    <label
                                                                        class="block font-mono font-bold text-xs uppercase mb-2">Document
                                                                        Name</label>
                                                                    <input type="text" x-model="name"
                                                                        wire:model="documents.{{ $index }}.name"
                                                                        placeholder="e.g. Passport, Seaman Book"
                                                                        class="w-full bg-white border-2 border-black p-3 font-bold focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                                                </div>
                                                                <div>
                                                                    <label
                                                                        class="block font-mono font-bold text-xs uppercase mb-2">Issuing
                                                                        Country</label>
                                                                    <input type="text"
                                                                        wire:model="documents.{{ $index }}.country"
                                                                        placeholder="e.g. Indonesia"
                                                                        class="w-full bg-white border-2 border-black p-3 font-medium focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                                                </div>
                                                                <div>
                                                                    <label
                                                                        class="block font-mono font-bold text-xs uppercase mb-2">Expiration
                                                                        Date</label>
                                                                    <input type="date"
                                                                        wire:model="documents.{{ $index }}.expiration_date"
                                                                        class="w-full bg-white border-2 border-black p-3 font-mono font-bold focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                    </div>
                                @endif

                                @if ($currentStep == 6)
                                    <div class="animate-fade-in-up space-y-12">

                                        <!-- HEADER SECTION -->
                                        <div
                                            class="border-b-2 border-black pb-6 flex flex-col md:flex-row md:items-end justify-between gap-4">
                                            <div>
                                                <h3
                                                    class="font-display text-4xl font-bold uppercase tracking-tighter text-black leading-none">
                                                    Final Check
                                                </h3>
                                                <p
                                                    class="font-mono text-sm text-gray-500 mt-2 bg-gray-200 inline-block px-2 border border-black shadow-[2px_2px_0px_0px_black]">
                                                    Step 06: Review & Submit
                                                </p>
                                            </div>
                                            <div class="text-right hidden md:block">
                                                <p class="text-xs font-mono text-gray-400">One last look.</p>
                                                <p class="text-xs font-mono text-gray-400">Make it perfect.</p>
                                            </div>
                                        </div>

                                        <!-- SUMMARY STATS (Top Bar) -->
                                        <div
                                            class="grid grid-cols-3 gap-0 border-2 border-black divide-x-2 divide-black bg-white shadow-[4px_4px_0px_0px_black]">
                                            <div class="p-4 text-center hover:bg-gray-50 transition-colors">
                                                <span
                                                    class="block font-display text-3xl font-bold">{{ count($educations) + count($experiences) }}</span>
                                                <span class="font-mono text-[10px] uppercase text-gray-500">History
                                                    Items</span>
                                            </div>
                                            <div class="p-4 text-center hover:bg-gray-50 transition-colors">
                                                <span
                                                    class="block font-display text-3xl font-bold text-accent-blue">{{ count($hardSkills) + count($softSkills) }}</span>
                                                <span class="font-mono text-[10px] uppercase text-gray-500">Total
                                                    Skills</span>
                                            </div>
                                            <div class="p-4 text-center hover:bg-gray-50 transition-colors">
                                                <span
                                                    class="block font-display text-3xl font-bold text-green-600">{{ count($achievements) + count($certifications) }}</span>
                                                <span
                                                    class="font-mono text-[10px] uppercase text-gray-500">Credentials</span>
                                            </div>
                                        </div>

                                        <div class="grid grid-cols-1 gap-8">

                                            {{-- 1. PERSONAL INFO (White Card) --}}
                                            <div class="border-2 border-black p-6 bg-white relative">
                                                <div
                                                    class="flex justify-between items-start mb-6 border-b-2 border-black pb-4 border-dashed">
                                                    <h4
                                                        class="font-display text-xl font-bold uppercase flex items-center gap-2">
                                                        <i data-lucide="user" class="w-5 h-5"></i> Personal Info
                                                    </h4>
                                                    <button wire:click="goToStep(1)"
                                                        class="text-xs font-mono font-bold uppercase underline hover:text-accent-blue">Edit</button>
                                                </div>

                                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                                    <div>
                                                        <p class="font-mono text-[10px] uppercase text-gray-400 mb-1">
                                                            Full Name</p>
                                                        <p class="font-bold text-lg">{{ $first_name }}
                                                            {{ $last_name }}</p>
                                                    </div>
                                                    <div>
                                                        <p class="font-mono text-[10px] uppercase text-gray-400 mb-1">
                                                            Target Role</p>
                                                        <p class="font-bold">{{ $job_title ?: '-' }}</p>
                                                    </div>
                                                    <div>
                                                        <p class="font-mono text-[10px] uppercase text-gray-400 mb-1">
                                                            Contact</p>
                                                        <p class="text-sm font-medium">{{ $email }}</p>
                                                        <p class="text-sm font-medium">{{ $phone }}</p>
                                                    </div>
                                                    <div>
                                                        <p class="font-mono text-[10px] uppercase text-gray-400 mb-1">
                                                            Details</p>
                                                        <p class="text-sm">{{ $address ?: '-' }}</p>
                                                        <p class="text-sm">
                                                            {{ $birthdate ? \Carbon\Carbon::parse($birthdate)->format('d M Y') : '-' }}
                                                            •
                                                            {{ ucfirst($gender) ?: '-' }}
                                                        </p>
                                                    </div>
                                                </div>

                                                @if ($summary)
                                                    <div
                                                        class="mt-6 p-4 bg-gray-50 border border-black border-dashed">
                                                        <p class="font-mono text-[10px] uppercase text-gray-400 mb-2">
                                                            Professional Summary</p>
                                                        <p class="text-sm italic leading-relaxed text-gray-600">
                                                            "{{ \Illuminate\Support\Str::limit($summary, 150) }}"</p>
                                                    </div>
                                                @endif
                                            </div>

                                            {{-- 2. HISTORY (Black & White) --}}
                                            <div
                                                class="border-2 border-black p-6 bg-white relative shadow-[8px_8px_0px_0px_#e5e7eb]">
                                                <div
                                                    class="flex justify-between items-start mb-6 border-b-2 border-black pb-4 border-dashed">
                                                    <h4
                                                        class="font-display text-xl font-bold uppercase flex items-center gap-2">
                                                        <i data-lucide="briefcase" class="w-5 h-5"></i> History
                                                    </h4>
                                                    <button wire:click="goToStep(2)"
                                                        class="text-xs font-mono font-bold uppercase underline hover:text-accent-blue">Edit</button>
                                                </div>

                                                <div class="space-y-4">
                                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                                        <div class="p-4 border border-black bg-gray-50">
                                                            <span
                                                                class="block font-display text-2xl font-bold">{{ count($educations) }}</span>
                                                            <span class="text-xs font-mono uppercase">Education
                                                                Entries</span>
                                                            <div class="mt-2 text-xs text-gray-500 truncate">
                                                                {{ collect($educations)->pluck('school')->join(', ') }}
                                                            </div>
                                                        </div>
                                                        <div class="p-4 border border-black bg-gray-50">
                                                            <span
                                                                class="block font-display text-2xl font-bold">{{ count($experiences) }}</span>
                                                            <span class="text-xs font-mono uppercase">Work
                                                                Experiences</span>
                                                            <div class="mt-2 text-xs text-gray-500 truncate">
                                                                {{ collect($experiences)->pluck('company')->join(', ') }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- 3. SKILLS (Accent Border) --}}
                                            <div
                                                class="border-2 border-black p-6 bg-white relative shadow-[8px_8px_0px_0px_#dbeafe]">
                                                <div
                                                    class="flex justify-between items-start mb-6 border-b-2 border-black pb-4 border-dashed">
                                                    <h4
                                                        class="font-display text-xl font-bold uppercase flex items-center gap-2">
                                                        <i data-lucide="cpu" class="w-5 h-5 text-accent-blue"></i>
                                                        Skills
                                                    </h4>
                                                    <button wire:click="goToStep(3)"
                                                        class="text-xs font-mono font-bold uppercase underline hover:text-accent-blue">Edit</button>
                                                </div>

                                                <div class="space-y-4">
                                                    @if (count($hardSkills) > 0)
                                                        <div>
                                                            <p
                                                                class="font-mono text-[10px] uppercase text-gray-400 mb-2">
                                                                Hard Skills</p>
                                                            <div class="flex flex-wrap gap-2">
                                                                @foreach (collect($hardSkills)->take(6) as $skill)
                                                                    <span
                                                                        class="px-2 py-1 border border-black bg-accent-blue text-white text-xs font-bold uppercase">
                                                                        {{ $skill['skill_name'] }}
                                                                    </span>
                                                                @endforeach
                                                                @if (count($hardSkills) > 6)
                                                                    <span
                                                                        class="px-2 py-1 border border-black bg-gray-100 text-xs font-bold">+{{ count($hardSkills) - 6 }}</span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endif

                                                    @if (count($softSkills) > 0)
                                                        <div>
                                                            <p
                                                                class="font-mono text-[10px] uppercase text-gray-400 mb-2">
                                                                Soft Skills</p>
                                                            <div class="flex flex-wrap gap-2">
                                                                @foreach (collect($softSkills)->take(6) as $skill)
                                                                    <span
                                                                        class="px-2 py-1 border border-black bg-green-400 text-black text-xs font-bold uppercase">
                                                                        {{ $skill['skill_name'] }}
                                                                    </span>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            {{-- 4. CREDENTIALS & SEA (Compact Grid) --}}
                                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                                {{-- Credentials --}}
                                                <div
                                                    class="border-2 border-black p-6 bg-white shadow-[8px_8px_0px_0px_#fef3c7]">
                                                    <div class="flex justify-between items-center mb-4">
                                                        <h4 class="font-display text-lg font-bold uppercase">
                                                            Credentials</h4>
                                                        <button wire:click="goToStep(4)"
                                                            class="text-xs font-mono font-bold uppercase underline">Edit</button>
                                                    </div>
                                                    <ul class="space-y-2 text-sm">
                                                        <li
                                                            class="flex justify-between border-b border-gray-200 pb-1">
                                                            <span>Achievements</span>
                                                            <span
                                                                class="font-bold">{{ count($achievements) }}</span>
                                                        </li>
                                                        <li
                                                            class="flex justify-between border-b border-gray-200 pb-1">
                                                            <span>Certifications</span>
                                                            <span
                                                                class="font-bold">{{ count($certifications) }}</span>
                                                        </li>
                                                        <li
                                                            class="flex justify-between border-b border-gray-200 pb-1">
                                                            <span>References</span>
                                                            <span class="font-bold">{{ count($references) }}</span>
                                                        </li>
                                                    </ul>
                                                </div>

                                                {{-- Sea Service --}}
                                                <div
                                                    class="border-2 border-black p-6 bg-white shadow-[8px_8px_0px_0px_#ccfbf1]">
                                                    <div class="flex justify-between items-center mb-4">
                                                        <h4 class="font-display text-lg font-bold uppercase">Maritime
                                                        </h4>
                                                        <button wire:click="goToStep(5)"
                                                            class="text-xs font-mono font-bold uppercase underline">Edit</button>
                                                    </div>
                                                    <ul class="space-y-2 text-sm">
                                                        <li
                                                            class="flex justify-between border-b border-gray-200 pb-1">
                                                            <span>Sea Records</span>
                                                            <span
                                                                class="font-bold">{{ count($seaExperiences) }}</span>
                                                        </li>
                                                        <li
                                                            class="flex justify-between border-b border-gray-200 pb-1">
                                                            <span>Documents</span>
                                                            <span class="font-bold">{{ count($documents) }}</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <!-- AI REVIEWER (Special Section) -->
                                            <div class="mt-8 border-2 border-black border-dashed p-6 bg-gray-50">
                                                <div class="flex items-center gap-2 mb-4">
                                                    <i data-lucide="sparkles" class="w-5 h-5 text-purple-600"></i>
                                                    <h4 class="font-display text-xl font-bold uppercase">AI Quality
                                                        Check</h4>
                                                </div>
                                                @include('livewire.form-step.ai-reviewer')
                                            </div>

                                            <!-- FINAL NOTE -->
                                            <div class="flex items-start gap-4 p-4 bg-black text-white">
                                                <i data-lucide="info" class="w-6 h-6 shrink-0 text-accent-lime"></i>
                                                <div>
                                                    <p
                                                        class="font-bold font-display uppercase text-lg text-accent-lime">
                                                        Ready to Launch?</p>
                                                    <p class="text-xs font-mono opacity-80 mt-1">
                                                        By clicking "Finish & Save", your data will be processed into a
                                                        PDF.
                                                        You can always edit this later from your dashboard.
                                                    </p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                @endif

                            </div>

                            <div class="mt-12 pt-8 border-t-2 border-black border-dashed">
                                {{-- Navigation Buttons Container --}}
                                <div
                                    class="flex justify-between items-center mt-12 pt-8 border-t-2 border-black border-dashed">

                                    {{-- 1. PREVIOUS BUTTON --}}
                                    @if ($currentStep > 1)
                                        <button type="button" wire:click="previousStep"
                                            class="group flex items-center gap-2 px-6 py-3 bg-white border-2 border-black text-black font-mono text-sm font-bold uppercase transition-all hover:bg-black hover:text-white hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,0.2)]">
                                            <i data-lucide="arrow-left"
                                                class="w-4 h-4 transition-transform group-hover:-translate-x-1"></i>
                                            <span>Back</span>
                                        </button>
                                    @else
                                        {{-- Spacer agar tombol Next tetap di kanan --}}
                                        <div></div>
                                    @endif

                                    {{-- 2. NEXT BUTTON --}}
                                    @if ($currentStep < $totalSteps)
                                        <button type="button" wire:click="nextStep"
                                            class="group relative flex items-center gap-3 px-8 py-3 bg-black text-white border-2 border-black font-display font-bold text-sm uppercase tracking-widest shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transition-all hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none hover:bg-accent-blue active:bg-accent-blue/80">
                                            <span>Next Step</span>
                                            <i data-lucide="arrow-right"
                                                class="w-4 h-4 transition-transform group-hover:translate-x-1"></i>

                                            {{-- Loading Spinner (Specific for Next) --}}
                                            <div wire:loading wire:target="nextStep"
                                                class="absolute inset-0 bg-black flex items-center justify-center">
                                                <i data-lucide="loader-2"
                                                    class="w-5 h-5 animate-spin text-white"></i>
                                            </div>
                                        </button>
                                    @else
                                        {{-- 3. SUBMIT / SAVE BUTTON --}}
                                        <button type="button" wire:click="save" wire:loading.attr="disabled"
                                            wire:target="save" @if ($isSubmitted) disabled @endif
                                            class="group relative px-8 py-3 border-2 border-black font-display font-bold text-sm uppercase tracking-widest shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transition-all 
            {{ $isSubmitted
                ? 'bg-gray-200 text-gray-500 cursor-not-allowed shadow-none border-gray-400'
                : 'bg-green-500 text-black hover:bg-green-400 hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none' }}">

                                            {{-- Content Wrapper --}}
                                            <div class="flex items-center gap-2">
                                                {{-- Normal State --}}
                                                <span wire:loading.remove wire:target="save"
                                                    class="flex items-center gap-2">
                                                    @if ($isSubmitted)
                                                        <i data-lucide="check-circle" class="w-5 h-5"></i>
                                                        <span>CV Submitted</span>
                                                    @else
                                                        <span>Finish & Save</span>
                                                        <i data-lucide="save"
                                                            class="w-4 h-4 transition-transform group-hover:scale-110"></i>
                                                    @endif
                                                </span>

                                                {{-- Loading State --}}
                                                <span wire:loading wire:target="save"
                                                    class="flex items-center gap-2">
                                                    <i data-lucide="loader-2" class="w-5 h-5 animate-spin"></i>
                                                    <span>Processing...</span>
                                                </span>
                                            </div>
                                        </button>
                                    @endif
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- PREVIEW AREA (Hidden on Mobile) --}}
            <div class="hidden xl:block xl:col-span-7 bg-gray-50 border-l-2 border-black relative overflow-hidden h-full flex-col"
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
