<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package osborne
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="error-404 not-found">
				<header class="entry-header bg-hover">
					<div class="background">
						<img src="<?php echo get_template_directory_uri() . '/images/villa-arrigo.jpg'; ?>" />
					</div>
					<div class="wrapper">
						<div class="header-container">
							<h1 class="page-title">Error 404: Page not found</h1>
							<!-- <h1 class="entry-title"><?php echo get_the_title($post_id); ?></h1> -->
						</div>
					</div>
				</header><!-- .page-header -->

				<div class="section-container">
					<div class="wrapper">

						<h2>Nothing was found at this location. Maybe try one of the links below?</h2>

						<ul>
							<li><a href="<?php echo home_url(); ?>">Home</a></li>
							<li><a href="<?php echo home_url('our-story'); ?>">Our Story</a></li>
							<li><a href="<?php echo home_url('services'); ?>">Services</a></li>
							<li><a href="<?php echo home_url('venues'); ?>">Venues</a></li>
							<li><a href="<?php echo home_url('online-shop'); ?>">Online Shop</a></li>
							<li><a href="<?php echo home_url('contact'); ?>">Contact</a></li>
						</ul>

					</div>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();