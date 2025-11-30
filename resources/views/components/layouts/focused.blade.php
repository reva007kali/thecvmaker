<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ?? 'Isi CV' }}</title>

    <link rel="icon" href="/favicon2.png" sizes="any">
    <link rel="icon" href="/favicon2.png" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <!-- Fonts: Space Grotesk (Display) & Plus Jakarta Sans (Body) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600&family=Space+Grotesk:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">


    {{-- vite style --}}
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/style.css'])
    {{-- @fluxAppearance --}}

    {{-- swiper js CDN --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />


</head>

<body class="font-lex bg-accent relative antialiased">



    {{ $slot }}

    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>
</body>

</html>
