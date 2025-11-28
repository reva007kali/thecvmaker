<div class="hidden xl:block xl:col-span-3 h-full bg-slate-100 relative overflow-hidden border-l border-gray-200"
    x-data="{
        scale: 0.70, // Default zoom (70%)
        panning: false,
        pointX: 0,
        pointY: 0,
        startX: 0,
        startY: 0,
    
        // Fungsi Zoom In
        zoomIn() {
            if (this.scale < 3) this.scale += 0.1;
        },
    
        // Fungsi Zoom Out
        zoomOut() {
            if (this.scale > 0.3) this.scale -= 0.1;
        },
    
        // Fungsi Reset ke Default
        reset() {
            this.scale = 0.70;
            this.pointX = 0;
            this.pointY = 0;
        },
    
        // Fungsi Mouse Wheel (Scroll untuk Zoom)
        handleWheel(e) {
            e.preventDefault();
            const delta = e.deltaY > 0 ? -0.1 : 0.1;
            const newScale = this.scale + delta;
            if (newScale >= 0.3 && newScale <= 3) {
                this.scale = newScale;
            }
        },
    
        // Fungsi Mulai Drag (MouseDown)
        startDrag(e) {
            this.panning = true;
            this.startX = e.clientX - this.pointX;
            this.startY = e.clientY - this.pointY;
        },
    
        // Fungsi Sedang Drag (MouseMove)
        onDrag(e) {
            if (!this.panning) return;
            e.preventDefault();
            this.pointX = e.clientX - this.startX;
            this.pointY = e.clientY - this.startY;
        },
    
        // Fungsi Stop Drag (MouseUp/Leave)
        stopDrag() {
            this.panning = false;
        }
    }">

    {{-- FLOATING TOOLBAR --}}
    <div class="absolute top-6 left-1/2 transform -translate-x-1/2 z-20">
        <div
            class="flex items-center gap-2 bg-white/80 backdrop-blur-md border border-gray-300 px-4 py-2 rounded-full shadow-lg">

            {{-- Label Zoom --}}
            <span class="text-xs font-bold text-gray-500 w-12 text-center" x-text="Math.round(scale * 100) + '%'"></span>

            <div class="h-4 w-px bg-gray-300 mx-1"></div>

            {{-- Zoom Out Button --}}
            <button @click="zoomOut()" class="p-1.5 hover:bg-gray-100 rounded-full text-gray-600 transition"
                title="Zoom Out">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4" />
                </svg>
            </button>

            {{-- Zoom In Button --}}
            <button @click="zoomIn()" class="p-1.5 hover:bg-gray-100 rounded-full text-gray-600 transition"
                title="Zoom In">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
            </button>

            <div class="h-4 w-px bg-gray-300 mx-1"></div>

            {{-- Reset Button --}}
            <button @click="reset()" class="p-1.5 hover:bg-gray-100 rounded-full text-gray-600 transition"
                title="Fit to Screen">
                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 8V4m0 0h4M4 4l5 5m11-1V4m0 0h-4m4 4l-5 5M4 16v4m0 0h4m-4 0l5-5m11 5l-5-5m5 5v-4m0 4h-4" />
                </svg>
            </button>
        </div>
    </div>

    {{-- VIEWPORT AREA --}}
    {{-- VIEWPORT AREA --}}
    <div class="w-full h-full overflow-hidden flex items-start justify-center pt-8" @wheel="handleWheel"
        @mousedown="startDrag" @mousemove="onDrag" @mouseup="stopDrag" @mouseleave="stopDrag" {{-- Class select-none dipasang saat panning true --}}
        :class="{ 'cursor-grabbing select-none': panning, 'cursor-grab': !panning }">

        <div class="origin-top transition-transform duration-75 ease-out shadow-2xl"
            :style="`transform: translate(${pointX}px, ${pointY}px) scale(${scale});`">

            {{-- AREA KERTAS CV --}}
            {{-- Tambahan pointer-events-none agar elemen didalamnya (link/text) ignoral mouse saat drag --}}
            <div class="w-[210mm] min-h-[297mm] bg-white pointer-events-none">
                @include('components.templates.' . $template_id)
            </div>

        </div>
    </div>
</div>
