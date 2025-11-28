{{-- Navigation Buttons --}}
<div class="flex justify-between mt-8 pt-6 border-t">
    @if ($currentStep > 1)
        <button type="button" wire:click="previousStep"
            class="px-6 py-3 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition font-semibold">
            ← Previous
        </button>
    @else
        <div></div>
    @endif

    @if ($currentStep < $totalSteps)
        <button type="button" wire:click="nextStep"
            class="px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition font-semibold">
            Next →
        </button>
    @else
        <button type="button" wire:click="save"
            class="px-6 py-3 rounded-lg font-semibold transition
               @if ($isSubmitted) bg-gray-400 cursor-not-allowed @else bg-green-600 hover:bg-green-700 text-white @endif"
            wire:loading.attr="disabled" wire:target="save" @if ($isSubmitted) disabled @endif>

            <!-- Teks normal -->
            <span wire:loading.remove wire:target="save">
                @if ($isSubmitted)
                    ✓ CV Submitted
                @else
                    ✓ Submit CV
                @endif
            </span>

            <!-- Teks loading -->
            <span wire:loading wire:target="save">Submitting...</span>
        </button>

    @endif
</div>
