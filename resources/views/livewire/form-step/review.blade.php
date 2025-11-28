{{-- STEP 6: Review --}}
@if ($currentStep == 6)
    <div>
        <h3 class="text-2xl font-semibold text-gray-800 mb-6">Review Your CV Data</h3>

        <div class="space-y-6">
            {{-- Personal Information --}}
            <div class="p-6 bg-gradient-to-r from-blue-50 to-blue-100 rounded-lg border border-blue-200">
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
            <div class="p-6 bg-gradient-to-r from-green-50 to-green-100 rounded-lg border border-green-200">
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
            <div class="p-6 bg-gradient-to-r from-purple-50 to-purple-100 rounded-lg border border-purple-200">
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
            <div class="p-6 bg-gradient-to-r from-amber-50 to-amber-100 rounded-lg border border-amber-200">
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
            <div class="p-6 bg-gradient-to-r from-cyan-50 to-cyan-100 rounded-lg border border-cyan-200">
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
            <div class="p-6 bg-gradient-to-r from-gray-50 to-gray-100 rounded-lg border-2 border-gray-300">
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
