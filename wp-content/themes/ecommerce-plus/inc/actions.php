<?php

//Contact
add_action('ecommerce_plus_contact', 'ecommerce_plus_contact');

function ecommerce_plus_contact() {

		$options = ecommerce_plus_get_theme_options();
?>
<div id="home-contact-section" >
	<div class="container text-center">
			<div class="row">
				<div class="section-title"><h2><?php echo esc_html('Contact Us', 'ecommerce-plus'); ?></h2></div>
			</div>	
			<div class="row">
				<?php echo do_shortcode($options['contact_form_shortcode']); ?>
			</div>
	</div>		
</div>
<?php
}


//Call to Action
add_action('ecommerce_plus_cta', 'ecommerce_plus_cta');

function ecommerce_plus_cta() {

		$options = ecommerce_plus_get_theme_options();
			
			
		$args = array( 'post_type' => 'page', 'ignore_sticky_posts' => 1 , 'post__in' => array($options['cta_page']) );
		$result = new WP_Query($args);
		$link = '';
		
		?>
		<div id="home-cta-section" class="cta-section" style="background-image:url(<?php echo esc_url($options['cta_image']); ?>);color:<?php echo esc_attr($options['cta_color']);?>;background-repeat: no-repeat;background-size: cover;background-attachment: fixed;background-position: center center;" >		
		<div class="container cta-content text-center" style="padding:<?php echo (absint($options['cta_height'])/2); ?>px 15px;">
			<div class="row">
				<div class="col-sm-12">
		<?php
		while ( $result->have_posts() ) :
			$result->the_post();
			the_content();
			$link = get_page_link();
		endwhile;
		wp_reset_postdata();
		echo '<div class="cta-text"><h3>'.esc_html($options['cta_text']).'</h3></div>';
		?>
				</div>
			</div>
		<?php if($options['cta_label'] !=''): ?>	
			<div class="row"> 
				<div class="col-sm-12">	
					<a class="call-to-action btn" href="<?php echo esc_url($options['cta_link']) ?>"><?php echo esc_html($options['cta_label']); ?></a><p></p>
				</div>
			</div>
		<?php endif; ?>			
		</div>
		</div>
<?php
}

// Services
add_action('ecommerce_plus_services', 'ecommerce_plus_services');

function ecommerce_plus_services() {

		$options = ecommerce_plus_get_theme_options();
			
			
		$args = array( 'post_type' => 'page', 'ignore_sticky_posts' => 1 , 'post__in' => array($options['service_page']) );
		$result = new WP_Query($args);
		
		?>
		<div id="home-service-section" class="container">
			<div class="row">
				<div class="col-sm-12">
		<?php
		while ( $result->have_posts() ) :
			$result->the_post();
			the_content();
		endwhile;
		wp_reset_postdata();
		?>
				</div>
			</div>
		</div>
<?php
}


// Slider
add_action('ecommerce_plus_post_slider', 'ecommerce_plus_post_slider');

function ecommerce_plus_post_slider() {

	$options = ecommerce_plus_get_theme_options();
	
	$args = array(	'category'	=> $options['slider_cat'], 
					'title_text'=> $options['slider_title_text'],
					'max_height'=> $options['slider_height'],
					'max_items'	=> $options['slider_max'], 
					'btn_label'	=> $options['slider_btn_label'],
					'btn_url'	=> $options['slider_btn_url']
					) ;
	
	
	?>
	<div id="home-post-slider"><?php the_widget('ecommerce_plus_post_slider_widget', $args);?></div>
	<?php
}

//Showcase
add_action('ecommerce_plus_product_showcase', 'ecommerce_plus_product_showcase');

function ecommerce_plus_product_showcase() {

	if (!class_exists('WooCommerce')) return;

	$options = ecommerce_plus_get_theme_options();
	
	$product_args = array(	'category'	=> $options['prod_slider_cat'], 
							'product_meta'		=> $options['prod_slider_title_text'],
							'product_desc'		=> $options['prod_slider_title_text'], //
							'max_height'		=> $options['prod_slider_height'],
							'max_items'			=> $options['prod_slider_max'], 
							'button_lbl'		=> $options['prod_slider_btn_label'],
							
							'display_sub_cat' 	=> true					
						);
					
	$navigation_args = array('title' => $options['prod_slider_cat_label'],) ;				

	
	if ($options['prod_navigation_section_enable']){
	?>
	<div id="home-product-showcase" class="container padding-top-md">
		<div class="row">
		
		<div class="col-sm-3 col-xs-12">
		<div><?php the_widget('ecommerce_plus_product_navigation_widget', $navigation_args);?></div>
		</div>	
		
		<div class="col-sm-9 col-xs-12">
		<div class="showcase-product-slider"><?php the_widget('ecommerce_plus_product_slider_widget', $product_args);?></div>
		</div>
		
		
		</div>
	</div>
	<?php
	} else {
	?>
	<div><?php the_widget('ecommerce_plus_product_slider_widget', $product_args);?></div>
	<?php	
	}
}


// Product Slider
add_action('ecommerce_plus_product_slider', 'ecommerce_plus_product_slider');

function ecommerce_plus_product_slider() {

	if (!class_exists('WooCommerce')) return;

	$options = ecommerce_plus_get_theme_options();
	$product_args = array(	 
							'slider'		=> $options['product_section_1_slider'],
							'category_id'	=> $options['product_section_1_product_cat'],
							'feature'		=> $options['product_section_1_product_feature'], //
							'colums'		=> $options['product_section_1_colums'],
							'max_items'		=> $options['product_section_1_num_products'], 
							'min_height'	=> $options['product_section_1_height'],
							'image_height' 	=> $options['product_section_1_image_height'],
							'slider_speed' 	=> $options['product_section_1_speed'],											
						);	
	
	//category
	?><div id="home-product-1" class="container">
		<div class="row">
			<div class="section-title"><h2><?php echo esc_html($options['product_section_1_title'], 'ecommerce-plus'); ?></h2></div>
		</div>	
	<?php if ($options['product_section_1_type'] == 0) { ?>
		<div class="row">
			<?php the_widget('ecommerce_plus_product_category_widget', $product_args); ?>
		</div>
	<?php
	} else {	
	?>
		<div class="row">
			<?php the_widget('ecommerce_plus_product_carousel_grid_widget', $product_args); ?> 
		</div>
	<?php
	}
	?></div><?php
}


// Product Slider
add_action('ecommerce_plus_product_slider_2', 'ecommerce_plus_product_slider_2');

function ecommerce_plus_product_slider_2() {

	if (!class_exists('WooCommerce')) return;

	$options = ecommerce_plus_get_theme_options();
	$product_args = array(	 
							'slider'		=> $options['product_section_2_slider'],
							'category_id'	=> $options['product_section_2_product_cat'],
							'feature'		=> $options['product_section_2_product_feature'], //
							'colums'		=> $options['product_section_2_colums'],
							'max_items'		=> $options['product_section_2_num_products'], 
							'min_height'	=> $options['product_section_2_height'],
							'image_height' 	=> $options['product_section_2_image_height'],
							'slider_speed' 	=> $options['product_section_2_speed'],											
						);	
	
	//category
	?><div id="home-product-2" class="container">
		<div class="row">
			<div class="section-title"><h2><?php echo esc_html($options['product_section_2_title']); ?></h2></div>
		</div>	
	<?php if ($options['product_section_2_type'] == 0) { ?>
		<div class="row">
			<?php the_widget('ecommerce_plus_product_category_widget', $product_args); ?> 
		</div>
	<?php
	} else {	
	?>
		<div class="row">
			<?php the_widget('ecommerce_plus_product_carousel_grid_widget', $product_args); ?> 
		</div>
	<?php
	}
	?></div><?php
}