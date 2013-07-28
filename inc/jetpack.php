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
remove_action( 'pre_get_posts', array( Featured_Content::init(), 'pre_get_posts' ), 30, 1 );