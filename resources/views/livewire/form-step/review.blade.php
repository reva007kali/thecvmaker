@if ($currentStep == 6)
    <div class="animate-fade-in-up space-y-12">

        <!-- HEADER SECTION -->
        <div class="border-b-2 border-black pb-6 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h3 class="font-display text-4xl font-bold uppercase tracking-tighter text-black leading-none">
                    Final Check
                </h3>
                <p
                    class="font-mono text-sm text-gray-500 mt-2 bg-gray-200 inline-block px-2 border border-black shadow-[2px_2px_0px_0px_black]">
                    Step 06: Review & Submit
                </p>
            </div>
            <div class="text-right hidden md:block">
                <p class="text-xs font-mono text-gray-400">One last look.</p>
                <p class="text-xs font-mono text-gray-400">Make it perfect.</p>
            </div>
        </div>

        <!-- SUMMARY STATS (Top Bar) -->
        <div
            class="grid grid-cols-3 gap-0 border-2 border-black divide-x-2 divide-black bg-white shadow-[4px_4px_0px_0px_black]">
            <div class="p-4 text-center hover:bg-gray-50 transition-colors">
                <span class="block font-display text-3xl font-bold">{{ count($educations) + count($experiences) }}</span>
                <span class="font-mono text-[10px] uppercase text-gray-500">History Items</span>
            </div>
            <div class="p-4 text-center hover:bg-gray-50 transition-colors">
                <span
                    class="block font-display text-3xl font-bold text-accent-blue">{{ count($hardSkills) + count($softSkills) }}</span>
                <span class="font-mono text-[10px] uppercase text-gray-500">Total Skills</span>
            </div>
            <div class="p-4 text-center hover:bg-gray-50 transition-colors">
                <span
                    class="block font-display text-3xl font-bold text-green-600">{{ count($achievements) + count($certifications) }}</span>
                <span class="font-mono text-[10px] uppercase text-gray-500">Credentials</span>
            </div>
        </div>

        <div class="grid grid-cols-1 gap-8">

            {{-- 1. PERSONAL INFO (White Card) --}}
            <div class="border-2 border-black p-6 bg-white relative">
                <div class="flex justify-between items-start mb-6 border-b-2 border-black pb-4 border-dashed">
                    <h4 class="font-display text-xl font-bold uppercase flex items-center gap-2">
                        <i data-lucide="user" class="w-5 h-5"></i> Personal Info
                    </h4>
                    <button wire:click="goToStep(1)"
                        class="text-xs font-mono font-bold uppercase underline hover:text-accent-blue">Edit</button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <p class="font-mono text-[10px] uppercase text-gray-400 mb-1">Full Name</p>
                        <p class="font-bold text-lg">{{ $first_name }} {{ $last_name }}</p>
                    </div>
                    <div>
                        <p class="font-mono text-[10px] uppercase text-gray-400 mb-1">Target Role</p>
                        <p class="font-bold">{{ $job_title ?: '-' }}</p>
                    </div>
                    <div>
                        <p class="font-mono text-[10px] uppercase text-gray-400 mb-1">Contact</p>
                        <p class="text-sm font-medium">{{ $email }}</p>
                        <p class="text-sm font-medium">{{ $phone }}</p>
                    </div>
                    <div>
                        <p class="font-mono text-[10px] uppercase text-gray-400 mb-1">Details</p>
                        <p class="text-sm">{{ $address ?: '-' }}</p>
                        <p class="text-sm">
                            {{ $birthdate ? \Carbon\Carbon::parse($birthdate)->format('d M Y') : '-' }} •
                            {{ ucfirst($gender) ?: '-' }}
                        </p>
                    </div>
                </div>

                @if ($summary)
                    <div class="mt-6 p-4 bg-gray-50 border border-black border-dashed">
                        <p class="font-mono text-[10px] uppercase text-gray-400 mb-2">Professional Summary</p>
                        <p class="text-sm italic leading-relaxed text-gray-600">
                            "{{ \Illuminate\Support\Str::limit($summary, 150) }}"</p>
                    </div>
                @endif
            </div>

            {{-- 2. HISTORY (Black & White) --}}
            <div class="border-2 border-black p-6 bg-white relative shadow-[8px_8px_0px_0px_#e5e7eb]">
                <div class="flex justify-between items-start mb-6 border-b-2 border-black pb-4 border-dashed">
                    <h4 class="font-display text-xl font-bold uppercase flex items-center gap-2">
                        <i data-lucide="briefcase" class="w-5 h-5"></i> History
                    </h4>
                    <button wire:click="goToStep(2)"
                        class="text-xs font-mono font-bold uppercase underline hover:text-accent-blue">Edit</button>
                </div>

                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="p-4 border border-black bg-gray-50">
                            <span class="block font-display text-2xl font-bold">{{ count($educations) }}</span>
                            <span class="text-xs font-mono uppercase">Education Entries</span>
                            <div class="mt-2 text-xs text-gray-500 truncate">
                                {{ collect($educations)->pluck('school')->join(', ') }}
                            </div>
                        </div>
                        <div class="p-4 border border-black bg-gray-50">
                            <span class="block font-display text-2xl font-bold">{{ count($experiences) }}</span>
                            <span class="text-xs font-mono uppercase">Work Experiences</span>
                            <div class="mt-2 text-xs text-gray-500 truncate">
                                {{ collect($experiences)->pluck('company')->join(', ') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- 3. SKILLS (Accent Border) --}}
            <div class="border-2 border-black p-6 bg-white relative shadow-[8px_8px_0px_0px_#dbeafe]">
                <div class="flex justify-between items-start mb-6 border-b-2 border-black pb-4 border-dashed">
                    <h4 class="font-display text-xl font-bold uppercase flex items-center gap-2">
                        <i data-lucide="cpu" class="w-5 h-5 text-accent-blue"></i> Skills
                    </h4>
                    <button wire:click="goToStep(3)"
                        class="text-xs font-mono font-bold uppercase underline hover:text-accent-blue">Edit</button>
                </div>

                <div class="space-y-4">
                    @if (count($hardSkills) > 0)
                        <div>
                            <p class="font-mono text-[10px] uppercase text-gray-400 mb-2">Hard Skills</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach (collect($hardSkills)->take(6) as $skill)
                                    <span
                                        class="px-2 py-1 border border-black bg-accent-blue text-white text-xs font-bold uppercase">
                                        {{ $skill['skill_name'] }}
                                    </span>
                                @endforeach
                                @if (count($hardSkills) > 6)
                                    <span
                                        class="px-2 py-1 border border-black bg-gray-100 text-xs font-bold">+{{ count($hardSkills) - 6 }}</span>
                                @endif
                            </div>
                        </div>
                    @endif

                    @if (count($softSkills) > 0)
                        <div>
                            <p class="font-mono text-[10px] uppercase text-gray-400 mb-2">Soft Skills</p>
                            <div class="flex flex-wrap gap-2">
                                @foreach (collect($softSkills)->take(6) as $skill)
                                    <span
                                        class="px-2 py-1 border border-black bg-green-400 text-black text-xs font-bold uppercase">
                                        {{ $skill['skill_name'] }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- 4. CREDENTIALS & SEA (Compact Grid) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                {{-- Credentials --}}
                <div class="border-2 border-black p-6 bg-white shadow-[8px_8px_0px_0px_#fef3c7]">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="font-display text-lg font-bold uppercase">Credentials</h4>
                        <button wire:click="goToStep(4)"
                            class="text-xs font-mono font-bold uppercase underline">Edit</button>
                    </div>
                    <ul class="space-y-2 text-sm">
                        <li class="flex justify-between border-b border-gray-200 pb-1">
                            <span>Achievements</span>
                            <span class="font-bold">{{ count($achievements) }}</span>
                        </li>
                        <li class="flex justify-between border-b border-gray-200 pb-1">
                            <span>Certifications</span>
                            <span class="font-bold">{{ count($certifications) }}</span>
                        </li>
                        <li class="flex justify-between border-b border-gray-200 pb-1">
                            <span>References</span>
                            <span class="font-bold">{{ count($references) }}</span>
                        </li>
                    </ul>
                </div>

                {{-- Sea Service --}}
                <div class="border-2 border-black p-6 bg-white shadow-[8px_8px_0px_0px_#ccfbf1]">
                    <div class="flex justify-between items-center mb-4">
                        <h4 class="font-display text-lg font-bold uppercase">Maritime</h4>
                        <button wire:click="goToStep(5)"
                            class="text-xs font-mono font-bold uppercase underline">Edit</button>
                    </div>
                    <ul class="space-y-2 text-sm">
                        <li class="flex justify-between border-b border-gray-200 pb-1">
                            <span>Sea Records</span>
                            <span class="font-bold">{{ count($seaExperiences) }}</span>
                        </li>
                        <li class="flex justify-between border-b border-gray-200 pb-1">
                            <span>Documents</span>
                            <span class="font-bold">{{ count($documents) }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- AI REVIEWER (Special Section) -->
            <div class="mt-8 border-2 border-black border-dashed p-6 bg-gray-50">
                <div class="flex items-center gap-2 mb-4">
                    <i data-lucide="sparkles" class="w-5 h-5 text-purple-600"></i>
                    <h4 class="font-display text-xl font-bold uppercase">AI Quality Check</h4>
                </div>
                @include('livewire.form-step.ai-reviewer')
            </div>

            <!-- FINAL NOTE -->
            <div class="flex items-start gap-4 p-4 bg-black text-white">
                <i data-lucide="info" class="w-6 h-6 shrink-0 text-accent-lime"></i>
                <div>
                    <p class="font-bold font-display uppercase text-lg text-accent-lime">Ready to Launch?</p>
                    <p class="text-xs font-mono opacity-80 mt-1">
                        By clicking "Finish & Save", your data will be processed into a PDF.
                        You can always edit this later from your dashboard.
                    </p>
                </div>
            </div>

        </div>
    </div>
@endif
