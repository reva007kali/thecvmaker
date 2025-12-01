@if ($currentStep == 3)
    <div class="animate-fade-in-up space-y-12">

        <!-- HEADER SECTION -->
        <div class="border-b-2 border-black pb-6 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h3 class="font-display text-4xl font-bold uppercase tracking-tighter text-black leading-none">
                    Abilities
                </h3>
                <p
                    class="font-mono text-sm text-gray-500 mt-2 bg-yellow-300 inline-block px-2 border border-black shadow-[2px_2px_0px_0px_black]">
                    Step 03: Skills & Languages
                </p>
            </div>
            <div class="text-right hidden md:block">
                <p class="text-xs font-mono text-gray-400">Be honest with levels.</p>
                <p class="text-xs font-mono text-gray-400">Showcase your strengths.</p>
            </div>
        </div>

        {{-- ===================================================
         1. HARD SKILLS (Blue Theme)
         =================================================== --}}
        <div>
            {{-- Header --}}
            <div class="flex justify-between items-end mb-6">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 bg-accent-blue text-white flex items-center justify-center border-2 border-black">
                        <i data-lucide="cpu" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h4 class="font-display text-2xl font-bold uppercase leading-none">Hard Skills</h4>
                        <p class="font-mono text-[10px] text-gray-500 uppercase mt-1">Technical & Tools</p>
                    </div>
                </div>

                <button type="button" wire:click="addHardSkill"
                    class="group flex items-center gap-2 px-4 py-2 bg-white border-2 border-black text-xs font-mono font-bold uppercase hover:bg-black hover:text-white transition-all shadow-[4px_4px_0px_0px_black] active:translate-x-[2px] active:translate-y-[2px] active:shadow-none">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    <span>Add New</span>
                </button>
            </div>

            {{-- List --}}
            <div class="space-y-4">
                @foreach ($hardSkills as $index => $skill)
                    <div x-data="{
                        expanded: {{ empty($skill['skill_name']) ? 'true' : 'false' }},
                        name: @entangle("hardSkills.{$index}.skill_name"),
                        level: @entangle("hardSkills.{$index}.level")
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
                                        x-text="name || 'NEW HARD SKILL'"></span>

                                    <div class="flex items-center gap-2 mt-1" x-show="!expanded">
                                        <span x-show="level" x-text="level"
                                            class="px-2 py-0.5 border border-black bg-accent-blue text-white font-mono text-[10px] font-bold uppercase">
                                        </span>
                                        <span x-show="!level && !expanded"
                                            class="font-mono text-[10px] opacity-60 uppercase">Click to edit</span>
                                    </div>
                                </div>
                            </div>

                            <button type="button" wire:click="removeHardSkill({{ $index }})" @click.stop
                                class="p-2 border-2 border-transparent hover:border-red-500 hover:bg-red-500 hover:text-white transition-colors"
                                :class="expanded ? 'text-gray-400 hover:border-white' : 'text-gray-400'">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </div>

                        {{-- Accordion Body --}}
                        <div x-show="expanded" x-collapse class="p-6 bg-white">
                            <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                                {{-- Name --}}
                                <div class="md:col-span-6">
                                    <label class="block font-mono font-bold text-xs uppercase mb-2">Skill Name</label>
                                    <input type="text" x-model="name"
                                        wire:model.blur="hardSkills.{{ $index }}.skill_name"
                                        placeholder="e.g. Laravel, Photoshop"
                                        class="w-full bg-white border-2 border-black p-3 font-bold focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                </div>

                                {{-- Level --}}
                                <div class="md:col-span-4">
                                    <label class="block font-mono font-bold text-xs uppercase mb-2">Level</label>
                                    <div class="relative">
                                        <select x-model="level" wire:model.blur="hardSkills.{{ $index }}.level"
                                            class="w-full bg-white border-2 border-black p-3 appearance-none font-medium focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                            <option value="">Select...</option>
                                            <option value="Beginner">Beginner</option>
                                            <option value="Intermediate">Intermediate</option>
                                            <option value="Advanced">Advanced</option>
                                            <option value="Expert">Expert</option>
                                        </select>
                                        <i data-lucide="chevron-down"
                                            class="absolute right-3 top-3.5 w-5 h-5 pointer-events-none"></i>
                                    </div>
                                </div>

                                {{-- Score (Range Slider) --}}
                                <div class="md:col-span-2">
                                    <label class="block font-mono font-bold text-xs uppercase mb-2">Score (1-10)</label>
                                    <div class="flex items-center gap-2 border-2 border-black p-3 bg-gray-50">
                                        <input type="number" wire:model.blur="hardSkills.{{ $index }}.scale"
                                            min="1" max="10"
                                            class="w-full bg-transparent font-display font-bold text-lg text-center focus:outline-none">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- ===================================================
         2. SOFT SKILLS (Green Theme)
         =================================================== --}}
        <div>
            <div class="flex justify-between items-end mb-6 pt-8 border-t-2 border-black border-dashed">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 bg-green-500 text-black flex items-center justify-center border-2 border-black">
                        <i data-lucide="users" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h4 class="font-display text-2xl font-bold uppercase leading-none">Soft Skills</h4>
                        <p class="font-mono text-[10px] text-gray-500 uppercase mt-1">Interpersonal & Leadership</p>
                    </div>
                </div>

                <button type="button" wire:click="addSoftSkill"
                    class="group flex items-center gap-2 px-4 py-2 bg-white border-2 border-black text-xs font-mono font-bold uppercase hover:bg-black hover:text-white transition-all shadow-[4px_4px_0px_0px_black] active:translate-x-[2px] active:translate-y-[2px] active:shadow-none">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    <span>Add New</span>
                </button>
            </div>

            <div class="space-y-4">
                @foreach ($softSkills as $index => $skill)
                    <div x-data="{
                        expanded: {{ empty($skill['skill_name']) ? 'true' : 'false' }},
                        name: @entangle("softSkills.{$index}.skill_name"),
                        level: @entangle("softSkills.{$index}.level")
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
                                        x-text="name || 'NEW SOFT SKILL'"></span>

                                    <div class="flex items-center gap-2 mt-1" x-show="!expanded">
                                        <span x-show="level" x-text="level"
                                            class="px-2 py-0.5 border border-black bg-green-500 text-black font-mono text-[10px] font-bold uppercase">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <button type="button" wire:click="removeSoftSkill({{ $index }})" @click.stop
                                class="p-2 border-2 border-transparent hover:border-red-500 hover:bg-red-500 hover:text-white transition-colors"
                                :class="expanded ? 'text-gray-400 hover:border-white' : 'text-gray-400'">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </div>

                        <div x-show="expanded" x-collapse class="p-6 bg-white">
                            <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                                <div class="md:col-span-6">
                                    <label class="block font-mono font-bold text-xs uppercase mb-2">Skill Name</label>
                                    <input type="text" x-model="name"
                                        wire:model.blur="softSkills.{{ $index }}.skill_name"
                                        placeholder="e.g. Leadership"
                                        class="w-full bg-white border-2 border-black p-3 font-bold focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                </div>
                                <div class="md:col-span-4">
                                    <label class="block font-mono font-bold text-xs uppercase mb-2">Level</label>
                                    <div class="relative">
                                        <select x-model="level" wire:model.blur="softSkills.{{ $index }}.level"
                                            class="w-full bg-white border-2 border-black p-3 appearance-none font-medium focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                            <option value="">Select...</option>
                                            <option value="Beginner">Beginner</option>
                                            <option value="Intermediate">Intermediate</option>
                                            <option value="Advanced">Advanced</option>
                                            <option value="Expert">Expert</option>
                                        </select>
                                        <i data-lucide="chevron-down"
                                            class="absolute right-3 top-3.5 w-5 h-5 pointer-events-none"></i>
                                    </div>
                                </div>
                                <div class="md:col-span-2">
                                    <label class="block font-mono font-bold text-xs uppercase mb-2">Score</label>
                                    <div class="flex items-center gap-2 border-2 border-black p-3 bg-gray-50">
                                        <input type="number" wire:model.blur="softSkills.{{ $index }}.scale"
                                            min="1" max="10"
                                            class="w-full bg-transparent font-display font-bold text-lg text-center focus:outline-none">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- ===================================================
         3. LANGUAGES (Purple Theme)
         =================================================== --}}
        <div>
            <div class="flex justify-between items-end mb-6 pt-8 border-t-2 border-black border-dashed">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 bg-purple-500 text-white flex items-center justify-center border-2 border-black">
                        <i data-lucide="languages" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h4 class="font-display text-2xl font-bold uppercase leading-none">Languages</h4>
                        <p class="font-mono text-[10px] text-gray-500 uppercase mt-1">Communication</p>
                    </div>
                </div>

                <button type="button" wire:click="addLanguage"
                    class="group flex items-center gap-2 px-4 py-2 bg-white border-2 border-black text-xs font-mono font-bold uppercase hover:bg-black hover:text-white transition-all shadow-[4px_4px_0px_0px_black] active:translate-x-[2px] active:translate-y-[2px] active:shadow-none">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    <span>Add New</span>
                </button>
            </div>

            <div class="space-y-4">
                @foreach ($languages as $index => $language)
                    <div x-data="{
                        expanded: {{ empty($language['language']) ? 'true' : 'false' }},
                        name: @entangle("languages.{$index}.language"),
                        level: @entangle("languages.{$index}.level")
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
                                        x-text="name || 'NEW LANGUAGE'"></span>

                                    <div class="flex items-center gap-2 mt-1" x-show="!expanded">
                                        <span x-show="level" x-text="level"
                                            class="px-2 py-0.5 border border-black bg-purple-500 text-white font-mono text-[10px] font-bold uppercase">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <button type="button" wire:click="removeLanguage({{ $index }})" @click.stop
                                class="p-2 border-2 border-transparent hover:border-red-500 hover:bg-red-500 hover:text-white transition-colors"
                                :class="expanded ? 'text-gray-400 hover:border-white' : 'text-gray-400'">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </div>

                        <div x-show="expanded" x-collapse class="p-6 bg-white">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block font-mono font-bold text-xs uppercase mb-2">Language
                                        Name</label>
                                    <input type="text" x-model="name"
                                        wire:model.blur="languages.{{ $index }}.language"
                                        placeholder="e.g. English"
                                        class="w-full bg-white border-2 border-black p-3 font-bold focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                </div>
                                <div>
                                    <label class="block font-mono font-bold text-xs uppercase mb-2">Proficiency</label>
                                    <div class="relative">
                                        <select x-model="level" wire:model.blur="languages.{{ $index }}.level"
                                            class="w-full bg-white border-2 border-black p-3 appearance-none font-medium focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                            <option value="">Select...</option>
                                            <option value="Basic">Basic</option>
                                            <option value="Conversational">Conversational</option>
                                            <option value="Fluent">Fluent</option>
                                            <option value="Native">Native</option>
                                        </select>
                                        <i data-lucide="chevron-down"
                                            class="absolute right-3 top-3.5 w-5 h-5 pointer-events-none"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endif
