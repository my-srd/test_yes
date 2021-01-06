<?php
/**
 * Template Name: Home - Page
 */

get_header(); 

$ecommerce_plus_options = ecommerce_plus_get_theme_options();
?>

<div class="home-template-wrapper">
	<?php
		do_action($ecommerce_plus_options['home_section_1']);
		do_action($ecommerce_plus_options['home_section_2']);
		do_action($ecommerce_plus_options['home_section_3']);
		do_action($ecommerce_plus_options['home_section_4']);
		do_action($ecommerce_plus_options['home_section_5']);
		do_action($ecommerce_plus_options['home_section_6']);
		do_action($ecommerce_plus_options['home_section_7']);					
	?>
</div>

<?php
get_footer();
