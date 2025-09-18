<?php
/*
 * Template Name: Home
 */
get_header('header');

$paged = max(1, get_query_var('paged'), get_query_var('page'));

?>


<?php if ($paged == 1): ?>
    <section class="top4-news-section">
        <div class="container">
            <div class="top4news-wrapper">
                <div class="top4news">
                    <div class="top4-arrow-icon">
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                    <div class="top4-cnt">
                        <h2 class="top4title"><a href="#">Venice Daily Edition, Day 5</a></h2>
                        <p>'Smashing' star Dwayne Johnson shows his dramatic side</p>
                    </div>
                </div>
                <div class="top4news">
                    <div class="top4-arrow-icon">
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                    <div class="top4-cnt">
                        <h2 class="top4title"><a href="#">Venice Daily Edition, Day 5</a></h2>
                        <p>'Smashing' star Dwayne Johnson shows his dramatic side</p>
                    </div>
                </div>
                <div class="top4news">
                    <div class="top4-arrow-icon">
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                    <div class="top4-cnt">
                        <h2 class="top4title"><a href="#">Venice Daily Edition, Day 5</a></h2>
                        <p>'Smashing' star Dwayne Johnson shows his dramatic side</p>
                    </div>
                </div>
                <div class="top4news">
                    <div class="top4-arrow-icon">
                        <i class="fa-solid fa-arrow-right"></i>
                    </div>
                    <div class="top4-cnt">
                        <h2 class="top4title"><a href="#">Venice Daily Edition, Day 5</a></h2>
                        <p>'Smashing' star Dwayne Johnson shows his dramatic side</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- top-story-section-start -->

    <section class="top-story">
        <div class="container">
            <div class="row main-wrap">

                <div class="story-description w-68 col-md-12 col-sm-12">
                    <div class="artical-wrapper">
                        <div class="row">
                            <div class="row-wrapper">
                                <?php echo do_shortcode("[top_variety_latest_posts numberposts='6']"); ?>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="most-popular w-32 col-md-12 col-sm-12">
                    <div class="ads-header"></div>
                    <div class="most-popular-section">
                        <h2>Most Popular</h2>
                        <div class="popular-list">
                            <?php echo do_shortcode("[popular_variety_latest_posts_function numberposts='15']"); ?>
                        </div>
                    </div>
                    <div class="ads-header mt-3"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- top-story-section-end -->


    <!-- sign-up-section-start -->
    <section class="home_sign-up d-none">
        <div class="container p-0">
            <div class="home_newsletter-bar">
                <form id="custom-cfdb10-form">
                    <div class="home_newsletter-content">
                        <span class="newsletter-text">Sign Up for Variety Newsletters</span>
                        <a href="#">Learn More <i class="fa-solid fa-arrow-right"></i></a>
                    </div>
                </form>

            </div>
        </div>
    </section>
    <!-- sign-up-section-end -->

    <!-- Recommend Section Start -->
    <section class="recommend-section">
        <div class="container">
            <h2 class="recommed-title">Recommended For You</h2>
            <div class="recommend-cards-wrapper">
                <?php echo do_shortcode('[recommended_tags_post tag="Latest Post" posts="6"]'); ?>
            </div>
        </div>
    </section>
    <!-- Recommend Section End -->
    <!-- sign-up-section-start -->
    <section class="home_sign-up-form">
        <div class="container p-0">
            <div class="home_newsletter-bar">
                <form id="custom-cfdb121-form">
                    <div class="home_newsletter-content-form">
                        <span class="newsletter-text">Sign Up for Variety Newsletters</span>
                        <div class="home_news-letters-wrap">
                            <div class="input-error-wrap">
                                <input type="email" id="home_new_emails" name="email" class="newsletter-input"
                                    placeholder="Enter your email address">
                                <div id="form-responses" class="respo"></div>
                            </div>
                            <input type="hidden" id="home_news" name="news" value="">
                            <button type="submit" class="home_newsletter-button"><span id="form-responses">Sign Up</span>
                                <i class="fa-solid fa-arrow-right"></i>
                            </button>

                        </div>
                    </div>
                </form>
                <p>By providing your information, you agree to our <a
                        href="<?php echo get_permalink(get_page_by_path('terms-and-conditions')); ?>">Terms of Use</a> and
                    our <a href="<?php echo get_permalink(get_page_by_path('privacy-policy')); ?>">Privacy Policy</a>. We
                    use vendors that may also process your information to help provide our services. // This site is
                    protected by reCAPTCHA Enterprise and the <a href="https://policies.google.com/privacy"
                        target="_blank">Google Privacy Policy</a> and <a href="https://policies.google.com/terms"
                        target="_blank">Terms of Service</a> apply.</p>
            </div>
        </div>
    </section>
    <!-- sign-up-section-end -->
    <!-- latest-news-section-start -->
    <section class="latest-news">
        <div class="container">
            <div class="row main-wrap">
                <div class="w-68 col-md-12 col-sm-12 news-wrapper">
                    <div class="news-title">
                        <h2>latest news</h2>
                    </div>
                    <?php echo do_shortcode("[variety_latest_posts posts_per_page='10']"); ?>
                    <?php if (0): ?>
                    <?php endif; ?>

                </div>
                <div class="w-32 col-md-12 col-sm-12 actors-on-actor">
                    <div class="actors-wrapper">
                        <h2 class="actor-main-title">Actors on Actors</h2>
                        <div class="actors-on-actor-card-wrap">

                            <?php echo do_shortcode('[actors_cards category="actors-on-actors" numberposts="5"]'); ?>
                        </div>

                    </div>


                </div>
            </div>
        </div>
    </section>
    <!-- latest-news-section-end -->

    <!-- sign-up-section-start -->
    <section class="home_sign-up-form  breaking-news">
        <div class="container p-0">
            <div class="home_newsletter-bar border-top">
                <form id="custom-cfdb525-form">
                    <div class="home_newsletter-content-form">
                        <span class="newsletter-text">Sign up for Variety Breaking News Alerts</span>
                        <div class="home_news-letters-wrap">
                            <div class="input-error-wrap">
                                <input type="email" id="emails_second_new" name="email" class="newsletter-input"
                                    placeholder="Enter your email address">
                                <div id="form-responses" class="formresponses respo"></div>
                            </div>
                            <input type="hidden" id="new_secound" name="news" value="">
                            <button type="submit" class="home_newsletter-button"><span id="form-responses">Sign Up</span>
                                <i class="fa-solid fa-arrow-right"></i>
                            </button>

                        </div>
                    </div>
                </form>
                <p>By providing your information, you agree to our <a
                        href="<?php echo get_permalink(get_page_by_path('terms-and-conditions')); ?>">Terms of Use</a> and
                    our <a href="<?php echo get_permalink(get_page_by_path('privacy-policy')); ?>">Privacy Policy</a>. We
                    use vendors that may also process your information to help provide our services. // This site is
                    protected by reCAPTCHA Enterprise and the <a href="https://policies.google.com/privacy"
                        target="_blank">Google Privacy Policy</a> and <a href="https://policies.google.com/terms"
                        target="_blank">Terms of Service</a> apply.</p>
            </div>
        </div>
    </section>
    <!-- sign-up-section-end -->
    <div class="ads-header mt-3"></div>

    <!-- Reviews Section Start -->
    <section class="reviews-section">
        <div class="container">
            <div class="row main-wrap">
                <div class="revies-title-wrap">
                    <h2 class="review-title">Reviews</h2>
                    <?php echo  do_shortcode("[reviews_tabs]");?>
                </div>
                <div class="reviews-card-wrapper" id="reviews-tab-content">
                    <!-- <div class="reviews-cards" >
                        <a href="#"><img src="/wp-content/themes/variety/assets/images/Caught-Stealing-1.webp" alt="Reviews-img" width="255" height="170"></a>
                        <div class="reviews-cnt">
                            <h2 class="review-cnt-subtitle">Critics Pick</h2>
                            <h2 class="review-cnt-title"><a href="#">‘Caught Stealing'</a></h2>
                            <p class="review-cnt-para">Austin Butler plays a relatable loser in Darren Aronofsky's high-energy New York hustle. The director delivers a lively scuzzy tour of his home city that feels like 'After Hours' with more corpses.</p>
                        </div>
                    </div> -->
                </div>


                <div class="more-div">
                <?php //echo get_permalink(get_page_by_path('reviews'));?>
                    <a href="/category/film/reviews/" class="newsletter-button">
                        <span>More Reviews</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>

            </div>
        </div>
    </section>
<!-- Reviews Section End -->
    <!-- Reviews Section End -->
    <div class="ads-header mt-3"></div>
    <div class="ads-header mt-3"></div>
    <!-- Category News Section Start -->
    <section class="category-news-section">
        <div class="container">
            <div class="row main-wrap">
                <div class="category-news-wrapper">
                    <?php echo do_shortcode('[categorynews category="tv,music,film,tech" numberposts="5"]'); ?>
                </div>
            </div>
        </div>
    </section>
    <!-- Category News Section End -->
<?php endif; ?>




<!-- page 2-->
<?php if ($paged >= 2): ?>
    <!-- latest-news-section-start -->
    <section class="latest-news more-news-section">
        <div class="container">
            <div class="row main-wrap">
                <div class="w-68 col-md-12 col-sm-12 news-wrapper">
                    <div class="news-title">
                        <h2>More news</h2>
                    </div>
                    <?php echo do_shortcode("[variety_latest_posts posts_per_page='10']"); ?>
                    <?php if (0): ?>
                    <?php endif; ?>

                </div>
                <div class="most-popular w-32 col-md-12 col-sm-12">
                    <div class="ads-header"></div>
                    <div class="most-popular-section">
                        <h2>Most Popular</h2>
                        <div class="popular-list">
                            <?php echo do_shortcode("[popular_variety_latest_posts_function numberposts='15']"); ?>
                        </div>
                    </div>
                    <div class="ads-header mt-3"></div>
                    <div class="must-read">
                        <div class="most-popular-section listing">
                            <h2>must Read</h2>

                            <?php //echo do_shortcode("[Read_Popular_variety_latest_posts_function]");

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
                                            <input type="email" id="home_new_emails1" name="email" class="newsletter-input"
                                                placeholder="Enter your email address">
                                            <div id="form-responses" class="respo"></div>
                                            <input type="hidden" id="home_news1" name="news" value="">
                                            <button type="submit" class="home_newsletter-button"><span
                                                    id="form-responses">Sign Up</span>
                                                <i class="fa-solid fa-arrow-right"></i>
                                            </button>

                                        </div>
                                    </div>
                                </form>
                                <p>By providing your information, you agree to our <a
                                        href="https://variety.amaruventures.in/terms-and-conditions/">Terms of Use</a> and
                                    our <a href="https://variety.amaruventures.in/privacy-policy/">Privacy Policy</a>. We
                                    use vendors that may also process your information to help provide our services. // This
                                    site is protected by reCAPTCHA Enterprise and the <a
                                        href="https://policies.google.com/privacy">Google Privacy Policy</a> and <a
                                        href="https://variety.amaruventures.in/terms-and-conditions/">Terms of Service</a>
                                    apply.</p>
                            </div>
                        </div>
                    </div>
                    <div class="ads-header mt-3"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- latest-news-section-end -->

<?php endif; ?>

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
get_footer('footer'); ?>