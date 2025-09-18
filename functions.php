<?php

/**
 * Variety functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Variety
 */

if (! defined('_S_VERSION')) {
    // Replace the version number of the theme on each release.
    define('_S_VERSION', '1.0.0');
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function variety_setup()
{
    /*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on Variety, use a find and replace
		* to change 'variety' to the name of your theme in all the template files.
		*/
    load_theme_textdomain('variety', get_template_directory() . '/languages');

    // Add default posts and comments RSS feed links to head.
    add_theme_support('automatic-feed-links');

    /*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
    add_theme_support('title-tag');

    /*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
    add_theme_support('post-thumbnails');

    // This theme uses wp_nav_menu() in one location.
    register_nav_menus(
        array(
            'header' => esc_html__('Header', 'variety'),
            'footer' => esc_html__('Footer', 'variety'),
        )
    );

    /*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
    add_theme_support(
        'html5',
        array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
            'style',
            'script',
        )
    );

    // Set up the WordPress core custom background feature.
    add_theme_support(
        'custom-background',
        apply_filters(
            'variety_custom_background_args',
            array(
                'default-color' => 'ffffff',
                'default-image' => '',
            )
        )
    );

    // Add theme support for selective refresh for widgets.
    add_theme_support('customize-selective-refresh-widgets');

    /**
     * Add support for core custom logo.
     *
     * @link https://codex.wordpress.org/Theme_Logo
     */
    add_theme_support(
        'custom-logo',
        array(
            'height'      => 250,
            'width'       => 250,
            'flex-width'  => true,
            'flex-height' => true,
        )
    );
}
add_action('after_setup_theme', 'variety_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function variety_content_width()
{
    $GLOBALS['content_width'] = apply_filters('variety_content_width', 640);
}
add_action('after_setup_theme', 'variety_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function variety_widgets_init()
{
    register_sidebar(
        array(
            'name'          => esc_html__('Sidebar', 'variety'),
            'id'            => 'sidebar-1',
            'description'   => esc_html__('Add widgets here.', 'variety'),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action('widgets_init', 'variety_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function variety_scripts()
{


    wp_register_style("variety-style", get_template_directory_uri() . "/assets/css/style.css", array(), time(), false);
    wp_register_style("variety-responsive", get_template_directory_uri() . "/assets/css/responsive.css", array(), time(), false);
    wp_register_style("variety-headerstyle", get_template_directory_uri() . "/assets/css/header.css", array(), time(), false);
    wp_register_script("variety-bootstrapbundle", "https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js", array("jquery"), "2.3.4", true);
    wp_register_script("variety-customscript", get_template_directory_uri() . "/assets/js/scripts.js", array("jquery"), time(), true);

    wp_enqueue_style('variety-style', get_stylesheet_uri(), array(), _S_VERSION);
    wp_enqueue_style('variety-responsive', get_stylesheet_uri(), array(), _S_VERSION);
    wp_enqueue_style('variety-headerstyle', get_stylesheet_uri(), array(), _S_VERSION);

    wp_enqueue_script("variety-bootstrapbundle");
    wp_enqueue_script("variety-customscript");

    wp_style_add_data('variety-style', 'rtl', 'replace');

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'variety_scripts');

function variety_get_header_menu()
{
    $menu_name = 24; // The slug or name of your menu in Appearance > Menus
    $menu = wp_get_nav_menu_object($menu_name);

    if ($menu) {
        ob_start();
        $menu_items = wp_get_nav_menu_items($menu->term_id);

        // Group menu items by parent
        $menu_tree = array();

        foreach ($menu_items as $item) {
            if (!$item->menu_item_parent) {
                $menu_tree[$item->ID] = array(
                    'item' => $item,
                    'children' => array()
                );
            }
        }

        foreach ($menu_items as $item) {
            if ($item->menu_item_parent && isset($menu_tree[$item->menu_item_parent])) {
                $menu_tree[$item->menu_item_parent]['children'][] = $item;
            }
        }

        // Output in custom format
        foreach ($menu_tree as $group) {
            //print_r($group);

?>
            <?php
            // this is condition only for what we watch
            if ($group['item']->title != "What We Watch"):
            ?>

                <div class="menu-group">
                    <div class="menu-item">

                        <a href="<?php echo esc_url($group['item']->url); ?>">
                            <span><?php echo esc_html($group['item']->title); ?></span>

                        </a>
                        <span class="dropdown-toggle">
                            <i class="fa-solid fa-angle-down"></i>
                        </span>
                    </div>

                    <ul>
                        <?php foreach ($group['children'] as $child) : ?>
                            <li><a href="<?php echo esc_url($child->url); ?>"><?php echo esc_html($child->title); ?></a></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
        <?php }
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
}


// this is header menu

function headermenu_variety_get_header_menu()
{
    $menu_name = 24; // The slug or name of your menu in Appearance > Menus
    $menu = wp_get_nav_menu_object($menu_name);

    if ($menu) {
        ob_start();
        $menu_items = wp_get_nav_menu_items($menu->term_id);

        // Group menu items by parent
        $menu_tree = array();

        foreach ($menu_items as $item) {
            if (!$item->menu_item_parent) {
                $menu_tree[$item->ID] = array(
                    'item' => $item,
                    'children' => array()
                );
            }
        }

        foreach ($menu_items as $item) {
            if ($item->menu_item_parent && isset($menu_tree[$item->menu_item_parent])) {
                $menu_tree[$item->menu_item_parent]['children'][] = $item;
            }
        }
        // Output in custom format
        foreach ($menu_tree as $group) {

        ?>

            <li><a href="<?php echo esc_url($group['item']->url); ?>"><?php echo esc_html($group['item']->title); ?></a></li>

        <?php }
        $output = ob_get_contents();
        ob_end_clean();
        return $output;
    }
}

//end


function variety_latest_posts_function($atts)
{
    $atts = shortcode_atts(array(
        "posts_per_page" => 10,  // how many posts per page
        "category"       => '',  // category slug or ID
        "nextlabel" => "More News"
    ), $atts, 'variety_latest_posts');

    // ✅ Handle pagination for shortcodes (works inside Pages too)
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    if (get_query_var('page')) {
        $paged = get_query_var('page');
    }

    $args = array(
        'post_type'      => 'post',   // ✅ only blog posts
        'posts_per_page' => intval($atts['posts_per_page']),
        'orderby'        => 'date',
        'order'          => 'DESC',
        'paged'          => $paged,
    );

    // ✅ Category filter
    if (!empty($atts['category'])) {
        if (is_numeric($atts['category'])) {
            $args['cat'] = intval($atts['category']);
        } else {
            $slugs = explode('/', trim($atts['category'], '/'));
            $last_slug = end($slugs);
            $term = get_category_by_slug(sanitize_title($last_slug));
            if ($term) {
                $args['cat'] = $term->term_id;
            }
        }
    }

    $query = new WP_Query($args);

    ob_start();

    if ($query->have_posts()) {
        $i = 1;
        while ($query->have_posts()) {
            $query->the_post();
            $tags = get_the_tags($post_id);
            $tagname = "";
            $tag_link = "#";
            if ($tags) {
                $sponsored_tags = array_filter($tags, function ($tag) {
                    return $tag->name === 'Sponsored';
                });
                $sponsored_tags = reset($sponsored_tags);
                if ($sponsored_tags->name == "Sponsored") {
                    $tagname = $sponsored_tags->name;
                    $tag_link = get_tag_link($sponsored_tags->term_id);
                }
            }
            $categories = get_the_category(get_the_ID());
            $category_name = !empty($categories) ? esc_html($categories[0]->name) : 'Uncategorized';
            $cat_link = !empty($categories) ? get_category_link($categories[0]->term_id) : '#';
            $publish_timestamp = get_the_time('U');
            $human_time = custom_human_time_diff($publish_timestamp);
        ?>
            <div class="news-inform-wrap">
                <div class="news-img">
                    <a href="<?php the_permalink(); ?>">
                        <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'medium')); ?>"
                            alt="<?php the_title_attribute(); ?>" class="img-fluid"
                            width="230" height="200" decoding="async">
                    </a>
                </div>
                <div class="news-cnt">
                    <div class="first-cnt">
                        <p class="latest-post-category post-tag-name-<?php echo strtolower($tagname); ?>">
                            <?php if ($tagname == "Sponsored"): ?>
                                <a href="<?php echo esc_url($tag_link); ?>"><?php echo strtoupper($tagname); ?></a>
                            <?php else: ?>
                                <a href="<?php echo esc_url($cat_link); ?>"><?php echo $category_name; ?></a>
                            <?php endif; ?>
                        </p>
                        <?php if ($tagname != "Sponsored"): ?>
                            <span>|</span>
                            <p class="latest-post-time"><?php echo $human_time; ?></p>
                        <?php endif; ?>

                    </div>
                    <h2 class="latest-post-title">
                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                    </h2>
                </div>
            </div>
        <?php
        }

        // ✅ Previous + Next pagination
        ?>
        <div class="pagination-buttons">
            <?php if ($paged > 1) : ?>
                <a class="newsletter-button prev" href="<?php echo esc_url(get_pagenum_link($paged - 1)); ?>">
                    <i class="fa-solid fa-arrow-left"></i><span>Previous</span>
                </a>
            <?php endif; ?>

            <?php if ($paged < $query->max_num_pages) : ?>
                <?php if ($paged >= 2): ?>
                    <a class="newsletter-button next-btn" href="<?php echo esc_url(get_pagenum_link($paged + 1)); ?>">
                        <span>Next</span> <i class="fa-solid fa-arrow-right"></i>
                    </a>
                <?php else: ?>
                    <a class="newsletter-button next next-btn" href="<?php echo esc_url(get_pagenum_link($paged + 1)); ?>">
                        <span><?php echo $atts['nextlabel']; ?></span> <i class="fa-solid fa-arrow-right"></i>
                    </a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    <?php
    }

    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('variety_latest_posts', 'variety_latest_posts_function');




function variety_author_posts_function($atts)
{
    $atts = shortcode_atts(array(
        "numberposts" => -1,
        "authorid" => 1,
    ), $atts, 'variety_author_posts');

    $args = array(
        'numberposts' => $atts['numberposts'],
        'orderby'     => 'modified', // ✅ order by updated time
        'order'       => 'DESC',
        "author__in" => array($atts['authorid'])
    );


    if (!empty($atts['category'])) {
        if (is_numeric($atts['category'])) {
            // Category passed as ID
            $args['cat'] = intval($atts['category']);
        } else {
            // Handle nested slugs like "film/news"
            $slugs = explode('/', trim($atts['category'], '/'));
            $last_slug = end($slugs);

            $term = get_category_by_slug(sanitize_title($last_slug));
            if ($term) {
                $args['cat'] = $term->term_id; // Use term ID to query
            }
        }
    }

    $posts = get_posts($args);
    ob_start();

    foreach ($posts as $post) {
        setup_postdata($post);

        $categories = get_the_category($post->ID);
        $category_name = !empty($categories) ? esc_html($categories[0]->name) : 'Uncategorized';
        $cat_link = !empty($categories) ? get_category_link($categories[0]->term_id) : '#';

        $publish_timestamp = get_the_time('U', $post->ID);
        $human_time = custom_human_time_diff($publish_timestamp);
    ?>
        <div class="news-inform-wrap">
            <div class="news-img">
                <a href="<?php echo get_permalink($post); ?>">
                    <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>"
                        alt="<?php echo esc_attr($post->post_title); ?>" class="img-fluid"
                        width="230" height="200" decoding="async">
                </a>
            </div>
            <div class="news-cnt">
                <div class="first-cnt">
                    <p class="latest-post-category"><a href="<?php echo esc_url($cat_link); ?>"><?php echo $category_name; ?></a></p>
                    <span>|</span>
                    <p class="latest-post-time"><?php echo $human_time; ?></p>
                </div>
                <h2 class="latest-post-title"><a href="<?php echo get_permalink($post); ?>"><?php echo $post->post_title; ?></a></h2>
            </div>
        </div>
        <?php
    }

    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('variety_author_posts', 'variety_author_posts_function');

// this is top story post shortcode
function top_variety_latest_posts_function($atts)
{

    $atts = shortcode_atts(array(
        "numberposts" => 6,
        "category"    => "" // category slug
    ), $atts);

    $slug = sanitize_text_field($atts['category']);

    // Get latest posts by category
    $args = array(
        'posts_per_page' => intval($atts['numberposts']),
        'orderby'        => 'date',
        'order'          => 'DESC',
    );

    if (!empty($slug)) {
        $args['category_name'] = $slug; // filter by category slug if provided
    }

    $posts = get_posts($args);

    if (empty($posts)) {
        return '<p>No posts found.</p>';
    }

    ob_start();

    $index = 0;

    foreach ($posts as $post) {
        setup_postdata($post);

        // Get category name
        $categories = get_the_category($post->ID);
        $category_name = !empty($categories) ? esc_html($categories[0]->name) : 'Uncategorized';
        $cat_link = !empty($categories) ? get_category_link($categories[0]->term_id) : '#';

        // Human readable time
        $publish_timestamp = get_the_time('U', $post->ID);
        $human_time = custom_human_time_diff($publish_timestamp);

        // Get thumbnail
        $thumbnail_url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));

        // Get post excerpt
        $excerpt = $post->post_excerpt ? $post->post_excerpt : wp_trim_words($post->post_content, 20);

        $title = $post->post_title;
        $length = strlen($title);
        $half   = ceil($length / 2);
        $part1 = mb_substr($title, 0, $half);
        $part2 = mb_substr($title, $half);

        $image_id = get_post_thumbnail_id($post->ID);
        $alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', true);
        if ($index === 0) {
            // First post - special story-wrap layout

            if (!empty(get_the_author())) {
                $authorname = get_the_author();
            } else {
                $authorname = "Courtesy Son";
            }
        ?>


            <div class="variety_cards_wrapper">
                <div class="story-wrap">
                    <span class="topstory-title">TOP STORY</span>

                    <h1 class="topstorynews-title">
                        <a href="<?php echo get_permalink($post); ?>">
                            <span><?php echo esc_html($part1); ?></span>
                            <?php if (!empty($part2)): ?>
                                <span><?php echo esc_html($part2); ?></span>
                            <?php endif; ?>
                        </a>
                    </h1>

                    <div class="story-img etsttsts">
                        <a href="<?php echo get_permalink($post); ?>"><img src="<?php echo esc_url($thumbnail_url); ?>" width="1280" height="720" alt="<?php echo $alt_text; ?>" class="img-fluid" decoding="async" loading="eager" fetchpriority="high"></a>
                    </div>

                    <div class="story-cnt">
                        <div class="story-cnt-div">
                            <p><?php echo esc_html($excerpt); ?></p>
                        </div>
                        <span class="last-cnt">
                            <p class="variety_author">By <?php echo $authorname; ?></p>

                        </span>
                    </div>
                </div>
            </div>
        <?php
        } else {
            // Other posts - variety_cards_wrapper layout
        ?>
            <div class="variety_cards_wrapper">
                <div class="variety_img">
                    <a href="<?php echo get_permalink($post); ?>"><img src="<?php echo esc_url($thumbnail_url); ?>"
                            width="300"
                            height="200"
                            alt="<?php echo $alt_text; ?>"
                            class="img-fluid" decoding="async"
                            style="width:100%;height:auto;"
                            fetchpriority="high"></a>
                </div>
                <div class="variety-cnt-home">
                    <div class="variety-card-title-new">
                        <p class="topstory-title"><a href="<?php echo esc_url($cat_link); ?>"><?php echo esc_html($category_name); ?></a></p>
                        <h2><a href="<?php echo get_permalink($post); ?>"><?php echo esc_html($post->post_title); ?></a></h2>
                        <div class="variety-card-para-new">
                            <p><?php echo esc_html($excerpt); ?></p>
                        </div>
                    </div>
                    <div class="variety-author-date-wrapper">
                        <p class="variety_author">By <?php echo $authorname; ?></p>

                    </div>
                </div>
            </div>
        <?php
        }

        $index++;
    }

    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('top_variety_latest_posts', 'top_variety_latest_posts_function');
//end


// this is most popular varrity shortcode

function most_Popular_variety_latest_posts_function($atts)
{
    extract(shortcode_atts(array(
        "numberposts" => -1
    ), $atts));

    $posts = get_posts(array('numberposts' => $numberposts));
    ob_start();

    foreach ($posts as $post) {
        setup_postdata($post);

        // Get the first category name
        $categories = get_the_category($post->ID);
        $category_name = !empty($categories) ? esc_html($categories[0]->name) : 'Uncategorized';

        // Get the publish date
        $publish_timestamp = get_the_time('U', $post->ID);
        $time_diff = time() - $publish_timestamp;
        $human_time = custom_human_time_diff($publish_timestamp);
        $tags = get_the_tags($post->ID);
        $tagname = "";
        $tag_link = "#";
        if ($tags) {
            $sponsored_tags = array_filter($tags, function ($tag) {
                return $tag->name === 'Sponsored';
            });
            $sponsored_tags = reset($sponsored_tags);
            if ($sponsored_tags->name == "Sponsored") {
                $tagname = $sponsored_tags->name;
                $tag_link = get_tag_link($sponsored_tags->term_id);
            }
        }

        $image_id = get_post_thumbnail_id($post->ID);
        $alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', true);
        ?>

        <div class="popular-item post-tag-name-<?php echo strtolower($tagname); ?>">
            <a href="<?php echo get_permalink($post); ?>"><img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>" alt="<?php echo $alt_text; ?>"></a>
            <div class="popular-item-sponsored-wrapper">

                <?php if ($tagname != "" && $tagname == "Sponsored"): ?>
                    <span class="variety-sponsored-tag"><?php echo $tagname; ?></span>
                <?php endif; ?>
                <a href="<?php echo get_permalink($post); ?>">
                    <p><?php echo $post->post_title; ?></p>
                </a>
            </div>
        </div>

        <?php
    }

    wp_reset_postdata();
    $output = ob_get_clean();
    return $output;
}
add_shortcode('popular_variety_latest_posts_function', 'most_Popular_variety_latest_posts_function');

//end

// This is the "Must Read Variety" shortcode
function mustRead_Popular_variety_latest_posts_function($atts)
{
    // Extract shortcode attributes, with defaults
    extract(shortcode_atts(array(
        "numberposts" => 10,
        "category" => '' // NEW: optional category slug
    ), $atts));

    // Query posts
    $args = array(
        'numberposts' => $numberposts,
        'post_type' => 'post'
    );

    // Filter by category if provided
    if (!empty($category)) {
        $args['category_name'] = sanitize_text_field($category);
    }

    $posts = get_posts($args);

    ob_start();
    $index = 0;



    foreach ($posts as $post) {
        setup_postdata($post);

        // Get the first category name
        $categories = get_the_category($post->ID);
        $category_name = !empty($categories) ? esc_html($categories[0]->name) : 'Uncategorized';

        // Get publish time diff
        $publish_timestamp = get_the_time('U', $post->ID);
        $human_time = custom_human_time_diff($publish_timestamp);
        $image_id = get_post_thumbnail_id($post->ID);
        $alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', true);

        if ($index === 0) { ?>
            <a href="<?php echo get_permalink($post); ?>" class="must-wrap">
                <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>" alt="<?php echo $alt_text; ?>" class="img-fluid" decoding="async" width="200" height="200" loading="eager">
                <span><?php echo $category_name; ?></span>
                <p><?php echo esc_html($post->post_title); ?></p>
            </a>
        <?php } else { ?>
            <div class="popular-list">
                <a href="<?php echo get_permalink($post); ?>" class="popular-item">
                    <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id($post->ID)); ?>" alt="<?php echo $alt_text; ?>" decoding="async" width="200" height="200">
                    <div class="variety_must-read_cnt">
                        <span class="d-block"><?php echo $category_name; ?></span>
                        <p><?php echo esc_html($post->post_title); ?></p>
                    </div>
                </a>
            </div>
    <?php }

        $index++;
    }

    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('Read_Popular_variety_latest_posts_function', 'mustRead_Popular_variety_latest_posts_function');

// this is latest post scrolling code step by step 
function variety_enqueue_scripts()
{
    wp_enqueue_script('variety-ajax-posts', get_template_directory_uri() . '/js/variety-ajax-posts.js', array('jquery'), null, true);

    wp_localize_script('variety-ajax-posts', 'variety_ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('load_more_posts')
    ));
}
add_action('wp_enqueue_scripts', 'variety_enqueue_scripts');



function variety_autoload_posts_shortcode($atts)
{
    ob_start(); ?>

    <div id="variety-posts-container">
        <div class="row">
            <?php echo variety_load_posts(1); ?>
        </div>
    </div>

    <div id="variety-loader" style="text-align: center; padding: 20px;">

        <div class="load-more">
            <div class="spinner">
                <div class="double-bounce1"></div>
                <div class="double-bounce2"></div>
            </div>
        </div>
    </div>

    <script>
        var page = 2;
        var loading = false;
        jQuery(window).scroll(function() {
            if (jQuery(window).scrollTop() + jQuery(window).height() >= jQuery(document).height() - 100 && !loading) {
                loading = true;
                jQuery.ajax({
                    type: 'POST',
                    url: variety_ajax_object.ajax_url,
                    data: {
                        action: 'load_variety_posts',
                        nonce: variety_ajax_object.nonce,
                        page: page
                    },
                    success: function(response) {
                        if (response.trim() !== '') {
                            var wrapped = '<div class="row">' + response + '</div>';
                            jQuery('#variety-posts-container').append(wrapped);
                            window.observeNewWrappers();
                            page++;
                            loading = false;
                        } else {
                            jQuery('#variety-loader').hide();

                        }
                    }
                });
            }
        });
    </script>

    <?php
    return ob_get_clean();
}
add_shortcode('variety_autoload_posts', 'variety_autoload_posts_shortcode');



add_action('wp_ajax_load_variety_posts', 'ajax_load_variety_posts');
add_action('wp_ajax_nopriv_load_variety_posts', 'ajax_load_variety_posts');

function ajax_load_variety_posts()
{
    check_ajax_referer('load_more_posts', 'nonce');

    $paged = isset($_POST['page']) ? intval($_POST['page']) : 1;

    echo variety_load_posts($paged);

    wp_die();
}


// this infinite loader for details page

function variety_load_posts($paged = 1)
{
    $output = '';
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 1,
        'paged' => $paged,
        'orderby' => 'date',
        'order' => 'DESC'
    );
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            // Start output buffering
            ob_start();

            // Get post categories
            $categories = get_the_category();
            $breadcrumb_items = [];

            if (!empty($categories)) {
                // Get primary category (or first one)
                $cat = $categories[0];
                // Traverse parent categories
                while ($cat) {
                    $breadcrumb_items[] = [
                        'name' => $cat->name,
                        'url' => get_category_link($cat->term_id),
                    ];
                    $cat = $cat->parent ? get_category($cat->parent) : null;
                }
                // Reverse to make it parent > child order
                $breadcrumb_items = array_reverse($breadcrumb_items);
            }

            // Prepare social share variables
            $post_title = urlencode(get_the_title());
            $post_desc = urlencode(get_the_excerpt());
            $post_url = urlencode(get_permalink());
            $id = get_the_ID();
            $post_image = urlencode(get_the_post_thumbnail_url(get_the_ID(), 'full'));
    ?>
            <div class="col-lg-9 col-md-12">
                <div class="variety-detials-main-cnt">

                    <div class="breadcrump-date-wrapper">
                        <div class="breadcrump">
                            <ul>
                                <li><a href="<?php echo home_url(); ?>">Home</a></li>
                                <?php foreach ($breadcrumb_items as $item): ?>
                                    <li><i class="fa-solid fa-angle-right"></i></li>
                                    <li><a href="<?php echo esc_url($item['url']); ?>"><?php echo esc_html($item['name']); ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <div class="variety-details-date-time">
                            <p><?php echo get_the_date('M j, Y g:ia'); ?></p>
                        </div>
                    </div>

                    <div class="variety-news-details-page-div">
                        <h2><?php the_title(); ?></h2>
                        <div class="variety-write-social_wrapper">
                            <div class="variety-writer-div">
                                <p>By <?php the_author(); ?></p>
                            </div>
                            <div class="social-container" id="socialContainer">
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $post_url; ?>" target="_blank" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                                <a href="https://twitter.com/intent/tweet?url=<?php echo $post_url; ?>&text=<?php echo $post_title; ?>" target="_blank" class="social-icon"><i class="fab fa-twitter"></i></a>
                                <a href="https://www.tumblr.com/widgets/share/tool?canonicalUrl=<?php echo $post_url; ?>&title=<?php echo $post_title; ?>&caption=<?php echo $post_desc; ?>" target="_blank" class="social-icon"><i class="fa-brands fa-tumblr"></i></a>
                                <a href="https://www.reddit.com/submit?url=<?php echo $post_url; ?>&title=<?php echo $post_title; ?>" target="_blank" class="social-icon"><i class="fa-brands fa-reddit-alien"></i></a>
                                <a href="https://pinterest.com/pin/create/button/?url=<?php echo $post_url; ?>&media=<?php echo $post_image; ?>&description=<?php echo $post_desc; ?>" target="_blank" class="social-icon"><i class="fab fa-pinterest-p"></i></a>
                                <div class="more-icons" id="moreIcons">
                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo $post_url; ?>" target="_blank" class="social-icon"><i class="fab fa-linkedin-in"></i></a>
                                    <a href="https://api.whatsapp.com/send?text=<?php echo $post_title . '%20-%20' . $post_desc . '%20' . $post_url; ?>" target="_blank" class="social-icon"><i class="fa-brands fa-whatsapp"></i></a>
                                    <a href="mailto:?subject=<?php echo $post_title; ?>&body=<?php echo $post_desc . '%0A' . $post_url; ?>" target="_blank" class="social-icon"><i class="fa-solid fa-envelope"></i></a>
                                    <a href="javascript:window.print()" class="social-icon"><i class="fa-solid fa-print"></i></a>
                                </div>
                                <span class="social-toggle-btn" onclick="toggleIcons()">⋯</span>
                            </div>
                        </div>

                        <div class="variety-news-content">
                            <?php if (has_post_thumbnail()) : ?>
                                <figure>
                                    <?php the_post_thumbnail('large', ['class' => 'img-fluid']); ?>
                                    <figcaption><?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?></figcaption>
                                </figure>
                            <?php endif; ?>
                            <?php the_content(); ?>
                        </div>

                        <!-- this is join subbription form-->

                        <div class="loveandfilm-wrapper" data-observed="true">
                            <div class="loveandfilm-wrappe_overlay"></div>
                            <div class="box-shadow-join">
                                <div class="imglove">
                                    <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id($id)); ?>" alt="">
                                </div>
                                <div class="love-flim-form">
                                    <form id="observer-subscribe-form-<?php echo $id; ?>" name="observer-subscribe-form" class="observer-subscribe-form">
                                        <p class="d-none js-errors-subscribe"></p>
                                        <p class="js-msg-subscribe d-none"></p>

                                        <div class="variety-love-input-wrap">
                                            <h2>Love Film &amp; TV?</h2>
                                            <p>Get your daily dose of everything happening in music, film and TV in Australia and abroad. </p>
                                            <div class="variety-join-frm-end">
                                                <input type="hidden" name="listid" id="listid" value="">
                                                <input type="email" name="emailjoin" id="emailjoin" class="observer-sub-email" placeholder="Your email" required>
                                                <div class="submit-wrap">
                                                    <button type="submit" name="subscribe" class="button btn btn-join btn-primary">Join</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                        <?php
                        $post_tags = get_the_tags();
                        if ($post_tags) : ?>
                            <div class="variety-readmore">
                                <h4>Read More About:</h4>
                                <p>
                                    <?php
                                    $tag_links = [];
                                    foreach ($post_tags as $tag) {
                                        $tag_links[] = '<a href="' . esc_url(get_tag_link($tag->term_id)) . '">' . esc_html($tag->name) . '</a>';
                                    }
                                    echo implode(', ', $tag_links);
                                    ?>
                                </p>
                            </div>
                        <?php endif; ?>

                    </div>

                </div>
            </div>
            <!-- this is sidebar-->
            <div class="most-popular col-lg-3 col-md-12 col-sm-12">
                <div class="most-popular-section listing">
                    <h2>Most Popular</h2>
                    <div class="popular-list">
                        <?php display_category_wise_popular_posts(); ?>
                    </div>

                </div>

                <div class="newsletter-devider">
                    <div class="newsletter-bar">
                        <div class="newsletter-content">
                            <span class="newsletter-text">Sign Up for Variety Newsletters</span>
                            <form id="custom-cfdb71-form-<?php echo  $id; ?>" class="signup-form-data">
                                <div class="news-letters-wrap">
                                    <input type="email" id="emailn" name="emailn" class="newsletter-input" placeholder="Enter your email address" required>
                                    <input type="hidden" id="newssss" name="news" value="">
                                    <button type="submit" class="newsletter-button"><span class="form-responsed">SIGN UP</span>
                                        <i class="fa-solid fa-arrow-right"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="must-read">
                    <div class="most-popular-section listing">
                        <h2>Must Read</h2>
                        <?php display_random_category_posts(); ?>

                    </div>
                </div>
            </div>
            <!-- end-->
            </div>


            <?php
            $output .= ob_get_clean();
        }
        wp_reset_postdata();
    }

    return $output;
}


//end


//this is most popular function code 

function display_category_wise_popular_posts($posts_per_category = 3)
{
    // Get all categories
    $categories = get_categories();

    foreach ($categories as $category) {
        // Get posts in the category ordered by popularity (comment count)
        $posts = get_posts(array(
            'numberposts' => $posts_per_category,
            'category'    => $category->term_id,
            'post_status' => 'publish',
            'orderby'     => 'comment_count', // popularity basis
            'order'       => 'DESC'
        ));

        if (!empty($posts)) {
            $index = 0;
            foreach ($posts as $post) {
                setup_postdata($post);
                $image_url = get_the_post_thumbnail_url($post->ID, 'medium');

                $image_id = get_post_thumbnail_id($post->ID);
                $alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', true);

                if ($index == 0) {
            ?>
                    <a href="<?php echo esc_url(get_permalink($post)); ?>" class="popular-item">
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo $alt_text; ?>">
                        <p><?php echo esc_html(get_the_title($post)); ?></p>
                    </a>
                <?php } else { ?>

                    <a href="<?php echo esc_url(get_permalink($post)); ?>" class="popular-item">
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo $alt_text; ?>"
                            alt="webp">
                        <div class="variety_must-read_cnt">
                            <span class="d-block">Film</span>
                            <p><?php echo esc_html(get_the_title($post)); ?></p>
                        </div>
                    </a>

            <?php
                }
                $index++;
            }
            // echo '</div>';
        }
    }
    wp_reset_postdata();
}
//end


//this is display_random_category_posts function code 

function display_random_category_posts($max_categories = 5)
{

    $categories = get_categories(array(
        'orderby'    => 'rand',
        'number'     => $max_categories,
        'hide_empty' => true,
    ));

    $index = 0;

    foreach ($categories as $category) {
        // Get one random post from this category
        $posts = get_posts(array(
            'posts_per_page' => 1,
            'category'       => $category->term_id,
            'orderby'        => 'rand',
            'post_status'    => 'publish',
        ));

        if (!empty($posts)) {
            foreach ($posts as $post) {
                setup_postdata($post);
                $image_url = get_the_post_thumbnail_url($post->ID, 'medium');
                $title     = get_the_title($post);
                $permalink = get_permalink($post);

                if ($index === 0) {
                    // Featured post layout
                    echo '<a href="' . esc_url($permalink) . '" class="must-wrap">';
                    echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($title) . '">';
                    echo '<p>' . esc_html($title) . '</p>';
                    echo '</a>';
                } else {
                    // Secondary posts layout
                    echo '<div class="popular-list">';
                    echo '<a href="' . esc_url($permalink) . '" class="popular-item">';
                    echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($title) . '">';
                    echo '<div class="variety_must-read_cnt">';
                    echo '<span class="d-block">' . esc_html($category->name) . '</span>';
                    echo '<p>' . esc_html($title) . '</p>';
                    echo '</div>';
                    echo '</a>';
                    echo '</div>';
                }

                $index++;
            }
        }
    }

    wp_reset_postdata();
}

//end





// this is list searching code

function custom_news_enqueue_scripts()
{
    wp_enqueue_script('custom-news-search', get_template_directory_uri() . '/js/news-search.js?v=' . time() . '', array('jquery'), null, true);

    wp_localize_script('custom-news-search', 'newsSearchAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
    ));
}
add_action('wp_enqueue_scripts', 'custom_news_enqueue_scripts');

function title_only_search($search, $wp_query)
{
    global $wpdb;

    // Skip for admin or no search term
    if (is_admin() || !$wp_query->is_main_query() || !$wp_query->get('s')) {
        return $search;
    }

    $search_term = $wp_query->get('s');

    // Match as whole word using REGEXP
    $search = " AND {$wpdb->posts}.post_title REGEXP '[[:<:]]" . esc_sql($search_term) . "[[:>:]]' ";

    return $search;
}


// functions.php
function custom_news_search_shortcode()
{
    $search_query = isset($_GET['q']) ? sanitize_text_field($_GET['q']) : '';
    ob_start();

    // Add the filter locally
    add_filter('posts_search', 'title_only_search', 10, 2);

    $args = array(
        'post_type'      => 'post',
        's'              => $search_query,
        'post_status'    => 'publish',
        'posts_per_page' => 10,
        'paged'          => get_query_var('paged') ? get_query_var('paged') : 1,
    );

    $query = new WP_Query($args);

    // Remove the filter after query is executed
    remove_filter('posts_search', 'title_only_search', 10);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $id = get_the_ID();
            $title = get_the_title();
            $permalink = get_the_permalink();
            $featimg = wp_get_attachment_url(get_post_thumbnail_id($id));

            $image_id = get_post_thumbnail_id($id);
            $alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', true);
            $categories = get_the_category($id);
            $category_name = !empty($categories) ? esc_html($categories[0]->name) : 'Uncategorized';
            ?>
            <a href="<?php echo $permalink; ?>" class="news-inform-wrap">
                <div class="news-img">
                    <img src="<?php echo $featimg; ?>" alt="<?php echo $alt_text; ?>" class="img-fluid">
                </div>
                <div class="news-cnt">
                    <div class="first-cnt">
                        <p><?php echo $category_name; ?></p>
                        <span>|</span>
                        <p>4 minutes</p>
                    </div>
                    <h2><?php echo $title; ?></h2>
                </div>
            </a>
        <?php
        }
    }

    $output = ob_get_clean();
    echo $output;
}
add_shortcode('news_search_form', 'custom_news_search_shortcode');



// functions.php
function ajax_search_news_posts()
{


    $search = isset($_POST['search']) ? sanitize_text_field($_POST['search']) : '';

    $args = array(
        'post_type' => 'post', // change to 'news' if you have a custom post type
        'posts_per_page' => 7,
        's' => $search,
        'orderby' => 'date',
        'order' => 'DESC'
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) : $query->the_post(); ?>
            <a href="<?php the_permalink(); ?>" class="news-inform-wrap">
                <div class="news-img">
                    <?php the_post_thumbnail('medium', ['class' => 'img-fluid']); ?>
                </div>
                <div class="news-cnt">
                    <div class="first-cnt">
                        <p><?php echo get_post_type(); ?></p>
                        <span>|</span>
                        <p><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></p>
                    </div>
                    <h2><?php the_title(); ?></h2>
                </div>
            </a>
        <?php endwhile;
        wp_reset_postdata();
    } else {
        echo '<p class="no-data-found">No news found.</p>';
    }

    wp_die();
}
add_action('wp_ajax_search_news_posts', 'ajax_search_news_posts');
add_action('wp_ajax_nopriv_search_news_posts', 'ajax_search_news_posts');

//end





// this iswhattowatch_variety_latest_posts_function  shortcode
function whattowatch_variety_latest_posts_function($atts)
{
    extract(shortcode_atts(array(
        "numberposts" => 3
    ), $atts));

    $posts = get_posts(array('numberposts' => $numberposts));
    ob_start();
    $index = 0;
    foreach ($posts as $post) {
        setup_postdata($post);
        // Get category name
        $categories = get_the_category($post->ID);
        $category_name = !empty($categories) ? esc_html($categories[0]->name) : 'Uncategorized';
        // Human readable time
        $publish_timestamp = get_the_time('U', $post->ID);
        $human_time = custom_human_time_diff($publish_timestamp);
        // Get thumbnail
        $thumbnail_url = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
        // Get post excerpt
        $excerpt = $post->post_excerpt ? $post->post_excerpt : wp_trim_words($post->post_content, 20);
        $image_id = get_post_thumbnail_id($post->ID);
        $alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', true);
        if ($index === 0) {
            // First post - special story-wrap layout
        ?>

            <div class="variety-wrap">
                <h2>Variety Recommends</h2>
                <p>Get stuck in with Variety's top picks this month.</p>

                <a href="<?php echo get_permalink($post); ?>" class="variety-box">
                    <div class="variety-img">
                        <img src="<?php echo esc_url($thumbnail_url); ?>"
                            alt="<?php echo $alt_text; ?>" class="img-fluid">
                    </div>
                    <div class="variety-cnt">
                        <span><?php echo esc_html($category_name); ?></span>
                        <h2><?php echo esc_html($post->post_title); ?></h2>
                        <p><?php echo esc_html($excerpt); ?></p>
                    </div>
                </a>
            </div>

        <?php
        } else {
        ?>

            <div class="variety-blog-wrap">
                <a href="<?php echo get_permalink($post); ?>" class="variety-blog-new">
                    <div class="blog-img">
                        <img src="<?php echo esc_url($thumbnail_url); ?>"
                            alt="<?php echo $alt_text; ?>" class="img-fluid">
                    </div>
                    <div class="blog-cnt">
                        <span><?php echo esc_html($category_name); ?></span>
                        <h5><?php echo esc_html($post->post_title); ?></h5>
                        <p><?php echo esc_html($excerpt); ?></p>
                    </div>
                </a>
            </div>

        <?php
        }

        $index++;
    }
    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('watch_variety_latest_posts_function', 'whattowatch_variety_latest_posts_function');


// this movies shortcode
function variety_movie_slider_shortcode($atts)
{
    extract(shortcode_atts(array(
        'numberposts' => 10, // default number of posts
    ), $atts));

    $posts = get_posts(array(
        'numberposts' => $numberposts,
        'post_type' => 'post',
        'orderby' => 'date',
        'order' => 'DESC',
        'post_status' => 'publish'
    ));

    ob_start();

    foreach ($posts as $post) {
        setup_postdata($post);

        $title = get_the_title($post);
        $permalink = get_permalink($post);
        $thumbnail = get_the_post_thumbnail_url($post->ID, 'medium');
        $image_id = get_post_thumbnail_id($post->ID);
        $alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', true);
        ?>
        <div class="swiper-slide">
            <div class="movie-box-wrap">
                <div class="slide-img">
                    <img src="<?php echo esc_url($thumbnail); ?>"
                        alt="<?php echo $alt_text; ?>" class="img-fluid">
                </div>
                <a href="<?php echo esc_url($permalink); ?>" class="slide-cnt">
                    <h5><?php echo esc_html($title); ?></h5>
                    <div class="music-wrap">
                        <p>WATCH</p>
                        <i class="fa-regular fa-circle-play"></i>
                    </div>
                </a>
            </div>
        </div>

    <?php
    }

    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('variety_movie_slider', 'variety_movie_slider_shortcode');
//end

//this is seriese shortcode

function variety_series_slider_shortcode($atts)
{
    extract(shortcode_atts(array(
        'numberposts' => 15, // default number of posts
    ), $atts));

    $posts = get_posts(array(
        'numberposts' => $numberposts,
        'post_type' => 'post',
        'orderby' => 'date',
        'order' => 'ASC',
        'post_status' => 'publish'
    ));

    ob_start();

    foreach ($posts as $post) {
        setup_postdata($post);

        $title = get_the_title($post);
        $permalink = get_permalink($post);
        $thumbnail = get_the_post_thumbnail_url($post->ID, 'medium');

    ?>
        <div class="swiper-slide">
            <div class="movie-box-wrap series-box-wrap">
                <div class="slide-img">
                    <img src="<?php echo esc_url($thumbnail); ?>"
                        alt="<?php echo esc_attr($title); ?>" class="img-fluid">
                </div>
                <a href="<?php echo esc_url($permalink); ?>" class="slide-cnt">
                    <h5><?php echo esc_html($title); ?></h5>
                    <div class="music-wrap">
                        <p>WATCH</p>
                        <i class="fa-regular fa-circle-play"></i>
                    </div>
                </a>
            </div>
        </div>

    <?php
    }

    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('series_slider_shortcode', 'variety_series_slider_shortcode');
//end



// this is newsletter code
function enqueue_custom_ajax_script()
{
    wp_enqueue_script('custom-ajax-js', get_template_directory_uri() . '/js/custom-ajax.js?v=' . time() . '', array('jquery'), null, true);
    wp_localize_script('custom-ajax-js', 'my_ajax_object', array(
        'ajax_url' => admin_url('admin-ajax.php')
    ));
}
add_action('wp_enqueue_scripts', 'enqueue_custom_ajax_script');


add_action('wp_ajax_insert_cfdb7_email', 'insert_cfdb7_email');
add_action('wp_ajax_nopriv_insert_cfdb7_email', 'insert_cfdb7_email');


function insert_cfdb7_email()
{
    global $wpdb;
    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $news = isset($_POST['news']) ? sanitize_email($_POST['news']) : '';

    //echo $email."sfkjsfks".$news;

    if (empty($news)):
        if (!is_email($email)) {
            wp_send_json('Invalid email address!');
        }
        $table_name = $wpdb->prefix . 'db7_forms';
        $form_id = 391;

        $form_data = serialize([
            'cfdb7_status' => 'unread',
            'email' => $email
        ]);
        $inserted = $wpdb->insert(
            $table_name,
            [
                'form_post_id' => $form_id,
                'form_value'   => $form_data,
                'form_date'    => current_time('mysql')
            ]
        );

        if ($inserted) {
            wp_send_json('Subscription Successful!');
        } else {
            wp_send_json('Insert failed. Error: ' . $wpdb->last_error);
        }
        wp_die();
    endif;
}
//end


//this is ads shortcode

function varietyads_shortcode($atts)
{
    ob_start();
    // Parse shortcode attributes
    $atts = shortcode_atts(array(
        'posts_per_page' => 5,
    ), $atts);
    // WP Query
    $query = new WP_Query(array(
        'post_type'      => 'varietyads',
        'posts_per_page' => $atts['posts_per_page'],
        'post_status'    => 'publish',
    ));
    if ($query->have_posts()) {
        echo '<div class="varietyads-list">';
        while ($query->have_posts()) {
            $query->the_post();
            // Get image URL
            $image_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
            echo '<div class="varietyads-item">';
            if ($image_url) {
                echo '<div class="thumb">';
                echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr(get_the_title()) . '" class="img-fluid" />';
                echo '</div>';
            }
            // Post title with link
            //echo '<h3><a href="' . get_permalink() . '">' . get_the_title() . '</a></h3>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo '<p>No ads found.</p>';
    }
    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('varietyads_list', 'varietyads_shortcode');
//end

function custom_human_time_diff($from)
{
    $now = time();
    $diff = $now - $from;

    if ($diff < HOUR_IN_SECONDS) {
        $minutes = ceil($diff / MINUTE_IN_SECONDS);
        return "$minutes minute" . ($minutes > 1 ? 's' : '');
    } elseif ($diff < DAY_IN_SECONDS) {
        $hours = ceil($diff / HOUR_IN_SECONDS);
        return "$hours hour" . ($hours > 1 ? 's' : '');
    } elseif ($diff < WEEK_IN_SECONDS) {
        $days = ceil($diff / DAY_IN_SECONDS);
        return "$days day" . ($days > 1 ? 's' : '');
    } elseif ($diff < MONTH_IN_SECONDS) {
        $weeks = ceil($diff / WEEK_IN_SECONDS);
        return "$weeks week" . ($weeks > 1 ? 's' : '');
    } else {
        $months = floor($diff / MONTH_IN_SECONDS);
        $years = floor($months / 12);
        $remaining_months = $months % 12;

        $result = [];
        if ($years > 0) {
            $result[] = "$years year" . ($years > 1 ? 's' : '');
        }
        if ($remaining_months > 0) {
            $result[] = "$remaining_months month" . ($remaining_months > 1 ? 's' : '');
        }

        return implode(' ', $result);
    }
}



// this is shore code
add_action('wp_head', 'add_twitter_card_meta');

function add_twitter_card_meta()
{
    if (is_single()) {
        global $post;

        $share_title = get_the_title($post->ID);
        $share_desc = get_the_excerpt($post->ID);
        $share_url = get_permalink($post->ID);
        $share_image = get_the_post_thumbnail_url($post->ID, 'full');

        // Optional: fallback image
        if (empty($share_image)) {
            $share_image = 'https://yourdomain.com/path-to-default-image.jpg'; // replace with a valid fallback
        }

    ?>
        <!-- Twitter Card Meta -->
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@YourTwitterHandle"> <!-- Optional -->
        <meta name="twitter:title" content="<?php echo esc_attr($share_title); ?>">
        <meta name="twitter:description" content="<?php echo esc_attr($share_desc); ?>">
        <meta name="twitter:image" content="<?php echo esc_url($share_image); ?>">
        <meta name="twitter:url" content="<?php echo esc_url($share_url); ?>">

        <meta property="og:type" content="article" />
        <meta property="og:title" content="<?php echo esc_attr($share_title); ?>" />
        <meta property="og:description" content="<?php echo esc_attr($share_desc); ?>" />
        <meta property="og:url" content="<?php echo esc_url($share_url); ?>" />
        <meta property="og:image" content="<?php echo esc_url($share_image); ?>" />
        <meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>" />


        <?php
    }
}

//end


// this is recommended category post type shortcode

function recommended_category_posts_shortcode1111($atts)
{
    ob_start();
    $atts = shortcode_atts(array(
        'max' => 10,
    ), $atts, 'random_category_posts');

    $max_categories = intval($atts['max']);

    // Get random categories
    $categories = get_categories(array(
        'orderby'    => 'rand',
        'number'     => $max_categories,
        'hide_empty' => true,
    ));

    foreach ($categories as $category) {
        // Get one random post from this category
        $posts = get_posts(array(
            'posts_per_page' => 1,
            'category'       => $category->term_id,
            'orderby'        => 'rand',
            'post_status'    => 'publish',
        ));





        if (!empty($posts)) {
            foreach ($posts as $post) {
                setup_postdata($post);
                $image_url = get_the_post_thumbnail_url($post->ID, 'medium');
                $title     = get_the_title($post);
                $permalink = get_permalink($post);

                // Your required HTML
        ?>
                <div class="recommend-cards">
                    <a href="<?php echo esc_url($permalink); ?>">
                        <img src="<?php echo esc_url($image_url); ?>"
                            alt="<?php echo esc_attr($title); ?>"
                            width="160" height="106" />
                    </a>
                    <div class="recommend-cnt-wrap">
                        <h2 class="recommend-cat">
                            <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>">
                                <?php echo esc_html($category->name); ?>
                            </a>
                        </h2>
                        <h2 class="recommend-title">
                            <a href="<?php echo esc_url($permalink); ?>">
                                <?php echo esc_html($title); ?>
                            </a>
                        </h2>
                    </div>
                </div>
            <?php
            }
        }
    }

    wp_reset_postdata();

    return ob_get_clean();
}
add_shortcode('recommended_category', 'recommended_category_posts_shortcode');


function variety_recommended_posts_($atts)
{
    ob_start();
    $atts = shortcode_atts(array(
        'tag'   => '',  // tag name
        'posts' => 6,   // number of posts
    ), $atts, 'tag_posts');

    if (empty($atts['tag'])) {
        return '<p>No tag provided.</p>';
    }
    $args = array(
        'posts_per_page'    => intval($atts['posts']),
        'post_status'       => 'publish',
        'orderby'           => 'date',
        'order'             => 'DESC',
        'ignore_sticky_posts' => 1,
        'tax_query' => array(
            array(
                'taxonomy' => 'post_tag',
                'field'    => 'name',  // match by tag name
                'terms'    => array(sanitize_text_field($atts['tag'])),
            ),
        ),
    );
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            $title   = get_the_title();
            $link    = get_permalink();
            $excerpt = wp_trim_words(get_the_excerpt(), 20);
            $author  = get_the_author();
            $image   = get_the_post_thumbnail_url(get_the_ID(), 'medium');
            $categories = get_the_category();
            $category_name = !empty($categories) ? $categories[0]->name : 'Uncategorized';
            $cat_link = !empty($categories) ? get_category_link($categories[0]->term_id) : '#';

            ?>

            <div class="recommend-cards">
                <a href="<?php echo esc_url($link); ?>">
                    <img src="<?php echo esc_url($image); ?>"
                        alt="<?php echo esc_attr($title); ?>"
                        width="160" height="106" />
                </a>
                <div class="recommend-cnt-wrap">
                    <h2 class="recommend-cat">
                        <a href="<?php echo esc_url($cat_link); ?>">
                            <?php echo esc_html($category_name); ?>
                        </a>
                    </h2>
                    <h2 class="recommend-title">
                        <a href="<?php echo esc_url($permalink); ?>">
                            <?php echo esc_html($title); ?>
                        </a>
                    </h2>
                </div>
            </div>
            <?php
        }
    }

    wp_reset_postdata();

    return ob_get_clean();
}
add_shortcode('recommended_tags_post', 'variety_recommended_posts_');
//end

// this shortcode is what to here

function what_to_hear_posts_shortcode($atts)
{
    ob_start();

    $atts = shortcode_atts(array(
        'category' => 'what-to-hear',
        'posts'    => 5, // total posts to fetch
    ), $atts, 'what_to_hear_posts');

    $args = array(
        'posts_per_page'    => intval($atts['posts']),
        'post_status'       => 'publish',
        'category_name'     => sanitize_text_field($atts['category']),
        'orderby'           => 'date',
        'order'             => 'DESC',
        'ignore_sticky_posts' => 1,
        'tax_query' => array(
            array(
                'taxonomy' => 'post_tag',
                'operator' => 'NOT EXISTS', // Exclude posts with any tags
            ),
        ),
    );

    $query = new WP_Query($args);
    //print_r($query);

    if ($query->have_posts()) {
        $index = 0;

        echo '<div class="banner-section">';
        while ($query->have_posts()) {
            $query->the_post();
            if (get_the_tags()) {
                continue;
            }

            $title   = get_the_title();
            $link    = get_permalink();
            $excerpt = wp_trim_words(get_the_excerpt(), 20);
            //$author  = get_the_author();
            $image   = get_the_post_thumbnail_url(get_the_ID(), 'large');

            if (!empty(get_the_author())) {
                $author = get_the_author();
            } else {
                $author = "Courtesy Son";
            }

            // First Post -> Banner Box
            if ($index === 0) { ?>
                <div class="banner-box">
                    <div class="container py-5">
                        <div class="row m-design">
                            <div class="col-lg-6 col-md-6 p-0">
                                <div class="banner-cnt">
                                    <h2><a href="<?php echo esc_url($link); ?>"><?php echo esc_html($title); ?></a></h2>
                                    <p><?php echo esc_html($excerpt); ?></p>
                                    <span><a href="#"><?php echo esc_html($author); ?></a></span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 p-0">
                                <a href="<?php echo esc_url($link); ?>" class="banner-img">
                                    <?php if ($image): ?>
                                        <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>" class="img-fluid">
                                    <?php endif; ?>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            } else {
                // Start Film Details Grid after the first post
                if ($index === 1) {
                    echo '<div class="film-details"><div class="container py-5"><div class="row">';
                }
            ?>
                <div class="col-lg-3 col-md-3 border-right">
                    <div class="details-box">
                        <a href="<?php echo esc_url($link); ?>">
                            <?php if ($image): ?>
                                <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>" class="img-fluid">
                            <?php endif; ?>
                            <h3><?php echo esc_html($title); ?></h3>
                        </a>
                        <p><?php echo esc_html($excerpt); ?></p>
                    </div>
                </div>
            <?php
            }
            $index++;
        }

        // Close film-details row and container
        if ($index > 1) {
            echo '</div></div></div>';
        }

        echo '</div>'; // end banner-section
    }
    wp_reset_postdata();

    return ob_get_clean();
}
add_shortcode('what_to_hear_posts', 'what_to_hear_posts_shortcode');


//end

// this what to watch varriety recommonded audible custom post type
function whattowatch_variety_recommented_tags($atts)
{
    ob_start();
    $atts = shortcode_atts(array(
        'tag'   => '',  // tag name
        'posts' => 6,   // number of posts
    ), $atts, 'tag_posts');

    if (empty($atts['tag'])) {
        return '<p>No tag provided.</p>';
    }

    $args = array(
        'posts_per_page'    => intval($atts['posts']),
        'post_status'       => 'publish',
        'orderby'           => 'date',
        'order'             => 'DESC',
        'ignore_sticky_posts' => 1,
        'tax_query' => array(
            array(
                'taxonomy' => 'post_tag',
                'field'    => 'name',  // match by tag name
                'terms'    => array(sanitize_text_field($atts['tag'])),
            ),
        ),
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            // $title   = get_the_title();
            $title = wp_trim_words(get_the_title(), 10, '');
            $link    = get_permalink();
            $excerpt = wp_trim_words(get_the_excerpt(), 20);
            $author  = get_the_author();
            $image   = get_the_post_thumbnail_url(get_the_ID(), 'medium');

            ?>
            <div class="swiper-slide audio-slider">
                <div class="details-box">
                    <a href="<?php echo esc_url($link); ?>">
                        <?php if ($image): ?>
                            <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>" class="img-fluid">
                        <?php endif; ?>
                        <h3><?php echo esc_html($title); ?></h3>
                    </a>
                    <p><?php echo esc_html($excerpt); ?></p>
                    <span>By <?php echo esc_html($author); ?></span>
                </div>
            </div>
        <?php
        }
    }

    wp_reset_postdata();

    return ob_get_clean();
}
add_shortcode('audiobooks_recommented_tags', 'whattowatch_variety_recommented_tags');

//end

// This is Trending post type short code

function trending_variety_recommented_tags($atts)
{
    ob_start();
    $atts = shortcode_atts(array(
        'tag'   => '',  // tag name
        'posts' => 6,   // number of posts
    ), $atts, 'tag_posts');

    if (empty($atts['tag'])) {
        return '<p>No tag provided.</p>';
    }
    $args = array(
        'posts_per_page'    => intval($atts['posts']),
        'post_status'       => 'publish',
        'orderby'           => 'date',
        'order'             => 'DESC',
        'ignore_sticky_posts' => 1,
        'tax_query' => array(
            array(
                'taxonomy' => 'post_tag',
                'field'    => 'name',  // match by tag name
                'terms'    => array(sanitize_text_field($atts['tag'])),
            ),
        ),
    );
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            $title   = get_the_title();
            $link    = get_permalink();
            $excerpt = wp_trim_words(get_the_excerpt(), 20);
            $author  = get_the_author();
            $image   = get_the_post_thumbnail_url(get_the_ID(), 'medium');

            $categories = get_the_category();
            $category_name = !empty($categories) ? $categories[0]->name : 'Uncategorized';

        ?>


            <div class="podcast-card">
                <a href="<?php echo esc_url($link); ?>">
                    <?php if ($image): ?>
                        <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>" class="img-fluid">
                    <?php endif; ?>
                </a>
                <div class="podcast-info">
                    <a href="#">
                        <span class="category"><?php echo $category_name; ?></span>
                        <div class="podcast-title"><?php echo esc_html($title); ?></div>
                    </a>
                    <p class="podcast-description"><?php echo esc_html($excerpt); ?></p>
                </div>
            </div>
        <?php
        }
    }

    wp_reset_postdata();

    return ob_get_clean();
}
add_shortcode('trending_recommented_tags', 'trending_variety_recommented_tags');

//end

// this is podcasts_category_shortcode short code
function podcasts_category_shortcode($atts)
{
    ob_start();

    $atts = shortcode_atts(array(
        'posts' => 5, // number of posts to show
    ), $atts, 'podcasts_category');

    $args = array(
        'posts_per_page'    => intval($atts['posts']),
        'post_status'       => 'publish',
        'orderby'           => 'date',
        'order'             => 'DESC',
        'ignore_sticky_posts' => 1,
        'category_name'     => 'Podcasts', // only fetch "Podcasts" category
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            $title   = get_the_title();
            $excerpt = wp_trim_words(get_the_excerpt(), 25);
            $link    = get_permalink();
            $image   = get_the_post_thumbnail_url(get_the_ID(), 'medium');
        ?>
            <div class="podcast-news-item">
                <?php if ($image): ?>
                    <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>">
                <?php endif; ?>
                <div class="podcast-news-content">
                    <h3><?php echo esc_html($title); ?></h3>
                    <p><?php echo esc_html($excerpt); ?></p>
                    <a href="<?php echo esc_url($link); ?>">SUBSCRIBE</a>
                </div>
            </div>
        <?php
        }
    } else {
        echo '<p>No podcasts found.</p>';
    }

    wp_reset_postdata();

    return ob_get_clean();
}
add_shortcode('what_to_here_podcasts_category', 'podcasts_category_shortcode');

//end


// this is podcasts_category_shortcode short code
function music_category_shortcode($atts)
{
    ob_start();

    $atts = shortcode_atts(array(
        'posts' => 5, // number of posts to show
    ), $atts, 'podcasts_category');

    $args = array(
        'posts_per_page'    => intval($atts['posts']),
        'post_status'       => 'publish',
        'orderby'           => 'date',
        'order'             => 'DESC',
        'ignore_sticky_posts' => 1,
        'category_name'     => 'music/album-reviews', // only fetch "Podcasts" category
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            // $title   = get_the_title();
            $title = wp_trim_words(get_the_title(), 10, '');
            $excerpt = wp_trim_words(get_the_excerpt(), 10);
            $link    = get_permalink();
            $image   = get_the_post_thumbnail_url(get_the_ID(), 'medium');
            $review_name = get_post_meta(get_the_ID(), 'review_name', true);
            if (!empty($review_name)) {
                $reviewname = $review_name;
            } else {
                $reviewname = "Courtesy Son";
            }
        ?>


            <div class="album-card">
                <a href="<?php echo esc_url($link); ?>">
                    <?php if ($image): ?>
                        <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>">
                    <?php endif; ?>
                    <h3><?php echo $reviewname; ?></h3>
                </a>
                <a href="<?php echo esc_url($link); ?>">
                    <div class="album-meta"><?php echo esc_html($title); ?></div>
                </a>
                <p><?php echo esc_html($excerpt); ?></p>
            </div>
        <?php
        }
    } else {
        echo '<p>No podcasts found.</p>';
    }

    wp_reset_postdata();

    return ob_get_clean();
}
add_shortcode('what_to_here_music_category', 'music_category_shortcode');

//end


// this is what to here all post

// Shortcode: [podcast_cards count="6"]

function what_to_hear_news($atts)
{
    ob_start();

    $atts = shortcode_atts(array(
        "posts_per_page" => 10,  // how many posts per page
        "category"       => '',  // category slug or ID
        "nextlabel" => "More What To Hear News"
    ), $atts, 'whattohear_news');

    // ✅ Handle pagination for shortcodes (works inside Pages too)
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    if (get_query_var('page')) {
        $paged = get_query_var('page');
    }

    $args = array(
        'post_type'      => 'post',   // ✅ only blog posts
        'posts_per_page' => intval($atts['posts_per_page']),
        'orderby'        => 'date',
        'order'          => 'DESC',
        'paged'          => $paged,
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            $title    = get_the_title();
            $link     = get_permalink();
            $excerpt  = wp_trim_words(get_the_excerpt(), 20);
            $image    = get_the_post_thumbnail_url(get_the_ID(), 'medium');
            $cats     = get_the_category();
            $cat_name = !empty($cats) ? $cats[0]->name : '';
        ?>

            <div class="podcast-card">
                <a href="<?php echo esc_url($link); ?>">
                    <?php if ($image): ?>
                        <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>">
                    <?php endif; ?>
                </a>
                <div class="podcast-info">
                    <a href="<?php echo esc_url($link); ?>">
                        <?php if ($cat_name): ?>
                            <span class="category"><?php echo esc_html($cat_name); ?></span>
                        <?php endif; ?>
                        <div class="podcast-title"><?php echo esc_html($title); ?></div>
                    </a>
                    <p class="podcast-description"><?php echo esc_html($excerpt); ?></p>
                </div>
            </div>

        <?php
        } ?>

        <div class="pagination-buttons">
            <?php if ($paged > 1) : ?>
                <a class="newsletter-button prev" href="<?php echo esc_url(get_pagenum_link($paged - 1)); ?>">
                    <i class="fa-solid fa-arrow-left"></i><span>Previous</span>
                </a>
            <?php endif; ?>

            <?php if ($paged < $query->max_num_pages) : ?>
                <?php if ($paged >= 2): ?>
                    <a class="newsletter-button next-btn" href="<?php echo esc_url(get_pagenum_link($paged + 1)); ?>">
                        <span>Next</span> <i class="fa-solid fa-arrow-right"></i>
                    </a>
                <?php else: ?>
                    <a class="newsletter-button next next-btn" href="<?php echo esc_url(get_pagenum_link($paged + 1)); ?>">
                        <span><?php echo $atts['nextlabel']; ?></span> <i class="fa-solid fa-arrow-right"></i>
                    </a>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <?php

    } else {
        echo '<p>No posts found.</p>';
    }

    wp_reset_postdata();

    return ob_get_clean();
}
add_shortcode('whattohear_news', 'what_to_hear_news');


//end


// this is brand shortcode
function brand_variety_recommented_tags($atts)
{
    ob_start();
    $atts = shortcode_atts(array(
        'tag'   => '',  // tag name
        'posts' => 6,   // number of posts
    ), $atts, 'tag_posts');

    if (empty($atts['tag'])) {
        return '<p>No tag provided.</p>';
    }
    $args = array(
        'posts_per_page'    => intval($atts['posts']),
        'post_status'       => 'publish',
        'orderby'           => 'date',
        'order'             => 'DESC',
        'ignore_sticky_posts' => 1,
        'tax_query' => array(
            array(
                'taxonomy' => 'post_tag',
                'field'    => 'name',  // match by tag name
                'terms'    => array(sanitize_text_field($atts['tag'])),
            ),
        ),
    );
    $query = new WP_Query($args);

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            $title   = get_the_title();
            $link    = get_permalink();
            $excerpt = wp_trim_words(get_the_excerpt(), 20);
            $author  = get_the_author();
            $image   = get_the_post_thumbnail_url(get_the_ID(), 'medium');

            $categories = get_the_category();
            $category_name = !empty($categories) ? $categories[0]->name : 'Uncategorized';
            $cat_link = !empty($categories) ? get_category_link($categories[0]->term_id) : '#';

        ?>



            <div class="recommend-cards">
                <a href="<?php echo esc_url($link); ?>">
                    <?php if ($image): ?>
                        <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>" alt="<?php echo esc_attr($title); ?>" width="160" height="106">
                    <?php endif; ?>
                </a>
                <div class="recommend-cnt">
                    <h2 class="recommend-cat"><a href="<?php echo esc_url($cat_link); ?>"><?php echo $category_name; ?></a></h2>
                    <h2 class="recommend-title"><a href="<?php echo $link; ?>"><?php echo  $title; ?></a></h2>
                </div>
            </div>
    <?php
        }
    }

    wp_reset_postdata();

    return ob_get_clean();
}
add_shortcode('brand_recommented_tags', 'brand_variety_recommented_tags');

// this is reviws filter code

function reviews_tabs_scripts() {
    wp_enqueue_script('reviews-tabs', get_stylesheet_directory_uri() . '/js/reviews-tabs.js?v="'.time().'"', array('jquery'), null, true);
    wp_localize_script('reviews-tabs', 'reviews_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
    ));
}
add_action('wp_enqueue_scripts', 'reviews_tabs_scripts');


function reviews_tabs_shortcode() {
    ob_start();
    ?>
    <div class="reviews-category" id="reviews-tabs">
        <ul class="review-tabs-nav">
            <li class="active"><a href="film">Film</a></li>
            <li><a href="tv">TV</a></li>
            <li><a href="music">Music</a></li>
            <li><a href="tech">Tech</a></li>
        </ul>
   </div>

    <?php
    return ob_get_clean();
}
add_shortcode('reviews_tabs', 'reviews_tabs_shortcode');

// AJAX for loading category posts
function load_reviews_tab_posts() {
    $slug = sanitize_text_field($_POST['slug']);
     $category = get_category_by_slug($slug);
    if (!$category) {
        wp_send_json_error("Category not found");
    }
    $posts = get_posts(array(
        'posts_per_page' => 4,
        'category'       => $category->term_id,
        'post_status'    => 'publish'
    ));

    ob_start();
    foreach ($posts as $post) {
        setup_postdata($post);
        $image_url = get_the_post_thumbnail_url($post->ID, 'medium');

        if (!empty(get_the_author())) {
            $author = get_the_author();
        } else {
            $author = "Courtesy Son";
        }
        ?>

               <div class="reviews-cards">
                    <a href="<?php echo get_permalink($post->ID); ?>">
                        <?php if ($image_url): ?>
                            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr(get_the_title($post)); ?>" alt="<?php echo esc_attr(get_the_title($post)); ?>" width="255" height="170">
                        <?php endif; ?>
                        <h3></h3>
                    </a>

                    <div class="reviews-cnt">
                        <h2 class="review-cnt-subtitle"><?php echo $author;?></h2>
                        <h2 class="review-cnt-title"><a href="<?php echo get_permalink($post->ID); ?>"><?php echo esc_html(get_the_title($post)); ?></a></h2>
                        <p class="review-cnt-para"><?php echo wp_trim_words(get_the_excerpt($post), 20); ?></p>
                    </div>
                  </div>
        <?php
    }
    wp_reset_postdata();
    wp_send_json_success(ob_get_clean());
}
add_action('wp_ajax_load_reviews_tab_posts', 'load_reviews_tab_posts');
add_action('wp_ajax_nopriv_load_reviews_tab_posts', 'load_reviews_tab_posts');

//end

// this post is mutiple categories fetching
function get_variety_multiple_cat($atts)
{
    $atts = shortcode_atts(array(
        'category'    => '',  // category slugs, comma-separated
        'numberposts' => 5,   // total posts to fetch (1 with image + rest without)
    ), $atts, 'categorynews');
    if (empty($atts['category'])) {
        return '<p>No category defined.</p>';
    }
    $categories = array_map('trim', explode(',', $atts['category']));

    ob_start();
    foreach ($categories as $cat_slug) {
        $cat_obj = get_category_by_slug($cat_slug);
        if (!$cat_obj) {
            continue;
        }
        $posts = get_posts(array(
            'category_name'  => $cat_slug,
            'posts_per_page' => intval($atts['numberposts']),
        ));
        if (empty($posts)) {
            continue;
        }
    ?>
        <div class="categorynews-card">
            <h3><a href="<?php echo esc_url(get_category_link($cat_obj->term_id)); ?>">
                    <?php echo esc_html($cat_obj->name); ?>
                </a></h3>
            <div class="cate-inner-wrap">
                <?php
                $index = 0;
                foreach ($posts as $post) :
                    setup_postdata($post);
                    if ($index === 0) :
                        // First post with image
                        $thumbnail_url = get_the_post_thumbnail_url($post->ID, 'medium');
                ?>
                        <div class="categorynews-div">
                            <?php if ($thumbnail_url): ?>
                                <img class="img-fluid w-100" src="<?php echo esc_url($thumbnail_url); ?>" alt="<?php echo esc_attr(get_the_title($post)); ?>" width="191" height="170" />
                            <?php endif; ?>
                            <h2><a href="<?php echo get_permalink($post); ?>"><?php echo esc_html(get_the_title($post)); ?></a></h2>
                        </div>
                        <div class="category-without-img-wrapper">
                        <?php else : ?>
                            <!-- Other posts without image -->
                            <div class="categorynews-div">
                                <h2><a href="<?php echo get_permalink($post); ?>"><?php echo esc_html(get_the_title($post)); ?></a></h2>
                            </div>
                    <?php
                    endif;
                    $index++;
                endforeach;
                    ?>
                        </div><!-- .category-without-img-wrapper -->
            </div>
        </div>
        <?php
        wp_reset_postdata();
    }

    return ob_get_clean();
}
add_shortcode('categorynews', 'get_variety_multiple_cat');


//end


// this  featured cart shortcode

function actors_cards_featured($atts)
{

    $atts = shortcode_atts(array(
        "numberposts" => -1,
        "category"    => '', // category slug
    ), $atts, 'actors_cards');

    $args = array(
        'numberposts' => $atts['numberposts'],
        'orderby'     => 'modified', // ✅ order by updated time
        'order'       => 'DESC',
    );

    if (!empty($atts['category'])) {
        if (is_numeric($atts['category'])) {
            // Category passed as ID
            $args['cat'] = intval($atts['category']);
        } else {
            // Handle nested slugs like "film/news"
            $slugs = explode('/', trim($atts['category'], '/'));
            $last_slug = end($slugs);

            $term = get_category_by_slug(sanitize_title($last_slug));
            if ($term) {
                $args['cat'] = $term->term_id; // Use term ID to query
            }
        }
    }

    if (!empty($term) && !is_wp_error($term)) {
        $category_link = get_category_link($term->term_id);
    }

    $posts = get_posts($args);
    ob_start();
    $index = 0;

    foreach ($posts as $post) {
        setup_postdata($post);

        $thumbnail_url = get_the_post_thumbnail_url($post->ID, 'medium') ?: '/wp-content/themes/variety/assets/images/default-image.webp';
        $title = get_the_title($post);
        $permalink = get_permalink($post);
        $excerpt = has_excerpt($post) ? get_the_excerpt($post) : wp_trim_words($post->post_content, 20);

        if ($index < 2) {
            // Featured cards
            $border_class = ($index === 1) ? ' border-none' : '';
        ?>
            <div class="actors-card featured<?php echo $border_class; ?>">
                <a href="<?php echo esc_url($permalink); ?>">
                    <img class="img-fluid" src="<?php echo esc_url($thumbnail_url); ?>" alt="actor-img" />
                </a>
                <div class="actors-cnt">
                    <h2 class="actor-title"><a href="<?php echo esc_url($permalink); ?>"><?php echo esc_html($title); ?></a></h2>
                    <p class="actor-para"><?php echo esc_html($excerpt); ?></p>
                </div>
            </div>
        <?php
        } else {
            // Small cards
        ?>
            <div class="actors-card small">
                <a href="<?php echo esc_url($permalink); ?>">
                    <img class="img-fluid" src="<?php echo esc_url($thumbnail_url); ?>" alt="actor-img" />
                </a>
                <div class="actors-cnt">
                    <h2 class="actor-title"><a href="<?php echo esc_url($permalink); ?>"><?php echo esc_html($title); ?></a></h2>
                </div>
            </div>
        <?php
        }

        $index++;
    }

    if ($category_link) {
        ?>
        <div class="read-more-btn">
            <a href="<?php echo esc_url($category_link); ?>">
                Read More <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    <?php
    }

    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('actors_cards', 'actors_cards_featured');

//end

// this is dynamic category short code
function variety_fetch_sub_category_tabs_($atts)
{
    $atts = shortcode_atts(array(
        'numberposts' => 5
    ), $atts);
    $queried_object = get_queried_object();
    if (!$queried_object || $queried_object->taxonomy !== 'category') {
        return '<p>No categories found.</p>';
    }
    $parent_cat_id = $queried_object->term_id;
    $subcategories = get_categories(array(
        'parent'     => $parent_cat_id,
        'hide_empty' => false,
        'orderby'    => 'id',
        'order'      => 'ASC'
    ));

    ob_start();
    ?>
    <div class="variety-tabs desktop">
        <span id="section-heading" class="c-heading"><?php echo esc_html($queried_object->name); ?></span>
        <ul class="variety-tabs-nav">
            <li class="active" data-slug="all">
                <a href="<?php echo esc_url(get_category_link($parent_cat_id)); ?>">All</a>
            </li>
            <?php foreach ($subcategories as $cat): ?>
                <li data-slug="<?php echo esc_attr($cat->slug); ?>">
                    <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>">
                        <?php echo esc_html($cat->name); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php
    return ob_get_clean();
}
add_shortcode('variety_tabs_sub_cat', 'variety_fetch_sub_category_tabs_');
//end



// this is dynamic category for mobile resonsive 
function variety_fetch_sub_category_tabs_mobile($atts)
{
    $atts = shortcode_atts(array(
        'numberposts' => 5
    ), $atts);
    $queried_object = get_queried_object();
    if (!$queried_object || $queried_object->taxonomy !== 'category') {
        return '<p>No categories found.</p>';
    }
    $parent_cat_id = $queried_object->term_id;
    $subcategories = get_categories(array(
        'parent'     => $parent_cat_id,
        'hide_empty' => false,
        'orderby'    => 'id',
        'order'      => 'ASC'
    ));

    ob_start();
?>
    <div class="variety-tabs mobile-responsive">
        <span id="section-heading" class="c-heading"><?php echo esc_html($queried_object->name); ?></span>
        <h4 class="active" data-slug="all" id="mobilemenu">All <img src="data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27%20width%3D%2710.121%27%20height%3D%275.811%27%20viewBox%3D%270%200%2010.121%205.811%27%3E%3Cg%20id%3D%27Chevron_thin%27%20data-name%3D%27Chevron%20thin%27%20transform%3D%27translate%289.061%201.061%29%20rotate%2890%29%27%3E%3Cpath%20id%3D%27Path_21%27%20data-name%3D%27Path%2021%27%20d%3D%27M-4091.213,6256.242l4,4-4,4%27%20transform%3D%27translate%284091.213%20-6256.242%29%27%20fill%3D%27none%27%20stroke%3D%27%23000%27%20stroke-linecap%3D%27round%27%20stroke-linejoin%3D%27round%27%20stroke-width%3D%271.5%27%2F%3E%3C%2Fg%3E%3C%2Fsvg%3E" width="15" height="15"></h4>
        <ul class="variety-tabs-nav showmobilemenu d-none">

            <?php foreach ($subcategories as $cat): ?>
                <li data-slug="<?php echo esc_attr($cat->slug); ?>">
                    <a href="<?php echo esc_url(get_category_link($cat->term_id)); ?>">
                        <?php echo esc_html($cat->name); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php
    return ob_get_clean();
}
add_shortcode('variety_tabs_sub_cat_mobile', 'variety_fetch_sub_category_tabs_mobile');
//end
// this custom filter for post data

function enqueue_custom_filter_script()
{
    wp_enqueue_script('custom-filter', get_stylesheet_directory_uri() . '/js/custom-filter.js?v="' . time() . '"', ['jquery'], null, true);
    wp_localize_script('custom-filter', 'filter_ajax', ['ajaxurl' => admin_url('admin-ajax.php')]);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_filter_script');

add_action('wp_ajax_filter_posts', 'filter_posts_callback');
add_action('wp_ajax_nopriv_filter_posts', 'filter_posts_callback');

function filter_posts_callback()
{
    $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;

    $args = [
        'post_type'      => 'post',
        'posts_per_page' => 10,
        'paged'          => $paged,
    ];

    $search_term = '';

    // --- Live Search ---
    if (!empty($_POST['q'])) {
        $search_term     = sanitize_text_field($_POST['q']);
        $args['s']       = $search_term; // ✅ use "s", not "q"
        $args['orderby'] = 'relevance';
        $args['order']   = 'DESC';
    } else {
        if (!empty($_POST['sort'])) {
            switch ($_POST['sort']) {
                case 'date_asc':
                    $args['orderby'] = 'date';
                    $args['order'] = 'ASC';
                    break;
                case 'date_desc':
                    $args['orderby'] = 'date';
                    $args['order'] = 'DESC';
                    break;
                case 'title_asc':
                    $args['orderby'] = 'title';
                    $args['order'] = 'ASC';
                    break;
                case 'title_desc':
                    $args['orderby'] = 'title';
                    $args['order'] = 'DESC';
                    break;
            }
        }
    }

    // --- Date Filter ---
    if (!empty($_POST['date'])) {
        $date_query = [];
        if ($_POST['date'] === '24h') {
            $date_query[] = ['after' => '1 day ago'];
        }
        if ($_POST['date'] === '7d') {
            $date_query[] = ['after' => '7 days ago'];
        }
        if ($_POST['date'] === '30d') {
            $date_query[] = ['after' => '30 days ago'];
        }
        if ($_POST['date'] === '12m') {
            $date_query[] = ['after' => '1 year ago'];
        }
        if (!empty($date_query)) $args['date_query'] = $date_query;
    }

    // --- Post Type Filter ---
    if (!empty($_POST['content_type']) && is_array($_POST['content_type'])) {
        $args['post_type'] = array_map('sanitize_text_field', $_POST['content_type']);
    } else {
        // Default to both if nothing selected
        $args['post_type'] = ['post', 'varietyvideo'];
    }


    // --- Category Filter ---
    if (!empty($_POST['category']) && is_array($_POST['category'])) {
        $args['category__in'] = array_map('intval', $_POST['category']);
    }

    // --- Tag Filter ---
    if (!empty($_POST['tag']) && is_array($_POST['tag'])) {
        $args['tag__in'] = array_map('intval', $_POST['tag']);
    }

    // --- Author Filter ---
    if (!empty($_POST['author'])) {
        if (is_array($_POST['author'])) {
            $args['author__in'] = array_map('intval', $_POST['author']);
        } else {
            $args['author__in'] = [intval($_POST['author'])];
        }
    }

    // --- Main Query (paged) ---
    $query = new WP_Query($args);

    // --- Counter ---
    echo '<div id="results-counter">';
    $total_posts  = $query->found_posts;
    $per_page     = $args['posts_per_page'];
    $current_page = max(1, $paged);
    $start        = ($current_page - 1) * $per_page + 1;
    $end          = min($current_page * $per_page, $total_posts);

    if ($total_posts > 0) {
        echo "Showing $start – $end of $total_posts results";
    } else {
        echo "No results found";
    }
    echo '</div>';

    // --- Posts List ---
    echo '<div id="results-list">';
    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();

            $title   = get_the_title();
            $excerpt = wp_trim_words(get_the_excerpt(), 50, '...');

            if (!empty($search_term)) {
                $safe = preg_quote($search_term, '/');
                $title   = preg_replace('/(' . $safe . ')/i', '<mark>$1</mark>', $title);
                $excerpt = preg_replace('/(' . $safe . ')/i', '<mark>$1</mark>', $excerpt);
            }

            $date = get_the_date();
            $tags_list = get_the_tag_list('', ', ');
            $tags_html = $tags_list ? '<span class="post-tags">Tags: ' . $tags_list . '</span>' : '';

            echo '<div class="post-item search-listing-wrapper">';
            echo '<div class="search-listing-img"><a href="' . get_permalink() . '">';
            if (has_post_thumbnail()) the_post_thumbnail('thumbnail');
            echo '</a></div>';
            echo '<div class="search-listing-content">';
            echo '<h2><a href="' . get_permalink() . '">' . $title . '</a></h2>';
            echo '<small>' . $date . '</small><br>';
            echo '<small>By ' . get_the_author() . '</small>';
            echo '<p>'  . $excerpt . '</p>';
            echo '</div></div>';
        }
    }
    echo '</div>';

    // --- Pagination ---
    $big = 999999999;
    $paginate_links = paginate_links([
        'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
        'format'    => '?paged=%#%',
        'current'   => max(1, $current_page),
        'total'     => $query->max_num_pages,
        'type'      => 'array',
    ]);

    if ($paginate_links) {
        echo '<div class="ajax-pagination">';
        foreach ($paginate_links as $page) {
            if (preg_match('/page\/(\d+)/', $page, $matches)) {
                $page_num = intval($matches[1]);
            } elseif (preg_match('/\?paged=(\d+)/', $page, $matches)) {
                $page_num = intval($matches[1]);
            } else {
                $page_num = null;
            }
            if ($page_num) {
                $page = preg_replace('/<a /', '<a data-page="' . $page_num . '" ', $page, 1);
            }
            echo $page;
        }
        echo '</div>';
    }
    // ===================================================
    // ✅ Counts must use ALL filtered posts, not just page
    // ===================================================
    $count_args = $args;
    $count_args['posts_per_page'] = -1;
    unset($count_args['paged']);

    $count_query = new WP_Query($count_args);

    // --- Category Counts ---
    $all_cats = get_categories(['hide_empty' => false]);
    $cat_counts = array_fill_keys(wp_list_pluck($all_cats, 'term_id'), 0);
    foreach ($count_query->posts as $p) {
        foreach (wp_get_post_categories($p->ID) as $c) {
            if (isset($cat_counts[$c])) $cat_counts[$c]++;
        }
    }
    // --- Tag Counts ---
    $all_tags = get_tags(['hide_empty' => false]);
    $tag_counts = array_fill_keys(wp_list_pluck($all_tags, 'term_id'), 0);
    foreach ($count_query->posts as $p) {
        $post_tags = wp_get_post_tags($p->ID, ['fields' => 'ids']);
        foreach ($post_tags as $t) {
            if (isset($tag_counts[$t])) $tag_counts[$t]++;
        }
    }
    // --- Author Counts ---
    $all_authors = get_users(['who' => 'authors']);
    $author_counts = [];
    foreach ($all_authors as $author) {
        $author_counts[$author->ID] = 0;
    }
    foreach ($count_query->posts as $p) {
        $author_id = $p->post_author;
        if (isset($author_counts[$author_id])) {
            $author_counts[$author_id]++;
        }
    }

    // --- Post Type Counts for filtered query ---
    $allowed = ['post', 'varietyvideo'];
    $content_type_counts = array_fill_keys($allowed, 0);
    // Use the same $count_query you already built above (it already has filters applied!)
    foreach ($count_query->posts as $p) {
        $pt = get_post_type($p->ID);
        if (isset($content_type_counts[$pt])) {
            $content_type_counts[$pt]++;
        }
    }
    // Send to frontend
    echo '<script type="application/json" id="dynamic-cat-counts">' . wp_json_encode($cat_counts) . '</script>';
    echo '<script type="application/json" id="dynamic-tag-counts">' . wp_json_encode($tag_counts) . '</script>';
    echo '<script type="application/json" id="dynamic-author-counts">' . wp_json_encode($author_counts) . '</script>';
    echo '<div id="dynamic-content_type-counts" style="display:none;">' . wp_json_encode($content_type_counts) . '</div>';
    wp_reset_postdata();
    wp_die();
}

//end
// this is suggestions filter
add_action('wp_ajax_get_search_suggestions', 'get_search_suggestions');
add_action('wp_ajax_nopriv_get_search_suggestions', 'get_search_suggestions');

function get_search_suggestions()
{
    $query = sanitize_text_field($_POST['q']);

    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => 5,
        'q'              => $query,
    );

    $posts = get_posts($args);

    if ($posts) {
        echo '<ul>';
        foreach ($posts as $post) {
            echo '<li class="suggestion-item">' . esc_html(get_the_title($post)) . '</li>';
        }
        echo '</ul>';
    } else {
        echo '<ul><li>No results found</li></ul>';
    }

    wp_die();
}

//end





function variety_latest_videos_post($atts)
{
    $atts = shortcode_atts(array(
        "numberposts" => 5,
    ), $atts, 'variety_latest_videos');

    $args = array(
        'post_type'      => 'varietyvideo',
        'posts_per_page' => $atts['numberposts'],
        'orderby'        => 'date',
        'order'          => 'DESC',
    );

    $videos = get_posts($args);

    if (empty($videos)) {
        return '<p>No videos found.</p>';
    }

    ob_start();

    // --- Convert YouTube URL to embed format
    function convert_to_embed_url11($url, $autoplay = false)
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
            if ($autoplay) {
                $embed .= "?autoplay=1";
            }
            return $embed;
        }
        return $url;
    }

    // --- First video (main player)
    $first_video = $videos[0];
    $video_url   = get_post_meta($first_video->ID, 'variety-video-url', true);
    $embed_url   = convert_to_embed_url11($video_url, true); // autoplay first video


?>

    <div class="w-75 col-md-12">
        <div class="top-videos">
            <div class="top-video-div">
                <iframe id="main-video-player" width="100%" height="415"
                    src="<?php echo esc_url($embed_url); ?>"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                    allowfullscreen>
                </iframe>
            </div>
            <div class="video-top-cnt">
                <h2 id="main-video-title">
                    <a href="<?php echo get_permalink($first_video->ID); ?>">
                        <?php echo esc_html($first_video->post_title); ?>
                    </a>
                </h2>
            </div>
        </div>
    </div>

    <div class="w-25 col-md-12">
        <div class="featured-video-div">
            <h4>Featured Video</h4>
            <div class="featured-card-wrap">
                <?php foreach ($videos as $index => $video):
                    $url     = get_post_meta($video->ID, 'variety-video-url', true);
                    $embed   = convert_to_embed_url11($url);
                    $thumb   = get_the_post_thumbnail_url($video->ID, 'medium');
                    $image_id = get_post_thumbnail_id($video->ID);
                    $alt_text = get_post_meta($image_id, '_wp_attachment_image_alt', true);

                ?>

                    <div class="featured-card-div"
                        data-url="<?php echo esc_url($embed); ?>"
                        data-title="<?php echo esc_attr($video->post_title); ?>">
                        <div class="overlay-now-play">
                            <a href="<?php echo get_permalink($video->ID); ?>">
                                <img class="img-fluid w-100"
                                    src="<?php echo esc_url($thumb); ?>"
                                    width="209" height="117"
                                    alt="<?php echo $alt_text; ?>" />
                            </a>
                            <?php if ($index === 0): ?>
                                <div class="overlay-now">
                                    <h3>Now Playing</h3>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="featured-cnt">
                            <h2>
                                <a href="<?php echo get_permalink($video->ID); ?>">
                                    <?php echo esc_html($video->post_title); ?>
                                </a>
                            </h2>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php

    return ob_get_clean();
}
add_shortcode('variety_latest_videos', 'variety_latest_videos_post');



// this is shortcode for video cat

function variety_video_parent_post($atts)
{
    $atts = shortcode_atts(array(
        'posts_per_cat' => 6,
    ), $atts, 'variety_video_parent');

    $video_taxonomy_terms = get_terms(array(
        'taxonomy'   => 'vcategory',
        'hide_empty' => false,
    ));

    ob_start();

    foreach ($video_taxonomy_terms as $term) {
        // Query posts for this taxonomy term
        $args = array(
            'post_type'      => 'varietyvideo',
            'posts_per_page' => intval($atts['posts_per_cat']),
            'tax_query' => array(
                array(
                    "taxonomy" => "vcategory",
                    "field" => "slug",
                    "terms" => $term->slug
                )
            ),
            'orderby'        => 'date',
            'order'          => 'DESC',
        );

        $posts = get_posts($args);
        if (empty($posts)) continue;

        // Get first (big) post
        $first = array_shift($posts);
        setup_postdata($first);
        $thumb = get_the_post_thumbnail_url($first->ID, 'large');
        if (!$thumb) $thumb = "https://via.placeholder.com/681x383?text=No+Image";

    ?>
        <div class="row main-wrap">
            <div class="videopage-actor-wrapper-div">
                <h2 class="video-actor-title"><?php echo esc_html($term->name); ?></h2>
                <a href="<?php echo esc_url(get_term_link($term)); ?>" class="more-actor-btn">
                    More <?php echo esc_html($term->name); ?> <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <div class="actors-on-actor-cards-wrapper">
                <div class="video-wrapper-actor">

                    <!-- Big left video -->
                    <div class="left-video-card-div">
                        <div class="leftvideo-card">
                            <div class="overlay-now-play">
                                <a href="<?php echo get_permalink($first); ?>">
                                    <img class="img-fluid w-100"
                                        src="<?php echo esc_url($thumb); ?>"
                                        alt="<?php echo esc_attr(get_the_title($first)); ?>" />
                                </a>
                            </div>
                            <div class="leftvideo-cnt">
                                <h2>
                                    <a href="<?php echo get_permalink($first); ?>">
                                        <?php echo esc_html(get_the_title($first)); ?>
                                    </a>
                                </h2>
                            </div>
                        </div>
                    </div>

                    <!-- Right small videos -->
                    <div class="right-video-card-div">
                        <?php foreach ($posts as $post) : setup_postdata($post);
                            $thumb = get_the_post_thumbnail_url($post->ID, 'medium');
                            if (!$thumb) $thumb = "https://via.placeholder.com/300x200?text=No+Image";
                        ?>
                            <div class="leftvideo-card">
                                <div class="overlay-now-play">
                                    <a href="<?php echo get_permalink($post); ?>">
                                        <img class="img-fluid w-100"
                                            src="<?php echo esc_url($thumb); ?>"
                                            alt="<?php echo esc_attr(get_the_title($post)); ?>" />
                                    </a>
                                </div>
                                <div class="leftvideo-cnt">
                                    <h2>
                                        <a href="<?php echo get_permalink($post); ?>">
                                            <?php echo esc_html(get_the_title($post)); ?>
                                        </a>
                                    </h2>
                                </div>
                            </div>
                        <?php endforeach;
                        wp_reset_postdata(); ?>
                    </div>

                </div>
            </div>
        </div>
        <?php
    }

    return ob_get_clean();
}
add_shortcode('variety_video_parent', 'variety_video_parent_post');


//end

// Helper function for YouTube embed
// Shortcode function

function variety_videos_taxonomy_categorywise($atts)
{
    ob_start();

    $atts = shortcode_atts(
        array(
            'taxonomy' => '',
            'term'     => '',
            'posts'    => 6,
        ),
        $atts,
        'variety_videos_taxo_cat'
    );

    // Current page
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    $args = array(
        'post_type'      => 'varietyvideo',
        'posts_per_page' => intval($atts['posts']),
        'paged'          => $paged,
    );

    if (!empty($atts['taxonomy']) && !empty($atts['term'])) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => $atts['taxonomy'],
                'field'    => 'slug',
                'terms'    => $atts['term'],
            )
        );
    }

    $query = new WP_Query($args);

    // Convert normal YouTube URL into embed
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
            if ($autoplay) {
                $embed .= "?autoplay=1&mute=1&playsinline=1";
            }
            return $embed;
        }
        return $url;
    }

    if ($query->have_posts()) {
        $count = 0;
        echo '<div class="variety-videos-wrap">';

        while ($query->have_posts()) {
            $query->the_post();
            $count++;

            $url   = get_post_meta(get_the_ID(), 'variety-video-url', true);
            $embed = convert_to_embed_url($url);

            if ($count === 1) { ?>
                <!-- Featured Video -->
                <div class="row main-wrap border-bottom pb-4">
                    <div class="catgeorynews-featuredcard">
                        <div class="videocategory-vid">
                            <iframe width="100%" height="415"
                                src="<?php echo esc_url($embed); ?>"
                                title="<?php the_title_attribute(); ?>"
                                frameborder="0"
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                referrerpolicy="strict-origin-when-cross-origin"
                                allowfullscreen></iframe>
                        </div>
                        <div class="videocategory-cnt">
                            <h2>
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                            <p><?php echo wp_trim_words(get_the_excerpt(), 30); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Start grid section -->
                <div class="video-grid">
                <?php } else { ?>
                    <!-- Grid video item -->
                    <div class="video3div-wrap">
                        <div class="video3div-img">
                            <a href="<?php the_permalink(); ?>">
                                <?php if (has_post_thumbnail()) {
                                    the_post_thumbnail([181, 102]);
                                } else { ?>
                                    <img src="https://via.placeholder.com/181x102?text=No+Image"
                                        alt="<?php the_title_attribute(); ?>">
                                <?php } ?>
                            </a>
                        </div>
                        <div class="video3div-cnt">
                            <h2>
                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                            </h2>
                        </div>
                    </div>
            <?php }
        }

        echo '</div>'; // close grid
        echo '</div>'; // close wrap

        // ✅ Add Pagination here
        $big = 999999999; // need an unlikely integer
        $paginate_links = paginate_links(array(
            'base'      => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format'    => '?paged=%#%',
            'current'   => max(1, $paged),
            'total'     => $query->max_num_pages,
            'prev_text' => __('<i class="fa-solid fa-arrow-left"></i> Prev'),
            'next_text' => __('Next <i class="fa-solid fa-arrow-right"></i>'),
            'type'      => 'array',
        ));

        if ($paginate_links) {
            echo '<div class="next-btn-wrap">';
            foreach ($paginate_links as $link) {
                echo '<span class="newsletter-button next next-btn">' . $link . '</span>';
            }
            echo '</div>';
        }

        wp_reset_postdata();
    }

    return ob_get_clean();
}
add_shortcode('variety_videos_taxo_cat', 'variety_videos_taxonomy_categorywise');


//end


/* Get Related Stories */
function variety_get_related_stories($args)
{
    ob_start();
    foreach ($args as $story) {
        $postId = url_to_postid($story["post-content-fields-related-stories-list-post-url"]);
        $featimg = wp_get_attachment_url(get_post_thumbnail_id($postId));
        $title = get_the_title($postId);
            ?>
            <div class="related-card">
                <img src="<?php echo $featimg; ?>" alt="stories-img" width="182" height="167" />
                <div class="stoies-cnt">
                    <h2><?php echo $title; ?></h2>
                </div>
            </div>
            <?php
        }
        $output = ob_get_contents();
        ob_end_clean();
        echo $output;
    }

    function variety_get_search_from_db($request)
    {
        $args = array(
            's'           => $request,    // The search keyword
            'post_type'   => 'post',            // Post type (can be 'page', 'custom_post_type', or array of types)
            'post_status' => 'publish',         // Only published posts
            'numberposts' => 10,                // Number of posts to return
        );
        $search_results = get_posts($args);
        return $search_results;
    }




    //end

    function more_from_variety_post($atts)
    {
        ob_start();

        // Shortcode attributes
        $atts = shortcode_atts(array(
            'category' => '', // category slug
            'posts'    => 1   // how many posts to show
        ), $atts, 'more_from_variety');

        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => intval($atts['posts']),
            'post_status'    => 'publish',
            'orderby'        => 'date',
            'order'          => 'DESC',
        );

        // If category is passed
        if (!empty($atts['category'])) {
            $args['category_name'] = sanitize_text_field($atts['category']);
        }

        $query = new WP_Query($args);

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();

                $title = get_the_title();
                $link  = get_permalink();

                if (has_post_thumbnail()) {
                    $image = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                } else {
                    $image = 'https://via.placeholder.com/250x167?text=No+Image';
                }
            ?>

                <div class="more-from-card">
                    <a href="<?php echo esc_url($link); ?>">
                        <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($title); ?>" width="250" height="167" />
                    </a>
                    <div class="more-variety-cnt">
                        <h2>
                            <a href="<?php echo esc_url($link); ?>"><?php echo esc_html($title); ?></a>
                        </h2>
                    </div>
                </div>

        <?php
            }
            wp_reset_postdata();
        } else {
            echo '<p>No posts found.</p>';
        }

        return ob_get_clean();
    }
    add_shortcode('more_from_variety', 'more_from_variety_post');

    // this shrot code auther latest post
    function variety_latest_author_post($atts)
    {
        // Default parameters
        $atts = shortcode_atts(
            array(
                'author' => '',   // author ID or username
                'count'  => 3,    // number of posts
            ),
            $atts,
            'latest_author_post'
        );
        // If author is a username, get ID
        if (!is_numeric($atts['author']) && !empty($atts['author'])) {
            $user = get_user_by('login', $atts['author']);
            if ($user) {
                $atts['author'] = $user->ID;
            } else {
                return 'Author post not found.';
            }
        }
        // Get author data
        $author_id = intval($atts['author']);
        $author_obj = get_user_by('id', $author_id);
        if (!$author_obj) {
            return 'Author post not found.';
        }
        $author_name = $author_obj->display_name;
        $author_url  = get_author_posts_url($author_id);
        // WP Query
        $args = array(
            'author'        => $author_id,
            'posts_per_page' => intval($atts['count']),
            'post_status'   => 'publish',
            'orderby'       => 'date',
            'order'         => 'DESC',
        );
        $query = new WP_Query($args);

        // Start output
        ob_start();
        ?>
        <section class="author-details">
            <h3 id="title-of-a-story" class="c-title">
                <a href="<?php echo esc_url($author_url); ?>" class="c-title__link">
                    <?php echo esc_html($author_name); ?>
                </a>
            </h3>
            <ul class="author-details__list lrv-a-unstyle-list u-margin-t-1">
                <h4 class="author-details-list__title lrv-a-font-primary-xs u-margin-b-025 u-border-b-1 u-border-color-black lrv-u-text-transform-uppercase">
                    Latest
                </h4>
                <?php if ($query->have_posts()) : ?>
                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                        <li class="author-details-item  u-border-color-black">
                            <a class="c-link lrv-u-display-block lrv-a-font-primary-xs u-color-black u-color-medium-grey:hover u-margin-b-025"
                                href="<?php the_permalink(); ?>">
                                <?php the_title(); ?>
                            </a>
                            <time class="c-timestamp lrv-a-font-secondary-regular-xxs u-color-medium-grey u-text-transform-capitalize lrv-u-margin-b-00"
                                datetime="<?php echo get_the_date('c'); ?>">

                                <?php
                                // Custom time format
                                $post_time   = get_the_time('U'); // Unix timestamp
                                $current_time = current_time('timestamp');
                                $diff = $current_time - $post_time;
                                if ($diff < 86400) { // less than 1 day
                                    $hours = floor($diff / 3600);
                                    echo $time_display = $hours > 0 ? $hours . ' hours ago' : 'Just now';
                                } elseif ($diff < 172800) { // less than 2 days
                                    $days = floor($diff / 86400);
                                    echo $time_display = $days . ' day ago';
                                } elseif ($diff < 259200) { // less than 3 days
                                    $days = floor($diff / 86400);
                                    echo $time_display = $days . ' days ago';
                                } else {
                                    echo $time_display = get_the_date('M j, Y');
                                }
                                ?>
                            </time>
                        </li>
                    <?php endwhile; ?>
                    <?php wp_reset_postdata(); ?>
                <?php else: ?>
                    <li>No posts found.</li>
                <?php endif; ?>
            </ul>
            <div class="lrv-u-flex lrv-u-align-items-center">
                <a class="c-link see-all"
                    href="<?php echo esc_url($author_url); ?>">
                    See All
                </a>
            </div>
        </section>
    <?php

        return ob_get_clean();
    }
    add_shortcode('latest_author_post', 'variety_latest_author_post');


    //end

    /**
     * Implement the Custom Header feature.
     */
    require get_template_directory() . '/inc/custom-header.php';

    /**
     * Custom template tags for this theme.
     */
    require get_template_directory() . '/inc/template-tags.php';

    /**
     * Functions which enhance the theme by hooking into WordPress.
     */
    require get_template_directory() . '/inc/template-functions.php';

    /**
     * Customizer additions.
     */
    require get_template_directory() . '/inc/customizer.php';

    /**
     * Load Jetpack compatibility file.
     */
    if (defined('JETPACK__VERSION')) {
        require get_template_directory() . '/inc/jetpack.php';
    }
