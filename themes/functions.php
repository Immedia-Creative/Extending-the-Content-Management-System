<?php //


add_action( 'wp_enqueue_scripts', 'enqueue_parent_styles' );
function enqueue_parent_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri().'/style.css' );
}

add_action('wp_enqueue_scripts', 'enqueue_child_js');
function enqueue_child_js() {
	wp_register_script('custom_script', get_stylesheet_directory_uri() . '/js/custom.js',   array('jquery'),   '1.0' );
	wp_enqueue_script('custom_script'); 
}

//Add ability to click parent menu items
function immedia_get_navwalker() {
       	require get_stylesheet_directory() . '/inc/wp_bootstrap_navwalker.php';
    }
add_action('after_setup_theme', 'immedia_get_navwalker');

//Change mobile nav to work at 991 rather than 768
 function immedia_get_verticalnav() {
 	   $verticalNav = esc_attr( get_option( 'vertical_nav' ) );
		if($verticalNav == 'On'){
			//includes change @media to 991 and custom css to call nav hamburger earlier
			wp_enqueue_style( 'immedia-vertical-nav-css', get_stylesheet_directory_uri() . '/inc/vertical-nav/vertical-nav.css' );
			wp_enqueue_script( 'immedia-vertical-nav-js', get_stylesheet_directory_uri() . '/inc/vertical-nav/vertical-nav.js', array(), '20151215', true );
		}
    }
	add_action('wp_enqueue_scripts', 'immedia_get_verticalnav');
	
//Fetch match height js library
 function match_height() {
			wp_enqueue_script( 'match-heught-js', get_stylesheet_directory_uri() . '/js/jquery-match-height/jquery.matchHeight.js', array(), '20151215', true );
    }
	add_action('wp_enqueue_scripts', 'match_height');
	
// Owl slider
 function owl_slider() {
			wp_enqueue_script( 'owl-slider-js', get_stylesheet_directory_uri() . '/js/owlcarousel/owl.carousel.min.js', array(), '20151215', true );
			wp_enqueue_style( 'owl-slider-css', get_stylesheet_directory_uri() . '/js/owlcarousel/owl.carousel.min.css' );
			wp_enqueue_style( 'owl-slider-theme', get_stylesheet_directory_uri() . '/js/owlcarousel/owl.theme.default.min.css' );
    }
	add_action('wp_enqueue_scripts', 'owl_slider');
	
// Counter up
 function counter_up() {
	 		wp_enqueue_script( 'counterup-js', get_stylesheet_directory_uri() . '/js/jquery.counterup/jquery.counterup.min.js' );
		wp_enqueue_script( 'waypoints-js', get_stylesheet_directory_uri() . '/js/waypoints/lib/jquery.waypoints.min.js' );
}
	add_action('wp_enqueue_scripts', 'counter_up');
	
// Shopify css extension
 function shopify_css() {
	 	wp_enqueue_style( 'shopify-css', get_stylesheet_directory_uri() . '/css/shopify.css' );
}
	add_action('wp_enqueue_scripts', 'shopify_css');
	
//Register custom sidebars
function immedia_widget_init() {
	register_sidebar( array(
		'name'          => ( 'CTA Bar' ),
		'id'            => 'cta-bar',
		'before_widget' => '',
		'after_widget'  => '',
	) );
	
	register_sidebar( array(
		'name'          => ( 'Testimonial Head' ),
		'id'            => 'testimonial-head',
		'before_widget' => '',
		'after_widget'  => '',
	) );
	
	register_sidebar( array(
		'name'          => ( 'News Head' ),
		'id'            => 'news-head',
		'before_widget' => '',
		'after_widget'  => '',
	) );
	
	register_sidebar( array(
		'name'          => ( 'Search Head' ),
		'id'            => 'search-head',
		'before_widget' => '',
		'after_widget'  => '',
	) );
	
	register_sidebar( array(
		'name'          => ( 'Main Modal' ),
		'id'            => 'main-modal',
		'before_widget' => '',
		'after_widget'  => '',
	) );
		register_sidebar( array(
		'name'          => ( 'CTA for HCP' ),
		'id'            => 'cta-for-hcp',
		'before_widget' => '',
		'after_widget'  => '',
	) );
		register_sidebar( array(
		'name'          => ( 'Watch more success stories' ),
		'id'            => 'watch-more-success-stories',
		'before_widget' => '',
		'after_widget'  => '',
	) );
}
add_action( 'widgets_init', 'immedia_widget_init' );

// add new menu location
function register_menu() {
register_nav_menu('top-bar-menu',__( 'Top bar menu' ));
}
add_action( 'init', 'register_menu' );

//remove top bar wigdet area as is being used for menu
add_action( 'after_setup_theme', 'parent_override' );
function parent_override() {
    unregister_sidebar('top-bar'); 
}


// add post-formats
add_action( 'after_setup_theme', 'wpsites_child_theme_posts_formats', 11 );
function wpsites_child_theme_posts_formats(){
 add_theme_support( 'post-formats', array(
    'video',
    ) );
}

//Add image size for service box
add_image_size( 'service-image', 558, 312, array( 'middle', 'top' ) );

// add search shortcode
function wpbsearchform( $form ) {
 
    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '">
	<div class="input-group">
	<input type="text" value="' . get_search_query() . '" name="s" id="s" class="form-control" placeholder="Search">
	<span class="input-group-btn"><button class="btn" type="submit" id="searchsubmit" value="Search"><i class="fa fa-search"></i></button></span>
	</div>
	</form>';
 
    return $form;

}
 
add_shortcode('wpbsearch', 'wpbsearchform');

// Search remove vc
/** add this to your function.php child theme to remove ugly shortcode on excerpt */
 
if(!function_exists('remove_vc_from_excerpt'))  {
  function remove_vc_from_excerpt( $excerpt ) {
    $patterns = "/\[[\/]?vc_[^\]]*\]/";
    $replacements = "";
    return preg_replace($patterns, $replacements, $excerpt);
  }
}
 
/** * Original elision function mod by Paolo Rudelli */
 
if(!function_exists('kc_excerpt')) {
 
/** Function that cuts post excerpt to the number of word based on previosly set global * variable $word_count, which is defined below */
 
  function kc_excerpt($excerpt_length = 60) {
 
    global $word_count, $post;
 
    $word_count = isset($word_count) && $word_count != "" ? $word_count : $excerpt_length;
 
    $post_excerpt = $post->post_excerpt != "" ? $post->post_excerpt : strip_tags($post->post_content); $clean_excerpt = strpos($post_excerpt, '...') ? strstr($post_excerpt, '...', true) : $post_excerpt;
 
    /** add by PR */
 
    $clean_excerpt = strip_shortcodes(remove_vc_from_excerpt($clean_excerpt));
 
    /** end PR mod */
 
    $excerpt_word_array = explode (' ',$clean_excerpt);
 
    $excerpt_word_array = array_slice ($excerpt_word_array, 0, $word_count);
 
    $excerpt = implode (' ', $excerpt_word_array).''; echo ''.$excerpt.'';
 
  }
 
}

// Turn off big image filer WP 5.3
add_filter( 'big_image_size_threshold', '__return_false' );


