import { components } from './components/components';
import { templates } from './templates/templates';
import { criticalCss } from './criticalCss/criticalCss';

/* global jQuery */
/* eslint no-undef: "error" */

jQuery( document ).ready( function ( $ ) {
	components( $ );
	templates( $ );
	criticalCss( $ );
} );
