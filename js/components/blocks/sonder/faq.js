const faq = ($) => {
	const faqItemClass = 'faq__item';
	const faqItemSelector = `.${faqItemClass}`;
	const $faqItem = $(faqItemSelector);

	if ($faqItem.length === 0) {
		return;
	}

	const collapseItem = () => {
		const $answer = $(`${faqItemSelector}-answer`);

		$faqItem.removeClass(`${faqItemClass}--extended`);
		$answer.slideUp();
	};

	const extendItem = ($thisItem, thisItemIsExtended = false) => {
		if (thisItemIsExtended) {
			return;
		}

		const $answer = $(`${faqItemSelector}-answer`, $thisItem);

		$thisItem.addClass(`${faqItemClass}--extended`);
		$answer.slideDown();
	};

	const faqItemClickHandler = ($thisItem) => {
		const thisItemIsExtended = $thisItem.hasClass(
			`${faqItemClass}--extended`
		);

		collapseItem();
		extendItem($thisItem, thisItemIsExtended);
	};

	$faqItem.on('click', function () {
		faqItemClickHandler($(this));
	});
};

export { faq };
