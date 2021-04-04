<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;
// Get the post to obtain the categorisation of the product
global $post;

$fields = get_fields();

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>

	<?php 
	// Get all the product categories, WP object in array
	$terms = get_the_terms( $post->ID, 'product_cat' );

	foreach ($terms as $term) {
		$categoryName = $term->name;
		$categoryLink = get_term_link($term->slug, 'product_cat');
	} ?>

	<span class="product-breadcrumb">
		<a href="/">Home</a> > 
		<a href="/online-shop">Online Shop</a> > 
		<a href="<?php echo $categoryLink; ?>"><?php echo $categoryName; ?></a> > 
		<div class="product-name"><?php echo $post->post_title; ?></div>
	</span>

	<?php
	/**
	 * Hook: woocommerce_before_single_product_summary.
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20
	 */
	do_action( 'woocommerce_before_single_product_summary' );
	?>

	<div class="summary entry-summary">
		<h1 class="product-title"><?php echo $post->post_title; ?></h1>
		<?php
		/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_title - 5
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */
		do_action( 'woocommerce_single_product_summary' );
		?>

		<?php if($fields !== false){ ?>
			<div class="additional-product-information">
				<?php foreach($fields as $key => $field){ ?>
					<?php if($field !== ''){ ?>
						<div class="specific-info <?php echo $key.'-info' ?>">
							<h3 class="section-title"><?php echo $key; ?></h3>
							<p class="section-details"><?php echo $field; ?></p>
						</div>
					<?php } ?>
				<?php } ?>
			</div>
		<?php } ?>

		<?php if($product->is_type('simple')){ ?>
			<div class="simple-price">
				<?php 
				$productPrice = (float)$product->price; 
				$productPrice = number_format($productPrice, 2);
				?>
				<span>€<?php echo $productPrice; ?></span>
			</div>
		<?php } ?>
	</div>

	<?php
	/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action( 'woocommerce_after_single_product_summary' );
	?>
</div>

<?php do_action( 'woocommerce_after_single_product' ); ?>