@if ($currentStep == 5)
    <div class="animate-fade-in-up space-y-12">

        <!-- HEADER SECTION -->
        <div class="border-b-2 border-black pb-6 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h3 class="font-display text-4xl font-bold uppercase tracking-tighter text-black leading-none">
                    Maritime Data
                </h3>
                <p
                    class="font-mono text-sm text-gray-500 mt-2 bg-orange-300 inline-block px-2 border border-black shadow-[2px_2px_0px_0px_black]">
                    Step 05: Sea Service & Docs
                </p>
            </div>
            <div class="text-right hidden md:block">
                <p class="text-xs font-mono text-gray-400">Record sea time accurately.</p>
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
                    <div class="w-10 h-10 bg-teal-400 text-black flex items-center justify-center border-2 border-black">
                        <i data-lucide="anchor" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h4 class="font-display text-2xl font-bold uppercase leading-none">Sea Experience</h4>
                        <p class="font-mono text-[10px] text-gray-500 uppercase mt-1">Vessel & Contract History</p>
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
                <div class="border-2 border-black border-dashed bg-gray-50 p-8 text-center">
                    <p class="font-mono text-sm text-gray-500 mb-2">No sea service recorded.</p>
                    <p class="font-mono text-xs text-gray-400">Add your vessel history here.</p>
                </div>
            @endif

            <div class="space-y-4">
                @foreach ($seaExperiences as $index => $seaExp)
                    <div x-data="{
                        expanded: {{ empty($seaExp['vessel_name']) ? 'true' : 'false' }},
                        vessel: @entangle("seaExperiences.{$index}.vessel_name"),
                        rank: @entangle("seaExperiences.{$index}.rank"),
                        isCurrent: @entangle("seaExperiences.{$index}.is_current")
                    }" class="border-2 border-black bg-white transition-all duration-200"
                        :class="expanded ? 'shadow-[8px_8px_0px_0px_black] -translate-y-1' :
                            'hover:shadow-[4px_4px_0px_0px_black] hover:-translate-y-[2px]'">

                        {{-- Accordion Header --}}
                        <div @click="expanded = !expanded"
                            class="flex justify-between items-center p-4 cursor-pointer select-none group"
                            :class="expanded ? 'bg-black text-white border-b-2 border-black' : 'bg-white text-black'">

                            <div class="flex items-center gap-4">
                                <div class="transition-transform duration-200" :class="expanded ? 'rotate-180' : ''">
                                    <i data-lucide="chevron-down" class="w-5 h-5"></i>
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-display font-bold text-lg uppercase tracking-wide"
                                        x-text="vessel || 'NEW VESSEL RECORD'"></span>

                                    <div class="flex items-center gap-2" x-show="rank">
                                        <span class="font-mono text-xs opacity-80 uppercase" x-text="rank"></span>
                                    </div>
                                    <span x-show="!rank && !expanded"
                                        class="font-mono text-[10px] opacity-60 uppercase">Click to edit details</span>
                                </div>
                            </div>

                            <button type="button" wire:click="removeSeaExperience({{ $index }})" @click.stop
                                class="p-2 border-2 border-transparent hover:border-red-500 hover:bg-red-500 hover:text-white transition-colors"
                                :class="expanded ? 'text-gray-400 hover:border-white' : 'text-gray-400'">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </div>

                        {{-- Accordion Body --}}
                        <div x-show="expanded" x-collapse class="p-6 bg-white">
                            <div class="grid grid-cols-1 gap-6">

                                {{-- BLOCK 1: VESSEL INFO --}}
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                    <div class="md:col-span-2 flex items-center gap-2 mb-2">
                                        <i data-lucide="ship" class="w-4 h-4 text-teal-600"></i>
                                        <span
                                            class="font-mono text-xs font-bold uppercase underline decoration-2 decoration-teal-400">Vessel
                                            Details</span>
                                    </div>

                                    <div>
                                        <label class="block font-mono font-bold text-[10px] uppercase mb-1">Vessel
                                            Name</label>
                                        <input type="text" x-model="vessel"
                                            wire:model="seaExperiences.{{ $index }}.vessel_name"
                                            placeholder="MV. Example"
                                            class="w-full bg-white border-2 border-black p-2 font-bold text-sm focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                    </div>
                                    <div>
                                        <label class="block font-mono font-bold text-[10px] uppercase mb-1">Vessel
                                            Type</label>
                                        <input type="text"
                                            wire:model="seaExperiences.{{ $index }}.vessel_type"
                                            placeholder="Bulk Carrier"
                                            class="w-full bg-white border-2 border-black p-2 font-medium text-sm focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                    </div>
                                    <div>
                                        <label class="block font-mono font-bold text-[10px] uppercase mb-1">Gross
                                            Tonnage (GT)</label>
                                        <input type="number"
                                            wire:model="seaExperiences.{{ $index }}.gross_tonnage"
                                            placeholder="50000"
                                            class="w-full bg-white border-2 border-black p-2 font-medium text-sm focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                    </div>
                                    <div>
                                        <label class="block font-mono font-bold text-[10px] uppercase mb-1">Rank /
                                            Position</label>
                                        <input type="text" x-model="rank"
                                            wire:model="seaExperiences.{{ $index }}.rank"
                                            placeholder="Chief Officer"
                                            class="w-full bg-white border-2 border-black p-2 font-medium text-sm focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                    </div>
                                </div>

                                {{-- BLOCK 2: TECH SPECS --}}
                                <div class="border-2 border-black border-dashed p-4 bg-gray-50">
                                    <div class="flex items-center gap-2 mb-3">
                                        <i data-lucide="settings" class="w-3 h-3 text-gray-500"></i>
                                        <span class="font-mono text-[10px] font-bold uppercase text-gray-500">Technical
                                            Specs</span>
                                    </div>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block font-mono font-bold text-[10px] uppercase mb-1">Engine
                                                Type</label>
                                            <input type="text"
                                                wire:model="seaExperiences.{{ $index }}.engine_type"
                                                placeholder="B&W 6S60MC"
                                                class="w-full bg-white border-2 border-black p-2 text-sm focus:outline-none focus:shadow-[2px_2px_0px_0px_black]">
                                        </div>
                                        <div>
                                            <label class="block font-mono font-bold text-[10px] uppercase mb-1">Engine
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
                                    <div class="md:col-span-2 flex items-center gap-2 mb-2 mt-2">
                                        <i data-lucide="calendar-days" class="w-4 h-4 text-teal-600"></i>
                                        <span
                                            class="font-mono text-xs font-bold uppercase underline decoration-2 decoration-teal-400">Contract
                                            & Dates</span>
                                    </div>

                                    <div>
                                        <label class="block font-mono font-bold text-[10px] uppercase mb-1">Company /
                                            Owner</label>
                                        <input type="text" wire:model="seaExperiences.{{ $index }}.company"
                                            placeholder="Maersk Line"
                                            class="w-full bg-white border-2 border-black p-2 font-medium text-sm focus:outline-none focus:shadow-[4px_4px_0px_0px_black]">
                                    </div>
                                    <div>
                                        <label class="block font-mono font-bold text-[10px] uppercase mb-1">Contract
                                            Type</label>
                                        <input type="text"
                                            wire:model="seaExperiences.{{ $index }}.contract_type"
                                            placeholder="CBA / Private"
                                            class="w-full bg-white border-2 border-black p-2 font-medium text-sm focus:outline-none focus:shadow-[4px_4px_0px_0px_black]">
                                    </div>

                                    <div>
                                        <label class="block font-mono font-bold text-[10px] uppercase mb-1">Sign On
                                            Date</label>
                                        <input type="date" wire:model="seaExperiences.{{ $index }}.sign_on"
                                            class="w-full bg-white border-2 border-black p-2 font-mono text-sm focus:outline-none focus:shadow-[4px_4px_0px_0px_black]">
                                    </div>
                                    <div class="relative">
                                        <label class="block font-mono font-bold text-[10px] uppercase mb-1">Sign Off
                                            Date</label>
                                        <input type="date"
                                            wire:model="seaExperiences.{{ $index }}.sign_off"
                                            :disabled="isCurrent"
                                            class="w-full border-2 border-black p-2 font-mono text-sm focus:outline-none transition-all"
                                            :class="isCurrent ? 'bg-gray-200 text-gray-400 cursor-not-allowed' :
                                                'bg-white focus:shadow-[4px_4px_0px_0px_black]'">
                                    </div>

                                    <div class="md:col-span-2">
                                        <label
                                            class="flex items-center gap-2 cursor-pointer bg-teal-50 border-2 border-black border-dashed p-3 hover:bg-teal-100 transition-colors w-fit">
                                            <input type="checkbox" x-model="isCurrent"
                                                wire:model="seaExperiences.{{ $index }}.is_current"
                                                class="w-4 h-4 text-teal-600 border-2 border-black rounded-none focus:ring-0">
                                            <span class="font-mono text-xs font-bold uppercase">Currently
                                                Onboard</span>
                                        </label>
                                    </div>
                                </div>

                                {{-- BLOCK 4: EXTRA INFO --}}
                                <div>
                                    <label class="block font-mono font-bold text-[10px] uppercase mb-1">Sailing
                                        Area</label>
                                    <input type="text"
                                        wire:model="seaExperiences.{{ $index }}.sailing_area"
                                        placeholder="Worldwide / South East Asia"
                                        class="w-full bg-white border-2 border-black p-2 text-sm mb-4 focus:outline-none focus:shadow-[4px_4px_0px_0px_black]">

                                    <label class="block font-mono font-bold text-[10px] uppercase mb-1">Duties &
                                        Responsibilities</label>
                                    <textarea wire:model="seaExperiences.{{ $index }}.duties" rows="2"
                                        placeholder="Watchkeeping, Cargo Operation..."
                                        class="w-full bg-white border-2 border-black p-2 text-sm mb-4 focus:outline-none focus:shadow-[4px_4px_0px_0px_black]"></textarea>

                                    <label class="block font-mono font-bold text-[10px] uppercase mb-1">Additional
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
            <div class="flex justify-between items-end mb-6 pt-8 border-t-2 border-black border-dashed">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 bg-orange-400 text-black flex items-center justify-center border-2 border-black">
                        <i data-lucide="file-text" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h4 class="font-display text-2xl font-bold uppercase leading-none">Documents</h4>
                        <p class="font-mono text-[10px] text-gray-500 uppercase mt-1">Passports & COCs</p>
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
                    }" class="border-2 border-black bg-white transition-all duration-200"
                        :class="expanded ? 'shadow-[8px_8px_0px_0px_black] -translate-y-1' :
                            'hover:shadow-[4px_4px_0px_0px_black] hover:-translate-y-[2px]'">

                        <div @click="expanded = !expanded"
                            class="flex justify-between items-center p-4 cursor-pointer select-none group"
                            :class="expanded ? 'bg-black text-white border-b-2 border-black' : 'bg-white text-black'">

                            <div class="flex items-center gap-4">
                                <div class="transition-transform duration-200" :class="expanded ? 'rotate-180' : ''">
                                    <i data-lucide="chevron-down" class="w-5 h-5"></i>
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-display font-bold text-lg uppercase tracking-wide"
                                        x-text="name || 'NEW DOCUMENT'"></span>
                                </div>
                            </div>

                            <button type="button" wire:click="removeDocument({{ $index }})" @click.stop
                                class="p-2 border-2 border-transparent hover:border-red-500 hover:bg-red-500 hover:text-white transition-colors"
                                :class="expanded ? 'text-gray-400 hover:border-white' : 'text-gray-400'">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </div>

                        <div x-show="expanded" x-collapse class="p-6 bg-white">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label class="block font-mono font-bold text-xs uppercase mb-2">Document
                                        Name</label>
                                    <input type="text" x-model="name"
                                        wire:model="documents.{{ $index }}.name"
                                        placeholder="e.g. Passport, Seaman Book"
                                        class="w-full bg-white border-2 border-black p-3 font-bold focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                </div>
                                <div>
                                    <label class="block font-mono font-bold text-xs uppercase mb-2">Issuing
                                        Country</label>
                                    <input type="text" wire:model="documents.{{ $index }}.country"
                                        placeholder="e.g. Indonesia"
                                        class="w-full bg-white border-2 border-black p-3 font-medium focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                </div>
                                <div>
                                    <label class="block font-mono font-bold text-xs uppercase mb-2">Expiration
                                        Date</label>
                                    <input type="date" wire:model="documents.{{ $index }}.expiration_date"
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
