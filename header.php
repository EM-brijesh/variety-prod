<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Variety
 */

global $post;
$share_title = get_the_title($post->ID);
$share_desc = get_the_excerpt($post->ID);
$share_url = get_permalink($post->ID);
$share_image = get_the_post_thumbnail_url($post->ID, 'full');
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="robots" content="index, follow">
	<link rel="icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.webp">
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.webp">
	<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/assets/images/favicon.webp">
	<!-- Open Graph Meta Tags -->
	<meta property="og:title" content="<?php echo esc_attr($share_title); ?>">
	<meta property="og:description" content="<?php echo esc_attr($share_desc); ?>">
	<meta property="og:url" content="<?php echo esc_url($share_url); ?>">
	<meta property="og:image" content="<?php echo esc_url($share_image); ?>">
	<meta property="og:type" content="article">

	<!-- Twitter Card Meta Tags -->
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:title" content="<?php echo esc_attr($share_title); ?>">
	<meta name="twitter:description" content="<?php echo esc_attr($share_desc); ?>">
	<meta name="twitter:image" content="<?php echo esc_url($share_image); ?>">
	<!-- Bootstrap -->
	<!-- ✅ Bootstrap -->
	<link rel="preload" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" as="style"
		onload="this.onload=null;this.rel='stylesheet'">
	<noscript>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
	</noscript>

	<!-- ✅ Font Awesome -->
	<link rel="preload" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" as="style"
		onload="this.onload=null;this.rel='stylesheet'">
	<noscript>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	</noscript>
     
	<?php if ( is_page('what-we-watch') || is_page('what-to-hear') ) {?>
	<!-- ✅ Swiper -->
	<link rel="preload" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" as="style"
		onload="this.onload=null;this.rel='stylesheet'">
	<noscript>
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
	</noscript>
	<?php } ?>

	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link
		href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=IBM+Plex+Serif:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,100;1,200;1,300;1,400;1,500;1,600;1,700&family=Roboto+Condensed:ital,wght@0,100..900;1,100..900&display=swap"
		rel="stylesheet">
	<link rel="preload" href="/wp-content/themes/variety/assets/fonts/Owners-Regular.woff2" as="font" type="font/woff2" crossorigin>
	<link rel="preload" href="/wp-content/themes/variety/assets/fonts/Owners-Bold.woff2" as="font" type="font/woff2" crossorigin>
	<link rel="preload" href="/wp-content/themes/variety/assets/fonts/Owners-Medium.woff2" as="font" type="font/woff2" crossorigin>
	<link rel="preload"
		as="image"
		href="https://variety.amaruventures.in/wp-content/uploads/2025/09/Stephen-Graham-Emmy-Win.webp"
		fetchpriority="high">
	<link rel="preload" href="<?php echo get_template_directory_uri(); ?>/assets/fonts/Owners-Bold.woff2" as="font" type="font/woff2" crossorigin>


	<!-- this is google ads-->
	<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-6859002112484340"
		crossorigin="anonymous"></script>
	<!-- Header_728x90 -->
	<ins class="adsbygoogle"
		style="display:block"
		data-ad-client="ca-pub-6859002112484340"
		data-ad-slot="4956455691"
		data-ad-format="auto"
		data-full-width-responsive="true"></ins>
	<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
	</script>
	<!-- end-->
	 <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'variety'); ?></a>
		<div class="ads-header">

		</div>
		<section class="bottom_menu">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<ul class="variety_second-menu-wrapper">
							<?php echo headermenu_variety_get_header_menu(); ?>
						</ul>
					</div>
				</div>
			</div>
		</section>
		<header class="header-sticky">
			<div class="container">
				<div class="header-bar">
					<div class="left-section">
						<svg style="cursor: pointer;" class="openMenuClass" id="openMenu" xmlns="http://www.w3.org/2000/svg" fill="#000"
							width="24px" height="24px" viewBox="0 0 1920 1920">
							<path
								d="M1920 1468.412v112.94H0v-112.94h1920Zm0-564.706v112.941H0V903.706h1920ZM1920 339v112.941H0V339h1920Z"
								fill-rule="evenodd"></path>
						</svg>
						<div class="right-section" id="main-header-search">
							<svg style="cursor: pointer;" class="fa-search" xmlns="http://www.w3.org/2000/svg"
								xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000" height="25px" width="25px"
								version="1.1" id="Capa_1" viewBox="0 0 488.4 488.4" xml:space="preserve">
								<g>
									<g>
										<path
											d="M0,203.25c0,112.1,91.2,203.2,203.2,203.2c51.6,0,98.8-19.4,134.7-51.2l129.5,129.5c2.4,2.4,5.5,3.6,8.7,3.6    s6.3-1.2,8.7-3.6c4.8-4.8,4.8-12.5,0-17.3l-129.6-129.5c31.8-35.9,51.2-83,51.2-134.7c0-112.1-91.2-203.2-203.2-203.2    S0,91.15,0,203.25z M381.9,203.25c0,98.5-80.2,178.7-178.7,178.7s-178.7-80.2-178.7-178.7s80.2-178.7,178.7-178.7    S381.9,104.65,381.9,203.25z"></path>
									</g>
								</g>
							</svg>
						</div>
						<div class="header-popup-wrapper">
							<div class="search-box">
								<div class="close-search" id="closeSearch">&#10005;</div>
								<input type="text" class="form-control bg-dark text-white border-secondary"
									id="data-search-form-2" placeholder="Search">
								<button class="go-btn" id="searchbtn">Go</button>
							</div>
						</div>
					</div>
					<div class="center-section">
						<div class="logo">
							<a href="<?php echo get_permalink(get_page_by_path('home')); ?>"><img
									src="<?php echo get_template_directory_uri(); ?>/assets/images/variety-india-logo.webp"
									class="img-fluid" alt="Logo" fetchpriority="high"></a>
						</div>
					</div>
					<div class="top-sticky-menu-news">
						<p><a href="#">Read News:Why Does David Ellison Want Paramount to Swallow Warner Bros. Discovery Whole? To Beat Rival Suitors to the Punch</a></p>
					</div>
				</div>

			</div>
		</header>
		<header class="header" id="header">
			<div class="container">
				<div class="header-bar">
					<div class="left-section">
						<svg style="cursor: pointer;" class="openMenuClass" id="openMenu" xmlns="http://www.w3.org/2000/svg" fill="#000"
							width="24px" height="24px" viewBox="0 0 1920 1920">
							<path
								d="M1920 1468.412v112.94H0v-112.94h1920Zm0-564.706v112.941H0V903.706h1920ZM1920 339v112.941H0V339h1920Z"
								fill-rule="evenodd"></path>
						</svg>
						<div class="right-section" id="main-header-search">
							<svg style="cursor: pointer;" class="fa-search" xmlns="http://www.w3.org/2000/svg"
								xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000" height="25px" width="25px"
								version="1.1" id="Capa_1" viewBox="0 0 488.4 488.4" xml:space="preserve">
								<g>
									<g>
										<path
											d="M0,203.25c0,112.1,91.2,203.2,203.2,203.2c51.6,0,98.8-19.4,134.7-51.2l129.5,129.5c2.4,2.4,5.5,3.6,8.7,3.6    s6.3-1.2,8.7-3.6c4.8-4.8,4.8-12.5,0-17.3l-129.6-129.5c31.8-35.9,51.2-83,51.2-134.7c0-112.1-91.2-203.2-203.2-203.2    S0,91.15,0,203.25z M381.9,203.25c0,98.5-80.2,178.7-178.7,178.7s-178.7-80.2-178.7-178.7s80.2-178.7,178.7-178.7    S381.9,104.65,381.9,203.25z"></path>
									</g>
								</g>
							</svg>
						</div>
						<div class="header-popup-wrapper">
							<div class="search-box">
								<div class="close-search" id="closeSearch">&#10005;</div>
								<input type="text" class="form-control bg-dark text-white border-secondary"
									id="data-search-form-3" placeholder="Search">
								<button class="go-btn" id="searchbtn">Go</button>
							</div>
						</div>
						<div class="variety_newsletter_dropdown_wrapper">
							<a href="<?php echo get_permalink(get_page_by_path('news-tips')); ?>" class="">Got a Tip?</a>
							<select class="form-select form-select-sm bg-dark text-white border-secondary filternewsallover" id="global-desk-drop">
								<option value="">India Edition</option>
								<option value="/tag/asia">Asia Edition</option>
								<option value="/tag/us">US </option>
								<option value="/category/global">Global</option>
							</select>
						</div>
					</div>
					<div class="center-section">
						<div class="logo">
							<a href="<?php echo get_permalink(get_page_by_path('home')); ?>"><img
									src="<?php echo get_template_directory_uri(); ?>/assets/images/variety-india-logo.webp"
									class="img-fluid" alt="Logo" fetchpriority="high"></a>
						</div>
					</div>
				</div>

				<!-- Overlay Menu -->
				<div class="overlay" id="menuOverlay">
					<div class="container-width">
						<div class="overlay-header-wrapper">
							<div class="overlay-header">
								<div class="logo_menu"><a href="<?php echo get_permalink(get_page_by_path('home')); ?>"><img
											src="<?php echo get_template_directory_uri(); ?>/assets/images/variety-india-logo-light.webp"
											class="img-fluid" alt="Logo" fetchpriority="high"></a></div>
								<div class="search-box">
									<input type="text" class="form-control bg-dark text-white border-secondary"
										id="data-search-forms" placeholder="Search...">
									<button class="go-btn" id="searchbtndd">Go</button>
								</div>
								<div class="close-btn" id="closeMenu">&#10005;</div>
							</div>
						</div>
						<div class="menu-wrapper">
							<div class="menu-grid">
								<?php echo variety_get_header_menu(); ?>
							</div>
						</div>
					</div>
					<div class="bottom-info">
						<div class="variety_alers-wrapper">
							<form id="custom-cfdb7-form">
								<div class="alerts-section">
									<div class="title-alerts">Alerts and Newsletters</div>
									<div class="input-error-wrap">
										<input type="email" id="email" name="email"
											class="form-control bg-dark text-white border-secondary alertmenu-header-form"
											placeholder="Enter your email address">
										<div id="form-response"></div>
									</div>
									<button type="submit" class="btn btn-sm" id="form-response">Sign Up <i
											class="fa-solid fa-arrow-right"></i></button>
								</div>
							</form>
							<p>By providing your information, you agree to our <a href="<?php echo get_permalink(get_page_by_path('terms-and-conditions')); ?>">Terms of Use</a> and our <a href="<?php echo get_permalink(get_page_by_path('privacy-policy')); ?>">Privacy Policy</a>. We use vendors that may also process your information to help provide our services. // This site is protected by reCAPTCHA Enterprise and the <a href="https://policies.google.com/privacy" target="_blank">Google Privacy Policy</a> and <a href="https://policies.google.com/terms" target="_blank">Terms of Service</a> apply.</p>
						</div>
						<div class="menu_social-wrap">
							<div class="social-left-wrapper">
								<div class="social-icons">
									<a href="javascript:void(0);" target="_blank"><i class="fab fa-instagram"></i></a>
									<a href="javascript:void(0);" target="_blank"><img
											src="<?php echo get_template_directory_uri(); ?>/assets/images/x-twitter-brands.svg"></a>
									<a href="javascript:void(0);" target="_blank"><i class="fab fa-youtube"></i></a>
									<a href="javascript:void(0);" target="_blank"><i class="fab fa-facebook-f"></i></a>
									<a href="javascript:void(0);" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
								</div>
								<div class="subscribe-menu-inner">
									<a href="#">Subscribe</a>
								</div>
							</div>
							<div class="variety_newsletter_dropdown_wrapper">
								<a href="#">Got a Tip?</a>
								<select class="form-select form-select-sm bg-dark text-white border-secondary" id="global-drop">
									<option selected>India Edition</option>
									<option>US </option>
									<option>Asia </option>
									<option>Global </option>
								</select>
							</div>
						</div>
						<div class="bottom-last-wrap">
							<div class="left-bottom-wrap">
								<ul>
									<li><a href="<?php echo get_permalink(get_page_by_path('advertise')); ?>">Advertise</a></li>
									<li><a href="<?php echo get_permalink(get_page_by_path('about-us')); ?>">About</a></li>
									<li><a href="<?php echo get_permalink(get_page_by_path('contact-us')); ?>">Contact Us</a></li>
								</ul>
								<p class="copyright">Variety is a part of Penske Media Corporation. © 2025 Variety Media, LLC. All Rights Reserved.</p>
							</div>
							<div class="right-bottom-logo">
								<a href="#"></a>
							</div>
						</div>
					</div>
					<div class="mobile-bottom-div">
						<ul>
							<li><a href="<?php echo get_permalink(get_page_by_path('news-tips')); ?>">Have a News Tip?</a></li>
						</ul>
						<div class="variety_newsletter_dropdown_wrapper" style="display: block;">
							<select class="form-select form-select-sm bg-dark text-white border-secondary" id="global-drop-mob-new">
								<option value="">India Edition</option>
								<option value="/tag/asia">Asia Edition</option>
								<option value="/tag/us">US </option>
								<option value="/category/global">Global</option>
							</select>
						</div>
					</div>
				</div>
			</div>
		</header>

		<main id="primary" class="site-main">