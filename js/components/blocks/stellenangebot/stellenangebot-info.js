const stellenangebotInfo = ( $ ) => {
	/* global stellenangebotAjax, customEmailTo */
	/* eslint no-undef: "error"*/

	const $form = $( '#cf-form-stellenangebot' );
	const $button = $( '.cf-form__button', $form );
	const $requiredField = $( '.cf-form__field--required', $form );
	const $checkbox = $( '.cf-form__agree-checkbox', $form );
	const $resumeFile = $( '#resumeFile', $form );
	const $successMessage = $( '.cf-form__success-message', $form );
	const $errorMessage = $( '.cf-form__error-message', $form );
	const elResumeFile = document.getElementById( 'resumeFile' );
	const elResumeFileLabel = document.getElementById( 'resumeFileLabel' );
	const elResumeFileArea = document.getElementById( 'resumeFileArea' );
	const elResumeFileAreaText = document.getElementById(
		'resumeFileAreaText'
	);
	const $fileClear = $( '.cf-form__file-clear' );
	const $preloader = $( '.kemroc-preloader' );

	const showError = ( $el, type ) => {
		$el.addClass( 'cf-form__field--error' );

		if ( type === 'empty' ) {
			$el.siblings( '.cf-form__error-notice' )
				.not( '.cf-form__error-notice--email' )
				.show();
		} else if ( type === 'invalidEmail' ) {
			$el.siblings( '.cf-form__error-notice--email' ).show();
		} else if ( type === 'checkbox' ) {
			$( '.cf-form__error-notice--checkbox' ).show();
		} else if ( type === 'file' ) {
			$( '.cf-form__error-notice--file' ).show();
		}
	};

	const hideError = ( $el, type ) => {
		if ( type === 'empty' ) {
			$el.removeClass( 'cf-form__field--error' );
			$el.siblings( '.cf-form__error-notice' ).hide();
		} else if ( type === 'checkbox' ) {
			$( '.cf-form__error-notice--checkbox' ).hide();
		} else if ( type === 'file' ) {
			$el.removeClass( 'cf-form__field--error' );
			$( '.cf-form__error-notice--file' ).hide();
		}
	};

	const validateEmail = ( email ) => {
		const emailReg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		return emailReg.test( email );
	};

	const fieldCheck = ( el ) => {
		let res = true;

		const $this = $( el );
		// const thisValue = $this.val();
		const thisValue = el.value;
		const thisType = $this.attr( 'type' );

		if ( thisValue === '' ) {
			showError( $this, 'empty' );
			res = false;
		} else if ( thisType === 'email' ) {
			if ( ! validateEmail( thisValue ) ) {
				showError( $this, 'invalidEmail' );
				res = false;
			}
		}

		return res;
	};

	$requiredField.on( 'blur', function () {
		fieldCheck( this );
	} );

	$requiredField.on( 'input', function () {
		hideError( $( this ), 'empty' );
	} );

	$checkbox.on( 'change', function () {
		const $this = $( this );

		if ( $this.prop( 'checked' ) ) {
			hideError( $this, 'checkbox' );
		}
	} );

	$button.on( 'click', function ( event ) {
		event.preventDefault();

		let sendAllow = true;

		$requiredField.each( function () {
			const checkFieldRes = fieldCheck( this );
			if ( ! checkFieldRes ) {
				sendAllow = false;
			}
		} );

		if ( ! $checkbox.prop( 'checked' ) ) {
			showError( $checkbox, 'checkbox' );
			sendAllow = false;
		}

		if ( sendAllow ) {
			$form.submit();
		}
	} );

	$form.on( 'submit', function ( event ) {
		event.preventDefault();

		$preloader.show();
		$button.attr( 'disabled', true ).css( 'opacity', 0.5 );

		const $this = $( this );
		const data = new FormData( $this[ 0 ] );

		if ( $resumeFile.length !== 0 ) {
			const resumeFileData = $resumeFile.prop( 'files' )[ 0 ];

			if ( typeof resumeFileData !== 'undefined' ) {
				// if ( resumeFileData.size <= 1000000 ) {
				data.append( 'resume', resumeFileData );
				// } else {
				// 	showError();
				// }
			}
		}

		data.append( 'action', 'stellenangebot_action' );
		data.append( 'nonce', stellenangebotAjax.nonce );

		if ( typeof customEmailTo !== 'undefined' ) {
			data.append( 'custom_email_to', customEmailTo );
		}

		$.ajax( {
			type: 'POST',
			url: stellenangebotAjax.url,
			data,
			dataType: 'json',
			contentType: false,
			processData: false,
			success( resp ) {
				if ( ! resp.success ) {
					if ( typeof resp.data === 'object' ) {
						$.each(
							resp.data,
							function ( indexInArray, valueOfElement ) {
								if ( indexInArray === 'resume' ) {
									$preloader.hide();
									$button
										.attr( 'disabled', false )
										.css( 'opacity', 1 );

									showError(
										$( elResumeFileArea ),
										valueOfElement
									);
									return;
								}

								$preloader.hide();
								$button
									.attr( 'disabled', false )
									.css( 'opacity', 1 );

								showError(
									$( `input[name=${ indexInArray }]` ),
									valueOfElement
								);
							}
						);
					} else if ( typeof resp.data === 'string' ) {
						$preloader.hide();
						$button.attr( 'disabled', false ).css( 'opacity', 1 );

						$errorMessage.text( '' ).text( resp.data );
						$errorMessage.fadeIn( 400, function () {
							const srollToPos = $errorMessage.offset().top - 500;

							$( 'html, body' ).animate(
								{ scrollTop: srollToPos },
								500
							);
						} );

						setTimeout( () => {
							$errorMessage.fadeOut();
						}, 5000 );
					}
				} else {
					$preloader.hide();
					$button.attr( 'disabled', false ).css( 'opacity', 1 );

					$successMessage.fadeIn( 400, function () {
						const srollToPos = $successMessage.offset().top - 500;

						$( 'html, body' ).animate(
							{ scrollTop: srollToPos },
							500
						);
					} );

					setTimeout( () => {
						$successMessage.fadeOut();
					}, 5000 );
				}
			},
		} );
	} );

	const loadFileHandler = () => {
		if ( elResumeFile === null ) {
			return;
		}

		if ( elResumeFileArea === null ) {
			return;
		}

		if ( elResumeFileLabel === null ) {
			return;
		}

		const fileAreaHtml = elResumeFileAreaText.innerHTML;

		elResumeFile.onchange = function () {
			if ( this.files.length === 0 || this.value === '' ) {
				hideError( $( elResumeFileArea ), 'file' );
				showError( $( elResumeFileArea ), 'empty' );

				return;
			}

			hideError( $( elResumeFileArea ), 'empty' );

			$fileClear.addClass( 'cf-form__file-clear--visible' );

			const file = this.files[ 0 ];

			elResumeFileAreaText.innerHTML = file.name;

			if ( file.size > 1000000 ) {
				showError( $( elResumeFileArea ), 'file' );
			}
		};

		$fileClear.on( 'click', function () {
			elResumeFile.value = '';
			elResumeFileAreaText.innerHTML = fileAreaHtml;

			$( elResumeFile ).trigger( 'change' );

			$( this ).removeClass( 'cf-form__file-clear--visible' );
		} );

		elResumeFileAreaText.addEventListener( 'click', () => {
			elResumeFile.click();
		} );

		[ 'dragenter', 'dragover', 'dragleave', 'drop' ].forEach(
			( eventName ) => {
				elResumeFileArea.addEventListener(
					eventName,
					( e ) => {
						e.preventDefault();
						e.stopPropagation();
					},
					false
				);
			}
		);

		[ 'dragenter', 'dragover' ].forEach( ( eventName ) => {
			elResumeFileArea.addEventListener(
				eventName,
				function () {
					this.classList.add( 'cf-form__label--resume--over' );
				},
				false
			);
		} );

		let files;

		elResumeFileArea.addEventListener(
			'dragleave',
			function () {
				this.classList.remove( 'cf-form__label--resume--over' );
			},
			false
		);

		elResumeFileArea.addEventListener(
			'drop',
			function ( e ) {
				this.classList.remove( 'cf-form__label--resume--over' );

				const dt = e.dataTransfer;
				files = dt.files;

				if ( files.length > 1 ) return;

				elResumeFile.files = files;
				$( elResumeFile ).trigger( 'change' );
			},
			false
		);
	};

	loadFileHandler();
};

export { stellenangebotInfo };
