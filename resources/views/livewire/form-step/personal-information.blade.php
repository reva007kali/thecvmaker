@if ($currentStep == 1)
    <div class="animate-fade-in-up">

        <!-- Header Section -->
        <div class="mb-8 border-b border-gray-100 pb-4">
            <h3 class="text-2xl font-bold text-gray-800">Personal Information</h3>
            <p class="text-sm text-gray-500 mt-1">Lengkapi data diri Anda untuk memulai CV yang profesional.</p>
        </div>

        <!-- 1. VISUAL TEMPLATE SELECTOR -->
        <div class="mb-8">
            <label class="block text-sm font-semibold text-gray-700 mb-3">Pilih Gaya Template</label>
            <div class="grid grid-cols-2 gap-4">
                <!-- Simple Template Card -->
                <label class="cursor-pointer relative group">
                    <input type="radio" wire:model.live="template_id" value="1" class="peer sr-only">
                    <div
                        class="p-4 rounded-xl border-2 transition-all duration-200 
                        peer-checked:border-blue-600 peer-checked:bg-blue-50/50 
                        border-gray-200 hover:border-blue-300 bg-white">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800 text-sm">Simple Clean</h4>
                                <p class="text-xs text-gray-500">Minimalis & Formal</p>
                            </div>
                            <!-- Checkmark Icon -->
                            <div
                                class="absolute top-4 right-4 opacity-0 peer-checked:opacity-100 text-blue-600 transition-opacity">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </label>

                <!-- Modern Template Card -->
                <label class="cursor-pointer relative group">
                    <input type="radio" wire:model.live="template_id" value="2" class="peer sr-only">
                    <div
                        class="p-4 rounded-xl border-2 transition-all duration-200 
                        peer-checked:border-blue-600 peer-checked:bg-blue-50/50 
                        border-gray-200 hover:border-blue-300 bg-white">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-10 h-10 rounded-full bg-blue-100 flex items-center justify-center text-blue-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-gray-800 text-sm">Modern Creative</h4>
                                <p class="text-xs text-gray-500">Elegan & Berwarna</p>
                            </div>
                            <div
                                class="absolute top-4 right-4 opacity-0 peer-checked:opacity-100 text-blue-600 transition-opacity">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </label>
            </div>
        </div>

        <!-- 2. PHOTO & BASIC INFO -->
        <div class="flex flex-col md:flex-row gap-8 mb-8">
            <!-- Photo Uploader -->
            <div class="shrink-0 flex flex-col items-center">
                <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Profil</label>
                <div class="relative group cursor-pointer w-32 h-32">
                    <div
                        class="w-32 h-32 rounded-full overflow-hidden border-4 border-white shadow-lg bg-gray-100 relative">
                        @if ($cv_photo)
                            <img src="{{ $cv_photo->temporaryUrl() }}" class="w-full h-full object-cover">
                        @elseif($existingPhoto)
                            <img src="{{ Storage::url($existingPhoto) }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center text-gray-300">
                                <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                            </div>
                        @endif

                        <!-- Hover Overlay -->
                        <div
                            class="absolute inset-0 bg-black/40 hidden group-hover:flex items-center justify-center transition-all">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z">
                                </path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <!-- Hidden File Input -->
                    <input type="file" wire:model="cv_photo" accept="image/*"
                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">

                    <!-- Loading State -->
                    <div wire:loading wire:target="cv_photo"
                        class="absolute inset-0 flex items-center justify-center bg-white/80 rounded-full z-20">
                        <svg class="animate-spin h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                    </div>
                </div>
                @error('cv_photo')
                    <span class="text-red-500 text-xs mt-1 text-center block">{{ $message }}</span>
                @enderror
            </div>

            <!-- Name & Title Inputs -->
            <div class="flex-1 grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Job Title / Posisi Dilamar</label>
                    <input type="text" wire:model.blur="job_title" placeholder="e.g. Senior Software Engineer"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Depan <span
                            class="text-red-500">*</span></label>
                    <input type="text" wire:model.blur="first_name" placeholder="John"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition @error('first_name') border-red-500 @enderror">
                    @error('first_name')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Nama Belakang</label>
                    <input type="text" wire:model.blur="last_name" placeholder="Doe"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                </div>
                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Alamat Domisili</label>
                    <input type="text" wire:model.blur="address" placeholder="Jalan Sudirman No. 1, Jakarta"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition">
                </div>
            </div>
        </div>

        <!-- 3. CONTACT & DEMOGRAPHICS -->
        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200 mb-8">
            <h4 class="text-sm font-bold text-gray-500 uppercase tracking-wide mb-4">Kontak & Info Lainnya</h4>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-5">
                <!-- Email -->
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Email <span
                            class="text-red-500">*</span></label>
                    <div class="relative">
                        <div
                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <input type="email" wire:model.blur="email" placeholder="email@example.com"
                            class="pl-10 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 text-sm @error('email') border-red-500 @enderror">
                    </div>
                    @error('email')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Phone -->
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">No. Telepon <span
                            class="text-red-500">*</span></label>
                    <div class="relative">
                        <div
                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                </path>
                            </svg>
                        </div>
                        <input type="text" wire:model.blur="phone" placeholder="0812..."
                            class="pl-10 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 text-sm @error('phone') border-red-500 @enderror">
                    </div>
                    @error('phone')
                        <span class="text-red-500 text-xs">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Birthdate -->
                <div class="col-span-2">
                    <x-date-selector label="Tanggal Lahir" wire:model="birthdate" />
                </div>

                <!-- Gender -->
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Gender</label>
                    <select wire:model.blur="gender"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 text-sm bg-white">
                        <option value="">Pilih...</option>
                        <option value="male">Laki-laki</option>
                        <option value="female">Perempuan</option>
                    </select>
                </div>

                <!-- Marital Status -->
                <div>
                    <label class="block text-xs font-semibold text-gray-600 mb-1">Status Pernikahan</label>
                    <select wire:model.blur="marital_status"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 text-sm bg-white">
                        <option value="">Pilih...</option>
                        <option value="single">Single</option>
                        <option value="married">Menikah</option>
                        <option value="divorced">Cerai</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- 4. SMART SUMMARY SECTION -->
        <div x-data="{ pasted: false }" class="mb-8">
            <div class="flex justify-between items-center mb-2">
                <label class="text-sm font-semibold text-gray-700">Professional Summary</label>

                <!-- Action Toolbar -->
                <div class="flex items-center gap-2">
                    {{-- Paste Button --}}
                    <button type="button"
                        @click="navigator.clipboard.readText().then(text => { $wire.set('summary', text); pasted = true; setTimeout(() => pasted = false, 2000); })"
                        class="text-xs flex items-center gap-1 px-2 py-1 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded transition">
                        <template x-if="!pasted">
                            <span class="flex items-center gap-1">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                    </path>
                                </svg>
                                Paste
                            </span>
                        </template>
                        <template x-if="pasted">
                            <span class="flex items-center gap-1 text-green-600 font-bold">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                                Pasted!
                            </span>
                        </template>
                    </button>
                </div>
            </div>

            <div class="relative">
                <textarea wire:model.defer="summary" rows="5"
                    placeholder="Jelaskan pengalaman dan keahlian utama Anda secara singkat..."
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-sm leading-relaxed"></textarea>

                <!-- Helper Text -->
                <p class="text-xs text-gray-400 mt-1 text-right">Disarankan: 2-3 kalimat yang kuat.</p>
            </div>

            <!-- AI Generator Component (Integrated) -->
            <div class="mt-4 border-t border-gray-100 pt-4">
                @livewire('about-generator')
            </div>
        </div>

        <!-- 5. LINKS SECTION -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1">Website Link</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9">
                            </path>
                        </svg>
                    </div>
                    <input type="url" wire:model.blur="website_link" placeholder="https://mysite.com"
                        class="pl-10 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 text-sm">
                </div>
            </div>
            <div>
                <label class="block text-xs font-semibold text-gray-600 mb-1">Portfolio Link</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                            </path>
                        </svg>
                    </div>
                    <input type="url" wire:model.blur="portfolio_link" placeholder="https://behance.net/..."
                        class="pl-10 w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 text-sm">
                </div>
            </div>
        </div>

    </div>
@endif
