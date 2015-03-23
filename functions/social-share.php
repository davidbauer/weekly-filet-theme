<?php
/**
 * Create simple social sharing buttons.
 *
 * @package WordPress
 * @subpackage Total
 * @since Total 1.0
*/


if ( !function_exists( 'wpex_social_share' ) ) {

	function wpex_social_share( $postid = '' ) {

		// Show/Hide on Entries
		if ( ! is_singular() ) {
			if ( !get_theme_mod( 'wpex_blog_entry_share', '1' ) ) return;
		} else {
			if ( !get_theme_mod( 'wpex_blog_single_share', '1' ) ) return;
			if ( !get_theme_mod( 'wpex_blog_post_thumb', '1' ) ) return;
		}
		
		// Get post
		global $post;
		if ( !$post ) return;
		$postid = $postid ? $postid :$post->ID;
		$post_type = get_post_type($post);
		$meta = get_post_meta( $postid, 'wpex_disable_social', true );
		
		// If disabled show nothing
		if ('on' == $meta ) return;
		
		// Vars
		$permalink = get_permalink($postid);
		$url = urlencode( $permalink );
		$title = urlencode( esc_attr( the_title_attribute( 'echo=0' ) ) );
		$summary = urlencode( wp_trim_words( get_the_content( $postid ), '40' ) );
		$img = urlencode( wp_get_attachment_url( get_post_thumbnail_id( $postid ) ) );
		$source = urlencode( home_url() );
		$share_text = apply_filters( 'wpex_share_text', __( 'Share', 'wpex' ) ); ?>

		<div title="<?php echo $share_text; ?>" class="social-share-toggle"><?php echo $share_text; ?><span class="fa fa-caret-down"></span>
			<div class="social-share-buttons clr">
				<?php
				// Twitter ?>
				<a href="http://twitter.com/share?text=<?php echo $title; ?>&amp;url=<?php echo $url; ?>" target="_blank" title="<?php _e( 'Share on Twitter', 'wpex' ); ?>" rel="nofollow" class="twitter-share" onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><span class="fa fa-twitter"></span></a>
				<?php
				// Facebook ?>
				<a href="http://www.facebook.com/share.php?u=<?php echo $url; ?>" target="_blank" title="<?php _e( 'Share on Facebook', 'wpex' ); ?>" rel="nofollow" class="facebook-share" onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><span class="fa fa-facebook"></span></a>
				<?php
				// Google Plus ?>
				<a title="<?php _e( 'Share on Google+', 'wpex' ); ?>" rel="external" href="https://plus.google.com/share?url=<?php echo $url; ?>" class="googleplus-share" onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><span class="fa fa-google-plus"></span></a>
				<?php
				// Pinterest ?>
				<a href="http://pinterest.com/pin/create/button/?url=<?php echo $url; ?>&amp;media=<?php echo $img; ?>&amp;description=<?php echo $summary; ?>" target="_blank" title="<?php _e( 'Share on Pinterest', 'wpex' ); ?>" rel="nofollow" class="pinterest-share" onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><span class="fa fa-pinterest"></span></a>
				<?php
				// Linkedin ?>
				<a title="<?php _e( 'Share on LinkedIn', 'wpex' ); ?>" href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo $url; ?>&amp;title=<?php echo $title; ?>&amp;summary=<?php echo $summary; ?>&amp;source=<?php echo $source; ?>" target="_blank" rel="nofollow" class="linkedin-share" onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><span class="fa fa-linkedin"></span></a>
			</div>
		</div>

	<?php
	} // End function

} // End function_exists check