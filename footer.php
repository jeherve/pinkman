<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Pinkman
 */
?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php do_action( 'pinkman_credits' ); ?>
			<a href="http://wordpress.org/" title="<?php esc_attr_e( 'A Semantic Personal Publishing Platform', 'pinkman' ); ?>" rel="generator"><?php printf( __( 'Proudly powered by %s', 'pinkman' ), 'WordPress' ); ?></a>
			<span class="sep"> | </span>
			<?php printf( __( 'Theme: %1$s by %2$s.', 'pinkman' ), 'Pinkman', '<a href="http://jeremy.hu" rel="designer">Jeremy Herve</a>' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->

	</div><!-- #main -->

</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
