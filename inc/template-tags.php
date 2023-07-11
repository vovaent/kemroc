<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package kemroc
 */

if ( ! function_exists( 'kemroc_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function kemroc_posted_on( $compact = false, $classes = array(
		'main' => '',
		'add'  => '',
	) ) {
		
		$entry_date_add_class = 'entry-date published updated';

		if ( ! empty( $classes['main'] ) ) {
			$entry_date_add_class .= ' ' . $classes['main'] . '__meta-date';
		}

		if ( ! empty( $classes['add'] ) ) {
			$entry_date_add_class .= ' ' . $classes['add'];
		}

		$time_string = '<time class="' . $entry_date_add_class . '" datetime="%1$s">%2$s</time>';
		if ( ! $compact ) {
			if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
				$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
			}
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		if ( $compact ) {
			$posted_on = $time_string;
			echo $posted_on; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped    
		} else {
			$posted_on = sprintf(
				/* translators: %s: post date. */
				esc_html_x( 'Posted on %s', 'post date', 'kemroc' ),
				'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
			);
			echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped    
		}   
	}
endif;

if ( ! function_exists( 'kemroc_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function kemroc_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'kemroc' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;

if ( ! function_exists( 'kemroc_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function kemroc_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'kemroc' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', 'kemroc' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'kemroc' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'kemroc' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'kemroc' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'kemroc' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'kemroc_the_post_thumbnail' ) ) :
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function kemroc_get_the_post_thumbnail( $size = 'post-thumbnail', $wrapper_classes = '', $attr = array(), $no_image = false ) {
		if ( post_password_required() || is_attachment() || ( ! has_post_thumbnail() && ! $no_image ) ) {
			return;
		}

		$post_id       = get_the_ID();
		$post_no_image = '<img src="' . get_template_directory_uri() . '/images/no-image.jpg" alt="" class="search-card__image">';
		$post_thumb    = '';

		if ( is_singular() && ! is_front_page() ) :
			$post_thumb = get_the_post_thumbnail( $post_id, $size, $attr );

			if ( '' === $post_thumb ) {
				$post_thumb = $post_no_image;
			} 

			$html = '<div class="post-thumbnail ' . esc_attr( $wrapper_classes ) . '">' .
						$post_thumb .
					'</div><!-- .post-thumbnail -->';

		else :
			$post_thumb = get_the_post_thumbnail(
				$post_id,
				'post-thumbnail',
				array_merge(
					array(
						'alt' => the_title_attribute(
							array(
								'echo' => false,
							)
						),
					),
					$attr
				)
			);

			if ( '' === $post_thumb ) {
				$post_thumb = $post_no_image;
			} 

			$html = '<a class="post-thumbnail ' . esc_attr( $wrapper_classes ) . '" href="' . get_the_permalink() . '" aria-hidden="true" tabindex="-1">' .
						$post_thumb . '
                    </a>';
		endif; // End is_singular().
		
		return $html;
	}
endif;

if ( ! function_exists( 'kemroc_the_post_thumbnail' ) ) :
	function kemroc_the_post_thumbnail( $size = 'post-thumbnail', $wrapper_classes = '', $attr = array(), $no_image = false ) {
		echo wp_kses_post( kemroc_get_the_post_thumbnail( $size, $wrapper_classes, $attr, $no_image ) );
	}
endif;


if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Shim for sites older than 5.2.
	 *
	 * @link https://core.trac.wordpress.org/ticket/12563
	 */
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;

if ( ! function_exists( 'kemroc_get_template_part_content' ) ) :
	function kemroc_get_template_part_content( $slug, $name = null, $args = array() ) {
		if ( empty( $slug ) ) {
			return;
		}

		$part_content = '';

		ob_start();

		get_template_part( $slug, $name, $args );
		$part_content = ob_get_contents();
	
		ob_end_clean();

		return $part_content;
	}
endif;

if ( ! function_exists( 'kemroc_the_template_part_content' ) ) :
	function kemroc_the_template_part_content( $slug, $name = null, $args = array() ) {
		echo kemroc_get_template_part_content( $slug, $name = null, $args = array() );//phpcs:ignore
	}
endif;

if ( ! function_exists( 'kemroc_paginate_links' ) ) :
	function kemroc_paginate_links( $args = '', $wp_query = null, $current_page = null ) {
		if ( ! $wp_query ) {
			global $wp_query;
		}

		global $wp_rewrite;

		// Setting up default values based on the current URL.
		$pagenum_link = html_entity_decode( get_pagenum_link() );
		$url_parts    = explode( '?', $pagenum_link );

		// Get max pages and current page out of the current query, if available.
		$total = isset( $wp_query->max_num_pages ) ? $wp_query->max_num_pages : 1;

		if ( ! $current_page ) {
			$current = get_query_var( 'paged' ) ? (int) get_query_var( 'paged' ) : 1;
		} else {
			$current = $current_page;
		}

		// Append the format placeholder to the base URL.
		$pagenum_link = trailingslashit( $url_parts[0] ) . '%_%';

		// URL base depends on permalink settings.
		$format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
		$format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';

		$defaults = array(
			'base'               => $pagenum_link, // http://example.com/all_posts.php%_% : %_% is replaced by format (below).
			'format'             => $format, // ?page=%#% : %#% is replaced by the page number.
			'total'              => $total,
			'current'            => $current,
			'aria_current'       => 'page',
			'show_all'           => false,
			'prev_next'          => true,
			'prev_text'          => __( '&laquo; Vorherige', 'kemroc' ),
			'next_text'          => __( 'Weiter &raquo;', 'kemroc' ),
			'end_size'           => 1,
			'mid_size'           => 2,
			'type'               => 'plain',
			'add_args'           => array(), // Array of query args to add.
			'add_fragment'       => '',
			'before_page_number' => '',
			'after_page_number'  => '',
		);

		$args = wp_parse_args( $args, $defaults );

		if ( ! is_array( $args['add_args'] ) ) {
			$args['add_args'] = array();
		}

		// Merge additional query vars found in the original URL into 'add_args' array.
		if ( isset( $url_parts[1] ) ) {
			// Find the format argument.
			$format       = explode( '?', str_replace( '%_%', $args['format'], $args['base'] ) );
			$format_query = isset( $format[1] ) ? $format[1] : '';
			wp_parse_str( $format_query, $format_args );

			// Find the query args of the requested URL.
			wp_parse_str( $url_parts[1], $url_query_args );

			// Remove the format argument from the array of query arguments, to avoid overwriting custom format.
			foreach ( $format_args as $format_arg => $format_arg_value ) {
				unset( $url_query_args[ $format_arg ] );
			}

			$args['add_args'] = array_merge( $args['add_args'], urlencode_deep( $url_query_args ) );
		}

		// Who knows what else people pass in $args.
		$total = (int) $args['total'];
		if ( $total < 2 ) {
			return;
		}
		$current  = (int) $args['current'];
		$end_size = (int) $args['end_size']; // Out of bounds? Make it the default.
		if ( $end_size < 1 ) {
			$end_size = 1;
		}
		$mid_size = (int) $args['mid_size'];
		if ( $mid_size < 0 ) {
			$mid_size = 2;
		}

		$add_args   = $args['add_args'];
		$r          = '';
		$page_links = array();
		$dots       = false;

		if ( $args['prev_next'] && $current && 1 < $current ) :
			$link = str_replace( '%_%', 2 == $current ? '' : $args['format'], $args['base'] );
			$link = str_replace( '%#%', $current - 1, $link );
			if ( $add_args ) {
				$link = add_query_arg( $add_args, $link );
			}
			$link .= $args['add_fragment'];

			$prev_text_class = $args['class'] . '__page-numbers ' . $args['class'] . '__page-numbers--prev';

			$page_links[] = sprintf(
				'<a class="' . $prev_text_class . '" href="%s" data-page-number="' . ( $current - 1 ) . '">%s</a>',
				/**
				* Filters the paginated links for the given archive pages.
				*
				* @since 3.0.0
				*
				* @param string $link The paginated link URL.
				*/
				esc_url( apply_filters( 'kemroc_paginate_links', $link ) ),
				$args['prev_text']
			);
	endif;

		$current_page_text_class = $args['class'] . '__page-numbers ' . $args['class'] . '__page-numbers--current';
		$dots_class              = $args['class'] . '__page-numbers ' . $args['class'] . '__page-numbers--dots';
		$page_text_class         = $args['class'] . '__page-numbers';

		for ( $n = 1; $n <= $total; $n++ ) :
			if ( $n == $current ) :
				$page_links[] = sprintf(
					'<span aria-current="%s" class="' . $current_page_text_class . '">%s</span>',
					esc_attr( $args['aria_current'] ),
					$args['before_page_number'] . number_format_i18n( $n ) . $args['after_page_number']
				);

				$dots = true;
			else :
				if ( $args['show_all'] || ( $n <= $end_size || ( $current && $n >= $current - $mid_size && $n <= $current + $mid_size ) || $n > $total - $end_size ) ) :
					$link = str_replace( '%_%', 1 == $n ? '' : $args['format'], $args['base'] );
					$link = str_replace( '%#%', $n, $link );
					if ( $add_args ) {
						$link = add_query_arg( $add_args, $link );
					}
					$link .= $args['add_fragment'];

					$page_links[] = sprintf(
						'<a class="' . $page_text_class . '" href="%s" data-page-number="' . ( $n ) . '">%s</a>',
						/** This filter is documented in wp-includes/general-template.php */
						esc_url( apply_filters( 'kemroc_paginate_links', $link ) ),
						$args['before_page_number'] . number_format_i18n( $n ) . $args['after_page_number']
					);

					$dots = true;
				elseif ( $dots && ! $args['show_all'] ) :
					$page_links[] = '<span class="' . $dots_class . '">' . __( '&hellip;', 'kemroc' ) . '</span>';

					$dots = false;
				endif;
			endif;
	endfor;

		if ( $args['prev_next'] && $current && $current < $total ) :
			$link = str_replace( '%_%', $args['format'], $args['base'] );
			$link = str_replace( '%#%', $current + 1, $link );
			if ( $add_args ) {
				$link = add_query_arg( $add_args, $link );
			}
			$link .= $args['add_fragment'];

			$next_text_class = $args['class'] . '__page-numbers ' . $args['class'] . '__page-numbers--next';

			$page_links[] = sprintf(
				'<a class="' . $next_text_class . '" href="%s" data-page-number="' . ( $current + 1 ) . '">%s</a>',
				/** This filter is documented in wp-includes/general-template.php */
				esc_url( apply_filters( 'kemroc_paginate_links', $link ) ),
				$args['next_text']
			);
	endif;

		switch ( $args['type'] ) {
			case 'array':
				return $page_links;

			case 'list':
				$r .= "<ul class='$page_text_class'>\n\t<li>";
				$r .= implode( "</li>\n\t<li>", $page_links );
				$r .= "</li>\n</ul>\n";
				break;

			default:
				$r = implode( "\n", $page_links );
				break;
		}

		/**
		 * Filters the HTML output of paginated links for archives.
		 *
		 * @since 5.7.0
		 *
		 * @param string $r    HTML output.
		 * @param array  $args An array of arguments. See paginate_links()
		 *                     for information on accepted arguments.
		 */
		$r = apply_filters( 'kemroc_paginate_links_output', $r, $args );

		return $r;
	}
endif;

if ( ! function_exists( 'kemroc_get_the_posts_pagination' ) ) :
	function kemroc_get_the_posts_pagination( $args = array(), $wp_query = null, $current_page = null ) {
		if ( ! $wp_query ) {
			global $wp_query;
		}
		$navigation = '';

		// Don't print empty markup if there's only one page.
		if ( $wp_query->max_num_pages > 1 ) {
			// Make sure the nav element has an aria-label attribute: fallback to the screen reader text.
			if ( ! empty( $args['screen_reader_text'] ) && empty( $args['aria_label'] ) ) {
				$args['aria_label'] = $args['screen_reader_text'];
			}

			$args = wp_parse_args(
				$args,
				array(
					'mid_size'           => 1,
					'prev_text'          => _x( 'Vorherige', 'previous set of posts', 'kemroc' ),
					'next_text'          => _x( 'Weiter', 'next set of posts', 'kemroc' ),
					'screen_reader_text' => __( 'Beiträge Navigation', 'kemroc' ),
					'aria_label'         => __( 'Beiträge', 'kemroc' ),
					'class'              => 'pagination',
				)
			);

			/**
			 * Filters the arguments for posts pagination links.
			 *
			 * @since 6.1.0
			 *
			 * @param array $args {
			 *     Optional. Default pagination arguments, see paginate_links().
			 *
			 *     @type string $screen_reader_text Screen reader text for navigation element.
			 *                                      Default 'Posts navigation'.
			 *     @type string $aria_label         ARIA label text for the nav element. Default 'Posts'.
			 *     @type string $class              Custom class for the nav element. Default 'pagination'.
			 * }
			 */
			$args = apply_filters( 'kemroc_the_posts_pagination_args', $args );

			// Make sure we get a string back. Plain is the next best thing.
			if ( isset( $args['type'] ) && 'array' === $args['type'] ) {
				$args['type'] = 'plain';
			}

			// Set up paginated links.
			$links = kemroc_paginate_links( $args, $wp_query, $current_page );

			if ( $links ) {
				$navigation = _navigation_markup( $links, $args['class'], $args['screen_reader_text'], $args['aria_label'] );
			}
		}

		return $navigation;
	}
endif;

if ( ! function_exists( 'kemroc_the_posts_pagination' ) ) :
	function kemroc_the_posts_pagination( $args = array(), $wp_query = null, $current_page = null ) {
		echo wp_kses_post( kemroc_get_the_posts_pagination( $args, $wp_query, $current_page ) );
	}
endif;
