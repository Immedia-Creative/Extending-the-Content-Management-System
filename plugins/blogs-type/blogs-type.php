<?php global $wp_query;
/**
 * Plugin Name: Blogs Type
 * Plugin URI: http://www.immedia-creative.com
 * Description: Creates a blog type.
 * Version: 1.0.0
 * Author: Chris Brown
 * Author URI: http://www.brownbearmedia.com
 * License: GPL2
 */
 
function post_title(){

		$title = get_the_title();
		$string = '<h1>' . $title . '</h1>';

			
		return($string);
}	
add_shortcode( 'post-title', 'post_title' );

function post_image(){

		if ( has_post_thumbnail() ) { 
			
			$image = get_the_post_thumbnail();
			$string = $image;

		} else {
			
			$string = '<img src="/wp-content/uploads/2020/03/snoozeal-logo.png" alt="Snoozeal" />';
			
		} 

		return($string);
}	
add_shortcode( 'post-image', 'post_image' );

function post_details(){

		$string = '<div class="post-details">';

			$string .= '<hr />';
			
			$string .= '<span class="cat-author">';
				$author = get_the_author(); 
				$string .= 'By ' . $author;
			$string .= '</span>';
			
			$string .= '<span class="inline-sep">|</span>';
			
			$string .= '<span class="cat-date">';
				$date = get_the_date();
				$string .= $date;
			$string .= '</span>';
			
			
			if ($terms_cat = get_the_term_list( $post->ID, 'blog-category', '', ', ' )){
				
			$string .= '<span class="inline-sep">|</span>';

			$string .= '<span class="cat-list">';
				
			$string .= 'Categories ' . $terms_cat;
			
			$string .= '</span>';
			
			}
			
			if ($terms_tag = get_the_term_list( $post->ID, 'blog-tag', '', ', ' )){
				
			$string .= '<span class="inline-sep">|</span>';

			$string .= '<span class="cat-tag">';
				
			$string .= 'Tags ' . $terms_tag;
			
			$string .= '</span>';
			
			}
							
			$string .= '<hr />';
			
		$string .= '</div>';
		return($string);
}	
add_shortcode( 'post-details', 'post_details' );

 
function create_blogposttype() {

	register_post_type( 'blog',
	// CPT Options
		array(
			'labels' => array(
				'name' => __( 'Blog' ),
				'singular_name' => __( 'Article' ),
			),
			'public' => true,
			'publicly_queryable' => true, // Set to false hides Single Pages
			'show_ui'=> true,
			'has_archive' => true,
			'rewrite' => array('slug' => 'blog'),
			'show_in_menu' => true,
			'menu_position' => 5,
			'supports' => array( 'title','editor','author','revisions','post-formats','thumbnail','excerpt'),	
			'menu_icon'           => 'dashicons-welcome-write-blog',
		)
	);
}


add_action( 'init', 'create_blogposttype' );

function create_blog_taxonomy() {
	register_taxonomy(
		'blog-category',
		'blog',
		array(
		'labels' => array(
			'name'          => 'Blog Categories',
			'singular_name' => 'Blog Category',
		),
		'hierarchical' => true
	));
}

add_action( 'init', 'create_blog_taxonomy' );

function create_blog_tag() {
	register_taxonomy(
		'blog-tag',
		'blog',
		array(
		'labels' => array(
			'name'          => 'Blog Tags',
			'singular_name' => 'Blog Tag',
		),
		'hierarchical' => false
	));
}

add_action( 'init', 'create_blog_tag' );


