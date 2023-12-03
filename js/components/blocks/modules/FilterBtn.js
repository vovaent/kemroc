/* global jQuery */
/* eslint no-undef: "error" */
const $ = jQuery;

const FilterBtn = {
	class: 'filter-btn',
};

FilterBtn.classActive = FilterBtn.class + '--active';
FilterBtn.selector = '.' + FilterBtn.class;
FilterBtn.selectorActive = '.' + FilterBtn.classActive;
FilterBtn.$btns = $( FilterBtn.selector );

export { FilterBtn };
