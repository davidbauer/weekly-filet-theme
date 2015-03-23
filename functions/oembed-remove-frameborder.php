<?php
/**
 * Remove frameborder from oembed
 *
 * @package WordPress
 * @subpackage Magtastico WPExplorer Theme
 * @since Magtastico 1.0
 */


if ( ! function_exists( 'wpex_embed_oembed_html' ) ) {
	function wpex_embed_oembed_html($html, $url, $attr, $post_id) {
		$html = str_replace( 'frameborder="0"', '', $html );
		$html = '<div id="video">' . $html . '</div>';
		return $html;
	}
}
add_filter('embed_oembed_html', 'wpex_embed_oembed_html', 99, 4);