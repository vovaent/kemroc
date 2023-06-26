/* global jQuery */
/* eslint no-undef: "error" */
const $ = jQuery;

const filterBtn = {
	class: 'filter-btn',
};

filterBtn.classActive = filterBtn.class + '--active';
filterBtn.selector = '.' + filterBtn.class;
filterBtn.selectorActive = '.' + filterBtn.classActive;
filterBtn.$btns = $(filterBtn.selector);

export { filterBtn };
