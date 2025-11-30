@props(['img', 'name', 'handle', 'text', 'tag' => null, 'color' => 'bg-black'])

<div
    class="hover-trigger relative w-[350px] p-6 bg-white border border-gray-200 rounded-2xl shadow-sm hover:shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] hover:-translate-y-1 hover:border-black transition-all duration-300 flex-shrink-0 cursor-none">

    <!-- Header -->
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-full border border-black overflow-hidden bg-gray-100">
                <img src="{{ $img }}" alt="{{ $name }}" class="w-full h-full object-cover">
            </div>
            <div>
                <div class="flex items-center gap-1">
                    <p class="font-display font-bold text-sm text-swiss-black leading-none">{{ $name }}</p>
                    <i data-feather="check-circle" class="w-3 h-3 text-blue-500 fill-current"></i>
                </div>
                <p class="text-xs text-gray-400 font-mono">{{ $handle }}</p>
            </div>
        </div>
        <div class="w-8 h-8 flex items-center justify-center bg-black rounded-full text-white">
            <svg viewBox="0 0 24 24" class="w-4 h-4 fill-current">
                <path
                    d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z">
                </path>
            </svg>
        </div>
    </div>

    <!-- Content -->
    <p class="text-swiss-black text-sm font-medium leading-relaxed mb-4">
        "{{ $text }}"
    </p>

    <!-- Footer Tag -->
    @if ($tag)
        <div class="flex items-center justify-between border-t border-gray-100 pt-3">
            <div class="flex items-center gap-2">
                <span class="w-2 h-2 rounded-full {{ $color }} animate-pulse"></span>
                <span
                    class="text-xs font-bold font-mono uppercase tracking-wider text-gray-500">{{ $tag }}</span>
            </div>
            <span class="text-[10px] text-gray-300">2h ago</span>
        </div>
    @endif
</div>
