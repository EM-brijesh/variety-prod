<?php
/*
Template Name: Videos Details Page
*/
get_header();

// Get current video ID from URL or fallback to current post
$video_id = isset($_GET['video_id']) ? intval($_GET['video_id']) : get_the_ID();
$url      = get_post_meta($video_id, 'variety-video-url', true);

// Convert YouTube URL to embed URL
function convert_to_embed_url($url, $autoplay = true)
{
    $video_id = '';

    if (preg_match('#youtu\.be/([^\?&]+)#', $url, $matches)) {
        $video_id = $matches[1];
    } elseif (preg_match('#youtube\.com/watch\?v=([^\?&]+)#', $url, $matches)) {
        $video_id = $matches[1];
    } elseif (preg_match('#youtube\.com/embed/([^\?&]+)#', $url, $matches)) {
        $video_id = $matches[1];
    }

    if ($video_id) {
        $embed = "https://www.youtube.com/embed/{$video_id}";
        if ($autoplay) $embed .= "?autoplay=1";
        return $embed;
    }
    return $url;
}

$embed = convert_to_embed_url($url);

// Featured videos query
$categories = wp_get_post_terms($video_id, 'vcategory');
$featured_query = null;

if ($categories) {
    $category_ids = wp_list_pluck($categories, 'term_id');
    $args = array(
        'post_type'      => 'varietyvideo',
        'posts_per_page' => 5,
        'post__not_in'   => array($video_id), // 🚀 exclude current video
        'tax_query'      => array(
            array(
                'taxonomy' => 'vcategory',
                'field'    => 'term_id',
                'terms'    => $category_ids,
            ),
        ),
    );

    $featured_query = new WP_Query($args);
}
?>

<style>
    .featured-card-div {
        position: relative;
        /* margin-bottom: 15px; */
    }

    .featured-card-div .overlay-now {
        display: none;
    }

    .featured-card-div.active .overlay-now {
        display: flex;
        justify-content: center;
        align-items: center;
        background: rgba(0, 0, 0, 0.5);
        color: #fff;
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        font-size: 20px;
        z-index: 1;
    }
</style>

<section class="Video_top-section">
    <div class="container">
        <div class="title-and filter-wrapper">
            <div class="row main-wrap">
                <h2 class="videos-title">Video</h2>
            </div>
            <div class="row-wrapper-video">
                <a href="#" class="popular-text">Popular on Variety</a>
                <div class="video-filter">
                    <div class="select-menu">
                        <div class="select-btn">
                            <span class="sBtn-text">More</span>
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
    <div class="container">
        <div class="row main-wrap">

            <!-- MAIN VIDEO -->
            <div class="w-75 col-md-12">
                <div class="top-videos">
                    <div class="top-video-div">
                        <iframe id="main-video" width="100%" height="415"
                            src="<?php echo esc_url($embed); ?>"
                            title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            referrerpolicy="strict-origin-when-cross-origin"
                            allowfullscreen></iframe>
                    </div>
                    <div class="video-top-cnt">
                        <h2 id="main-video-title">
                            <a href="#"><?php echo get_the_title($video_id); ?></a>
                        </h2>
                    </div>
                </div>
            </div>

            <!-- FEATURED VIDEOS -->
            <div class="w-25 col-md-12">
                <div class="featured-video-div">
                    <h4>Featured Video</h4>
                    <div class="featured-card-wrap">

                        <?php
                        // First show the main video in featured list
                        ?>
                        <div class="featured-card-div active"
                            data-url="<?php echo esc_url($embed); ?>"
                            data-title="<?php echo esc_attr(get_the_title($video_id)); ?>">
                            <div class="overlay-now-play">
                                <a href="<?php echo add_query_arg('video_id', $video_id); ?>">
                                    <?php echo get_the_post_thumbnail($video_id, 'medium', ['class' => 'img-fluid w-100']); ?>
                                    <div class="overlay-now">
                                        <h3>Now Playing</h3>
                                    </div>
                                </a>
                            </div>
                            <div class="featured-cnt">
                                <h2><a href="<?php echo get_permalink($video_id); ?>"><?php echo get_the_title($video_id); ?></a></h2>
                            </div>
                        </div>

                        <?php
                        if ($featured_query && $featured_query->have_posts()) :
                            while ($featured_query->have_posts()) : $featured_query->the_post();
                                $other_id    = get_the_ID();
                                $url         = get_post_meta($other_id, 'variety-video-url', true);
                                $embed_other = convert_to_embed_url($url);
                        ?>
                                <div class="featured-card-div"
                                    data-url="<?php echo esc_url($embed_other); ?>"
                                    data-title="<?php the_title(); ?>">
                                    <div class="overlay-now-play">
                                        <a href="<?php echo add_query_arg('video_id', $other_id); ?>">
                                            <?php the_post_thumbnail('medium', ['class' => 'img-fluid w-100']); ?>
                                        </a>
                                    </div>
                                    <div class="featured-cnt">
                                        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                                    </div>
                                </div>
                        <?php
                            endwhile;
                            wp_reset_postdata();
                        endif;
                        ?>

                    </div>
                </div>
            </div>

        </div>
    </div>


    <div class="container container-details">
        <div class="row main-wrap">
            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="video-details-cnt">

                    <p class="auther-name">By Emily Longeretta Plus Icon <?php echo get_the_author(); ?></p>

                    <?php
                    $post_title = urlencode(get_the_title());
                    $post_desc = urlencode(get_the_excerpt());
                    $post_url = urlencode(get_permalink());
                    $post_image = urlencode(get_the_post_thumbnail_url(get_the_ID(), 'full'));

                    ?>
                    <div class="variety-news-details-page-div">
                        <h2><?php echo the_title(); ?></h2>
                        <div class="variety-write-social_wrapper">
                            <div class="variety-writer-div">
                                <p>By <?php echo get_the_author(); ?></p>
                            </div>
                            <div class="social-container" id="socialContainer">
                                <div class="icons-social">
                                    <a target="_blank" class="social-icon" href="#"><img src="data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27%20width%3D%2724%27%20height%3D%2725.314%27%20viewBox%3D%270%200%2024%2025.314%27%3E%3Cpath%20id%3D%27Path_38%27%20data-name%3D%27Path%2038%27%20d%3D%27M3.75,2A1.752,1.752,0,0,0,2,3.75v10.5A1.752,1.752,0,0,0,3.75,16H8.672v4.962L14.455,16H20.25A1.752,1.752,0,0,0,22,14.25V3.75A1.752,1.752,0,0,0,20.25,2H3.75m0-2h16.5A3.75,3.75,0,0,1,24,3.75v10.5A3.75,3.75,0,0,1,20.25,18H15.2L6.672,25.314V18H3.75A3.75,3.75,0,0,1,0,14.25V3.75A3.75,3.75,0,0,1,3.75,0Z%27%2F%3E%3C%2Fsvg%3E" width="25" height="25"></a>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $post_url; ?>"
                                        target="_blank" class="social-icon"><svg viewBox="0 0 1024 1024" id="facebook-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#000">
                                            <g data-name="Layer 2">
                                                <g data-name="Ebene 1">
                                                    <path d="M1024 512C1024 229.23 794.77 0 512 0S0 229.23 0 512c0 255.55 187.23 467.37 432 505.78V660H302V512h130V399.2C432 270.88 508.44 200 625.39 200c56 0 114.61 10 114.61 10v126h-64.56c-63.6 0-83.44 39.47-83.44 80v96h142l-22.7 148H592v357.78c244.77-38.41 432-250.23 432-505.78Z"></path>
                                                    <path d="M711.3 660 734 512H592v-96c0-40.49 19.84-80 83.44-80H740V210s-58.59-10-114.61-10C508.44 200 432 270.88 432 399.2V512H302v148h130v357.78a517.58 517.58 0 0 0 160 0V660Z" style="fill:#fff"></path>
                                                </g>
                                            </g>
                                        </svg></a>
                                    <a href="https://twitter.com/intent/tweet?url=<?php echo $post_url; ?>&text=<?php echo $post_title; ?>"
                                        target="_blank" class="social-icon"><svg viewBox="0 0 1200 1227" id="twitter" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#000">
                                            <path d="M714.163 519.284 1160.89 0h-105.86L667.137 450.887 357.328 0H0l468.492 681.821L0 1226.37h105.866l409.625-476.152 327.181 476.152H1200L714.137 519.284h.026ZM569.165 687.828l-47.468-67.894-377.686-540.24h162.604l304.797 435.991 47.468 67.894 396.2 566.721H892.476L569.165 687.854v-.026Z"></path>
                                        </svg></a>
                                    <a href="#" target="_blank" class="social-icon"><svg viewBox="0 0 24 24" id="filpboard-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#000">
                                            <path d="M0 0v24h24V0H0zm19.2 9.6h-4.8v4.8H9.6v4.8H4.8V4.8h14.4v4.8z"></path>
                                        </svg></a>
                                    <a href="mailto:?subject=<?php echo $post_title; ?>&body=<?php echo $post_desc . '%0A' . $post_url; ?>"
                                        target="_blank" class="social-icon"><svg viewBox="0 0 32 32" id="email-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#000">
                                            <path d="M29 6H2.92a.78.78 0 0 0-.21 0l-.17.07a.65.65 0 0 0-.15.1.67.67 0 0 0-.15.14l-.06.06a.36.36 0 0 0 0 .09 1.08 1.08 0 0 0-.08.19 1.29 1.29 0 0 0-.1.25S2 7 2 7v18a1 1 0 0 0 1 1h26a1 1 0 0 0 1-1V7a1 1 0 0 0-1-1Zm-13 8.81L6.2 8h20.89ZM4 24V8.91l11.43 7.91a1.51 1.51 0 0 0 .18.09h.08A1.09 1.09 0 0 0 16 17a1 1 0 0 0 .41-.1h.07L28 9.79V24Z"></path>
                                        </svg></a>
                                </div>
                                <div class="more-icons" id="moreIcons">
                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $post_url; ?>"
                                        target="_blank" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="https://pinterest.com/pin/create/button/?url=<?php echo $post_url; ?>&media=<?php echo $post_image; ?>&description=<?php echo $post_desc; ?>"
                                        target="_blank" class="social-icon"><i class="fab fa-pinterest-p"></i></a>
                                    <a href="https://www.reddit.com/submit?url=<?php echo $post_url; ?>&title=<?php echo $post_title; ?>"
                                        target="_blank" class="social-icon"><i class="fa-brands fa-reddit-alien"></i></a>
                                    <a href="https://www.tumblr.com/widgets/share/tool?canonicalUrl=<?php echo $post_url; ?>&title=<?php echo $post_title; ?>&caption=<?php echo $post_desc; ?>"
                                        target="_blank" class="social-icon"><i class="fa-brands fa-tumblr"></i></a>
                                    <a href="https://api.whatsapp.com/send?text=<?php echo $post_title . '%20-%20' . $post_desc . '%20' . $post_url; ?>"
                                        target="_blank" class="social-icon"><i class="fa-brands fa-whatsapp"></i></a>
                                    <!-- <a href="javascript:window.print()" class="social-icon"><i
												class="fa-solid fa-print"></i></a> -->
                                </div>
                                <span class="social-toggle-btn">⋯</span>
                            </div>
                        </div>
                        <div class="video-cnt-para">
                            <?php echo  get_the_content(); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12 p-0">
                <div class="home_sign-up-form right-side-videoform">
                    <div class="container p-0">
                        <div class="home_newsletter-bar">
                            <form id="custom-cfdb121-form">
                                <div class="home_newsletter-content-form">
                                    <span class="newsletter-text">Sign Up for Variety Newsletters</span>
                                    <div class="home_news-letters-wrap">
                                        <input type="email" id="home_new_emails" name="email" class="newsletter-input" placeholder="Enter your email address">
                                        <div class="respo" id="form-responses"></div>
                                        <input type="hidden" id="home_news" name="news" value="">
                                        <button type="submit" class="home_newsletter-button"><span id="form-responses">Sign Up</span>
                                            <i class="fa-solid fa-arrow-right"></i>
                                        </button>

                                    </div>
                                </div>
                            </form>
                            <p>By providing your information, you agree to our <a href="<?php echo get_permalink(get_page_by_path('terms-and-conditions')); ?>">Terms of Use</a> and our <a href="<?php echo get_permalink(get_page_by_path('privacy-policy')); ?>">Privacy Policy</a>. We use vendors that may also process your information to help provide our services. // This site is protected by reCAPTCHA Enterprise and the <a href="https://policies.google.com/privacy" target="_blank">Google Privacy Policy</a> and <a href="https://policies.google.com/terms" target="_blank">Terms of Service</a> apply.</p>
                        </div>
                    </div>
                </div>
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
    </div>
</section>

<?php get_footer(); ?>