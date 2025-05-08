<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Meta Tags -->
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="Copyright" content="Inazuma" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Ranyeh" />
    <meta name="rating" content="general" />
    <meta name="language" content="English" />
    <meta name="application-name" content="Inazuma" />
    <meta
        name="description"
        content="Tailwind CSS Company Landing Page Template by Ranyeh."
    />
    <meta name="keywords" content="company" />
    <meta
        name="twitter:title"
        content="Inazuma | Tailwind CSS Company Landing Page"
    />
    <meta
        name="twitter:description"
        content="Tailwind CSS Company Landing Page Template by Ranyeh."
    />
    <meta name="twitter:image" content="./assets/img/inazuma-cover.png" />
    <meta
        content="Inazuma | Tailwind CSS Company Landing Page"
        property="og:title"
    />
    <meta content="Inazuma" property="og:site_name" />
    <meta
        content="Tailwind CSS Company Landing Page Template by Ranyeh."
        property="og:description"
    />
    <meta content="./assets/img/inazuma-cover.png" property="og:image" />
    <meta content="https://ranyeh24.github.io/inazuma-tailwind" property="og:url" />
    <meta content="website" property="og:type" />

    <meta name="msapplication-TileColor" content="#3d63dd" />
    <meta
        name="msapplication-TileImage"
        content="{{asset('images/favicon/mstile-144x144.png')}}"
    />
    <meta name="theme-color" content="#3d63dd" />

    <!-- Page title -->
    <title>Point Of Sale Application </title>

    <!-- Canonical -->
    <link rel="canonical" href="https://ranyeh24.github.io/inazuma-tailwind" />

    <!-- Favicon -->
    <link
        rel="apple-touch-icon"
        sizes="180x180"
        href="{{asset('images/favicon/apple-touch-icon.png')}}"
    />
    <link
        rel="icon"
        type="image/png"
        sizes="32x32"
        href="{{asset('images/favicon/favicon-32x32.png')}}"
    />
    <link
        rel="icon"
        type="image/png"
        sizes="194x194"
        href="{{asset('images/favicon/favicon-194x194.png')}}"
    />
    <link
        rel="icon"
        type="image/png"
        sizes="192x192"
        href="{{asset('images/favicon/android-chrome-192x192.png')}}"
    />
    <link
        rel="icon"
        type="image/png"
        sizes="16x16"
        href="{{asset('images/favicon/favicon-16x16.png')}}"
    />
    <link rel="manifest" href="{{asset('images/favicon/site.webmanifest.json')}}" />
    <link
        rel="mask-icon"
        href="{{asset('images/favicon/safari-pinned-tab.svg')}}"
        color="#3d63dd"
    />

    <!-- CSS Plugins -->
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
    />
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css"
    />
    <link rel="stylesheet" href="https://cdn.lineicons.com/4.0/lineicons.css" />

    <link rel="stylesheet" href="{{asset('css/main.css')}}" />
</head>

<body>

<!-- Page loading -->
<div
    class="page-loading fixed top-0 bottom-0 left-0 right-0 z-[99999] flex items-center justify-center bg-primary-light-1 dark:bg-primary-dark-1 opacity-100 visible pointer-events-auto"
    role="status"
    aria-live="polite"
    aria-atomic="true"
    aria-label="Loading..."
>
    <div class="grid-loader">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>


<div>
    @yield('content')
</div>


<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/mcstudios/glightbox/dist/js/glightbox.min.js"></script>
<script src="https://unpkg.com/scrollreveal@4.0.0/dist/scrollreveal.min.js"></script>

<script src="{{asset('js/main.js')}}"></script>
<script>
    // Scroll Reveal
    const sr = ScrollReveal({
        origin: "bottom",
        distance: "16px",
        duration: 1000,
        reset: false,
    });

    sr.reveal(`.scroll-revealed`, {
        cleanup: true,
    });

    // GLightBox
    GLightbox({
        selector: ".video-popup",
        href: "https://www.youtube.com/watch?v=r44RKWyfcFw&fbclid=IwAR21beSJORalzmzokxDRcGfkZA1AtRTE__l5N4r09HcGS5Y6vOluyouM9EM",
        type: "video",
        source: "youtube",
        width: 900,
        autoplayVideos: true,
    });

    const myGallery3 = GLightbox({
        selector: ".portfolio-box",
        type: "image",
        width: 900,
    });

    // Testimonial
    const testimonialSwiper = new Swiper(".testimonial-carousel", {
        slidesPerView: 1,
        spaceBetween: 30,

        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },

        breakpoints: {
            640: {
                slidesPerView: 2,
                spaceBetween: 30,
            },
            1024: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
            1280: {
                slidesPerView: 3,
                spaceBetween: 30,
            },
        },
    });
</script>
</body>

</html>


