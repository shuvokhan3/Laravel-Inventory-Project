<!-- Hero section -->
<section
    id="home"
    class="relative overflow-hidden bg-primary text-primary-color pt-[120px] md:pt-[130px] lg:pt-[160px]"
>
    <div class="container">
        <div class="-mx-5 flex flex-wrap items-center">
            <div class="w-full px-5">
                <div class="scroll-revealed mx-auto max-w-[780px] text-center">
                    <h1
                        class="mb-6 text-3xl font-bold leading-snug text-primary-color sm:text-4xl sm:leading-snug lg:text-5xl lg:leading-tight"
                    >
                        Smart Point of Sale System for Modern Businesses
                    </h1>

                    <p
                        class="mx-auto mb-9 max-w-[600px] text-base text-primary-color sm:text-lg sm:leading-normal"
                    >
                        Simplify your sales, track inventory, and grow your business with our easy-to-use Point of Sale application. Manage sales, customers, and reports—all in one place.
                    </p>

                    <ul
                        class="mb-10 flex flex-wrap items-center justify-center gap-4 md:gap-5"
                    >
                        <li>
                            <a
                                href="{{asset('/dashboard')}}"
                                class="inline-flex items-center justify-center rounded-md bg-primary-color text-primary px-5 py-3 text-center text-base font-medium shadow-md hover:bg-primary-light-5 md:px-7 md:py-[14px]"
                                role="button"
                            >Get Started</a
                            >
                        </li>

                        <li>
                            <a
                                href="javascript:boid(0)"
                                class="video-popup flex items-center gap-4 rounded-md bg-primary-color/[0.15] px-5 py-3 text-base font-medium text-primary-color hover:bg-primary-color hover:text-primary md:px-7 md:py-[14px]"
                                role="button"
                            ><i class="lni lni-play text-lg/none"></i> View Demo</a
                            >
                        </li>
                    </ul>

                    <div>
                        <p class="mb-4 text-center text-primary-color">Trusted by retail stores, cafes, and businesses worldwide</p>

                        <div
                            class="scroll-revealed flex items-center justify-center gap-4 text-center"
                        >
{{--                            <a--}}
{{--                                href="https://laravel.com/"--}}
{{--                                target="_blank"--}}
{{--                                class="text-primary-color/60 hover:text-primary-color"--}}
{{--                            >--}}
{{--                                <svg--}}
{{--                                    xmlns="http://www.w3.org/2000/svg"--}}
{{--                                    viewBox="0 0 256 221"--}}
{{--                                    height="26"--}}
{{--                                    class="fill-current"--}}
{{--                                >--}}
{{--                                    --}}
{{--                                    <path d="M40.87 2.02 0 25.12v56.95l40.87 23.1 40.87-23.1V25.12L40.87 2.02Zm0 93.3L17.3 78.5V52.7L40.88 39l23.57 13.7v25.8l-23.57 13.8ZM126.1 2 85.2 25.1v56.95l40.9 23.1 40.9-23.1V25.1L126.1 2Zm0 93.3-23.6-13.8v-25.8l23.6-13.7 23.6 13.7v25.8l-23.6 13.8ZM211.3 2l-40.9 23.1v56.95l40.9 23.1 40.9-23.1V25.1L211.3 2Zm0 93.3-23.6-13.8v-25.8l23.6-13.7 23.6 13.7v25.8l-23.6 13.8ZM63.75 132.5 22.9 155.6v56.9l40.85 23.1 40.87-23.1v-56.9L63.75 132.5Zm0 93.3L40.2 212v-25.8l23.56-13.7 23.57 13.7V212l-23.6 13.8ZM148.9 132.5l-40.87 23.1v56.9l40.87 23.1 40.9-23.1v-56.9l-40.9-23.1Zm0 93.3-23.6-13.8V186l23.6-13.7 23.6 13.7v25.8l-23.6 13.8Z" />--}}
{{--                                </svg>--}}
{{--                            </a>--}}


                        </div>
                    </div>
                </div>
            </div>
            <div class="w-full px-5">
                <div class="scroll-revealed relative z-10 mx-auto max-w-[845px]">
                    <figure class="mt-16">
                        <img
                            src="{{asset('images/img/hero.png')}}"
                            alt="Hero image"
                            class="mx-auto max-w-full rounded-t-xl rounded-tr-xl"
                        />
                    </figure>

                    <div class="absolute -left-9 bottom-0 z-[-1]">
                        <img
                            src="{{asset('images/img/dots.svg')}}"
                            alt
                            class="w-[120px] opacity-75"
                        />
                    </div>

                    <div class="absolute -right-6 -top-6 z-[-1]">
                        <img
                            src="{{asset('images/img/dots.svg')}}"
                            alt
                            class="w-[120px] opacity-75"
                        />
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
