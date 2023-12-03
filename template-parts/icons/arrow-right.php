<?php
/**
 * Arrow right
 * 
 * @package kemroc
 */

$kemroc_ar_svg_width  = isset( $args['width'] ) ? $args['width'] : '6';
$kemroc_ar_svg_height = isset( $args['height'] ) ? $args['height'] : '10';
$kemroc_ar_svg_fill   = isset( $args['fill'] ) ? $args['fill'] : '#444444';
?>
<svg 
	width="<?php echo $kemroc_ar_svg_width; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>" 
	height="<?php echo $kemroc_ar_svg_height; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>"
	viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
	<path fill-rule="evenodd" clip-rule="evenodd"
		d="M0.292893 0.292893C0.683417 -0.0976311 1.31658 -0.0976311 1.70711 0.292893L5.70711 4.29289C6.09763 4.68342 6.09763 5.31658 5.70711 5.70711L1.70711 9.70711C1.31658 10.0976 0.683417 10.0976 0.292893 9.70711C-0.0976311 9.31658 -0.0976311 8.68342 0.292893 8.29289L3.58579 5L0.292893 1.70711C-0.0976311 1.31658 -0.0976311 0.683417 0.292893 0.292893Z"
		fill="<?php echo $kemroc_ar_svg_fill; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>" />
</svg>
