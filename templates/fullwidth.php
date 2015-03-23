<?php
/**
 * Template Name: FullWidth
 *
 * @package WordPress
 * @subpackage Magtastico WPExplorer Theme
 * @since Magtastico 1.0
 */

get_header(); ?>
	<div id="primary" class="content-area clr">
		<?php while ( have_posts() ) : the_post(); ?>
			<article id="post-<?php the_ID(); ?>" class="boxed-content clr">
				<?php if ( !is_front_page() ) { ?>
					<?php
					// Display featured image
					wpex_page_featured_image(); ?>
					<header class="page-header clr">
						<h1 class="page-header-title"><?php the_title(); ?></h1>
					</header><!-- #page-header -->
				<?php } ?>
				<div class="entry clr">
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-links clr">', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
				</div><!-- .entry -->
			</article><!-- #post -->
			<?php
			if ( get_theme_mod( 'wpex_page_comments' ) ) {
				comments_template();
			} ?>
		<?php endwhile; ?>
	</div><!-- #primary -->
<?php get_footer(); ?>