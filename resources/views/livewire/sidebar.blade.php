<div x-data="{
    sidebarOpen: @entangle('isSidebarOpen'),
    openSubmenu: @entangle('openSubmenu')
}" class="relative h-screen flex overflow-hidden bg-gray-50 pr-4">

    {{-- ===================================================
     1. MOBILE OVERLAY (Backdrop)
     =================================================== --}}
    <div x-show="sidebarOpen" x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" @click="sidebarOpen = false"
        class="fixed inset-0 z-40 bg-black/50 backdrop-blur-sm lg:hidden">
    </div>

    {{-- ===================================================
     2. SIDEBAR NAVIGATION
     =================================================== --}}
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
        class="fixed inset-y-0 left-0 z-50 w-72 bg-white border-r-2 border-black transition-transform duration-300 ease-[cubic-bezier(0.25,1,0.5,1)] flex flex-col lg:static lg:h-screen shadow-[4px_0px_0px_0px_rgba(0,0,0,0.05)]">

        {{-- A. LOGO HEADER --}}
        <div class="h-20 flex items-center px-6 border-b-2 border-black bg-accent-lime/20 flex-shrink-0">
            <a href="/dashboard" wire:navigate class="flex items-center gap-3 group w-full">
                <div
                    class="w-10 h-10 bg-black text-white flex items-center justify-center border-2 border-black shadow-[2px_2px_0px_0px_rgba(0,0,0,0.2)] group-hover:-rotate-6 transition-transform">
                    <i data-lucide="layout-grid" class="w-5 h-5"></i>
                </div>
                <div>
                    <h1 class="font-display font-bold text-xl uppercase leading-none tracking-tight">System</h1>
                    <span class="font-mono text-[10px] font-bold bg-black text-white px-1">v2.0</span>
                </div>

                {{-- Close Button (Mobile Only) --}}
                <button @click="sidebarOpen = false"
                    class="ml-auto lg:hidden p-1 hover:bg-red-500 hover:text-white border-2 border-transparent hover:border-black rounded transition-colors">
                    <i data-lucide="x" class="w-5 h-5"></i>
                </button>
            </a>
        </div>

        {{-- B. USER PROFILE CARD --}}
        <div class="p-6 border-b-2 border-black bg-white flex-shrink-0">
            <div
                class="flex items-center gap-4 p-3 border-2 border-black bg-gray-50 shadow-[4px_4px_0px_0px_black] hover:translate-x-[1px] hover:translate-y-[1px] hover:shadow-[2px_2px_0px_0px_black] transition-all cursor-default">
                <div class="relative">
                    <img src="{{ auth()->user()->avatar ?? 'https://i.pravatar.cc/150?u=a042581f4e29026024d' }}"
                        alt="Avatar" class="w-10 h-10 object-cover border border-black">
                    <div class="absolute -bottom-1 -right-1 w-3 h-3 bg-green-500 border border-black"></div>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-bold font-display truncate text-black uppercase">
                        {{ auth()->user()->name ?? 'Guest User' }}
                    </p>
                    <p class="text-[10px] font-mono text-gray-500 truncate">
                        {{ auth()->user()->email ?? 'guest@example.com' }}
                    </p>
                </div>
            </div>
        </div>

        {{-- C. NAVIGATION MENU --}}
        <nav class="flex-1 overflow-y-auto custom-scrollbar p-4 space-y-2">

            {{-- Label --}}
            <div class="px-2 mb-2 mt-2">
                <span class="font-mono text-[10px] uppercase font-bold text-gray-400 tracking-widest">Main Menu</span>
            </div>

            {{-- 1. Dashboard --}}
            <a wire:navigate href="/dashboard"
                class="flex items-center gap-3 px-4 py-3 border-2 transition-all duration-200 group
               {{ $activeMenu === 'dashboard'
                   ? 'bg-black border-black text-white shadow-[4px_4px_0px_0px_rgba(0,0,0,0.2)]'
                   : 'bg-white border-transparent hover:border-black text-gray-600 hover:text-black hover:shadow-[4px_4px_0px_0px_black]' }}">
                <i data-lucide="bar-chart-2"
                    class="w-5 h-5 {{ $activeMenu === 'dashboard' ? 'text-accent-lime' : '' }}"></i>
                <span class="font-bold text-sm uppercase tracking-wide">Dashboard</span>
            </a>

            {{-- 2. Products (Dropdown) --}}
            <div x-data="{ expanded: @entangle('openSubmenu') === 'products' }">
                <button @click="expanded = !expanded; $wire.toggleSubmenu('products')"
                    class="w-full flex items-center justify-between px-4 py-3 border-2 transition-all duration-200 group
                    {{ $activeMenu === 'products'
                        ? 'bg-black border-black text-white'
                        : 'bg-white border-transparent hover:border-black text-gray-600 hover:text-black hover:shadow-[4px_4px_0px_0px_black]' }}">
                    <div class="flex items-center gap-3">
                        <i data-lucide="package"
                            class="w-5 h-5 {{ $activeMenu === 'products' ? 'text-accent-lime' : '' }}"></i>
                        <span class="font-bold text-sm uppercase tracking-wide">Products</span>
                    </div>
                    <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-200"
                        :class="expanded ? 'rotate-180' : ''"></i>
                </button>

                {{-- Submenu Items --}}
                <div x-show="expanded" x-collapse
                    class="pl-6 pr-2 py-2 space-y-1 border-l-2 border-black ml-6 border-dashed mt-2">
                    <a href="#"
                        class="block px-4 py-2 text-xs font-mono font-bold uppercase text-gray-500 hover:text-black hover:bg-accent-lime hover:border border-black transition-colors">
                        - All Products
                    </a>
                    <a href="#"
                        class="block px-4 py-2 text-xs font-mono font-bold uppercase text-gray-500 hover:text-black hover:bg-accent-lime hover:border border-black transition-colors">
                        - Add New
                    </a>
                    <a href="#"
                        class="block px-4 py-2 text-xs font-mono font-bold uppercase text-gray-500 hover:text-black hover:bg-accent-lime hover:border border-black transition-colors">
                        - Categories
                    </a>
                </div>
            </div>

            {{-- 3. Analytics --}}
            <a wire:navigate href="#"
                class="flex items-center gap-3 px-4 py-3 border-2 transition-all duration-200 group
               {{ $activeMenu === 'analytics'
                   ? 'bg-black border-black text-white shadow-[4px_4px_0px_0px_rgba(0,0,0,0.2)]'
                   : 'bg-white border-transparent hover:border-black text-gray-600 hover:text-black hover:shadow-[4px_4px_0px_0px_black]' }}">
                <i data-lucide="pie-chart"
                    class="w-5 h-5 {{ $activeMenu === 'analytics' ? 'text-accent-lime' : '' }}"></i>
                <span class="font-bold text-sm uppercase tracking-wide">Analytics</span>
            </a>

            {{-- 4. Orders (With Badge) --}}
            <a wire:navigate href="#"
                class="flex items-center justify-between px-4 py-3 border-2 transition-all duration-200 group
               {{ $activeMenu === 'orders'
                   ? 'bg-black border-black text-white shadow-[4px_4px_0px_0px_rgba(0,0,0,0.2)]'
                   : 'bg-white border-transparent hover:border-black text-gray-600 hover:text-black hover:shadow-[4px_4px_0px_0px_black]' }}">
                <div class="flex items-center gap-3">
                    <i data-lucide="shopping-cart"
                        class="w-5 h-5 {{ $activeMenu === 'orders' ? 'text-accent-lime' : '' }}"></i>
                    <span class="font-bold text-sm uppercase tracking-wide">Orders</span>
                </div>
                <span
                    class="font-mono text-[10px] font-bold px-2 py-0.5 border border-current {{ $activeMenu === 'orders' ? 'bg-white text-black' : 'bg-black text-white' }}">
                    12
                </span>
            </a>

            <div class="px-2 mb-2 mt-6">
                <span class="font-mono text-[10px] uppercase font-bold text-gray-400 tracking-widest">Preferences</span>
            </div>

            {{-- 5. Settings (Dropdown) --}}
            <div x-data="{ expanded: @entangle('openSubmenu') === 'settings' }">
                <button @click="expanded = !expanded; $wire.toggleSubmenu('settings')"
                    class="w-full flex items-center justify-between px-4 py-3 border-2 transition-all duration-200 group
                    {{ $activeMenu === 'settings'
                        ? 'bg-black border-black text-white'
                        : 'bg-white border-transparent hover:border-black text-gray-600 hover:text-black hover:shadow-[4px_4px_0px_0px_black]' }}">
                    <div class="flex items-center gap-3">
                        <i data-lucide="settings"
                            class="w-5 h-5 {{ $activeMenu === 'settings' ? 'text-accent-lime' : '' }}"></i>
                        <span class="font-bold text-sm uppercase tracking-wide">Settings</span>
                    </div>
                    <i data-lucide="chevron-down" class="w-4 h-4 transition-transform duration-200"
                        :class="expanded ? 'rotate-180' : ''"></i>
                </button>

                <div x-show="expanded" x-collapse
                    class="pl-6 pr-2 py-2 space-y-1 border-l-2 border-black ml-6 border-dashed mt-2">
                    <a href="#"
                        class="block px-4 py-2 text-xs font-mono font-bold uppercase text-gray-500 hover:text-black hover:bg-accent-lime hover:border border-black transition-colors">
                        - Profile
                    </a>
                    <a href="#"
                        class="block px-4 py-2 text-xs font-mono font-bold uppercase text-gray-500 hover:text-black hover:bg-accent-lime hover:border border-black transition-colors">
                        - Security
                    </a>
                </div>
            </div>

        </nav>

        {{-- D. LOGOUT FOOTER --}}
        <div class="p-4 border-t-2 border-black bg-gray-50">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit"
                    class="w-full flex items-center justify-center gap-2 px-4 py-3 bg-white border-2 border-black font-bold text-sm uppercase hover:bg-red-500 hover:text-white transition-all shadow-[4px_4px_0px_0px_black] hover:translate-x-[2px] hover:translate-y-[2px] hover:shadow-none">
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                    <span>Log Out</span>
                </button>
            </form>
        </div>
    </aside>

    {{-- ===================================================
     3. MAIN CONTENT WRAPPER
     =================================================== --}}
    <main class="flex-1 overflow-hidden flex flex-col relative w-full h-full">

        {{-- Mobile Header Toggle (Only visible on mobile) --}}
        <header
            class="lg:hidden h-16 bg-white border-b-2 border-black flex items-center justify-between px-4 z-30 shrink-0">
            <div class="font-display font-bold text-lg uppercase">Dashboard</div>
            <button @click="sidebarOpen = true"
                class="p-2 border-2 border-black bg-white hover:bg-black hover:text-white transition-colors shadow-[2px_2px_0px_0px_black]">
                <i data-lucide="menu" class="w-5 h-5"></i>
            </button>
        </header>

        {{-- Content Area --}}
        <div class="flex-1 overflow-y-auto custom-scrollbar bg-white p-6">
            {{-- Slot for page content --}}
            {{ $slot ?? '' }}
        </div>
    </main>

</div>

{{-- SCRIPT: Init Icons --}}
<script>
    function initLucide() {
        if (typeof lucide !== 'undefined') {
            lucide.createIcons();
        }
    }

    // Load awal
    document.addEventListener('DOMContentLoaded', initLucide);
    // Load saat navigasi SPA Livewire (wire:navigate)
    document.addEventListener('livewire:navigated', initLucide);
    // Load saat DOM diupdate oleh Livewire (wire:click)
    document.addEventListener('livewire:init', () => {
        Livewire.hook('morph.updated', ({
            el,
            component
        }) => {
            initLucide();
        });
    });
</script>
