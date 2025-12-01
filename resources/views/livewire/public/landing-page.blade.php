<div class="overflow-x-hidden">

    <!-- Background Grid Lines (Decorative) -->
    <div class="fixed inset-0 pointer-events-none z-0 flex justify-between px-6 container mx-auto opacity-40">
        <div class="grid-line-y left-6"></div>
        <div class="grid-line-y right-6"></div>
        <div class="grid-line-y left-1/2 hidden md:block"></div>
    </div>

    <!-- Navbar -->
    <nav
        class="fixed w-full z-50 bg-swiss-white/80 backdrop-blur-md border-b border-gray-200 transition-all duration-300">
        <div class="container mx-auto px-6 h-20 flex justify-between items-center relative z-50">
            <!-- Logo -->
            <a href="/" class="hover-trigger flex items-center gap-2 group">
                <div
                    class="w-8 h-8 bg-swiss-black text-white flex items-center justify-center rounded-full group-hover:scale-110 transition-transform">
                    <span class="font-display font-bold">cv</span>
                </div>
                <span class="font-display font-bold text-xl tracking-tight">thecvmaker.</span>
            </a>

            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center gap-8">
                <a href="#"
                    class="hover-trigger text-sm font-medium hover:text-accent-blue transition-colors">vibe check</a>
                <a href="#"
                    class="hover-trigger text-sm font-medium hover:text-accent-blue transition-colors">templates</a>
                <a href="#"
                    class="hover-trigger text-sm font-medium hover:text-accent-blue transition-colors">pricing</a>
            </div>

            <!-- CTA & Mobile Toggle -->
            <div class="flex items-center gap-4">
                <a href="/login" wire:navigate.hover
                    class="hover-trigger hidden md:block text-sm font-medium hover:underline">log in</a>
                <a href="/cv-form" wire:navigate.hover
                    class="hover-trigger magnetic-btn px-6 py-2.5 bg-swiss-black text-white rounded-full font-medium text-sm hover:bg-accent-blue transition-colors hidden sm:block">
                    start cooking ⚡
                </a>
                <button @click="mobileMenu = !mobileMenu" class="hover-trigger md:hidden p-2 z-50">
                    <i data-lucide="menu" x-show="!mobileMenu"></i>
                    <i data-lucide="x" x-show="mobileMenu" x-cloak></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu Overlay -->
        <div x-show="mobileMenu" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-full" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-full"
            class="absolute top-0 left-0 w-full h-screen bg-swiss-white z-40 flex flex-col items-center justify-center space-y-8 md:hidden">
            <a href="#" class="font-display text-4xl font-bold hover:text-accent-blue">vibe check</a>
            <a href="#" class="font-display text-4xl font-bold hover:text-accent-blue">templates</a>
            <a href="#" class="font-display text-4xl font-bold hover:text-accent-blue">pricing</a>
            <a href="/login" class="font-display text-xl text-gray-500">log in</a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-20 md:pt-32 md:pb-32 md:px-10 overflow-hidden bg-swiss-white z-10">
        <div class="container mx-auto px-6 relative">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div data-aos="fade-up" data-aos-duration="1000">
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1 rounded-full border border-gray-200 bg-gray-50 mb-6">
                        <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse"></span>
                        <span class="text-xs font-medium text-gray-500 lowercase">AI-powered v1.0 live</span>
                    </div>
                    <h1 class="font-display text-6xl md:text-8xl font-medium tracking-tighter leading-[0.9] mb-6">
                        MAKE A CV <br>
                        <span class="text-gray-300 italic">THAT DOESN'T</span> <br>
                        <span class="text-accent-blue line-through">SUCK.</span>
                    </h1>
                    <p class="text-lg text-gray-600 max-w-md leading-relaxed mb-8">
                        HR managers spend 6 seconds on your resume. Make them count with our AI-powered,
                        brutalist-approved templates.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        <a href="/cv-form" wire:navigate.hover
                            class="hover-trigger px-8 py-4 bg-swiss-black text-white rounded-none border border-black hover:bg-white hover:text-black transition-all duration-300 font-display font-bold text-lg group">
                            make my cv
                            <span class="inline-block group-hover:translate-x-1 transition-transform">-></span>
                        </a>
                        <a href="#demo"
                            class="hover-trigger px-8 py-4 bg-transparent text-black border border-gray-300 hover:border-black transition-all duration-300 font-display font-medium text-lg">
                            watch demo
                        </a>
                    </div>
                </div>

                <!-- Abstract Visual -->
                <div class="relative h-[500px] w-full border border-black bg-swiss-gray flex items-center justify-center overflow-hidden"
                    data-aos="zoom-in" data-aos-delay="200">
                    <div class="absolute inset-0 grid grid-cols-2 grid-rows-2">
                        <div class="border-r border-b border-black/10 p-4 flex items-end">
                            <span class="font-mono text-xs text-gray-400">01_LAYOUT</span>
                        </div>
                        <div class="border-b border-black/10 p-4 bg-accent-blue/5"></div>
                        <div class="border-r border-black/10 p-4"></div>
                        <div class="p-4 flex items-end justify-end">
                            <span class="font-mono text-xs text-gray-400">04_EXPORT</span>
                        </div>
                    </div>
                    <!-- Floating Card -->
                    <img src="https://via.placeholder.com/300x400" alt="CV"
                        class="hover-trigger absolute w-64 shadow-2xl rotate-3 hover:rotate-0 transition-transform duration-500 z-10 border border-black grayscale hover:grayscale-0">

                    <!-- Floating Badge -->
                    <div
                        class="absolute top-10 right-10 bg-white border border-black px-4 py-2 rotate-12 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] z-20">
                        <p class="font-display font-bold text-sm">hired.pdf</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Marquee (The Receipts) -->
    <div class="border-y border-black bg-accent-lime overflow-hidden py-3 z-10 relative">
        <div
            class="marquee-content whitespace-nowrap flex gap-12 text-swiss-black font-display font-bold text-xl uppercase tracking-wider">
            <span>✨ ATS Friendly</span>
            <span>✨ No Cap Pricing</span>
            <span>✨ AI Writer</span>
            <span>✨ Instant PDF</span>
            <span>✨ Secure The Bag</span>
            <span>✨ ATS Friendly</span>
            <span>✨ No Cap Pricing</span>
            <span>✨ AI Writer</span>
            <span>✨ Instant PDF</span>
            <span>✨ Secure The Bag</span>
            <span>✨ ATS Friendly</span>
            <span>✨ No Cap Pricing</span>
            <span>✨ AI Writer</span>
            <span>✨ Instant PDF</span>
            <span>✨ Secure The Bag</span>
        </div>
    </div>

    <!-- The "Ick" Section (Problems) -->
    <section class="py-24 bg-swiss-white z-10 relative md:px-10">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-16">
                <h2 class="font-display text-4xl md:text-8xl font-medium" data-aos="fade-up">
                    why ur current cv <br>
                    <span class="line-through text-gray-400">sucks</span> <span class="text-red-500">is failing.</span>
                </h2>
                <p class="text-gray-500 font-mono text-sm mt-4 md:mt-0 max-w-xs" data-aos="fade-up"
                    data-aos-delay="100">
                    if: visual_clutter <br> status: <span class="text-red-500">rejected</span>
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="hover-trigger group p-8 border border-gray-200 shadow-sm hover:shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:-translate-y-1 hover:border-black transition-all duration-300"
                    data-aos="fade-up">
                    <i data-lucide="x-circle"
                        class="w-8 h-8 mb-6 text-gray-400 group-hover:text-red-500 transition-colors"></i>
                    <h3 class="font-display text-xl font-bold mb-3">The "Template" Ick</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">Using that one Canva template everyone uses?
                        Recruiters can smell it from a mile away. It's giving basic.</p>
                </div>
                <div class="hover-trigger group p-8 border border-gray-200 shadow-sm hover:shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:-translate-y-1 hover:border-black transition-all duration-300"
                    data-aos="fade-up" data-aos-delay="100">
                    <i data-lucide="layout"
                        class="w-8 h-8 mb-6 text-gray-400 group-hover:text-red-500 transition-colors"></i>
                    <h3 class="font-display text-xl font-bold mb-3">Formatting Nightmare</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">Moved an image 1px and the whole page exploded?
                        Yeah, Word does that. We don't.</p>
                </div>
                <div class="hover-trigger group p-8 border border-gray-200 shadow-sm hover:shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:-translate-y-1 hover:border-black transition-all duration-300"
                    data-aos="fade-up" data-aos-delay="200">
                    <i data-lucide="cpu"
                        class="w-8 h-8 mb-6 text-gray-400 group-hover:text-red-500 transition-colors"></i>
                    <h3 class="font-display text-xl font-bold mb-3">Ghosted by ATS</h3>
                    <p class="text-gray-600 text-sm leading-relaxed">Robots are reading your resume before humans. If
                        it's not optimized, you're literally invisible.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Bento Grid (The Glow Up) -->
    <section class="py-24 md:px-10 bg-gray-50 border-t border-gray-200 z-10 relative">
        <div class="container mx-auto px-6">
            <div class="mb-12">
                <span class="font-mono text-xs uppercase tracking-widest text-accent-blue mb-2 block">Features</span>
                <h2 class="font-display text-4xl md:text-7xl font-medium">the glow up.</h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 grid-rows-2 gap-4 h-auto md:h-[600px]">

                <!-- Large Feature -->
                <div class="hover-trigger md:col-span-2 md:row-span-2 bg-swiss-white border border-gray-200 p-8 rounded-2xl relative overflow-hidden group"
                    data-aos="fade-right">
                    <div
                        class="absolute top-0 right-0 w-64 h-64 bg-accent-blue/10 rounded-full blur-3xl -mr-16 -mt-16 transition-all group-hover:bg-accent-blue/20">
                    </div>
                    <div class="relative z-10 h-full flex flex-col justify-between">
                        <div>
                            <div
                                class="w-10 h-10 bg-black text-white rounded-full flex items-center justify-center mb-4">
                                <i data-feather="edit-3" class="w-4 h-4"></i>
                            </div>
                            <h3 class="font-display text-2xl font-bold mb-2">AI Writer that hits different</h3>
                            <p class="text-gray-600">Writer's block? Nah. Our AI generates punchy bullet points
                                tailored to your job title. Sound pro without trying hard.</p>
                        </div>
                        <div class="mt-8 bg-gray-100 rounded-lg p-4 border border-gray-200 font-mono text-xs">
                            <span class="text-green-600">AI ></span> Generating professional summary for "Product
                            Designer"...
                            <br><br>
                            <span class="text-gray-800 typing-effect">"Results-driven creative with 4+ years of
                                experience..."</span>
                        </div>
                    </div>
                </div>

                <!-- Tall Feature -->
                <div class="hover-trigger md:col-span-1 md:row-span-2 bg-swiss-black text-white p-8 rounded-2xl flex flex-col justify-between group overflow-hidden"
                    data-aos="fade-up">
                    <div
                        class="absolute inset-0 bg-gradient-to-b from-transparent to-gray-900 opacity-0 group-hover:opacity-100 transition-opacity">
                    </div>
                    <div class="relative z-10">
                        <i data-feather="smartphone" class="w-8 h-8 mb-6 text-accent-lime"></i>
                        <h3 class="font-display text-2xl font-bold mb-2">Mobile Ready</h3>
                        <p class="text-gray-400 text-sm">Edit on your phone while commuting. Why not?</p>
                    </div>
                    <img src="https://via.placeholder.com/150x300"
                        class="relative z-10 mx-auto mt-4 rounded border border-gray-700 opacity-60 group-hover:opacity-100 transition-opacity group-hover:translate-y-[-10px] duration-500">
                </div>

                <!-- Small Feature 1 -->
                <div class="hover-trigger md:col-span-1 md:row-span-1 bg-accent-lime p-8 rounded-2xl flex flex-col justify-center border border-black group"
                    data-aos="fade-left">
                    <i data-feather="download"
                        class="w-8 h-8 mb-4 text-black group-hover:scale-110 transition-transform"></i>
                    <h3 class="font-display text-xl font-bold">Fast Export</h3>
                    <p class="text-sm opacity-80">PDF in seconds.</p>
                </div>

                <!-- Small Feature 2 -->
                <div class="hover-trigger md:col-span-1 md:row-span-1 bg-white border border-gray-200 p-8 rounded-2xl flex flex-col justify-center group"
                    data-aos="fade-left" data-aos-delay="100">
                    <i data-feather="eye"
                        class="w-8 h-8 mb-4 text-accent-blue group-hover:scale-110 transition-transform"></i>
                    <h3 class="font-display text-xl font-bold">Real-time Preview</h3>
                    <p class="text-sm text-gray-500">What you see is what you get.</p>
                </div>

            </div>
        </div>
    </section>

    <!-- The Receipts Section (Infinite Wall of Wins) -->
    <section class="py-24 bg-swiss-white relative overflow-hidden z-10">

        <!-- Background Noise/Gradient -->
        <div
            class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-10 pointer-events-none">
        </div>
        <div
            class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[800px] h-[500px] bg-accent-blue/5 rounded-full blur-3xl pointer-events-none">
        </div>

        <div class="container mx-auto px-6 mb-12 text-center relative z-20">
            <div class="inline-block relative">
                <h2 class="font-display text-4xl md:text-7xl font-bold leading-tight" data-aos="zoom-in">
                    THE RECEIPTS 🧾
                </h2>
                <!-- Decorative Sticker -->
                <div
                    class="absolute -top-6 -right-12 rotate-12 bg-accent-lime border border-black px-3 py-1 font-mono text-xs font-bold shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] animate-pulse">
                    NO CAP FR
                </div>
            </div>
            <p class="text-gray-500 mt-4 font-mono text-sm">Real dms, real hires. We don't gatekeep success.</p>
        </div>

        <!-- Infinite Scroll Wrapper -->
        <div class="relative w-full space-y-6">

            <!-- Gradient Masks (Agar pinggirannya nge-blur smooth) -->
            <div class="absolute top-0 bottom-0 left-0 w-24 bg-gradient-to-r from-swiss-white to-transparent z-20">
            </div>
            <div class="absolute top-0 bottom-0 right-0 w-24 bg-gradient-to-l from-swiss-white to-transparent z-20">
            </div>

            <!-- ROW 1: Scroll Left -->
            <div class="flex overflow-hidden group">
                <div class="flex gap-6 animate-scroll-left group-hover:[animation-play-state:paused] py-4 px-4">
                    <!-- Card 1 -->
                    <x-review-card img="https://i.pravatar.cc/100?img=12" name="alex_dev" handle="@alexcodes"
                        text="bro thecvmaker saved my life. applied to 5 jobs, got 3 interviews. the AI writer goes crazy 🔥"
                        tag="Hired at Netflix" color="bg-red-500" />
                    <!-- Card 2 -->
                    <x-review-card img="https://i.pravatar.cc/100?img=32" name="jessica_ui" handle="@jessdesigns"
                        text="stopped using canva templates and finally got a callback. the swiss layout is aesthetic af."
                        tag="Salary +40%" color="bg-green-500" />
                    <!-- Card 3 -->
                    <x-review-card img="https://i.pravatar.cc/100?img=5" name="david_pm" handle="@pm_dave"
                        text="ats score went from 40 to 95. literally a cheat code." tag="Job Secured"
                        color="bg-blue-500" />
                    <!-- Card 4 -->
                    <x-review-card img="https://i.pravatar.cc/100?img=60" name="sarah_g" handle="@sarahg"
                        text="my old resume was giving ick. this one eats." tag="Interviewed"
                        color="bg-purple-500" />
                    <!-- DUPLICATE FOR LOOP (Wajib diduplikasi agar loop mulus) -->
                    <x-review-card img="https://i.pravatar.cc/100?img=12" name="alex_dev" handle="@alexcodes"
                        text="bro thecvmaker saved my life. applied to 5 jobs, got 3 interviews. the AI writer goes crazy 🔥"
                        tag="Hired at Netflix" color="bg-red-500" />
                    <x-review-card img="https://i.pravatar.cc/100?img=32" name="jessica_ui" handle="@jessdesigns"
                        text="stopped using canva templates and finally got a callback. the swiss layout is aesthetic af."
                        tag="Salary +40%" color="bg-green-500" />
                    <x-review-card img="https://i.pravatar.cc/100?img=5" name="david_pm" handle="@pm_dave"
                        text="ats score went from 40 to 95. literally a cheat code." tag="Job Secured"
                        color="bg-blue-500" />
                    <x-review-card img="https://i.pravatar.cc/100?img=60" name="sarah_g" handle="@sarahg"
                        text="my old resume was giving ick. this one eats." tag="Interviewed"
                        color="bg-purple-500" />
                </div>
            </div>

            <!-- ROW 2: Scroll Right (Opposite Direction) -->
            <div class="flex overflow-hidden group">
                <div class="flex gap-6 animate-scroll-right group-hover:[animation-play-state:paused] py-4 px-4">
                    <!-- Card 5 -->
                    <x-review-card img="https://i.pravatar.cc/100?img=11" name="mike_t" handle="@mikey"
                        text="gatekeeping this app honestly. it's too good." tag="Offer Letter"
                        color="bg-yellow-500" />
                    <!-- Card 6 -->
                    <x-review-card img="https://i.pravatar.cc/100?img=44" name="lisa_hr" handle="@lisa_recruiter"
                        text="as a recruiter, i love seeing these templates. so easy to read. instant yes."
                        tag="Recruiter Approved" color="bg-pink-500" />
                    <!-- Card 7 -->
                    <x-review-card img="https://i.pravatar.cc/100?img=3" name="ryan_code" handle="@ryancode"
                        text="took me 5 mins to build a cv that looks like i paid $500 for it. W." tag="Saved Time"
                        color="bg-indigo-500" />
                    <!-- DUPLICATE FOR LOOP -->
                    <x-review-card img="https://i.pravatar.cc/100?img=11" name="mike_t" handle="@mikey"
                        text="gatekeeping this app honestly. it's too good." tag="Offer Letter"
                        color="bg-yellow-500" />
                    <x-review-card img="https://i.pravatar.cc/100?img=44" name="lisa_hr" handle="@lisa_recruiter"
                        text="as a recruiter, i love seeing these templates. so easy to read. instant yes."
                        tag="Recruiter Approved" color="bg-pink-500" />
                    <x-review-card img="https://i.pravatar.cc/100?img=3" name="ryan_code" handle="@ryancode"
                        text="took me 5 mins to build a cv that looks like i paid $500 for it. W." tag="Saved Time"
                        color="bg-indigo-500" />
                </div>
            </div>

        </div>
    </section>

    <!-- FAQ Accordion -->
    <section class="py-20 bg-gray-50 border-t border-gray-200 z-10 relative">
        <div class="container mx-auto px-6 max-w-3xl" x-data="{ active: null }">
            <h2 class="font-display text-3xl font-bold mb-10 text-center">FAQ's (Freaking Asked Questions)</h2>

            <div class="space-y-2">
                <div class="border border-gray-200 bg-white rounded-lg overflow-hidden">
                    <button @click="active = active === 1 ? null : 1"
                        class="hover-trigger w-full px-6 py-4 text-left flex justify-between items-center font-bold font-display hover:bg-gray-50">
                        Is it actually free?
                        <i data-feather="chevron-down" :class="active === 1 ? 'rotate-180' : ''"
                            class="transition-transform"></i>
                    </button>
                    <div x-show="active === 1" x-collapse
                        class="px-6 py-4 text-sm text-gray-600 border-t border-gray-100">
                        We have a free tier that lets you build and download. Premium unlocks the god-mode AI features
                        and unlimited designs.
                    </div>
                </div>

                <div class="border border-gray-200 bg-white rounded-lg overflow-hidden">
                    <button @click="active = active === 2 ? null : 2"
                        class="hover-trigger w-full px-6 py-4 text-left flex justify-between items-center font-bold font-display hover:bg-gray-50">
                        Can I cancel anytime?
                        <i data-feather="chevron-down" :class="active === 2 ? 'rotate-180' : ''"
                            class="transition-transform"></i>
                    </button>
                    <div x-show="active === 2" x-collapse
                        class="px-6 py-4 text-sm text-gray-600 border-t border-gray-100">
                        Yeah, no strings attached. We don't do toxic relationships.
                    </div>
                </div>

                <div class="border border-gray-200 bg-white rounded-lg overflow-hidden">
                    <button @click="active = active === 3 ? null : 3"
                        class="hover-trigger w-full px-6 py-4 text-left flex justify-between items-center font-bold font-display hover:bg-gray-50">
                        Is my data safe?
                        <i data-feather="chevron-down" :class="active === 3 ? 'rotate-180' : ''"
                            class="transition-transform"></i>
                    </button>
                    <div x-show="active === 3" x-collapse
                        class="px-6 py-4 text-sm text-gray-600 border-t border-gray-100">
                        Locked down tighter than Fort Knox. We don't sell your info.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer CTA -->
    <section class="py-32 bg-swiss-black text-white text-center relative overflow-hidden z-10">
        <div class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20"></div>
        <div class="container mx-auto px-6 relative z-10">
            <h2 class="font-display text-5xl md:text-9xl font-bold mb-8 tracking-tighter" data-aos="zoom-in">
                DON'T BE UNEMPLOYED.
            </h2>
            <a href="/cv-form"
                class="hover-trigger inline-block px-10 py-4 bg-accent-blue text-white rounded-full font-bold text-xl hover:scale-105 transition-transform shadow-[0_0_30px_rgba(37,99,235,0.6)]">
                create cv now ->
            </a>
            <p class="mt-8 text-gray-500 font-mono text-xs">join 15k+ people who stopped being unemployed.</p>
        </div>
    </section>

    <!-- Simple Footer -->
    <footer class="bg-swiss-white border-t border-gray-200 py-10 z-10 relative">
        <div class="container mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-4">
            <div class="flex items-center gap-2">
                <div class="w-6 h-6 bg-black rounded-full"></div>
                <span class="font-display font-bold">thecvmaker.</span>
            </div>
            <div class="flex gap-6 text-sm font-medium text-gray-500">
                <a href="#" class="hover-trigger hover:text-black">Terms</a>
                <a href="#" class="hover-trigger hover:text-black">Privacy</a>
                <a href="#" class="hover-trigger hover:text-black">Twitter</a>
                <a href="#" class="hover-trigger hover:text-black">Instagram</a>
            </div>
            <p class="text-xs text-gray-400 font-mono">&copy; {{ date('Y') }}</p>
        </div>
    </footer>
</div>
