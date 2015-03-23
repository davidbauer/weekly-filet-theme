<?php
/**
 * Define sidebars for use in this theme
 * @package WordPress
 * @subpackage Magtastico WPExplorer Theme
 * @since Magtastico 1.0
 */


// Sidebar
register_sidebar( array(
	'name'			=> __( 'Main Sidebar', 'wpex' ),
	'id'			=> 'main-sidebar',
	'description'	=> __( 'Widgets in this area are used in the main sidebar region.', 'wpex' ),
	'before_widget'	=> '<div class="widget-box %2$s clr">',
	'after_widget'	=> '</div>',
	'before_title'	=> '<span class="widget-title">',
	'after_title'	=> '</span>',
) );

// Sidebar
register_sidebar( array(
	'name'			=> __( 'Secondary Sidebar', 'wpex' ),
	'id'			=> 'secondary-sidebar',
	'description'	=> __( 'Widgets in this area are used in the secondary sidebar region.', 'wpex' ),
	'before_widget'	=> '<div class="widget-box boxed-content %2$s clr">',
	'after_widget'	=> '</div>',
	'before_title'	=> '<span class="widget-title">',
	'after_title'	=> '</span>',
) );