<?php
/**
 * Used for your site wide breadcrumbs
 * Support for Yoast SEO Breadcrumbs
 *
 * @package WordPress
 * @subpackage Magtastico WPExplorer Theme
 * @since Magtastico 1.0
*/



// Returns the correct breadcrumbs function
if ( !function_exists( 'wpex_display_breadcrumbs' ) ) {
	
	function wpex_display_breadcrumbs() {

		// Only display on singular posts
		if ( !is_singular( 'post' ) ) return;

		// Global enable option
		if ( '1' != get_theme_mod( 'wpex_breadcrumbs', '1' ) ) return;
		
		// Meta disabled breadcrumbs
		if ( is_singular() ) {
			global $post;
			if ( $post->ID ) {
				if ( 'on' == get_post_meta( $post->ID, 'wpex_disable_breadcrumbs', true ) ) return;
			}
		}
		
		// Yoast breadcrumbs
		if( function_exists('yoast_breadcrumb') ) {
			return yoast_breadcrumb('<nav class="site-breadcrumbs clr"">','</nav>');
		
		// Built-in breadcrumbs
		} else {
			echo wpex_breadcrumbs();
		}
		
	} // End function
	
} // End if


// Begin breadcrumbs Class
if ( !function_exists( 'wpex_breadcrumbs' ) ) {
	function wpex_breadcrumbs( $args = array() ) {
		
		global $wp_query, $wp_rewrite;
		
		/*woocommerce*/
		if ( class_exists('Woocommerce') ) {
			$shop_page_url = get_permalink( woocommerce_get_page_id( 'shop' ) );
			$shop_title = __('Shop','wpex');
			$shop_title = apply_filters( 'wpex_bcrums_shop_title', $shop_title );
		}

		// Google microdata
		$item_type_scope = 'itemscope="" itemtype="http://data-vocabulary.org/Breadcrumb"';

		/* Create an empty variable for the breadcrumb. */
		$breadcrumb = '';

		/* Create an empty array for the trail. */
		$trail = array();
		$path = '';

		/* Set up the default arguments for the breadcrumb. */
		if ( !is_rtl() ) {
			$seperator_html = '<i class="fa fa-caret-right breadcrumbs-sep"></i>';
		} else {
			$seperator_html = '<i class="fa fa-caret-left breadcrumbs-sep"></i>';
		}
		$defaults = array(
			'separator'			=> $seperator_html,
			'before'			=> '',
			'after'				=> false,
			'front_page'		=> true,
			'show_home'			=> __( 'Home', 'wpex' ),
			'echo'				=> false, 
			'show_posts_page'	=> true
		);
		

		/* Allow singular post views to have a taxonomy's terms prefixing the trail. */
		if ( is_singular() )
			$defaults["singular_{$wp_query->post->post_type}_taxonomy"] = false;

		/* Apply filters to the arguments. */
		$args = apply_filters( 'wpex_breadcrumbs_args', $args );

		/* Parse the arguments and extract them for easy variable naming. */
		extract( wp_parse_args( $args, $defaults ) );

		/* If $show_home is set and we're not on the front page of the site, link to the home page. */
		if ( !is_front_page() && $show_home ) {
			if ( !is_rtl() ) {
				$icon_left = '<i class="fa fa-home"></i>';
				$icon_right = '';
			} else {
				$icon_right = '<i class="fa fa-home"></i>';
				$icon_left = '';
			}
			$trail[] = '<span '. $item_type_scope .'>
							<a href="' . home_url() . '" title="' . esc_attr( get_bloginfo( 'name' ) ) . '" rel="home" class="trail-begin">
								<span itemprop="title">' . $icon_left . $show_home . $icon_right . '</span>
							</a>
						</span>';
		}

		/* If viewing the front page of the site. */
		if ( is_front_page() ) {
			if ( !$front_page )
				$trail = false;
			elseif ( $show_home )
				$trail['trail_end'] = "{$show_home}";
		}

		/* If viewing the "home"/posts page. */
		elseif ( is_home() ) {
			$home_page = get_page( $wp_query->get_queried_object_id() );
			$trail = array_merge( $trail, wpex_breadcrumbs_get_parents( $home_page->post_parent, '' ) );
			$trail['trail_end'] = get_the_title( $home_page->ID );
		}

		/* If viewing a singular post (page, attachment, etc.). */
		elseif ( is_singular() ) {
			
			/* Get singular post variables needed. */
			$post = $wp_query->get_queried_object();
			$post_id = absint( $wp_query->get_queried_object_id() );
			$post_type = $post->post_type;
			$parent = $post->post_parent;
			

			/* If a custom post type, check if there are any pages in its hierarchy based on the slug. */
			if ( 'page' !== $post_type && 'post' !== $post_type ) {

				$post_type_object = get_post_type_object( $post_type );
				
				/* If $front has been set, add it to the $path. */
				if ( 'post' == $post_type || 'attachment' == $post_type || ( $post_type_object->rewrite['with_front'] && $wp_rewrite->front ) )
					$path .= trailingslashit( $wp_rewrite->front );

				/* If there's a slug, add it to the $path. */
				if ( !empty( $post_type_object->rewrite['slug'] ) )
					$path .= $post_type_object->rewrite['slug'];

				/* If there's a path, check for parents. */
				if ( !empty( $path ) )
					$trail = array_merge( $trail, wpex_breadcrumbs_get_parents( '', $path ) );

				/* If there's an archive page, add it to the trail. */
				if ( !empty( $post_type_object->has_archive ) && function_exists( 'get_post_type_archive_link' ) )
					if ( !is_singular('product') ) {
						$trail[] = '<span '. $item_type_scope .'>
										<a href="' . get_post_type_archive_link( $post_type ) . '" title="' . esc_attr( $post_type_object->labels->name ) . '">
											<span itemprop="title">' . $post_type_object->labels->name . '</span>
										</a>
									</span>';
					}
					
			}
			
			/*add shop page to cart*/
			if ( is_singular('page') && class_exists('Woocommerce') ) {
				if ( is_cart() || is_checkout() ) {
					$trail[] = '<span '. $item_type_scope .'>
									<a href="'. $shop_page_url .'" title="'. $shop_title .'" itemprop="url">
										<span itemprop="title">'. $shop_title .'</span>
									</a>
								</span>';
				}
			}

			// Standard Posts
			if('post' == $post_type) {

				// 1st Category
				$terms = get_the_terms( $post_id, 'category');
				if ( $terms ) {
					$term = reset($terms);
					$trail[] = '<span '. $item_type_scope .'>
									<a href="'. get_term_link($term) .'" itemprop="url" title="'. $term->name .'">
										<span itemprop="title">'. $term->name .'</span>
									</a>
								</span>';
				}
			}

			/* If the post type path returns nothing and there is a parent, get its parents. */
			if ( empty( $path ) && 0 !== $parent || 'attachment' == $post_type )
				$trail = array_merge( $trail, wpex_breadcrumbs_get_parents( $parent, '' ) );

			/* Toggle the display of the posts page on single blog posts. */
			if ( 'post' == $post_type && $show_posts_page == true && 'page' == get_option( 'show_on_front' ) ) {
				$posts_page = get_option( 'page_for_posts' );
				if ( $posts_page != '' && is_numeric( $posts_page ) ) {
					$trail = array_merge( $trail, wpex_breadcrumbs_get_parents( $posts_page, '' ) );
				}
			}

			/* Display terms for specific post type taxonomy if requested. */
			if ( isset( $args["singular_{$post_type}_taxonomy"] ) && $terms = get_the_term_list( $post_id, $args["singular_{$post_type}_taxonomy"], '', ', ', '' ) )
				$trail[] = $terms;

			/* End with the post title. */
			$post_title = get_the_title( $post_id ); // Force the post_id to make sure we get the correct page title.
			if ( !empty( $post_title ) ) {
				$post_title_length = str_word_count($post_title);
				$trail['trail_end'] = $post_title;
			}
		}

		/* If we're viewing any type of archive. */
		elseif ( is_archive() ) {
			
			// Topics
			if ( is_post_type_archive('topic') ) {
				$forums_link = get_post_type_archive_link('forum');
				$forum_obj = get_post_type_object( 'forum' );
				$forum_name = $forum_obj->labels->name;
				if ( $forums_link ) {
					$trail[] = '<a href="'. $forums_link .'" title="'. $forum_name .'">'. $forum_name .'</a>';
				}
			}

			/* If viewing a taxonomy term archive. */
			if ( is_tax() || is_category() || is_tag() ) {

				/* Get some taxonomy and term variables. */
				$term = $wp_query->get_queried_object();
				$taxonomy = get_taxonomy( $term->taxonomy );
				
				/* Get the path to the term archive. Use this to determine if a page is present with it. */
				if ( is_category() )
					$path = get_option( 'category_base' );
				elseif ( is_tag() )
					$path = get_option( 'tag_base' );
				else {
					if ( $taxonomy->rewrite['with_front'] && $wp_rewrite->front )
						$path = trailingslashit( $wp_rewrite->front );
					$path .= $taxonomy->rewrite['slug'];
				}

				/* Get parent pages by path if they exist. */
				if ( $path )
					$trail = array_merge( $trail, wpex_breadcrumbs_get_parents( '', $path ) );

				/* If the taxonomy is hierarchical, list its parent terms. */
				if ( is_taxonomy_hierarchical( $term->taxonomy ) && $term->parent )
					$trail = array_merge( $trail, wpex_breadcrumbs_get_term_parents( $term->parent, $term->taxonomy ) );

				/* Add the term name to the trail end. */
				$trail['trail_end'] = $term->name;
			}

			/* If viewing a post type archive. */
			elseif ( function_exists( 'is_post_type_archive' ) && is_post_type_archive() ) {

				/* Get the post type object. */
				$post_type_object = get_post_type_object( get_query_var( 'post_type' ) );

				/* If $front has been set, add it to the $path. */
				if ( $post_type_object->rewrite['with_front'] && $wp_rewrite->front )
					$path .= trailingslashit( $wp_rewrite->front );

				/* If there's a slug, add it to the $path. */
				if ( !empty( $post_type_object->rewrite['archive'] ) )
					$path .= $post_type_object->rewrite['archive'];

				/* If there's a path, check for parents. */
				if ( !empty( $path ) )
					$trail = array_merge( $trail, wpex_breadcrumbs_get_parents( '', $path ) );

				/* Add the post type [plural] name to the trail end. */
				$trail['trail_end'] = $post_type_object->labels->name;
			}

			/* If viewing an author archive. */
			elseif ( is_author() ) {

				/* If $front has been set, add it to $path. */
				if ( !empty( $wp_rewrite->front ) )
					$path .= trailingslashit( $wp_rewrite->front );

				/* If an $author_base exists, add it to $path. */
				if ( !empty( $wp_rewrite->author_base ) )
					$path .= $wp_rewrite->author_base;

				/* If $path exists, check for parent pages. */
				if ( !empty( $path ) )
					$trail = array_merge( $trail, wpex_breadcrumbs_get_parents( '', $path ) );

				/* Add the author's display name to the trail end. */
				$trail['trail_end'] = get_the_author_meta( 'display_name', get_query_var( 'author' ) );
			}

			/* If viewing a time-based archive. */
			elseif ( is_time() ) {

				if ( get_query_var( 'minute' ) && get_query_var( 'hour' ) )
					$trail['trail_end'] = get_the_time( __( 'g:i a', 'wpex' ) );

				elseif ( get_query_var( 'minute' ) )
					$trail['trail_end'] = sprintf( __( 'Minute %1$s', 'wpex' ), get_the_time( __( 'i', 'wpex' ) ) );

				elseif ( get_query_var( 'hour' ) )
					$trail['trail_end'] = get_the_time( __( 'g a', 'wpex' ) );
			}

			/* If viewing a date-based archive. */
			elseif ( is_date() ) {

				/* If $front has been set, check for parent pages. */
				if ( $wp_rewrite->front )
					$trail = array_merge( $trail, wpex_breadcrumbs_get_parents( '', $wp_rewrite->front ) );

				if ( is_day() ) {
					$trail[] = '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '" title="' . get_the_time( esc_attr__( 'Y', 'wpex' ) ) . '">' . get_the_time( __( 'Y', 'wpex' ) ) . '</a>';
					$trail[] = '<a href="' . get_month_link( get_the_time( 'Y' ), get_the_time( 'm' ) ) . '" title="' . get_the_time( esc_attr__( 'F', 'wpex' ) ) . '">' . get_the_time( __( 'F', 'wpex' ) ) . '</a>';
					$trail['trail_end'] = get_the_time( __( 'j', 'wpex' ) );
				}

				elseif ( get_query_var( 'w' ) ) {
					$trail[] = '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '" title="' . get_the_time( esc_attr__( 'Y', 'wpex' ) ) . '">' . get_the_time( __( 'Y', 'wpex' ) ) . '</a>';
					$trail['trail_end'] = sprintf( __( 'Week %1$s', 'wpex' ), get_the_time( esc_attr__( 'W', 'wpex' ) ) );
				}

				elseif ( is_month() ) {
					$trail[] = '<a href="' . get_year_link( get_the_time( 'Y' ) ) . '" title="' . get_the_time( esc_attr__( 'Y', 'wpex' ) ) . '">' . get_the_time( __( 'Y', 'wpex' ) ) . '</a>';
					$trail['trail_end'] = get_the_time( __( 'F', 'wpex' ) );
				}

				elseif ( is_year() ) {
					$trail['trail_end'] = get_the_time( __( 'Y', 'wpex' ) );
				}
			}
		}

		/* If viewing search results. */
		elseif ( is_search() )
			$trail['trail_end'] = sprintf( __( 'Search results for &quot;%1$s&quot;', 'wpex' ), esc_attr( get_search_query() ) );

		/* If viewing a 404 error page. */
		elseif ( is_404() )
			$trail['trail_end'] = __( '404 Not Found', 'wpex' );

		/* Allow child themes/plugins to filter the trail array. */
		$trail = apply_filters( 'wpex_breadcrumbs_trail', $trail, $args );

		/* Connect the breadcrumb trail if there are items in the trail. */
		if ( is_array( $trail ) ) {

			/* Open the breadcrumb trail containers. */
			$breadcrumb = '<nav class="site-breadcrumbs clr"><div class="breadcrumb-trail">';

			/* If $before was set, wrap it in a container. */
			if ( !empty( $before ) )
				$breadcrumb .= '<span class="trail-before">' . $before . '</span> ';

			/* Wrap the $trail['trail_end'] value in a container. */
			if ( !empty( $trail['trail_end'] ) )
				$trail['trail_end'] = '<span class="trail-end">' . $trail['trail_end'] . '</span>';

			/* Format the separator. */
			if ( !empty( $separator ) )
				$separator = '<span class="sep">' . $separator . '</span>';

			/* Join the individual trail items into a single string. */
			$breadcrumb .= join( " {$separator} ", $trail );

			/* If $after was set, wrap it in a container. */
			if ( !empty( $after ) )
				$breadcrumb .= ' <span class="trail-after">' . $after . '</span>';

			/* Close the breadcrumb trail containers. */
			$breadcrumb .= '</div></nav>';
		}

		/* Allow developers to filter the breadcrumb trail HTML. */
		$breadcrumb = apply_filters( 'wpex_breadcrumbs', $breadcrumb );

		/* Output the breadcrumb. */
		if ( $echo )
			echo $breadcrumb;
		else
			return $breadcrumb;

	} // End wpex_breadcrumbs()
}


if ( !function_exists( 'wpex_breadcrumbs_get_parents' ) ) {

	function wpex_breadcrumbs_get_parents( $post_id = '', $path = '' ) {

		/* Set up an empty trail array. */
		$trail = array();

		/* If neither a post ID nor path set, return an empty array. */
		if ( empty( $post_id ) && empty( $path ) )
			return $trail;

		/* If the post ID is empty, use the path to get the ID. */
		if ( empty( $post_id ) ) {

			/* Get parent post by the path. */
			$parent_page = get_page_by_path( $path );


			if( empty( $parent_page ) )
				// search on page name (single word)
				$parent_page = get_page_by_title ( $path );

			if( empty( $parent_page ) )
				// search on page title (multiple words)
				$parent_page = get_page_by_title ( str_replace( array('-', '_'), ' ', $path ) );

			/* End Modification */

			/* If a parent post is found, set the $post_id variable to it. */
			if ( !empty( $parent_page ) )
				$post_id = $parent_page->ID;
		}

		/* If a post ID and path is set, search for a post by the given path. */
		if ( $post_id == 0 && !empty( $path ) ) {

			/* Separate post names into separate paths by '/'. */
			$path = trim( $path, '/' );
			preg_match_all( "/\/.*?\z/", $path, $matches );

			/* If matches are found for the path. */
			if ( isset( $matches ) ) {

				/* Reverse the array of matches to search for posts in the proper order. */
				$matches = array_reverse( $matches );

				/* Loop through each of the path matches. */
				foreach ( $matches as $match ) {

					/* If a match is found. */
					if ( isset( $match[0] ) ) {

						/* Get the parent post by the given path. */
						$path = str_replace( $match[0], '', $path );
						$parent_page = get_page_by_path( trim( $path, '/' ) );

						/* If a parent post is found, set the $post_id and break out of the loop. */
						if ( !empty( $parent_page ) && $parent_page->ID > 0 ) {
							$post_id = $parent_page->ID;
							break;
						}
					}
				}
			}
		}

		/* While there's a post ID, add the post link to the $parents array. */
		while ( $post_id ) {

			/* Get the post by ID. */
			$page = get_page( $post_id );

			/* Add the formatted post link to the array of parents. */
			$parents[]  = '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_the_title( $post_id ) ) . '">' . get_the_title( $post_id ) . '</a>';

			/* Set the parent post's parent to the post ID. */
			$post_id = $page->post_parent;
		}

		/* If we have parent posts, reverse the array to put them in the proper order for the trail. */
		if ( isset( $parents ) )
			$trail = array_reverse( $parents );

		/* Return the trail of parent posts. */
		return $trail;

	} // End wpex_breadcrumbs_get_parents()
	
}

if ( !function_exists( 'wpex_breadcrumbs_get_term_parents' ) ) {

	function wpex_breadcrumbs_get_term_parents( $parent_id = '', $taxonomy = '' ) {

		/* Set up some default arrays. */
		$trail = array();
		$parents = array();

		/* If no term parent ID or taxonomy is given, return an empty array. */
		if ( empty( $parent_id ) || empty( $taxonomy ) )
			return $trail;

		/* While there is a parent ID, add the parent term link to the $parents array. */
		while ( $parent_id ) {

			/* Get the parent term. */
			$parent = get_term( $parent_id, $taxonomy );

			/* Add the formatted term link to the array of parent terms. */
			$parents[] = '<a href="' . get_term_link( $parent, $taxonomy ) . '" title="' . esc_attr( $parent->name ) . '">' . $parent->name . '</a>';

			/* Set the parent term's parent as the parent ID. */
			$parent_id = $parent->parent;
		}

		/* If we have parent terms, reverse the array to put them in the proper order for the trail. */
		if ( !empty( $parents ) )
			$trail = array_reverse( $parents );

		/* Return the trail of parent terms. */
		return $trail;

	} // End wpex_breadcrumbs_get_term_parents()

}