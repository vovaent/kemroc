<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package kemroc
 */

add_action( 'after_setup_theme', 'custom_images_size' );
function custom_images_size() {
	add_image_size( 'home-product', 140, 140, true );
	add_image_size( 'home-areas', 540, 680, true );
	add_image_size( 'home-news', 370, 250, true );
	add_image_size( 'product-page', 370, 250, true );

}
 // SVG support
// Allow SVG
add_filter(
	'wp_check_filetype_and_ext',
	function( $data, $file, $filename, $mimes ) {

		global $wp_version;
		if ( $wp_version !== '4.7.1' ) {
			return $data;
		}
  
		$filetype = wp_check_filetype( $filename, $mimes );
  
		return array(
			'ext'             => $filetype['ext'],
			'type'            => $filetype['type'],
			'proper_filename' => $data['proper_filename'],
		);
  
	},
	10,
	4 
);
  
function cc_mime_types( $mimes ) {
	$mimes['svg']  = 'image/svg';
	$mimes['svgz'] = 'image/svg+xml';
	$mimes['dwg']  = 'image/vnd.dwg';
	$mimes['rvt']  = 'application/octet-stream';
	$mimes['3ds']  = 'image/x-3ds';
	return $mimes;
}
  add_filter( 'upload_mimes', 'cc_mime_types' );
  
function fix_svg() {
	echo '<style type="text/css">
          .attachment-266x266, .thumbnail img {
               width: 100% !important;
               height: auto !important;
          }
          </style>';
}
  add_action( 'admin_head', 'fix_svg' );

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function kemroc_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'kemroc_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function kemroc_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'kemroc_pingback_header' );

if ( ! function_exists( 'kemroc_register_nav_menu' ) ) {

	function kemroc_register_nav_menu() {
		register_nav_menus(
			array(
				'main_menu'   => __( 'Main Menu', 'kemroc' ),
				'footer_menu' => __( 'Footer Menu', 'kemroc' ),
			)
		);
	}
	add_action( 'after_setup_theme', 'kemroc_register_nav_menu', 0 );
}

add_filter(
	'wp_nav_menu_objects',
	function( $items, $args ) {
		
		// loop.
		foreach ( $items as &$item ) {
			if ( $item->menu_item_parent ) {
				// vars.
				$image         = get_field( 'image', $item );
				$item_thumb_id = get_post_thumbnail_id( $item->object_id );
				$item_thumb    = wp_get_attachment_image( $item_thumb_id );
		
				// append icon.
				if ( $image && $item_thumb_id ) {
			
					$item->title = $item_thumb . '<div class="item-title"><span>' . $item->title . '</span><svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.292893 0.292893C0.683417 -0.0976311 1.31658 -0.0976311 1.70711 0.292893L5.70711 4.29289C6.09763 4.68342 6.09763 5.31658 5.70711 5.70711L1.70711 9.70711C1.31658 10.0976 0.683417 10.0976 0.292893 9.70711C-0.0976311 9.31658 -0.0976311 8.68342 0.292893 8.29289L3.58579 5L0.292893 1.70711C-0.0976311 1.31658 -0.0976311 0.683417 0.292893 0.292893Z" fill="#444444"/>
                    </svg></div>';
			
				} else {
					$item->title = '<span>' . $item->title . '</span><svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M0.292893 0.292893C0.683417 -0.0976311 1.31658 -0.0976311 1.70711 0.292893L5.70711 4.29289C6.09763 4.68342 6.09763 5.31658 5.70711 5.70711L1.70711 9.70711C1.31658 10.0976 0.683417 10.0976 0.292893 9.70711C-0.0976311 9.31658 -0.0976311 8.68342 0.292893 8.29289L3.58579 5L0.292893 1.70711C-0.0976311 1.31658 -0.0976311 0.683417 0.292893 0.292893Z" fill="#444444"/>
                </svg>';
				}
			}       
		}
	
		return $items;
	
	},
	10,
	2
);

function kemroc_the_excerpt( $limit = 30, $post_id = false ) {
	echo kemroc_get_the_excerpt( $limit, $post_id ); //phpcs:ignore
}

function kemroc_get_the_excerpt( $limit = 30, $post_id = false ) {
	if ( $post_id ) {
		$excerpt = explode( ' ', get_the_excerpt( $post_id ), $limit );
	} else {
		$excerpt = explode( ' ', get_the_excerpt(), $limit );
	}


	if ( count( $excerpt ) >= $limit ) {
		array_pop( $excerpt );
		$excerpt = implode( ' ', $excerpt ) . '...';
	} else {
		$excerpt = implode( ' ', $excerpt );
	}

	$excerpt = preg_replace( '`\[[^\]]*\]`', '', $excerpt );

	return $excerpt;
}

function add_custom_block_categories( $block_categories, $editor_context ) {
	if ( ! empty( $editor_context->post ) ) {
		array_push(
			$block_categories,
			array(
				'slug'  => 'images-modules',
				'title' => __( 'Bild-Module', 'kemroc' ),
				'icon'  => null,
			),
			array(
				'slug'  => 'text-images-modules',
				'title' => __( 'Bild/Text module', 'kemroc' ),
				'icon'  => null,
			),
			array(
				'slug'  => 'text-modules',
				'title' => __( 'Text module', 'kemroc' ),
				'icon'  => null,
			),
			array(
				'slug'  => 'sonder',
				'title' => __( 'Sonder', 'kemroc' ),
				'icon'  => null,
			),
			array(
				'slug'  => 'products',
				'title' => esc_html__( 'Produkte', 'kemroc' ),
				'icon'  => null,
			),
			array(
				'slug'  => 'application-areas',
				'title' => esc_html__( 'Einsatzbereiche', 'kemroc' ),
				'icon'  => null,            
			),
			array(
				'slug'  => 'constacts',
				'title' => esc_html__( 'Kontakte', 'kemroc' ),
				'icon'  => null,
			),
			array(
				'slug'  => 'aktuelles',
				'title' => esc_html__( 'Aktuelles', 'kemroc' ),
				'icon'  => null,
			)
		);
	}
	return $block_categories;
}
add_filter( 'block_categories_all', 'add_custom_block_categories', 10, 2 );

function allowed_block_types( $allowed_blocks, $editor_context ) {
	if ( ! is_object( $editor_context ) || ! is_object( $editor_context->post ) ) {
		return;
	}

	$general_blocks = array(
		'core/paragraph',
		'core/image',
		'core/gallery',
		'core/heading',
		'core/list',
		'core/list-item',
		'core/spacer',
		'core/buttons',
		'core/separator',
		'core/file',
		'core/html',
		'acf/lazy-video',
	);

	if ( (int) get_option( 'page_on_front' ) === $editor_context->post->ID ) {
		$allowed_blocks = array_merge(
			$general_blocks,
			array(
				'acf/hero',
				'acf/cta-wide',
				'acf/our-company',
				'acf/cta-bg',
				'acf/section-header',
				'acf/products',
				'acf/application-areas-list',
				'acf/front-page-news',
			)
		);
	} elseif ( 'page' === $editor_context->post->post_type ) {
		$allowed_blocks = array_merge(
			$general_blocks,
			array(
				'acf/hero',
				'acf/product-general-info',
				'acf/product-tech-info',
				'acf/product-model-list',
				'acf/products',
				'acf/model-info',
				'acf/serial-product-general-info',
				'acf/serial-product-descriptions',
				'acf/serial-product-compare',
				'acf/series-general-info',
				'acf/series-tech-info',
				'acf/application-areas-list',
				'acf/application-areas-description',
				'acf/chess-content',
				'acf/full-width-image-rounded',
				'acf/our-team',
				'acf/application-areas-filter',
				'acf/contacts-info',
				'acf/contacts-form',
				'acf/contacts-links',
				'acf/all-news',
				'acf/section-header',
				'acf/events',
				'acf/stellenangebote-list',
				'acf/stellenangebot-info',
				'acf/absatztext',
				'acf/cookies-table',
				'acf/impressum',
				'acf/columns-text',
				'acf/pdf-kataloge',
				'acf/page-404',
				'acf/farbiger-text',
				'acf/partners',
			)
		);
	} elseif ( 'post' === $editor_context->post->post_type ) {
		$allowed_blocks = array_merge(
			$general_blocks, 
			array(
				'acf/faq',
			)
		);
	}

	return $allowed_blocks;
}
add_filter( 'allowed_block_types_all', 'allowed_block_types', 25, 2 );

function kemroc_navigation_template_class_change( $template ) {
	$template = '
    <nav class="navigation %1$s" aria-label="%4$s">
		<h2 class="screen-reader-text">%2$s</h2>
		<div class="kemroc-navigation__nav-links">%3$s</div>
	</nav>
    ';
	return $template;
}

add_filter( 'navigation_markup_template', 'kemroc_navigation_template_class_change', 10, 1 );

function kemroc_home_url( $lang = '' ) {
	$home_url = home_url();

	if ( function_exists( 'pll_home_url' ) ) {
		$home_url = pll_home_url( $lang );
	}
	return $home_url;
}

function kemroc_change_search_posts_count( $query ) {
	if ( is_admin() ) {
		return;
	}
	if ( ! $query->is_main_query() ) {
		return;
	}
	if ( ! is_search() ) {
		return;
	}

	$query->set( 'posts_per_page', 6 );
	$query->set( 'post_type', array( 'post', 'page' ) );
}
add_action( 'pre_get_posts', 'kemroc_change_search_posts_count' );
