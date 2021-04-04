<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package osborne
 */

// Required to get the slug of the page to eliminate and show accordingly.
global $post;

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if (is_page('credit-card')):
					
					get_template_part('template-parts/content-credit-card');
				endif;
	?>

		<div class="entry-content">

			<?php
				// sub title
				$subtitle = get_field('subtitle');

				if ($subtitle):
					// To hide wrapper in Online Shop Page
					if($post->post_title !== "Online Shop"){ ?>

						<div class="section-header">
							<div class="wrapper">
								<h1><?php echo $subtitle; ?></h1>
							</div>
						</div>

					<?php }else{ ?>

						<div class="online-shop-breadcrumb">
							<div class="wrapper">
								<span><a href="/">Home</a></span> > Online Shop
							</div>
						</div>

					<?php } ?>

			<?php
				endif;

				// page sections
				if( have_rows('page_content') ):

					// loop through the rows of data
					$cnt = 0;
					
					while ( have_rows('page_content') ) : the_row();
						$cnt += 1;
						set_query_var('section_id', $cnt);
						
						switch(get_row_layout()):
							case 'page_sections':
								get_template_part('components/page-section');
								break;
							case 'page_gallery':
								get_template_part('components/page-gallery');
								break;
							case 'page_steps':
								get_template_part('components/page-steps');
								break;
							case 'set_menus':
								// Previously used this but no longer required used new template instead
								// get_template_part('components/set-menus');
								get_template_part('components/online-shop');
								break;
							case 'contact_details':
								get_template_part('components/contact-details');
								break;
						endswitch;

					endwhile;
				endif;
			?>

			<?php
				the_content();

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'osborne' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						wp_kses(
							/* translators: %s: Name of current post. Only visible to screen readers */
							__( 'Edit <span class="screen-reader-text">%s</span>', 'osborne' ),
							array(
								'span' => array(
									'class' => array(),
								),
							)
						),
						get_the_title()
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->