@if ($currentStep == 1)
    <div class="animate-fade-in-up space-y-12">

        <!-- HEADER SECTION -->
        <div class="border-b-2 border-black pb-6 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h3 class="font-display text-4xl font-bold uppercase tracking-tighter text-black leading-none">
                    Personal Info
                </h3>
                <p class="font-mono text-sm text-gray-500 mt-2 bg-yellow-300 inline-block px-2 border border-black shadow-[2px_2px_0px_0px_black]">
                    Step 01: The Basics
                </p>
            </div>
            <div class="text-right hidden md:block">
                <p class="text-xs font-mono text-gray-400">Please ensure data accuracy.</p>
                <p class="text-xs font-mono text-gray-400">Mistakes = Rejection.</p>
            </div>
        </div>

        <!-- 1. VISUAL TEMPLATE SELECTOR -->
        <div>
            <label class="block font-display font-bold text-lg mb-4 uppercase">Select Style</label>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Simple Template Card -->
                <label class="cursor-pointer group relative">
                    <input type="radio" wire:model.blur="template_id" value="1" class="peer sr-only">
                    <div class="p-5 border-2 border-black bg-white transition-all duration-200 
                                hover:-translate-y-1 hover:shadow-[6px_6px_0px_0px_black]
                                peer-checked:bg-black peer-checked:text-white peer-checked:shadow-[6px_6px_0px_0px_#d9f99d]">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 border-2 border-black bg-gray-100 flex items-center justify-center peer-checked:bg-white peer-checked:text-black">
                                <i data-lucide="layout" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <h4 class="font-bold font-display text-xl uppercase">Swiss Clean</h4>
                                <p class="text-xs font-mono opacity-70">Minimalist & Formal</p>
                            </div>
                            <div class="ml-auto opacity-0 peer-checked:opacity-100 transition-opacity">
                                <i data-lucide="check-circle" class="w-6 h-6 text-accent-lime"></i>
                            </div>
                        </div>
                    </div>
                </label>

                <!-- Modern Template Card -->
                <label class="cursor-pointer group relative">
                    <input type="radio" wire:model.blur="template_id" value="2" class="peer sr-only">
                    <div class="p-5 border-2 border-black bg-white transition-all duration-200 
                                hover:-translate-y-1 hover:shadow-[6px_6px_0px_0px_black]
                                peer-checked:bg-accent-blue peer-checked:text-white peer-checked:shadow-[6px_6px_0px_0px_black]">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 border-2 border-black bg-blue-100 flex items-center justify-center peer-checked:bg-white peer-checked:text-blue-600">
                                <i data-lucide="layers" class="w-6 h-6"></i>
                            </div>
                            <div>
                                <h4 class="font-bold font-display text-xl uppercase">Neo Pop</h4>
                                <p class="text-xs font-mono opacity-70">Bold & Creative</p>
                            </div>
                            <div class="ml-auto opacity-0 peer-checked:opacity-100 transition-opacity">
                                <i data-lucide="check-circle" class="w-6 h-6 text-white"></i>
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
                <label class="block font-mono font-bold text-xs uppercase mb-2">Profile Picture</label>
                <div class="relative group cursor-pointer w-40 h-40">
                    <div class="w-full h-full border-2 border-black bg-gray-100 relative overflow-hidden shadow-[4px_4px_0px_0px_black]">
                        @if ($cv_photo)
                            <img src="{{ $cv_photo->temporaryUrl() }}" class="w-full h-full object-cover">
                        @elseif($existingPhoto)
                            <img src="{{ Storage::url($existingPhoto) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-gray-400 gap-2 bg-white">
                                <i data-lucide="camera" class="w-8 h-8"></i>
                                <span class="text-[10px] font-mono uppercase text-center px-2">Upload<br>Photo</span>
                            </div>
                        @endif

                        <!-- Hover Overlay -->
                        <div class="absolute inset-0 bg-black/80 hidden group-hover:flex flex-col items-center justify-center transition-all text-white gap-2">
                            <i data-lucide="upload-cloud" class="w-8 h-8"></i>
                            <span class="font-mono text-xs uppercase">Change</span>
                        </div>
                    </div>
                    
                    <input type="file" wire:model.blur="cv_photo" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">

                    <!-- Loading State -->
                    <div wire:loading wire:target="cv_photo" class="absolute inset-0 flex items-center justify-center bg-white border-2 border-black z-20">
                        <i data-lucide="loader-2" class="animate-spin w-8 h-8 text-black"></i>
                    </div>
                </div>
                @error('cv_photo') <span class="text-red-600 font-bold text-xs mt-2 block bg-red-100 p-1 border border-red-500">{{ $message }}</span> @enderror
            </div>

            <!-- Inputs -->
            <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Job Title -->
                <div class="col-span-1 md:col-span-2">
                    <label class="block font-mono font-bold text-xs uppercase mb-2">Target Role / Job Title</label>
                    <input type="text" wire:model.blur="job_title" placeholder="E.g. Senior Product Designer"
                        class="w-full bg-white border-2 border-black p-3 font-bold placeholder:font-normal placeholder:text-gray-400 focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                </div>

                <!-- First Name -->
                <div>
                    <label class="block font-mono font-bold text-xs uppercase mb-2">First Name <span class="text-red-500">*</span></label>
                    <input type="text" wire:model.blur="first_name" placeholder="John"
                        class="w-full bg-white border-2 border-black p-3 font-bold focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow @error('first_name') border-red-500 bg-red-50 @enderror">
                    @error('first_name') <span class="text-red-600 text-xs font-bold mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Last Name -->
                <div>
                    <label class="block font-mono font-bold text-xs uppercase mb-2">Last Name</label>
                    <input type="text" wire:model.blur="last_name" placeholder="Doe"
                        class="w-full bg-white border-2 border-black p-3 font-bold focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                </div>

                <!-- Address -->
                <div class="col-span-1 md:col-span-2">
                    <label class="block font-mono font-bold text-xs uppercase mb-2">Domicile Address</label>
                    <div class="relative">
                        <div class="absolute top-3 left-3 pointer-events-none">
                            <i data-lucide="map-pin" class="w-5 h-5 text-gray-400"></i>
                        </div>
                        <input type="text" wire:model.blur="address" placeholder="Jalan Jenderal Sudirman No. 1, Jakarta"
                            class="w-full bg-white border-2 border-black p-3 pl-10 font-medium focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. CONTACT & DEMOGRAPHICS (Card Style) -->
        <div class="border-2 border-black p-6 bg-gray-50 relative">
            <div class="absolute -top-3 left-4 bg-black text-white px-2 py-1 text-xs font-mono font-bold uppercase">
                Contact & Details
            </div>

            <div class=" space-y-6 mt-2">
                <!-- Email -->
                <div>
                    <label class="block font-mono font-bold text-xs uppercase mb-2">Email <span class="text-red-500">*</span></label>
                    <input type="email" wire:model.blur="email" placeholder="you@example.com"
                        class="w-full bg-white border-2 border-black p-3 font-medium focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow @error('email') border-red-500 @enderror">
                    @error('email') <span class="text-red-600 text-xs font-bold mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label class="block font-mono font-bold text-xs uppercase mb-2">Phone <span class="text-red-500">*</span></label>
                    <input type="text" wire:model.blur="phone" placeholder="0812..."
                        class="w-full bg-white border-2 border-black p-3 font-medium focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow @error('phone') border-red-500 @enderror">
                    @error('phone') <span class="text-red-600 text-xs font-bold mt-1 block">{{ $message }}</span> @enderror
                </div>

                <!-- Birthdate -->
                <div class="col-span-2 md:col-span-1">
                    {{-- Pastikan component x-date-selector juga menyesuaikan style jika bisa, atau bungkus div ini --}}
                    <div class="[&_input]:border-2 [&_input]:border-black [&_input]:rounded-none [&_input]:p-3 [&_input]:w-full [&_input]:focus:shadow-[4px_4px_0px_0px_black] [&_label]:font-mono [&_label]:font-bold [&_label]:text-xs [&_label]:uppercase [&_label]:mb-2">
                        <x-date-selector label="Date of Birth" wire:model.blur="birthdate" />
                    </div>
                </div>

                <!-- Gender -->
                <div>
                    <label class="block font-mono font-bold text-xs uppercase mb-2">Gender</label>
                    <div class="relative">
                        <select wire:model.blur="gender" class="w-full bg-white border-2 border-black p-3 appearance-none font-medium focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                            <option value="">Select...</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                        <i data-lucide="chevron-down" class="absolute right-3 top-3.5 w-5 h-5 pointer-events-none"></i>
                    </div>
                </div>

                <!-- Marital Status -->
                <div>
                    <label class="block font-mono font-bold text-xs uppercase mb-2">Marital Status</label>
                    <div class="relative">
                        <select wire:model.blur="marital_status" class="w-full bg-white border-2 border-black p-3 appearance-none font-medium focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                            <option value="">Select...</option>
                            <option value="single">Single</option>
                            <option value="married">Married</option>
                            <option value="divorced">Divorced</option>
                        </select>
                        <i data-lucide="chevron-down" class="absolute right-3 top-3.5 w-5 h-5 pointer-events-none"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4. SUMMARY SECTION -->
        <div x-data="{ pasted: false }">
            <div class="flex justify-between items-end mb-2">
                <label class="font-display font-bold text-xl uppercase">Professional Summary</label>
                
                <button type="button"
                    @click="navigator.clipboard.readText().then(text => { $wire.set('summary', text); pasted = true; setTimeout(() => pasted = false, 2000); })"
                    class="group flex items-center gap-2 px-3 py-1 bg-white border-2 border-black text-xs font-mono font-bold hover:bg-black hover:text-white transition-all shadow-[2px_2px_0px_0px_black] active:translate-x-[1px] active:translate-y-[1px] active:shadow-none">
                    <template x-if="!pasted">
                        <div class="flex items-center gap-2">
                            <i data-lucide="clipboard" class="w-3 h-3"></i> PASTE
                        </div>
                    </template>
                    <template x-if="pasted">
                        <div class="flex items-center gap-2 text-green-500 group-hover:text-green-300">
                            <i data-lucide="check" class="w-3 h-3"></i> DONE!
                        </div>
                    </template>
                </button>
            </div>

            <textarea wire:model.blur.defer="summary" rows="6"
                placeholder="Briefly describe your experience, superpowers, and what you bring to the table..."
                class="w-full bg-white border-2 border-black p-4 font-sans text-sm leading-relaxed focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow"></textarea>

            <!-- AI Generator Wrapper -->
            <div class="mt-4 p-4 border-2 border-black border-dashed bg-gray-50">
                <div class="flex items-center gap-2 mb-2">
                    <i data-lucide="sparkles" class="w-4 h-4 text-accent-blue"></i>
                    <span class="font-mono text-xs font-bold uppercase text-gray-500">Lazy? Use AI</span>
                </div>
                @livewire('about-generator')
            </div>
        </div>

        <!-- 5. LINKS SECTION -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t-2 border-black">
            <div>
                <label class="block font-mono font-bold text-xs uppercase mb-2">Website Link</label>
                <div class="relative">
                    <div class="absolute top-3 left-3 pointer-events-none">
                        <i data-lucide="globe" class="w-5 h-5 text-gray-400"></i>
                    </div>
                    <input type="url" wire:model.blur="website_link" placeholder="https://mysite.com"
                        class="w-full bg-white border-2 border-black p-3 pl-10 font-mono text-sm focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                </div>
            </div>
            <div>
                <label class="block font-mono font-bold text-xs uppercase mb-2">Portfolio Link</label>
                <div class="relative">
                    <div class="absolute top-3 left-3 pointer-events-none">
                        <i data-lucide="briefcase" class="w-5 h-5 text-gray-400"></i>
                    </div>
                    <input type="url" wire:model.blur="portfolio_link" placeholder="https://behance.net/..."
                        class="w-full bg-white border-2 border-black p-3 pl-10 font-mono text-sm focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                </div>
            </div>
        </div>

    </div>
@endif