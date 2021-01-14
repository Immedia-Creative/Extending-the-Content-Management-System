<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package immedia
 */


$siteLayout = esc_attr( get_option( 'site_layout' ) );
if($siteLayout == 'Normal'){
get_header();
}
elseif($siteLayout == 'Linear'){
get_header("linear");
}
else{
get_header();	
}?>
	<div id="primary" class="content-area thisisArchiveTestimonials">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>
		
		<?php dynamic_sidebar('Testimonial Head'); ?>

		
		<?php
			if ( function_exists('yoast_breadcrumb') ) {
			  yoast_breadcrumb( '<p id="breadcrumbs" class="breadcrumb">','</p>' );
			}
		?>
 
	
			<?php
			// Get all the categories
			//$categories = get_terms( 'testimonial-category' );
			
			$categories = get_terms( array(
				'taxonomy' => 'testimonial-category',
				'orderby' => 'name',
				'order' => 'DESC' 
			) );


				// set up a new query for each category, pulling in related posts.
				$conditions = new WP_Query(
					array(
						'post_type' => 'testimonials',
						'post_status' => 'publish',
						'showposts' => -1,
						'tax_query' => array(
							array(
								'taxonomy'  => 'testimonial-category',
								// change this to apply doctors
								// 'terms'     => array( $category->slug ),
								'terms'     => 'user',
								'field'     => 'slug'
							)
						)
					)
				);

				$cat = $category->name;
				//$catID = str_replace(array( '(', ')' ), '', $cat);
				$catID = preg_replace("/[^a-zA-Z0-9\s]/", "", $cat);
				$catID = preg_replace('/\s+/', '_', $catID);
				
				?>
				
				<div class="row archive-row" id="<?php echo strtolower($catID);?>">
					<div class="col-md-12">

						<div class="row items-container">
							<?php while ($conditions->have_posts()) : $conditions->the_post(); ?>
							
							<?php if ( $cat == "Doctor" ){ ?>
								
								<div class="col-sm-6 col-md-6 col-lg-4 doctor-col">
									
							<?php } elseif ( $cat == "User" ){ ?>
								
								<div class="col-sm-6 col-md-6 col-lg-4 user-col">
								
							<?php } else { ?>
							
								<div class="col-sm-6 col-md-6 col-lg-4">
								
							<?php }
								
							 if ( false == get_post_format() ) { ?>	
								
									<a class="service-box-cont" href="<?php the_permalink(); ?>">
										<div class="service-box">
										
											<div class="thumb">
												<?php if ( has_post_thumbnail() ) {
													$thumb_id = get_post_thumbnail_id(get_the_ID());
													$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'service-image'); 
													$alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);

													echo '<img src="' . $featured_img_url . '" alt="' . $alt . '" />';
												} ?>
											</div>	
								
											<div class="service-content">
											
												<?php if (has_excerpt()) { 
													
														$excerpt = get_the_excerpt();
														echo  '<p class="excerpt">'. $excerpt . '</p>';
		
													} else {
															
														$content = get_the_content();
														$content = strip_shortcodes( $content );?>
														<p class="excerpt">
														<?php echo wp_trim_words( $content, 18 ); ?>
														</p>
														<?php 
														} 
														?>
														
													<?php $name = get_field( "name" );
														echo '<div class="testimonial-name">' . $name . '</div>';
													  ?>
										
													<div class="vc_btn3-container vc_btn3-inline ">
														<button class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-round vc_btn3-style-flat vc_btn3-icon-right vc_btn3-color-blue" title="">Read more <i class="vc_btn3-icon fas fa-chevron-right" aria-hidden="true"></i></button>
													</div>
											
											</div>
										</div>
									</a>
								
							<?php } ?>
								
							<?php if ( has_post_format( 'video' ) ) { ?>	
								
									<a class="service-box-cont" href="<?php the_permalink(); ?>">
										<div class="service-box">
										
											<div class="thumb">
												<?php if ( has_post_thumbnail() ) {
													$thumb_id = get_post_thumbnail_id(get_the_ID());
													$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'service-image'); 
													$alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);

													echo '<img class="testimonial-image" src="' . $featured_img_url . '" alt="' . $alt . '" />';
												} ?>
											</div>
										
											<div class="service-content">
												
													<h3><?php the_title(); ?></h3>
												
												
												<?php if (has_excerpt()) { 
													
														$excerpt = get_the_excerpt();
														echo  '<p class="excerpt">'. $excerpt . '</p>';
		
													} else {
															
														$content = get_the_content();
														$content = strip_shortcodes( $content );?>
														<p class="excerpt">
														<?php echo wp_trim_words( $content, 18 ); ?>
														</p>
														<?php 
														} 
														?>

													<div class="vc_btn3-container vc_btn3-inline ">
														<button class="vc_general vc_btn3 vc_btn3-size-md vc_btn3-shape-round vc_btn3-style-flat vc_btn3-icon-right vc_btn3-color-blue" title="">Learn more <i class="vc_btn3-icon fas fa-chevron-right" aria-hidden="true"></i></button>
													</div>

											</div>
										</div>
									</a>
							<?php } ?>
							
							</div>
							
							<?php endwhile; ?>
						</div>

						<?php
							// Reset things, for good measure
							$conditions = null;
							wp_reset_postdata();

						// end the loop

			
						
						dynamic_sidebar('Watch more success stories');
						
						?>		
						

						
				
					
					</div>
				

				
				</div>

			
		<?php
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>
		

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//get_sidebar();
get_footer();
