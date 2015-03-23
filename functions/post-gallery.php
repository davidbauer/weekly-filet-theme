<?php
/**
 * Outputs the post gallery
 *
 * @package WordPress
 * @subpackage Magtastico WPExplorer Theme
 * @since Magtastico 1.0
 */


if ( ! function_exists( 'wpex_post_gallery' ) ) {
	function wpex_post_gallery() {
		global $post;
		$attachments = wpex_get_gallery_ids();
		if ( !$attachments ) return; ?>
		<div class="flexslider-wrap post-gallery clr">
			<div class="flexslider">
				<ul class="slides clr wpex-gallery-lightbox">
					<?php
					// Loop through each image in each gallery
					foreach( $attachments as $attachment ) {
						$attachment_data = wpex_get_attachment( $attachment ); ?>
						<?php if ( wpex_get_featured_img_url($attachment) ) { ?>
							<li>
								<?php if ( wpex_gallery_is_lightbox_enabled() ) { ?>
									<a href="<?php echo wpex_get_featured_img_url( $attachment, true ); ?>" title="<?php echo $attachment_data['alt']; ?>">
								<?php } ?>
								<img src="<?php echo wpex_get_featured_img_url($attachment); ?>" alt="<?php echo $attachment_data['alt']; ?>" />
								<?php if ( wpex_gallery_is_lightbox_enabled() ) echo '</a>'; ?>
								<?php if ( is_singular() && '' != $attachment_data['caption'] ) { ?>
									<div class="post-gallery-caption"><?php echo $attachment_data['caption']; ?></div>
								<?php } ?>
							</li>
						<?php } ?>
					<?php } ?>
				</ul>
			</div>
		</div>
	<?php
	} // End function
} // End if