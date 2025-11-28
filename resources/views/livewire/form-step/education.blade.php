{{-- STEP 2: Education & Experience --}}
@if ($currentStep == 2)
    <div>
        <h3 class="text-2xl font-semibold text-gray-800 mb-6">Education & Work Experience</h3>



        {{-- Education Section --}}
        <div class="mb-8">
            <div class="flex justify-between items-center mb-4">
                <h4 class="text-xl font-semibold text-gray-700">Education</h4>
                <button type="button" wire:click="addEducation"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-medium flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Education
                </button>
            </div>

            <div class="space-y-3">
                @foreach ($educations as $index => $education)
                    <div x-data="{
                        expanded: {{ empty($education['school']) ? 'true' : 'false' }},
                        schoolName: @entangle("educations.{$index}.school")
                    }"
                        class="border border-gray-200 rounded-lg bg-white shadow-sm overflow-hidden transition-all duration-200"
                        :class="expanded ? 'ring-2 ring-blue-500 ring-opacity-50' : 'hover:border-blue-300'">

                        {{-- HEADER ACCORDION (Klik disini untuk buka/tutup) --}}
                        <div @click="expanded = !expanded"
                            class="flex justify-between items-center p-4 cursor-pointer bg-gray-50 hover:bg-gray-100 transition select-none">

                            <div class="flex items-center gap-3">
                                {{-- Icon Chevron (Berputar saat dibuka) --}}
                                <svg class="w-5 h-5 text-gray-500 transition-transform duration-200"
                                    :class="expanded ? 'transform rotate-180' : ''" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>

                                {{-- Judul: Menampilkan Nama Sekolah Realtime --}}
                                <div class="flex flex-col">
                                    <span class="font-bold text-gray-700 text-sm"
                                        x-text="schoolName || 'New Education (Click to Expand)'"></span>
                                    {{-- Subtitle kecil jika ditutup --}}
                                    <span x-show="!expanded && schoolName" class="text-xs text-gray-500">Click to edit
                                        details</span>
                                </div>
                            </div>

                            {{-- Tombol Remove (Stop propagation agar tidak men-trigger accordion) --}}
                            <button type="button" wire:click="removeEducation({{ $index }})" @click.stop
                                class="text-red-500 hover:text-red-700 p-1 rounded hover:bg-red-50 transition"
                                title="Remove">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>

                        {{-- BODY ACCORDION (Form Input) --}}
                        <div x-show="expanded" x-collapse class="p-4 border-t border-gray-200 bg-white">
                            <div class="grid grid-cols-2 gap-4">

                                {{-- Input School --}}
                                <div class="col-span-2 md:col-span-1">
                                    <label class="text-xs font-semibold text-gray-500 mb-1 block">School
                                        / University</label>
                                    <input type="text" x-model="schoolName" {{-- Pakai x-model ke variable alpine biar judul update realtime --}}
                                        wire:model="educations.{{ $index }}.school"
                                        placeholder="Ex: Harvard University"
                                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                                </div>

                                {{-- Input Degree --}}
                                <div class="col-span-2 md:col-span-1">
                                    <label class="text-xs font-semibold text-gray-500 mb-1 block">Degree</label>
                                    <input type="text" wire:model="educations.{{ $index }}.degree"
                                        placeholder="Ex: Bachelor of Science"
                                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                                </div>

                                {{-- Input Location --}}
                                <div class="col-span-2">
                                    <label class="text-xs font-semibold text-gray-500 mb-1 block">Location</label>
                                    <input type="text" wire:model="educations.{{ $index }}.location"
                                        placeholder="Ex: New York, USA"
                                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                                </div>

                                {{-- Date Selectors --}}
                                <div class="col-span-2 md:col-span-1">
                                    <x-date-selector wire:model="educations.{{ $index }}.year_start"
                                        label="Start Date" :with-day="false" />
                                </div>

                                <div class="col-span-2 md:col-span-1">
                                    <x-date-selector wire:model="educations.{{ $index }}.year_end"
                                        label="End Date" :with-day="false" />
                                </div>
                            </div>
                        </div>

                    </div>
                @endforeach
            </div>
        </div>

        {{-- experience --}}
        <div class="mb-8">
            {{-- Header Section --}}
            <div class="flex justify-between items-center mb-4">
                <h4 class="text-xl font-semibold text-gray-700">Work Experience</h4>
                <button type="button" wire:click="addExperience"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-medium flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Experience
                </button>
            </div>

            <div class="space-y-3">
                @foreach ($experiences as $index => $experience)
                    <div x-data="{
                        expanded: {{ empty($experience['company']) ? 'true' : 'false' }},
                        companyName: @entangle("experiences.{$index}.company"),
                        jobTitle: @entangle("experiences.{$index}.job_title"),
                        isPresent: @entangle("experiences.{$index}.is_present")
                    }"
                        class="border border-gray-200 rounded-lg bg-white shadow-sm overflow-hidden transition-all duration-200"
                        :class="expanded ? 'ring-2 ring-blue-500 ring-opacity-50' : 'hover:border-blue-300'">

                        {{-- ACCORDION HEADER --}}
                        <div @click="expanded = !expanded"
                            class="flex justify-between items-center p-4 cursor-pointer bg-gray-50 hover:bg-gray-100 transition select-none">

                            <div class="flex items-center gap-3">
                                {{-- Icon Chevron --}}
                                <svg class="w-5 h-5 text-gray-500 transition-transform duration-200"
                                    :class="expanded ? 'transform rotate-180' : ''" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>

                                {{-- Judul: Menampilkan Company & Job Title --}}
                                <div class="flex flex-col">
                                    <span class="font-bold text-gray-700 text-sm"
                                        x-text="companyName || 'New Experience (Click to Expand)'"></span>

                                    {{-- Subtitle (Job Title) hanya muncul jika ada isinya --}}
                                    <span x-show="jobTitle" class="text-xs text-gray-500" x-text="jobTitle"></span>
                                    <span x-show="!jobTitle && !expanded" class="text-xs text-gray-400">Click to edit
                                        details</span>
                                </div>
                            </div>

                            {{-- Tombol Remove (@click.stop agar accordion tidak trigger) --}}
                            <button type="button" wire:click="removeExperience({{ $index }})" @click.stop
                                class="text-red-500 hover:text-red-700 p-1 rounded hover:bg-red-50 transition"
                                title="Remove">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>

                        {{-- ACCORDION BODY (Form Input) --}}
                        <div x-show="expanded" x-collapse class="p-4 border-t border-gray-200 bg-white">
                            <div class="grid grid-cols-2 gap-4">

                                {{-- Company Name --}}
                                <div class="col-span-2 md:col-span-1">
                                    <label class="text-xs font-semibold text-gray-500 mb-1 block">Company
                                        Name</label>
                                    <input type="text" x-model="companyName"
                                        wire:model="experiences.{{ $index }}.company"
                                        placeholder="Ex: Google Inc"
                                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                                </div>

                                {{-- Job Title --}}
                                <div class="col-span-2 md:col-span-1">
                                    <label class="text-xs font-semibold text-gray-500 mb-1 block">Job
                                        Title</label>
                                    <input type="text" x-model="jobTitle"
                                        wire:model="experiences.{{ $index }}.job_title"
                                        placeholder="Ex: Senior Web Developer"
                                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                                </div>

                                {{-- Location --}}
                                <div class="col-span-2">
                                    <label class="text-xs font-semibold text-gray-500 mb-1 block">Location</label>
                                    <input type="text" wire:model="experiences.{{ $index }}.location"
                                        placeholder="Ex: Jakarta, Indonesia"
                                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                                </div>

                                {{-- Dates Section --}}
                                <div class="col-span-2 grid grid-cols-2 gap-4 border-t border-gray-100 pt-3 mt-1">

                                    {{-- Start Date --}}
                                    <div>
                                        <label class="text-xs font-semibold text-gray-500 mb-1 block">Start
                                            Date</label>
                                        <input type="date" wire:model="experiences.{{ $index }}.start_date"
                                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-600">
                                    </div>

                                    {{-- End Date --}}
                                    <div class="relative">
                                        <label class="text-xs font-semibold text-gray-500 mb-1 block">End
                                            Date</label>

                                        {{-- Logic Disable: Jika isPresent true, input end_date disable --}}
                                        <input type="date" wire:model="experiences.{{ $index }}.end_date"
                                            :disabled="isPresent"
                                            :class="isPresent ? 'bg-gray-100 text-gray-400 cursor-not-allowed' :
                                                'bg-white'"
                                            class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm text-gray-600 transition-colors">
                                    </div>

                                    {{-- Checkbox Currently Working --}}
                                    <div class="col-span-2">
                                        <label class="inline-flex items-center cursor-pointer">
                                            <input type="checkbox" x-model="isPresent"
                                                wire:model="experiences.{{ $index }}.is_present"
                                                class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                            <span class="ml-2 text-sm text-gray-600 font-medium">I am
                                                currently working here</span>
                                        </label>
                                    </div>
                                </div>

                                {{-- Job Description --}}
                                <div class="col-span-2">
                                    <label class="text-xs font-semibold text-gray-500 mb-1 block">Job
                                        Description</label>
                                    <textarea wire:model="experiences.{{ $index }}.job_desk" rows="3"
                                        placeholder="Describe your responsibilities and achievements..."
                                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"></textarea>
                                </div>

                            </div>
                        </div>
                        {{-- END BODY --}}

                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endif
