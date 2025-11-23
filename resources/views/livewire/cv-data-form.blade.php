<div x-data="{
    first_name: @entangle('first_name'),
    last_name: @entangle('last_name'),
    email: @entangle('email'),
    phone: @entangle('phone'),
    experiences: @entangle('experiences'),
    updatePreview(index, field, value) {
        this.experiences[index][field] = value;
    }
}" class="grid lg:grid-cols-5 bg-slate-300 h-screen">
    <div class="col-span-2 h-screen overflow-y-scroll">
        <div class="bg-white rounded-lg shadow-lg p-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-6 text-center">CV Builder Wizard</h2>

            {{-- Progress Bar --}}
            <div class="mb-8 overflow-x-auto p-2">
                <div class="flex justify-between mb-2">
                    @for ($i = 1; $i <= $totalSteps; $i++)
                        <div class="flex flex-col items-center flex-1">
                            <div class="flex items-center w-full">
                                @if ($i > 1)
                                    <div class="flex-1 h-1 {{ $currentStep >= $i ? 'bg-blue-600' : 'bg-gray-300' }}">
                                    </div>
                                @endif

                                <div class="relative">
                                    <div wire:click="goToStep({{ $i }})"
                                        class="w-10 h-10 rounded-full flex items-center justify-center font-bold cursor-pointer transition-all
                                         {{ $currentStep >= $i ? 'bg-blue-600 text-white' : 'bg-gray-300 text-gray-600' }}
                                         {{ $currentStep == $i ? 'ring-4 ring-blue-200' : '' }}">
                                        {{ $i }}
                                    </div>
                                </div>

                                @if ($i < $totalSteps)
                                    <div class="flex-1 h-1 {{ $currentStep > $i ? 'bg-blue-600' : 'bg-gray-300' }}">
                                    </div>
                                @endif
                            </div>
                            <span
                                class="text-xs mt-2 text-center {{ $currentStep >= $i ? 'text-blue-600 font-semibold' : 'text-gray-500' }}">
                                @if ($i == 1)
                                    Personal
                                @elseif($i == 2)
                                    Education
                                @elseif($i == 3)
                                    Skills
                                @elseif($i == 4)
                                    Achievements
                                @elseif($i == 5)
                                    Sea & Docs
                                @else
                                    Review
                                @endif
                            </span>
                        </div>
                    @endfor
                </div>
            </div>

            {{-- Success Message --}}
            @if (session()->has('status'))
                <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('status') }}
                </div>
            @endif

            <form wire:submit.prevent="save">


                @include('livewire.form-step.personal-information')


                {{-- STEP 2: Education & Experience --}}
                @if ($currentStep == 2)
                    <div>
                        <h3 class="text-2xl font-semibold text-gray-800 mb-6">Education & Work Experience</h3>

                        {{-- Education Section --}}
                        <div class="mb-8">
                            <div class="flex justify-between items-center mb-4">
                                <h4 class="text-xl font-semibold text-gray-700">Education</h4>
                                <button type="button" wire:click="addEducation"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                    + Add Education
                                </button>
                            </div>

                            @foreach ($educations as $index => $education)
                                <div class="p-4 border rounded-lg mb-4 bg-gray-50">
                                    <div class="flex justify-between items-center mb-3">
                                        <span class="font-semibold text-gray-700">Education
                                            #{{ $index + 1 }}</span>
                                        <button type="button" wire:click="removeEducation({{ $index }})"
                                            class="text-red-600 hover:text-red-800">Remove</button>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4">
                                        <input type="text" wire:model="educations.{{ $index }}.school"
                                            placeholder="School Name"
                                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">

                                        <input type="text" wire:model="educations.{{ $index }}.degree"
                                            placeholder="Degree"
                                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">

                                        <input type="text" wire:model="educations.{{ $index }}.location"
                                            placeholder="Location"
                                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">

                                        <div class="grid grid-cols-2 gap-2">
                                            <input type="date"
                                                wire:model="educations.{{ $index }}.year_start"
                                                placeholder="Start Year"
                                                class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">

                                            <input type="date" wire:model="educations.{{ $index }}.year_end"
                                                placeholder="End Year"
                                                class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- Experience Section --}}
                        <div>
                            <div class="flex justify-between items-center mb-4">
                                <h4 class="text-xl font-semibold text-gray-700">Work Experience</h4>
                                <button type="button" wire:click="addExperience"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                    + Add Experience
                                </button>
                            </div>

                            @foreach ($experiences as $index => $experience)
                                <div class="p-4 border rounded-lg mb-4 bg-gray-50">
                                    <div class="flex justify-between items-center mb-3">
                                        <span class="font-semibold text-gray-700">Experience
                                            #{{ $index + 1 }}</span>
                                        <button type="button" wire:click="removeExperience({{ $index }})"
                                            class="text-red-600 hover:text-red-800">Remove</button>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4 mb-3">
                                        <input type="text" wire:model="experiences.{{ $index }}.company"
                                            placeholder="Company Name"
                                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">

                                        <input type="text" wire:model="experiences.{{ $index }}.job_title"
                                            placeholder="Job Title"
                                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">

                                        <input type="text" wire:model="experiences.{{ $index }}.location"
                                            placeholder="Location"
                                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">

                                        <div class="grid grid-cols-2 gap-2">
                                            <input type="date"
                                                wire:model="experiences.{{ $index }}.start_date"
                                                class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">

                                            <input type="date" wire:model="experiences.{{ $index }}.end_date"
                                                class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                                        </div>
                                    </div>

                                    <textarea wire:model="experiences.{{ $index }}.job_desk" placeholder="Job Description" rows="3"
                                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600"></textarea>

                                    <label class="flex items-center mt-2">
                                        <input type="checkbox" wire:model="experiences.{{ $index }}.is_present"
                                            class="mr-2">
                                        <span class="text-sm text-gray-700">Currently working here</span>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- STEP 3: Skills & Languages --}}
                @if ($currentStep == 3)
                    <div>
                        <h3 class="text-2xl font-semibold text-gray-800 mb-6">Skills & Languages</h3>

                        {{-- Hard Skills Section --}}
                        <div class="mb-8">
                            <div class="flex justify-between items-center mb-4">
                                <h4 class="text-xl font-semibold text-gray-700">Hard Skills</h4>
                                <button type="button" wire:click="addHardSkill"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                    + Add Hard Skill
                                </button>
                            </div>

                            @foreach ($hardSkills as $index => $skill)
                                <div class="p-4 border rounded-lg mb-4 bg-gray-50">
                                    <div class="flex justify-between items-center mb-3">
                                        <span class="font-semibold text-gray-700">Hard Skill
                                            #{{ $index + 1 }}</span>
                                        <button type="button" wire:click="removeHardSkill({{ $index }})"
                                            class="text-red-600 hover:text-red-800">Remove</button>
                                    </div>

                                    <div class="grid grid-cols-3 gap-4">
                                        <input type="text" wire:model="hardSkills.{{ $index }}.skill_name"
                                            placeholder="Skill Name (e.g. PHP, Laravel)"
                                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">

                                        <select wire:model="hardSkills.{{ $index }}.level"
                                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                                            <option value="">Select Level</option>
                                            <option value="beginner">Beginner</option>
                                            <option value="intermediate">Intermediate</option>
                                            <option value="advanced">Advanced</option>
                                            <option value="expert">Expert</option>
                                        </select>

                                        <input type="number" wire:model="hardSkills.{{ $index }}.scale"
                                            placeholder="Scale (1-10)" min="1" max="10"
                                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                                    </div>
                                </div>
                            @endforeach

                            @if (count($hardSkills) == 0)
                                <p class="text-gray-500 text-center py-4">No hard skills added yet</p>
                            @endif
                        </div>

                        {{-- Soft Skills Section --}}
                        <div class="mb-8">
                            <div class="flex justify-between items-center mb-4">
                                <h4 class="text-xl font-semibold text-gray-700">Soft Skills</h4>
                                <button type="button" wire:click="addSoftSkill"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                    + Add Soft Skill
                                </button>
                            </div>

                            @foreach ($softSkills as $index => $skill)
                                <div class="p-4 border rounded-lg mb-4 bg-gray-50">
                                    <div class="flex justify-between items-center mb-3">
                                        <span class="font-semibold text-gray-700">Soft Skill
                                            #{{ $index + 1 }}</span>
                                        <button type="button" wire:click="removeSoftSkill({{ $index }})"
                                            class="text-red-600 hover:text-red-800">Remove</button>
                                    </div>

                                    <div class="grid grid-cols-3 gap-4">
                                        <input type="text" wire:model="softSkills.{{ $index }}.skill_name"
                                            placeholder="Skill Name (e.g. Leadership, Communication)"
                                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">

                                        <select wire:model="softSkills.{{ $index }}.level"
                                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                                            <option value="">Select Level</option>
                                            <option value="beginner">Beginner</option>
                                            <option value="intermediate">Intermediate</option>
                                            <option value="advanced">Advanced</option>
                                            <option value="expert">Expert</option>
                                        </select>

                                        <input type="number" wire:model="softSkills.{{ $index }}.scale"
                                            placeholder="Scale (1-10)" min="1" max="10"
                                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                                    </div>
                                </div>
                            @endforeach

                            @if (count($softSkills) == 0)
                                <p class="text-gray-500 text-center py-4">No soft skills added yet</p>
                            @endif
                        </div>

                        {{-- Languages Section --}}
                        <div>
                            <div class="flex justify-between items-center mb-4">
                                <h4 class="text-xl font-semibold text-gray-700">Languages</h4>
                                <button type="button" wire:click="addLanguage"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                    + Add Language
                                </button>
                            </div>

                            @foreach ($languages as $index => $language)
                                <div class="p-4 border rounded-lg mb-4 bg-gray-50">
                                    <div class="flex justify-between items-center mb-3">
                                        <span class="font-semibold text-gray-700">Language
                                            #{{ $index + 1 }}</span>
                                        <button type="button" wire:click="removeLanguage({{ $index }})"
                                            class="text-red-600 hover:text-red-800">Remove</button>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4">
                                        <input type="text" wire:model="languages.{{ $index }}.language"
                                            placeholder="Language (e.g. English, Indonesian)"
                                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">

                                        <select wire:model="languages.{{ $index }}.level"
                                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                                            <option value="">Select Proficiency</option>
                                            <option value="basic">Basic</option>
                                            <option value="conversational">Conversational</option>
                                            <option value="fluent">Fluent</option>
                                            <option value="native">Native</option>
                                        </select>
                                    </div>
                                </div>
                            @endforeach

                            @if (count($languages) == 0)
                                <p class="text-gray-500 text-center py-4">No languages added yet</p>
                            @endif
                        </div>
                    </div>
                @endif

                {{-- STEP 4: Achievements & Certifications --}}
                @if ($currentStep == 4)
                    <div>
                        <h3 class="text-2xl font-semibold text-gray-800 mb-6">Achievements & Certifications</h3>

                        {{-- Achievements Section --}}
                        <div class="mb-8">
                            <div class="flex justify-between items-center mb-4">
                                <h4 class="text-xl font-semibold text-gray-700">Achievements</h4>
                                <button type="button" wire:click="addAchievement"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                    + Add Achievement
                                </button>
                            </div>

                            @foreach ($achievements as $index => $achievement)
                                <div class="p-4 border rounded-lg mb-4 bg-gray-50">
                                    <div class="flex justify-between items-center mb-3">
                                        <span class="font-semibold text-gray-700">Achievement
                                            #{{ $index + 1 }}</span>
                                        <button type="button" wire:click="removeAchievement({{ $index }})"
                                            class="text-red-600 hover:text-red-800">Remove</button>
                                    </div>

                                    <div class="grid grid-cols-3 gap-4">
                                        <input type="text" wire:model="achievements.{{ $index }}.name"
                                            placeholder="Achievement Name"
                                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">

                                        <input type="text" wire:model="achievements.{{ $index }}.vendor"
                                            placeholder="Organization/Vendor"
                                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">

                                        <input type="date" wire:model="achievements.{{ $index }}.year"
                                            placeholder="Year"
                                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                                    </div>
                                </div>
                            @endforeach

                            @if (count($achievements) == 0)
                                <p class="text-gray-500 text-center py-4">No achievements added yet</p>
                            @endif
                        </div>

                        {{-- Certifications Section --}}
                        <div class="mb-8">
                            <div class="flex justify-between items-center mb-4">
                                <h4 class="text-xl font-semibold text-gray-700">Certifications</h4>
                                <button type="button" wire:click="addCertificate"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                    + Add Certification
                                </button>
                            </div>

                            @foreach ($certifications as $index => $certification)
                                <div class="p-4 border rounded-lg mb-4 bg-gray-50">
                                    <div class="flex justify-between items-center mb-3">
                                        <span class="font-semibold text-gray-700">Certification
                                            #{{ $index + 1 }}</span>
                                        <button type="button" wire:click="removeCertificate({{ $index }})"
                                            class="text-red-600 hover:text-red-800">Remove</button>
                                    </div>

                                    <div class="grid grid-cols-3 gap-4">
                                        <input type="text" wire:model="certifications.{{ $index }}.name"
                                            placeholder="Certification Name"
                                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">

                                        <input type="text" wire:model="certifications.{{ $index }}.vendor"
                                            placeholder="Issuing Organization"
                                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">

                                        <input type="text" wire:model="certifications.{{ $index }}.year"
                                            placeholder="Year Obtained"
                                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                                    </div>
                                </div>
                            @endforeach

                            @if (count($certifications) == 0)
                                <p class="text-gray-500 text-center py-4">No certifications added yet</p>
                            @endif
                        </div>

                        {{-- References Section --}}
                        <div class="mb-8">
                            <div class="flex justify-between items-center mb-4">
                                <h4 class="text-xl font-semibold text-gray-700">References</h4>
                                <button type="button" wire:click="addReference"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                    + Add Reference
                                </button>
                            </div>

                            @foreach ($references as $index => $reference)
                                <div class="p-4 border rounded-lg mb-4 bg-gray-50">
                                    <div class="flex justify-between items-center mb-3">
                                        <span class="font-semibold text-gray-700">Reference
                                            #{{ $index + 1 }}</span>
                                        <button type="button" wire:click="removeReference({{ $index }})"
                                            class="text-red-600 hover:text-red-800">Remove</button>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4 mb-3">
                                        <input type="text" wire:model="references.{{ $index }}.name"
                                            placeholder="Reference Name"
                                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">

                                        <input type="email" wire:model="references.{{ $index }}.email"
                                            placeholder="Email"
                                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">

                                        <input type="text" wire:model="references.{{ $index }}.phone"
                                            placeholder="Phone Number"
                                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">

                                        <input type="text" wire:model="references.{{ $index }}.company"
                                            placeholder="Company"
                                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                                    </div>

                                    <input type="text" wire:model="references.{{ $index }}.relation"
                                        placeholder="Relation (e.g. Former Manager, Colleague)"
                                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                                </div>
                            @endforeach

                            @if (count($references) == 0)
                                <p class="text-gray-500 text-center py-4">No references added yet</p>
                            @endif
                        </div>

                        {{-- Social Media Section --}}
                        <div>
                            <div class="flex justify-between items-center mb-4">
                                <h4 class="text-xl font-semibold text-gray-700">Social Media</h4>
                                <button type="button" wire:click="addSocialMedia"
                                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                    + Add Social Media
                                </button>
                            </div>

                            @foreach ($socialMedia as $index => $sm)
                                <div class="p-4 border rounded-lg mb-4 bg-gray-50">
                                    <div class="flex justify-between items-center mb-3">
                                        <span class="font-semibold text-gray-700">Social Media
                                            #{{ $index + 1 }}</span>
                                        <button type="button" wire:click="removeSocialMedia({{ $index }})"
                                            class="text-red-600 hover:text-red-800">Remove</button>
                                    </div>

                                    <div class="grid grid-cols-3 gap-4">
                                        <select wire:model="socialMedia.{{ $index }}.platform"
                                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                                            <option value="">Select Platform</option>
                                            <option value="linkedin">LinkedIn</option>
                                            <option value="github">GitHub</option>
                                            <option value="twitter">Twitter</option>
                                            <option value="instagram">Instagram</option>
                                            <option value="facebook">Facebook</option>
                                            <option value="other">Other</option>
                                        </select>

                                        <input type="text" wire:model="socialMedia.{{ $index }}.name"
                                            placeholder="Username/Profile Name"
                                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">

                                        <input type="url" wire:model="socialMedia.{{ $index }}.link"
                                            placeholder="Profile URL"
                                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">
                                    </div>
                                </div>
                            @endforeach

                            @if (count($socialMedia) == 0)
                                <p class="text-gray-500 text-center py-4">No social media added yet</p>
                            @endif
                        </div>
                    </div>
                @endif

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
                                        <input type="text"
                                            wire:model="seaExperiences.{{ $index }}.vessel_name"
                                            placeholder="Vessel Name"
                                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">

                                        <input type="text"
                                            wire:model="seaExperiences.{{ $index }}.vessel_type"
                                            placeholder="Vessel Type"
                                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">

                                        <input type="text"
                                            wire:model="seaExperiences.{{ $index }}.gross_tonnage"
                                            placeholder="Gross Tonnage (GT)"
                                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">

                                        <input type="text"
                                            wire:model="seaExperiences.{{ $index }}.engine_type"
                                            placeholder="Engine Type"
                                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">

                                        <input type="text"
                                            wire:model="seaExperiences.{{ $index }}.engine_power"
                                            placeholder="Engine Power (KW)"
                                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">

                                        <input type="text" wire:model="seaExperiences.{{ $index }}.rank"
                                            placeholder="Rank/Position"
                                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">

                                        <input type="text" wire:model="seaExperiences.{{ $index }}.company"
                                            placeholder="Company/Owner"
                                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">

                                        <input type="text"
                                            wire:model="seaExperiences.{{ $index }}.contract_type"
                                            placeholder="Contract Type"
                                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">

                                        <input type="date" wire:model="seaExperiences.{{ $index }}.sign_on"
                                            placeholder="Sign On Date"
                                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">

                                        <input type="date"
                                            wire:model="seaExperiences.{{ $index }}.sign_off"
                                            placeholder="Sign Off Date"
                                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">

                                        <input type="text"
                                            wire:model="seaExperiences.{{ $index }}.sailing_area"
                                            placeholder="Sailing Area"
                                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 col-span-2">
                                    </div>

                                    <textarea wire:model="seaExperiences.{{ $index }}.duties" placeholder="Duties & Responsibilities"
                                        rows="2"
                                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 mb-3"></textarea>

                                    <textarea wire:model="seaExperiences.{{ $index }}.notes" placeholder="Additional Notes" rows="2"
                                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600 mb-2"></textarea>

                                    <label class="flex items-center">
                                        <input type="checkbox"
                                            wire:model="seaExperiences.{{ $index }}.is_current"
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

                                        <input type="date"
                                            wire:model="documents.{{ $index }}.expiration_date"
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

                {{-- STEP 6: Review --}}
                @if ($currentStep == 6)
                    <div>
                        <h3 class="text-2xl font-semibold text-gray-800 mb-6">Review Your CV Data</h3>

                        <div class="space-y-6">
                            {{-- Personal Information --}}
                            <div
                                class="p-6 bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg border border-blue-200">
                                <div class="flex justify-between items-start mb-4">
                                    <h4 class="font-semibold text-lg text-gray-800">Personal Information</h4>
                                    <button type="button" wire:click="goToStep(1)"
                                        class="text-blue-600 hover:text-blue-800 text-sm font-medium">Edit</button>
                                </div>

                                <div class="grid grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <span class="text-gray-600">Name:</span>
                                        <p class="font-semibold text-gray-800">{{ $first_name }}
                                            {{ $last_name }}</p>
                                    </div>

                                    @if ($job_title)
                                        <div>
                                            <span class="text-gray-600">Job Title:</span>
                                            <p class="font-semibold text-gray-800">{{ $job_title }}</p>
                                        </div>
                                    @endif

                                    <div>
                                        <span class="text-gray-600">Email:</span>
                                        <p class="font-semibold text-gray-800">{{ $email }}</p>
                                    </div>

                                    <div>
                                        <span class="text-gray-600">Phone:</span>
                                        <p class="font-semibold text-gray-800">{{ $phone }}</p>
                                    </div>

                                    @if ($address)
                                        <div class="col-span-2">
                                            <span class="text-gray-600">Address:</span>
                                            <p class="font-semibold text-gray-800">{{ $address }}</p>
                                        </div>
                                    @endif

                                    @if ($birthdate)
                                        <div>
                                            <span class="text-gray-600">Birthdate:</span>
                                            <p class="font-semibold text-gray-800">
                                                {{ \Carbon\Carbon::parse($birthdate)->format('d M Y') }}</p>
                                        </div>
                                    @endif

                                    @if ($gender)
                                        <div>
                                            <span class="text-gray-600">Gender:</span>
                                            <p class="font-semibold text-gray-800">{{ ucfirst($gender) }}</p>
                                        </div>
                                    @endif

                                    @if ($marital_status)
                                        <div>
                                            <span class="text-gray-600">Marital Status:</span>
                                            <p class="font-semibold text-gray-800">{{ ucfirst($marital_status) }}
                                            </p>
                                        </div>
                                    @endif
                                </div>

                                @if ($summary)
                                    <div class="mt-4">
                                        <span class="text-gray-600">Summary:</span>
                                        <p class="text-gray-700 mt-1">{{ $summary }}</p>
                                    </div>
                                @endif
                            </div>

                            {{-- Education & Experience --}}
                            <div
                                class="p-6 bg-gradient-to-r from-green-50 to-green-100 rounded-lg border border-green-200">
                                <div class="flex justify-between items-start mb-4">
                                    <h4 class="font-semibold text-lg text-gray-800">Education & Experience</h4>
                                    <button type="button" wire:click="goToStep(2)"
                                        class="text-green-600 hover:text-green-800 text-sm font-medium">Edit</button>
                                </div>

                                <div class="space-y-4">
                                    <div>
                                        <span class="text-gray-600 font-medium">Education:</span>
                                        <p class="text-gray-800">
                                            {{ count($educations) }}
                                            {{ count($educations) == 1 ? 'entry' : 'entries' }}
                                            @if (count($educations) > 0)
                                                <span class="text-gray-600 text-sm ml-2">
                                                    ({{ collect($educations)->pluck('school')->filter()->implode(', ') }})
                                                </span>
                                            @endif
                                        </p>
                                    </div>

                                    <div>
                                        <span class="text-gray-600 font-medium">Work Experience:</span>
                                        <p class="text-gray-800">
                                            {{ count($experiences) }}
                                            {{ count($experiences) == 1 ? 'entry' : 'entries' }}
                                            @if (count($experiences) > 0)
                                                <span class="text-gray-600 text-sm ml-2">
                                                    ({{ collect($experiences)->pluck('company')->filter()->implode(', ') }})
                                                </span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- Skills & Languages --}}
                            <div
                                class="p-6 bg-gradient-to-r from-purple-50 to-purple-100 rounded-lg border border-purple-200">
                                <div class="flex justify-between items-start mb-4">
                                    <h4 class="font-semibold text-lg text-gray-800">Skills & Languages</h4>
                                    <button type="button" wire:click="goToStep(3)"
                                        class="text-purple-600 hover:text-purple-800 text-sm font-medium">Edit</button>
                                </div>

                                <div class="space-y-4">
                                    <div>
                                        <span class="text-gray-600 font-medium">Hard Skills:</span>
                                        <p class="text-gray-800">{{ count($hardSkills) }} skills</p>
                                        @if (count($hardSkills) > 0)
                                            <div class="flex flex-wrap gap-2 mt-2">
                                                @foreach (collect($hardSkills)->pluck('skill_name')->filter()->take(5) as $skill)
                                                    <span
                                                        class="bg-purple-200 text-purple-800 px-2 py-1 rounded text-xs">{{ $skill }}</span>
                                                @endforeach
                                                @if (count($hardSkills) > 5)
                                                    <span class="text-gray-600 text-xs">+{{ count($hardSkills) - 5 }}
                                                        more</span>
                                                @endif
                                            </div>
                                        @endif
                                    </div>

                                    <div>
                                        <span class="text-gray-600 font-medium">Soft Skills:</span>
                                        <p class="text-gray-800">{{ count($softSkills) }} skills</p>
                                        @if (count($softSkills) > 0)
                                            <div class="flex flex-wrap gap-2 mt-2">
                                                @foreach (collect($softSkills)->pluck('skill_name')->filter()->take(5) as $skill)
                                                    <span
                                                        class="bg-purple-200 text-purple-800 px-2 py-1 rounded text-xs">{{ $skill }}</span>
                                                @endforeach
                                                @if (count($softSkills) > 5)
                                                    <span class="text-gray-600 text-xs">+{{ count($softSkills) - 5 }}
                                                        more</span>
                                                @endif
                                            </div>
                                        @endif
                                    </div>

                                    <div>
                                        <span class="text-gray-600 font-medium">Languages:</span>
                                        <p class="text-gray-800">
                                            {{ count($languages) }}
                                            {{ count($languages) == 1 ? 'language' : 'languages' }}
                                            @if (count($languages) > 0)
                                                <span class="text-gray-600 text-sm ml-2">
                                                    ({{ collect($languages)->pluck('language')->filter()->implode(', ') }})
                                                </span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- Achievements & More --}}
                            <div
                                class="p-6 bg-gradient-to-r from-amber-50 to-amber-100 rounded-lg border border-amber-200">
                                <div class="flex justify-between items-start mb-4">
                                    <h4 class="font-semibold text-lg text-gray-800">Achievements & Certifications
                                    </h4>
                                    <button type="button" wire:click="goToStep(4)"
                                        class="text-amber-600 hover:text-amber-800 text-sm font-medium">Edit</button>
                                </div>

                                <div class="grid grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <span class="text-gray-600">Achievements:</span>
                                        <p class="font-semibold text-gray-800">{{ count($achievements) }} entries
                                        </p>
                                    </div>

                                    <div>
                                        <span class="text-gray-600">Certifications:</span>
                                        <p class="font-semibold text-gray-800">{{ count($certifications) }}
                                            entries</p>
                                    </div>

                                    <div>
                                        <span class="text-gray-600">References:</span>
                                        <p class="font-semibold text-gray-800">{{ count($references) }} entries
                                        </p>
                                    </div>

                                    <div>
                                        <span class="text-gray-600">Social Media:</span>
                                        <p class="font-semibold text-gray-800">{{ count($socialMedia) }} entries
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- Sea Experience & Documents --}}
                            <div
                                class="p-6 bg-gradient-to-r from-cyan-50 to-cyan-100 rounded-lg border border-cyan-200">
                                <div class="flex justify-between items-start mb-4">
                                    <h4 class="font-semibold text-lg text-gray-800">Sea Experience & Documents</h4>
                                    <button type="button" wire:click="goToStep(5)"
                                        class="text-cyan-600 hover:text-cyan-800 text-sm font-medium">Edit</button>
                                </div>

                                <div class="grid grid-cols-2 gap-4 text-sm">
                                    <div>
                                        <span class="text-gray-600">Sea Experiences:</span>
                                        <p class="font-semibold text-gray-800">{{ count($seaExperiences) }}
                                            entries</p>
                                    </div>

                                    <div>
                                        <span class="text-gray-600">Documents:</span>
                                        <p class="font-semibold text-gray-800">{{ count($documents) }} entries
                                        </p>
                                    </div>
                                </div>
                            </div>

                            {{-- Summary Stats --}}
                            <div
                                class="p-6 bg-gradient-to-r from-gray-50 to-gray-100 rounded-lg border-2 border-gray-300">
                                <h4 class="font-semibold text-lg text-gray-800 mb-4 text-center">Total Data Summary
                                </h4>

                                <div class="grid grid-cols-3 gap-4 text-center">
                                    <div class="p-3 bg-white rounded-lg shadow-sm">
                                        <p class="text-2xl font-bold text-blue-600">
                                            {{ count($educations) + count($experiences) }}</p>
                                        <p class="text-xs text-gray-600">Edu + Exp</p>
                                    </div>

                                    <div class="p-3 bg-white rounded-lg shadow-sm">
                                        <p class="text-2xl font-bold text-purple-600">
                                            {{ count($hardSkills) + count($softSkills) + count($languages) }}</p>
                                        <p class="text-xs text-gray-600">Skills + Lang</p>
                                    </div>

                                    <div class="p-3 bg-white rounded-lg shadow-sm">
                                        <p class="text-2xl font-bold text-amber-600">
                                            {{ count($achievements) + count($certifications) }}</p>
                                        <p class="text-xs text-gray-600">Achievements</p>
                                    </div>
                                </div>
                            </div>

                            {{-- Final Note --}}
                            <div class="p-4 bg-blue-50 border-l-4 border-blue-600 text-blue-800 rounded">
                                <p class="font-medium">✓ Ready to Submit</p>
                                <p class="text-sm mt-1">Review all your information above. Click on "Edit" buttons
                                    to modify any section, or click "Submit CV" to save your data.</p>
                            </div>
                        </div>
                    </div>
                @endif

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
                            wire:loading.attr="disabled" wire:target="save"
                            @if ($isSubmitted) disabled @endif>

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

            </form>
        </div>
    </div>
    <div class="col-span-3 bg-blue-200 p-8 overflow-y-scroll">
        @include('components.templates.' . $selectedTemplate)
    </div>
</div>
