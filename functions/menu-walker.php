<?php
/**
 * Modify WP menu for dropdown styles
 *
 *
 * @package WordPress
 * @subpackage Magtastico WPExplorer Theme
 * @since Magtastico 1.0
 */

class WPEX_Walker_Nav extends Walker_Nav_Menu {
	function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output) {
		$id_field = $this->db_fields['id'];
		if ( !empty( $children_elements[$element->$id_field] ) && ( $depth == 0 ) ) {
			$element->title .= '<span class="fa fa-caret-down"></span>';
		}
		if ( !empty( $children_elements[$element->$id_field] ) && ( $depth > 0 ) ) {
			$element->title .= '<span class="fa fa-caret-down"></span>';
		}
		Walker_Nav_Menu::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
	}
}