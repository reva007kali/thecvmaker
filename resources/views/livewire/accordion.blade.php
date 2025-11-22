<div x-data="{ current: @entangle('open') }">
    @foreach ($items as $item)
        <div class="border rounded-lg overflow-hidden mb-2">

            <button wire:click="toggle({{ $item['id'] }})" class="w-full px-4 py-3 bg-gray-100 text-left font-medium">
                {{ $item['title'] }}
            </button>

            <div x-show="current === {{ $item['id'] }}" x-transition:enter="transition-all ease-out duration-300"
                x-transition:enter-start="opacity-0 max-h-0" x-transition:enter-end="opacity-100 max-h-40"
                x-transition:leave="transition-all ease-in duration-200" x-transition:leave-start="opacity-100 max-h-40"
                x-transition:leave-end="opacity-0 max-h-0" class="overflow-hidden">
                <div class="p-4">
                    {{ $item['content'] }}
                </div>
            </div>
        </div>
    @endforeach
</div>
