<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package immedia
 */

?>
<div class="blog-row row">

	<div class="col-md-4">

		<a href="<?php the_permalink() ?>">

			<?php if ( has_post_thumbnail() ) { ?>

				<?php 	the_post_thumbnail('medium');  ?>

			<?php } else { ?>
			
				<img src="/wp-content/uploads/2020/03/snoozeal-logo.png" alt="Snoozeal" />
			
			<?php } ?>

		</a>

	</div>

	<div class="col-md-8">

		<div class="blog-section">
					
			<a class="blog-link" href="<?php echo get_permalink(); ?>">
				
				<div class="hidden-xs hidden-sm vc_separator wpb_content_element vc_separator_align_center vc_sep_width_10 vc_sep_border_width_3 vc_sep_pos_align_left vc_separator_no_text vc_sep_color_blue  wpb_animate_when_almost_visible wpb_left-to-right left-to-right wpb_animate_when_almost_visible wpb_left-to-right left-to-right wpb_start_animation animated">
					<span class="vc_sep_holder vc_sep_holder_l">
						<span class="vc_sep_line"></span>
					</span>
					<span class="vc_sep_holder vc_sep_holder_r">
						<span class="vc_sep_line"></span>
					</span>
				</div>
			 
				<?php $str = get_the_title(); 
				echo '<h3>' . $str . '</h3>';
				
				if (has_excerpt()) { 
					$excerpt = get_the_excerpt();
					echo  '<p class="excerpt">'. $excerpt . '</p>';
					echo  '<a href="' . get_permalink() . '" class="read-more">Read more</a>';
				}
				?>
				
			</a>
			
		</div>
		
		<div class="post-details">

			<hr />
			
			<span class="cat-author">
				<?php $author = get_the_author(); 
				echo 'By ' . $author; ?>
			</span>
			
			<span class="inline-sep">|</span>
			
			<span class="cat-date">
				<?php $date = get_the_date();
				echo  $date;  ?>
			</span>
			
			<?php if ($terms_cat = wp_get_post_terms($post->ID, 'blog-category')){ ?>
			
				<span class="inline-sep">|</span>
				
				<span class="cat-list">
				<?php 
					global $post;
					$terms_cat = wp_get_post_terms($post->ID, 'blog-category');
					if ($terms_cat) {
						$output = array();
						foreach ($terms_cat as $term_cat) {
							$output[] = '<a href="' .get_term_link( $term_cat->slug, 'blog-category') .'">' .$term_cat->name .'</a>';
						}
						echo 'Categories ' . join( ', ', $output );
					}
				?>
				</span>
				
				<?php } ?>
				
				<?php if ($terms_tag = wp_get_post_terms($post->ID, 'blog-tag')){ ?>
				
					<span class="inline-sep">|</span>
					
					<span class="cat-tag">
					<?php
						$terms_tag = wp_get_post_terms($post->ID, 'blog-tag');
						if ($terms_tag) {
							$output = array();
							foreach ($terms_tag as $term_tag) {
								$output[] = '<a href="' .get_term_link( $term_tag->slug, 'blog-tag') .'">' .$term_tag->name .'</a>';
							}
							echo 'Tags ' . join( ', ', $output );
						}
					?>
					</span>
					
				<?php } ?>
							
			<hr />
			
		</div>
		

	</div>
	

</div>