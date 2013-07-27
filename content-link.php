<?php
/**
 * @package Pinkman
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php echo esc_url( pinkman_get_link_url() ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<div class="entry-meta">
			<?php pinkman_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'pinkman' ) ); ?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
