/**
 * File customizer.js.
 *
 * global wp
 *
 * Theme Customizer enhancements for a better user experience.
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	var api = wp.customize;

	// Site title and description.
	api( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	api( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	api( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description, .menu-toggle, .ham-menu-container .menu-toggle button' ).css( {
					'color': to
				} );
			}
		} );
	} );

	// Custom Header
	api( 'header-image-title', function( value ) {
		value.bind( function( to ) {
			$('.custom-header-box .header-image-title').text( to );
		} );
	} );

	api( 'header-image-description', function( value ) {
		value.bind( function( to ) {
			$('.custom-header-box .header-image-description').html( to );
		} );
	} );

	api( 'header-image-button-label', function( value ) {
		value.bind( function( to ) {
			$('.custom-header-box a.button').text( to );
		} );
	} );

	api( 'header-image-position', function( value ) {
		value.bind( function( to ) {
			$('.custom-header-box').removeClass( 'align-left align-center align-right' );
			$('.custom-header-box').addClass( 'align-' + to );

		} );
	} );

	/* End Custom Header */

	api( 'color-accent', function( value ) {
		value.bind( function( to ) {
			$('.button, .accent-background, .hentry.has-post-thumbnail .sticky-post, .home-widget.widget_product_search, .home-widget.widget_search, .store-notice-container, .posts-navigation a, .widget_price_filter .ui-slider .ui-slider-range, .widget_price_filter .ui-slider .ui-slider-handle, .comment-reply-link, input[type="submit"], input[type="button"]').css('background-color', to);
			$('.main-navigation .current-menu-item > a, .main-navigation .current_page_item > a, .main-navigation .current-menu-ancestor > a, .current_page_parent > a, .main-navigation .current-menu-parent > a, .main-navigation .current-menu-ancestor > a, .main-navigation ul ul :hover > a').css('border-color', to);
			$('a:hover, a:focus, a:active').css('color', to);
		} );
	} );

	api( 'color-sticky', function( value ) {
		value.bind( function( to ) {
			$('.hentry.sticky.has-post-thumbnail .sticky-post, .hentry.sticky.has-post-thumbnail .sticky-post, .hentry.has-post-thumbnail .sticky-post').css('background-color', to);
		} );
	} );

	api( 'color-woo-sale', function( value ) {
		value.bind( function( to ) {
			$('.product .onsale').css('background-color', to);
		} );
	} );

	api( 'color-woo-outofstock', function( value ) {
		value.bind( function( to ) {
			$('.product .out-of-stock').css('background-color', to);
		} );
	} );

	// Footer Background Color.
	api( 'color-footer-background', function( value ) {
		value.bind( function( to ) {
			$('.site-footer, .footer-toggle').css('background-color', to);
		} );
	} );

	// Footer Text Color.
	api( 'color-footer-text', function( value ) {
		value.bind( function( to ) {
			$('.site-footer').css('color', to);
			$('.site-footer').find('a:not(.button), input, button, select, textarea, .genericon, ins .amount, .product-price .amount, .total, .wp-caption, .cart_list .product-variations .variation dt, .cart_list  .product-variations .variation dd, .cart_list .product-price .quantity').css('color', to);
			$('.site-footer').find('input, button, select, textarea, .widget-title, th, td').css('border-color', to);
		} );
	} );

	// Toggle Site byline visibility
	api( 'bool-hide-credit', function( value ) {
		value.bind( function( to ) {
			if( to === true ) {
				$('.site-byline').hide();
			}else if( to === false ) {
				$('.site-byline').show();
			}
		} );
	} );

	// Footer Card.
	api( 'html-footer-card', function( value ) {
		value.bind( function( to ) {
			$('.site-card').html( to );
		} );
	} );

	// 404 page.
	api( '404-cover-color', function( value ) {
		value.bind( function( to ) {
			$('.error-404 .cover').css('background-color', to);
		} );
	} );

	api( '404-cover-opacity', function( value ) {
		value.bind( function( to ) {
			$('.error-404 .cover').css('opacity', to/100);
		} );
	} );

	api( 'shop-header-cover-color', function( value ) {
		value.bind( function( to ) {
			$('.shop-header-background .cover').css('background-color', to);
		} );
	} );

	api( 'shop-header-cover-opacity', function( value ) {
		value.bind( function( to ) {
			$('.shop-header-background .cover').css('opacity', to/100);
		} );
	} );

} )( jQuery );
