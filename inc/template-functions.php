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
		
			// vars.
			$image = get_field( 'image', $item );
		
		
			// append icon.
			if ( $image ) {
			
				$item->title = '<img src="' . $image['sizes']['home-product'] . '" /><div class="item-title"><span>' . $item->title . '</span><svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M0.292893 0.292893C0.683417 -0.0976311 1.31658 -0.0976311 1.70711 0.292893L5.70711 4.29289C6.09763 4.68342 6.09763 5.31658 5.70711 5.70711L1.70711 9.70711C1.31658 10.0976 0.683417 10.0976 0.292893 9.70711C-0.0976311 9.31658 -0.0976311 8.68342 0.292893 8.29289L3.58579 5L0.292893 1.70711C-0.0976311 1.31658 -0.0976311 0.683417 0.292893 0.292893Z" fill="#444444"/>
            </svg>
            </div>';
			
			}   
		}
	
		return $items;
	
	},
	10,
	2
);

function excerpt( $limit, $post_id = false ) {
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

function custom_post_type() {
  
	// Set UI labels for Custom Post Type
		$labels = array(
			'name'                => _x( 'Products', 'Post Type General Name', 'kemroc' ),
			'singular_name'       => _x( 'Product', 'Post Type Singular Name', 'kemroc' ),
			'menu_name'           => __( 'Products', 'kemroc' ),
			'parent_item_colon'   => __( 'Parent Product', 'kemroc' ),
			'all_items'           => __( 'All Products', 'kemroc' ),
			'view_item'           => __( 'View Product', 'kemroc' ),
			'add_new_item'        => __( 'Add New Product', 'kemroc' ),
			'add_new'             => __( 'Add New', 'kemroc' ),
			'edit_item'           => __( 'Edit Product', 'kemroc' ),
			'update_item'         => __( 'Update Product', 'kemroc' ),
			'search_items'        => __( 'Search Products', 'kemroc' ),
			'not_found'           => __( 'Not Found', 'kemroc' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'kemroc' ),
		);
		  
		// Set other options for Custom Post Type.
		  
		$args = array(
			'label'               => __( 'products', 'kemroc' ),
			'description'         => __( 'Products', 'kemroc' ),
			'labels'              => $labels,
			// Features this CPT supports in Post Editor.
			'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', 'taxonomies' ),
			// You can associate this CPT with a taxonomy or custom taxonomy. 
			
			/*
			 A hierarchical CPT is like Pages and can have
			* Parent and child items. A non-hierarchical CPT
			* is like Posts.
			*/
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			'show_in_rest'        => true,
	  
		);
		  
		// Registering your Custom Post Type
		register_post_type( 'produkt', $args );
}
add_action( 'init', 'custom_post_type', 0 );

/**
 * Create two taxonomies, genres and writers for the post type "book".
 *
 * @see register_post_type() for registering custom post types.
 */
function kemroc_create_book_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories).
	$labels = array(
		'name'              => _x( 'Tags', 'taxonomy general name', 'kemroc' ),
		'singular_name'     => _x( 'Tag', 'taxonomy singular name', 'kemroc' ),
		'search_items'      => __( 'Search Tags', 'kemroc' ),
		'all_items'         => __( 'All Tags', 'kemroc' ),
		'parent_item'       => __( 'Parent Tag', 'kemroc' ),
		'parent_item_colon' => __( 'Parent Tag:', 'kemroc' ),
		'edit_item'         => __( 'Edit Tag', 'kemroc' ),
		'update_item'       => __( 'Update Tag', 'kemroc' ),
		'add_new_item'      => __( 'Add New Tag', 'kemroc' ),
		'new_item_name'     => __( 'New Tag Name', 'kemroc' ),
		'menu_name'         => __( 'Tag', 'kemroc' ),
	);

	$args = array(
		'hierarchical'      => false,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'produkt-tag' ),
	);

	register_taxonomy( 'product_tag', array( 'produkt' ), $args );
}
add_action( 'init', 'kemroc_create_book_taxonomies', 0 );

function custom_post_type_areas() {
  
	// Set UI labels for Custom Post Type
		$labels = array(
			'name'                => _x( 'Our Areas', 'Post Type General Name', 'kemroc' ),
			'singular_name'       => _x( 'Area', 'Post Type Singular Name', 'kemroc' ),
			'menu_name'           => __( 'Our Areas', 'kemroc' ),
			'parent_item_colon'   => __( 'Parent Area', 'kemroc' ),
			'all_items'           => __( 'All Areas', 'kemroc' ),
			'view_item'           => __( 'View Area', 'kemroc' ),
			'add_new_item'        => __( 'Add New Area', 'kemroc' ),
			'add_new'             => __( 'Add New', 'kemroc' ),
			'edit_item'           => __( 'Edit Area', 'kemroc' ),
			'update_item'         => __( 'Update Area', 'kemroc' ),
			'search_items'        => __( 'Search Area', 'kemroc' ),
			'not_found'           => __( 'Not Found', 'kemroc' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'kemroc' ),
		);
		  
		// Set other options for Custom Post Type
		  
		$args = array(
			'label'               => __( 'areas', 'kemroc' ),
			'description'         => __( 'Areas', 'kemroc' ),
			'labels'              => $labels,
			// Features this CPT supports in Post Editor
			'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields' ),
			// You can associate this CPT with a taxonomy or custom taxonomy. 
			
			/*
			 A hierarchical CPT is like Pages and can have
			* Parent and child items. A non-hierarchical CPT
			* is like Posts.
			*/
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			'show_in_rest'        => true,
	  
		);
		  
		// Registering your Custom Post Type
		register_post_type( 'areas', $args );
	  
}
	  
	/*
	 Hook into the 'init' action so that the function
	* Containing our post type registration is not 
	* unnecessarily executed. 
	*/
	  
	add_action( 'init', 'custom_post_type_areas', 0 );

function acf_option_init() {
	if ( function_exists( 'acf_add_options_sub_page' ) ) {

		$parent = acf_add_options_page(
			array(
				'page_title' => __( 'Themen Einstellungen' ),
				'menu_title' => __( 'Themen Einstellungen' ),
				'menu_slug'  => 'theme-general-settings',
				'capability' => 'edit_posts',
				'redirect'   => false,
			)
		);
	}
}
add_action( 'acf/init', 'acf_option_init' );

function add_custom_block_categories( $block_categories, $editor_context ) {
	if ( ! empty( $editor_context->post ) ) {
		array_push(
			$block_categories,
			array(
				'slug'  => 'images-modules',
				'title' => __( 'Bild-Module', 'images-plugins' ),
				'icon'  => null,
			),
			array(
				'slug'  => 'text-images-modules',
				'title' => __( 'Bild/Text module', 'text-plugins' ),
				'icon'  => null,
			),
			array(
				'slug'  => 'text-modules',
				'title' => __( 'Text module', 'text-plugins' ),
				'icon'  => null,
			),
			array(
				'slug'  => 'sonder-modules',
				'title' => __( 'Sonder module', 'text-plugins' ),
				'icon'  => null,
			),
			array(
				'slug'  => 'product',
				'title' => esc_html__( 'Produkt', 'kemroc' ),
				'icon'  => null,
			)
		);
	}
	return $block_categories;
}
add_filter( 'block_categories_all', 'add_custom_block_categories', 10, 2 );

function acf_init_block_types() { 
	// Home last news block
	acf_register_block_type(
		array(
			'name'            => 'home-hero',
			'title'           => __( 'Home Hero' ),
			'description'     => __( 'Home Hero' ),
			'render_template' => 'template-parts/blocks/sonder/home-hero.php',
			'category'        => 'sonder',
			'mode'            => 'edit',
			'icon'            => 'format-gallery',
			'keywords'        => array( 'hero' ),
			'post_types'      => array( 'page' ),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'gutenberg_preview_image' => get_template_directory_uri() . '/template-parts/blocks/sonder/home-hero.png',
					),
				),
			),
		)
	);
	acf_register_block_type(
		array(
			'name'            => 'our-products',
			'title'           => __( 'Our Products' ),
			'description'     => __( 'Our Products' ),
			'render_template' => 'template-parts/blocks/sonder/our-products.php',
			'category'        => 'sonder',
			'mode'            => 'edit',
			'icon'            => 'format-gallery',
			'keywords'        => array( 'products' ),
			'post_types'      => array( 'page' ),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'gutenberg_preview_image' => get_template_directory_uri() . '/template-parts/blocks/sonder/our-products.png',
					),
				),
			),
		)
	);
	acf_register_block_type(
		array(
			'name'            => 'cta-wide',
			'title'           => __( 'CTA v1' ),
			'description'     => __( 'CTA' ),
			'render_template' => 'template-parts/blocks/sonder/cta-wide.php',
			'category'        => 'sonder',
			'mode'            => 'edit',
			'icon'            => 'format-gallery',
			'keywords'        => array( 'cta' ),
			'post_types'      => array( 'page' ),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'gutenberg_preview_image' => get_template_directory_uri() . '/template-parts/blocks/sonder/cta-wide.png',
					),
				),
			),
		)
	);
	acf_register_block_type(
		array(
			'name'            => 'our-areas',
			'title'           => __( 'Our Areas' ),
			'description'     => __( 'Our Areas' ),
			'render_template' => 'template-parts/blocks/sonder/our-areas.php',
			'category'        => 'sonder',
			'mode'            => 'edit',
			'icon'            => 'format-gallery',
			'keywords'        => array( 'areas' ),
			'post_types'      => array( 'page' ),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'gutenberg_preview_image' => get_template_directory_uri() . '/template-parts/blocks/sonder/our-areas.png',
					),
				),
			),
		)
	);
	acf_register_block_type(
		array(
			'name'            => 'our-company',
			'title'           => __( 'Our Company' ),
			'description'     => __( 'Our Company' ),
			'render_template' => 'template-parts/blocks/sonder/our-company.php',
			'category'        => 'sonder',
			'mode'            => 'edit',
			'icon'            => 'format-gallery',
			'keywords'        => array( 'company' ),
			'post_types'      => array( 'page' ),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'gutenberg_preview_image' => get_template_directory_uri() . '/template-parts/blocks/sonder/our-company.png',
					),
				),
			),
		)
	);
	acf_register_block_type(
		array(
			'name'            => 'cta-bg',
			'title'           => __( 'CTA v2' ),
			'description'     => __( 'CTA' ),
			'render_template' => 'template-parts/blocks/sonder/cta-bg.php',
			'category'        => 'sonder',
			'mode'            => 'edit',
			'icon'            => 'format-gallery',
			'keywords'        => array( 'CTA' ),
			'post_types'      => array( 'page' ),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'gutenberg_preview_image' => get_template_directory_uri() . '/template-parts/blocks/sonder/cta-bg.png',
					),
				),
			),
		)
	);
	acf_register_block_type(
		array(
			'name'            => 'our-news',
			'title'           => __( 'Our News' ),
			'description'     => __( 'Our News' ),
			'render_template' => 'template-parts/blocks/sonder/our-news.php',
			'category'        => 'sonder',
			'mode'            => 'edit',
			'icon'            => 'format-gallery',
			'keywords'        => array( 'News' ),
			'post_types'      => array( 'page' ),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'gutenberg_preview_image' => get_template_directory_uri() . '/template-parts/blocks/sonder/our-news.png',
					),
				),
			),
		)
	);
	acf_register_block_type(
		array(
			'name'            => 'product-general-info',
			'title'           => __( 'Allgemeine Produktinformationen', 'kemroc' ),
			'description'     => __( 'Allgemeine Produktinformationen', 'kemroc' ),
			'render_template' => 'template-parts/blocks/product/general-info/general-info.php',
			'category'        => 'product',
			'mode'            => 'edit',
			'icon'            => 'format-gallery',
			'keywords'        => array( 'Product' ),
			'post_types'      => array( 'page' ),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'gutenberg_preview_image' => get_template_directory_uri() . '/template-parts/blocks/product/general-info/general-info.png',
					),
				),
			),
		)
	);
	acf_register_block_type(
		array(
			'name'            => 'product-tech-info',
			'title'           => __( 'Technische Produktinformationen', 'kemroc' ),
			'description'     => __( 'Technische Produktinformationen', 'kemroc' ),
			'render_template' => 'template-parts/blocks/product/tech-info/tech-info.php',
			'category'        => 'product',
			'mode'            => 'edit',
			'icon'            => 'format-gallery',
			'keywords'        => array( 'Product' ),
			'post_types'      => array( 'page' ),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'gutenberg_preview_image' => get_template_directory_uri() . '/template-parts/blocks/product/tech-info/tech-info.png',
					),
				),
			),
		)
	);
	acf_register_block_type(
		array(
			'name'            => 'product-model-list',
			'title'           => __( 'Produkt Modellliste', 'kemroc' ),
			'description'     => __( 'Produkt Modellliste', 'kemroc' ),
			'render_template' => 'template-parts/blocks/product/model-list/model-list.php',
			'category'        => 'product',
			'mode'            => 'edit',
			'icon'            => 'format-gallery',
			'keywords'        => array( 'Product' ),
			'post_types'      => array( 'page' ),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'gutenberg_preview_image' => get_template_directory_uri() . '/template-parts/blocks/product/model-list/model-list.png',
					),
				),
			),
		)
	);
}
add_action( 'acf/init', 'acf_init_block_types' );

add_filter( 'allowed_block_types_all', 'allowed_block_types', 25, 2 );
function allowed_block_types( $allowed_blocks, $editor_context ) {
	if ( 'post' === $editor_context->post->post_type ) {
		return array(
			'core/paragraph',
			'core/image',
			'core/gallery',
			'core/heading',
			'core/list',
			'core/list-item',
			'core/video',
			'core/embed',
			'core/spacer',
			'core/buttons',
			'core/separator',
			'acf/article-button-simple',
		);
	}

	if ( get_option( 'page_on_front' ) == $editor_context->post->ID ) {

		return array(
			'core/columns',
			'acf/home-topnews',
		);
	}
}
