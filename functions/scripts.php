<?php
/**
 * This file loads custom css and js for our theme
 *
 * @package WordPress
 * @subpackage Magtastico WPExplorer Theme
 * @since Magtastico 1.0
*/


add_action( 'wp_enqueue_scripts','wpex_load_scripts' );

function wpex_load_scripts() {

	/**
		CSS
	**/
	wp_enqueue_style( 'style', get_stylesheet_uri() );

	if ( get_theme_mod( 'wpex_g_font', '1' ) ) {
		wp_enqueue_style( 'wpex-google-font-karla-regular', 'http://fonts.googleapis.com/css?family=Karla:400,400italic,700,700italic&subset=latin,latin-ext' );
		wp_enqueue_style( 'wpex-google-roboto-slab', 'http://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700&subset=latin,cyrillic-ext,greek-ext,vietnamese,latin-ext,cyrillic,greek' );
	}

	if ( function_exists( 'wpcf7_enqueue_styles') ) {
		wp_dequeue_style( 'contact-form-7' );
	}

	// Load media css for embeds
	if ( 'infinite-scroll' == get_theme_mod( 'wpex_pagination', 'infinite-scroll' ) && get_theme_mod( 'wpex_blog_entry_thumb', '1' ) ) {
		wp_enqueue_style( 'mediaelement' );
	}

	/**
		jQuery
	**/

	// RTL for masonry
	if ( is_rtl() ) {
		$isOriginLeft = false;
	} else {
		$isOriginLeft = true;
	}

	// Load media css for embeds
	if ( get_theme_mod( 'wpex_blog_entry_thumb', '1' ) ) {
		if ( 'load-more' == get_theme_mod( 'wpex_pagination', 'infinite-scroll' ) || 'load-more' == get_theme_mod( 'wpex_pagination', 'infinite-scroll' ) ) {
			wp_enqueue_script( 'wp-mediaelement' );
		}
	}

	// Threaded commments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Retina Support
	if ( get_theme_mod( 'wpex_retina' ) ) {
		wp_enqueue_script( 'wpex-retina', WPEX_JS_DIR_URI .'/retina.js', array( 'jquery' ), '', true );
	}

	// Main js plugins
	wp_enqueue_script( 'wpex-plugins', WPEX_JS_DIR_URI .'/plugins.js', array( 'jquery' ), '1.7.5', true );

	// Init
	wp_enqueue_script( 'wpex-global', WPEX_JS_DIR_URI .'/global.js', array( 'jquery', 'wpex-plugins' ), '1.7.5', true );
	$is_mobile = wp_is_mobile() ? 'yes' : 'no';
	wp_localize_script( 'wpex-global', 'wpexLocalize', array(
		'pagination'	=> get_theme_mod( 'wpex_pagination', 'load-more' ),
		'mobile'		=> $is_mobile
	) );
}


/**
* Load twitter widgets.js script for AJAX support for status post formats
 *
 * @package WordPress
 * @subpackage Magtastico WPExplorer Theme
 * @since Magtastico 1.0
*/
add_action( 'wp_footer', 'wpex_get_twitter_widgets_js' );
if ( ! function_exists( 'wpex_get_twitter_widgets_js' ) ) {
	function wpex_get_twitter_widgets_js() {
		echo '<script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>';
	}
}