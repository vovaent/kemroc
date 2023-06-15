/**
 * Components
 */
import { navigation } from './components/navigation/navigation';
import { productModelList } from './components/blocks/product/product-model-list';
import { modelInfo } from './components/blocks/model/model-info';
import { serialProductGeneralInfo } from './components/blocks/serial-product/serial-product-general-info';
import { seriesGeneralInfo } from './components/blocks/serial-product/series-general-info';
import { applicationAreasFilter } from './components/blocks/application-areas/application-areas-filter';

/*global jQuery */
/*eslint no-undef: "error"*/
jQuery(document).ready(function ($) {
	navigation($);
	productModelList($);
	modelInfo($);
	serialProductGeneralInfo();
	seriesGeneralInfo();
	applicationAreasFilter($);
});
