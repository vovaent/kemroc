<?php
/**
 * Search Form Template
 * 
 * @package kemroc
 */

$kemroc_sf_add_class = ! empty( $args['add_class'] ) ? ' ' . $args['add_class'] : '';
?>
<form role="search" method="get" class="search-form<?php echo esc_attr( $kemroc_sf_add_class ); ?>" action="<?php echo esc_attr( kemroc_home_url() ); ?>">
	<div class="search-form__inner">
		<label class="search-form__label">
			<span class="screen-reader-text">
				<?php esc_html_x( 'Suche nach:', 'label', 'kemroc' ); ?>
			</span>
			<!-- /.screen-reader-text -->
			<input 
				type="search" 
				class="search-form__field" 
				placeholder="<?php echo esc_attr_x( 'Suche …', 'placeholder', 'kemroc' ); ?>" 
				value="<?php echo get_search_query(); ?>" 
				name="s" 
				autocomplete="off"
				maxlength="500"
				title="<?php esc_html_x( 'Suche nach:', 'label', 'kemroc' ); ?>" 
			/>
			<!-- /.search-form__field -->
			<span class="search-form__icon"></span>
			<!-- /.search-form__icon -->
		</label>
		<!-- /.search-form__label -->
		<button class="btn btn-accent btn-rounded arrow-right search-form__submit">
			<?php echo esc_attr_x( 'Suche', 'button', 'kemroc' ); ?>
		</button>
		<!-- /.btn btn-accent btn-rounded arrow-right search-form__submit -->
	</div>
	<!-- /.search-form__inner -->
	<div class="search-results-wrapper search-form__result-wrapper"></div>
	<!-- /.search-results-wrapper search-form__result-wrapper -->
</form>
<!-- /.search-form<?php echo esc_html( $kemroc_sf_add_class ); ?> -->
