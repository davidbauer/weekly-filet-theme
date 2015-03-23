<?php
/**
 * The default template for displaying post content.
 *
 * @package WordPress
 * @subpackage Magtastico WPExplorer Theme
 * @since Magtastico 1.0
 */



/**
	Entries
**/
global $wpex_query;

if ( is_singular() && !$wpex_query ) {

	// Display post featured image
	// See functions/post-featured-image.php
	wpex_post_featured_image();

}

/**
	Posts
**/
else { ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="loop-entry-inner clr nobtns pos<?php echo get_post_meta($post->ID, "position", true);?>">
			
			<div class="loop-entry-thumbnail">
					<a href="<?php $key="url"; echo get_post_meta($post->ID, $key, true); ?>" title="<?php the_title(); ?>" target="_blank">
					
					<?php if ( has_post_thumbnail() ) { ?>
						<img src="<?php echo wpex_get_featured_img_url(); ?>" alt="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" />
					<?php } else if (get_post_meta($post->ID, "image_url", true) != "") { ?>
						<img src="<?php echo get_post_meta($post->ID, "image_url", true);?>" alt="<?php echo esc_attr( the_title_attribute( 'echo=0' ) ); ?>" />
					<?php } else { ?>
						
					<?php } ?>
					</a>
				</div><!-- .post-entry-thumbnail -->
			
			
			<div class="loop-entry-content clr">
				<header class="loop-entry-header">
					<h2 class="loop-entry-title"><a href="<?php $key="url"; echo get_post_meta($post->ID, $key, true); ?>" title="<?php the_title(); ?>" target="_blank"><?php the_title(); ?></a></h2>
						
					<a href="/?publisher=<?php $key="publisher"; echo get_post_meta($post->ID, $key, true); ?>" title="View all links from <?php $key="publisher"; echo get_post_meta($post->ID, $key, true); ?>"><span><?php $key="publisher"; echo get_post_meta($post->ID, $key, true); ?></a> <?php $the_author = get_post_meta($post->ID, "author", true); if( ! empty( $the_author ) ) {echo "| " . "<a href='?author=" . $the_author ."' title='View all links from " . $the_author . "'>" .$the_author ;}  ?></span></a>
					
					<?php $the_curator = get_post_meta($post->ID, "curator", true); if( $the_curator != "David Bauer" && $the_curator != ""  ) {echo "<br/><span class='highlight'>Guest curated by " . $the_curator . "</span>";}  ?>
						
				</header>
				<div class="loop-entry-excerpt entry clr">
					<?php the_content(); ?>
				</div><!-- .loop-entry-excerpt -->
				<div class="readmore">
					<a href="<?php $key="url"; echo get_post_meta($post->ID, $key, true); ?>" title="Go to <?php the_title(); ?>" class="loop-entry-readmore" target="_blank">Read more</a>
				</div>
				<div class="readmore pocket"></div>
				<div class="readmore instapaper"></div>
				
				
				<div class="filed">
				Published in <a href="?issue=<?php $key="issue"; echo get_post_meta($post->ID, $key, true); ?>">Weekly Filet #<?php $key="issue"; echo get_post_meta($post->ID, $key, true); ?></a>
				<ul class="tags"><?php the_tags("#",", #",""); ?></ul>
				
				<!-- list collections if post has one or more collection assigned -->
				<?php $the_collection = get_post_meta($post->ID, "collection", true); 
								
				if( ! empty( $the_collection )) { 
					
					if (is_array($the_collection)) {
						
						if( count($the_collection) > 1 ) {
							echo "In collections: ";
							$numItems = count($the_collection);
							$i = 0;
							foreach($the_collection as $coll) {
								echo "<a href='?collection=" . $coll . "'>" . $coll . "</a>";
								if(++$i < $numItems) { // add a comma after each collection except the last one
								echo ", ";
								}
							};
						}
						
						else {
							echo "In collection: <a href='?collection=" . $the_collection[0] . "'>" . $the_collection[0] . "</a>";
						}
					}
					
					// applies for imported posts that have collection as a string, not array
					else {echo "In collection: <a href='?collection=" . $the_collection . "'>" . $the_collection . "</a>";}
				
				}
				?>
				
				<?php edit_post_link(); ?>
				
				<a class="permalink" title="Link directly to this recommendation" href="<?php the_permalink(); ?>"><i class="fa fa-link"></i></a>
				</div>
							
			</div><!-- .loop-entry-content -->
		</div><!-- .loop-entry-inner -->
	</article><!-- .loop-entry -->

<?php } ?>