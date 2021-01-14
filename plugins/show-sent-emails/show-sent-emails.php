<?php
/*
Plugin Name: Show Sent Emails
Description: This plugin lists the emails sent by a logged in user.
Version:     1.0
Author:      Malcolm Kinross
Author URI:  www.immedia-creative.com
*/

/*Function to show emails sent by logged in user*/
add_shortcode( 'show_sent_emails', 'show_sent_emails' );

function show_sent_emails(){

  global $current_user; wp_get_current_user();
  if ( is_user_logged_in() ) { 
    # the line below just checks we have the users details
    ?><p><?php
    #echo 'Username: ' . $current_user->user_login . "\n"; echo 'User display name: ' . $current_user->display_name . "\n";
    ?></p><?php

    // the query
    $the_query = new WP_Query( array(
    'posts_per_page' => '-1',
    'author' => $current_user->ID,
    'post_type'=>'flamingo_inbound'
    )); 
  
    
    if ( $the_query->have_posts() ) :
    ?>
    <div class="emailsmainwrapper">
      <div class="emailsitemwrapper">
        <div class="emailsitmehead">Email Address</div>
        <div class="emailsdatehead">Date Sent</div>
      </div> 
    <?php
    while ( $the_query->have_posts() ) : $the_query->the_post();
	  
	  $key_1_values = get_post_meta( get_the_ID(), '_from_email' );
    ?>

      <div class="emailsitemwrapper">
        <div class="emailsitme"><?php echo ($key_1_values[0]); ?></div>
        <div class="emailsdate"><?php the_date(); ?></div>
      </div>

    <?php 
      
    endwhile;
    wp_reset_postdata();
    ?>
    </div>
    <?php
    else :
    echo "no posts";
    endif;
  
  } else { wp_loginout(); }

}



