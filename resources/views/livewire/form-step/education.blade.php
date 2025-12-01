@if ($currentStep == 2)
    <div class="animate-fade-in-up space-y-12">

        <!-- HEADER SECTION -->
        <div class="border-b-2 border-black pb-6 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h3 class="font-display text-4xl font-bold uppercase tracking-tighter text-black leading-none">
                    History
                </h3>
                <p
                    class="font-mono text-sm text-gray-500 mt-2 bg-yellow-300 inline-block px-2 border border-black shadow-[2px_2px_0px_0px_black]">
                    Step 02: Education & Work
                </p>
            </div>
            <div class="text-right hidden md:block">
                <p class="text-xs font-mono text-gray-400">Chronological Order Recommended.</p>
                <p class="text-xs font-mono text-gray-400">Be precise.</p>
            </div>
        </div>

        {{-- ===================================================
         SECTION 1: EDUCATION
         =================================================== --}}
        <div>
            {{-- Section Header --}}
            <div class="flex justify-between items-end mb-6">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-black text-white flex items-center justify-center border-2 border-black">
                        <i data-lucide="graduation-cap" class="w-5 h-5"></i>
                    </div>
                    <h4 class="font-display text-2xl font-bold uppercase">Education</h4>
                </div>

                <button type="button" wire:click="addEducation"
                    class="group flex items-center gap-2 px-4 py-2 bg-white border-2 border-black text-xs font-mono font-bold uppercase hover:bg-black hover:text-white transition-all shadow-[4px_4px_0px_0px_black] active:translate-x-[2px] active:translate-y-[2px] active:shadow-none">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    <span>Add New</span>
                </button>
            </div>

            {{-- Empty State --}}
            @if (count($educations) === 0)
                <div class="border-2 border-black border-dashed bg-gray-50 p-8 text-center">
                    <p class="font-mono text-sm text-gray-500 mb-2">No education added yet.</p>
                    <p class="font-mono text-xs text-gray-400">Click "Add New" to list your degrees.</p>
                </div>
            @endif

            {{-- Education List (Accordion) --}}
            <div class="space-y-4">
                @foreach ($educations as $index => $education)
                    <div x-data="{
                        expanded: {{ empty($education['school']) ? 'true' : 'false' }},
                        schoolName: @entangle("educations.{$index}.school")
                    }" class="border-2 border-black bg-white transition-all duration-200"
                        :class="expanded ? 'shadow-[8px_8px_0px_0px_black] -translate-y-1' :
                            'hover:shadow-[4px_4px_0px_0px_black] hover:-translate-y-[2px]'">

                        {{-- ACCORDION HEADER --}}
                        <div @click="expanded = !expanded"
                            class="flex justify-between items-center p-4 cursor-pointer select-none group"
                            :class="expanded ? 'bg-black text-white border-b-2 border-black' : 'bg-white text-black'">

                            <div class="flex items-center gap-4">
                                {{-- Chevron --}}
                                <div class="transition-transform duration-200" :class="expanded ? 'rotate-180' : ''">
                                    <i data-lucide="chevron-down" class="w-5 h-5"></i>
                                </div>

                                {{-- Title --}}
                                <div class="flex flex-col">
                                    <span class="font-display font-bold text-lg uppercase tracking-wide"
                                        x-text="schoolName || 'NEW EDUCATION'"></span>
                                    <span x-show="!expanded" class="font-mono text-[10px] opacity-60 uppercase">Click to
                                        edit details</span>
                                </div>
                            </div>

                            {{-- Remove Button --}}
                            <button type="button" wire:click="removeEducation({{ $index }})" @click.stop
                                class="p-2 border-2 border-transparent hover:border-red-500 hover:bg-red-500 hover:text-white transition-colors"
                                :class="expanded ? 'text-gray-400 hover:border-white' : 'text-gray-400'">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </div>

                        {{-- ACCORDION BODY --}}
                        <div x-show="expanded" x-collapse class="p-6 bg-white">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                {{-- School --}}
                                <div class="md:col-span-2">
                                    <label class="block font-mono font-bold text-xs uppercase mb-2">School /
                                        University</label>
                                    <input type="text" x-model="schoolName"
                                        wire:model.blur="educations.{{ $index }}.school"
                                        placeholder="Ex: Harvard University"
                                        class="w-full bg-white border-2 border-black p-3 font-bold focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                </div>

                                {{-- Degree --}}
                                <div>
                                    <label class="block font-mono font-bold text-xs uppercase mb-2">Degree /
                                        Major</label>
                                    <input type="text" wire:model.blur="educations.{{ $index }}.degree"
                                        placeholder="Ex: Bachelor of Science"
                                        class="w-full bg-white border-2 border-black p-3 font-medium focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                </div>

                                {{-- Location --}}
                                <div>
                                    <label class="block font-mono font-bold text-xs uppercase mb-2">City,
                                        Country</label>
                                    <input type="text" wire:model.blur="educations.{{ $index }}.location"
                                        placeholder="Ex: Boston, USA"
                                        class="w-full bg-white border-2 border-black p-3 font-medium focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                </div>

                                {{-- Date Selectors --}}
                                <div>
                                    <x-date-selector wire:model.blur="educations.{{ $index }}.year_start"
                                        label="Start Date" :with-day="false" />
                                </div>
                                <div>
                                    <x-date-selector wire:model.blur="educations.{{ $index }}.year_end"
                                        label="End Date (Or Expected)" :with-day="false" />
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Separator Line --}}
        <div class="border-t-2 border-black border-dashed"></div>

        {{-- ===================================================
         SECTION 2: WORK EXPERIENCE
         =================================================== --}}
        <div>
            {{-- Section Header --}}
            <div class="flex justify-between items-end mb-6">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 bg-accent-blue text-white flex items-center justify-center border-2 border-black">
                        <i data-lucide="briefcase" class="w-5 h-5"></i>
                    </div>
                    <h4 class="font-display text-2xl font-bold uppercase">Work Experience</h4>
                </div>

                <button type="button" wire:click="addExperience"
                    class="group flex items-center gap-2 px-4 py-2 bg-white border-2 border-black text-xs font-mono font-bold uppercase hover:bg-black hover:text-white transition-all shadow-[4px_4px_0px_0px_black] active:translate-x-[2px] active:translate-y-[2px] active:shadow-none">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    <span>Add New</span>
                </button>
            </div>

            {{-- Empty State --}}
            @if (count($experiences) === 0)
                <div class="border-2 border-black border-dashed bg-gray-50 p-8 text-center">
                    <p class="font-mono text-sm text-gray-500 mb-2">No work experience added.</p>
                    <p class="font-mono text-xs text-gray-400">Fresh graduate? Skip this or add internships.</p>
                </div>
            @endif

            <div class="space-y-4">
                @foreach ($experiences as $index => $experience)
                    <div x-data="{
                        expanded: {{ empty($experience['company']) ? 'true' : 'false' }},
                        companyName: @entangle("experiences.{$index}.company"),
                        jobTitle: @entangle("experiences.{$index}.job_title"),
                        isPresent: @entangle("experiences.{$index}.is_present")
                    }" class="border-2 border-black bg-white transition-all duration-200"
                        :class="expanded ? 'shadow-[8px_8px_0px_0px_black] -translate-y-1' :
                            'hover:shadow-[4px_4px_0px_0px_black] hover:-translate-y-[2px]'">

                        {{-- ACCORDION HEADER --}}
                        <div @click="expanded = !expanded"
                            class="flex justify-between items-center p-4 cursor-pointer select-none group"
                            :class="expanded ? 'bg-black text-white border-b-2 border-black' : 'bg-white text-black'">

                            <div class="flex items-center gap-4">
                                {{-- Chevron --}}
                                <div class="transition-transform duration-200" :class="expanded ? 'rotate-180' : ''">
                                    <i data-lucide="chevron-down" class="w-5 h-5"></i>
                                </div>

                                {{-- Titles --}}
                                <div class="flex flex-col">
                                    <span class="font-display font-bold text-lg uppercase tracking-wide"
                                        x-text="companyName || 'NEW EXPERIENCE'"></span>

                                    <div class="flex items-center gap-2" x-show="jobTitle">
                                        <span class="font-mono text-xs opacity-80" x-text="jobTitle"></span>
                                    </div>
                                    <span x-show="!jobTitle && !expanded"
                                        class="font-mono text-[10px] opacity-60 uppercase">Click to edit details</span>
                                </div>
                            </div>

                            {{-- Remove Button --}}
                            <button type="button" wire:click="removeExperience({{ $index }})" @click.stop
                                class="p-2 border-2 border-transparent hover:border-red-500 hover:bg-red-500 hover:text-white transition-colors"
                                :class="expanded ? 'text-gray-400 hover:border-white' : 'text-gray-400'">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </div>

                        {{-- ACCORDION BODY --}}
                        <div x-show="expanded" x-collapse class="p-6 bg-white">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                                {{-- Company --}}
                                <div>
                                    <label class="block font-mono font-bold text-xs uppercase mb-2">Company
                                        Name</label>
                                    <input type="text" x-model="companyName"
                                        wire:model.blur="experiences.{{ $index }}.company"
                                        placeholder="Ex: Google Inc"
                                        class="w-full bg-white border-2 border-black p-3 font-bold focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                </div>

                                {{-- Job Title --}}
                                <div>
                                    <label class="block font-mono font-bold text-xs uppercase mb-2">Job Title</label>
                                    <input type="text" x-model="jobTitle"
                                        wire:model.blur="experiences.{{ $index }}.job_title"
                                        placeholder="Ex: Senior Developer"
                                        class="w-full bg-white border-2 border-black p-3 font-medium focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                </div>

                                {{-- Location --}}
                                <div class="md:col-span-2">
                                    <label class="block font-mono font-bold text-xs uppercase mb-2">Location</label>
                                    <input type="text" wire:model.blur="experiences.{{ $index }}.location"
                                        placeholder="Ex: Jakarta, Indonesia"
                                        class="w-full bg-white border-2 border-black p-3 font-medium focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                </div>

                                {{-- Dates --}}
                                <div class="md:col-span-2 border-2 border-black border-dashed p-4 bg-gray-50">
                                    <div class="flex items-center justify-between mb-4">
                                        <label class="font-mono font-bold text-xs uppercase">Employment Period</label>

                                        {{-- Checkbox Present --}}
                                        <label class="flex items-center gap-2 cursor-pointer">
                                            <input type="checkbox" x-model="isPresent"
                                                wire:model.blur="experiences.{{ $index }}.is_present"
                                                class="w-4 h-4 text-black border-2 border-black rounded-none focus:ring-0 focus:ring-offset-0">
                                            <span class="font-mono text-xs font-bold uppercase">Currently Working
                                                Here</span>
                                        </label>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4">
                                        {{-- Start Date (Native Date Picker with Brutalist Style) --}}
                                        <div>
                                            <label
                                                class="block font-mono font-bold text-[10px] uppercase mb-1 text-gray-500">Start
                                                Date</label>
                                            <input type="date"
                                                wire:model.blur="experiences.{{ $index }}.start_date"
                                                class="w-full bg-white border-2 border-black p-2 font-mono text-sm focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                        </div>

                                        {{-- End Date --}}
                                        <div>
                                            <label
                                                class="block font-mono font-bold text-[10px] uppercase mb-1 text-gray-500">End
                                                Date</label>
                                            <input type="date"
                                                wire:model.blur="experiences.{{ $index }}.end_date"
                                                :disabled="isPresent"
                                                class="w-full border-2 border-black p-2 font-mono text-sm focus:outline-none transition-all"
                                                :class="isPresent ?
                                                    'bg-gray-200 text-gray-400 cursor-not-allowed border-gray-300' :
                                                    'bg-white focus:shadow-[4px_4px_0px_0px_black]'">
                                        </div>
                                    </div>
                                </div>

                                {{-- Description --}}
                                <div class="md:col-span-2">
                                    <label class="block font-mono font-bold text-xs uppercase mb-2">Job
                                        Description</label>
                                    <textarea wire:model.blur="experiences.{{ $index }}.job_desk" rows="4"
                                        placeholder="Describe your responsibilities, achievements, and tech stack used..."
                                        class="w-full bg-white border-2 border-black p-3 font-sans text-sm leading-relaxed focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow"></textarea>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endif
