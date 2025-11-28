{{-- STEP 3: Skills & Languages --}}
@if ($currentStep == 3)
    <div>
        <h3 class="text-2xl font-semibold text-gray-800 mb-6">Skills & Languages</h3>

        {{-- Hard Skills Section --}}
        <div class="mb-8">
            {{-- Header --}}
            <div class="flex justify-between items-center mb-4">
                <h4 class="text-xl font-semibold text-gray-700">Hard Skills</h4>
                <button type="button" wire:click="addHardSkill"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-medium flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Hard Skill
                </button>
            </div>

            <div class="space-y-3">
                @foreach ($hardSkills as $index => $skill)
                    <div x-data="{
                        expanded: {{ empty($skill['skill_name']) ? 'true' : 'false' }},
                        name: @entangle("hardSkills.{$index}.skill_name"),
                        level: @entangle("hardSkills.{$index}.level")
                    }"
                        class="border border-gray-200 rounded-lg bg-white shadow-sm overflow-hidden transition-all duration-200"
                        :class="expanded ? 'ring-2 ring-blue-500 ring-opacity-50' : 'hover:border-blue-300'">

                        {{-- Accordion Header --}}
                        <div @click="expanded = !expanded"
                            class="flex justify-between items-center p-4 cursor-pointer bg-gray-50 hover:bg-gray-100 transition select-none">

                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-gray-500 transition-transform duration-200"
                                    :class="expanded ? 'transform rotate-180' : ''" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>

                                <div class="flex flex-col">
                                    <div class="flex items-center gap-2">
                                        <span class="font-bold text-gray-700 text-sm"
                                            x-text="name || 'New Hard Skill'"></span>
                                        {{-- Badge Level --}}
                                        <span x-show="level" x-text="level"
                                            class="px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-blue-100 text-blue-700 tracking-wide"></span>
                                    </div>
                                    <span x-show="!expanded && !name" class="text-xs text-gray-400">Click to edit
                                        details</span>
                                </div>
                            </div>

                            <button type="button" wire:click="removeHardSkill({{ $index }})" @click.stop
                                class="text-red-500 hover:text-red-700 p-1 rounded hover:bg-red-50 transition"
                                title="Remove">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>
                            </button>
                        </div>

                        {{-- Accordion Body --}}
                        <div x-show="expanded" x-collapse class="p-4 border-t border-gray-200 bg-white">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="md:col-span-1">
                                    <label class="text-xs font-semibold text-gray-500 mb-1 block">Skill
                                        Name</label>
                                    <input type="text" x-model="name"
                                        wire:model="hardSkills.{{ $index }}.skill_name"
                                        placeholder="Ex: PHP, Laravel"
                                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                                </div>

                                <div class="md:col-span-1">
                                    <label class="text-xs font-semibold text-gray-500 mb-1 block">Level</label>
                                    <select x-model="level" wire:model="hardSkills.{{ $index }}.level"
                                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm bg-white">
                                        <option value="">Select Level</option>
                                        <option value="beginner">Beginner</option>
                                        <option value="intermediate">Intermediate</option>
                                        <option value="advanced">Advanced</option>
                                        <option value="expert">Expert</option>
                                    </select>
                                </div>

                                <div class="md:col-span-1">
                                    <label class="text-xs font-semibold text-gray-500 mb-1 block">Scale
                                        (1-10)
                                    </label>
                                    <input type="number" wire:model="hardSkills.{{ $index }}.scale"
                                        placeholder="1-10" min="1" max="10"
                                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                @if (count($hardSkills) == 0)
                    <div class="text-center py-6 border-2 border-dashed border-gray-200 rounded-lg">
                        <p class="text-gray-500 text-sm">No hard skills added yet.</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Soft Skills Section --}}
        <div class="mb-8">
            {{-- Header --}}
            <div class="flex justify-between items-center mb-4">
                <h4 class="text-xl font-semibold text-gray-700">Soft Skills</h4>
                <button type="button" wire:click="addSoftSkill"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-medium flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Soft Skill
                </button>
            </div>

            <div class="space-y-3">
                @foreach ($softSkills as $index => $skill)
                    <div x-data="{
                        expanded: {{ empty($skill['skill_name']) ? 'true' : 'false' }},
                        name: @entangle("softSkills.{$index}.skill_name"),
                        level: @entangle("softSkills.{$index}.level")
                    }"
                        class="border border-gray-200 rounded-lg bg-white shadow-sm overflow-hidden transition-all duration-200"
                        :class="expanded ? 'ring-2 ring-blue-500 ring-opacity-50' : 'hover:border-blue-300'">

                        {{-- Accordion Header --}}
                        <div @click="expanded = !expanded"
                            class="flex justify-between items-center p-4 cursor-pointer bg-gray-50 hover:bg-gray-100 transition select-none">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-gray-500 transition-transform duration-200"
                                    :class="expanded ? 'transform rotate-180' : ''" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>

                                <div class="flex flex-col">
                                    <div class="flex items-center gap-2">
                                        <span class="font-bold text-gray-700 text-sm"
                                            x-text="name || 'New Soft Skill'"></span>
                                        <span x-show="level" x-text="level"
                                            class="px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-green-100 text-green-700 tracking-wide"></span>
                                    </div>
                                    <span x-show="!expanded && !name" class="text-xs text-gray-400">Click to edit
                                        details</span>
                                </div>
                            </div>

                            <button type="button" wire:click="removeSoftSkill({{ $index }})" @click.stop
                                class="text-red-500 hover:text-red-700 p-1 rounded hover:bg-red-50 transition"><svg
                                    class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg></button>
                        </div>

                        {{-- Accordion Body --}}
                        <div x-show="expanded" x-collapse class="p-4 border-t border-gray-200 bg-white">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div class="md:col-span-1">
                                    <label class="text-xs font-semibold text-gray-500 mb-1 block">Skill
                                        Name</label>
                                    <input type="text" x-model="name"
                                        wire:model="softSkills.{{ $index }}.skill_name"
                                        placeholder="Ex: Leadership"
                                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                                </div>

                                <div class="md:col-span-1">
                                    <label class="text-xs font-semibold text-gray-500 mb-1 block">Level</label>
                                    <select x-model="level" wire:model="softSkills.{{ $index }}.level"
                                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm bg-white">
                                        <option value="">Select Level</option>
                                        <option value="beginner">Beginner</option>
                                        <option value="intermediate">Intermediate</option>
                                        <option value="advanced">Advanced</option>
                                        <option value="expert">Expert</option>
                                    </select>
                                </div>

                                <div class="md:col-span-1">
                                    <label class="text-xs font-semibold text-gray-500 mb-1 block">Scale
                                        (1-10)
                                    </label>
                                    <input type="number" wire:model="softSkills.{{ $index }}.scale"
                                        placeholder="1-10" min="1" max="10"
                                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                @if (count($softSkills) == 0)
                    <div class="text-center py-6 border-2 border-dashed border-gray-200 rounded-lg">
                        <p class="text-gray-500 text-sm">No soft skills added yet.</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Languages Section --}}
        <div>
            {{-- Header --}}
            <div class="flex justify-between items-center mb-4">
                <h4 class="text-xl font-semibold text-gray-700">Languages</h4>
                <button type="button" wire:click="addLanguage"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 text-sm font-medium flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Language
                </button>
            </div>

            <div class="space-y-3">
                @foreach ($languages as $index => $language)
                    <div x-data="{
                        expanded: {{ empty($language['language']) ? 'true' : 'false' }},
                        name: @entangle("languages.{$index}.language"),
                        level: @entangle("languages.{$index}.level")
                    }"
                        class="border border-gray-200 rounded-lg bg-white shadow-sm overflow-hidden transition-all duration-200"
                        :class="expanded ? 'ring-2 ring-blue-500 ring-opacity-50' : 'hover:border-blue-300'">

                        {{-- Accordion Header --}}
                        <div @click="expanded = !expanded"
                            class="flex justify-between items-center p-4 cursor-pointer bg-gray-50 hover:bg-gray-100 transition select-none">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 text-gray-500 transition-transform duration-200"
                                    :class="expanded ? 'transform rotate-180' : ''" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>

                                <div class="flex flex-col">
                                    <div class="flex items-center gap-2">
                                        <span class="font-bold text-gray-700 text-sm"
                                            x-text="name || 'New Language'"></span>
                                        <span x-show="level" x-text="level"
                                            class="px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-purple-100 text-purple-700 tracking-wide"></span>
                                    </div>
                                    <span x-show="!expanded && !name" class="text-xs text-gray-400">Click to edit
                                        details</span>
                                </div>
                            </div>

                            <button type="button" wire:click="removeLanguage({{ $index }})" @click.stop
                                class="text-red-500 hover:text-red-700 p-1 rounded hover:bg-red-50 transition"><svg
                                    class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg></button>
                        </div>

                        {{-- Accordion Body --}}
                        <div x-show="expanded" x-collapse class="p-4 border-t border-gray-200 bg-white">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="md:col-span-1">
                                    <label class="text-xs font-semibold text-gray-500 mb-1 block">Language</label>
                                    <input type="text" x-model="name"
                                        wire:model="languages.{{ $index }}.language" placeholder="Ex: English"
                                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                                </div>

                                <div class="md:col-span-1">
                                    <label class="text-xs font-semibold text-gray-500 mb-1 block">Proficiency</label>
                                    <select x-model="level" wire:model="languages.{{ $index }}.level"
                                        class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm bg-white">
                                        <option value="">Select Proficiency</option>
                                        <option value="basic">Basic</option>
                                        <option value="conversational">Conversational</option>
                                        <option value="fluent">Fluent</option>
                                        <option value="native">Native</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                @if (count($languages) == 0)
                    <div class="text-center py-6 border-2 border-dashed border-gray-200 rounded-lg">
                        <p class="text-gray-500 text-sm">No languages added yet.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endif
