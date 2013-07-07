<?php
/**
 * Pinkman Theme Customizer
 *
 * @package Pinkman
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function pinkman_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
		$wp_customize->add_section( 'pinkman_theme_options', array(
		'title'         => __( 'Theme Options', 'pinkman' ),
		'priority'      => 35,
	) );

	$wp_customize->add_setting( 'google_plus_link', array(
		'default'       => '',
		'type'          => 'theme_mod',
		'capability'    => 'edit_theme_options',
	) );

	$wp_customize->add_control( 'google_plus_link', array(
		'label'         => __( 'Google+ Link', 'pinkman' ),
		'section'       => 'pinkman_theme_options',
		'type'          => 'text',
		'priority'      => 1,
	) );

	$wp_customize->add_setting( 'github_link', array(
		'default'       => '',
		'type'          => 'theme_mod',
		'capability'    => 'edit_theme_options',
	) );

	$wp_customize->add_control( 'github_link', array(
		'label'         => __( 'Github Link', 'pinkman' ),
		'section'       => 'pinkman_theme_options',
		'type'          => 'text',
		'priority'      => 2,
	) );
	
	$wp_customize->add_setting( 'wporg_link', array(
		'default'       => '',
		'type'          => 'theme_mod',
		'capability'    => 'edit_theme_options',
	) );

	$wp_customize->add_control( 'wporg_link', array(
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
