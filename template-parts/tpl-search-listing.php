<?php
/*
Template Name: Search Listing Page
*/
get_header();
$search_query = isset($_GET['q']) ? sanitize_text_field($_GET['q']) : '';
?>
<style>
    .page-template-tpl-search-listing .ads-header{
        display: none;
    }
    .filter-btn {
        display: none;
    }

    .filter-btn a {
        text-decoration: none;
        color: #000;
        font-size: 14px;
        font-weight: 700;
        padding: 10px 10px;
        background: #fff;
        border: 1px solid #000;
        padding: 10px;
        width: 100%;
        display: block;
        border-radius: 5px;
        font-family: var(--main-font-bold);
    }
    
    @media only screen and (max-width : 991px) {
        .search-title {
            font-size: 32px;
            color: #000;
            font-family: Arial;
            text-align: center;
            font-weight: 700;
        }

        div#results-counter {
            font-size: 12px;
            padding-bottom: 7px;
        }

        .most-popular-section {
            width: 100%;
            text-align: left;
        }

        .latest-news .news-wrapper {
            border-right: none;
        }

        .search-listing-img img {
            width: 70px;
            height: 70px;
        }

        .post-item.search-listing-wrapper {
            justify-content: center;
            flex-direction: row-reverse;
        }

        .search-listing-content p {
            font-size: 14px;
            width: 100%;
        }

        .filter-btn {
            display: block;
            text-align: center;
            margin-bottom: 30px;
        }

        .most-popular-section {
            display: none;
        }

        .search-list-section {
            max-width: 100%;
            width: 100%;
            margin: auto;
        }
         .search-most-popular.save-filter-div {
        position: fixed;
        height: 100%;
        width: 100%;
        background: #fff;
        top: 0;
        z-index: 9999;
        left: 0;
        padding: 20px 20px;
        overflow-y: scroll;
    }
    }




    .filter-section {
  margin-bottom: 20px;
  border-bottom: 1px solid #ddd;
  padding-bottom: 10px;
}

.filter-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.filter-header h4 {
  font-size: 14px;
  font-weight: bold;
  margin: 0;
}

.filter-header .clear-filter {
  font-size: 12px;
  background: none;
  border: none;
  color: #0073aa;
  cursor: pointer;
  text-transform: uppercase;
}

.filter-options label {
  display: flex;
  justify-content: space-between;
  align-items: center;
  font-size: 13px;
  margin: 3px 0;
}

.filter-options input[type="checkbox"] {
  margin-right: 6px;
}




#search-suggestions {
  display: none;
  position: absolute;
  top: 100%;
  left: 0;
  right: 0;
  background: #fff;
  border: 1px solid #ccc;
  z-index: 99;
  max-height: 250px;
  overflow-y: auto;
}

#search-suggestions ul {
  list-style: none;
  margin: 0;
  padding: 0;
}

#search-suggestions li {
  padding: 10px;
  cursor: pointer;
  border-bottom: 1px solid #eee;
}

#search-suggestions li:hover {
  background: #f0f0f0;
}
</style>






<!-- latest-news-section-start -->
<section class="latest-news category-listing search-list-section">
    <div class="container p-0">
        <form id="custom-filters">
            <div class="row ">
                <div class="col-12 p-0">
                    <h2 class="search-title">Search Results</h2>
                    <div class="search_list_div">
                        <div class="form-group">
                            <p><span class="wpcf7-form-control-wrap" data-name="q">
                                    <input size="40" maxlength="400" class="wpcf7-form-control wpcf7-text search-input"
                                        id="news-search" aria-invalid="false" value="<?php echo $search_query; ?>"
                                        type="text" name="q" placeholder="Search">
                                        <div id="search-suggestions" class="suggestions"></div>
                                    </span>
                            </p>
                        </div>
                        <div class="variety-search-btn">
                            <p><input class="wpcf7-form-control wpcf7-submit has-spinner search-submit-btn"
                                    type="submit" value="Go" id="searchBnt"><span class="wpcf7-spinner"></span>
                            </p>
                        </div>
                    </div>



                </div>
            </div>

            <div id="results-counter"></div>
            <div class="row padding-block-30">


                <div class="most-popular search-most-popular col-lg-3 col-md-12 col-sm-12">
                 <form id="custom-filters">
                    <div class="filter-btn">
                        <a href="#" id="filter-btn">Show Filter</a>
                    </div>
                    <div class="most-popular-section listing" id="mob-filter-btn">
                    <button type="button" id="clear-filters">Clear Filters</button>
                        <!-- Sort By -->
                        <h4>Sort By</h4>
                        <select name="sort">
                            <option value="relevance">Relevance</option>
                            <option value="date_desc">Published Date (newest first)</option>
                            <option value="date_asc">Published Date (oldest first)</option>
                        </select>
                        <div class="date-filter-search">
                            <!-- Date Filter -->
                            <h4>Date Filter</h4>
                            <label><input type="radio" name="date" value="" checked> All</label>
                            <label><input type="radio" name="date" value="24h"> Past 24 Hours</label>
                            <label><input type="radio" name="date" value="7d"> Past 7 Days</label>
                            <label><input type="radio" name="date" value="30d"> Past 30 Days</label>
                            <label><input type="radio" name="date" value="12m"> Past 12 Months</label>
                        </div>
                        <!-- this is content type-->
                        <div class="topics-search" data-section-wrapper="content_type">
                            <h4>Content Type </h4>
                            <?php
                                $allowed = ['post', 'varietyvideo'];
                                foreach ($allowed as $pt) {
                                    $count_posts = wp_count_posts($pt);
                                    $total = isset($count_posts->publish) ? $count_posts->publish : 0;

                                    if(get_post_type_object($pt)->labels->singular_name=="Post"){
                                        $postname= "Article";
                                    }else{
                                        $postname= "Video";
                                    }

                                    echo '<label>';
                                    echo '<input type="checkbox" name="content_type[]" value="' . esc_attr($pt) . '"> ';
                                    echo '<p class="cat-name"><span>' .$postname. '</span>';
                                    echo '<span class="count-news" data-content-type="' . esc_attr($pt) . '">' . intval($total) . '</span></p>';
                                    echo '</label>';
                                }
                                ?>
                              
                        </div>
                        <!-- end-->
                        <div class="topics-search" data-section-wrapper="cat">
                            <!-- Topics (Categories) -->
                            <h4>Topics</h4>
                            <?php
                            $categories = get_categories(['parent' => 0, 'hide_empty' => false]);
                            foreach ($categories as $cat) {
                                echo '<label>';
                                echo '<input type="checkbox" name="category[]" value="' . $cat->term_id . '"> ';
                                echo '<p class="cat-name"><span>' . $cat->name . '</span><span class="count-news" data-cat="' . $cat->term_id . '">' . intval($cat->count) . '</span></p>';
                                echo '</label>';
                            }
                            ?>
                        </div>
                        <div class="tags-search" data-section-wrapper="tag">
                            <!-- Tags -->
                            <h4>Tags</h4>
                            <?php
                            $tags = get_tags();
                            foreach ($tags as $tag) {
                                echo '<label>';
                                echo '<input type="checkbox" name="tag[]" value="' . $tag->term_id . '"> ';
                                echo '<p class="cat-name"><span>' . $tag->name . '</span><span class="count-news" data-tag="' . $tag->term_id . '">' . intval($tag->count) . '</span></p>';
                                echo '</label>';
                            }
                            ?>
                        </div>
                        <div class="author-search" data-section-wrapper="author">
                            <!-- Authors -->
                            <h4>Authors 
                            <?php
                            $authors = get_users(['who' => 'authors']);
                            foreach ($authors as $author) {
                                $post_count = count_user_posts($author->ID);
                                echo '<label>';
                                echo '<input type="checkbox" name="author[]" value="' . $author->ID . '"> ';
                                echo '<p class="cat-name"><span>' . $author->display_name . '</span><span class="count-news" data-author="' . $author->ID . '">' . intval($post_count) . '</span></p>';
                                echo '</label>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                        </form>

                <div class="col-lg-9 col-md-12 col-sm-12 news-wrapper">

                    <div id="results-list" class="news-results filter-results">
                    </div>
                </div>
            </div>
        </form>
        <div id="results-pagination"></div>
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
<script>
  jQuery(document).on("click", "#filter-btn", function (e) {
    e.preventDefault(); // stop page reload
    console.log("hide.....");

    // toggle class
    jQuery("#mob-filter-btn").toggleClass("d-block");
    jQuery(".search-most-popular").toggleClass("save-filter-div");
    

    // toggle text
    let currentText = jQuery(this).text().trim();
    if (currentText === "Show Filter") {
        jQuery(this).text("Save Filter");
    } else {
        jQuery(this).text("Show Filter");
    }
});
</script>
<!-- More Brands Section End -->
<?php

get_footer();
