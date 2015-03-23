<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Magtastico WPExplorer Theme
 * @since Magtastico 1.0
 */

get_header(); ?>
	
	<div id="primary" class="content-area clr">
	<?php 	$issues = isset($_GET['issue']) ? explode(',', $_GET['issue']) : array();
			$publisher = isset($_GET['publisher']) ? explode(',', $_GET['publisher']) : array();
			$collection = isset($_GET['collection']) ? explode(',', $_GET['collection']) : array();
			$author = isset($_GET['author']) ? explode(',', $_GET['author']) : array();
	?>
	
	<?php if ($issues || $publisher || $collection || $author):?>
				
				<header class="archive-header clr">
						<h1 class="archive-header-title">
						<?php 
												
								if($issues): printf("Weekly Filet #" . implode(', #', $issues));
								elseif ($collection): printf("Collection: " . $collection[0]);
								elseif ($publisher): printf("All links from " . $publisher[0]);
								elseif ($author): printf("All links from " . $author[0]);
								endif;
				
						?></h1>
						<?php if ( term_description() ) { ?>
							<div class="archive-description clr">
								<?php echo term_description(); ?>
							</div><!-- #archive-description -->
						<?php } ?>
						
						<?php get_template_part( 'tpl-subscribe-light' ); ?>
						
				</header><!-- .archive-header -->
			<?php else:
				get_template_part( 'tpl-subscribe' );
			endif;
			?>
	
	
	
			<div id="blog-wrap archive" class="clr masonry-grid">

				<?php
					if ( have_posts() ) : while ( have_posts() ) : the_post();	
					get_template_part( 'content');
				endwhile; ?>
			</div><!-- #blog-wrap -->
			<?php wpex_get_pagination(); ?>
		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>
	</div><!-- #primary -->

<?php get_footer(); ?>