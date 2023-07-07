const contactsForm = ( $ ) => {
	/* global contacts_object, customEmailTo */
	/* eslint no-undef: "error"*/

	const $form = $( '#cf-form-contacts' );
	const $button = $( '.cf-form__button', $form );
	const $requiredField = $( '.cf-form__field--required', $form );
	const $checkbox = $( '.cf-form__agree-checkbox', $form );
	const $successMessage = $( '.cf-form__success-message', $form );
	const $errorMessage = $( '.cf-form__error-message', $form );

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
		}
	};

	const hideError = ( $el, type ) => {
		if ( type === 'empty' ) {
			$el.removeClass( 'cf-form__field--error' );
			$el.siblings( '.cf-form__error-notice' ).hide();
		} else if ( type === 'checkbox' ) {
			$( '.cf-form__error-notice--checkbox' ).hide();
		}
	};

	const validateEmail = ( email ) => {
		const emailReg = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
		return emailReg.test( email );
	};

	const fieldCheck = ( el ) => {
		let res = true;

		const $this = $( el );
		const thisValue = $this.val();
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

		const $this = $( this );
		const data = new FormData( $this[ 0 ] );

		data.append( 'action', 'contacts_action' );
		data.append( 'nonce', contacts_object.nonce );

		if ( typeof customEmailTo !== 'undefined' ) {
			data.append( 'custom_email_to', customEmailTo );
		}

		$.ajax( {
			type: 'POST',
			url: contacts_object.url,
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
								showError(
									$( `input[name=${ indexInArray }]` ),
									valueOfElement
								);
							}
						);
					} else if ( typeof resp.data === 'string' ) {
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
};

export { contactsForm };
