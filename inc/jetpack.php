<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package Pinkman
 */

function pinkman_jetpack_setup() {

	/**
	 * Add theme support for Infinite Scroll.
	 * See: http://jetpack.me/support/infinite-scroll/
	 */
	add_theme_support( 'infinite-scroll', array(
		'container' => 'content',
		'footer'    => 'page',
	) );

	/**
	 * Add theme support for Featured Content.
	 * See: http://jetpack.me/support/featured-content/
	 */
	add_theme_support( 'featured-content', array(
	    'featured_content_filter' => 'pinkman_get_featured_posts',
	    'max_posts'   => 6,
	    //'include_featured' => true,
	) );

	/**
	 * Add theme support for Social Links.
	 * See: http://jetpack.me/support/social-links/
	 */
	add_theme_support( 'social-links', array(
		'facebook',
		'twitter',
		'linkedin',
		'google_plus'
	) );

}
add_action( 'after_setup_theme', 'pinkman_jetpack_setup' );

/**
 * Get our Featured Content posts
 */
function pinkman_get_featured_posts() {
    return apply_filters( 'pinkman_get_featured_posts', array() );
}

/**
 * Do not exclude the Featured Posts from the main blog query
 */
function jeherve_add_featured_content_to_blog() {
    remove_action( 'pre_get_posts', array( 'Featured_Content', 'pre_get_posts' ) );
}
add_action( 'init', 'jeherve_add_featured_content_to_blog', 31 ); // Immediately after FC hooks in.
