<?php

/**
 * Plugin Name: Display testimonials shortcode
 * Plugin URI: http://www.immedia-creative.com
 * Description: This plugin displays the testimonials grid.
 * Version: 1.0.0
 * Author: Cameron
 * Author URI: http://www.immedia-creative.com
 * License: GPL2
 */


    add_shortcode( 'display-testimonials', 'display_testimonials' );

    function display_testimonials($atts){
		
		extract(shortcode_atts( array(
		'categories' => '',
		'posts_per_page' => '',
		) , $atts ));
		
		if ( is_page( 'how-exciteosa-can-help' ) ){
			
			$args = array(
			'post_type' => 'testimonials',
            'post_status' => 'publish',
			'orderby'         => 'post_date',
			'order'           => 'DESC',		
			'posts_per_page' => -1,
			'meta_query' => array(
					array(
						'key'     => 'page_feeds',
						'value'   => 'how_snoozeal_can_help_feed',
						'compare' => 'LIKE'
					)
				)
			);
			
		} elseif ( is_page( 'Clinical Evidence' ) ){
			
			$args = array(
			'post_type' => 'testimonials',
            'post_status' => 'publish',
			'orderby'         => 'post_date',
			'order'           => 'DESC',		
			'posts_per_page' => -1,
			'meta_query' => array(
					array(
						'key'     => 'page_feeds',
						'value'   => 'clinical_evidence_feed',
						'compare' => 'LIKE'
					)
				)
			);
			
		}

		elseif (empty($categories) && empty($posts_per_page)) {
					  		
        $args = array(
            'post_type' => 'testimonials',
            'post_status' => 'publish',
			'orderby'         => 'post_date',
			'order'           => 'DESC',		
			'posts_per_page' => -1
		);
	} elseif (empty($categories) && !empty($posts_per_page)) {
					  		
        $args = array(
            'post_type' => 'testimonials',
            'post_status' => 'publish',
			'orderby'         => 'post_date',
			'order'           => 'DESC',		
			'posts_per_page' => $posts_per_page
		);
	} elseif (!empty($categories) && empty($posts_per_page)) {
		
		$catArray = explode(',', $categories);
					  		
        $args = array(
            'post_type' => 'testimonials',
            'post_status' => 'publish',
			'orderby'         => 'post_date',
			'order'           => 'DESC',		
			'posts_per_page' => -1, 
			'tax_query' => array(
				array (
					'taxonomy' => 'testimonial-category',
					'field' => 'name',
					'terms' => $catArray
				)
			),
		);
	} else {
		
		$catArray = explode(',', $categories);
		
        $args = array(
            'post_type' => 'testimonials',
            'post_status' => 'publish',
			'orderby'         => 'post_date',
			'order'           => 'DESC',		
			'posts_per_page' => $posts_per_page, 
			'tax_query' => array(
				array (
					'taxonomy' => 'testimonial-category',
					'field' => 'name',
					'terms' => $catArray
				)
			),
		);
		
	}
	
	$string = '';
	$string = '<div class="row">';
		
		$the_query = new WP_Query($args);
		if ($the_query->have_posts()) :
			while ($the_query->have_posts()) { 
			$the_query->the_post();
			
				if( has_term( 'Doctor', 'testimonial-category' ) ) {
					
					$string .=  '<div class="col-sm-6 col-md-6 col-lg-6 doctor-col">';

				}
				elseif( has_term( 'User', 'testimonial-category' ) ) {
					
					$string .=  '<div class="col-sm-6 col-md-6 col-lg-6 user-col">';

				} else {
					
					$string .=  '<div class="col-sm-6 col-md-6 col-lg-6">';
				}
				
				if ( false == get_post_format() ) {	
								
					$string .=  '<a class="service-box-cont" href="'. get_post_permalink() . '">';
						$string .=  '<div class="service-box">';
						
							$string .=  '<div class="thumb">';
								if ( has_post_thumbnail() ) {
									$thumb_id = get_post_thumbnail_id(get_the_ID());
									$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'service-image'); 
									$alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);

									$string .= '<img src="' . $featured_img_url . '" alt="' . $alt . '" />';
								}
							$string .=  '</div>';	
				
							$string .=  '<div class="service-content">';
							
								 if (has_excerpt()) { 
									
										$excerpt = get_the_excerpt();
										$string .=  '<p class="excerpt">'. $excerpt . '</p>';

									} else {
											
										$content = get_the_content();
										$content = strip_shortcodes( $content );
										$string .=  '<p class="excerpt">' . wp_trim_words( $content, 18 ) . '</p>';

									} 
										
									$name = get_field( "name" );
									$string .=  '<div class="testimonial-name">' . $name . '</div>';

						
									$string .=  '<div class="vc_btn3-container vc_btn3-inline ">';
										$string .=  '<button class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-round vc_btn3-style-flat vc_btn3-icon-right vc_btn3-color-blue" title="">Read more <i class="vc_btn3-icon fas fa-chevron-right" aria-hidden="true"></i></button>';
									$string .=  '</div>';
							
							$string .=  '</div>';
						$string .=  '</div>';
					$string .=  '</a>';
				
				}
				
				if ( has_post_format( 'video' ) ) {	
								
					$string .=  '<a class="service-box-cont" href="'. get_post_permalink() . '">';
						$string .=  '<div class="service-box">';
						
							$string .=  '<div class="thumb">';
								if ( has_post_thumbnail() ) {
									$thumb_id = get_post_thumbnail_id(get_the_ID());
									$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'service-image'); 
									$alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);

									$string .=  '<img class="testimonial-image" src="' . $featured_img_url . '" alt="' . $alt . '" />';
								}
							$string .=  '</div>';
						
							$string .=  '<div class="service-content">';
								
									$string .=  '<h3>' . get_the_title() . '</h3>';
								
								
									if (has_excerpt()) { 
									
										$excerpt = get_the_excerpt();
										$string .=  '<p class="excerpt">'. $excerpt . '</p>';

									} else {
											
										$content = get_the_content();
										$content = strip_shortcodes( $content );
										$string .=  '<p class="excerpt">' . wp_trim_words( $content, 18 ) . '</p>';

									} 

									$string .=  '<div class="vc_btn3-container vc_btn3-inline ">';
										$string .=  '<button class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-round vc_btn3-style-flat vc_btn3-icon-right vc_btn3-color-blue" title="">Learn more <i class="vc_btn3-icon fas fa-chevron-right" aria-hidden="true"></i></button>';
									$string .=  '</div>';

							$string .=  '</div>';
						$string .=  '</div>';
					$string .=  '</a>';
				} 
							
			$string .=  '</div>';

			}
		endif;
		wp_reset_postdata();
		$string .=  '</div>';
		return $string;
	}
		?>