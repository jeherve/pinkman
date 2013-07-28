<?php
/**
 * @package Pinkman
 */

// Get our Featured Content posts
$grid = pinkman_get_featured_posts();
  
// If we don't have enough posts, our work is done here
if ( empty( $grid ) || 6 < count( $grid ) )
    return;
  
// Let's loop through our posts ?>
<div class="grid">
    <?php foreach ( $grid as $post ) : setup_postdata( $post ); ?>
          
        <div class="grid-thumb">
        	<a href="<?php the_permalink(); ?>" rel="bookmark">
            	<?php the_post_thumbnail(); ?>
        	</a>
        </div><!-- .grid-thumb -->
  
    <?php endforeach; ?>
</div><!-- .grid -->
<?php wp_reset_postdata(); ?>