<?php

/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Variety
 */

get_header();

$paged = max(1, get_query_var('paged'), get_query_var('page'));


//$category_slug = get_queried_object()->slug;
$cat = get_queried_object();
if ($cat && isset($cat->term_id)) {
    // Get full path with slashes
    $category_slug = get_category_parents($cat->term_id, false, '/', true);
    // Remove trailing slash if present
    $category_slug = trim($category_slug, '/');
}

?>
<style>
    /* festival-css-start */
    .festival-box {
        display: flex;
        flex-direction: column;
        gap: 10px;
        text-align: center;
    }

    .festivl-small-title {
        text-decoration: none;
        align-items: center;
    }

    .festival-img img {
        width: 100%;
    }

    /* festival-css-start */
</style>
<?php if (0): ?>
    <main id="primary" class="site-main">

        <?php if (have_posts()): ?>

            <header class="page-header yes-this-the-category-page">
                <?php
                the_archive_title('<h1 class="page-title">', '</h1>');
                the_archive_description('<div class="archive-description">', '</div>');
                ?>
            </header><!-- .page-header -->

        <?php
            /* Start the Loop */
            while (have_posts()):
                the_post();
                
                get_template_part('template-parts/content', get_post_type());

            endwhile;

            the_posts_navigation();

        else:

            get_template_part('template-parts/content', 'none');

        endif;
        ?>

    </main><!-- #main -->
<?php endif; ?>

<!-- latest-news-section-start -->
<section class="latest-news category-listing">



    <?php
    // Hide shortcode on specific categories
    if (is_category()) {
        $cat = get_queried_object();
        if ($cat->parent == 0 ):
    ?>
            <div class="row">
                <?php echo do_shortcode('[variety_tabs_sub_cat]'); ?>

                <?php echo do_shortcode('[variety_tabs_sub_cat_mobile]'); ?>
            </div>
    <?php endif;
    } ?>

    <div class="container p-0">
        <div class="row main-wrap">
            <div class="w-68 col-md-12 col-sm-12">
                <?php if($paged==1) :?>
                <?php if ($cat->parent == 0): ?>
                    <div class="story-description">
                        <div class="artical-wrapper">
                            <div class="row">
                                <div class="row-wrapper">
                                    <?php echo do_shortcode('[top_variety_latest_posts category="' . $category_slug . '" numberposts="5"]'); ?>
                                </div>
                            </div>
                            <div class="home_sign-up-form category-main">
                                <div class="container p-0">
                                    <div class="home_newsletter-bar">
                                        <form id="custom-cfdb121-form">
                                            <div class="home_newsletter-content-form">
                                                <span class="newsletter-text">Sign Up for Variety Newsletters</span>
                                                <div class="home_news-letters-wrap">
                                                    <div class="input-error-wrap"> <input type="email" id="home_new_emails" name="email" class="newsletter-input" placeholder="Enter your email address">
                                                        <div class="respo" id="form-responses"></div>
                                                    </div>
                                                    <input type="hidden" id="home_news" name="news" value="">
                                                    <button type="submit" class="home_newsletter-button"><span id="form-responses">Sign Up</span>
                                                        <i class="fa-solid fa-arrow-right"></i>
                                                    </button>

                                                </div>
                                            </div>
                                        </form>
                                        <p>By providing your information, you agree to our <a href="<?php echo get_permalink(get_page_by_path('terms-and-conditions')); ?>">Terms of Use</a> and our <a href="<?php echo get_permalink(get_page_by_path('privacy-policy')); ?>">Privacy Policy</a>. We use vendors that may also process your information to help provide our services. // This site is protected by reCAPTCHA Enterprise and the  <a href="https://policies.google.com/privacy" target="_blank">Google Privacy Policy</a> and <a href="https://policies.google.com/terms" target="_blank">Terms of Service</a> apply.</p>
                                    </div>
                                </div>
                            </div>
                            <!-- sign-up-section-end -->
                        </div>
                    </div>
                <?php endif; ?>
                <?php endif; ?>
                <!-- sign-up-section-start -->

                <div class="news-wrapper">
                    <div class="news-title">
                        <h2>latest news</h2>
                    </div>

                    <?php echo do_shortcode('[variety_latest_posts posts_per_page="10" category="' . $category_slug . '"]'); ?>

                    <?php if (0): ?>
                    <?php endif; ?>
                </div>
            </div>

            <div class="most-popular w-32 col-md-12 col-sm-12">
                <div class="most-popular-section">
                    <h2>Most Popular</h2>
                    <div class="popular-list">
                        <?php echo do_shortcode("[popular_variety_latest_posts_function numberposts='10']"); ?>
                    </div>
                </div>
                <div class="ads-header mt-3"></div>
                <div class="must-read">
                    <div class="most-popular-section listing">
                        <h2>must Read</h2>

                        <?php 
                        $categories = get_the_category();
                        $category_slug = !empty($categories) ? $categories[0]->slug : '';
                        echo do_shortcode('[Read_Popular_variety_latest_posts_function numberposts="5" category="' . esc_attr($category_slug) . '"]');

                        ?>
                    </div>
                </div>
                <div class="home_sign-up-form right-side-newsform">
                    <div class="container p-0">
                        <div class="home_newsletter-bar">
                            <form id="custom-cfdb5250-form">
                                <div class="home_newsletter-content-form">
                                    <span class="newsletter-text">Sign Up for Variety Newsletters</span>
                                    <div class="home_news-letters-wrap">
                                        <input type="text" id="home_new_emails1" name="email" class="newsletter-input" placeholder="Enter your email address">
                                        <div class="respo" id="form-responses"></div>
                                        <input type="hidden" id="home_news1" name="news" value="">
                                        <button type="submit" class="home_newsletter-button"><span id="form-responses">Sign Up</span>
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </button>

                                    </div>
                                </div>
                            </form>
                            <p>By providing your information, you agree to our <a href="<?php echo get_permalink(get_page_by_path('terms-and-conditions')); ?>">Terms of Use</a> and our <a href="<?php echo get_permalink(get_page_by_path('privacy-policy')); ?>">Privacy Policy</a>. We use vendors that may also process your information to help provide our services. // This site is protected by reCAPTCHA Enterprise and the  <a href="https://policies.google.com/privacy" target="_blank">Google Privacy Policy</a> and <a href="https://policies.google.com/terms" target="_blank">Terms of Service</a> apply.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- latest-news-section-end -->
<!-- More Brands Section Start -->
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
<!-- More Brands Section End -->
<?php
get_footer();
