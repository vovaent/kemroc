<?php
/**
 * Critical CSS
 * 
 * @package kemroc
 */

/**
 * Custom is_admin()
 */
function kemroc_is_admin() {
	$res = false;
	if ( is_admin() || '/wp-admin/' === $_SERVER['REQUEST_URI'] ) { //phpcs:ignore
		$res = true;
	}
	return $res;
}


/** 
 * Get critical file path
 * 
 * @return string
 */
function kemroc_get_critical_file_path() {
	$critical_file_path = '';

	if ( is_front_page() ) {
		$critical_file_path = get_template_directory() . '/critical-css/front-page.css';
	} elseif ( is_singular( 'post' ) ) {
		$critical_file_path = get_template_directory() . '/critical-css/post.css';
	}
	
	return $critical_file_path;
}

function kemroc_adding_style_preload( $html, $handle, $href, $media ) {
	if ( kemroc_is_admin() ) {
		return $html;
	}

	$critical_file_path = kemroc_get_critical_file_path();
	
	if ( ! file_exists( $critical_file_path ) ) {
		return $html;
	}
	
	$html = <<<EOT
            <link rel="preload" id="$handle" href="$href" as="style" onload="this.onload=null; this.rel='stylesheet';" media="all">
EOT;

	return $html;
}

add_filter( 'style_loader_tag', 'kemroc_adding_style_preload', 10, 4 );

function kemroc_include_critical_css() { 
	if ( kemroc_is_admin() ) {
		return;
	}

	$critical_file_path = kemroc_get_critical_file_path();

	if ( ! file_exists( $critical_file_path ) ) {
		return;
	}
	
	$critical_file = file_get_contents( $critical_file_path );
	?>

	<style id="critical-css">
		<?php echo esc_html( $critical_file ); ?>
	</style>

	<?php
}

add_action( 'wp_head', 'kemroc_include_critical_css', 10 );
