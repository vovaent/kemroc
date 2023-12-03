import { productModelList } from './product/product-model-list';
import { modelInfo } from './model/model-info';
import { serialProductGeneralInfo } from './serial-product/serial-product-general-info';
import { seriesGeneralInfo } from './serial-product/series-general-info';
import { applicationAreasFilter } from './application-areas/application-areas-filter';
import { contactsForm } from './contacts/contacts-form';
import { lazyLoad } from './sonder/lazy-load';
import { faq } from './sonder/faq';
import { allNews } from './news/all-news';
import { products } from './product/products';
import { ourTeam } from './sonder/our-team';
import { stellenangebotInfo } from './stellenangebot/stellenangebot-info';

const blocks = ( $ ) => {
	productModelList( $ );
	modelInfo( $ );
	serialProductGeneralInfo( $ );
	seriesGeneralInfo( $ );
	applicationAreasFilter( $ );
	contactsForm( $ );
	lazyLoad( $ );
	faq( $ );
	allNews( $ );
	products( $ );
	ourTeam( $ );
	stellenangebotInfo( $ );
};

export { blocks };
