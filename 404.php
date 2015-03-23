<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Magtastico WPExplorer Theme
 * @since Magtastico 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area clr">
		<div id="content" class="site-content clr" role="main">
			<div id="error-page" class="clr boxed">
				<h1 id="error-page-title">404 – Junk Food</h1>
				
				<p>No filet has been found. To make sure this never happens again, subscribe to the weekly newsletter.</p>
				
				<p id="error-page-text">
					
					<?php get_template_part( 'tpl-subscribe');?>

				</p>
			</div><!-- #error-page -->
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>
 
 
