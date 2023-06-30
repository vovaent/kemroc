import { navigation } from './navigation/navigation';
import { search } from './search/search';
import { blocks } from './blocks/blocks';

const components = ( $ ) => {
	navigation( $ );
	search( $ );
	blocks( $ );
};

export { components };
