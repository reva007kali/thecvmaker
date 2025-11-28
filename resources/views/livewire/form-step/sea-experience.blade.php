{{-- STEP 5: Sea Experience & Documents --}}
@if ($currentStep == 5)
    <div>
        <h3 class="text-2xl font-semibold text-gray-800 mb-6">Sea Experience & Documents</h3>

        {{-- Sea Experience Section --}}
        <div class="mb-8">
            <div class="flex justify-between items-center mb-4">
                <h4 class="text-xl font-semibold text-gray-700">Sea Experience</h4>
                <button type="button" wire:click="addSeaExperience"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    + Add Sea Experience
                </button>
            </div>

            @foreach ($seaExperiences as $index => $seaExp)
                <div class="p-4 border rounded-lg mb-4 bg-gray-50">
                    <div class="flex justify-between items-center mb-3">
                        <span class="font-semibold text-gray-700">Sea Experience
                            #{{ $index + 1 }}</span>
                        <button type="button" wire:click="removeSeaExperience({{ $index }})"
                            class="text-red-600 hover:text-red-800">Remove</button>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-3">
                        <input type="text" wire:model="seaExperiences.{{ $index }}.vessel_name"
                            placeholder="Vessel Name"
                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">

                        <input type="text" wire:model="seaExperiences.{{ $index }}.vessel_type"
                            placeholder="Vessel Type"
                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">

                        <input type="text" wire:model="seaExperiences.{{ $index }}.gross_tonnage"
                            placeholder="Gross Tonnage (GT)"
                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">

                        <input type="text" wire:model="seaExperiences.{{ $index }}.engine_type"
                            placeholder="Engine Type"
                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">

                        <input type="text" wire:model="seaExperiences.{{ $index }}.engine_power"
                            placeholder="Engine Power (KW)"
                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">

                        <input type="text" wire:model="seaExperiences.{{ $index }}.rank"
                            placeholder="Rank/Position"
                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">

                        <input type="text" wire:model="seaExperiences.{{ $index }}.company"
                            placeholder="Company/Owner"
                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">

                        <input type="text" wire:model="seaExperiences.{{ $index }}.contract_type"
                            placeholder="Contract Type"
                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">

                        <input type="date" wire:model="seaExperiences.{{ $index }}.sign_on"
                            placeholder="Sign On Date"
                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">

                        <input type="date" wire:model="seaExperiences.{{ $index }}.sign_off"
                            placeholder="Sign Off Date"
                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">

                        <input type="text" wire:model="seaExperiences.{{ $index }}.sailing_area"
                            placeholder="Sailing Area"
                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 col-span-2">
                    </div>

                    <textarea wire:model="seaExperiences.{{ $index }}.duties" placeholder="Duties & Responsibilities" rows="2"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 mb-3"></textarea>

                    <textarea wire:model="seaExperiences.{{ $index }}.notes" placeholder="Additional Notes" rows="2"
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 mb-2"></textarea>

                    <label class="flex items-center">
                        <input type="checkbox" wire:model="seaExperiences.{{ $index }}.is_current"
                            class="mr-2">
                        <span class="text-sm text-gray-700">Currently working on this vessel</span>
                    </label>
                </div>
            @endforeach

            @if (count($seaExperiences) == 0)
                <p class="text-gray-500 text-center py-4">No sea experiences added yet</p>
            @endif
        </div>

        {{-- Documents Section --}}
        <div>
            <div class="flex justify-between items-center mb-4">
                <h4 class="text-xl font-semibold text-gray-700">Documents & Certificates</h4>
                <button type="button" wire:click="addDocument"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    + Add Document
                </button>
            </div>

            @foreach ($documents as $index => $document)
                <div class="p-4 border rounded-lg mb-4 bg-gray-50">
                    <div class="flex justify-between items-center mb-3">
                        <span class="font-semibold text-gray-700">Document
                            #{{ $index + 1 }}</span>
                        <button type="button" wire:click="removeDocument({{ $index }})"
                            class="text-red-600 hover:text-red-800">Remove</button>
                    </div>

                    <div class="grid grid-cols-3 gap-4">
                        <input type="text" wire:model="documents.{{ $index }}.name"
                            placeholder="Document Name (e.g. Passport, COC)"
                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">

                        <input type="text" wire:model="documents.{{ $index }}.country"
                            placeholder="Issuing Country"
                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">

                        <input type="date" wire:model="documents.{{ $index }}.expiration_date"
                            placeholder="Expiration Date"
                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                    </div>
                </div>
            @endforeach

            @if (count($documents) == 0)
                <p class="text-gray-500 text-center py-4">No documents added yet</p>
            @endif
        </div>
    </div>
@endif
