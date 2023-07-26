<?php
/**
 * Glossary Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 * 
 * @package kemroc
 */

if ( isset( $block['data']['gutenberg_preview_image'] ) && $is_preview ) {
	echo '<img src="' . esc_url( $block['data']['gutenberg_preview_image'] ) . '" style="max-width:100%; height:auto;">';
}

if ( ! $is_preview ) :
	// Create id attribute allowing for custom "anchor" value.
	$kemroc_gl_id = 'our-partners-' . $block['id'];
	if ( ! empty( $block['anchor'] ) ) {
		$kemroc_gl_id = $block['anchor'];
	}

	// Create class attribute allowing for custom "className" and "align" values.
	$kemroc_gl_class_name = 'glossary-block bg-primary text-white text-center';
	if ( ! empty( $block['className'] ) ) {
		$kemroc_gl_class_name .= ' ' . $block['className'];
	}
	if ( ! empty( $block['align'] ) ) {
		$kemroc_gl_class_name .= ' align' . $block['align'];
	}

	// Load values and assing defaults.
	$kemroc_gl_title_choice = get_field( 'kemroc_gl_title_choice' );
	$kemroc_gl_title        = 'custom_title' === $kemroc_gl_title_choice ? get_field( 'custom_title' ) : get_the_title();
	$kemroc_gl_shortcode    = get_field( 'shortcode' );
	?>

	<section id="<?php echo esc_attr( $kemroc_gl_id ); ?>" class="<?php echo esc_attr( $kemroc_gl_class_name ); ?>">
		<div class="container glossary-block__content">			
			<h1 class="glossary-block__title">
				<?php echo esc_html( $kemroc_gl_title ); ?>
			</h1>
			<!-- /.glossary-block__title -->
			<div class="glossary-block__list">
				<?php echo do_shortcode( $kemroc_gl_shortcode ); ?>
			</div>
			<!-- /.glossary-block__list -->
		</div>
		<!-- /.container glossary-block__content -->
	</section>
	<!-- /.glossary-block -->

	<?php
	endif;
