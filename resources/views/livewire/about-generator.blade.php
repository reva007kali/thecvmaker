<div x-data="{ showModal: false }">

    <!-- Tombol buka modal -->
    <button @click="showModal = true" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
        Buat dengan AI
    </button>

    <!-- Modal backdrop -->
    <div x-show="showModal" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50" style="display: none;"
        @click.self="showModal = false">

        <!-- Modal box -->
        <div x-show="showModal" x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200 transform"
            x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90"
            class="bg-white rounded-xl shadow-lg w-11/12 max-w-xl p-6 max-h-[80vh] overflow-y-auto relative">

            <!-- Tombol Close -->
            <button @click="showModal = false"
                class="absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-lg font-bold">✕</button>

            <h2 class="text-xl font-bold mb-4">AI About Me Generator</h2>

            <!-- Input -->
            <textarea wire:model.defer="inputText" class="w-full p-3 bg-white border rounded mb-3" rows="4"
                placeholder="Tulis sedikit tentang diri kamu di sini..."></textarea>

            <!-- Tombol Generate -->
            <button wire:click="generate" wire:loading.attr="disabled"
                class="bg-blue-600 text-white px-4 py-2 rounded flex items-center gap-2">
                <span wire:loading.remove>Generate About Me</span>
                <span wire:loading>
                    <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"></path>
                    </svg>
                    Generating...
                </span>
            </button>

            <!-- Hasil -->
            <div class="mt-4 p-4 border rounded bg-gray-50 relative">
                <h3 class="font-semibold mb-2">Hasil:</h3>

                <!-- Gunakan x-ref untuk referensi yang aman -->
                <p x-ref="result" class="whitespace-pre-line">{{ $resultText ?: 'Hasil akan muncul di sini...' }}</p>

                <!-- Tombol Copy & Clear -->
                <div class="absolute top-2 right-2 flex gap-2">
                    <button x-data="{ copied: false }"
                        x-on:click="
        navigator.clipboard.writeText($refs.result.innerText); 
        copied = true; 
        setTimeout(() => copied = false, 2000)"
                        class="px-2 py-1 bg-green-500 text-white rounded hover:bg-green-600 text-sm flex items-center gap-1">

                        <template x-if="!copied">
                            <span>Copy</span>
                        </template>

                        <template x-if="copied">
                            <span>Copied ✅</span>
                        </template>
                    </button>

                    <button wire:click="$set('resultText', '')"
                        class="px-2 py-1 bg-red-500 text-white rounded hover:bg-red-600 text-sm">
                        Clear
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
