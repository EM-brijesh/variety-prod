<?php
/*
Template Name: What To Here
*/
get_header();

$paged = max(1, get_query_var('paged'), get_query_var('page'));
?>
<style>
    .container,
    .container-lg,
    .container-md,
    .container-sm,
    .container-xl,
    .container-xxl {
        max-width: 1120px;
    }

    .border-right:nth-last-child(1) {
        border-right: none;
    }

    .film-details .py-5 {
        padding-top: 2rem !important;
    }

    .what-we-hear .podcast .container {
        padding-inline: 0 !important;
    }

    .what-we-hear .partner .container {
        padding-inline: 0 !important;
    }

    section.what-we-hear .audio-books .container,
    section.what-we-hear .banner-section .banner-box .container,
    section.what-we-hear .film-details .container,
    section.what-we-hear .film-details .col-lg-3.col-md-3.border-right {
        padding-inline: 0 !important;
    }

    .film-details .details-box {
        padding-inline: 10px;
    }

    .hear-title-box {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
        padding-block: 20px;
        border-bottom: 1px solid #000;
    }

    .hear-title-box img {
        width: 70px;
    }

    .u-width-80 {
        width: 80px;
    }

    .hear-title-box h2 {
        font-size: 48px;
        color: #000;
        font-family: var(--owner-bold);
        text-transform: uppercase;
    }

    .hear-title-box span {
        font-size: 18px;
        color: #000;
        font-family: var(--owner-medium);
    }

    .banner-cnt {
        max-width: 90%;
    }

    .banner-cnt h2 a {
        font-size: 28px;
        font-family: var(--owner-bold);
        color: #000;
        text-decoration: none;
    }

    .banner-cnt h2 a:hover {
        color: #595959;
    }

    .banner-cnt h2 {
        margin-bottom: 8px;
    }

    .banner-cnt p {
        font-size: 18px;
        font-family: var(--owner-regular);
        color: #000;
        line-height: 22px;
        margin-bottom: 8px;
    }

    .banner-cnt span a {
        font-size: 13px;
        color: #595959;
        text-decoration: none;
        font-family: var(--mono-medium);
    }

    .banner-cnt span a:hover {
        border-bottom: 1px solid #595959;
    }

    .banner-box {
        border-bottom: 1px solid #bbb;
    }

    .border-right {
        border-right: 1px solid #bbb;
    }

    .details-box a {
        text-decoration: none;
    }

    .details-box a h3 {
        font-size: 16px;
        line-height: 20px;
        color: #000;
        font-family: var(--owner-bold);
        padding-top: 10px;
    }

    .details-box a h3:hover {
        color: rgb(89, 89, 89);
    }

    .details-box p {
        font-size: 14px;
        line-height: 18px;
        color: #000;
        font-family: var(--owner-regular);
        padding-top: 6px;
        letter-spacing: 1px;
    }

    .audio-books {}

    .audio-books span {
        font-family: var(--owner-medium);
        font-size: 14px;
        line-height: 18px;
        color: #000;
        text-transform: uppercase;
    }

    .swiper-boxes {
        border-top: 6px solid #000;
        padding-top: 10px;
        border-bottom: 1px solid #000;
    }

    .swiper-boxes h2 {
        font-size: 21px;
        line-height: 25px;
        font-family: var(--owner-bold);
        color: #000;
        margin-bottom: 8px;
    }

    .swiper-boxes p {
        font-size: 16px;
        line-height: 21px;
        color: #000;
        font-family: var(--owner-regular);
        margin-bottom: 20px;
    }

    .audio-slider .details-box span {
        font-size: 13px;
        color: #595959;
        text-decoration: none;
        font-family: var(--mono-medium);
        text-transform: capitalize;
    }

    .audio-slider .details-box p {
        margin-bottom: 5px;
    }

    .swiper-slide.audio-slider {
        border-right: 1px solid #bbb;
        padding-inline: 0 10px;
    }

    /* ----------------------------- */
    .podcast {}

    .podcast-info a {
        text-decoration: none;

    }

    .podcast-info a span:hover {
        border-bottom: 1px solid #3d8247;
    }

    .podcast h2,
    .podcast-sec h2,
    .music-sec h2,
    .album-header h2 {
        font-size: 14px;
        font-weight: bold;
        text-transform: uppercase;
        margin-bottom: 10px;
        border-bottom: 6px solid #000;
        padding-bottom: 5px;
    }

    .podcast h3,
    .podcast-sec h3,
    .music-sec h3,
    .album-header h3 {
        font-size: 21px;
        line-height: 25px;
        font-family: var(--owner-bold);
        color: #000;
    }

    .podcast p.subtext,
    .podcast-sec p.subtext,
    .music-sec p.subtext,
    .album-header p.subtext {
        margin: 5px 0 20px;
        font-size: 16px;
        line-height: 21px;
        font-family: var(--owner-regular);
        color: #000;
    }

    .podcast-card {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        padding: 20px 0;
    }

    .podcast-card:not(:last-child) {
        border-bottom: 1px solid #bbb;
    }

    .podcast .podcast-card:first-child {
        border-top: 1px solid #000;
    }

    .podcast-card img {
        width: 250px;
        height: auto;
        border-radius: 5px;
    }

    .podcast-info {
        flex: 1;
    }

    .category {
        font-size: 13px;
        font-family: var(--owner-medium);
        color: #3d8247;
        text-transform: uppercase;
    }

    .podcast-title {
        font-size: 18px;
        font-family: var(--owner-bold);
        margin: 5px 0;
        color: #000;
        line-height: 20px;
    }

    .podcast .podcast-title {
        font-size: 21px;
        padding-bottom: 5px;
        line-height: 25px;
    }

    .podcast-description {
        font-size: 16px;
        line-height: 21px;
        color: #000;
        font-family: var(--owner-regular);
        line-height: 1.4;
    }

    .partner span {
        font-family: var(--owner-medium);
        font-size: 14px;
        line-height: 18px;
        color: #f47e37;
        text-transform: uppercase;
    }



    /* ------------------- */
    .podcast-news {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 30px;
        /* border-top: 1px solid #000;
    padding-top: 20px; */
    }

    .podcast-news-item {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 30px;
    }

    .podcast-news-item img {
        width: 223px;
        height: 223px;
        object-fit: cover;
        flex-shrink: 0;
    }

    .podcast-news-section .podcast-news-content h3 {
        font-size: 21px;
        line-height: 25px;
        font-family: var(--owner-bold);
        color: #000;
        margin-bottom: 10px;
    }

    .podcast-news-content p {
        font-size: 16px;
        line-height: 21px;
        color: #000;
        font-family: var(--owner-regular);
        margin-bottom: 10px;
    }

    .podcast-news-content a {
        font-size: 13px;
        font-family: var(--owner-medium);
        line-height: 16px;
        text-decoration: none;
        color: #0066cc;
    }

    .podcast-news-content a:hover {
        border-bottom: 1px solid #0066cc;
    }

    .line {
        color: #000;
        width: 43px;
    }

    .brands-wrapper {
        display: flex;
        gap: 20px;
        padding-block: 15px;
    }



    /* ---------------------- */
    .album-header {
        margin-bottom: 20px;
        border-bottom: 1px solid #000;
        padding-bottom: 10px;
    }

    .album-header h4 {
        text-transform: uppercase;
        margin-bottom: 5px;
    }

    .album-header h2 {
        margin-bottom: 8px;
    }

    .album-header p {
        margin: 5px 0 20px;
        font-size: 16px;
        line-height: 21px;
        font-family: var(--owner-regular);
        color: #000;
    }

    /* Flexbox Layout */
    .album-row {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        margin-top: 20px;
    }

    .album-card {
        flex: 1 1 calc(25% - 20px);
        min-width: 250px;
        border-right: 1px solid #ccc;
        padding-right: 15px;
    }

    .album-card:last-child {
        border-right: none;
    }

    .album-card img {
        width: 100%;
        height: 256px;
        object-fit: cover;
        margin-bottom: 12px;
        display: block;
    }

    .album-card h3 {
        font-size: 16px;
        line-height: 20px;
        color: #000;
        font-family: var(--owner-bold);
        padding-top: 10px;
        margin-bottom: 5px;
    }

    .album-meta {
        font-size: 13px;
        color: #595959;
        font-weight: 400;
        text-decoration: none;
        font-family: var(--mono-medium);
        margin-bottom: 8px;
    }

    .album-card p {
        font-size: 16px;
        line-height: 20px;
        color: #000;
        font-family: var(--owner-regular);
        padding-top: 6px;
        letter-spacing: 1px;
    }

    .album-card a {
        font-size: 13px;
        font-weight: bold;
        text-decoration: none;
        color: #0066cc;
    }

    .album-card h3 a:hover {
        color: #595959;
    }

    .album-meta a:hover {
        border-bottom: 1px soild red;
    }

    .album-meta:hover {
        text-decoration: underline;
    }

    .podcast-news-item:nth-child(3) {
        border-bottom: none;
    }

    .podcast-news-item:nth-child(4) {
        border-bottom: none;
    }

    .audio-swiper {
        padding-block: 50px 0;
        height: 421px;
    }

    .swiper-slide.audio-slider:last-child {
        border-right: none;
    }


    /* -------------------- */
    .podcast-news-header {
        border-bottom: 2px solid #000;
        padding-bottom: 8px;
        margin-bottom: 15px;
    }

    .podcast-news-header h4 {
        font-size: 14px;
        font-weight: bold;
        line-height: 18px;
        text-transform: uppercase;
        margin-bottom: 5px;
        padding-bottom: 5px;
    }

    .podcast-news-header h2 {
        font-size: 22px;
        font-family: var(--owner-bold);
        margin-bottom: 5px;
        padding-top: 5px;
        color: #000;
    }

    .podcast-news-header p {
        font-size: 16px;
        margin-bottom: 15px;
        line-height: 21px;
        color: #000;
        font-family: var(--owner-regular);

    }

    /* Layout */
    .podcast-news {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .podcast-news-item {
        display: flex;
        gap: 15px;
        flex: 1 1 calc(50% - 20px);
        border-bottom: 1px solid #ccc;
        padding-bottom: 15px;
    }

    .podcast-news-item img {
        width: 223px;
        height: 223px;
        object-fit: cover;
        flex-shrink: 0;
    }

    .podcast-news-content h3 {
        font-size: 16px;
        font-weight: bold;
        margin-bottom: 8px;
    }

    .podcast-news-content p {
        font-size: 16px;
        line-height: 1.4;
        margin-bottom: 19px;
    }

    .podcast-news-content a {
        font-size: 13px;
        font-weight: bold;
        color: #0066cc;
        text-decoration: none;
        position: relative;
        padding-top: 5px;
    }

    .podcast-news-content a::after {
        content: "";
        top: -26%;
        left: 0%;
        position: absolute;
        background-color: #000;
        width: 45px;
        height: 1px;
    }

    .podcast-card:first-child {
        border-top: 1px solid #000;
    }

    .podcast-title:hover {
        color: #595959;
    }

    .podcast-news-header h4 {
        border-bottom: 5px solid #000;
    }

    .partner-swiper {
        border-bottom: 1px solid #bbb;

    }

    .swiper-button-prev,
    .swiper-button-next {
        top: 10px;
        left: 10px;
        right: auto;
        transform: none;
    }

    .swiper-button-prev,
    .swiper-button-next {
        top: 10px;
        left: 0px;
        right: auto;
        transform: none;
    }

    .swiper-button-next {
        left: 50px;
        /* move next button to the right of prev */
    }

    .swiper-button-prev,
    .swiper-button-next {
        outline: none !important;
        padding: 30px 0;
    }

    .swiper-button-prev:focus,
    .swiper-button-next:focus {
        outline: none !important;
        box-shadow: none !important;
    }

    .swiper-button-next:after,
    .swiper-rtl .swiper-button-prev:after {
        display: none;
    }

    .swiper-button-prev:after,
    .swiper-rtl .swiper-button-next:after {
        display: none;
    }

    .swiper-button-next {
        left: 97%;
        padding: 30px 0;
    }

    .swiper-button-prev img,
    .swiper-button-next img {
        width: 25px;
        height: 25px;
    }

    .listen-btn {
        width: 100%;
        text-align: right;
        position: relative;
        right: 19%;
        bottom: 0px;
    }

    .listen-btn a {
        font-size: 13px;
        line-height: 16px;
        text-decoration: none;
        color: #0066cc;
        font-family: var(--owner-medium);
        border-top: 1px solid #000;
        padding-top: 10px;
    }

    .more-what a {
        font-size: 14px;
        line-height: 18px;
        text-decoration: none;
        color: #000;
        font-family: var(--owner-medium);
        padding-top: 10px;
    }

    .listen-btn a:hover {
        text-decoration: underline;
    }

    .more-what {
        width: 100%;
        text-align: right;
        border-top: 1px solid #000;
        padding-top: 15px;
    }

    .podcast .podcast-card:nth-last-child {
        margin-bottom: 50px;
    }

    .what-to-hear-podcat .podcast-card img {
        width: 300px;
        height: 169px;
        object-fit: cover;
        border-radius: 0;
    }

    .podcast-card:first-child {
        border-top: 1px solid #000;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .album-card {
            flex: 1 1 calc(50% - 20px);
            border-right: none;
            padding-right: 0;
            border-bottom: 1px solid #ccc;
            padding-bottom: 15px;
        }

    }

    @media (max-width: 991px) {
        .hear-title-box h2 {
            font-size: 34px;
        }

        .banner-cnt {
            padding: 10px 0;
        }

        .m-design {
            flex-direction: column-reverse;
        }

        .border-right {
            border-right: none;
        }

        .film-details .details-box img {
            width: 100%;
        }

        .film-details .details-box {
            border-bottom: 1px solid #bbb;
            padding-top: 15px;
        }

        .details-box p {
            margin-bottom: 10px;
        }

        /* .film-details .details-box:last-child{
    border-bottom: none;
} */
        .py-5 {
            padding-bottom: 1rem !important;
        }

        .swiper-button-next {
            left: 90%;
        }

        .what-to-hear-podcat .podcast-card img {
            width: 100%;
            height: auto;
            object-fit: cover;
        }

        .listen-btn {
            right: 0;
            width: auto;
        }

        .podcast .podcast-title {
            font-size: 18px;
        }

        .film-details .details-box {
            padding-inline: 0;
        }
    }

    @media (max-width: 768px) {
        .podcast-news-item {
            flex-direction: column;
            align-items: flex-start;
        }

        .banner-cnt h2 a {
            font-size: 21px;
        }

        .podcast-news-item img {
            width: 100%;
            height: auto;
        }

        .podcast-card {
            flex-direction: column;
            text-align: center;
            width: 100%;
        }

        .podcast-card a {
            width: 100%;
        }

        .podcast-card img {
            margin: auto;
            width: 100%;
            max-width: 100%;
            height: 400px;
            object-fit: cover;
        }

        .podcast-info {
            text-align: left;
        }

        .podcast-news-item {
            flex: 1 1 100%;
            flex-direction: column;
        }

        .podcast-news-item img {
            width: 100%;
            height: auto;
        }

    }

    @media (max-width: 600px) {
        .album-card {
            flex: 1 1 100%;
        }
    }

    @media only screen and (min-width: 1024px) and (max-width: 1366px) and (orientation: portrait) and (-webkit-min-device-pixel-ratio: 1) {

        .banner-cnt h2 a,
        .banner-cnt h2 {
            font-size: 21px !important;
            line-height: 25px;
        }

        .album-row {
            display: grid;
            flex-wrap: wrap;
            gap: 20px;
            margin-top: 20px;
            grid-template-columns: repeat(4, 1fr);
        }
    }

    @media only screen and (min-width: 744px) and (max-width: 1133px) and (orientation: portrait) and (-webkit-min-device-pixel-ratio: 1) {
        .m-design {
            flex-direction: row;
        }

        .what-we-hear .banner-section .banner-cnt {
            width: 100%;
            max-width: 95%;
        }

        .what-we-hear .banner-cnt h2 a,
        .what-we-hear .banner-cnt h2 {
            font-size: 21px;
            line-height: 23px;
        }

        .border-right {
            border-right: 1px solid #bbb;
        }

        .film-details .details-box img {
            height: 130px;
        }

        .film-details .details-box {
            border-bottom: none;
        }

        .podcast-card {
            flex-direction: row;
        }

        .podcast-card a {
            width: auto;
        }

        .podcast-card img {
            width: 200px;
            height: 200px;
            object-fit: cover;
        }

        .podcast-news {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 30px;
        }

        .album .album-row {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
        }

        .album .album-card {
            min-width: 100%;
            border-right: 1px solid #bbb;
            border-bottom: none;
        }

        .album .album-card img {
            height: 150px;
        }

        .film-details .details-box {
            padding-top: 0px;
        }

        .swiper-button-next {
            left: 95%;
        }

        .swiper-button-prev {
            left: -2px !important;
        }

        .podcast .py-5 {
            padding-top: 0rem !important;
        }
    }
</style>


<section class="what-we-hear">
    <div class="container">

        <div class="hear-title-box">
              <h1 class="sr-only">what to watch variety</h1>
            <h2>What to Hear</h2>
            <span>Presented by</span>
            <a href="#" class="u-width-80">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 210.29 79.24">
                    <defs>
                        <style>
                            .cls-1 {
                                fill: #1c1c1a
                            }
                        </style>
                    </defs>
                    <g id="Layer_2" data-name="Layer 2">
                        <g id="OL">
                            <path
                                d="M43.87 12.7A17.79 17.79 0 0 0 48 0a17.68 17.68 0 0 0-11.74 6.06c-2.54 2.93-4.78 7.71-4.2 12.21 4.5.39 9-2.25 11.81-5.57M47.92 19.14c-6.52-.38-12.07 3.71-15.18 3.71s-7.89-3.51-13-3.42a19.25 19.25 0 0 0-16.4 9.94c-7 12.08-1.85 30 5 39.83 3.31 4.87 7.3 10.23 12.55 10 5-.19 6.91-3.21 13-3.21s7.78 3.21 13 3.12C52.3 79 55.71 74.27 59 69.4a43.32 43.32 0 0 0 5.45-11.2c-.1-.1-10.51-4.1-10.61-16.07-.1-10 8.18-14.8 8.57-15.1-4.68-6.91-12-7.69-14.51-7.89M89.46 9.91v13.23h10.64v8.73H89.46V63c0 4.81 2.12 7 6.77 7a34.5 34.5 0 0 0 3.81-.27v8.79a37.31 37.31 0 0 1-6.3.47c-11 0-15.29-4.23-15.29-14.92v-32.2H70.3v-8.73h8.15V9.91ZM137.32 78.59h-11.68L106 23.15h11.62L131.4 67.7h.27l13.78-44.55h11.41ZM188.64 78.59h-10.09V55.87H156.9v-10h21.65V23.15h10.09v22.73h21.65v10h-21.65Z"
                                class="cls-1"></path>
                        </g>
                    </g>
                </svg>
            </a>
        </div>
        <?php if ($paged == 1): ?>

            <?php echo do_shortcode("[what_to_hear_posts]"); ?>




            <div class="audio-books">
                <div class="container py-5">
                    <span>Audiobooks</span>
                    <div class="swiper-boxes">
                        <h2>Variety Recommends</h2>
                        <p>Dive into the audiobooks and podcasts getting Hollywood's attention, for your next vacation or
                            commute.</p>
                    </div>
                    <!-- Swiper -->
                    <div class="swiper audio-swiper">
                        <div class="swiper-wrapper">

                            <?php echo do_shortcode('[audiobooks_recommented_tags tag="Audiobooks" posts="6"]'); ?>

                        </div>
                        <div class="swiper-button-prev"><img
                                src="http://variety.amaruventures.in/wp-content/uploads/2025/09/right-arrow.png" alt=".png">
                        </div>
                        <div class="swiper-button-next"><img
                                src="http://variety.amaruventures.in/wp-content/uploads/2025/09/arrow-img.png" alt=".png">
                        </div>
                    </div>

                    <!-- Swiper JS -->
                </div>
            </div>
            <!------------>
            <div class="partner">
                <div class="container pb-4">
                    <span>Partner Content</span>
                    <div class="swiper-boxes">
                        <h2>Variety Recommends</h2>
                        <p>Dive into the audiobooks and podcasts getting Hollywood's attention, for your next vacation or
                            commute.</p>
                    </div>
                    <!-- Swiper -->
                    <div class="swiper audio-swiper partner-swiper">
                        <div class="swiper-wrapper">

                            <?php echo do_shortcode('[audiobooks_recommented_tags tag="Partner Content" posts="6"]'); ?>

                        </div>
                        <div class="swiper-button-prev"><img
                                src="data:image/svg+xml;charset=US-ASCII,%3Csvg%20width%3D%2718%27%20height%3D%2718%27%20xmlns%3D%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27%3E%3Cg%20transform%3D%27rotate%28-180%209%209%29%27%20fill%3D%27none%27%20fill-rule%3D%27evenodd%27%3E%3Crect%20width%3D%2718%27%20height%3D%2718%27%20rx%3D%272%27%2F%3E%3Cg%20stroke%3D%27%23000%27%20stroke-width%3D%271.5%27%3E%3Cpath%20d%3D%27M15%209H3%27%2F%3E%3Cpath%20stroke-linejoin%3D%27round%27%20d%3D%27M12%205l3%204-3%204%27%2F%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E"
                                alt=".prev">
                        </div>
                        <div class="swiper-button-next"><img
                                src="data:image/svg+xml;charset=US-ASCII,%3Csvg%20width%3D%2718%27%20height%3D%2718%27%20xmlns%3D%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27%3E%3Cg%20fill%3D%27none%27%20fill-rule%3D%27evenodd%27%3E%3Crect%20width%3D%2718%27%20height%3D%2718%27%20rx%3D%272%27%2F%3E%3Cg%20stroke%3D%27%23000%27%20stroke-width%3D%271.5%27%3E%3Cpath%20d%3D%27M15%209H3%27%2F%3E%3Cpath%20stroke-linejoin%3D%27round%27%20d%3D%27M12%205l3%204-3%204%27%2F%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E"
                                alt=".next">
                        </div>

                    </div>

                    <!-- Swiper JS -->
                </div>
            </div>
            <!--------------------------->
        <div class="podcast">
            <div class="container">
                <h2>PODCASTS</h2>
                <h3>Trending</h3>
                <p class="subtext">From daily news to true crime, find the next can't-miss podcasts that everyone is
                    talking
                    about and are sure to get you hooked.</p>
                <div class="podcast-line-wrapper">
                <?php echo do_shortcode('[trending_recommented_tags tag="Trending" posts="6"]'); ?>
                </div>
            </div>
        </div>

        <!--------------------->

        <!-- --------------------- -->

            <div class="podcast-news-section">
                <div class="container pad-inline py-5">
                    <div class="podcast-news-header">
                        <h4>PODCASTS</h4>
                        <h2>Variety Produced</h2>
                        <p>Keep it in the family with our suite of Variety produced podcasts covering everything from
                            awards, Broadway and business.</p>
                    </div>

                    <div class="podcast-news">
                        <!-- Item 1 -->
                        <?php echo do_shortcode('[what_to_here_podcasts_category  posts="4"]'); ?>
                    </div>
                </div>
            </div>

            <!-- -------------------- -->
            <div class="album">
                <div class="container py-5 pad-inline">
                    <div class="album-header">
                        <h2>MUSIC</h2>
                        <h3>Album Reviews</h3>
                        <p class="subtext">Who doesn’t love new music? Our critics pick the best new albums of the moment.
                        </p>
                    </div>

                    <div class="album-row">
                        <?php echo do_shortcode('[what_to_here_music_category  posts="4"]'); ?>

                        <div class="listen-btn">
                            <a href="#">LISTEN</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- --------------------- -->

            <!--------------------------->
        <div class="podcast what-to-hear-podcat">
            <div class="container py-5 pad-inline">
                <h2></h2>
                <h3 class="pb-3">More What To Hear News</h3>
                <?php echo do_shortcode("[whattohear_news posts_per_page='10']"); ?>
            </div>
        </div>
        <!--------------------->

        <div class="our-brand d-none">
            <div class="container py-5 pad-inline">
                <div class="row">
                    <h3>More From Our Brands</h3>
                    <div href="#" class="brands-wrapper">
                        <?php echo do_shortcode('[brand_recommented_tags tag="Brands" posts="5"]');
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <section class="recommend-section moe-branda-section">
            <h2 class="recommed-title">More From Our Brands</h2>
            <div class="recommend-cards-wrapper">
                <?php echo do_shortcode('[brand_recommented_tags tag="Brands" posts="5"]'); ?>
            </div>
        </section>
    </div>
    <?php endif; ?>

    </div>
    </div>
</section>


<?php if ($paged >= 2): ?>
<!--------------------------->
<div class="podcast what-to-hear-podcat hear-details-page">
    <div class="container py-5">

        <h2></h2>
        <h3 class="pb-3">What To Hear News</h3>
        <?php //echo do_shortcode('[whattohear_news count="10"]'); 
            ?>
        <?php echo do_shortcode("[whattohear_news posts_per_page='10']"); ?>


    </div>
</div>
 <section class="recommend-section moe-branda-section">
    <div class="container">
            <h2 class="recommed-title">More From Our Brands</h2>
            <div class="recommend-cards-wrapper">
                <?php echo do_shortcode('[brand_recommented_tags tag="Brands" posts="5"]'); ?>
            </div>
             <h3 class="sr-only">varietyindia</h3>
        <h4 class="sr-only">variety india</h4>
            </div>
        </section>
<?php endif; ?>
<!--------------------->
<script>

</script>

<?php

get_footer();
