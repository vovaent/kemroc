const lazyLoad = ( $ ) => {
	const createIframe = ( $placeholder ) => {
		const ytVideoId = $placeholder.data( 'ytVideoId' );
		const ytIframeClass = $placeholder.data( 'ytIframeClass' );

		const $iframe = $( '<iframe>', {
			class: ytIframeClass,
			src:
				'https://www.youtube.com/embed/' +
				ytVideoId +
				'?rel=0&showinfo=0&autoplay=1',
			width: '100%',
			height: '100%',
			webkitallowfullscreen: '',
			mozallowfullscreen: '',
			frameborder: '0',
			allow:
				'accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture',
		} );

		return $iframe;
	};

	const videoPlaceholderHandler = () => {
		const $preloader = $( '.kemroc-preloader' );
		const $videoPlaceholder = $( '.lazy-video__placeholder' );

		if ( $videoPlaceholder.length === 0 ) {
			return;
		}

		$videoPlaceholder.on( 'click', function () {
			$preloader.show();

			const $this = $( this );

			$( '.lazy-video__poster', $this ).addClass(
				'lazy-video__poster--back'
			);
			$( '.lazy-video__icon-play', $this ).remove();

			const iframe = createIframe( $this );
			$this.parent().append( iframe );

			$this.addClass( 'lazy-video__placeholder--back' );
		} );
	};

	const videoFileHandler = () => {
		const $videoFile = $( '.lazy-video__figure--file' );

		if ( $videoFile.length === 0 ) {
			return;
		}

		$videoFile.on( 'click', function ( e ) {
			const $this = $( this );
			const $video = $this.find( 'video' );

			$this.find( '.icon-play' ).remove();
			$video.attr( 'controls', '' );

			if ( e.target !== $video[ 0 ] ) {
				$video[ 0 ].play();
			}
		} );
	};

	videoPlaceholderHandler();
	videoFileHandler();
};

export { lazyLoad };
