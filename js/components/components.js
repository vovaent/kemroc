import { navigation } from './navigation/navigation';
import { search } from './search/search';
import { header } from './header/header';
import { blocks } from './blocks/blocks';

const components = ( $ ) => {
	navigation( $ );
	search( $ );
	header( $ );
	blocks( $ );
};

export { components };
