<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package immedia
 */


get_header("no-container");	
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<div class="grey-swatch">
				<div class="container">
				<?php
					if ( function_exists('yoast_breadcrumb') ) {
					  yoast_breadcrumb( '<p id="breadcrumbs" class="breadcrumb">','</p>' );
					}
				?>
				</div>
			</div>
			
			<div class="spacer-wrapper">
				<div class="visible-xs" style="height:50px"></div>
				<div class="visible-sm" style="height:50px"></div>
				<div class="visible-md" style="height:50px"></div>
				<div class="visible-lg" style="height:50px"></div>
			</div>	
		
			<div class="container">
			<?php
			if ( have_posts() ) : ?>

				<!--<div class="row">-->
				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post(); 
				
					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content-blogs' );

				endwhile;

				the_posts_navigation(); ?>
				<!--</div> -->
				<?php
				else :

					get_template_part( 'template-parts/content', 'none' );

				endif; ?>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
//get_sidebar();
get_footer();
