@if ($currentStep == 4)
    <div class="animate-fade-in-up space-y-12">

        <!-- HEADER SECTION -->
        <div class="border-b-2 border-black pb-6 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h3 class="font-display text-4xl font-bold uppercase tracking-tighter text-black leading-none">
                    Credentials
                </h3>
                <p
                    class="font-mono text-sm text-gray-500 mt-2 bg-yellow-300 inline-block px-2 border border-black shadow-[2px_2px_0px_0px_black]">
                    Step 04: Awards & Refs
                </p>
            </div>
            <div class="text-right hidden md:block">
                <p class="text-xs font-mono text-gray-400">Validate your skills.</p>
                <p class="text-xs font-mono text-gray-400">Build trust.</p>
            </div>
        </div>

        {{-- ===================================================
         1. ACHIEVEMENTS (Yellow Theme)
         =================================================== --}}
        <div>
            <div class="flex justify-between items-end mb-6">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 bg-yellow-400 text-black flex items-center justify-center border-2 border-black">
                        <i data-lucide="trophy" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h4 class="font-display text-2xl font-bold uppercase leading-none">Achievements</h4>
                        <p class="font-mono text-[10px] text-gray-500 uppercase mt-1">Awards & Honors</p>
                    </div>
                </div>

                <button type="button" wire:click="addAchievement"
                    class="group flex items-center gap-2 px-4 py-2 bg-white border-2 border-black text-xs font-mono font-bold uppercase hover:bg-black hover:text-white transition-all shadow-[4px_4px_0px_0px_black] active:translate-x-[2px] active:translate-y-[2px] active:shadow-none">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    <span>Add New</span>
                </button>
            </div>

            <div class="space-y-4">
                @foreach ($achievements as $index => $achievement)
                    <div x-data="{
                        expanded: {{ empty($achievement['name']) ? 'true' : 'false' }},
                        name: @entangle("achievements.{$index}.name")
                    }" class="border-2 border-black bg-white transition-all duration-200"
                        :class="expanded ? 'shadow-[8px_8px_0px_0px_black] -translate-y-1' :
                            'hover:shadow-[4px_4px_0px_0px_black] hover:-translate-y-[2px]'">

                        {{-- Header --}}
                        <div @click="expanded = !expanded"
                            class="flex justify-between items-center p-4 cursor-pointer select-none group"
                            :class="expanded ? 'bg-black text-white border-b-2 border-black' : 'bg-white text-black'">

                            <div class="flex items-center gap-4">
                                <div class="transition-transform duration-200" :class="expanded ? 'rotate-180' : ''">
                                    <i data-lucide="chevron-down" class="w-5 h-5"></i>
                                </div>
                                <span class="font-display font-bold text-lg uppercase tracking-wide"
                                    x-text="name || 'NEW ACHIEVEMENT'"></span>
                            </div>

                            <button type="button" wire:click="removeAchievement({{ $index }})" @click.stop
                                class="p-2 border-2 border-transparent hover:border-red-500 hover:bg-red-500 hover:text-white transition-colors"
                                :class="expanded ? 'text-gray-400 hover:border-white' : 'text-gray-400'">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </div>

                        {{-- Body --}}
                        <div x-show="expanded" x-collapse class="p-6 bg-white">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <label class="block font-mono font-bold text-xs uppercase mb-2">Achievement
                                        Name</label>
                                    <input type="text" x-model="name"
                                        wire:model="achievements.{{ $index }}.name"
                                        placeholder="e.g. Employee of the Year"
                                        class="w-full bg-white border-2 border-black p-3 font-bold focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                </div>
                                <div>
                                    <label class="block font-mono font-bold text-xs uppercase mb-2">Organization /
                                        Vendor</label>
                                    <input type="text" wire:model="achievements.{{ $index }}.vendor"
                                        placeholder="e.g. Google"
                                        class="w-full bg-white border-2 border-black p-3 font-medium focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                </div>
                                <div>
                                    <label class="block font-mono font-bold text-xs uppercase mb-2">Year</label>
                                    {{-- Menggunakan type="number" untuk tahun, atau date picker jika ingin full date --}}
                                    <input type="number" wire:model="achievements.{{ $index }}.year"
                                        placeholder="YYYY" min="1900" max="2099"
                                        class="w-full bg-white border-2 border-black p-3 font-mono font-bold focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- ===================================================
         2. CERTIFICATIONS (Cyan Theme)
         =================================================== --}}
        <div>
            <div class="flex justify-between items-end mb-6 pt-8 border-t-2 border-black border-dashed">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 bg-cyan-400 text-black flex items-center justify-center border-2 border-black">
                        <i data-lucide="award" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h4 class="font-display text-2xl font-bold uppercase leading-none">Certifications</h4>
                        <p class="font-mono text-[10px] text-gray-500 uppercase mt-1">Professional Licenses</p>
                    </div>
                </div>

                <button type="button" wire:click="addCertificate"
                    class="group flex items-center gap-2 px-4 py-2 bg-white border-2 border-black text-xs font-mono font-bold uppercase hover:bg-black hover:text-white transition-all shadow-[4px_4px_0px_0px_black] active:translate-x-[2px] active:translate-y-[2px] active:shadow-none">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    <span>Add New</span>
                </button>
            </div>

            <div class="space-y-4">
                @foreach ($certifications as $index => $certification)
                    <div x-data="{
                        expanded: {{ empty($certification['name']) ? 'true' : 'false' }},
                        name: @entangle("certifications.{$index}.name")
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
                                <span class="font-display font-bold text-lg uppercase tracking-wide"
                                    x-text="name || 'NEW CERTIFICATION'"></span>
                            </div>

                            <button type="button" wire:click="removeCertificate({{ $index }})" @click.stop
                                class="p-2 border-2 border-transparent hover:border-red-500 hover:bg-red-500 hover:text-white transition-colors"
                                :class="expanded ? 'text-gray-400 hover:border-white' : 'text-gray-400'">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </div>

                        <div x-show="expanded" x-collapse class="p-6 bg-white">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="md:col-span-2">
                                    <label class="block font-mono font-bold text-xs uppercase mb-2">Certification
                                        Name</label>
                                    <input type="text" x-model="name"
                                        wire:model="certifications.{{ $index }}.name"
                                        placeholder="e.g. AWS Certified Solutions Architect"
                                        class="w-full bg-white border-2 border-black p-3 font-bold focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                </div>
                                <div>
                                    <label class="block font-mono font-bold text-xs uppercase mb-2">Issuing
                                        Organization</label>
                                    <input type="text" wire:model="certifications.{{ $index }}.vendor"
                                        placeholder="e.g. Amazon Web Services"
                                        class="w-full bg-white border-2 border-black p-3 font-medium focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                </div>
                                <div>
                                    <label class="block font-mono font-bold text-xs uppercase mb-2">Year
                                        Obtained</label>
                                    <input type="number" wire:model="certifications.{{ $index }}.year"
                                        placeholder="YYYY" min="1900" max="2099"
                                        class="w-full bg-white border-2 border-black p-3 font-mono font-bold focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- ===================================================
         3. REFERENCES (Pink Theme)
         =================================================== --}}
        <div>
            <div class="flex justify-between items-end mb-6 pt-8 border-t-2 border-black border-dashed">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 bg-pink-400 text-black flex items-center justify-center border-2 border-black">
                        <i data-lucide="user-check" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h4 class="font-display text-2xl font-bold uppercase leading-none">References</h4>
                        <p class="font-mono text-[10px] text-gray-500 uppercase mt-1">Professional Contacts</p>
                    </div>
                </div>

                <button type="button" wire:click="addReference"
                    class="group flex items-center gap-2 px-4 py-2 bg-white border-2 border-black text-xs font-mono font-bold uppercase hover:bg-black hover:text-white transition-all shadow-[4px_4px_0px_0px_black] active:translate-x-[2px] active:translate-y-[2px] active:shadow-none">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    <span>Add New</span>
                </button>
            </div>

            <div class="space-y-4">
                @foreach ($references as $index => $reference)
                    <div x-data="{
                        expanded: {{ empty($reference['name']) ? 'true' : 'false' }},
                        name: @entangle("references.{$index}.name")
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
                                <span class="font-display font-bold text-lg uppercase tracking-wide"
                                    x-text="name || 'NEW REFERENCE'"></span>
                            </div>

                            <button type="button" wire:click="removeReference({{ $index }})" @click.stop
                                class="p-2 border-2 border-transparent hover:border-red-500 hover:bg-red-500 hover:text-white transition-colors"
                                :class="expanded ? 'text-gray-400 hover:border-white' : 'text-gray-400'">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </div>

                        <div x-show="expanded" x-collapse class="p-6 bg-white">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block font-mono font-bold text-xs uppercase mb-2">Full Name</label>
                                    <input type="text" x-model="name"
                                        wire:model="references.{{ $index }}.name" placeholder="e.g. John Doe"
                                        class="w-full bg-white border-2 border-black p-3 font-bold focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                </div>
                                <div>
                                    <label class="block font-mono font-bold text-xs uppercase mb-2">Company</label>
                                    <input type="text" wire:model="references.{{ $index }}.company"
                                        placeholder="e.g. Acme Corp"
                                        class="w-full bg-white border-2 border-black p-3 font-medium focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                </div>
                                <div>
                                    <label class="block font-mono font-bold text-xs uppercase mb-2">Email</label>
                                    <input type="email" wire:model="references.{{ $index }}.email"
                                        placeholder="email@example.com"
                                        class="w-full bg-white border-2 border-black p-3 font-medium focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                </div>
                                <div>
                                    <label class="block font-mono font-bold text-xs uppercase mb-2">Phone</label>
                                    <input type="text" wire:model="references.{{ $index }}.phone"
                                        placeholder="+62..."
                                        class="w-full bg-white border-2 border-black p-3 font-medium focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                </div>
                                <div class="md:col-span-2">
                                    <label
                                        class="block font-mono font-bold text-xs uppercase mb-2">Relationship</label>
                                    <input type="text" wire:model="references.{{ $index }}.relation"
                                        placeholder="e.g. Direct Manager, Team Lead"
                                        class="w-full bg-white border-2 border-black p-3 font-medium focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- ===================================================
         4. SOCIAL MEDIA (Gray Theme)
         =================================================== --}}
        <div>
            <div class="flex justify-between items-end mb-6 pt-8 border-t-2 border-black border-dashed">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 bg-gray-200 text-black flex items-center justify-center border-2 border-black">
                        <i data-lucide="share-2" class="w-5 h-5"></i>
                    </div>
                    <div>
                        <h4 class="font-display text-2xl font-bold uppercase leading-none">Social Media</h4>
                        <p class="font-mono text-[10px] text-gray-500 uppercase mt-1">Online Presence</p>
                    </div>
                </div>

                <button type="button" wire:click="addSocialMedia"
                    class="group flex items-center gap-2 px-4 py-2 bg-white border-2 border-black text-xs font-mono font-bold uppercase hover:bg-black hover:text-white transition-all shadow-[4px_4px_0px_0px_black] active:translate-x-[2px] active:translate-y-[2px] active:shadow-none">
                    <i data-lucide="plus" class="w-4 h-4"></i>
                    <span>Add New</span>
                </button>
            </div>

            <div class="space-y-4">
                @foreach ($socialMedia as $index => $sm)
                    <div x-data="{
                        expanded: {{ empty($sm['platform']) ? 'true' : 'false' }},
                        platform: @entangle("socialMedia.{$index}.platform")
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
                                <span class="font-display font-bold text-lg uppercase tracking-wide"
                                    x-text="platform || 'NEW SOCIAL'"></span>
                            </div>

                            <button type="button" wire:click="removeSocialMedia({{ $index }})" @click.stop
                                class="p-2 border-2 border-transparent hover:border-red-500 hover:bg-red-500 hover:text-white transition-colors"
                                :class="expanded ? 'text-gray-400 hover:border-white' : 'text-gray-400'">
                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                            </button>
                        </div>

                        <div x-show="expanded" x-collapse class="p-6 bg-white">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                <div>
                                    <label class="block font-mono font-bold text-xs uppercase mb-2">Platform</label>
                                    <div class="relative">
                                        <select x-model="platform"
                                            wire:model="socialMedia.{{ $index }}.platform"
                                            class="w-full bg-white border-2 border-black p-3 appearance-none font-bold uppercase focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                            <option value="">Select...</option>
                                            <option value="linkedin">LinkedIn</option>
                                            <option value="github">GitHub</option>
                                            <option value="twitter">Twitter</option>
                                            <option value="instagram">Instagram</option>
                                            <option value="facebook">Facebook</option>
                                            <option value="website">Personal Website</option>
                                            <option value="other">Other</option>
                                        </select>
                                        <i data-lucide="chevron-down"
                                            class="absolute right-3 top-3.5 w-5 h-5 pointer-events-none"></i>
                                    </div>
                                </div>

                                <div>
                                    <label class="block font-mono font-bold text-xs uppercase mb-2">Username /
                                        Label</label>
                                    <input type="text" wire:model="socialMedia.{{ $index }}.name"
                                        placeholder="@username"
                                        class="w-full bg-white border-2 border-black p-3 font-medium focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                </div>

                                <div>
                                    <label class="block font-mono font-bold text-xs uppercase mb-2">URL Link</label>
                                    <input type="url" wire:model="socialMedia.{{ $index }}.link"
                                        placeholder="https://..."
                                        class="w-full bg-white border-2 border-black p-3 font-mono text-sm focus:outline-none focus:shadow-[4px_4px_0px_0px_black] transition-shadow">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>
@endif
