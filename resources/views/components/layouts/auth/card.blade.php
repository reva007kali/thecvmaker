<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">
    <head>
        @include('partials.head')
    </head>
    <body class="min-h-screen antialiased dark:bg-linear-to-b dark:from-neutral-950 dark:to-neutral-900">
        <div class="bg-muted flex flex-col items-center justify-center gap-6 p-6 md:p-0">
            {{$slot }}
        </div>
        @fluxScripts
    </body>
</html>
