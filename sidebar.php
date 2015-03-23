<?php
/**
 * The sidebar containing the logo, menu and widgets
 *
 * @package WordPress
 * @subpackage Magtastico WPExplorer Theme
 * @since Magtastico 1.0
 */

?>

<aside id="main-sidebar" class="sidebar-container" role="complementary">
	<header id="header" class="site-header clr" role="banner">
		<?php
		// Outputs the site logo
		// See functions/logo.php
		// wpex_logo(); ?>
	</header><!-- #header -->
	<div id="sidebar-content-toggle" class="clr">
		<a href="#toogle-sidebar" title="<?php _e( 'Toggle Sidebar', 'wpex' ); ?>"><span class="fa fa-bars"></span></a>
	</div><!-- #sidebar-content-toggle -->
	<div id="main-sidebar-content" class="clr">
		
		<?php 	$issues = isset($_GET['issue']) ? explode(',', $_GET['issue']) : array();
			$publisher = isset($_GET['publisher']) ? explode(',', $_GET['publisher']) : array();
			$collection = isset($_GET['collection']) ? explode(',', $_GET['collection']) : array();
			$author = isset($_GET['author']) ? explode(',', $_GET['author']) : array();
	?>
		
		<?php if ($issues || $publisher || $collection || $author || is_single() || is_page()):?>
		<div class="widget-box widget_tag_cloud clr">			
			<div class="tagcloud">
			<a href="/">To home page</a>
			</div>
		</div>
		<?php endif; ?>
		
		<?php get_search_form(); ?>
		
		<div class="widget-box widget_tag_cloud clr">
			<h3>Collections</h3>
			<div class="tagcloud">
			<a href="http://www.weeklyfilet.com?collection=Unputdownable%20Stories">Unputdownable Stories</a>
			<a href="http://www.weeklyfilet.com?collection=The%20Future%20Is%20Now">The Future Is Now</a>
			<a href="http://www.weeklyfilet.com?collection=Think%20Different">Think Different</a>
			<a href="http://www.weeklyfilet.com?collection=Guest%20Butchers%20FTW">Guest Butchers FTW</a>
			<a href="http://www.weeklyfilet.com?collection=Best%20of%202014">Best of 2014</a>
			</div>
		</div>
		
		<div class="widget-box widget_tag_cloud clr">
			<h3>Topics</h3>
			<div class="tags tagcloud">
			<?php wp_tag_cloud('number=15'); ?>
			</div>
		</div>
		
		<div class="mobile-hide">
		<span>BETA: Select your read later service</span>
		<form id="readlaterselection">
			<input id="Pocket" class="readlateroption" type="checkbox" name="readlaterservice" value="Pocket"><label for="Pocket">Pocket</label><br>
			<input id="Instapaper" class="readlateroption" type="checkbox" name="readlaterservice" value="Instapaper"><label for="Instapaper">Instapaper</label> 
		</form>
		<span>(doesn't get saved yet, but soon will)</span>
		</div>
		
		<?php get_template_part( 'tpl-support');?>

		<!--
		<?php if ( has_nav_menu( 'main_menu' ) ) { ?>
			<nav id="site-navigation" class="navigation main-navigation clr" role="navigation">
				<?php
				// Display main menu
				wp_nav_menu( array(
					'theme_location'	=> 'main_menu',
					'sort_column'		=> 'menu_order',
					'menu_class'		=> 'main-nav',
					'fallback_cb'		=> false,
					'walker'			=> new WPEX_Walker_Nav(),
				) ); ?>
			</nav> #site-navigation
		<?php } ?>-->
		<div class="widget-area clr">
			<?php dynamic_sidebar( 'main-sidebar' ); ?>
		</div><!-- .widget-area  -->
	</div><!-- #main-sidebar-content  -->
</aside><!-- #main-sidebar -->