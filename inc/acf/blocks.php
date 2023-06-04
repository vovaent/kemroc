<?php
/**
 * Blocks registration
 * 
 * @package kemroc 
 */

/**
 * ACF init block types
 */
function kemroc_acf_init_block_types() { 
	// Home last news block.
	acf_register_block_type(
		array(
			'name'            => 'home-hero',
			'title'           => __( 'Home Hero', 'kemroc' ),
			'description'     => __( 'Home Hero', 'kemroc' ),
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
			'title'           => __( 'Our Products', 'kemroc' ),
			'description'     => __( 'Our Products', 'kemroc' ),
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
			'title'           => __( 'CTA v1', 'kemroc' ),
			'description'     => __( 'CTA', 'kemroc' ),
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
			'title'           => __( 'Our Areas', 'kemroc' ),
			'description'     => __( 'Our Areas', 'kemroc' ),
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
			'title'           => __( 'Our Company', 'kemroc' ),
			'description'     => __( 'Our Company', 'kemroc' ),
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
			'title'           => __( 'CTA v2', 'kemroc' ),
			'description'     => __( 'CTA', 'kemroc' ),
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
			'title'           => __( 'Our News', 'kemroc' ),
			'description'     => __( 'Our News', 'kemroc' ),
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
			'render_template' => 'template-parts/blocks/product/product-general-info/product-general-info.php',
			'category'        => 'product',
			'mode'            => 'edit',
			'icon'            => 'format-gallery',
			'keywords'        => array( 'Produkt' ),
			'post_types'      => array( 'page' ),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'gutenberg_preview_image' => get_template_directory_uri() . '/template-parts/blocks/product/product-general-info/product-general-info.png',
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
			'render_template' => 'template-parts/blocks/product/product-tech-info/product-tech-info.php',
			'category'        => 'product',
			'mode'            => 'edit',
			'icon'            => 'format-gallery',
			'keywords'        => array( 'Produkt' ),
			'post_types'      => array( 'page' ),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'gutenberg_preview_image' => get_template_directory_uri() . '/template-parts/blocks/product/product-tech-info/product-tech-info.png',
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
			'render_template' => 'template-parts/blocks/product/product-model-list/product-model-list.php',
			'category'        => 'product',
			'mode'            => 'edit',
			'icon'            => 'format-gallery',
			'keywords'        => array( 'Produkt' ),
			'post_types'      => array( 'page' ),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'gutenberg_preview_image' => get_template_directory_uri() . '/template-parts/blocks/product/product-model-list/product-model-list.png',
					),
				),
			),
		)
	);
	acf_register_block_type(
		array(
			'name'            => 'model-info',
			'title'           => __( 'Modellinformationen', 'kemroc' ),
			'description'     => __( 'Modellinformationen', 'kemroc' ),
			'render_template' => 'template-parts/blocks/model/model-info.php',
			'category'        => 'product',
			'mode'            => 'edit',
			'icon'            => 'format-gallery',
			'keywords'        => array( 'Modell' ),
			'post_types'      => array( 'page' ),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'gutenberg_preview_image' => get_template_directory_uri() . '/template-parts/blocks/model/model-info.png',
					),
				),
			),
		)
	);
}
add_action( 'acf/init', 'kemroc_acf_init_block_types' );
