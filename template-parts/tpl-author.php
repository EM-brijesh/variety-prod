<?php
/*
 * Template Name: Author details page
 */
get_header('header');
?>
<style>
    .author-wrapper {
        display: flex;
        gap: 25px;
        align-items: flex-start;
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
        max-height: 300px;
        overflow-y: auto;
        padding-right: 5px;
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
        body{
            padding-inline: 20px !important;
        }
        .news-inform-wrap .news-img img {
            max-width: 100%;
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
                        <img src="http://variety.amaruventures.in/wp-content/uploads/2025/09/NamanRamachandran-photo.webp"
                            alt=".webp">
                    </div>
                    <div class="author-cnt">
                        <h2>Naman Ramachandran</h2>
                        <span><a href="#">nramachandran@variety.com</a></span>
                        <p>
                            Naman Ramachandran is International Correspondent at Variety, based out of London and Asia,
                            a critic for Sight & Sound, and a fortnightly columnist on world cinema for The Hindu.
                            Naman’s work as an author includes "Rajinikanth: The Definitive Biography" (Penguin),
                            "Lights, Camera, Masala: Making Movies In Mumbai" (IBH) and chapters in "Rough Guide To
                            Film" (Rough Guides), "Movies: From The Silent Classics Of The Silver Screen To The Digital
                            and 3D Era" (Universe) and "Movie Star Chronicles: A Visual History of 320 of the World's
                            Greatest Movie Stars" (Peregrine). He has previously worked with the British Film Institute,
                            Cineuropa, HBO Asia and MTV India. He is a BAFTA member.
                        </p>
                    </div>
                </div>
            </div>

            <div class="most-popular author-popular w-32 col-md-12 col-sm-12">
                <div class="most-popular-section">
                    <h2>Most Popular</h2>
                    <div class="popular-list">
                        <?php echo do_shortcode("[popular_variety_latest_posts_function numberposts='15']"); ?>
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
            <div class="w-68 col-md-12 col-sm-12 news-wrapper auther-details-wrapper">
                <div class="news-title">
                    <h2>Recent Articles</h2>
                </div>
                <?php echo do_shortcode("[variety_latest_posts numberposts=10]"); ?>
                <?php if (0): ?>
                <?php endif; ?>
                <div class="more-div">
                    <a href="#" class="newsletter-button">
                        <span>More News</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
          <div class="most-popular w-32 col-md-12 col-sm-12">
                <div class="ads-header"></div>
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
                                            placeholder="Enter your email address" />
                                            <div id="form-responses" class="respo"></div>
                                        <input type="hidden" id="home_news1" name="news" value="">
                                        <button type="submit" class="home_newsletter-button"><span>Sign Up</span>
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </button>

                                    </div>
                                </div>
                            </form>
                            <p>By providing your information, you agree to our <a href="https://variety.amaruventures.in/terms-and-conditions/">Terms of Use</a> and our <a href="https://variety.amaruventures.in/privacy-policy/">Privacy Policy</a>. We use vendors that may also process your information to help provide our services. // This site is protected by reCAPTCHA Enterprise and the <a href="https://policies.google.com/privacy">Google Privacy Policy</a> and <a href="https://variety.amaruventures.in/terms-and-conditions/">Terms of Service</a> apply.</p>
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
    <h2 class="recommed-title">More From Our Brands</h2>
    <div class="recommend-cards-wrapper">
        <?php echo do_shortcode('[brand_recommented_tags tag="Brands" posts="5"]'); ?>
    </div>
</section>
<!-- More Brands Section End -->



<?php
get_footer('footer'); ?>