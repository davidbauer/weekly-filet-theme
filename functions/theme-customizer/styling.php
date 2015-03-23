<?php
/**
 * This class adds styling (color) options to the WordPress
 * Theme Customizer and outputs the needed CSS to the header
 * 
 * @link http://codex.wordpress.org/Theme_Customization_API
 * @package WordPress
 * @subpackage Magtastico WPExplorer Theme
 * @since Magtastico 1.0
 */

class WPEX_Theme_Customizer_Styling {

	/**
	* This hooks into 'customize_register' (available as of WP 3.4) and allows
	* you to add new sections and controls to the Theme Customize screen.
	*
	* @see add_action('register',$func)
	* @param \WP_Customize_Manager $wp_customize
	* @since Magtastico 1.0
	*/
	public static function register ( $wp_customize ) {

			// Theme Design Section
			$wp_customize->add_section( 'wpex_styling' , array(
				'title'		=> __( 'Styling', 'wpex' ),
				'priority'	=> 202,
			) );

			// Color Skin
			$wp_customize->add_setting( 'wpex_theme_skin', array(
				'type'		=> 'theme_mod',
				'default'	=> 'purple',
			) );

			$wp_customize->add_control( 'wpex_theme_skin', array(
				'label'		=> __( 'Theme Skin','wpex'),
				'section'	=> 'wpex_styling',
				'settings'	=> 'wpex_theme_skin',
				'priority'	=> '1',
				'type'		=> 'select',
				'choices'	=> array (
					'purple'		=> __( 'Purple (Default)', 'wpex' ),
					'black'			=> __( 'Black', 'wpex' ),
					'gray'			=> __( 'Gray', 'wpex' ),
					'slate'			=> __( 'Slate', 'wpex' ),
					'light-blue'	=> __( 'Light Blue', 'wpex' ),
					'red'			=> __( 'Red', 'wpex' ),
				)
			) );

			// Get Color Options
			$color_options = self::wpex_color_options();

			// Loop through color options and add a theme customizer setting for it
			$count='2';
			foreach( $color_options as $option ) {
				$count++;
				$default = isset($option['default']) ? $option['default'] : '';
				$type = isset($option['type']) ? $option['type'] : '';
				$wp_customize->add_setting( 'wpex_'. $option['id'] .'', array(
					'type'		=> 'theme_mod',
					'default'	=> $default,
					'transport'	=> 'refresh',
				) );
				if ( 'text' == $type ) {
					$wp_customize->add_control( 'wpex_'. $option['id'] .'', array(
						'label'		=> $option['label'],
						'section'	=> 'wpex_styling',
						'settings'	=> 'wpex_'. $option['id'] .'',
						'priority'	=> $count,
						'type'		=> 'text',
					) );
				} else {
					$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'wpex_'. $option['id'] .'', array(
						'label'		=> $option['label'],
						'section'	=> 'wpex_styling',
						'settings'	=> 'wpex_'. $option['id'] .'',
						'priority'	=> $count,
					) ) );
				}
			} // End foreach

	} // End register


	/**
	* This will output the custom styling settings to the live theme's WP head.
	* Used by hook: 'wp_head'
	* 
	* @see add_action('wp_head',$func)
	* @since Magtastico 1.0
	*/
	public static function header_output() {
		$color_options = self::wpex_color_options();
		$css ='';
		foreach( $color_options as $option ) {
			$theme_mod = get_theme_mod('wpex_'. $option['id'] .'');
			$important = isset($option['important']) ? '!important' : '';
			if ( '' != $theme_mod ) {
				$css .= $option['element'] .'{ '. $option['style'] .':'. $theme_mod . $important .'; }';
			}
		}
		$css =  preg_replace( '/\s+/', ' ', $css );
		$css = "<!-- Theme Customizer Styling Options -->\n<style type=\"text/css\">\n" . $css . "\n</style>";
		if ( !empty( $css ) ) {
			echo $css;
		}
	} // End header_output function


	/**
	* Array of styling options
	* 
	* @since Magtastico 1.0
	*/
	public static function wpex_color_options() {

		$array = array();

		$array[] = array(
			'label'		=>	__( 'Logo Text Color', 'wpex' ),
			'id'		=>	'logo_color',
			'element'	=> '#main-sidebar #logo a.site-logo',
			'style'		=> 'color',
			'important'	=> true,
		);

		$array[] = array(
			'label'		=>	__( 'Logo Subheading Text Color', 'wpex' ),
			'id'		=>	'subheading_color',
			'element'	=> '.blog-description',
			'style'		=> 'color',
		);

		$array[] = array(
			'label'		=> __( 'Sidebar Background', 'wpex' ),
			'id'		=> 'sidebar_bg',
			'element'	=> 'body, #main-sidebar',
			'style'		=> 'background-color',
		);

		$array[] = array(
			'label'		=> __( 'Sidebar Color', 'wpex' ),
			'id'		=> 'sidebar_color',
			'element'	=> '#main-sidebar, #main-sidebar p',
			'style'		=> 'color',
			'important'	=> true,
		);

		$array[] = array(
			'label'		=> __( 'Menu Borders', 'wpex' ),
			'id'		=> 'menu_borders',
			'element'	=> '#site-navigation, #site-navigation .main-nav > li > a, #site-navigation .main-nav > li > .sub-menu',
			'style'		=> 'border-color',
			'important'	=> true,
		);

		$array[] = array(
			'label'		=> __( 'Sidebar Link Color', 'wpex' ),
			'id'		=> 'sidebar_link_color',
			'element'	=> '#main-sidebar a, #main-sidebar .textwidget a',
			'style'		=> 'color',
			'important'	=> true,
		);

		$array[] = array(
			'label'		=> __( 'Sidebar HoverLink Color', 'wpex' ),
			'id'		=> 'sidebar_link_hover_color',
			'element'	=> '#main-sidebar a:hover, #site-navigation .current-menu-item > a, #main-sidebar .textwidget a:hover',
			'style'		=> 'color',
			'important'	=> true,
		);

		$array[] = array(
			'label'		=>	__( 'Readmore Color', 'wpex' ),
			'id'		=>	'readmore_color',
			'element'	=> '.loop-entry-readmore',
			'style'		=> 'color',
		);

		$array[] = array(
			'label'		=>	__( 'Readmore Background', 'wpex' ),
			'id'		=>	'readmore_bg_color',
			'element'	=> '.loop-entry-readmore',
			'style'		=> 'background-color',
		);

		$array[] = array(
			'label'		=>	__( 'Readmore Hover Color', 'wpex' ),
			'id'		=>	'readmore_hover_color',
			'element'	=> '.loop-entry-readmore:hover',
			'style'		=> 'color',
		);

		$array[] = array(
			'label'		=>	__( 'Readmore Hover Background', 'wpex' ),
			'id'		=>	'readmore_hover_bg_color',
			'element'	=> '.loop-entry-readmore:hover',
			'style'		=> 'background-color',
		);

		$array[] = array(
			'label'		=>	__( 'Entry Title Hover Color', 'wpex' ),
			'id'		=>	'entry_title_hover_color',
			'element'	=> '.loop-entry-title a:hover',
			'style'		=> 'color',
		);

		$array[] = array(
			'label'		=>	__( 'Entry Overlay Background', 'wpex' ),
			'id'		=>	'entry_overlay_bg',
			'element'	=> '.loop-entry-thumbnail a:before',
			'style'		=> 'background-color',
		);

		$array[] = array(
			'label'		=>	__( 'Quote Entry Background', 'wpex' ),
			'id'		=>	'quote_bg',
			'element'	=> '.loop-entry.format-quote a, .quote-post-entry',
			'style'		=> 'background-color',
		);

		$array[] = array(
			'label'		=>	__( 'Quote Entry Hover Background', 'wpex' ),
			'id'		=>	'quote_bg_hover',
			'element'	=> '.loop-entry.format-quote a:hover',
			'style'		=> 'background-color',
			'important'	=> true,
		);

		$array[] = array(
			'label'		=>	__( 'Quote Entry Color', 'wpex' ),
			'id'		=>	'quote_color',
			'element'	=> '.loop-entry.format-quote a, .quote-post-entry',
			'style'		=> 'color',
			'important'	=> true,
		);

		$array[] = array(
			'label'		=>	__( 'Quote Entry Hover Color', 'wpex' ),
			'id'		=>	'quote_color_hover',
			'element'	=> '.loop-entry.format-quote a:hover',
			'style'		=> 'color',
			'important'	=> true,
		);

		$array[] = array(
			'label'		=>	__( 'Post Link Color', 'wpex' ),
			'id'		=>	'post_link_color',
			'element'	=> '.single .entry a, p.logged-in-as a, .comment-navigation a',
			'style'		=> 'color',
		);

		$array[] = array(
			'label'		=>	__( 'Post Link Hover Color', 'wpex' ),
			'id'		=>	'post_link_hover_color',
			'element'	=> '.single .entry a:hover, p.logged-in-as a:hover, .comment-navigation a:hover',
			'style'		=> 'color',
		);

		$array[] = array(
			'label'		=>	__( 'Back To Top Arrow Color', 'wpex' ),
			'id'		=>	'scrolltop_color',
			'element'	=> '.site-scroll-top',
			'style'		=> 'color',
			'important'	=> true,
		);

		$array[] = array(
			'label'		=>	__( 'Back To Top Arrow Background', 'wpex' ),
			'id'		=>	'scrolltop_bg',
			'element'	=> '.site-scroll-top',
			'style'		=> 'background-color',
			'important'	=> true,
		);

		$array[] = array(
			'label'		=>	__( 'Theme Button Color', 'wpex' ),
			'id'		=>	'theme_button_color',
			'element'	=> 'input[type="button"], input[type="submit"], .page-numbers a:hover, .page-numbers.current, .page-links span, .page-links a:hover span',
			'style'		=> 'color',
			'important'	=> true,
		);

		$array[] = array(
			'label'		=>	__( 'Theme Button Background', 'wpex' ),
			'id'		=>	'theme_button_bg',
			'element'	=> 'input[type="button"], input[type="submit"], .page-numbers a:hover, .page-numbers.current, .page-links span, .page-links a:hover span',
			'style'		=> 'background',
			'important'	=> true,
		);

		$array[] = array(
			'label'		=>	__( 'Theme Button Hover Color', 'wpex' ),
			'id'		=>	'theme_button_hover_color',
			'element'	=> 'input[type="button"]:hover, input[type="submit"]:hover',
			'style'		=> 'color',
			'important'	=> true,
		);

		$array[] = array(
			'label'		=>	__( 'Theme Button Hover Background', 'wpex' ),
			'id'		=>	'theme_button_hover_bg',
			'element'	=> 'input[type="button"]:hover, input[type="submit"]:hover',
			'style'		=> 'background-color',
			'important'	=> true,
		);

		// Apply filters for child theming magic
		$array = apply_filters( 'wpex_color_options_array', $array );

		// Return array
		return $array;
	}

} // End Theme_Customizer_Styling Class


// Setup the Theme Customizer settings and controls
add_action( 'customize_register' , array( 'WPEX_Theme_Customizer_Styling' , 'register' ) );

// Output custom CSS to live site
add_action( 'wp_head' , array( 'WPEX_Theme_Customizer_Styling' , 'header_output' ) );