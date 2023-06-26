import { filterBtn } from '../modules/filter-btn';

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

		const $this = $(this);
		const $filterBtnThis = $(filterBtn.selector, $this);

		if ($filterBtnThis.hasClass(filterBtn.classActive)) {
			return;
		}

		filterBtn.$btns.removeClass(filterBtn.classActive);
		$filterBtnThis.addClass(filterBtn.classActive);

		const areaItemThisTermId = $this.data('term-id');

		if ('all' === areaItemThisTermId) {
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
