<div class="relative">
    <!-- Mobile Overlay -->
    <div x-data="{ open: @entangle('isSidebarOpen') }" x-show="open" @click="open = false"
        x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-40 bg-gray-900 bg-opacity-50 lg:hidden" style="display: none;"></div>

    <!-- Sidebar -->
    <aside x-data="{ open: @entangle('isSidebarOpen') }" :class="open ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
        class="fixed left-0 top-0 z-50 h-screen w-64 transform bg-gradient-to-b from-gray-900 to-gray-800 transition-transform duration-300 ease-in-out lg:static lg:translate-x-0">
        <!-- Logo Section -->
        <div class="flex h-16 items-center justify-between border-b border-gray-700 px-6">
            <div class="flex items-center space-x-2">
                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-600">
                    <svg class="h-5 w-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <span class="text-xl font-bold text-white">MyApp</span>
            </div>
            <button @click="open = false" class="text-gray-400 hover:text-white lg:hidden">
                <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- User Profile -->
        <div class="border-b border-gray-700 p-4">
            <div class="flex items-center space-x-3">
                <img src="{{ auth()->user()->avatar ?? 'default-avatar.png' }}" alt="Avatar"
                    class="w-12 h-12 rounded-full">

                <div class="flex-1">
                    <p class="text-sm font-semibold text-white">{{ auth()->user()->name ?? 'default-avatar.png' }}</p>
                    <p class="text-xs text-gray-400">{{ auth()->user()->email ?? 'default-avatar.png' }}</p>
                </div>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-1 overflow-y-auto p-4">
            <div class="space-y-1">
                <!-- Dashboard -->
                <a wire:click="setActiveMenu('dashboard')" href="#"
                    class="flex items-center space-x-3 rounded-lg px-4 py-3 text-sm font-medium transition-colors {{ $activeMenu === 'dashboard' ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    <span>Dashboard</span>
                </a>

                <!-- Analytics -->
                <a wire:click="setActiveMenu('analytics')" href="#"
                    class="flex items-center space-x-3 rounded-lg px-4 py-3 text-sm font-medium transition-colors {{ $activeMenu === 'analytics' ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <span>Analytics</span>
                </a>

                <!-- Products with Submenu -->
                <div>
                    <button wire:click="toggleSubmenu('products')"
                        class="flex w-full items-center justify-between rounded-lg px-4 py-3 text-sm font-medium transition-colors {{ $activeMenu === 'products' ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                        <div class="flex items-center space-x-3">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                            <span>Products</span>
                        </div>
                        <svg class="h-4 w-4 transition-transform {{ $openSubmenu === 'products' ? 'rotate-180' : '' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    @if ($openSubmenu === 'products')
                        <div class="ml-4 mt-1 space-y-1 border-l-2 border-gray-700 pl-4">
                            <a href="#"
                                class="block rounded-lg px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white">All
                                Products</a>
                            <a href="#"
                                class="block rounded-lg px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white">Add
                                New</a>
                            <a href="#"
                                class="block rounded-lg px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white">Categories</a>
                        </div>
                    @endif
                </div>

                <!-- Orders -->
                <a wire:click="setActiveMenu('orders')" href="#"
                    class="flex items-center space-x-3 rounded-lg px-4 py-3 text-sm font-medium transition-colors {{ $activeMenu === 'orders' ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <span>Orders</span>
                    <span class="ml-auto rounded-full bg-red-500 px-2 py-0.5 text-xs font-semibold text-white">12</span>
                </a>

                <!-- Customers -->
                <a wire:click="setActiveMenu('customers')" href="#"
                    class="flex items-center space-x-3 rounded-lg px-4 py-3 text-sm font-medium transition-colors {{ $activeMenu === 'customers' ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <span>Customers</span>
                </a>

                <!-- Settings with Submenu -->
                <div>
                    <button wire:click="toggleSubmenu('settings')"
                        class="flex w-full items-center justify-between rounded-lg px-4 py-3 text-sm font-medium transition-colors {{ $activeMenu === 'settings' ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700 hover:text-white' }}">
                        <div class="flex items-center space-x-3">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Settings</span>
                        </div>
                        <svg class="h-4 w-4 transition-transform {{ $openSubmenu === 'settings' ? 'rotate-180' : '' }}"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>

                    @if ($openSubmenu === 'settings')
                        <div class="ml-4 mt-1 space-y-1 border-l-2 border-gray-700 pl-4">
                            <a href="#"
                                class="block rounded-lg px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white">Profile</a>
                            <a href="#"
                                class="block rounded-lg px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white">Account</a>
                            <a href="#"
                                class="block rounded-lg px-4 py-2 text-sm text-gray-400 hover:bg-gray-700 hover:text-white">Security</a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Bottom Section -->
            <div class="mt-8 border-t border-gray-700 pt-4">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button href="logout"
                        class="flex items-center space-x-3 rounded-lg px-4 py-3 text-sm font-medium text-gray-300 transition-colors hover:bg-gray-700 hover:text-white">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </nav>
    </aside>

    <!-- Mobile Toggle Button -->
    <button wire:click="toggleSidebar"
        class="fixed bottom-4 right-4 z-50 flex h-12 w-12 items-center justify-center rounded-full bg-blue-600 text-white shadow-lg lg:hidden">
        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
    </button>
</div>
