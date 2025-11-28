<div x-data="{
    first_name: @entangle('first_name'),
    last_name: @entangle('last_name'),
    job_title: @entangle('job_title'),
    email: @entangle('email'),
    phone: @entangle('phone'),
    address: @entangle('address'),
    summary: @entangle('summary'),
    website_link: @entangle('website_link'),
    portfolio_link: @entangle('portfolio_link'),
    experiences: @entangle('experiences'),
    educations: @entangle('educations'),
    soft_skills: @entangle('softSkills'),
    hard_skills: @entangle('hardSkills'),
    languages: @entangle('languages'),
    achievements: @entangle('achievements'),
    certifications: @entangle('certifications'),
    formatDate(dateString) {
        if (!dateString) return 'Present'; // Jika kosong, anggap 'Present'

        const date = new Date(dateString);

        // Cek apakah tanggal valid
        if (isNaN(date.getTime())) return dateString;

        // Ambil nama bulan (Inggris: 'en-US', Indo: 'id-ID')
        const month = date.toLocaleDateString('en-US', { month: 'long' });
        const year = date.getFullYear();

        return `${month} ${year}`; // Hasil: June-2025
    },
}"
    class="relative w-[210mm] font-mont min-h-[297mm] bg-white shadow-2xl overflow-hidden flex flex-row text-gray-800">

    {{-- ================= LEFT SIDEBAR (30%) ================= --}}
    <div class="w-[32%] bg-slate-900 text-white flex flex-col p-6 shrink-0 min-h-full">

        {{-- 1. PROFILE PHOTO --}}
        <div class="flex justify-center mb-8 mt-4">
            <div class="relative w-32 h-32">
                @if ($cv_photo)
                    <img src="{{ $cv_photo->temporaryUrl() }}"
                        class="w-full h-full object-cover rounded-full border-4 border-white/20 shadow-lg">
                @elseif($existingPhoto)
                    <img src="{{ Storage::url($existingPhoto) }}"
                        class="w-full h-full object-cover rounded-full border-4 border-white/20 shadow-lg">
                @else
                    <div
                        class="w-full h-full bg-slate-700 rounded-full flex items-center justify-center border-4 border-white/20 text-slate-400">
                        <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                    </div>
                @endif
            </div>
        </div>

        {{-- 2. CONTACT INFO --}}
        <div class="mb-8">
            <h3 class="text-xs font-bold uppercase tracking-[0.2em] text-slate-400 mb-4 border-b border-slate-700 pb-2">
                Contact
            </h3>
            <div class="space-y-3 text-sm font-light text-slate-200">
                <!-- Phone -->
                <div class="flex items-start gap-3" x-show="phone">
                    <svg class="w-4 h-4 mt-0.5 shrink-0 opacity-70" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                        </path>
                    </svg>
                    <span x-text="phone"></span>
                </div>
                <!-- Email -->
                <div class="flex items-start gap-3" x-show="email">
                    <svg class="w-4 h-4 mt-0.5 shrink-0 opacity-70" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                        </path>
                    </svg>
                    <span x-text="email" class="break-all"></span>
                </div>
                <!-- Address -->
                <div class="flex items-start gap-3" x-show="address">
                    <svg class="w-4 h-4 mt-0.5 shrink-0 opacity-70" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                        </path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span x-text="address"></span>
                </div>
                <!-- Website -->
                <div class="flex items-start gap-3" x-show="website_link">
                    <svg class="w-4 h-4 mt-0.5 shrink-0 opacity-70" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9">
                        </path>
                    </svg>
                    <a :href="website_link" x-text="website_link"
                        class="hover:text-blue-300 break-all transition"></a>
                </div>
                <!-- Portfolio -->
                <div class="flex items-start gap-3" x-show="portfolio_link">
                    <svg class="w-4 h-4 mt-0.5 shrink-0 opacity-70" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    <a :href="portfolio_link" x-text="portfolio_link"
                        class="hover:text-blue-300 break-all transition"></a>
                </div>
            </div>
        </div>

        {{-- 3. EDUCATION (Moved to Sidebar for this design) --}}
        <div class="mb-8" x-show="educations && educations.length > 0">
            <h3 class="text-xs font-bold uppercase tracking-[0.2em] text-slate-400 mb-4 border-b border-slate-700 pb-2">
                Education
            </h3>
            <div class="space-y-4">
                <template x-for="(edu, index) in educations" :key="index">
                    <div class="relative pl-4 border-l border-slate-700">
                        <div class="text-xs text-slate-400 mb-0.5">
                            <span x-text="formatDate(edu.year_start)"></span> - <span
                                x-text="formatDate(edu.year_end) || 'Present'"></span>
                        </div>
                        <h4 class="text-sm font-bold text-white leading-tight" x-text="edu.school"></h4>
                        <p class="text-xs text-slate-300 mt-1 italic" x-text="edu.degree"></p>
                    </div>
                </template>
            </div>
        </div>

        {{-- 4. SOFT SKILLS --}}
        <div class="mb-8" x-show="soft_skills && soft_skills.length > 0">
            <h3 class="text-xs font-bold uppercase tracking-[0.2em] text-slate-400 mb-4 border-b border-slate-700 pb-2">
                Soft Skills
            </h3>
            <div class="flex flex-wrap gap-2">
                <template x-for="(skill, index) in soft_skills" :key="index">
                    <span class="px-2 py-1 bg-slate-800 text-slate-200 text-xs rounded border border-slate-700"
                        x-text="skill.skill_name"></span>
                </template>
            </div>
        </div>

        {{-- 5. LANGUAGES --}}
        <div x-show="languages && languages.length > 0">
            <h3 class="text-xs font-bold uppercase tracking-[0.2em] text-slate-400 mb-4 border-b border-slate-700 pb-2">
                Languages
            </h3>
            <ul class="space-y-2">
                <template x-for="(lang, index) in languages" :key="index">
                    <li class="flex justify-between text-sm">
                        <span class="text-slate-200" x-text="lang.language"></span>
                        <span class="text-slate-500 text-xs uppercase" x-text="lang.level"></span>
                    </li>
                </template>
            </ul>
        </div>
    </div>

    {{-- ================= RIGHT CONTENT (70%) ================= --}}
    <div class="flex-1 bg-white p-10 flex flex-col">

        {{-- 1. HEADER --}}
        <div class="mb-10 border-b-2 border-slate-100 pb-6">
            <h1 class="text-5xl font-bold text-slate-900 tracking-tight leading-tight uppercase mb-2">
                <span x-text="first_name"></span>
                <span class="font-light text-slate-500" x-text="last_name"></span>
            </h1>
            <p class="text-xl text-blue-600 font-medium tracking-wide uppercase" x-text="job_title"></p>
        </div>

        {{-- 2. SUMMARY --}}
        <div class="mb-10" x-show="summary">
            <h3 class="text-sm font-bold uppercase tracking-widest text-slate-900 mb-3 flex items-center gap-2">
                <span class="w-2 h-2 bg-blue-600 rounded-full"></span> Profile
            </h3>
            <p class="text-slate-600 leading-relaxed text-sm text-justify" x-text="summary"></p>
        </div>

        {{-- 3. EXPERIENCE --}}
        <div class="mb-10" x-show="experiences && experiences.length > 0">
            <h3 class="text-sm font-bold uppercase tracking-widest text-slate-900 mb-5 flex items-center gap-2">
                <span class="w-2 h-2 bg-blue-600 rounded-full"></span> Work Experience
            </h3>

            <div class="space-y-6">
                <template x-for="(exp, index) in experiences" :key="index">
                    <div class="relative">
                        <!-- Header Bar -->
                        <div class="flex justify-between items-baseline mb-1">
                            <h4 class="text-base font-bold text-slate-800" x-text="exp.job_title"></h4>
                            <div class="text-xs font-semibold text-white bg-slate-900 px-2 py-0.5 rounded">
                                <span x-text="formatDate(exp.start_date)"></span> -
                                <span x-text="exp.is_present ? 'Present' : formatDate(exp.end_date)"></span>
                            </div>
                        </div>

                        <!-- Company & Loc -->
                        <div class="text-sm text-blue-600 font-medium mb-2 flex gap-2">
                            <span x-text="exp.company"></span>
                            <span x-show="exp.location" class="text-slate-400">•</span>
                            <span x-text="exp.location" class="text-slate-500 font-normal"></span>
                        </div>

                        <!-- Description -->
                        <p class="text-sm text-slate-600 leading-relaxed whitespace-pre-line" x-text="exp.job_desk">
                        </p>
                    </div>
                </template>
            </div>
        </div>

        {{-- 4. HARD SKILLS & CERTS GRID --}}
        <div class="grid grid-cols-2 gap-8 mt-auto">

            <!-- Hard Skills -->
            <div x-show="hard_skills && hard_skills.length > 0">
                <h3 class="text-sm font-bold uppercase tracking-widest text-slate-900 mb-4 flex items-center gap-2">
                    <span class="w-2 h-2 bg-blue-600 rounded-full"></span> Hard Skills
                </h3>
                <div class="space-y-3">
                    <template x-for="(skill, index) in hard_skills" :key="index">
                        <div>
                            <div class="flex justify-between text-xs font-semibold mb-1">
                                <span x-text="skill.skill_name" class="text-slate-700"></span>
                                <span class="text-slate-400" x-text="skill.level"></span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-1.5">
                                <div class="bg-slate-900 h-1.5 rounded-full"
                                    :style="'width: ' + (skill.scale * 10) + '%'"></div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <!-- Achievements / Certs -->
            <div x-show="(achievements && achievements.length > 0) || (certifications && certifications.length > 0)">
                <h3 class="text-sm font-bold uppercase tracking-widest text-slate-900 mb-4 flex items-center gap-2">
                    <span class="w-2 h-2 bg-blue-600 rounded-full"></span> Certificates
                </h3>
                <ul class="space-y-3">
                    <template x-for="(cert, index) in certifications" :key="'cert' + index">
                        <li class="flex items-start gap-2 text-sm text-slate-600">
                            <svg class="w-4 h-4 text-blue-600 mt-0.5 shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <span class="font-bold text-slate-800" x-text="cert.name"></span>
                                <span class="text-xs text-slate-500 block"
                                    x-text="cert.vendor + ' (' + cert.year + ')'"></span>
                            </div>
                        </li>
                    </template>
                    {{-- Achievements Mix --}}
                    <template x-for="(ach, index) in achievements" :key="'ach' + index">
                        <li class="flex items-start gap-2 text-sm text-slate-600">
                            <svg class="w-4 h-4 text-yellow-500 mt-0.5 shrink-0" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z">
                                </path>
                            </svg>
                            <div>
                                <span class="font-bold text-slate-800" x-text="ach.name"></span>
                                <span class="text-xs text-slate-500 block" x-text="ach.year"></span>
                            </div>
                        </li>
                    </template>
                </ul>
            </div>

        </div>

        {{-- Footer Decoration --}}
        <div class="mt-8 pt-4 border-t border-slate-100 flex justify-between items-center opacity-50">
            <div class="text-[10px] text-slate-400">Generated by CV Builder</div>
            <div class="flex gap-1">
                <div class="w-2 h-2 rounded-full bg-slate-300"></div>
                <div class="w-2 h-2 rounded-full bg-slate-400"></div>
                <div class="w-2 h-2 rounded-full bg-slate-500"></div>
            </div>
        </div>

    </div>
</div>
