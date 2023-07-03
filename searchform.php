<?php
/**
 * Search Form Template
 * 
 * @package kemroc
 */

$kemroc_sf_add_class = ! empty( $args['add_class'] ) ? ' ' . $args['add_class'] : '';
?>
<form role="search" method="get" class="search-form<?php echo esc_attr( $kemroc_sf_add_class ); ?>" action="<?php echo esc_attr( pll_home_url() ); ?>">
	<label class="search-form__label">
		<span class="screen-reader-text"><?php esc_html_x( 'Suche nach:', 'label', 'kemroc' ); ?></span>
		<input 
			type="search" 
			class="search-form__field" 
			placeholder="<?php echo esc_attr_x( 'Suche …', 'placeholder', 'kemroc' ); ?>" 
			value="<?php echo get_search_query(); ?>" 
			name="s" 
			autocomplete="off"
			title="<?php esc_html_x( 'Suche nach:', 'label', 'kemroc' ); ?>" 
		/>
		<span class="search-form__icon"></span>
	</label>
	<button class="btn btn-accent btn-rounded arrow-right search-form__submit">
		<?php echo esc_attr_x( 'Suche', 'button', 'kemroc' ); ?>
	</button>
</form>
