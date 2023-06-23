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
			'name'            => 'hero',
			'title'           => __( 'Held', 'kemroc' ),
			'description'     => __( 'Held', 'kemroc' ),
			'render_template' => 'template-parts/blocks/sonder/hero/hero.php',
			'category'        => 'text-images-modules',
			'mode'            => 'edit',
			'icon'            => 'format-gallery',
			'keywords'        => array( 'hero' ),
			'post_types'      => array( 'page' ),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'gutenberg_preview_image' => get_template_directory_uri() . '/template-parts/blocks/sonder/hero/hero.png',
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
	acf_register_block_type(
		array(
			'name'            => 'serial-product-general-info',
			'title'           => __( 'Serienprodukt Allgemeine Informationen', 'kemroc' ),
			'description'     => __( 'Serienprodukt Allgemeine Informationen', 'kemroc' ),
			'render_template' => 'template-parts/blocks/serial-product/serial-product-general-info/serial-product-general-info.php',
			'category'        => 'product',
			'mode'            => 'edit',
			'icon'            => 'format-gallery',
			'keywords'        => array( 'Serienprodukt' ),
			'post_types'      => array( 'page' ),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'gutenberg_preview_image' => get_template_directory_uri() . '/template-parts/blocks/serial-product/serial-product-general-info/serial-product-general-info.png',
					),
				),
			),
		)
	);
	acf_register_block_type(
		array(
			'name'            => 'serial-product-descriptions',
			'title'           => __( 'Serielle Produktbeschreibungen', 'kemroc' ),
			'description'     => __( 'Serielle Produktbeschreibungen', 'kemroc' ),
			'render_template' => 'template-parts/blocks/serial-product/serial-product-descriptions/serial-product-descriptions.php',
			'category'        => 'product',
			'mode'            => 'edit',
			'icon'            => 'format-gallery',
			'keywords'        => array( 'Serienprodukt' ),
			'post_types'      => array( 'page' ),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'gutenberg_preview_image' => get_template_directory_uri() . '/template-parts/blocks/serial-product/serial-product-descriptions/serial-product-descriptions.png',
					),
				),
			),
		)
	);
	acf_register_block_type(
		array(
			'name'            => 'serial-product-compare',
			'title'           => __( 'Serienproduktvergleich', 'kemroc' ),
			'description'     => __( 'Serienproduktvergleich', 'kemroc' ),
			'render_template' => 'template-parts/blocks/serial-product/serial-product-compare/serial-product-compare.php',
			'category'        => 'product',
			'mode'            => 'edit',
			'icon'            => 'format-gallery',
			'keywords'        => array( 'Serienprodukt' ),
			'post_types'      => array( 'page' ),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'gutenberg_preview_image' => get_template_directory_uri() . '/template-parts/blocks/serial-product/serial-product-compare/serial-product-compare.png',
					),
				),
			),
		)
	);
	acf_register_block_type(
		array(
			'name'            => 'series-general-info',
			'title'           => __( 'Allgemeine Informationen zur Serie', 'kemroc' ),
			'description'     => __( 'Allgemeine Informationen zur Serie', 'kemroc' ),
			'render_template' => 'template-parts/blocks/serial-product/series-general-info/series-general-info.php',
			'category'        => 'product',
			'mode'            => 'edit',
			'icon'            => 'format-gallery',
			'keywords'        => array( 'Serienprodukt' ),
			'post_types'      => array( 'page' ),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'gutenberg_preview_image' => get_template_directory_uri() . '/template-parts/blocks/serial-product/series-general-info/series-general-info.png',
					),
				),
			),
		)
	);
	acf_register_block_type(
		array(
			'name'            => 'series-tech-info',
			'title'           => __( 'Technische Informationen zur Serie', 'kemroc' ),
			'description'     => __( 'Technische Informationen zur Serie', 'kemroc' ),
			'render_template' => 'template-parts/blocks/serial-product/series-tech-info/series-tech-info.php',
			'category'        => 'product',
			'mode'            => 'edit',
			'icon'            => 'format-gallery',
			'keywords'        => array( 'Serienprodukt' ),
			'post_types'      => array( 'page' ),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'gutenberg_preview_image' => get_template_directory_uri() . '/template-parts/blocks/serial-product/series-tech-info/series-tech-info.png',
					),
				),
			),
		)
	);
	acf_register_block_type(
		array(
			'name'            => 'application-areas-list',
			'title'           => __( 'Liste der Einsatzbereiche', 'kemroc' ),
			'description'     => __( 'Liste der Einsatzbereiche', 'kemroc' ),
			'render_template' => 'template-parts/blocks/application-areas/application-areas-list/application-areas-list.php',
			'category'        => 'application-areas',
			'mode'            => 'edit',
			'icon'            => 'format-gallery',
			'keywords'        => array( 'Einsatzbereiche' ),
			'post_types'      => array( 'page' ),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'gutenberg_preview_image' => get_template_directory_uri() . '/template-parts/blocks/application-areas/application-areas-list/application-areas-list.png',
					),
				),
			),
		)
	);
	acf_register_block_type(
		array(
			'name'            => 'application-areas-description',
			'title'           => __( 'Einsatzbereiche Beschreibung', 'kemroc' ),
			'description'     => __( 'Einsatzbereiche Beschreibung', 'kemroc' ),
			'render_template' => 'template-parts/blocks/application-areas/application-areas-description/application-areas-description.php',
			'category'        => 'application-areas',
			'mode'            => 'edit',
			'icon'            => 'format-gallery',
			'keywords'        => array( 'Einsatzbereiche' ),
			'post_types'      => array( 'page' ),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'gutenberg_preview_image' => get_template_directory_uri() . '/template-parts/blocks/application-areas/application-areas-description/application-areas-description.png',
					),
				),
			),
		)
	);
	acf_register_block_type(
		array(
			'name'            => 'chess-content',
			'title'           => __( 'Schachinhalt', 'kemroc' ),
			'description'     => __( 'Schachinhalt', 'kemroc' ),
			'render_template' => 'template-parts/blocks/sonder/chess-content/chess-content.php',
			'category'        => 'text-images-modules',
			'mode'            => 'edit',
			'icon'            => 'format-gallery',
			'keywords'        => array( 'Schachinhalt', 'Text und Bild' ),
			'post_types'      => array( 'page' ),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'gutenberg_preview_image' => get_template_directory_uri() . '/template-parts/blocks/sonder/chess-content/chess-content.png',
					),
				),
			),
		)
	);
	acf_register_block_type(
		array(
			'name'            => 'full-width-image-rounded',
			'title'           => __( 'Bild in voller Breite mit abgerundeten Kanten', 'kemroc' ),
			'description'     => __( 'Bild in voller Breite mit abgerundeten Kanten', 'kemroc' ),
			'render_template' => 'template-parts/blocks/sonder/full-width-image-rounded/full-width-image-rounded.php',
			'category'        => 'images-modules',
			'mode'            => 'edit',
			'icon'            => 'format-gallery',
			'keywords'        => array( 'Bild' ),
			'post_types'      => array( 'page' ),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'gutenberg_preview_image' => get_template_directory_uri() . '/template-parts/blocks/sonder/full-width-image-rounded/full-width-image-rounded.png',
					),
				),
			),
		)
	);
	acf_register_block_type(
		array(
			'name'            => 'our-team',
			'title'           => __( 'Unser Team', 'kemroc' ),
			'description'     => __( 'Unser Team', 'kemroc' ),
			'render_template' => 'template-parts/blocks/sonder/our-team/our-team.php',
			'category'        => 'sonder-modules',
			'mode'            => 'edit',
			'icon'            => 'format-gallery',
			'keywords'        => array( 'Team' ),
			'post_types'      => array( 'page' ),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'gutenberg_preview_image' => get_template_directory_uri() . '/template-parts/blocks/sonder/our-team/our-team.png',
					),
				),
			),
		)
	);
	acf_register_block_type(
		array(
			'name'            => 'application-areas-filter',
			'title'           => __( 'Einsatzbereiche Filter', 'kemroc' ),
			'description'     => __( 'Einsatzbereiche Filter', 'kemroc' ),
			'render_template' => 'template-parts/blocks/application-areas/application-areas-filter/application-areas-filter.php',
			'category'        => 'application-areas',
			'mode'            => 'edit',
			'icon'            => 'format-gallery',
			'keywords'        => array( 'Einsatzbereiche', 'Filter' ),
			'post_types'      => array( 'page' ),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'gutenberg_preview_image' => get_template_directory_uri() . '/template-parts/blocks/application-areas/application-areas-filter/application-areas-filter.png',
					),
				),
			),
		)
	);
	acf_register_block_type(
		array(
			'name'            => 'contacts-info',
			'title'           => __( 'Kontaktinformationen', 'kemroc' ),
			'description'     => __( 'Kontaktinformationen', 'kemroc' ),
			'render_template' => 'template-parts/blocks/contacts/contacts-info/contacts-info.php',
			'category'        => 'contacts',
			'mode'            => 'edit',
			'icon'            => 'format-gallery',
			'keywords'        => array( 'Kontakt' ),
			'post_types'      => array( 'page' ),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'gutenberg_preview_image' => get_template_directory_uri() . '/template-parts/blocks/contacts/contacts-info/contacts-info.png',
					),
				),
			),
		)
	);
	acf_register_block_type(
		array(
			'name'            => 'contacts-form',
			'title'           => __( 'Kontakt-Formular', 'kemroc' ),
			'description'     => __( 'Kontakt-Formular', 'kemroc' ),
			'render_template' => 'template-parts/blocks/contacts/contacts-form/contacts-form.php',
			'category'        => 'contacts',
			'mode'            => 'edit',
			'icon'            => 'format-gallery',
			'keywords'        => array( 'Kontakt', 'Form' ),
			'post_types'      => array( 'page' ),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'gutenberg_preview_image' => get_template_directory_uri() . '/template-parts/blocks/contacts/contacts-form/contacts-form.png',
					),
				),
			),
		)
	);
	acf_register_block_type(
		array(
			'name'            => 'contacts-links',
			'title'           => __( 'Kontakt-Links', 'kemroc' ),
			'description'     => __( 'Kontakt-Links', 'kemroc' ),
			'render_template' => 'template-parts/blocks/contacts/contacts-links/contacts-links.php',
			'category'        => 'contacts',
			'mode'            => 'edit',
			'icon'            => 'format-gallery',
			'keywords'        => array( 'Kontakt', 'Links' ),
			'post_types'      => array( 'page' ),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'gutenberg_preview_image' => get_template_directory_uri() . '/template-parts/blocks/contacts/contacts-links/contacts-links.png',
					),
				),
			),
		)
	);
	acf_register_block_type(
		array(
			'name'            => 'lazy-video',
			'title'           => __( 'Faulenzer-Video', 'kemroc' ),
			'description'     => __( 'Faulenzer-Video', 'kemroc' ),
			'render_template' => 'template-parts/blocks/sonder/lazy-video/lazy-video.php',
			'category'        => 'sonder',
			'mode'            => 'edit',
			'icon'            => 'video-alt3',
			'keywords'        => array( 'Video', 'Lazy video' ),
			'post_types'      => array( 'page', 'post' ),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'gutenberg_preview_image' => get_template_directory_uri() . '/template-parts/blocks/sonder/lazy-video/lazy-video.png',
					),
				),
			),
		)
	);
	acf_register_block_type(
		array(
			'name'            => 'faq',
			'title'           => __( 'FAQ', 'kemroc' ),
			'description'     => __( 'FAQ', 'kemroc' ),
			'render_template' => 'template-parts/blocks/sonder/faq/faq.php',
			'category'        => 'sonder',
			'mode'            => 'edit',
			'icon'            => 'welcome-learn-more',
			'keywords'        => array( 'FAQ' ),
			'post_types'      => array( 'page', 'post' ),
			'example'         => array(
				'attributes' => array(
					'mode' => 'preview',
					'data' => array(
						'gutenberg_preview_image' => get_template_directory_uri() . '/template-parts/blocks/sonder/faq/faq.png',
					),
				),
			),
		)
	);
}
add_action( 'acf/init', 'kemroc_acf_init_block_types' );
