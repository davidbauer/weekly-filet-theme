<?php
/**
 * Used for next and previous post links
 *
 * @package WordPress
 * @subpackage Magtastico WPExplorer Theme
 * @since Magtastico 1.0
*/


// Display next/previous links
if ( ! function_exists( 'wpex_next_prev' ) ) {
	function wpex_next_prev() {
		global $post;
		if ( !is_singular() ) return;
		if ( !get_theme_mod( 'wpex_next_prev', '1' ) ) return; ?>
		<?php
		// Output the next/previous links ?>
		<div class="single-post-pagination clr">
			<?php if ( is_rtl() ) { ?>
				<?php previous_post_link( '<div class="post-next">%link</div>', '%title &#8592;' ); ?>
				<?php next_post_link( '<div class="post-prev">%link</div>', '%title' ); ?>
			<?php } else { ?>
				<?php previous_post_link( '<div class="post-next">%link</div>', '%title &#8594;' ); ?>
				<?php next_post_link( '<div class="post-prev">%link</div>', '&#8592; %title' ); ?>
			<?php } ?>
		</div><!-- .post-post-pagination -->
	<?php }
}