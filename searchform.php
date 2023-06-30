<form role="search" method="get" class="search-form" action="<?php echo esc_attr( pll_home_url() ); ?>">
	<label class="search-form__label">
		<span class="screen-reader-text"><?php esc_html_x( 'Suche nach:', 'label', 'kemroc' ); ?></span>
		<input 
			type="search" 
			class="search-form__field" 
			placeholder="<?php echo esc_attr_x( 'Suche', 'placeholder', 'kemroc' ); ?> …" 
			value="<?php echo get_search_query(); ?>" 
			name="s" 
			autocomplete="off"
			title="<?php esc_html_x( 'Suche nach:', 'label', 'kemroc' ); ?>" 
		/>
	</label>
	<button class="search-form__submit"></button>
</form>
