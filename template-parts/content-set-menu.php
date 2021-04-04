<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package osborne
 */
?>
aa
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="entry-content">
		<section>
			<div class="section-container">
				<div class="wrapper">
					<?php
						$title = get_the_title();
						$price = get_field('price_per_person');
						$email = 'mailto:' . get_field('email') . '?subject=' . $title;
					?>

					<div class="menu-details">
						<h1>
							<?php echo $title; ?><br>
							<span class="num-items"><?php echo sizeof(get_field('menu_items')); ?> items</span>
						</h1>
						<span class="gold-colour">€<?php echo $price; ?> per person (excl. VAT)</span>

						<?php if (have_rows('menu_items')): ?>
							<ul class="menu-items">
								<?php while (have_rows('menu_items')) : the_row(); ?>
									<li><?php echo get_sub_field('item'); ?></li>
								<?php endwhile; ?>
							</ul>
						<?php endif; ?>
						<?php do_action( 'woocommerce_single_product_summary' ); ?>
						<p>Minimum Order is 10 pax</p>
						
						<a class="btn-close" href="<?php echo get_permalink($parent); ?>">Close</a>
					</div>

					<?php
						the_content( sprintf(
							wp_kses(
								/* translators: %s: Name of current post. Only visible to screen readers */
								__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'osborne' ),
								array(
									'span' => array(
										'class' => array(),
									),
								)
							),
							get_the_title()
						) );

						wp_link_pages( array(
							'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'osborne' ),
							'after'  => '</div>',
						) );
					?>
				</div>
			</div>
		</section>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
