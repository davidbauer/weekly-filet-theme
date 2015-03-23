<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Magtastico WPExplorer Theme
 * @since Magtastico 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area clr">
		<div id="content" class="site-content left-content clr" role="main">
			<header class="archive-header clr">
				<h1 class="archive-header-title"><?php
					if ( is_day() ) :
						printf( __( 'Daily Archives: %s', 'wpex' ), get_the_date() );
					elseif ( is_month() ) :
						printf( __( 'All recommended links from %s', 'wpex' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'wpex' ) ) );
					elseif ( is_year() ) :
						printf( __( 'All recommended links from %s', 'wpex' ), get_the_date( _x( 'Y', 'yearly archives date format', 'wpex' ) ) );
					elseif ( is_category() ) : 
						$issues = isset($_GET['issue']) ? explode(',', $_GET['issue']) : array();
						$publisher = isset($_GET['publisher']) ? explode(',', $_GET['publisher']) : array();
						$collection = isset($_GET['collection']) ? explode(',', $_GET['collection']) : array();				
						if($issues): printf("Weekly Filet #" . $issues[0]);
						elseif ($collection): printf("Collection: " . $collection[0]);
						elseif ($publisher): printf("All links from " . $publisher[0]);
						endif;
					else :
						echo single_term_title();
					endif;
				?></h1>
				<?php if ( term_description() ) { ?>
					<div class="archive-description clr">
						<?php echo term_description(); ?>
					</div><!-- #archive-description -->
				<?php } ?>
				
				<?php get_template_part( 'tpl-subscribe-light' ); ?>
				
			</header><!-- .archive-header -->
			<?php if ( have_posts() ) : ?>
				<div id="blog-wrap" class="clr masonry-grid">
					<?php
					// Begin loop
					while ( have_posts() ) : the_post();
						get_template_part( 'content', get_post_format() );
					endwhile; ?>
				</div><!-- #blog-wrap -->
				<?php wpex_get_pagination(); ?>
			<?php else : ?>
				
			<?php endif; ?>
		</div><!-- #content -->
		<?php get_sidebar(); ?>
	</div><!-- #primary -->

<?php get_footer(); ?>