const ourTeam = ( $ ) => {
	const $memberCard = $( '.member-card' );
	if ( $memberCard.length === 0 ) {
		return;
	}
	// $memberCard.hover(
	// 	function () {
	// 		if ( $( window ).width < 1200 ) {
	// 			return;
	// 		}

	// 		const $this = $( this );
	// 		const $memberCardAvatar = $( '.member-card__avatar', $this );
	// 		const $memberCardAvatarImg = $( 'img', $memberCardAvatar );

	// 		$memberCardAvatar.css( 'scale', '0.8' );
	// 		$memberCardAvatarImg.css( 'scale', '1' );
	// 	},
	// 	function () {
	// 		if ( $( window ).width < 1200 ) {
	// 			return;
	// 		}

	// 		const $this = $( this );
	// 		const $memberCardAvatar = $( '.member-card__avatar', $this );
	// 		const $memberCardAvatarImg = $( 'img', $memberCardAvatar );

	// 		$memberCardAvatar.css( 'scale', '1' );
	// 		$memberCardAvatarImg.css( 'scale', '1.1' );
	// 	}
	// );
};

export { ourTeam };
