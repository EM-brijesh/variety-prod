<?php
get_header();

if (empty($atts['taxonomy']) || empty($atts['term'])) {
    $term = get_queried_object();
    if ($term && ! is_wp_error($term)) {
        $atts['taxonomy'] = $term->taxonomy;
        $atts['term']     = $term->slug;
    }
}
$term_obj = get_term_by('slug', $atts['term'], $atts['taxonomy']);


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
        padding: 1px 5px;
        text-decoration: none;
        color: #000;
        font-size: 18px;
        font-family: var(--owner-regular);
        text-align: right;
    }
</style>
<section class="video_top-section category-video-section">
    <div class="container">
        <div class="title-and filter-wrapper">

            <div class="row-wrapper-video position-relative">
                <a href="#" class="popular-text">
                    <?php if ($term_obj && ! is_wp_error($term_obj)) {
                        echo $term_obj->name;
                    } ?>
                </a>
                <div class="row main-wrap">
                    <h2 class="videos-title">Video</h2>
                </div>
                <div class="video-filter">
                    <div class="select-menu">
                        <div class="select-btn">
                            <span class="sBtn-text">More Playlists</span>
                            <svg width="14" height="15" viewBox="0 0 14 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.5 5.75L7 9.25L10.5 5.75" stroke="#131316" stroke-linecap="round" stroke-linejoin="round"></path>
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
</section>

<!-- Video Category News Start -->

<section class="videocategory-news-section">
    <div class="container">
        <div class="video3category_columnlayout border-bottom">
            <?php echo do_shortcode('[variety_videos_taxo_cat taxonomy="vcategory" term="' . $atts['term'] . '" posts="6"]'); ?>
        </div>
    </div>
    </div>
</section>

<!-- Video Category News End -->
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
