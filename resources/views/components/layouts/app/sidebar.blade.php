<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">

<head>
    @include('partials.head')
</head>

<body class="min-h-screen bg-slate-200 flex">
    @livewire('sidebar')
    <div class="w-full p-8">
        {{ $slot }}
    </div>

</body>

</html>
