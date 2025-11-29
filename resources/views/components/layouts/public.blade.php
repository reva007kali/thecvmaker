<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'TheCvMaker') }}</title>


    <link rel="icon" href="/favicon2.png" sizes="any">
    <link rel="icon" href="/favicon2.png" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">


    <!-- Fonts: Space Grotesk (Tech Headings) & Inter (Body) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Space+Grotesk:wght@500;700&display=swap"
        rel="stylesheet">

    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    {{-- vite style --}}
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/style.css'])
    {{-- @fluxAppearance --}}

    {{-- swiper js CDN --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />


</head>

<body
    class="font-lex antialiased text-slate-800 bg-slate-50 overflow-x-hidden selection:bg-primary selection:text-white">

    {{ $slot }}

    <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        feather.replace();
        AOS.init({
            once: true,
            duration: 600,
            offset: 50,
            easing: 'cubic-bezier(0.175, 0.885, 0.32, 1.275)' // Bouncy effect
        });

        // Simple accordion logic for mobile menu and faq (inline onclick used for simplicity)
    </script>
</body>

</html>
