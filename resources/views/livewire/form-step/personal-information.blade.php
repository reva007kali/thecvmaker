{{-- STEP 1: Personal Information --}}
@if ($currentStep == 1)
    <div>
        <h3 class="text-2xl font-semibold text-gray-800 mb-6">Personal Information</h3>

        <div class="mb-4 flex items-center gap-2">
            <select wire:model="tempSelectedTemplate" class="border p-2">
                @foreach ($template as $t)
                    <option value="{{ $t }}">{{ ucfirst($t) }}</option>
                @endforeach
            </select>

            <button wire:click="applyTemplate" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                Select Template
            </button>
        </div>




        {{-- Photo Upload --}}
        <div class="mb-6">
            <label class="block text-gray-700 font-bold mb-2">Foto CV</label>
            @if ($cv_photo)
                <img src="{{ $cv_photo->temporaryUrl() }}" class="w-32 h-32 object-cover rounded-lg mb-2">
            @elseif($existingPhoto)
                <img src="{{ Storage::url($existingPhoto) }}" class="w-32 h-32 object-cover rounded-lg mb-2">
            @endif
            <input type="file" wire:model="cv_photo" accept="image/*"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
            @error('cv_photo')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Nama Depan *</label>
                <input type="text" wire:model="first_name"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 @error('first_name') border-red-500 @enderror">
                @error('first_name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Nama Belakang</label>
                <input type="text" wire:model="last_name"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Job Title</label>
            <input type="text" wire:model="job_title"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Email *</label>
                <input type="email" wire:model="email"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 @error('email') border-red-500 @enderror">
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Phone *</label>
                <input type="text" wire:model="phone"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 @error('phone') border-red-500 @enderror">
                @error('phone')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 font-bold mb-2">Alamat</label>
            <textarea wire:model="address" rows="3"
                class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600"></textarea>
        </div>

        <div class="grid grid-cols-3 gap-4">
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Tanggal Lahir</label>
                <input type="date" wire:model="birthdate"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Gender</label>
                <select wire:model="gender"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <option value="">Pilih Gender</option>
                    <option value="male">Laki-laki</option>
                    <option value="female">Perempuan</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Status Pernikahan</label>
                <select wire:model="marital_status"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <option value="">Pilih Status</option>
                    <option value="single">Single</option>
                    <option value="married">Menikah</option>
                    <option value="divorced">Cerai</option>
                </select>
            </div>
        </div>

        <!-- Form summary -->
        <div x-data="{ pasted: false, lastCopied: '' }">
            <!-- Form summary -->
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Summary</label>
                <textarea wire:model.defer="summary" rows="4"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600"></textarea>
            </div>

            <!-- Tombol Paste -->
            <button
                x-on:click="
            // ambil teks terakhir dari clipboard atau Alpine state lastCopied
            navigator.clipboard.readText().then(text => {
                $wire.set('summary', text); 
                pasted = true; 
                setTimeout(() => pasted = false, 2000);
            })
        "
                class="px-4 py-2 bg-yellow-500 text-white rounded hover:bg-yellow-600 flex items-center gap-2 transition">
                <template x-if="!pasted">
                    <span>Paste</span>
                </template>
                <template x-if="pasted">
                    <span>Pasted ✅</span>
                </template>
            </button>
        </div>



        @livewire('about-generator')

        <div class="grid grid-cols-2 gap-4">
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Website Link</label>
                <input type="url" wire:model="website_link"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Portfolio Link</label>
                <input type="url" wire:model="portfolio_link"
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
            </div>
        </div>
    </div>
@endif
