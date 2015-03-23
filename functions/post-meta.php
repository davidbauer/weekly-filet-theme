<?php
/**
 * Used to output post meta info
 *
 * @package WordPress
 * @subpackage Magtastico WPExplorer Theme
 * @since Magtastico 1.0
 */


if ( ! function_exists( 'wpex_post_meta' ) ) {
	function wpex_post_meta() {
		if ( 'page' == get_post_type() ) return;
		if ( !is_singular('post' ) ) {
			if ( !get_theme_mod( 'wpex_blog_meta', '1' ) ) return;
		} else {
			if ( !get_theme_mod( 'wpex_post_meta', '1' ) ) return;
		} ?>
		<div class="post-meta clr">
			<span class="post-meta-category">
				<?php the_category(' / '); ?>
			</span>
			<i class="fa fa-circle first-circle"></i>
			<span class="post-meta-date">
				<?php echo get_the_date( 'j M Y', '', '', true ); ?>
			</span>
			<i class="fa fa-circle second-circle"></i>
			<span class="post-meta-author">
				<?php the_author_posts_link(); ?>
			</span>
		</div><!-- .post-meta -->
	<?php
	}
}