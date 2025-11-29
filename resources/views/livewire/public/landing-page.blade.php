<div>
    <!-- Navbar -->
    <nav class="sticky top-0 z-50 bg-neo-white border-b-4 border-black py-4 relative">
        <div class="container mx-auto px-4 flex justify-between items-center bg-neo-white z-50 relative">
            <!-- Logo -->
            <a href="/" class="flex items-center gap-2 group">
                <div
                    class="w-10 h-10 bg-neo-black text-neo-yellow flex items-center justify-center font-bold text-2xl group-hover:rotate-12 transition-transform">
                    CV
                </div>
                <span class="font-sans font-black text-xl tracking-tighter uppercase">Maker<span
                        class="text-neo-pink">.AI</span></span>
            </a>

            <!-- Desktop Menu -->
            <div class="hidden md:flex gap-6 items-center font-bold">
                <a href="#" class="hover:underline decoration-4 decoration-neo-blue underline-offset-4">Why Us?</a>
                <a href="#"
                    class="hover:underline decoration-4 decoration-neo-pink underline-offset-4">Templates</a>
                <a href="#"
                    class="hover:underline decoration-4 decoration-neo-green underline-offset-4">Pricing</a>
            </div>

            <!-- CTA Desktop -->
            <a href="/cv-form"
                class="btn-neo hidden md:inline-block px-6 py-2 bg-neo-yellow border-neo shadow-neo font-bold font-sans uppercase">
                Start Now ⚡
            </a>

            <!-- Mobile Menu Button (Kasih ID disini) -->
            <button id="mobile-menu-btn"
                class="md:hidden p-2 border-2 border-black bg-neo-blue shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] active:shadow-none active:translate-x-[4px] active:translate-y-[4px] transition-all z-50">
                <i data-feather="menu"></i>
            </button>
        </div>

        <!-- Mobile Menu Container (Wadah Menu Hidden) -->
        <div id="mobile-menu"
            class="hidden absolute top-full left-0 w-full bg-neo-white border-b-4 border-black shadow-neo-lg flex flex-col p-6 space-y-4 z-40 transition-all duration-300">
            <a href="#" class="font-bold font-sans text-xl hover:text-neo-blue">Why Us?</a>
            <a href="#" class="font-bold font-sans text-xl hover:text-neo-pink">Templates</a>
            <a href="#" class="font-bold font-sans text-xl hover:text-neo-green">Pricing</a>
            <hr class="border-2 border-black">
            <a href="/cv-form"
                class="btn-neo text-center px-6 py-3 bg-neo-yellow border-neo shadow-neo font-bold font-sans uppercase">
                Start Now ⚡
            </a>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-20 pb-20 overflow-hidden">
        <!-- Background Elements -->
        <div class="absolute top-20 right-0 opacity-20 transform translate-x-1/3 rotate-12 pointer-events-none">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/ec/Happy_smiley_face.png/800px-Happy_smiley_face.png"
                class="w-96 animate-pulse">
        </div>

        <div class="container mx-auto px-6 grid lg:grid-cols-2 gap-12 items-center relative z-10">
            <div class="space-y-6" data-aos="fade-right">
                <div class="inline-block bg-neo-black text-neo-white px-4 py-1 font-bold text-sm transform -rotate-2">
                    ⚠️ STOP GETTING REJECTED
                </div>
                <h1 class="font-sans font-black text-5xl lg:text-7xl leading-none">
                    MAKE A CV <br>
                    THAT DOESN'T <br>
                    <span class="bg-neo-pink px-2 text-white border-neo inline-block transform -rotate-1">SUCK.</span>
                </h1>
                <p class="font-mono text-lg text-gray-800 bg-white border-2 border-black p-4 shadow-neo max-w-md">
                    HR managers spend 6 seconds on your resume. Make them count with our AI-powered, brutalist-approved
                    templates.
                </p>

                <div class="flex flex-col sm:flex-row gap-4 pt-4">
                    <a href="/login"
                        class="btn-neo px-8 py-4 bg-neo-blue border-neo shadow-neo font-black text-xl text-center">
                        BUILD MY CV
                    </a>
                    <a href="/templates"
                        class="btn-neo px-8 py-4 bg-white border-neo shadow-neo font-bold text-xl flex items-center justify-center gap-2">
                        <i data-feather="eye"></i> SEE EXAMPLES
                    </a>
                </div>
            </div>

            <!-- Visual Chaos -->
            <div class="relative" data-aos="zoom-in" data-aos-delay="200">
                <!-- Decorative Shapes -->
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-neo-yellow border-neo rounded-full z-0"></div>
                <div
                    class="absolute -bottom-10 -left-10 w-full h-full border-neo bg-black z-0 translate-x-4 translate-y-4">
                </div>

                <!-- Main Image Card -->
                <div
                    class="relative z-10 bg-white border-neo p-4 transform rotate-2 hover:rotate-0 transition-transform duration-300">
                    <div class="border-b-2 border-black pb-2 mb-4 flex justify-between items-center">
                        <div class="flex gap-2">
                            <div class="w-4 h-4 rounded-full border-2 border-black bg-neo-pink"></div>
                            <div class="w-4 h-4 rounded-full border-2 border-black bg-neo-yellow"></div>
                        </div>
                        <span class="font-mono text-xs">awesome_cv.pdf</span>
                    </div>
                    <img src="img/step-1.png" alt="CV Template"
                        class="w-full grayscale contrast-125 border-2 border-black"
                        onerror="this.src='https://images.unsplash.com/photo-1586281380349-632531db7ed4?auto=format&fit=crop&q=80&w=600'">

                    <!-- Floating Sticker -->
                    <div
                        class="absolute -bottom-6 -right-6 bg-neo-green border-neo px-4 py-2 font-black text-sm transform -rotate-6 shadow-neo">
                        GET HIRED QUICK!
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Marquee Text (Running Text) -->
    <div class="border-y-4 border-black bg-neo-yellow py-4 overflow-hidden">
        <div class="whitespace-nowrap animate-marquee font-sans font-black text-3xl uppercase tracking-wider">
            GET HIRED 💥 NO MORE WRITER'S BLOCK 💥 AI POWERED 💥 ATS FRIENDLY 💥 INSTANT DOWNLOAD 💥 GET HIRED 💥 NO
            MORE WRITER'S BLOCK 💥
        </div>
    </div>

    <!-- Features Grid -->
    <section class="py-20 bg-white pattern-dots">
        <div class="container mx-auto px-6">
            <h2 class="font-sans font-black text-4xl mb-12 text-center uppercase" data-aos="fade-up">
                Why we are <span class="bg-neo-black text-white px-2">Better</span>
            </h2>

            <div class="grid md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-neo-bg border-neo shadow-neo p-6 hover:-translate-y-2 transition-transform"
                    data-aos="fade-up">
                    <div
                        class="w-16 h-16 bg-neo-pink border-neo flex items-center justify-center mb-6 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                        <i data-feather="zap" class="w-8 h-8 text-white"></i>
                    </div>
                    <h3 class="font-sans font-bold text-2xl mb-3">Lightning Fast</h3>
                    <p class="font-mono text-sm leading-relaxed">
                        Don't waste 3 hours on Word. Click, type, boom. Done in 5 minutes.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-neo-bg border-neo shadow-neo p-6 hover:-translate-y-2 transition-transform"
                    data-aos="fade-up" data-aos-delay="100">
                    <div
                        class="w-16 h-16 bg-neo-blue border-neo flex items-center justify-center mb-6 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                        <i data-feather="cpu" class="w-8 h-8 text-white"></i>
                    </div>
                    <h3 class="font-sans font-bold text-2xl mb-3">Smart AI</h3>
                    <p class="font-mono text-sm leading-relaxed">
                        Our AI writes the boring stuff for you. Summaries? Skills? We got you.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-neo-bg border-neo shadow-neo p-6 hover:-translate-y-2 transition-transform"
                    data-aos="fade-up" data-aos-delay="200">
                    <div
                        class="w-16 h-16 bg-neo-green border-neo flex items-center justify-center mb-6 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)]">
                        <i data-feather="thumbs-up" class="w-8 h-8 text-white"></i>
                    </div>
                    <h3 class="font-sans font-bold text-2xl mb-3">HR Approved</h3>
                    <p class="font-mono text-sm leading-relaxed">
                        Templates designed to pass the ATS bots and impress human eyes.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works (Steps) -->
    <section class="py-20 border-t-4 border-black bg-neo-blue">
        <div class="container mx-auto px-6">
            <div class="grid lg:grid-cols-2 gap-16">
                <!-- Sticky Left Text -->
                <div class="h-fit">
                    <h2 class="font-sans font-black text-5xl md:text-6xl mb-6 text-white text-stroke">
                        3 STEPS TO <br> GLORY
                    </h2>
                    <p class="font-mono font-bold text-xl border-l-4 border-black pl-4">
                        It's so easy your grandma could do it. (No offense to grandmas).
                    </p>
                    <img src="img/levelup.png"
                        class="mt-8 w-48 border-neo shadow-neo hidden lg:block rotate-3 bg-white" alt="Level Up"
                        onerror="this.style.display='none'">
                </div>

                <!-- Right Steps -->
                <div class="space-y-12">
                    <!-- Step 1 -->
                    <div class="bg-white border-neo shadow-neo-lg p-8 relative" data-aos="fade-left">
                        <div
                            class="absolute -top-6 -left-6 w-12 h-12 bg-black text-white font-sans font-bold text-2xl flex items-center justify-center border-2 border-white">
                            1</div>
                        <h3 class="font-sans font-bold text-2xl mb-2">Pick a Template</h3>
                        <p class="font-mono text-sm mb-4">Choose from our gallery of dope designs.</p>
                        <div class="h-32 bg-gray-200 border-2 border-black pattern-diagonal overflow-hidden relative">
                            <img src="img/step-1.png" class="w-full object-cover opacity-50"
                                onerror="this.style.display='none'">
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="bg-white border-neo shadow-neo-lg p-8 relative" data-aos="fade-left"
                        data-aos-delay="100">
                        <div
                            class="absolute -top-6 -left-6 w-12 h-12 bg-neo-pink text-black border-neo font-sans font-bold text-2xl flex items-center justify-center">
                            2</div>
                        <h3 class="font-sans font-bold text-2xl mb-2">Fill the Blanks</h3>
                        <p class="font-mono text-sm mb-4">Type your info or let AI auto-fill it.</p>
                        <div class="h-32 bg-gray-200 border-2 border-black flex items-center justify-center">
                            <span class="font-mono text-xs typing-effect">Typing...</span>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="bg-white border-neo shadow-neo-lg p-8 relative" data-aos="fade-left"
                        data-aos-delay="200">
                        <div
                            class="absolute -top-6 -left-6 w-12 h-12 bg-neo-yellow text-black border-neo font-sans font-bold text-2xl flex items-center justify-center">
                            3</div>
                        <h3 class="font-sans font-bold text-2xl mb-2">Download & Apply</h3>
                        <p class="font-mono text-sm mb-4">Get your PDF and start applying like a boss.</p>
                        <button
                            class="w-full bg-black text-white font-bold py-2 hover:bg-neo-green hover:text-black border-2 border-black transition-colors">DOWNLOAD
                            PDF</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ / Accordion (Brutalist Style) -->
    <section class="py-20 bg-neo-bg">
        <div class="container mx-auto px-6 max-w-4xl">
            <h2 class="font-sans font-black text-4xl text-center mb-12">FAQ (FREAKING ASKED QUESTIONS)</h2>

            <div class="space-y-4">
                <!-- Item 1 -->
                <div class="border-neo bg-white shadow-neo group cursor-pointer"
                    onclick="this.classList.toggle('active')">
                    <div
                        class="p-4 flex justify-between items-center bg-white group-[.active]:bg-neo-yellow border-b-2 border-black group-[.active]:border-b-4 transition-colors">
                        <h3 class="font-bold font-mono">Is this thing free?</h3>
                        <i data-feather="chevron-down" class="group-[.active]:rotate-180 transition-transform"></i>
                    </div>
                    <div class="p-4 hidden group-[.active]:block font-mono text-sm bg-white">
                        <p>We have a free tier that rocks. But if you want the superpower AI features, it's the price of
                            a coffee.</p>
                    </div>
                </div>

                <!-- Item 2 -->
                <div class="border-neo bg-white shadow-neo group cursor-pointer"
                    onclick="this.classList.toggle('active')">
                    <div
                        class="p-4 flex justify-between items-center bg-white group-[.active]:bg-neo-pink border-b-2 border-black group-[.active]:border-b-4 transition-colors">
                        <h3 class="font-bold font-mono">Will I get the job?</h3>
                        <i data-feather="chevron-down" class="group-[.active]:rotate-180 transition-transform"></i>
                    </div>
                    <div class="p-4 hidden group-[.active]:block font-mono text-sm bg-white">
                        <p>We build the gun, you pull the trigger. Our CVs increase your chances by 70%, but you still
                            gotta show up to the interview.</p>
                    </div>
                </div>
                <!-- Item 3 -->
                <div class="border-neo bg-white shadow-neo group cursor-pointer"
                    onclick="this.classList.toggle('active')">
                    <div
                        class="p-4 flex justify-between items-center bg-white group-[.active]:bg-neo-blue border-b-2 border-black group-[.active]:border-b-4 transition-colors">
                        <h3 class="font-bold font-mono">Can I edit later?</h3>
                        <i data-feather="chevron-down" class="group-[.active]:rotate-180 transition-transform"></i>
                    </div>
                    <div class="p-4 hidden group-[.active]:block font-mono text-sm bg-white">
                        <p>Yes, your data is saved securely. Come back anytime to update when you get that promotion.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section class="py-24 bg-neo-pink border-t-4 border-black text-center relative overflow-hidden">
        <!-- BG Pattern -->
        <div class="absolute inset-0 opacity-10"
            style="background-image: radial-gradient(#000 2px, transparent 2px); background-size: 20px 20px;"></div>

        <div class="container mx-auto px-6 relative z-10">
            <h2
                class="font-sans font-black text-5xl md:text-7xl mb-8 text-white text-stroke drop-shadow-[4px_4px_0_rgba(0,0,0,1)]">
                DON'T BE UNEMPLOYED.
            </h2>
            <div class="bg-white border-neo inline-block p-8 transform rotate-2 shadow-neo-lg">
                <p class="font-mono font-bold text-lg mb-6">Create your professional CV in minutes.</p>
                <a href="/cv-form"
                    class="btn-neo block w-full py-4 bg-neo-yellow border-neo font-black text-xl hover:bg-black hover:text-white uppercase">
                    Launch Cv Maker
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-black text-white py-12 border-t-4 border-neo-yellow">
        <div class="container mx-auto px-6 grid md:grid-cols-4 gap-8">
            <div class="col-span-2">
                <h2 class="font-sans font-black text-3xl text-neo-yellow mb-4">TheCvMaker.</h2>
                <p class="font-mono text-sm text-gray-400 max-w-xs">
                    Made with ☕ and ⚡ for job seekers who hate boring documents.
                </p>
            </div>
            <div>
                <h4 class="font-bold font-mono text-neo-pink mb-4 uppercase">Links</h4>
                <ul class="space-y-2 font-mono text-sm">
                    <li><a href="#" class="hover:text-neo-blue hover:underline decoration-2">Home</a></li>
                    <li><a href="#" class="hover:text-neo-blue hover:underline decoration-2">Templates</a></li>
                    <li><a href="#" class="hover:text-neo-blue hover:underline decoration-2">Pricing</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold font-mono text-neo-green mb-4 uppercase">Socials</h4>
                <div class="flex gap-4">
                    <a href="#"
                        class="w-10 h-10 bg-white text-black flex items-center justify-center border-2 border-white hover:bg-neo-blue hover:border-neo-blue transition-colors"><i
                            data-feather="instagram"></i></a>
                    <a href="#"
                        class="w-10 h-10 bg-white text-black flex items-center justify-center border-2 border-white hover:bg-neo-blue hover:border-neo-blue transition-colors"><i
                            data-feather="twitter"></i></a>
                </div>
            </div>
        </div>
        <div class="text-center mt-12 font-mono text-xs text-gray-600">
            &copy; {{ date('Y') }} TheCvMaker. No rights reserved. Just kidding, all rights reserved.
        </div>
    </footer>
</div>
