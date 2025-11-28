<div x-data="{ showMobilePreview: false }" class="xl:hidden">

    {{-- 1. FLOATING ACTION BUTTON (FAB) --}}
    <button @click="showMobilePreview = true"
        class="fixed bottom-14 right-1/2 translate-x-1/2 z-40 bg-blue-600 text-white px-5 py-3 rounded-full shadow-lg flex items-center gap-2 hover:bg-blue-700 transition active:scale-95">
        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
        </svg>
        <span class="font-bold text-sm">View CV</span>
    </button>

    {{-- 2. FULLSCREEN MODAL PREVIEW --}}
    <div x-show="showMobilePreview" style="display: none;"
        class="fixed inset-0 z-50 bg-gray-900 bg-opacity-95 flex flex-col"
        x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-full"
        x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-full">

        {{-- Modal Header --}}
        <div class="bg-white px-4 py-3 flex justify-between items-center shadow-md z-10">
            <h3 class="font-bold text-gray-800">Preview Result</h3>
            <button @click="showMobilePreview = false" class="text-gray-500 hover:text-red-500 p-1">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        {{-- Modal Body (Scrollable & Zoomable) --}}
        {{-- Kita gunakan logic Pan & Zoom yang sama dengan desktop tapi disesuaikan default scalenya --}}
        <div class="flex-1 overflow-hidden relative bg-gray-800" x-data="{
            scale: 0.45, // Default scale kecil agar muat di HP (A4 width ~800px vs HP ~360px)
            panning: false,
            pointX: 0,
            pointY: 0,
            startX: 0,
            startY: 0,
        
            startDrag(e) {
                // Hanya enable drag jika scale > 0.5 (saat di zoom in)
                // Atau biarkan user scroll bebas
                e.preventDefault();
                this.panning = true;
                // Support Touch Event untuk HP
                let clientX = e.touches ? e.touches[0].clientX : e.clientX;
                let clientY = e.touches ? e.touches[0].clientY : e.clientY;
                this.startX = clientX - this.pointX;
                this.startY = clientY - this.pointY;
            },
            onDrag(e) {
                if (!this.panning) return;
                e.preventDefault(); // Mencegah scroll halaman browser
                let clientX = e.touches ? e.touches[0].clientX : e.clientX;
                let clientY = e.touches ? e.touches[0].clientY : e.clientY;
                this.pointX = clientX - this.startX;
                this.pointY = clientY - this.startY;
            },
            stopDrag() {
                this.panning = false;
            }
        }">

            {{-- Controls Sederhana di Mobile --}}
            <div class="absolute bottom-6 left-1/2 transform -translate-x-1/2 z-20 flex gap-4">
                <button @click="scale -= 0.1"
                    class="bg-white/20 backdrop-blur rounded-full p-3 text-white hover:bg-white/30">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                    </svg>
                </button>
                <span class="text-white font-bold flex items-center" x-text="Math.round(scale * 100) + '%'"></span>
                <button @click="scale += 0.1"
                    class="bg-white/20 backdrop-blur rounded-full p-3 text-white hover:bg-white/30">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                </button>
            </div>

            {{-- Viewport --}}
            <div class="w-full h-full flex items-start justify-center pt-4" @touchstart="startDrag" @touchmove="onDrag"
                @touchend="stopDrag" @mousedown="startDrag" @mousemove="onDrag" @mouseup="stopDrag">

                <div class="origin-top transition-transform duration-100 ease-out shadow-2xl"
                    :style="`transform: translate(${pointX}px, ${pointY}px) scale(${scale});`">

                    {{-- Area A4 --}}
                    <div class="w-[210mm] min-h-[297mm] pointer-events-none">
                        @include('components.templates.' . $template_id)
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
