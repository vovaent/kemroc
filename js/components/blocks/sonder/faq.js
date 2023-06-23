const faq = ($) => {
	const faqItemClass = 'faq__item';
	const faqItemSelector = `.${faqItemClass}`;
	const $faqItem = $(faqItemSelector);

	if ($faqItem.length === 0) {
		return;
	}

	// const $faqItemSwitcher = $(`${faqItemSelector}-switcher`);
	// $faqItemSwitcher.on('click', function () {
	// 	const $thisParent = $(this).parent();
	// 	const $thisParentFaqItem = $(this).parents(faqItemSelector);

	// 	$thisParent.next().slideToggle();
	// 	$thisParentFaqItem.toggleClass(`${faqItemClass}--extended`);
	// });
	$faqItem.on('click', function () {
		const $this = $(this);
		const $thisQuestion = $(`${faqItemSelector}-question`, $this);
		const $thisAnswer = $(`${faqItemSelector}-answer`, $this);

		$thisQuestion.toggleClass(`${faqItemClass}--extended`);
		$thisAnswer.slideToggle();
	});
};

export { faq };
