<div x-data="{
    first_name: @entangle('first_name'),
    last_name: @entangle('last_name'),
    email: @entangle('email'),
    phone: @entangle('phone'),
    address: @entangle('address'),
    website_link: @entangle('website_link'),
    portfolio_link: @entangle('portfolio_link'),
    experiences: @entangle('experiences'),
    updateExp(index, field, value) {
        this.experiences[index][field] = value;
    },
    educations: @entangle('educations'),
    updateEdu(index, field, value) {
        this.educations[index][field] = value;
    },
    soft_skills: @entangle('softSkills'),
    updateSoftSkill(index, field, value) {
        this.soft_skills[index][field] = value;
    }


}" class="relative w-full max-w-[794px] mx-auto aspect-[794/1123] shadow-lg bg-white">
    <div class="flex">



        {{-- isi cv --}}
        <div class="w-full">

        </div>
        {{-- side bar cv --}}
        <div class="w-[280px] bg-amber-900 text-white h-[1123px] p-8">

            <div class="p-4 mb-4">
                @if ($cv_photo)
                    <!-- Preview upload baru -->
                    <img src="{{ $cv_photo->temporaryUrl() }}"
                        class="aspect-square object-cover border-6 object-top border-white rounded-full mb-2">
                @elseif($existingPhoto)
                    <!-- Foto yang sudah ada di storage -->
                    <img src="{{ Storage::url($existingPhoto) }}"
                        class="aspect-square object-cover border-6 object-top border-white rounded-full mb-2">
                @else
                    <!-- Placeholder jika tidak ada foto -->
                    <img src="img/avatar-placeholder.png" alt="Avatar"
                        class="aspect-square object-cover border-6 object-top border-white rounded-full mb-2">
                @endif
            </div>

            {{-- contact info --}}
            <div class="mb-5">
                <h1 class="text-xl uppercase tracking-widest font-semibold">Contact</h1>
                <hr class="bg-white h-[1.5px] mb-2">
                <div class="space-y-2 font-light text-sm">

                    <div class="flex gap-x-2 items-center" x-show="phone" x-cloak>
                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg" transform="rotate(0)" stroke="#ffffff">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"
                                stroke="#CCCCCC" stroke-width="0.4800000000000001"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path
                                    d="M3 5.5C3 14.0604 9.93959 21 18.5 21C18.8862 21 19.2691 20.9859 19.6483 20.9581C20.0834 20.9262 20.3009 20.9103 20.499 20.7963C20.663 20.7019 20.8185 20.5345 20.9007 20.364C21 20.1582 21 19.9181 21 19.438V16.6207C21 16.2169 21 16.015 20.9335 15.842C20.8749 15.6891 20.7795 15.553 20.6559 15.4456C20.516 15.324 20.3262 15.255 19.9468 15.117L16.74 13.9509C16.2985 13.7904 16.0777 13.7101 15.8683 13.7237C15.6836 13.7357 15.5059 13.7988 15.3549 13.9058C15.1837 14.0271 15.0629 14.2285 14.8212 14.6314L14 16C11.3501 14.7999 9.2019 12.6489 8 10L9.36863 9.17882C9.77145 8.93713 9.97286 8.81628 10.0942 8.64506C10.2012 8.49408 10.2643 8.31637 10.2763 8.1317C10.2899 7.92227 10.2096 7.70153 10.0491 7.26005L8.88299 4.05321C8.745 3.67376 8.67601 3.48403 8.55442 3.3441C8.44701 3.22049 8.31089 3.12515 8.15802 3.06645C7.98496 3 7.78308 3 7.37932 3H4.56201C4.08188 3 3.84181 3 3.63598 3.09925C3.4655 3.18146 3.29814 3.33701 3.2037 3.50103C3.08968 3.69907 3.07375 3.91662 3.04189 4.35173C3.01413 4.73086 3 5.11378 3 5.5Z"
                                    stroke="#fff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                </path>
                            </g>
                        </svg>
                        <p x-text="phone"></p>
                    </div>

                    <div class="flex gap-x-2 items-center" x-show="email" x-cloak>
                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <rect x="3" y="6" width="18" height="12" rx="2" stroke="#fff"
                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></rect>
                                <path d="M20.5737 7L12 13L3.42635 7" stroke="#fff" stroke-width="1"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                            </g>
                        </svg>
                        <p x-text="email"></p>
                    </div>

                    <div class="flex gap-x-2 items-center" x-show="address" x-cloak>
                        <svg width="20px" height="20px" viewBox="0 0 8.4666669 8.4666669" id="svg8"
                            version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:cc="http://creativecommons.org/ns#"
                            xmlns:dc="http://purl.org/dc/elements/1.1/"
                            xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape"
                            xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
                            xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd"
                            xmlns:svg="http://www.w3.org/2000/svg" fill="#ffffff" stroke="#ffffff">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <defs id="defs2"></defs>
                                <g id="layer1" transform="translate(0,-288.53332)">
                                    <path
                                        d="m 15.996094,0.99609375 c -6.0632836,0 -10.9980445,4.93673065 -10.9980471,11.00000025 -3.8e-6,10.668737 10.3789061,18.779297 10.3789061,18.779297 0.364612,0.290384 0.881482,0.290384 1.246094,0 0,0 10.380882,-8.11056 10.380859,-18.779297 C 27.003893,5.9328244 22.059377,0.99609375 15.996094,0.99609375 Z m 0,6.00195315 c 2.749573,0 5.00585,2.2484784 5.005859,4.9980471 C 21.001971,14.7457 18.745685,17 15.996094,17 c -2.749591,0 -4.998064,-2.2543 -4.998047,-5.003906 9e-6,-2.7495687 2.248474,-4.9980471 4.998047,-4.9980471 z"
                                        id="path929"
                                        style="color:#ffffff;font-style:normal;font-variant:normal;font-weight:normal;font-stretch:normal;font-size:medium;line-height:normal;font-family:sans-serif;font-variant-ligatures:normal;font-variant-position:normal;font-variant-caps:normal;font-variant-numeric:normal;font-variant-alternates:normal;font-feature-settings:normal;text-indent:0;text-align:start;text-decoration:none;text-decoration-line:none;text-decoration-style:solid;text-decoration-color:#ffffff;letter-spacing:normal;word-spacing:normal;text-transform:none;writing-mode:lr-tb;direction:ltr;text-orientation:mixed;dominant-baseline:auto;baseline-shift:baseline;text-anchor:start;white-space:normal;shape-padding:0;clip-rule:nonzero;display:inline;overflow:visible;visibility:visible;opacity:1;isolation:auto;mix-blend-mode:normal;color-interpolation:sRGB;color-interpolation-filters:linearRGB;solid-color:#ffffff;solid-opacity:1;vector-effect:none;fill:#ffffff;fill-opacity:1;fill-rule:nonzero;stroke:none;stroke-width:1.99999988;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:4;stroke-dasharray:none;stroke-dashoffset:0;stroke-opacity:1;paint-order:stroke fill markers;color-rendering:auto;image-rendering:auto;shape-rendering:auto;text-rendering:auto;enable-background:accumulate"
                                        transform="matrix(0.26458333,0,0,0.26458333,0,288.53332)"></path>
                                </g>
                            </g>
                        </svg>
                        <p x-text="address"></p>
                    </div>

                    <div class="flex gap-x-2 items-center" x-show="website_link" x-cloak>
                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M9.83824 18.4467C10.0103 18.7692 10.1826 19.0598 10.3473 19.3173C8.59745 18.9238 7.07906 17.9187 6.02838 16.5383C6.72181 16.1478 7.60995 15.743 8.67766 15.4468C8.98112 16.637 9.40924 17.6423 9.83824 18.4467ZM11.1618 17.7408C10.7891 17.0421 10.4156 16.1695 10.1465 15.1356C10.7258 15.0496 11.3442 15 12.0001 15C12.6559 15 13.2743 15.0496 13.8535 15.1355C13.5844 16.1695 13.2109 17.0421 12.8382 17.7408C12.5394 18.3011 12.2417 18.7484 12 19.0757C11.7583 18.7484 11.4606 18.3011 11.1618 17.7408ZM9.75 12C9.75 12.5841 9.7893 13.1385 9.8586 13.6619C10.5269 13.5594 11.2414 13.5 12.0001 13.5C12.7587 13.5 13.4732 13.5593 14.1414 13.6619C14.2107 13.1384 14.25 12.5841 14.25 12C14.25 11.4159 14.2107 10.8616 14.1414 10.3381C13.4732 10.4406 12.7587 10.5 12.0001 10.5C11.2414 10.5 10.5269 10.4406 9.8586 10.3381C9.7893 10.8615 9.75 11.4159 9.75 12ZM8.38688 10.0288C8.29977 10.6478 8.25 11.3054 8.25 12C8.25 12.6946 8.29977 13.3522 8.38688 13.9712C7.11338 14.3131 6.05882 14.7952 5.24324 15.2591C4.76698 14.2736 4.5 13.168 4.5 12C4.5 10.832 4.76698 9.72644 5.24323 8.74088C6.05872 9.20472 7.1133 9.68686 8.38688 10.0288ZM10.1465 8.86445C10.7258 8.95042 11.3442 9 12.0001 9C12.6559 9 13.2743 8.95043 13.8535 8.86447C13.5844 7.83055 13.2109 6.95793 12.8382 6.2592C12.5394 5.69894 12.2417 5.25156 12 4.92432C11.7583 5.25156 11.4606 5.69894 11.1618 6.25918C10.7891 6.95791 10.4156 7.83053 10.1465 8.86445ZM15.6131 10.0289C15.7002 10.6479 15.75 11.3055 15.75 12C15.75 12.6946 15.7002 13.3521 15.6131 13.9711C16.8866 14.3131 17.9412 14.7952 18.7568 15.2591C19.233 14.2735 19.5 13.1679 19.5 12C19.5 10.8321 19.233 9.72647 18.7568 8.74093C17.9413 9.20477 16.8867 9.6869 15.6131 10.0289ZM17.9716 7.46178C17.2781 7.85231 16.39 8.25705 15.3224 8.55328C15.0189 7.36304 14.5908 6.35769 14.1618 5.55332C13.9897 5.23077 13.8174 4.94025 13.6527 4.6827C15.4026 5.07623 16.921 6.08136 17.9716 7.46178ZM8.67765 8.55325C7.61001 8.25701 6.7219 7.85227 6.02839 7.46173C7.07906 6.08134 8.59745 5.07623 10.3472 4.6827C10.1826 4.94025 10.0103 5.23076 9.83823 5.5533C9.40924 6.35767 8.98112 7.36301 8.67765 8.55325ZM15.3224 15.4467C15.0189 16.637 14.5908 17.6423 14.1618 18.4467C13.9897 18.7692 13.8174 19.0598 13.6527 19.3173C15.4026 18.9238 16.921 17.9186 17.9717 16.5382C17.2782 16.1477 16.3901 15.743 15.3224 15.4467ZM12 21C16.9706 21 21 16.9706 21 12C21 7.02944 16.9706 3 12 3C7.02944 3 3 7.02944 3 12C3 16.9706 7.02944 21 12 21Z"
                                    fill="#ffffff"></path>
                            </g>
                        </svg>
                        <a target="_blank" href="https://{{ $website_link }}" x-text="website_link"></a>
                    </div>

                    <div class="flex gap-x-2 items-center" x-show="portfolio_link" x-cloak>
                        <svg version="1.1" id="Icons" xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" xml:space="preserve"
                            width="20px" height="20px" fill="#000000">
                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                            <g id="SVGRepo_iconCarrier">
                                <style type="text/css">
                                    .st0 {
                                        fill: none;
                                        stroke: #ffffff;
                                        stroke-width: 2;
                                        stroke-linecap: round;
                                        stroke-linejoin: round;
                                        stroke-miterlimit: 10;
                                    }

                                    .st1 {
                                        fill: none;
                                        stroke: #ffffff;
                                        stroke-width: 2;
                                        stroke-linecap: round;
                                        stroke-linejoin: round;
                                    }

                                    .st2 {
                                        fill: none;
                                        stroke: #ffffff;
                                        stroke-width: 2;
                                        stroke-linecap: round;
                                        stroke-linejoin: round;
                                        stroke-dasharray: 5.2066, 0;
                                    }
                                </style>
                                <path class="st0"
                                    d="M26,27H6c-1.1,0-2-0.9-2-2V12c0-1.1,0.9-2,2-2h20c1.1,0,2,0.9,2,2v13C28,26.1,27.1,27,26,27z">
                                </path>
                                <path class="st0"
                                    d="M22.6,18H9.4c-3,0-5.4-2.4-5.4-5.4V12c0-1.1,0.9-2,2-2h20c1.1,0,2,0.9,2,2v0.6C28,15.6,25.6,18,22.6,18z">
                                </path>
                                <line class="st0" x1="10" y1="20" x2="10" y2="18">
                                </line>
                                <line class="st0" x1="22" y1="20" x2="22" y2="18">
                                </line>
                                <path class="st0" d="M9.3,10c0.9-2.9,3.5-5,6.7-5c3.2,0,5.8,2.1,6.7,5"></path>
                            </g>
                        </svg>
                        <a target="_blank" href="https://{{ $portfolio_link }}" x-text="portfolio_link"></a>
                    </div>

                </div>

            </div>

            {{-- education info --}}
            <div class="mb-5" x-show="educations" x-cloak>
                <h1 class="text-xl uppercase tracking-widest font-semibold">Education</h1>
                <hr class="bg-white h-[1.5px] mb-2">
                <div class="space-y-2 font-light text-sm">
                    <template x-for="(edu, index) in educations" :key="index">
                        <li class="mb-2 ml-4">
                            <div class="flex gap-x-1">
                                <p x-text="edu.year_start"></p>
                                <span>-</span>
                                <p x-text="edu.year_end"></p>
                            </div>
                            <p x-text="edu.school"></p>
                            <p x-text="edu.degree"></p>
                        </li>
                    </template>
                </div>
            </div>

            {{-- Skills info --}}
            <div class="mb-5 ">
                <h1 class="text-xl uppercase tracking-widest font-semibold">Soft Skills</h1>
                <hr class="bg-white h-[1.5px] mb-2">
                <div class="space-y-2 font-light text-sm">
                    <template x-for="(soft, index) in soft_skills" :key="index">
                        <li class="mb-2 ml-4">
                            <div class="">
                                <p class="font-semibold" x-text="soft.skill_name"></p>
                                <p x-text="soft.level"></p>
                            </div>
                        </li>
                    </template>
                </div>
            </div>

            <!-- Konten lainnya -->
        </div>
    </div>

</div>
<script>
    formatMonthYear(dateStr) {
        if (!dateStr) return '';
        const [year, month] = dateStr.split('-');
        const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September",
            "Oktober", "November", "Desember"
        ];
        return month ? `${monthNames[parseInt(month)-1]} ${year}` : year;
    }
</script>
