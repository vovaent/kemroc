const vacancyForm = ( $ ) => {
	const elResumeFile = document.getElementById( 'resumeFile' );
	const elResumeFileArea = document.getElementById( 'file-area' );
	const elResumeFileAreaHTML = elResumeFileArea.innerHTML;

	elResumeFile.onchange = function ( e ) {
		const target = e.target;
		const fullFileName = target.value;
		const fileName =
			fullFileName.replace( /\\/g, '/' ).split( '/' ).pop() || labelText;
		elResumeFileLabel.textContent = fileName;
		elResumeFileArea.innerHTML = fileName;
		elResumeFileLabel.classList.add( 'label-file--change' );
	};

	document
		.addEventListener( 'click', ( e ) => {
			const elResumeFileAreaLabel = document.getElementById(
				'resumeFileArea'
			);
			if ( e.target == elResumeFileAreaLabel ) {
				elResumeFile.click();
			}
		} )

		[ ( 'dragenter', 'dragover', 'dragleave', 'drop' ) ].forEach(
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
				// console.log(this);
				this.classList.add( 'wpcf7-form__file-area--over' );
			},
			false
		);
	} );

	let files;

	[ 'dragleave', 'drop' ].forEach( ( eventName ) => {
		elResumeFileArea.addEventListener(
			eventName,
			function ( e ) {
				this.classList.remove( 'wpcf7-form__file-area--over' );
				this.classList.add( 'wpcf7-form__file-area--drop' );

				const dt = e.dataTransfer;
				files = dt.files;

				if ( files.length > 1 ) return;

				this.textContent = files[ 0 ].name;
				elResumeFile.files = files;

				// console.log(files);
			},
			false
		);
	} );
};

export { vacancyForm };
