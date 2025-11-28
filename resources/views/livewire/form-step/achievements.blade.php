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

                        <input type="date" wire:model="achievements.{{ $index }}.year" placeholder="Year"
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

                        <input type="email" wire:model="references.{{ $index }}.email" placeholder="Email"
                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">

                        <input type="text" wire:model="references.{{ $index }}.phone"
                            placeholder="Phone Number"
                            class="px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-600">

                        <input type="text" wire:model="references.{{ $index }}.company" placeholder="Company"
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
