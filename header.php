<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package osborne
 */

?>

<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<?php header('Access-Control-Allow-Origin: *'); ?>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" type="image/x-icon">
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-101524516-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-101524516-1');
	</script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
	<?php wp_head(); ?>
</head>

<body <?php body_class($post->post_name); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'osborne' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-header-container">
			<div class="side"></div>
			<div class="wrapper header">
				<div class="site-branding">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" class="full-logo">
						<?php get_template_part('images/osborne.svg'); ?>
					</a>
				</div><!-- .site-branding -->

				<div class="shop-menu small-screen">
					<a href="<?php echo WC()->cart->get_cart_url(); ?>" class="cart">Cart</a>

					<?php $account_link = (is_user_logged_in()) ? 'Account' : 'Login'; ?>
					
					<a class="login" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">
						<?php echo $account_link; ?>
					</a>
				</div>
				
				<nav id="site-navigation" class="main-navigation">
					<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
						<span class="menu-icon"></span>
						Menu
					</button>
					<?php
						wp_nav_menu( array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
						) );
					?>
				</nav><!-- #site-navigation -->
			</div>
			<div class="side shop-menu">
				<a href="<?php echo WC()->cart->get_cart_url(); ?>" class="cart">
					Cart <span class="cart-amount-display">(<span class="cart-total"><?php echo WC()->cart->get_cart_total(); ?></span>)</span>
				</a>

				<?php $account_link = (is_user_logged_in()) ? 'Account' : 'Login'; ?>
				
				<a class="login" href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">
					<?php echo $account_link; ?>
				</a>
			</div>
		</div>
	</header><!-- #masthead -->

	<div id="content" class="site-content">
	
	<?php
		if (is_page('home')):
			get_template_part('components/home-header');
		else:
			if (is_singular('set-menu')):
				set_query_var( 'is_subpage', true );
				set_query_var( 'parent_id', get_page_by_path('online-shop'));
			endif;
			
			get_template_part('components/page-header');
		endif;
	?>