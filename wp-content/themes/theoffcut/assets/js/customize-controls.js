/**
 * global wp
 *
 * Scripts within the customizer controls window.
 */

(function() {
	wp.customize.bind( 'ready', function() {

		// Only show 404 error page Color & Opacity controls, if a page is selected.
		wp.customize( '404_custom_page', function( setting ) {

			wp.customize.control( '404-cover-color', function( control ) {
				var visibility = function() {
					if ( 0 >= setting.get() ) {
						control.container.slideUp( 180 );
					} else {
						control.container.slideDown( 180 );
					}
				};

				visibility();
				setting.bind( visibility );
			});

			wp.customize.control( '404-cover-opacity', function( control ) {
				var visibility = function() {
					if ( 0 >= setting.get() ) {
						control.container.slideUp( 180 );
					} else {
						control.container.slideDown( 180 );
					}
				};

				visibility();
				setting.bind( visibility );
			});

		});

		// Only show Shop page Color & Opacity controls, if an image is selected.
		wp.customize( 'shop-header-img', function( setting ) {
			wp.customize.control( 'shop-header-cover-color', function( control ) {
				var visibility = function() {
					if ( 0 >= setting.get() ) {
						control.container.slideUp( 180 );
					} else {
						control.container.slideDown( 180 );
					}
				};

				visibility();
				setting.bind( visibility );
			});
			wp.customize.control( 'shop-header-cover-opacity', function( control ) {
				var visibility = function() {
					if ( 0 >= setting.get() ) {
						control.container.slideUp( 180 );
					} else {
						control.container.slideDown( 180 );
					}
				};

				visibility();
				setting.bind( visibility );
			});
		});

	});
})( jQuery );
