<?php
/**
 * General theme options
 *
 * @package WordPress
 * @subpackage Magtastico WPExplorer Theme
 * @since Magtastico 1.0
 */



add_action( 'customize_register', 'wpex_customizer_logo' );

function wpex_customizer_logo( $wp_customize ) {

	// Theme Settings Section
	$wp_customize->add_section( 'wpex_logo' , array(
		'title'		=> __( 'Logo', 'wpex' ),
		'priority'	=> 200,
	) );

	//Logo
	$wp_customize->add_setting( 'wpex_logo', array(
		'type'		=> 'theme_mod',
		'default'	=> get_template_directory_uri(). '/images/logo.png',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wpex_logo', array(
		'label'		=> __('Image Logo','wpex'),
		'section'	=> 'wpex_logo',
		'settings'	=> 'wpex_logo',
		'priority'	=> '1',
	) ) );

	// Subheading
	$wp_customize->add_setting( 'wpex_logo_subheading', array(
		'type'		=> 'theme_mod',
		'default'	=> '1',
	) );
	$wp_customize->add_control( 'wpex_logo_subheading', array(
		'label'		=> __('Display Site Description Below Logo','wpex'),
		'section'	=> 'wpex_logo',
		'settings'	=> 'wpex_logo_subheading',
		'type'		=> 'checkbox',
		'priority'	=> '2',
	) );
	
}