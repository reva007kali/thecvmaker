<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name') }}</title>

    <link rel="icon" href="/favicon2.png" sizes="any">
    <link rel="icon" href="/favicon2.png" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/apple-touch-icon.png">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">

    {{-- icons --}}
    <script src="https://unpkg.com/feather-icons"></script>


    {{-- vite style --}}
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/style.css'])
    {{-- @fluxAppearance --}}

    {{-- swiper js CDN --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />


</head>

<body class="font-lex antialiased">

    <nav class="sticky bg-white shadow-xl z-50 w-full top-0 py-3 px-2">
        <div class="flex justify-between items-center rounded-full container px-10">
            <div class="">
                <a class="font-lex items-center" href="">
                    <p class="text-xl">TheCvMaker</p>
                    <p class="text-xs">Powered by AI</p>
                </a>
            </div>
            <div class="flex gap-x-6">
                <div>
                    <a class="hover:text-primary" href="">About</a>
                </div>
                <div>
                    <a class="hover:text-primary" href="">CV Design</a>
                </div>
                <div>
                    <a class="hover:text-primary" href="">Contact</a>
                </div>
                <div>
                    <a class="px-4 py-2 rounded-full bg-primary text-white" href="cv-form">Create CV</a>
                </div>
            </div>
        </div>
    </nav>

    <section class="relative min-h-[86svh] flex flex-col justify-center mx-10 mb-10 rounded-3xl bg-center bg-cover"
        style="background-image:url('img/bg.png');">

        <img class="w-[130px] absolute top-52 animate-float rounded-md shadow-2xl -rotate-12 left-32 hover:-translate-y-6 hover:-rotate-0 transition duration-200 ease-in-out"
            src="img/cv-templates/6.png" alt="">
        <img class="w-[130px] absolute top-52 animate-float rounded-md shadow-2xl -rotate-12 left-44 hover:-translate-y-6 hover:-rotate-0 transition duration-200 ease-in-out"
            src="img/cv-templates/4.png" alt="">
        <img class="w-[130px] absolute top-52 animate-float rounded-md shadow-2xl rotate-12 right-32 hover:-translate-y-6 hover:-rotate-0 transition duration-200 ease-in-out"
            src="img/cv-templates/7.png" alt="">
        <img class="w-[130px] absolute top-52 animate-float rounded-md shadow-2xl rotate-12 right-44 hover:-translate-y-6 hover:-rotate-0 transition duration-200 ease-in-out"
            src="img/cv-templates/3.png" alt="">

        <div class="container space-y-6 max-w-7xl mx-auto">
            <div class="text-center text-white space-y-4 p-4">
                <p class="text-xl font-light font-lex">The Cv Maker - Powered by AI</p>
                <h1 class="text-6xl font-lex font-light mb-5">The best tool to create<br> your Professional CV.</h1>
                <p class="">“With our easy-to-use tools, you can create a CV that feels authentically
                    you. <br>Elevated by smart AI and designed to make a strong first impression.”</p>
            </div>
            <div class="flex gap-x-5 w-fit mx-auto">
                <a class=" px-5 py-3 rounded-full bg-primary backdrop-blur-md text-white border-2" href="/login">Create
                    CV</a>
                <a class=" px-5 py-3 rounded-full bg-white/50 backdrop-blur-md" href="/templates">Explore Designs</a>
            </div>
            <div>

            </div>
        </div>

        <div
            class="absolute -bottom-24 left-1/2 -translate-x-1/2 bg-white grid grid-cols-5 gap-4 rounded-4xl w-7xl mx-auto shadow-xl">
            <div class="p-6 text-left">
                <h2 class="text-4xl font-semibold text-primary mb-2">S<span class="text-2xl text-gray-500">imple</span>
                </h2>
                <p class="text-sm text-gray-500">Anti ribet, tinggal klik, lalu selesai tanpa pusing.</p>
            </div>
            <div class="p-6 text-left">
                <h2 class="text-4xl font-semibold text-primary mb-2">I<span class="text-2xl text-gray-500">nstant</span>
                </h2>
                <p class="text-sm text-gray-500">Proses super cepat, no waiting, and no drama.</p>
            </div>
            <div class="p-6 text-left">
                <h2 class="text-4xl font-semibold text-primary mb-2">G<span class="text-2xl text-gray-500">reat
                        value</span></h2>
                <p class="text-sm text-gray-500">Harga murah tapi kualitas premium.</p>
            </div>
            <div class="p-6  text-left">
                <h2 class="text-4xl font-semibold text-primary mb-2">M<span class="text-2xl text-gray-500">odern</span>
                </h2>
                <p class="text-sm text-gray-500">Selalu update dengan desain yang fresh.</p>
            </div>
            <div class="p-6 text-left">
                <h2 class="text-4xl font-semibold text-primary mb-2">A<span
                        class="text-2xl text-gray-500">ll-in-One</span>
                </h2>
                <p class="text-sm text-gray-500">Lengkap, Praktis di satu tempat.</p>
            </div>
        </div>
    </section>



    <section class="grid lg:grid-cols-3 relative space-y-4 p-4 py-10 mx-30 mt-32">
        <div class="col-span-2 flex items-center">
            <div class="space-y-4">
                <h1 class="text-5xl text-left text-primary">We Have The Best <br>Professional CV Design</h1>

            </div>
        </div>
        <div class="col-span-1 p-5 flex items-center">
            <p class="text-zinc-600 text-lg">Desain yang dirancang sesuai selera, passion, dan kebutuhan, sehingga
                terlihat lebih relevan dan menarik di mata HR.</p>
        </div>
    </section>

    <section class="relative mx-30 pb-10">
        {{-- @livewire('home-slider') --}}
    </section>

    <section class="text-center bg-cover bg-bottom relative space-y-4 p-4 py-20 mt-10" style="background-image: url('img/bg.png')">
        <div class="">
            <div class="space-y-4">
                <h1 class="text-5xl text-white">It's Only Few Steps And Your Cv Is Ready</h1>

            </div>
        </div>
        <div class="">
            <p class="text-white text-lg">Desain yang dirancang sesuai selera, passion, dan kebutuhan, sehingga
                terlihat lebih relevan dan menarik di mata HR.</p>
        </div>
    </section>

    <section class="grid lg:grid-cols-2 gap-x-20 py-10 mx-20">

        <div class="">
            <img class="rounded-2xl h-[500px] object-cover object-center" src="img/step-1.png" alt="">
        </div>

        <div class=" bg-white flex-col flex justify-between">
            <div class="space-y-5">
                <h1 class="text-5xl text-primary">Choose Your CV Template</h1>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Explicabo eligendi molestiae aliquam dicta
                    architecto, fugiat temporibus distinctio modi eveniet ab possimus laboriosam illum! Sequi
                    aspernatur, repudiandae minima accusamus dolores natus,<br><br> illum, unde maxime dolor modi
                    voluptas laborum. Voluptates ratione corrupti error rerum fugit iusto totam repellendus, neque
                    repudiandae! Optio ratione omnis labore sint qui! Nihil quisquam voluptatibus aut. Sit similique aut
                    architecto, reiciendis consequatur error doloremque nulla repellat dolorem. Magni neque ratione
                    fugit quis, perspiciatis quia et incidunt reiciendis at quibusdam doloribus veniam rem sint totam
                    quisquam provident maiores aut ex soluta optio dolorum minima? Dolores exercitationem culpa
                    voluptate commodi.</p>
                <a class="px-4 w-fit py-2 rounded-full bg-primary text-white" href="">Create Your CV Now</a>
            </div>
        </div>
    </section>

    <section class="grid lg:grid-cols-2 gap-10 py-10 mx-20">

        <div class=" bg-white flex-col flex justify-between">
            <div class="space-y-5">
                <h1 class="text-3xl text-primary">Fill Up The CV Form</h1>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Fugiat sapiente ut quaerat quia nihil
                    numquam
                    aliquam maiores vel! Hic nostrum, neque nulla tempora debitis libero? Debitis dicta ea ipsa iste!
                </p>
                <ul>
                    <li>Lorem ipsum dolor sit.</li>
                    <li>Lorem ipsum dolor sit.</li>
                    <li>Lorem ipsum dolor sit.</li>
                    <li>Lorem ipsum dolor sit.</li>
                    <li>Lorem ipsum dolor sit.</li>
                </ul>
                <a class="px-4 w-fit py-2 rounded-full bg-primary text-white" href="">Create Your CV Now</a>
            </div>
        </div>

        <div class="">
            <img class="rounded-2xl" src="img/step-1.png" alt="">
        </div>

    </section>


    <section class="grid lg:grid-cols-2 gap-10 py-10 mx-20">

        <div class="">
            <img class="rounded-2xl" src="img/step-3.png" alt="">
        </div>

        <div class=" bg-white flex-col flex justify-between">
            <div class="space-y-5">
                <h1 class="text-3xl text-primary">Pay and Your CV is Done</h1>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Explicabo eligendi molestiae aliquam dicta
                    architecto, fugiat temporibus distinctio modi eveniet ab possimus laboriosam illum! Sequi
                    aspernatur, repudiandae minima accusamus dolores natus,<br><br> illum, unde maxime dolor modi
                    voluptas laborum. Voluptates ratione corrupti error rerum fugit iusto totam repellendus, neque
                    repudiandae! Optio ratione omnis labore sint qui! Nihil quisquam voluptatibus aut. Sit similique aut
                    architecto, reiciendis consequatur error doloremque nulla repellat dolorem. Magni neque ratione
                    fugit quis, perspiciatis quia et incidunt reiciendis at quibusdam doloribus veniam rem sint totam
                    quisquam provident maiores aut ex soluta optio dolorum minima? Dolores exercitationem culpa
                    voluptate commodi.
                </p>
                <a class="px-4 w-fit py-2 rounded-full bg-primary text-white" href="">Create Your CV Now</a>
            </div>
        </div>
    </section>


    <section class="grid bg-primary/20 lg:grid-cols-4 gap-10 py-10 px-20">
        <div class="p-5 border-r-2  border-gray-300 space-y-3">
            <h3>Lorem, ipsum dolor.</h3>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequatur, quo.</p>
        </div>
        <div class="p-5 border-r-2  border-gray-300 space-y-3">
            <h3>Lorem, ipsum dolor.</h3>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequatur, quo.</p>
        </div>
        <div class="p-5 border-r-2  border-gray-300 space-y-3">
            <h3>Lorem, ipsum dolor.</h3>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequatur, quo.</p>
        </div>
        <div class="p-5 space-y-3">
            <h3>Lorem, ipsum dolor.</h3>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Consequatur, quo.</p>
        </div>
    </section>

    <section class="grid lg:grid-cols-3 relative space-y-4 p-4 py-10 mx-30 mt-20">
        <div class="col-span-2 flex items-center">
            <div class="space-y-4">
                <h1 class="text-5xl text-left text-primary leading-14">Hilangkan kutukan <br>pengangguran <br>dalam
                    diri anda</h1>

            </div>
        </div>
        <div class="col-span-1 p-5 flex items-center">
            <p class="text-zinc-600 text-xl">Kutukan pengangguran adalah hal yang nyata Lorem ipsum dolor sit amet
                consectetur, adipisicing elit. Temporibus mollitia accusamus qui dolorem, saepe dolorum minus eum!
                Labore, atque soluta.</p>
        </div>
    </section>
    <section class="grid lg:grid-cols-2 gap-x-12 relative py-10 mx-30 mt-20">
        <div class="col-span-1 p-5 ">
            @livewire('accordion')
        </div>
        <div class="col-span-1 flex items-center">
            <img class="rounded-3xl" src="img/levelup.png" alt="">
        </div>
    </section>



    <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
    <script>
        feather.replace();
    </script>
</body>

</html>
