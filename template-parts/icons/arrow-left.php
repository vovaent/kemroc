<?php
/**
 * Arrow right
 * 
 * @package kemroc
 */

$kemroc_al_svg_width  = isset( $args['width'] ) ? $args['width'] : '6';
$kemroc_al_svg_height = isset( $args['height'] ) ? $args['height'] : '10';
$kemroc_al_svg_fill   = isset( $args['fill'] ) ? $args['fill'] : '#444444';
?>
<svg 
	width="<?php echo $kemroc_al_svg_width; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>" 
	height="<?php echo $kemroc_al_svg_height; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>"
	viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
	<path fill-rule="evenodd" clip-rule="evenodd" d="M5.70711 0.292893C5.31658 -0.0976311 4.68342 -0.0976311 4.29289 0.292893L0.292893 4.29289C-0.097631 4.68342 -0.097631 5.31658 0.292893 5.70711L4.29289 9.70711C4.68342 10.0976 5.31658 10.0976 5.70711 9.70711C6.09763 9.31658 6.09763 8.68342 5.70711 8.29289L2.41421 5L5.70711 1.70711C6.09763 1.31658 6.09763 0.683417 5.70711 0.292893Z" 
		fill="<?php echo $kemroc_al_svg_fill; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>"
	/>
</svg>
