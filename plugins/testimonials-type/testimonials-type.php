<?php global $wp_query;
/**
 * Plugin Name: Testimonials Type
 * Plugin URI: http://www.immedia-creative.com
 * Description: Creates a testimonials type and displays a random tesimonial when shortcode [testimonial] is used.
 * Version: 1.0.0
 * Author: Chris Brown
 * Author URI: http://www.brownbearmedia.com
 * License: GPL2
 */

function cb_testimonials(){

  $mypost = array( 
  'post_type' => 'testimonials',
  'orderby' => 'rand', 
  'posts_per_page' => '1',
   );
    $loop = new WP_Query( $mypost );

while ( $loop->have_posts() ) { $loop->the_post();



/*$outstring .=  '<h3>1' . get_the_title() . '</h3>';*/
	
	
$outstring =  '<div class="testimonial wpb_content_element">';
	$outstring .=  '<div class="testimon">'.get_the_content().'</div>';
	$outstring .=  '<div class="testimon-auth" style="margin-bottom:20px;">'.get_the_title().'</div>';
	$outstring .=  '<div class="vc_btn3-container vc_btn3-center">';
		$outstring .=  '<a class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-square vc_btn3-style-classic" style="color:#ffffff; background:#1e324d;" href="/testimonials/">All Testimonials</a>';
	$outstring .=  '</div>';
$outstring .=  '</div>';

	return($outstring);
	}
	}	


	add_shortcode( 'testimonial', 'cb_testimonials' );

 
function create_testimonialsposttype() {

	register_post_type( 'testimonials',
	// CPT Options
		array(
			'labels' => array(
				'name' => __( 'Testimonials' ),
				'singular_name' => __( 'Testimonial' ),
			),
			'public' => true,
			'publicly_queryable' => true, // Set to false hides Single Pages
			'show_ui'=> true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'testimonials'),
			'show_in_menu' => true,
			'menu_position' => 5,
			'supports' => array( 'title','editor','author','revisions','post-formats','thumbnail','excerpt'),	
			'menu_icon'           => 'dashicons-testimonial',
		)
	);
}


add_action( 'init', 'create_testimonialsposttype' );

function create_testi_taxonomy() {
	register_taxonomy(
		'testimonial-category',
		'testimonials',
		array(
			'label' => 'Testimonial Categories',
			'hierarchical' => true,
		)
	);
}

add_action( 'init', 'create_testi_taxonomy' );


