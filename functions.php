<?php
/**
 * osborne functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package osborne
 */

if ( ! function_exists( 'osborne_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function osborne_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on osborne, use a find and replace
		 * to change 'osborne' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'osborne', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'osborne' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'osborne_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
	}
endif;
add_action( 'after_setup_theme', 'osborne_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function osborne_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'osborne_content_width', 640 );
}
add_action( 'after_setup_theme', 'osborne_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function osborne_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'osborne' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'osborne' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'osborne_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function osborne_scripts() {
	wp_enqueue_style( 'osborne-reset', get_template_directory_uri() . '/reset.min.css' );
	wp_enqueue_style( 'osborne-style', get_template_directory_uri() . '/style.css' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// wp_deregister_script('jquery');

	if (is_page('contact')) {
		wp_enqueue_script( 'google-maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBMXz2xc_dbwKN_sSnu5XMLnJYLp8n_KUE&libraries=places', array(), null, true );
		wp_enqueue_script( 'map-js', get_template_directory_uri() . '/dist/map.js', array('google-maps'), null, true );
	}

	wp_enqueue_script('osborne-js', get_template_directory_uri() . "/dist/bundle.js", array(), null, true);
}
add_action( 'wp_enqueue_scripts', 'osborne_scripts' );

// ACF Options Page

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();	
}

// ACF: Google Maps Key

function my_acf_init() {
	
	acf_update_setting('google_api_key', 'AIzaSyBMXz2xc_dbwKN_sSnu5XMLnJYLp8n_KUE');
}

add_action('acf/init', 'my_acf_init');

/**
 * Functions related to WooCommerce.
 */
require get_template_directory() . '/functions-woocommerce.php';

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
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

add_filter( 'woocommerce_shipping_package_name', 'custom_shipping_package_name' );
function custom_shipping_package_name( $name ) {
  return 'Delivery';
}

add_theme_support('woocommerce');

add_filter( 'woocommerce_loop_add_to_cart_link', function( $html, $product ) {
    if ( $product && $product->is_type( 'simple' ) && $product->is_purchasable() && $product->is_in_stock() && ! $product->is_sold_individually() ) {
        $html = '<form action="' . esc_url( $product->add_to_cart_url() ) . '" class="wcb2b-quantity" method="post" enctype="multipart/form-data">';
        $html .= woocommerce_quantity_input( array(), $product, false );
        $html .= '<button type="submit" class="button alt">' . esc_html( $product->add_to_cart_text() ) . '</button>';
        $html .= '</form>';
    }
    return $html;
}, 10, 2 );

// add_filter( 'woocommerce_get_script_data', 'change_alert_text', 10, 2 );
// function change_alert_text( $params, $handle ) {
//     if ( $handle === 'wc-add-to-cart-variation' )
//         $params['i18n_unavailable_text'] = __( 'You need to login or register to add this item to cart.', 'domain' );

//     return $params;
// }

/**
 * Hide shipping rates when free shipping is available.
 * Updated to support WooCommerce 2.6 Shipping Zones.
 *
 * @param array $rates Array of rates found for the package.
 * @return array
 */

function my_hide_shipping_when_free_is_available( $rates ) {
	$free = array();
	foreach ( $rates as $rate_id => $rate ) {
		if ( 'free_shipping' === $rate->method_id ) {
			$free[ $rate_id ] = $rate;
			break;
		}
	}
	return ! empty( $free ) ? $free : $rates;
}

add_filter( 'woocommerce_package_rates', 'my_hide_shipping_when_free_is_available', 100 );

add_action( 'woocommerce_thankyou', 'custom_woocommerce_auto_complete_paid_order', 10, 1 );

function custom_woocommerce_auto_complete_paid_order( $order_id ) {
    if ( ! $order_id )
    return;

    $order = wc_get_order( $order_id );

    if( $order->get_status()  === 'pending' ) {
        $order->update_status( 'processing' );
    }
}

