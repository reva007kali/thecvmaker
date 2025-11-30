{{-- Navigation Buttons Container --}}
<div class="flex justify-between items-center mt-12 pt-8 border-t-2 border-black border-dashed">

    {{-- 1. PREVIOUS BUTTON --}}
    @if ($currentStep > 1)
        <button type="button" wire:click="previousStep"
            class="group flex items-center gap-2 px-6 py-3 bg-white border-2 border-black text-black font-mono text-sm font-bold uppercase transition-all hover:bg-black hover:text-white hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,0.2)]">
            <i data-lucide="arrow-left" class="w-4 h-4 transition-transform group-hover:-translate-x-1"></i>
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
            <i data-lucide="arrow-right" class="w-4 h-4 transition-transform group-hover:translate-x-1"></i>

            {{-- Loading Spinner (Specific for Next) --}}
            <div wire:loading wire:target="nextStep" class="absolute inset-0 bg-black flex items-center justify-center">
                <i data-lucide="loader-2" class="w-5 h-5 animate-spin text-white"></i>
            </div>
        </button>
    @else
        {{-- 3. SUBMIT / SAVE BUTTON --}}
        <button type="button" wire:click="save" wire:loading.attr="disabled" wire:target="save"
            @if ($isSubmitted) disabled @endif
            class="group relative px-8 py-3 border-2 border-black font-display font-bold text-sm uppercase tracking-widest shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] transition-all 
            {{ $isSubmitted
                ? 'bg-gray-200 text-gray-500 cursor-not-allowed shadow-none border-gray-400'
                : 'bg-green-500 text-black hover:bg-green-400 hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none' }}">

            {{-- Content Wrapper --}}
            <div class="flex items-center gap-2">
                {{-- Normal State --}}
                <span wire:loading.remove wire:target="save" class="flex items-center gap-2">
                    @if ($isSubmitted)
                        <i data-lucide="check-circle" class="w-5 h-5"></i>
                        <span>CV Submitted</span>
                    @else
                        <span>Finish & Save</span>
                        <i data-lucide="save" class="w-4 h-4 transition-transform group-hover:scale-110"></i>
                    @endif
                </span>

                {{-- Loading State --}}
                <span wire:loading wire:target="save" class="flex items-center gap-2">
                    <i data-lucide="loader-2" class="w-5 h-5 animate-spin"></i>
                    <span>Processing...</span>
                </span>
            </div>
        </button>
    @endif
</div>
