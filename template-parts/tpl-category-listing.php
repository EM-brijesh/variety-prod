<?php
/*
Template Name: Category Listing Page
*/
get_header();
?>

<section class="sign-up">
    <div class="container ">
        <div class="row p-0">
            <div class="newsletter-bar col-lg-9 col-md-12 p-0">
                <div class="newsletter-content">
                    <span class="newsletter-text">Sign Up for Variety Newsletters</span>
                    <input type="email" class="newsletter-input" placeholder="Enter your email address" required/>
                    <a href="#" class="newsletter-button">
                        <span>SIGN UP</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- latest-news-section-start -->
<section class="latest-news category-listing">
    <div class="container p-0">
        <div class="row align-items-center">
            <div class="col-lg-9 col-md-12 col-sm-12 news-wrapper">
                <div class="news-title">
                    <h2>latest-news</h2>
                </div>


                <a href="<?php the_permalink(); ?>" class="news-inform-wrap">
                    <div class="news-img">
                        <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'full'); ?>"
                            alt="<?php the_title_attribute(); ?>" class="img-fluid">
                    </div>
                    <div class="news-cnt">
                        <div class="first-cnt">
                            <?php
                            $categories = get_the_category();
                            if (!empty($categories)) {
                                echo '<p>' . esc_html($categories[0]->name) . '</p><span>|</span>';
                            }
                            ?>
                            <p><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></p>
                        </div>
                        <h2><?php the_title(); ?></h2>
                    </div>
                </a>

                <div class="more-div">
                    <a href="#" class="newsletter-button">
                        <span>MORE NEWS</span>
                        <i class="fa-solid fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <div class="most-popular col-lg-3 col-md-12 col-sm-12">
                <div class="most-popular-section listing">
                    <h2>Most Popular</h2>
                    <div class="popular-list">
                        <a href="#" class="popular-item">
                            <img src="http://variety.amaruventures.in/wp-content/uploads/2025/06/popular_first_img.webp"
                                alt="webp">
                            <p>'28 Years Later' Review: Danny Boyle Revives His Hit Horror Saga in Time to</p>
                        </a>
                        <a href="#" class="popular-item">
                            <img src="http://variety.amaruventures.in/wp-content/uploads/2025/06/popular_first_img.webp"
                                alt="webp">
                            <p>'28 Years Later' Review: Danny Boyle Revives His Hit Horror Saga in Time to</p>
                        </a>
                        <a href="#" class="popular-item">
                            <img src="http://variety.amaruventures.in/wp-content/uploads/2025/06/popular_first_img.webp"
                                alt="webp">
                            <p>'28 Years Later' Review: Danny Boyle Revives His Hit Horror Saga in Time to</p>
                        </a>
                        <a href="#" class="popular-item">
                            <img src="http://variety.amaruventures.in/wp-content/uploads/2025/06/popular_first_img.webp"
                                alt="webp">
                            <p>'28 Years Later' Review: Danny Boyle Revives His Hit Horror Saga in Time to</p>
                        </a>
                        <a href="#" class="popular-item">
                            <img src="http://variety.amaruventures.in/wp-content/uploads/2025/06/popular_first_img.webp"
                                alt="webp">
                            <p>'28 Years Later' Review: Danny Boyle Revives His Hit Horror Saga in Time to</p>
                        </a>
                        <a href="#" class="popular-item">
                            <img src="http://variety.amaruventures.in/wp-content/uploads/2025/06/popular_first_img.webp"
                                alt="webp">
                            <p>'28 Years Later' Review: Danny Boyle Revives His Hit Horror Saga in Time to</p>
                        </a>
                        <a href="#" class="popular-item">
                            <img src="http://variety.amaruventures.in/wp-content/uploads/2025/06/popular_first_img.webp"
                                alt="webp">
                            <p>'28 Years Later' Review: Danny Boyle Revives His Hit Horror Saga in Time to</p>
                        </a>
                        <a href="#" class="popular-item">
                            <img src="http://variety.amaruventures.in/wp-content/uploads/2025/06/popular_first_img.webp"
                                alt="webp">
                            <p>'28 Years Later' Review: Danny Boyle Revives His Hit Horror Saga in Time to</p>
                        </a>
                        <a href="#" class="popular-item">
                            <img src="http://variety.amaruventures.in/wp-content/uploads/2025/06/popular_first_img.webp"
                                alt="webp">
                            <p>'28 Years Later' Review: Danny Boyle Revives His Hit Horror Saga in Time to</p>
                        </a>
                        <a href="#" class="popular-item">
                            <img src="http://variety.amaruventures.in/wp-content/uploads/2025/06/popular_first_img.webp"
                                alt="webp">
                            <p>'28 Years Later' Review: Danny Boyle Revives His Hit Horror Saga in Time to</p>
                        </a>
                        <a href="#" class="popular-item">
                            <img src="http://variety.amaruventures.in/wp-content/uploads/2025/06/popular_first_img.webp"
                                alt="webp">
                            <p>'28 Years Later' Review: Danny Boyle Revives His Hit Horror Saga in Time to</p>
                        </a>
                    </div>
                </div>
                <div class="newsletter-devider">
                    <div class="newsletter-bar">
                        <div class="newsletter-content">
                            <span class="newsletter-text">Sign Up for Variety Newsletters</span>
                            <input type="email" class="newsletter-input" placeholder="Enter your email address" required/>
                            <a href="#" class="newsletter-button">
                                <span>SIGN UP</span>
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="must-read">
                    <div class="most-popular-section listing">
                        <h2>must Read</h2>
                        <a href="#" class="must-wrap">
                            <img src="http://variety.amaruventures.in/wp-content/uploads/2025/06/GettyImage_must-read.webp"
                                alt=".webp" class="img-fluid">
                            <span>MUSIC</span>
                            <p>
                                Diddy's Ex-Assistant Testifies About Cleaning Up Hotel Rooms After 'Wild King Nights'
                                Sex Parties and Cocaine Arrest During FBI Raid
                            </p>
                        </a>
                        <div class="popular-list">
                            <a href="#" class="popular-item">
                                <img src="http://variety.amaruventures.in/wp-content/uploads/2025/06/popular_first_img.webp"
                                    alt="webp">
                                <div class="variety_must-read_cnt">
                                    <span class="d-block">Film</span>
                                    <p>'28 Years Later' Review: Danny Boyle Revives His Hit Horror Saga in Time to</p>
                                </div>
                            </a>
                            <a href="#" class="popular-item">
                                <img src="http://variety.amaruventures.in/wp-content/uploads/2025/06/popular_first_img.webp"
                                    alt="webp">
                                <div class="variety_must-read_cnt">
                                    <span class="d-block">Film</span>
                                    <p>'28 Years Later' Review: Danny Boyle Revives His Hit Horror Saga in Time to</p>
                                </div>
                            </a>
                            <a href="#" class="popular-item">
                                <img src="http://variety.amaruventures.in/wp-content/uploads/2025/06/popular_first_img.webp"
                                    alt="webp">
                                <div class="variety_must-read_cnt">
                                    <span class="d-block">Film</span>
                                    <p>'28 Years Later' Review: Danny Boyle Revives His Hit Horror Saga in Time to</p>
                                </div>
                            </a>
                            <a href="#" class="popular-item">
                                <img src="http://variety.amaruventures.in/wp-content/uploads/2025/06/popular_first_img.webp"
                                    alt="webp">
                                <div class="variety_must-read_cnt">
                                    <span class="d-block">Film</span>
                                    <p>'28 Years Later' Review: Danny Boyle Revives His Hit Horror Saga in Time to</p>
                                </div>
                            </a>
                            <a href="#" class="popular-item">
                                <img src="http://variety.amaruventures.in/wp-content/uploads/2025/06/popular_first_img.webp"
                                    alt="webp">
                                <div class="variety_must-read_cnt">
                                    <span class="d-block">Film</span>
                                    <p>'28 Years Later' Review: Danny Boyle Revives His Hit Horror Saga in Time to</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- latest-news-section-end -->
<?php

get_footer();