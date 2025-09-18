<?php
/*
Template Name: Videos Page
*/
get_header();

?>
<style>
    .select-menu {
        position: relative;
        display: inline-block;
    }

    .select-menu .options {
        display: none;
        /* hidden by default */
        position: absolute;
        top: 100%;
        right: 0;
        background: #fff;
        border: 1px solid #ddd;
        padding: 5px 0;
        list-style: none;
        margin: 0;
        z-index: 999;
        width: 320px;
    }

    .select-menu.active .options {
        display: block;
        /* show when active */
    }

    .select-menu .option a {
        display: block;
        padding: 0px 12px;
        text-decoration: none;
        color: #333;
        text-align: right;
    }

    .select-menu .option a:hover {
        background: #f2f2f2;
    }

    @media only screen and (max-width : 991px) {
        .w-75 {
            width: 100% !important;
            padding-right: unset;
        }

        .featured-card-wrap {
            display: grid;
            grid-auto-flow: column;
            grid-auto-columns: 290px;
            gap: 25px;
            overflow-x: auto;
            scroll-behavior: smooth;
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        .w-25 {
            width: 100% !important;
        }

        .top-videos {
            border-right: none;
            padding-right: 0;
        }

        .featured-video-div {
            padding-top: 30px;
        }

        .video-wrapper-actor {
            flex-direction: column;
        }

        .left-video-card-div {
            border-right: none;
            padding-right: 0;
            border-bottom: 1px solid #bbb;
            padding-bottom: 10px;
        }

        .right-video-card-div {
            grid-template-columns: repeat(1, 1fr);
            gap: 30px;
        }

        .right-video-card-div .leftvideo-card {
            flex-direction: row-reverse;
        }

        .featured-card-wrap {
            height: auto;
        }
    }
</style>

<section class="Video_top-section">
    <div class="border-bottom">
        <div class="container">
            <div class="title-and filter-wrapper border-bottom-none">
                <div class="row main-wrap">
                    <h1 class="sr-only">Video-variety</h1>
                    <h2 class="videos-title">Video</h2>
                </div>
                <div class="row-wrapper-video">
                    <a href="#" class="popular-text">Popular on Variety</a>
                    <div class="video-filter">
                        <div class="select-menu">
                            <div class="select-btn">
                                <span class="sBtn-text">More </span>
                                <svg width="14" height="15" viewBox="0 0 14 15" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3.5 5.75L7 9.25L10.5 5.75" stroke="#131316" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                            </div>

                            <ul class="options">
                                <?php
                                $terms = get_terms(array(
                                    'taxonomy' => 'vcategory', // replace with your taxonomy name
                                    'hide_empty' => false, // show even empty categories
                                ));

                                if (!empty($terms) && !is_wp_error($terms)) {
                                    foreach ($terms as $term) {
                                        echo '<li class="option"><a href="' . esc_url(get_term_link($term)) . '">' . esc_html($term->name) . '</a></li>';
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container border-bottom">
        <div class="row main-wrap">
            <?php echo do_shortcode('[variety_latest_videos numberposts="5"]'); ?>
        </div>
    </div>

</section>
<!-- Actores on actor Section Start -->
<section class="video-actors-all-section">
    <div class="container">
        <?php echo do_shortcode('[variety_video_parent parent_category="video-2" posts_per_cat="6"]'); ?>
    </div>
</section>
<section class="recommend-section moe-branda-section">
    <div class="container">
        <h2 class="recommed-title">More From Our Brands</h2>
        <div class="recommend-cards-wrapper">
            <?php echo do_shortcode('[brand_recommented_tags tag="Brands" posts="5"]'); ?>
        </div>
    </div>
</section>

<?php

get_footer();
