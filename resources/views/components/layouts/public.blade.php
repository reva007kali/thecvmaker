<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'TheCvMaker') }}</title>


    <link rel="icon" href="/favicon2.png" sizes="any">
    <link rel="icon" href="/favicon2.png" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">


    <!-- Fonts: Space Grotesk (Display) & Plus Jakarta Sans (Body) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600&family=Space+Grotesk:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">


    <!-- GSAP for Award-Winning Animations -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    {{-- vite style --}}
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/style.css'])
    {{-- @fluxAppearance --}}

    {{-- swiper js CDN --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />


</head>

<body class="bg-swiss-white text-swiss-black font-sans antialiased selection:bg-accent-blue selection:text-white"
    x-data="{ mobileMenu: false }">

    {{ $slot }}

    <div id="google_translate_element" style="display: none;"></div>
    <div id="translate-popup" class="neo-popup hidden">
        <div class="neo-inner">
            <h3>Translate to Indonesian?</h3>
            <p>Halaman ini berbahasa Inggris. Mau diubah ke Bahasa Indonesia?</p>

            <div class="neo-actions">
                <button id="btn-translate" class="neo-btn translate">Terjemahkan</button>
                <button id="btn-close-popup" class="neo-btn close">Tidak perlu</button>
            </div>
        </div>
    </div>

    <script>
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({
                pageLanguage: 'en',
                includedLanguages: 'id,en',
                autoDisplay: false
            }, 'google_translate_element');
        }
    </script>


    <script src="https://unpkg.com/lucide@latest"></script>
    <script>
        lucide.createIcons();
    </script>
</body>

</html>
