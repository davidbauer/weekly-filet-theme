<?php
/**
 * Show or hide sidebar accordingly
 *
 * @package WordPress
 * @subpackage Magtastico WPExplorer Theme
 * @since Magtastico 1.0
 */

if ( ! function_exists( 'wpex_sidebar_display' ) ) {
	function wpex_sidebar_display() {
		if ( is_singular() ) {
			return true;
		}
	} // End function
} // End if