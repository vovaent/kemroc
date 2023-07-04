const lazyLoad = ( $ ) => {
	const $preloader = $( '.lazy-video__preloader' );
	const $videoPlaceholder = $( '.lazy-video__placeholder' );
	const $videoFile = $( '.lazy-video__figure--file' );

	const showPreloader = () => {
		const preloaderDataImage =
			'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+PHN2ZyB4bWxuczpzdmc9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB2ZXJzaW9uPSIxLjAiIHdpZHRoPSI2NHB4IiBoZWlnaHQ9IjY0cHgiIHZpZXdCb3g9IjAgMCAxMjggMTI4IiB4bWw6c3BhY2U9InByZXNlcnZlIj48cGF0aCBmaWxsPSIjZmY2MDAwIiBkPSJNMTExLjcwOCw0OUE1MC4xMTYsNTAuMTE2LDAsMCwwLDc5LDE2LjI5MlYxLjc4NUE2NC4wNzYsNjQuMDc2LDAsMCwxLDEyNi4yMTUsNDlIMTExLjcwOFpNNDksMTYuMjkyQTUwLjExNCw1MC4xMTQsMCwwLDAsMTYuMjkyLDQ5SDEuNzg1QTY0LjA3NSw2NC4wNzUsMCwwLDEsNDksMS43ODVWMTYuMjkyWk0xNi4yOTIsNzlBNTAuMTE2LDUwLjExNiwwLDAsMCw0OSwxMTEuNzA4djE0LjUwN0E2NC4wNzYsNjQuMDc2LDAsMCwxLDEuNzg1LDc5SDE2LjI5MlpNNzksMTExLjcwOEE1MC4xMTgsNTAuMTE4LDAsMCwwLDExMS43MDgsNzloMTQuNTA3QTY0LjA3OCw2NC4wNzgsMCwwLDEsNzksMTI2LjIxNVYxMTEuNzA4WiI+PGFuaW1hdGVUcmFuc2Zvcm0gYXR0cmlidXRlTmFtZT0idHJhbnNmb3JtIiB0eXBlPSJyb3RhdGUiIGZyb209IjAgNjQgNjQiIHRvPSItOTAgNjQgNjQiIGR1cj0iODAwbXMiIHJlcGVhdENvdW50PSJpbmRlZmluaXRlIj48L2FuaW1hdGVUcmFuc2Zvcm0+PC9wYXRoPgogIDxwYXRoIGZpbGw9IiNmZjYwMDAiIGQ9Ik05Ni45NzEsNTMuNjMzYTM0LjYzNCwzNC42MzQsMCwwLDAtMjIuNi0yMi42VjIxQTQ0LjI4Myw0NC4yODMsMCwwLDEsMTA3LDUzLjYzM0g5Ni45NzFabS00My4zMzgtMjIuNmEzNC42MzQsMzQuNjM0LDAsMCwwLTIyLjYsMjIuNkgyMUE0NC4yODMsNDQuMjgzLDAsMCwxLDUzLjYzMywyMVYzMS4wMjlabS0yMi42LDQzLjMzOGEzNC42MzQsMzQuNjM0LDAsMCwwLDIyLjYsMjIuNlYxMDdBNDQuMjgzLDQ0LjI4MywwLDAsMSwyMSw3NC4zNjdIMzEuMDI5Wm00My4zMzgsMjIuNmEzNC42MzQsMzQuNjM0LDAsMCwwLDIyLjYtMjIuNkgxMDdBNDQuMjgzLDQ0LjI4MywwLDAsMSw3NC4zNjcsMTA3Vjk2Ljk3MVoiPjxhbmltYXRlVHJhbnNmb3JtIGF0dHJpYnV0ZU5hbWU9InRyYW5zZm9ybSIgdHlwZT0icm90YXRlIiBmcm9tPSIwIDY0IDY0IiB0bz0iOTAgNjQgNjQiIGR1cj0iODAwbXMiIHJlcGVhdENvdW50PSJpbmRlZmluaXRlIj48L2FuaW1hdGVUcmFuc2Zvcm0+PC9wYXRoPgogIDxwYXRoIGZpbGw9IiNmZjYwMDAiIGQ9Ik04NS40Nyw1Ny4yNUEyMi41NTIsMjIuNTUyLDAsMCwwLDcwLjc1LDQyLjUzVjM2QTI4LjgzNiwyOC44MzYsMCwwLDEsOTIsNTcuMjVIODUuNDdaTTU3LjI1LDQyLjUzQTIyLjU1MiwyMi41NTIsMCwwLDAsNDIuNTMsNTcuMjVIMzZBMjguODM2LDI4LjgzNiwwLDAsMSw1Ny4yNSwzNlY0Mi41M1pNNDIuNTMsNzAuNzVBMjIuNTUyLDIyLjU1MiwwLDAsMCw1Ny4yNSw4NS40N1Y5MkEyOC44MzYsMjguODM2LDAsMCwxLDM2LDcwLjc1SDQyLjUzWk03MC43NSw4NS40N0EyMi41NTIsMjIuNTUyLDAsMCwwLDg1LjQ3LDcwLjc1SDkyQTI4LjgzNiwyOC44MzYsMCwwLDEsNzAuNzUsOTJWODUuNDdaIj48YW5pbWF0ZVRyYW5zZm9ybSBhdHRyaWJ1dGVOYW1lPSJ0cmFuc2Zvcm0iIHR5cGU9InJvdGF0ZSIgZnJvbT0iMCA2NCA2NCIgdG89Ii05MCA2NCA2NCIgZHVyPSI4MDBtcyIgcmVwZWF0Q291bnQ9ImluZGVmaW5pdGUiPjwvYW5pbWF0ZVRyYW5zZm9ybT48L3BhdGg+PC9zdmc+';
		$preloader.attr(
			'style',
			`background-image: url(${ preloaderDataImage })`
		);
		$preloader.fadeIn();
	};

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
		if ( $videoPlaceholder.length === 0 ) {
			return;
		}

		$videoPlaceholder.on( 'click', function () {
			showPreloader();

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
		if ( $videoFile.length === 0 ) {
			return;
		}

		$videoFile.on( 'click', function () {
			const $this = $( this );
			const $video = $this.find( 'video' );

			$this.find( '.icon-play' ).remove();
			$video.attr( 'controls', '' );
			$video[ 0 ].play();
		} );
	};

	videoPlaceholderHandler();
	videoFileHandler();
};

export { lazyLoad };
