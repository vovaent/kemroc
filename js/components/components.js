import { navigation } from './navigation/navigation';
import { search } from './search/search';
import { header } from './header/header';
import { muSwitcher } from './measure-units-switcher/measure-units-switcher';
import { blocks } from './blocks/blocks';

const components = ( $ ) => {
	navigation( $ );
	search( $ );
	header( $ );
	muSwitcher( $ );
	blocks( $ );
};

export { components };
