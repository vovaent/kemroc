const contentPost = ($) => {
	/* global headerTag */
	/* eslint no-undef: "error" */

	const $window = $(window);
	let windowWidth = $window.width();

	const $articleContent = $('.cp-article__content');

	if ($articleContent.length === 0) {
		return;
	}

	const articleTitlesSelector =
		typeof headerTag !== 'undefined' && headerTag.length !== 0
			? headerTag
			: ':header';
	const $articleTitles = $(`.cp-article__content > ${articleTitlesSelector}`);
	const navLinkSelector = '.cp-article-navigation__item-link';
	const $articleNavlinks = $(navLinkSelector);
	const articleContentTopPos = $articleContent.offset().top;

	const articleNavlinkAnchorHandler = () => {
		$articleTitles.each(function (index) {
			if ($articleNavlinks.eq(index).length === 0) {
				return;
			}

			const articleNavlinkAnchor = $articleNavlinks
				.eq(index)
				.attr('href');
			const thisId = articleNavlinkAnchor.replace('#', '');

			$(this).attr('id', thisId);
		});

		$articleNavlinks.on('click', function (event) {
			event.preventDefault();

			const thisIndex = $(this).index(navLinkSelector);
			const articleHeaderPos = $articleTitles.eq(thisIndex).offset().top;
			const srollToPos = articleHeaderPos - 20;

			$('html, body').animate({ scrollTop: srollToPos }, 500);
		});
	};

	const synchronizationHandler = () => {
		if (windowWidth < 1024) {
			return;
		}

		const navItemClassName = 'cp-article-navigation__item';
		const navItemSelector = '.' + navItemClassName;
		const activeNavItemClassName = navItemClassName + '--active';
		const activeNavItemSelector = '.' + activeNavItemClassName;

		const articleContentBottomPos =
			articleContentTopPos + $articleContent.height();
		const windowScrollTopPos = $window.scrollTop();

		$articleTitles.each(function () {
			const $thisTitle = $(this);

			const thisTitleTopPos = $thisTitle.offset().top - 60;
			const thisTitleId = $thisTitle.attr('id');

			if (windowScrollTopPos > thisTitleTopPos) {
				$articleNavlinks
					.parent(activeNavItemSelector)
					.removeClass(activeNavItemClassName);

				$('a[href="#' + thisTitleId + '"]')
					.parent(navItemSelector)
					.addClass(activeNavItemClassName);
			}
		});

		$window.scroll(function () {
			const windowScrollTopPos = $(this).scrollTop();

			if (windowScrollTopPos > articleContentBottomPos) {
				return;
			}

			$articleTitles.each(function (index) {
				const $thisTitle = $(this);
				const isLastTitle = index === $articleTitles.length - 1;
				const thisTitleTopPos = $thisTitle.offset().top - 60;
				const thisTitleId = $thisTitle.attr('id');

				let thisTitleBottomPos = 0;
				if (isLastTitle) {
					thisTitleBottomPos =
						thisTitleTopPos + articleContentBottomPos;
				} else {
					thisTitleBottomPos = $articleTitles
						.eq(++index)
						.offset().top;
				}

				if (
					windowScrollTopPos > thisTitleTopPos &&
					windowScrollTopPos < thisTitleBottomPos
				) {
					$articleNavlinks
						.parent(activeNavItemSelector)
						.removeClass(activeNavItemClassName);

					$('a[href="#' + thisTitleId + '"]')
						.parent(navItemSelector)
						.addClass(activeNavItemClassName);
				} else if (windowScrollTopPos < thisTitleTopPos) {
					$('a[href="#' + thisTitleId + '"]')
						.parent(navItemSelector)
						.removeClass(activeNavItemClassName);
				}
			});
		});
	};

	const articleNavigationHandler = () => {
		if ($articleNavlinks.length === 0 || $articleTitles.length === 0) {
			return;
		}

		articleNavlinkAnchorHandler();
		synchronizationHandler();
	};

	const articleShareHandler = () => {
		const $articleShare = $('.cp-article__share');

		if ($articleShare.length === 0) {
			return;
		}

		$articleShare.css('opacity', '1');

		const $articleSticky = $('.cp-article__sticky');
		const $articleShareParent = $articleShare.parent();

		if (windowWidth <= 1024) {
			if ($articleShareParent[0] === $articleSticky[0]) {
				$articleShare
					.clone()
					.appendTo($articleContent)
					.css('display', 'flex');
				$articleShare.remove();
			}
		} else {
			if ($articleShareParent[0] === $articleContent[0]) {
				$articleShare
					.clone()
					.appendTo($articleSticky)
					.css('display', 'flex');
				$articleShare.remove();
			}
		}
	};

	const wpBlockFileHandler = () => {
		const $wpBlockFileLink = $('.wp-block-file a');

		if ($wpBlockFileLink.length > 0) {
			const wpBlockFileLinkHref = $wpBlockFileLink.attr('href');
			const extensionStartPosition = wpBlockFileLinkHref.lastIndexOf('.');

			if (extensionStartPosition !== -1) {
				const extension = wpBlockFileLinkHref.slice(
					extensionStartPosition
				);
				$wpBlockFileLink.append(
					`<span class="wp-block-file__extension">${extension}</span>`
				);
			}
		}
	};

	const goToReadHandler = () => {
		const $goToRead = $('.cp-article__to-read');
		if ($goToRead.length === 0) {
			return;
		}

		$goToRead.on('click', (event) => {
			event.preventDefault();

			const srollToPos = articleContentTopPos - 20;

			$('html, body').animate({ scrollTop: srollToPos }, 500);
		});
	};

	const windowResizeHandler = () => {
		$window.resize(function () {
			windowWidth = $window.width();

			synchronizationHandler();
			articleShareHandler();
		});
	};

	articleNavigationHandler();
	articleShareHandler();
	wpBlockFileHandler();
	goToReadHandler();
	windowResizeHandler();
};

export { contentPost };
