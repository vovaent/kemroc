const criticalCss = ( $ ) => {
	const removeCriticalCss = () => {
		$( '#critical-css' ).remove();
	};
	removeCriticalCss();
};

export { criticalCss };
