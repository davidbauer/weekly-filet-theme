<?php
/**
 * Theme functions and definitions.
 *
 * Sets up the theme and provides some helper functions
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development
 * and http://codex.wordpress.org/Child_Themes), you can override certain
 * functions (those wrapped in a function_exists() call) by defining them first
 * in your child theme's functions.php file. The child theme's functions.php
 * file is included before the parent theme's file, so the child theme
 * functions would be used.
 *
 *
 * For more information on hooks, actions, and filters,
 * see http://codex.wordpress.org/Plugin_API
 *
 * @package WordPress
 * @subpackage Magtastico WPExplorer Theme
 * @since Magtastico 1.0
 */




/**
	Constants
 **/
define( 'WPEX_JS_DIR_URI', get_template_directory_uri().'/js' );
define( 'WPEX_THEME_BRANDING', get_theme_mod( 'wpex_theme_branding', 'MAG' ) );


/**
	Theme Setup
 **/
if ( ! isset( $content_width ) ) $content_width = 650;

// Theme setup - menus, theme support, etc
require_once( get_template_directory() .'/functions/theme-setup.php' );

// Recommend plugins for use with this theme
require_once ( get_template_directory() .'/functions/recommend-plugins.php' );



/**
	Theme Customizer
 **/

// Header Options
require_once ( get_template_directory() .'/functions/theme-customizer/logo.php' );

// General Options
require_once ( get_template_directory() .'/functions/theme-customizer/general.php' );

// Styling Options
require_once ( get_template_directory() .'/functions/theme-customizer/styling.php' );

// Image resizing Options
require_once ( get_template_directory() .'/functions/theme-customizer/image-sizes.php' );


/**
	Includes
 **/

// Admin only functions
if ( is_admin() ) {

	// Default meta options usage
	require_once( get_template_directory() .'/functions/meta/usage.php' );

	// Post editor tweaks
	require_once( get_template_directory() .'/functions/mce.php' );

	// Gallery Metabox
	require_once( get_template_directory() .'/functions/meta/gallery-metabox/gmb-admin.php' );

// Non admin functions
} else {

	// Menu Walkers
	require_once( get_template_directory() .'/functions/menu-walker.php' );

	// Gallery Metabox
	require_once( get_template_directory() .'/functions/meta/gallery-metabox/gmb-display.php' );

	// Function that returns correct grid class for specific column number
	require_once( get_template_directory() .'/functions/grid.php' );

	// Outputs the main site logo
	require_once( get_template_directory() .'/functions/logo.php' );

	// Loads front end css and js
	require_once( get_template_directory() .'/functions/scripts.php' );

	// Image resizing script
	require_once( get_template_directory() .'/functions/aqua-resizer.php' );

	// Show or hide sidebar accordingly
	require_once( get_template_directory() .'/functions/sidebar-display.php' );

	// Returns the correct image sizes for cropping
	require_once( get_template_directory() .'/functions/featured-image.php' );

	// Comments output
	require_once( get_template_directory() .'/functions/comments-callback.php' );

	// Pagination output
	require_once( get_template_directory() .'/functions/pagination.php' );

	// Custom excerpts
	require_once( get_template_directory() .'/functions/excerpts.php' );

	// Outputs post meta (date, cat, comment count)
	require_once( get_template_directory() .'/functions/post-meta.php' );

	// Used for next/previous links on single posts
	require_once( get_template_directory() .'/functions/next-prev.php' );

	// Outputs the post format video
	require_once( get_template_directory() .'/functions/post-video.php' );

	// Outputs the post format audio
	require_once( get_template_directory() .'/functions/post-audio.php' );

	// Outputs post author bio
	require_once( get_template_directory() .'/functions/post-author.php' );

	// Outputs post slider
	require_once( get_template_directory() .'/functions/post-gallery.php' );

	// Adds classes to entries
	require_once( get_template_directory() .'/functions/post-classes.php' );

	// Adds a mobile search to the sidr container
	require_once( get_template_directory() .'/functions/mobile-search.php' );

	// Custom WP Gallery Output
	if ( get_theme_mod( 'wpex_custom_wp_gallery_output', '1' ) ) {
		require_once( get_template_directory() .'/functions/wp-gallery.php' );
	}

	// Page featured images
	require_once( get_template_directory() .'/functions/page-featured-image.php' );

	// Post featured images
	require_once( get_template_directory() .'/functions/post-featured-image.php' );

	// Breadcrumbs
	require_once( get_template_directory() .'/functions/breadcrumbs.php' );

	// Scroll top link
	require_once( get_template_directory() .'/functions/scroll-top-link.php' );

	// Body Classes
	require_once( get_template_directory() .'/functions/body-classes.php' );

	// Outputs content for quote format
	require_once( get_template_directory() .'/functions/quote-content.php' );

	// Social Share
	require_once( get_template_directory() .'/functions/social-share.php' );

	// Remove frameborder from oembed
	require_once( get_template_directory() .'/functions/oembed-remove-frameborder.php' );
	

function catch_that_image() {
  global $post, $posts;
  $first_img = '';
  ob_start();
  ob_end_clean();
  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i',$post->post_images, $matches);
  $first_img = $matches [1] [0];

  if(empty($first_img)){ //Defines a default image
    $first_img = "http://www.weeklyfilet.com/wp-content/themes/weeklyfilet-V3/images/logo.png";
  }
  return $first_img;
}


function wt_get_category_count($input = '') {
	global $wpdb;
	if($input == '')
	{
		$category = get_the_category();
		return $category[0]->category_count;
	}
	elseif(is_numeric($input))
	{
		$SQL = "SELECT $wpdb->term_taxonomy.count FROM $wpdb->terms, $wpdb->term_taxonomy WHERE $wpdb->terms.term_id=$wpdb->term_taxonomy.term_id AND $wpdb->term_taxonomy.term_id=$input";
		return $wpdb->get_var($SQL);
	}
	else
	{
		$SQL = "SELECT $wpdb->term_taxonomy.count FROM $wpdb->terms, $wpdb->term_taxonomy WHERE $wpdb->terms.term_id=$wpdb->term_taxonomy.term_id AND $wpdb->terms.slug='$input'";
		return $wpdb->get_var($SQL);
	}
}

add_action('pre_get_posts', 'my_pre_get_posts');

function my_pre_get_posts( $query )
{
	// validate
	if( is_admin() )
	{
		return;
	}

	if( !$query->is_main_query() )
	{
		return;
	}

	// get original meta query
	$meta_query = $query->get('meta_query');

        // allow the url to alter the query
        // eg: http://www.website.com/events?location=melbourne
        // eg: http://www.website.com/events?location=sydney
        if( !empty($_GET['issue']) )
        {
        	$issues = explode(',', $_GET['issue']);

        	//Add our meta query to the original meta queries
	    	$meta_query[] = array(
                'key'		=> 'issue',
                'value'		=> $issues,
                'compare'	=> 'IN',
            );
        }

		if( !empty($_GET['collection']) )
        {
        	$collections = explode(',',$_GET['collection']);
			
        	//Add our meta query to the original meta queries
	    	foreach($collections as $collection):
			$meta_query[] = array(
			'key'	=> 'collection', 
			'value'	=> $collection, 
			'compare'	=> 'LIKE'
			);
			endforeach;
        }
		
		if( !empty($_GET['publisher']) )
        {
        	$publisher = explode(',', $_GET['publisher']);

        	//Add our meta query to the original meta queries
	    	$meta_query[] = array(
                'key'		=> 'publisher',
                'value'		=> $publisher,
                'compare'	=> 'IN',
            );
        }
        
        if( !empty($_GET['author']) )
        {
        	$author = explode(',', $_GET['author']);

        	//Add our meta query to the original meta queries
	    	$meta_query[] = array(
                'key'		=> 'author',
                'value'		=> $author,
                'compare'	=> 'IN',
            );
        }

		
	// update the meta query args
	$query->set('meta_query', $meta_query);

	// always return
	return;

}

/* Cookies http://www.codecheese.com/2013/11/how-to-set-and-get-or-delete-cookies-with-wordpress/ 


add_action( 'init', 'my_setcookie' );

function my_setcookie($instapaper,$pocket) {
   setcookie( 'Instapaper', $instapaper, time() + 60*60*24*14, COOKIEPATH, COOKIE_DOMAIN );
   //setcookie( 'Pocket', $pocket, time() + 60*60*24*14, COOKIEPATH, COOKIE_DOMAIN );
}


add_action( 'wp_head', 'my_getcookie' );
function my_getcookie() {
   $instapaper = isset( $_COOKIE['Instapaper'] ) ? $_COOKIE['Instapaper'] : 'not set';
   $pocket = isset( $_COOKIE['Pocket'] ) ? $_COOKIE['Pocket'] : 'not set';
   echo "<script type='text/javascript'>console.log('$instapaper')</script>";
   
   
   "<script type='text/javascript'>
   			if (readlaterservices.indexOf("Instapaper") > -1) {
	   			$('#Instapaper').prop('checked', true);
   			}
   			
   			if (readlaterservices.indexOf("Pocket") > -1) {
	   			$('#Pocket').prop('checked', true);
   			}
   		</script>";
}

*/
	

}