<?php
/**
 * Displays page featured image
 *
 * @package WordPress
 * @subpackage Magtastico WPExplorer Theme
 * @since Magtastico 1.0
 */


if ( ! function_exists( 'wpex_page_featured_image' ) ) {
	function wpex_page_featured_image() {
		global $post;
		if ( 'on' == get_post_meta( $post->ID, 'wpex_disable_featured_image', true ) ) return; ?>
		<?php if ( has_post_thumbnail( $post->ID ) ) { ?>
			<div id="page-featured-img">
				<img src="<?php echo wpex_get_featured_img_url(); ?>" alt="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" />
			</div><!-- #page-featured-img -->
		<?php } ?>
	<?php
	} // End function
} // End if