import { productModelList } from './product/product-model-list';
import { modelInfo } from './model/model-info';
import { serialProductGeneralInfo } from './serial-product/serial-product-general-info';
import { seriesGeneralInfo } from './serial-product/series-general-info';
import { applicationAreasFilter } from './application-areas/application-areas-filter';
import { contactsForm } from './contacts/contacts-form';

const blocks = ($) => {
	productModelList($);
	modelInfo($);
	serialProductGeneralInfo();
	seriesGeneralInfo();
	applicationAreasFilter($);
	contactsForm($);
};

export { blocks };
