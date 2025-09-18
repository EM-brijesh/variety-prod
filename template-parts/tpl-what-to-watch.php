<?php
/*
Template Name: What To Watch
*/
global $wp_query;
$pageId = $wp_query->post->ID;
$whatwewatchmetadatarecommends = get_post_meta($pageId, "whatwewatchmetadatarecommends", true);
$whatwewatchmetadatastreamingideas = get_post_meta($pageId, "whatwewatchmetadatastreamingideas", true);
$whatwewatchmetadatabrowsestreameramazonprime = get_post_meta($pageId, "whatwewatchmetadatabrowsestreameramazonprime", true);
get_header();

?>
<style>
    section.what-we-watch .title-box {
        box-shadow: none;
        padding: 0;
    }

    section.what-we-watch .blog-movie-slider,
    section.what-we-watch .blog-series-slider {
        margin-top: 24px;
        border-top: 6px solid #000;
        padding-block: 15px;
        box-shadow: none;
    }

    .blog-movie-slider h2,
    .blog-series-slider h2,
    .variety-wrap h2 {
        font-size: 21px;
        color: #000;
        font-family: var(--owner-bold);
        text-transform: capitalize;
        margin-bottom: 4px;
    }

    section.what-we-watch .blog-movie-slider,
    section.what-we-watch .blog-series-slider {
        margin-top: 24px;
        border-top: 6px solid #000;
        padding-block: 15px;
        box-shadow: none;
        padding: 0;
        padding-top: 10px;
    }

    .blog-movie-slider p,
    .blog-series-slider p,
    .title-box p,
    .variety-wrap p {
        font-size: 16px;
        color: #000;
        font-family: var(--owner-regular);
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
        border-top: 1px solid #000;
        padding: 20px 0;
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
        height: 500px;
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
        font-size: 14px;
        line-height: 1.4;
        margin-bottom: 10px;
    }

    .podcast-news-content a {
        font-size: 13px;
        font-weight: bold;
        color: #0066cc;
        text-decoration: none;
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
        border-bottom: 1px solid #000;
    }

    .swiper-button-prev,
    .swiper-button-next {
        top: 10px;
        left: 10px;
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
        left: 96%;
        padding: 30px 0;
    }

    .swiper-button-prev img,
    .swiper-button-next img {
        width: 25px;
        height: 25px;
    }

    .slide-cnt .music-wrap p {
        font-size: 13px;
        line-height: 29px;
        color: #0066cc;
        font-family: var(--owner-bold);
        padding: 0;
        margin: 0;
    }

    .slide-cnt .music-wrap i {
        font-size: 20px;
        color: #0066cc;
    }

    .slide-cnt h5:hover a,
    .slide-cnt p:hover a,
    .slide-cnt h5 a:hover,
    .slide-cnt p a:hover {
        color: #0066cc;
        transition: 0.5s;
    }

    .what-we-watch .movie-box-wrap {
        padding: 5px;
        box-shadow: none;
    }

    .what-we-watch .watch-slide:not(:last-child) {
        border-right: 1px solid #bbb;
        padding-inline: 0 10px;
    }

    /* 
    .what-we-watch .swiper-slide.watch-slide {
        border-right: 1px solid #bbb;
        padding-inline: 0 10px;
    } */

    .what-we-watch-slider {
        height: 100%;
        padding-bottom: 30px;
    }

    .what-we-watch-slider:last-child {
        border-bottom: none;
    }

    .what-we-watch .title-box h2 {
        text-transform: capitalize;
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
            padding-block: 15px;
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

        .title-box h2 {
            font-size: 34px;
            font-weight: 500;
        }

        .what-we-watch .banner-box .row {
            flex-direction: column-reverse;
        }
    }

    @media (max-width: 767px) {
        .podcast-news-item {
            flex-direction: column;
            align-items: flex-start;
        }

        .what-we-watch .watch-slide:not(:last-child) {
            padding-inline: 0 20px;
        }

        .top-5news-what-we-watch .banner-box {
            padding-block: 10px;
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
    }
</style>
<section class="what-we-watch">
    <div class="container">
        <div class="title-box">
            <h1 class="sr-only">what to watch variety</h1>
            <h2>What To Watch</h2>
        </div>

        <div class="partner border-bottom">
            <div class="swiper-boxes">
                <h2>Variety Recommends</h2>
                <h3 class="sr-only">Recomnded</h3>
                <h4 class="sr-only">Recomnded variety</h4>
                <p>Catch up on the best titles coming to streaming.</p>
            </div>
            <!-- Swiper -->
            <div class="swiper what-we-watch-slider audio-swiper partner-swiper">
                <div class="swiper-wrapper">

                    <?php //echo do_shortcode('[audiobooks_recommented_tags tag="Partner Content" posts="6"]'); ?>
                    <?php foreach ($whatwewatchmetadatarecommends as $recommend):
                        $post = url_to_postid($recommend["what-we-watch-meta-data-recommends-post-link"]);
                        $featimg = wp_get_attachment_url(get_post_thumbnail_id($post));
                        $title = get_the_title($post);
                        $permalink = get_the_permalink($post);
                        ?>
                        <div class="swiper-slide watch-slide">
                            <div class="movie-box-wrap">
                                <div class="slide-img">
                                    <img src="<?php echo $featimg; ?>" alt=".jpg" class="img-fluid">
                                </div>
                                <a href="<?php echo $permalink; ?>" class="slide-cnt">
                                    <h5> <?php echo $title; ?> </h5>
                                    <div class="music-wrap">
                                        <p>WATCH</p>
                                        <i class="fa-regular fa-circle-play"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>

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
        <div class="top-5news-what-we-watch">
            <div class="banner-box">
                <div class="row">
                    <div class="col-lg-6 col-md-6 p-0">
                        <div class="banner-cnt">
                            <span class="what-we-cat">Streaming Ideas</span>
                            <?php
                            $streamPostId = url_to_postid($whatwewatchmetadatastreamingideas[0]["what-we-watch-meta-data-streaming-ideas-post-link"]);
                            $title = get_the_title($streamPostId);
                            $excerpt = get_the_excerpt($streamPostId);
                            $featimg = wp_get_attachment_url(get_post_thumbnail_id($streamPostId));
                            $author_id = get_post_field('post_author', $post_id);
                            $author_display_name = get_the_author_meta('display_name', $author_id);
                            $permalink = get_the_permalink($streamPostId);
                            ?>
                            <h2> <a href="<?php echo $permalink; ?>"><?php echo $title; ?></a>
                            </h2>
                            <?php echo $excerpt; ?>
                            <span><a href="#">By <?php echo $author_display_name; ?></a></span>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 p-0">
                        <a href="<?php echo $permalink; ?>" class="banner-img">
                            <img src="<?php echo $featimg; ?>" alt=".webp" class="img-fluid">
                        </a>
                    </div>
                </div>
            </div>

            <div class="film-details">
                <div class="row">
                    <?php for ($i = 1; $i < sizeof($whatwewatchmetadatastreamingideas); $i++) {
                        $streamPostId = url_to_postid($whatwewatchmetadatastreamingideas[$i]["what-we-watch-meta-data-streaming-ideas-post-link"]);
                        $title = get_the_title($streamPostId);
                        $excerpt = substr(get_the_excerpt($streamPostId), 0, 100);
                        $featimg = wp_get_attachment_url(get_post_thumbnail_id($streamPostId));
                        $permalink = get_the_permalink($streamPostId);
                        ?>

                        <div class="col-lg-3 col-md-3 border-right">
                            <div class="details-box">
                                <a href="<?php echo $permalink; ?>">
                                    <img src="<?php echo $featimg; ?>" alt=".webp" class="img-fluid">
                                    <h3><?php echo $title; ?></h3>
                                </a>
                                <?php echo $excerpt; ?>
                            </div>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>

        <div class="partner">
            <div class="swiper-boxes">
                <h2>Browse By Streamer</h2>
                <p class="pb-3">Variety’s curated list of critic’s picks, must see movies and the most
                    binge-worthy TV series on your favorite streamers.</p>
            </div>
            <div class="swiper-boxes">
                <h2 class="pb-3">Amazon Prime Video</h2>
            </div>
            <!-- Swiper -->
            <div class="swiper what-we-watch-slider audio-swiper partner-swiper">
                <div class="swiper-wrapper">

                    <?php //echo do_shortcode('[audiobooks_recommented_tags tag="Partner Content" posts="6"]'); 
                    ?>
                    <?php foreach ($whatwewatchmetadatabrowsestreameramazonprime as $prime):
                        $post = url_to_postid($prime["what-we-watch-meta-data-browse-streamer-amazon-prime-post"]);
                        $watchlink = $prime["what-we-watch-meta-data-browse-streamer-amazone-prime-post-watch-link"];
                        $featimg = wp_get_attachment_url(get_post_thumbnail_id($post));
                        $title = get_the_title($post);
                        $permalink = get_the_permalink($post);
                        ?>
                        <div class="swiper-slide watch-slide">
                            <div class="movie-box-wrap">
                                <div class="slide-img">
                                    <img src="<?php echo $featimg; ?>" alt=".jpg" class="img-fluid">
                                </div>
                                <a href="<?php echo $permalink; ?>" class="slide-cnt">
                                    <h3> <?php echo $title; ?> </h3>
                                    <div class="music-wrap">
                                        <p>WATCH</p>
                                        <i class="fa-regular fa-circle-play"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                    <!-- <div class="swiper-slide watch-slide">
                        <div class="movie-box-wrap">
                            <div class="slide-img">
                                <img src="http://variety.amaruventures.in/wp-content/uploads/2025/06/margot-robbie.jpg"
                                    alt=".jpg" class="img-fluid">
                            </div>
                            <a href="#" class="slide-cnt">
                                <h5> The 10 Best Movies Based on Real Life </h5>
                                <div class="music-wrap">
                                    <p>WATCH</p>
                                    <i class="fa-regular fa-circle-play"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide watch-slide">
                        <div class="movie-box-wrap">
                            <div class="slide-img">
                                <img src="http://variety.amaruventures.in/wp-content/uploads/2025/06/margot-robbie.jpg"
                                    alt=".jpg" class="img-fluid">
                            </div>
                            <a href="#" class="slide-cnt">
                                <h5> The 10 Best Movies Based on Real Life </h5>
                                <div class="music-wrap">
                                    <p>WATCH</p>
                                    <i class="fa-regular fa-circle-play"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide watch-slide">
                        <div class="movie-box-wrap">
                            <div class="slide-img">
                                <img src="http://variety.amaruventures.in/wp-content/uploads/2025/06/margot-robbie.jpg"
                                    alt=".jpg" class="img-fluid">
                            </div>
                            <a href="#" class="slide-cnt">
                                <h5> The 10 Best Movies Based on Real Life </h5>
                                <div class="music-wrap">
                                    <p>WATCH</p>
                                    <i class="fa-regular fa-circle-play"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide watch-slide">
                        <div class="movie-box-wrap">
                            <div class="slide-img">
                                <img src="http://variety.amaruventures.in/wp-content/uploads/2025/06/margot-robbie.jpg"
                                    alt=".jpg" class="img-fluid">
                            </div>
                            <a href="#" class="slide-cnt">
                                <h5> The 10 Best Movies Based on Real Life </h5>
                                <div class="music-wrap">
                                    <p>WATCH</p>
                                    <i class="fa-regular fa-circle-play"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide watch-slide">
                        <div class="movie-box-wrap">
                            <div class="slide-img">
                                <img src="http://variety.amaruventures.in/wp-content/uploads/2025/06/margot-robbie.jpg"
                                    alt=".jpg" class="img-fluid">
                            </div>
                            <a href="#" class="slide-cnt">
                                <h5> The 10 Best Movies Based on Real Life </h5>
                                <div class="music-wrap">
                                    <p>WATCH</p>
                                    <i class="fa-regular fa-circle-play"></i>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="swiper-slide watch-slide">
                        <div class="movie-box-wrap">
                            <div class="slide-img">
                                <img src="http://variety.amaruventures.in/wp-content/uploads/2025/06/margot-robbie.jpg"
                                    alt=".jpg" class="img-fluid">
                            </div>
                            <a href="#" class="slide-cnt">
                                <h5> The 10 Best Movies Based on Real Life </h5>
                                <div class="music-wrap">
                                    <p>WATCH</p>
                                    <i class="fa-regular fa-circle-play"></i>
                                </div>
                            </a>
                        </div>
                    </div> -->
                </div>
                <div class="swiper-button-prev"><img
                        src="http://variety.amaruventures.in/wp-content/uploads/2025/09/right-arrow.png" alt=".png">
                </div>
                <div class="swiper-button-next"><img
                        src="http://variety.amaruventures.in/wp-content/uploads/2025/09/arrow-img.png" alt=".png">
                </div>

                <!-- Swiper JS -->
            </div>
        </div>

    </div>
</section>
<section class="recommend-section moe-branda-section">
    <div class="container">
        <h2 class="recommed-title">More From Our Brands</h2>
        <div class="recommend-cards-wrapper">
            <?php echo do_shortcode('[brand_recommented_tags tag="Brands" posts="5"]'); ?>
        </div>
         <h3 class="sr-only">varietyindia</h3>
        <h4 class="sr-only">variety india</h4>
</section>

<?php

get_footer();
