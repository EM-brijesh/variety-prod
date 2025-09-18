<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Variety
 */
$post_id = get_the_ID();
$postcontentfields = get_post_meta($post_id, "postcontentfields", true);
$postcontentfieldsrelatedstorieslist = get_post_meta($post_id, "postcontentfieldsrelatedstorieslist", true);


//$category_slug = get_queried_object()->slug;
$cat = get_queried_object();
if ($cat && isset($cat->term_id)) {
	// Get full path with slashes
	$category_slug = get_category_parents($cat->term_id, false, '/', true);
	// Remove trailing slash if present
	$category_slug = trim($category_slug, '/');
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<section class="category-details-section">
		<div class="container">
			<div class="row">
				<div class="w-68 col-md-12 col-sm-12">
					<div class="variety-detials-main-cnt">
						<div class="breadcrump-date-wrapper">
							<div class="breadcrump">
								<ul>
									<li><a href="<?php echo home_url(); ?>">Home</a></li>
									<li><i class="fa-solid fa-angle-right"></i></li>
									<?php
									// If it's a single post, get its category hierarchy
									if (is_single()) {
										$category = get_the_category();
										if (!empty($category)) {
											$cat = $category[0]; // Get the first category
											$parents = get_ancestors($cat->term_id, 'category');
											// Display parent categories if any
											$parents = array_reverse($parents);
											foreach ($parents as $parent_id) {
												$parent = get_category($parent_id);
												echo '<li><a href="' . esc_url(get_category_link($parent_id)) . '">' . esc_html($parent->name) . '</a></li>';
												echo '<li><i class="fa-solid fa-angle-right"></i></li>';
											}
											// Current category
											echo '<li><a href="' . esc_url(get_category_link($cat->term_id)) . '">' . esc_html($cat->name) . '</a></li>';
										}
									}

									?>
								</ul>
							</div>
							<div class="variety-details-date-time">
								<p><?php echo get_the_date('M d, Y g:ia') . ' PT'; ?></p>
							</div>
						</div>
						<?php
						$post_title = urlencode(get_the_title());
						$post_desc = urlencode(get_the_excerpt());
						$post_url = urlencode(get_permalink());
						$post_image = urlencode(get_the_post_thumbnail_url(get_the_ID(), 'full'));
						
						?>
						<div class="variety-news-details-page-div">
							<h1 class="sr-only">news-old-title</h1>
							<h2><?php echo the_title(); ?></h2>
							<div class="variety-write-social_wrapper">
								<div class="variety-writer-div">
									<div class="authorname-arrow-wrapper">
										<p>By <?php echo get_the_author(); ?></p>
										<div class="author-story-div">
											<a href="javascript:void(0);" class="autherAlllastestpost" data-id="id">
												<svg viewBox="0 0 10.121 5.811" id="chevron-icon-medium-grey" xmlns="http://www.w3.org/2000/svg">
													<g data-name="Chevron thin">
														<path data-name="Path 21" d="m9.061 1.061-4 4-4-4" stroke="#595959" fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"></path>
													</g>
												</svg>
											</a>
										</div>
									</div>
									<div class="d-none latest-auther-post-data">
										<?php echo do_shortcode('[latest_author_post author="' . get_the_author() . '" count="5"]'); ?>
										<div>
										</div>

									</div>
									<div class="social-container" id="socialContainer">
										<div class="icons-social">
											<a class="social-icon" href="#comment-sec"><img src="data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27%20width%3D%2724%27%20height%3D%2725.314%27%20viewBox%3D%270%200%2024%2025.314%27%3E%3Cpath%20id%3D%27Path_38%27%20data-name%3D%27Path%2038%27%20d%3D%27M3.75,2A1.752,1.752,0,0,0,2,3.75v10.5A1.752,1.752,0,0,0,3.75,16H8.672v4.962L14.455,16H20.25A1.752,1.752,0,0,0,22,14.25V3.75A1.752,1.752,0,0,0,20.25,2H3.75m0-2h16.5A3.75,3.75,0,0,1,24,3.75v10.5A3.75,3.75,0,0,1,20.25,18H15.2L6.672,25.314V18H3.75A3.75,3.75,0,0,1,0,14.25V3.75A3.75,3.75,0,0,1,3.75,0Z%27%2F%3E%3C%2Fsvg%3E" width="25" height="25"></a>
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
									<div class="variety-news-content">
										<?php if (has_post_thumbnail()): ?>
											<figure>
												<img class="img-fluid" width="100%" height="407" src="<?php echo get_the_post_thumbnail_url(null, 'large'); ?>"
													alt="<?php echo esc_attr(get_the_title()); ?>" />
												<figcaption>Christie Goodwin</figcaption>
												<!-- Replace with dynamic credit if needed -->
											</figure>
										<?php endif; ?>
										<!-- <p><?php //the_content(); 
												?></p> -->
										<div class="inner-cont-details">
											<?php if (!empty($postcontentfields[0]["post-content-fields-opening-paragraph"])): ?>
												<?php echo $postcontentfields[0]["post-content-fields-opening-paragraph"]; ?>
											<?php endif; ?>
											<?php if (!empty($postcontentfieldsrelatedstorieslist)): ?>
												<div class="releated-stories-div">
													<h2 class="related-story-title">Related Stories</h2>
													<div class="related-stories-div-wrapper">
														<?php variety_get_related_stories($postcontentfieldsrelatedstorieslist);
														?>
													</div>
												</div>
											<?php endif; ?>

											<?php if (!empty($postcontentfields[0]["post-content-fields-after-story-paragraph"])): ?>
												<?php echo $postcontentfields[0]["post-content-fields-after-story-paragraph"]; ?>
											<?php endif; ?>
											<div class="ads-header"></div>
											<div class="popuplar-on-variety">
												<h2 class="popular-title">Popular on Variety</h2>
												<div class="popular-video">
													<?php
													echo wp_oembed_get("https://www.youtube.com/watch?v=eSgJ8PfSUSk");
													?>
												</div>
											</div>
											<?php if (!empty($postcontentfields[0]["post-content-fields-final-paragraph"])): ?>
												<?php echo $postcontentfields[0]["post-content-fields-final-paragraph"]; ?>
											<?php endif; ?>
											<!-- Youtube video -->
											<div class="popuplar-on-variety">
												<div class="popular-video">
													<iframe></iframe>
												</div>
											</div>
											<!-- Youtube video -->
											<div class="read-more-about">
												<div class="readmmore-wrapper">
													<h2>Read More About: <a href="#">Fox Corp.</a>, <a href="#">Lachlan Murdoch</a>, <a href="#">News Corp.</a></h2>
												</div>
											</div>
											<?php if (comments_open()): ?>
												<div class="jump-comment-div" id="comment-section">
													<h2><a href="#comment-sec">Jump To Comments <i class="fa-solid fa-arrow-right"></i></a></h2>
												</div>
											<?php endif; ?>
										</div>
										<!-- More From Variety Section Start -->
										<div class="more-from-variety-div">
											<h2 class="more-variety-title">More from Variety</h2>
											<div class="more-from-variety-wrapper">
												<?php echo do_shortcode('[more_from_variety category="' . $category_slug . '" posts="3"]'); ?>
											</div>
										</div>
										<!-- More From Variety Section End -->
										<!-- Comments Section Start -->
										<?php if (comments_open()):
											$variety_comment_count = get_comments_number();
										?>
											<div class="comment-section" id="comment-sec">
												<div class="comment-counter">
													<h2><img src="data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%27http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%27%20width%3D%2724%27%20height%3D%2725.314%27%20viewBox%3D%270%200%2024%2025.314%27%3E%3Cpath%20id%3D%27Path_38%27%20data-name%3D%27Path%2038%27%20d%3D%27M3.75,2A1.752,1.752,0,0,0,2,3.75v10.5A1.752,1.752,0,0,0,3.75,16H8.672v4.962L14.455,16H20.25A1.752,1.752,0,0,0,22,14.25V3.75A1.752,1.752,0,0,0,20.25,2H3.75m0-2h16.5A3.75,3.75,0,0,1,24,3.75v10.5A3.75,3.75,0,0,1,20.25,18H15.2L6.672,25.314V18H3.75A3.75,3.75,0,0,1,0,14.25V3.75A3.75,3.75,0,0,1,3.75,0Z%27%2F%3E%3C%2Fsvg%3E" width="25" height="25"> <?php echo $variety_comment_count; ?> Comments</h2>
													<p>Comments are moderated. They may be edited for clarity and reprinting in whole or in part in Variety publications.</p>
												</div>
												<?php
												// If comments are open or we have at least one comment, load up the comment template.
												if (comments_open() || get_comments_number()):
													comments_template();
												endif;
												?>
											</div>
										<?php endif; ?>
										<!-- Comments Section End -->
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
						<div class="most-popular w-32 col-md-12 col-sm-12">
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
													<input type="text" id="home_new_emails1" name="email" class="newsletter-input" placeholder="Enter your email address" />
													<div class="respo" id="form-responses"></div>
													<input type="hidden" id="home_news1" name="news" value="">
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
</article><!-- #post-<?php the_ID(); ?> -->
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