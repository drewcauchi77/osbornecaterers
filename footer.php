<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package osborne
 */

$address_1 = get_field('address_1', 'option');
$address_2 = get_field('address_2', 'option');
$address_3 = get_field('address_3', 'option');
$telephone = get_field('telephone', 'option');
$email = get_field('email', 'option');
$facebook = get_field('facebook', 'option');
$tripadvisor = get_field('tripadvisor', 'option');
?>

	</div><!-- #content -->

	<div class="section-header">
		<div class="wrapper">
			<h1>Get in touch to book a meeting</h1>
		</div>
	</div>

	<footer class="site-footer">
		<a class="back-to-top" title="Back to top" href="#top"><?php get_template_part('images/arrow-top.svg'); ?></a>
		<div class="wrapper">
			<div class="contact-details">
				<div class="address">
					<h3>Address:</h3>
					<?php echo $address_1; ?>,<br>
					<?php echo $address_2; ?>,</br>
					<?php echo $address_3; ?>
				</div>
				<div class="links">
					<a href="/terms-and-conditions">Terms & Conditions</a>,<br>
					<a href="/privacy-policy">Privacy Policy</a>,<br>
					<a href="/cookie-policy">Cookie Policy</a>
				</div>
				<div class="contact">
					<h3>Contact:</h3>
					<?php echo $telephone; ?><br>
					<a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>
				</div>
				<div class="social">
					<h3>Social:</h3>
					Visit our <a href="<?php echo $facebook; ?>" target="_blank">Facebook page</a><br>
					and rate us on <a href="<?php echo $tripadvisor; ?>" target="_blank">TripAdvisor</a>
				</div>
			</div>
			<div class="site-info">
				<a href="https://www.stevesandco.com" target="_blank">
					<img width="100" height="18" class="sc-logo" src="<?php echo get_template_directory_uri(); ?>/images/sco-logo.svg" alt="STEVES&amp;CO.">
					<span class="sc-text">another<br>steves&amp;co. website</span>
				</a>
			</div>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

<script type="text/javascript">
	$(document).ready(function(){
		// Script for checkout time selection
		$('input#event_time_new').timepicker({
			timeFormat: 'HH:mm',
			interval: 15,
			minTime: '10:00',
			maxTime: '18:00',
			defaultTime: '10:00',
			startTime: '10:00',
			dynamic: false,
			dropdown: true,
			scrollbar: true
		});
	});
</script>

</body>
</html>
