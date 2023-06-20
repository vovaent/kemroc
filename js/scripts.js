import { components } from './components/components';
import { templates } from './templates/templates';

/* global jQuery */
/* eslint no-undef: "error" */

jQuery(document).ready(function ($) {
	components($);
	templates($);
});
