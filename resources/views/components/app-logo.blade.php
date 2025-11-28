<div class="flex aspect-square size-8 items-center justify-center rounded-full bg-accent-content text-accent-foreground">
    <img src="{{ auth()->user()->avatar ?? 'default-avatar.png' }}" alt="Avatar"
                                class="w-8 h-8 object-cover rounded-full">
</div>
<div class="ms-1 grid flex-1 text-start text-sm">
    <span class="mb-0.5 truncate leading-tight font-semibold">Hello {{ auth()->user()->name }}!</span>
</div>
