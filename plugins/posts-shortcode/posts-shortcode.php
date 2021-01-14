<?php

/**
 * Plugin Name: Display posts shortcode
 * Plugin URI: http://www.immedia-creative.com
 * Description: This plugin displays the posts.
 * Version: 1.0.0
 * Author: Cameron
 * Author URI: http://www.immedia-creative.com
 * License: GPL2
 */


    add_shortcode( 'display-posts', 'display_posts' );

    function display_posts($atts){
		
		extract(shortcode_atts( array(
		'posts_per_page' => '',
		) , $atts ));
		
		if (!empty($posts_per_page)) {
			
			$args = (array(
				'posts_per_page'	=> $posts_per_page
			));
			
		} else {
		
			$args = (array(
				'posts_per_page'	=> -1
			));
	
		}
	
			$string = '';
			$string .= '<div class="row">';
	
			$query = new WP_Query( $args );


			  // Start looping over the query results.
			while ( $query->have_posts() ) {
		 
				$query->the_post();
			
				$string .= '<div class="article-col col-md-6 col-lg-6">';
			
					$string .= '<a class="article-link" href="'.get_permalink().'">';
					
					$string .= '<div class="vc_separator wpb_content_element vc_separator_align_center vc_sep_width_10 vc_sep_border_width_3 vc_sep_pos_align_left vc_separator_no_text vc_sep_color_blue  wpb_animate_when_almost_visible wpb_left-to-right left-to-right wpb_animate_when_almost_visible wpb_left-to-right left-to-right wpb_start_animation animated">';
						$string .= '<span class="vc_sep_holder vc_sep_holder_l">';
							$string .= '<span class="vc_sep_line"></span>';
						$string .= '</span>';
						$string .= '<span class="vc_sep_holder vc_sep_holder_r">';
							$string .= '<span class="vc_sep_line"></span>';
						$string .= '</span>';
					$string .= '</div>';
					
							 
								$str = get_the_title(); 
								$string .= '<h3>' . $str . '</h3>';
								
								if (has_excerpt()) { 
									$excerpt = get_the_excerpt();
									$string .= '<p class="excerpt">'. $excerpt . '</p>';
								}
								
								$date = get_the_date();
								$string .= '<div class="article-date">'. $date . '</div>';
						
					$string .= '</a>';

				$string .= '</div>';
				// Contents of the queried post results go here.
		 
			}
			wp_reset_postdata();
			$string .=  '</div>';
			return $string;
	}
		?>