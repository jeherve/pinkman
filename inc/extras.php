<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Pinkman
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function pinkman_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'pinkman_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 */
function pinkman_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'pinkman_body_classes' );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 */
function pinkman_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}
add_filter( 'attachment_link', 'pinkman_enhanced_image_navigation', 10, 2 );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 */
function pinkman_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( __( 'Page %s', 'pinkman' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'pinkman_wp_title', 10, 2 );

/**
 * Returns the URL from the post.
 *
 * @uses get_url_in_content() to get the URL in the post meta (if it exists) or
 * the first link found in the post content.
 *
 * Falls back to the post permalink if no URL is found in the post.
 * Props Twenty Thirteen
 *
 * @since Pinkman 1.0
 *
 * @return string The Link format URL.
 */
function pinkman_get_link_url() {
	$content = get_the_content();
	$has_url = get_url_in_content( $content );

	return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}

/**
 * Get a random image
 *
 * @uses wp_get_attachment_image_src() to get the source of a thumbnail image in any post
 * Props @designsimply - https://github.com/designsimply/photo-addict/
 *
 * @since Pinkman 1.2
 *
 * @return string The thumbnail image source
 */
function pinkman_get_random_image_src( $size = 'thumbnail' ) {
	$random_image = array();
	$args = array(
		'post_type' => 'attachment',
		'post_mime_type' =>'image',
		'post_status' => 'inherit',
		'posts_per_page' => 1,
		'orderby' => 'rand'
	);
	$query_images = new WP_Query( $args );

	if ( ! in_array( $size, array( 'thumbnail', 'medium', 'large', 'full' ) ) )
		$size = 'thumbnail';

	if ( isset( $query_images->post->ID ) ) {
		$random_image = wp_get_attachment_image_src ( $query_images->post->ID, $size);
	}

	if ( isset( $random_image[0] ) )
		return $random_image[0];
}

/**
 * Get an image from a post
 *
 * @uses Jetpack_PostImages::get_image( $post_id ) to get the source of an image in a post
 * @param int $post_id The post ID to check
 *
 * If it doesn't return anything, grab random image from pinkman_get_random_image_src()
 *
 * @since Pinkman 1.2
 *
 * @return string the image source
 */
function pinkman_get_post_image() {
	$post_id = get_the_ID();

	if ( class_exists( 'Jetpack_PostImages' ) ) {
		$the_image = Jetpack_PostImages::get_image( $post_id );
		if ( !empty( $the_image['src'] ) )
			$the_image = $the_image['src'];
	}

	if ( empty( $the_image ) )
		$the_image = pinkman_get_random_image_src();

	// Generate a Photon URL for that image
	$the_image = apply_filters( 'jetpack_photon_url', $the_image );

	return $the_image;
}



/**
 * Print css for the background using our background image
 *
 * @since Pinkman 1.2
 */
function pinkman_bg_css() {

	$my_image = pinkman_get_post_image();

	echo '<style type="text/css" media="screen">
		#bg-container {
			position: fixed;
			display: block;
			width: 100%;
			height: 100%;
			top: 0;
			left: 0;
			z-index: -99;
			background: url(' . $my_image . ') center / 2000%;
			opacity: .2;
			-webkit-filter: blur(50px);
			filter: blur(50px);
		}
		.home #bg-container { background-size: 1000%; opacity: .3; }
		#bg-container { filter:url(#blur50); } /* SVG blur for Firefox */
	</style>';	
}
add_action( 'wp_head', 'pinkman_bg_css' );

/**
 * Customize the credits appearing in the Infinite Scroll footer
 *
 * @since Pinkman 1.2.3
 */
function pinkman_cust_credit() {

	$credits = '<a href="http://wordpress.org/" rel="generator">Proudly powered by WordPress</a> ';
	$credits .= sprintf( __( 'Theme: %1$s.', 'jetpack' ), function_exists( 'wp_get_theme' ) ? wp_get_theme()->Name : get_current_theme() );
	$credits .= ' (<a href="http://jeremyherve.com/?p=2468">More about this theme</a>)';

	return $credits;
}
add_filter( 'infinite_scroll_credit', 'pinkman_cust_credit' );
