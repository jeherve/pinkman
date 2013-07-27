<?php
/**
 * @package Pinkman
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'pinkman' ) ); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . __( 'Pages:', 'pinkman' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<header class="entry-header">
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>

		<div class="entry-meta">
			<?php pinkman_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<footer class="entry-meta">
		<?php
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( __( ', ', 'pinkman' ) );
			if ( $categories_list && pinkman_categorized_blog() ) :
		?>
		<span class="cat-links">
			<?php printf( __( 'Posted in %1$s', 'pinkman' ), $categories_list ); ?>
		</span>
		<?php endif; // End if categories ?>

		<?php
			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', __( ', ', 'pinkman' ) );
			if ( $tags_list ) :
		?>
		<span class="sep"> | </span>
		<span class="tags-links">
			<?php printf( __( 'Tagged %1$s', 'pinkman' ), $tags_list ); ?>
		</span>
		<?php endif; // End if $tags_list ?>

		<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
		<span class="sep"> | </span>
		<span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'pinkman' ), __( '1 Comment', 'pinkman' ), __( '% Comments', 'pinkman' ) ); ?></span>
		<?php endif; ?>

		<?php edit_post_link( __( 'Edit', 'pinkman' ), '<span class="sep"> | </span><span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-## -->
