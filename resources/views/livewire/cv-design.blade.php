 <!-- Swiper -->
 <style>
     .swiper {
         width: 100%;
         padding-top: 50px;
         padding-bottom: 60px;
         /* color: rgb(22, 22, 22); */
     }

     .swiper-slide {
         background-position: center;
         background-size: cover;
         width: 300px;
         height: 420px;
     }

     .swiper-slide img {
         display: block;
         width: 100%;
         height: 100%;
     }

     .swiper-pagination-bullet {
         width: 10px;
         height: 10px;
         background: #ccc;
         opacity: 1;
         border-radius: 999px;
         transition: 0.2s;
     }

     .swiper-pagination-bullet-active {
         width: 26px;
         background: var(--color-primary);
     }

     .cv-button-next,
     .cv-button-prev {
         position: absolute;
         z-index: 9999 !important;
     }
 </style>
 <div class="relative">
     <div class="swiper cvSwiper">

         <div class="swiper-wrapper">

             <div class="swiper-slide">
                 <div id="cv-1" class="cv-template overflow-hidden rounded-xl bg-white w-full h-full flex">
                     <img src="img/cv-templates/1.png" alt="">
                 </div>
             </div>

             <div class="swiper-slide">
                 <div id="cv-1" class="cv-template overflow-hidden rounded-xl bg-white w-full h-full flex">
                     <img src="img/cv-templates/2.png" alt="">
                 </div>
             </div>

             <div class="swiper-slide">
                 <div id="cv-1" class="cv-template overflow-hidden rounded-xl bg-white w-full h-full flex">
                     <img src="img/cv-templates/3.png" alt="">
                 </div>
             </div>

             <div class="swiper-slide">
                 <div id="cv-1" class="cv-template overflow-hidden rounded-xl bg-white w-full h-full flex">
                     <img src="img/cv-templates/4.png" alt="">
                 </div>
             </div>

             <div class="swiper-slide">
                 <div id="cv-1" class="cv-template overflow-hidden rounded-xl bg-white w-full h-full flex">
                     <img src="img/cv-templates/5.png" alt="">
                 </div>
             </div>

             <div class="swiper-slide">
                 <div id="cv-1" class="cv-template overflow-hidden rounded-xl bg-white w-full h-full flex">
                     <img src="img/cv-templates/6.png" alt="">
                 </div>
             </div>

             <div class="swiper-slide">
                 <div id="cv-1" class="cv-template overflow-hidden rounded-xl bg-white w-full h-full flex">
                     <img src="img/cv-templates/7.png" alt="">
                 </div>
             </div>

         </div>

         <div class="swiper-pagination"></div>

     </div>

     <div class="absolute bottom-1/2 -left-6 bg-primary p-4 animate-pulse rounded-full cv-button-prev"><i
             data-feather="arrow-left"></i></div>
     <div class="absolute bottom-1/2 -right-6 bg-primary p-4 animate-pulse rounded-full cv-button-next"><i
             data-feather="arrow-right"></i>
     </div>

 </div>


 <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
 <script>
     var cvSwiper = new Swiper(".cvSwiper", {
         effect: "coverflow",
         grabCursor: true,
         centeredSlides: true,
         slidesPerView: "auto",
         initialSlide: 2,
         spaceBetween: 30,
         coverflowEffect: {
             rotate: 10,
             stretch: 0,
             depth: 100,
             modifier: 1,
             slideShadows: true,
         },
         pagination: {
             el: ".swiper-pagination",
             clickable: true,
             dynamicBullets: true,
         },
         navigation: {
             nextEl: ".cv-button-next",
             prevEl: ".cv-button-prev",
         },
     });
 </script>
