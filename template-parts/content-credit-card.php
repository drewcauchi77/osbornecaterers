<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package osborne
 */
$apco_url = $_SESSION['cc_payment'];
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


	<div class="entry-content">
        <iframe src="<?php echo $apco_url; ?>" frameborder="0" class="cc-payment"></iframe>
	</div><!-- .entry-content -->


	

</article><!-- #post-## -->
