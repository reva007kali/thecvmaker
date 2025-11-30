<x-layouts.auth>
    <!-- Main Container: Split Screen -->
    <div class="min-h-screen w-full flex bg-swiss-white">

        <!-- LEFT SIDE: Visuals (Hidden on Mobile) -->
        <div
            class="hidden lg:flex w-1/2 bg-swiss-black relative overflow-hidden flex-col justify-between p-12 text-white">
            <!-- Noise Texture Overlay -->
            <div
                class="absolute inset-0 bg-[url('https://grainy-gradients.vercel.app/noise.svg')] opacity-20 pointer-events-none">
            </div>

            <!-- Abstract Glow -->
            <div
                class="absolute top-0 right-0 w-96 h-96 bg-accent-blue/30 rounded-full blur-[100px] -translate-y-1/2 translate-x-1/2">
            </div>

            <!-- Logo Area -->
            <a href="/" wire:navigate.hover class="relative z-10 flex items-center gap-2">
                <div class="w-8 h-8 bg-white text-black rounded-full flex items-center justify-center">
                    <span class="font-display font-bold">cv</span>
                </div>
                <span class="font-display font-bold text-xl tracking-tight">thecvmaker.</span>
            </a>

            <!-- Big Text -->
            <div class="relative z-10 space-y-6">
                <h1 class="font-display text-6xl font-bold leading-[0.9] tracking-tighter">
                    unemployment? <br>
                    <span class="text-accent-blue line-through decoration-4 decoration-white">cancelled.</span>
                </h1>
                <p class="text-gray-400 text-lg max-w-md font-sans">
                    Your old cv was giving "meh". let's make it give "hired".
                    enter your winning era. no skips.
                </p>
            </div>

            <!-- Social Proof / Footer -->
            <div class="relative z-10 border-t border-white/10 pt-8">
                <div class="flex items-center gap-4">
                    <div class="flex -space-x-3">
                        <img class="w-10 h-10 rounded-full border-2 border-swiss-black"
                            src="https://i.pravatar.cc/100?img=33" alt="">
                        <img class="w-10 h-10 rounded-full border-2 border-swiss-black"
                            src="https://i.pravatar.cc/100?img=47" alt="">
                        <img class="w-10 h-10 rounded-full border-2 border-swiss-black"
                            src="https://i.pravatar.cc/100?img=12" alt="">
                    </div>
                    <div>
                        <div class="flex gap-1 text-accent-lime">
                            <i data-feather="star" class="w-3 h-3 fill-current"></i>
                            <i data-feather="star" class="w-3 h-3 fill-current"></i>
                            <i data-feather="star" class="w-3 h-3 fill-current"></i>
                            <i data-feather="star" class="w-3 h-3 fill-current"></i>
                            <i data-feather="star" class="w-3 h-3 fill-current"></i>
                        </div>
                        <p class="text-xs text-gray-400 mt-1">Trusted by 15k+ job seekers</p>
                    </div>
                </div>
            </div>
            <!-- Simple Footer (Right Side) -->
            <div class="absolute bottom-6 text-xs mt-4 text-gray-400 font-mono">
                &copy; {{ date('Y') }} TheCvMaker. No cap.
            </div>
        </div>

        <!-- RIGHT SIDE: Form Area -->
        <div class="w-full lg:w-1/2 flex flex-col justify-center items-center p-8 relative">
            <!-- Decorative Grid Lines (Swiss Style) -->
            <div class="absolute inset-0 pointer-events-none opacity-30"
                style="background-image: linear-gradient(#e5e7eb 1px, transparent 1px), linear-gradient(90deg, #e5e7eb 1px, transparent 1px); background-size: 40px 40px;">
            </div>

            <!-- Mobile Logo (Visible only on mobile) -->
            <div class="lg:hidden absolute top-8 left-8 flex items-center gap-2">
                <div class="w-8 h-8 bg-swiss-black text-white rounded-full flex items-center justify-center">
                    <span class="font-display font-bold">cv</span>
                </div>
            </div>

            <div
                class="w-full max-w-md bg-white/80 backdrop-blur-sm p-8 md:p-10 rounded-2xl border border-gray-200 shadow-xl relative z-20">

                <!-- Header -->
                <div class="mb-8 text-center">
                    <h2 class="font-display text-3xl font-bold text-swiss-black mb-2">welcome back.</h2>
                    <p class="text-gray-500 text-sm font-sans">ready to secure the bag? enter your details.</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4 text-center text-sm font-medium text-green-600" :status="session('status')" />

                <!-- Google Login (Prioritized) -->
                <a href="{{ route('google.redirect') }}"
                    class="group relative w-full flex items-center justify-center gap-3 bg-white border border-black text-swiss-black px-4 py-3 rounded-lg font-bold font-display hover:bg-gray-50 transition-all hover:shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:-translate-y-0.5 mb-6">
                    <img src="https://www.svgrepo.com/show/475656/google-color.svg"
                        class="w-5 h-5 group-hover:scale-110 transition-transform">
                    <span>Continue with Google</span>
                </a>

                <div class="relative flex py-2 items-center mb-6">
                    <div class="flex-grow border-t border-gray-200"></div>
                    <span class="flex-shrink-0 mx-4 text-gray-400 text-xs uppercase tracking-widest font-mono">Or login
                        with email</span>
                    <div class="flex-grow border-t border-gray-200"></div>
                </div>

                <!-- Form -->
                <form method="POST" action="{{ route('login.store') }}" class="flex flex-col gap-5">
                    @csrf

                    <!-- Email -->
                    <div class="space-y-1">
                        <flux:input name="email" :label="__('Email address')" type="email" required autofocus
                            placeholder="you@example.com" class="font-sans" />
                    </div>

                    <!-- Password -->
                    <div class="space-y-1">
                        <div class="relative">
                            <flux:input name="password" :label="__('Password')" type="password" required
                                placeholder="••••••••" viewable class="font-sans" />

                            @if (Route::has('password.request'))
                                <a href="{{ route('password.request') }}" wire:navigate
                                    class="absolute top-0 right-0 text-xs font-medium text-gray-500 hover:text-accent-blue transition-colors hover:underline">
                                    Forgot password?
                                </a>
                            @endif
                        </div>
                    </div>

                    <!-- Remember Me & Submit -->
                    <div class="pt-2">
                        <flux:checkbox name="remember" :label="__('Remember me for 30 days')" />
                    </div>

                    <div class="pt-2">
                        <flux:button variant="primary" type="submit"
                            class="w-full justify-center !bg-swiss-black !text-white !font-display !font-bold !py-3 !rounded-lg hover:!bg-accent-blue transition-colors shadow-lg"
                            data-test="login-button">
                            {{ __('Log In') }} ->
                        </flux:button>
                    </div>
                </form>

                <!-- Footer Link -->
                @if (Route::has('register'))
                    <div class="mt-8 text-center">
                        <p class="text-sm text-gray-600 font-sans">
                            New here?
                            <a href="{{ route('register') }}" wire:navigate
                                class="font-bold text-swiss-black hover:text-accent-blue underline decoration-2 underline-offset-4 transition-colors">
                                Create an account
                            </a>
                        </p>
                    </div>
                @endif
            </div>


        </div>
    </div>
</x-layouts.auth>
