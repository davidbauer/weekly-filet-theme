<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Magtastico WPExplorer Theme
 * @since Magtastico 1.0
 */

get_header(); ?>


<?php while ( have_posts() ) : the_post(); ?>
	<div id="primary" class="content-area clr">
		
		<div id="single-post-wrap" class="clr">¨
		<?php wpex_next_prev(); ?>
			<?php if ( 'quote' != get_post_format() ) { ?>
				<article class="single-post-article boxed-content clr">
					<div class="single-post-media clr">
						<a href="<?php $key="url"; echo get_post_meta($post->ID, $key, true); ?>" title="Go to <?php the_title(); ?>">
						<?php if ( has_post_thumbnail() ) { ?>
						<img src="<?php echo wpex_get_featured_img_url(); ?>" alt="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" />
					<?php } else if (get_post_meta($post->ID, "image_url", true) != "") { ?>
						<img src="<?php echo get_post_meta($post->ID, "image_url", true);?>" alt="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" />
					<?php } else { ?>
						
					<?php } ?>
						</a>
						
						
						<?php
						// Get post format media - image, video. audio, etc
						// get_template_part( 'content', get_post_format() ); ?>
					</div><!-- .single-post-media -->
					
					<header class="post-header clr">
						<h1 class="post-header-title"><a href="<?php $key="url"; echo get_post_meta($post->ID, $key, true); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
						<a href="?publisher=<?php $key="publisher"; echo get_post_meta($post->ID, $key, true); ?>" title="View all links from <?php $key="publisher"; echo get_post_meta($post->ID, $key, true); ?>"><span><?php $key="publisher"; echo get_post_meta($post->ID, $key, true); ?></a> <?php $the_author = get_post_meta($post->ID, "author", true); if( ! empty( $the_author ) ) {echo "| " . "<a href='?author=" . $the_author ."' title='View all links from " . $the_author . "'>" .$the_author ;}  ?></span></a>
						
					<?php $the_curator = get_post_meta($post->ID, "curator", true); if( $the_curator != "David Bauer" && $the_curator != ""  ) {echo "&nbsp;&nbsp;<span class='guestcurated'>Guest curated by " . $the_curator . "</span>";}  ?>
						

					</header><!-- .post-header -->
					<div class="entry clr">
						<?php
						// Post Content
						the_content();
						?>
						
						<div class="readmore">
							<a href="<?php $key="url"; echo get_post_meta($post->ID, $key, true); ?>" title="Go to <?php the_title(); ?>" class="loop-entry-readmore">Read more</a>
						</div>
						<br/>
						<br/>
				
				
				
						<div class="filed">
							Published in <a href="?issue=<?php $key="issue"; echo get_post_meta($post->ID, $key, true); ?>">Weekly Filet #<?php $key="issue"; echo get_post_meta($post->ID, $key, true); ?></a>
							<ul class="tags"><?php the_tags("#",", #",""); ?></ul>
							<?php $the_collection = get_post_meta($post->ID, "collection", true); 
				
					
				
				if( ! empty( $the_collection )) { 
					
					if (is_array($the_collection)) {
						
						if( count($the_collection) > 1 ) {
							echo "In collections: ";
							$numItems = count($the_collection);
							$i = 0;
							foreach($the_collection as $coll) {
								echo "<a href='/?collection=" . $coll . "'>" . $coll . "</a>";
								if(++$i < $numItems) { // add a comma after each collection except the last one
								echo ", ";
								}
							};
						}
						
						else {
							echo "In collection: <a href='/?collection=" . $the_collection[0] . "'>" . $the_collection[0] . "</a>";
						}
					}
					
					// applies for imported posts that have collection as a string, not array
					else {echo "In collection: <a href='/?collection=" . $the_collection . "'>" . $the_collection . "</a>";}
				
				}
				?>							<?php edit_post_link(); ?>
						</div>
						
						<?php wp_link_pages( array( 'before' => '<div class="page-links clr">', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
					</div><!-- .entry -->
				</article>
			<?php } else {
				get_template_part( 'content', get_post_format() );
			} ?>
			
		</div><!-- .single-post-wrap -->
		<?php get_template_part( 'tpl-subscribe' ); ?>
		</div><!-- #primary -->
<?php endwhile; ?>
<?php get_footer(); ?>