<?php

/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Variety
 */
global $wp;
$request_path = $wp->request; // This gives the requested path without leading/trailing slashes
$search_from_db = variety_get_search_from_db($request_path);
get_header();
?>

<main id="primary" class="site-main">

	<section class="error-404 not-found d-none">
		<header class="page-header">
			<h1 class="page-title"><?php esc_html_e('Oops! That page can&rsquo;t be found.', 'variety'); ?></h1>
		</header><!-- .page-header -->

		<div class="page-content">
			<p><?php esc_html_e('It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'variety'); ?>
			</p>

			<?php
			get_search_form();

			the_widget('WP_Widget_Recent_Posts');
			?>

			<div class="widget widget_categories">
				<h2 class="widget-title"><?php esc_html_e('Most Used Categories', 'variety'); ?></h2>
				<ul>
					<?php
					wp_list_categories(
						array(
							'orderby' => 'count',
							'order' => 'DESC',
							'show_count' => 1,
							'title_li' => '',
							'number' => 10,
						)
					);
					?>
				</ul>
			</div><!-- .widget -->

			<?php
			/* translators: %1$s: smiley */
			$variety_archive_content = '<p>' . sprintf(esc_html__('Try looking in the monthly archives. %1$s', 'variety'), convert_smilies(':)')) . '</p>';
			the_widget('WP_Widget_Archives', 'dropdown=1', "after_title=</h2>$variety_archive_content");

			the_widget('WP_Widget_Tag_Cloud');
			?>

		</div><!-- .page-content -->
	</section><!-- .error-404 -->
	<!--Error Section-->
	<section class="error-section">
		<div class="container">
			<div class="content">
				<div class="big-text">
					<h1>404</h1>
					<p>Page Not Found</p>
				</div>
				<h2>Sorry, the page you were looking
					for cannot be found.</h2>
				<?php if (count($search_from_db)): ?>

					<div class="error404-cnt">
						<h3>Here are some suggestions that might be the page you were looking for:</h3>
						<ul>
							<?php foreach ($search_from_db as $post):
								setup_postdata($post);
								$title = get_the_title($post);
								$permalink = get_the_permalink($post);
							?>
								<li><a href="<?php echo $permalink; ?>"><?php echo $title; ?></a></li>
							<?php endforeach; ?>
						</ul>
						<p>Or try searching for it here...</p>
					</div>
				<?php endif; ?>
				<div class="search_div-404">
					<p>You could try searching here...</p>
				</div>
				<div class="search_div-4040">
					<div class="error-search">
						<input type="text" id="search_404" value="" placeholder="Search">
						<button class="go-btn-error search404">Go</button>
					</div>
				</div>
			</div>
		</div>
	</section>
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
</main><!-- #main -->

<?php
get_footer();
