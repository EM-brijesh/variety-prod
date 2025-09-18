<?php
/* Author Detail Page */
get_header('header');
$authorid = intval($author);
$authordata = get_userdata($authorid);
// echo "<pre>";
// print_r($authordata);
// echo "</pre>";
?>
<style>
    .author-wrapper {
        display: flex;
        gap: 25px;
        align-items: flex-start;
    }

    .author-details {
        padding-top: 50px;
    }
    .auther-details-wrapper {
    padding-top: 50px;
}


    .news-img img {
        object-fit: cover;
        max-width: 230px;
        height: auto;
    }

    .author-cnt h2 {
        font-size: 42px;
        color: #000;
        line-height: 56px;
        font-family: Arial, sans-serif;
        font-weight: bold;
        margin-bottom: 15px;
    }

    .author-cnt span a {
        text-decoration: none;
        font-size: 18px;
        line-height: 24px;
        font-family: var(--mono-medium);
        color: #6b7b84;
    }

    .author-cnt p {
        font-size: 18px;
        line-height: 24px;
        color: #000;
        font-family: var(--ibm-plex-serif-regular);
        padding-top: 15px;
    }

    .author-details .popular-list {
        max-height: 450px;
        overflow-y: auto;
        padding-right: 5px;
    }
    .author-details .must-read {
    padding-top: 90px;
}
.auther-details-wrapper .latest-post-category a {
    color: #3d8247;
    text-decoration: none;
    font-size: 13px;
    line-height: 15px;
    font-family: var(--owner-medium);
}
.auther-details-wrapper .latest-post-category a:hover{
    text-decoration: underline;
}
.auther-details-wrapper .latest-post-time{
     font-size: 13px;
    line-height: 15px;
    font-family: var(--owner-regular);
    color: #595959;
}
.auther-details-wrapper .latest-post-title a:hover{
        color: #595959;
}
    .mail-wrap #twitter {
        width: 12px;
    }

    @media only screen and (max-width : 991px) {
        .author-wrapper {
            align-items: center;
            flex-direction: column;
        }

        .author-cnt {
            text-align: center;
        }

        .author-cnt h2 {
            font-size: 28px;
            line-height: 15px;
            margin-bottom: 15px;
        }

        .news-inform-wrap .news-img img {
            max-width: 100%;
        }
        .auther-details-wrapper{
            padding-right: 0;
        }
    }
</style>
<!-- ------------------------------------------ -->

<!-- top-story-section-start -->
<section class="top-story author-details">
    <div class="container">
        <div class="row main-wrap">
            <div class="story-description w-68 col-md-12 col-sm-12">
                <div class="author-wrapper">
                    <div class="author-img">
                        <img src="<?php echo get_avatar_url($authorid); ?>" alt=".webp">
                    </div>
                    <div class="author-cnt">
                        <h2><?php echo $authordata->display_name; ?></h2>
                        <div class="mail-wrap">
                            <span><a href="#"><svg viewBox="0 0 1200 1227" id="twitter"
                                        xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#000">
                                        <path
                                            d="M714.163 519.284 1160.89 0h-105.86L667.137 450.887 357.328 0H0l468.492 681.821L0 1226.37h105.866l409.625-476.152 327.181 476.152H1200L714.137 519.284h.026ZM569.165 687.828l-47.468-67.894-377.686-540.24h162.604l304.797 435.991 47.468 67.894 396.2 566.721H892.476L569.165 687.854v-.026Z">
                                        </path>
                                    </svg></a></span>
                            <span><a href="#"><?php echo $authordata->user_email; ?></a></span>
                        </div>
                        <?php echo wpautop($authordata->description); ?>
                    </div>
                </div>
                <div class="news-wrapper auther-details-wrapper">
                    <div class="news-title">
                        <h2>Recent Articles</h2>
                    </div>
                    <?php echo do_shortcode("[variety_author_posts authorid=$authorid]"); ?>
                    <?php if (0): ?>
                    <?php endif; ?>
                    <div class="more-div">
                        <a href="#" class="newsletter-button">
                            <span>More News</span>
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="most-popular author-popular w-32 col-md-12 col-sm-12">
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
            </div>
        </div>
    </div>
</section>
<!-- top-story-section-end -->

<!-- latest-news-section-start -->
<section class="latest-news auther-details-news">
    <div class="container">
        <div class="row main-wrap">

            <div class="most-popular w-32 col-md-12 col-sm-12">
                <div class="ads-header"></div>
                <div class="ads-header mt-3"></div>

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
    </div>
</section>
<!-- More Brands Section End -->


<?php
get_footer('footer'); ?>