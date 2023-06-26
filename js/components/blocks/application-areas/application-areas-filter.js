const applicationAreasFilter = ($) => {
	const filterBtnClass = 'filter-btn';
	const filterBtnSelector = '.' + filterBtnClass;
	const $filterBtns = $(filterBtnSelector);
	const $areaItems = $('.application-areas-filter__areas-item');
	const $modelItems = $('.application-areas-filter__model-item');

	if (0 === $areaItems.length) {
		return;
	}

	$areaItems.on('click', function () {
		if (0 === $modelItems.length) {
			return;
		}

		const $filterBtnThis = $(filterBtnSelector, $(this));
		const filterBtnClassActive = filterBtnClass + '--active';

		if ($filterBtnThis.hasClass(filterBtnClassActive)) {
			return;
		}

		$filterBtns.removeClass(filterBtnClassActive);
		$filterBtnThis.addClass(filterBtnClassActive);

		const areaItemThisTermId = $(this).data('term-id');

		if (null === areaItemThisTermId) {
			$modelItems.fadeIn();
		} else {
			$modelItems.hide();

			$modelItems.each(function () {
				const $modelItemThis = $(this);
				const modelItemThisTermId = $modelItemThis.data('term-id');

				if (modelItemThisTermId === areaItemThisTermId) {
					$modelItemThis.fadeIn();
				}
			});
		}
	});
};

export { applicationAreasFilter };
