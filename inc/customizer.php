<?php
/**
 * Pinkman Theme Customizer
 *
 * @package Pinkman
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * Create Theme mods for links to social media accounts.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function pinkman_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
	// Social Links theme options
	$wp_customize->add_section( 'pinkman_theme_options', array(
		'title'         => __( 'Theme Options', 'pinkman' ),
		'priority'      => 35,
	) );

	$wp_customize->add_setting( 'jetpack-github', array(
		'default'       => '',
		'type'          => 'theme_mod',
		'capability'    => 'edit_theme_options',
	) );

	$wp_customize->add_control( 'jetpack-github', array(
		'label'         => __( 'Github Link', 'pinkman' ),
		'section'       => 'pinkman_theme_options',
		'type'          => 'text',
		'priority'      => 2,
	) );
	
	$wp_customize->add_setting( 'jetpack-wporg', array(
		'default'       => '',
		'type'          => 'theme_mod',
		'capability'    => 'edit_theme_options',
	) );

	$wp_customize->add_control( 'jetpack-wporg', array(
		'label'         => __( 'WordPress.org Link', 'pinkman' ),
		'section'       => 'pinkman_theme_options',
		'type'          => 'text',
		'priority'      => 3,
	) );

}
add_action( 'customize_register', 'pinkman_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function pinkman_customize_preview_js() {
	wp_enqueue_script( 'pinkman_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'pinkman_customize_preview_js' );
