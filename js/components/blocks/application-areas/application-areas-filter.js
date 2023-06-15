const applicationAreasFilter = ($) => {
	const $areaItems = $('.application-areas-filter__areas-item');
	const $modelItems = $('.application-areas-filter__model-item');

	if (0 === $areaItems.length) {
		return;
	}

	$areaItems.on('click', function () {
		if (0 === $modelItems.length) {
			return;
		}

		const $areaItemThis = $(this);
		const areaItemClassActive =
			'application-areas-filter__areas-item--active';

		if ($areaItemThis.hasClass(areaItemClassActive)) {
			return;
		}

		$areaItems.removeClass(areaItemClassActive);
		$areaItemThis.addClass(areaItemClassActive);

		const areaItemThisTermId = $areaItemThis.data('term-id');

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
