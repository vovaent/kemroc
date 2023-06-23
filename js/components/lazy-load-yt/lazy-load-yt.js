const lazyLoadYT = ($) => {
	const $videoPlaceholder = $('.lazy-video__placeholder');

	if ($videoPlaceholder.length > 0) {
		$videoPlaceholder.on('click', function () {
			const iframe = document.createElement('iframe');
			const $iframe = $(iframe);
			const ytVideoId = $videoPlaceholder.data('ytVideoId');
			const ytIframeClass = $videoPlaceholder.data('ytIframeClass');

			$iframe.attr(
				'src',
				'https://www.youtube.com/embed/' +
					ytVideoId +
					'?rel=0&showinfo=0&autoplay=1'
			);
			$iframe.attr('class', ytIframeClass);
			$iframe.attr('width', '100%');
			$iframe.attr('height', '100%');
			$iframe.attr('webkitallowfullscreen', '');
			$iframe.attr('mozallowfullscreen', '');
			$iframe.attr('webkitallowfullscreen', '');
			$iframe.attr('frameborder', '0');
			$iframe.attr(
				'allow',
				'accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture'
			);

			const $videoPlaceholderParent = $videoPlaceholder.parent();

			$videoPlaceholderParent.html('');
			$videoPlaceholderParent.append(iframe);
		});
	}
};

export { lazyLoadYT };
