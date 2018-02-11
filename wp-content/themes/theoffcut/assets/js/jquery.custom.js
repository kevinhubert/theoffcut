(function ($) {
	'use strict';

	$(document).ready(function(){

		$('#primary-menu, #language-mobile-menu, #secondary-mobile-menu').on('click','i',function(e){
			e.preventDefault();
			$(this).closest('li').toggleClass('active');
		});

		$('#show-hide-comments').on('click', function(e){
			e.preventDefault();
			$(this).toggleClass('active');
			$('.comment-list, .comment-respond').toggle();
		});

		$('#mobile-menu-toggle').on('click', function(e){
			e.preventDefault();
			$('body').toggleClass('mobile-menu-open');
		});

		$('#footer-toggle').on('click', function(e){
			e.preventDefault();
			$('.site-footer').toggleClass('widgets-open');
		});

		// Add icon if menu has children on mobile menu - main navigation
		$('.main-navigation .menu-item-has-children a').append('<i class="genericon"></i>');

		// Add icon if menu has children on mobile menu - language navigation
		$('.language-menu .menu-item-has-children > a').append('<i class="genericon genericon-expand"></i>');

		if( $('body').is('.single-post') ) {
			var tables = document.querySelectorAll('.single-post .entry-content table');
			for ( var index = 0; index < tables.length; index++ ) {
				var headerText = [];
				var table = tables[index];
				var thead = table.querySelector('thead');
				var tbody = table.querySelector('tbody');

				if ( thead ) {
					for ( var i = 0, row; row = thead.rows[0].cells[i]; i++ ) {
						var current = row;
						headerText.push(current.textContent);
					}
				}
				if ( headerText.length ) {
					$(table).addClass('responsive-table');
					for ( var i = 0, row; row = tbody.rows[i]; i++ ) {
						for ( var j = 0, col; col = row.cells[j]; j++ ) {
							col.setAttribute('data-th', headerText[j]);
						}
					}
				}
			}
		}

		function runSliderSection(selector1, selector2) {
			$(selector1).find(selector2).each(function(){
				var _this = $(this),
					flexTransition = _this.find('.featured-slides').data('transition'),
					flexSpeed = _this.find('.featured-slides').data('speed'),
					flexPause = _this.find('.featured-slides').data('pause'),
					pagination = _this.find('.featured-slides').data('pagination'),
					paginate = false,
					dataPause = false,
					navContainer = _this.find('.control-nav-container');

				if ( 1 === flexPause ) {
					dataPause = true;
				}
				if ( 1 === pagination ) {
					paginate = true;
				}

				if ( typeof ($.fn.flexslider) !== 'undefined' ) {
					$('.site-slider').flexslider({
						animation: flexTransition,
						controlNav: paginate,
						controlsContainer: navContainer,
						directionNav: false,
						slideshow: true,
						slideshowSpeed: flexSpeed * 1000, // in milliseconds
						animationSpeed: 600,
						pauseOnHover: dataPause,
						start: function(){
							$('.site-slider').removeClass('loading');
						}
					});
				}
			});
		}

		// For default Section Slider
		runSliderSection('.page-template-template-widgetized', '.atik_widget_featured_slides');

		// For Elementor Section Slider
		runSliderSection('.page-template-template-layout-builder', '.elementor-widget-wp-widget-atik_widget_featured_slides');

		var runSingleFlexslider = function() {

			// Product Thumbnails in Single Product
			if ( typeof ($.fn.flexslider) !== 'undefined' ) {
				$('#product-slider').flexslider({
					animation: 'slide',
					selector: '.slides > .woocommerce-product-gallery__image',
					directionNav: false,
					controlNav: false,
					animationLoop: false,
					slideshow: false,
					prevText: '',
					nextText: '',
					sync: '#product-thumbnails',
					smoothHeight: true,
				});

				$('#product-thumbnails').flexslider({
					animation: 'slide',
					selector: '.slides > a',
					direction : 'horizontal',
					animationLoop: false,
					controlNav: false,
					slideshow: false,
					prevText: '',
					nextText: '',
					itemWidth: 90,
					itemMargin: 25,
					asNavFor: '#product-slider',
					smoothHeight: true,
				});
			}

			$(window).trigger('resize'); // To make flexslider nav works
		}

		runSingleFlexslider();

		var fixFlexsliderHeight = function() {
			// Set fixed height based on the tallest slide
			$('.product-slider.flexslider').each(function(){
				var sliderHeight = 0;
				$(this).find('.woocommerce-product-gallery__image a img').each(function(){
					var slideHeight = $(this).height();
					if (sliderHeight < slideHeight) {
						sliderHeight = slideHeight;
					}
				});
				$(this).find('.flex-viewport').css({'height' : sliderHeight});
				$(this).find('.woocommerce-product-gallery__image ').css({'min-height' : sliderHeight});
			});
		}

		fixFlexsliderHeight();

		$(window).resize(function() {
		    fixFlexsliderHeight();
		});

		$( '.wc-tabs-wrapper, .woocommerce-tabs' )
			.on( 'click', '.accordion-tab a', function( e ) {
				e.preventDefault();
				var $accordion = $( this );
				var $tabs_wrapper = $accordion.closest( '.wc-tabs-wrapper, .woocommerce-tabs' );
				var $accordions = $tabs_wrapper.find( '.accordion-tab' );

				var $tabs = $tabs_wrapper.find( '.wc-tabs, ul.tabs' );

				var isActive = $accordion.closest( 'div' ).hasClass('active');

				$accordions.removeClass( 'active' );

				if ( $tabs.length && ! isActive ) {
					$tabs_wrapper.find( '.wc-tab, .panel:not(.panel .panel)' ).hide();
				}

				if ( ! isActive ) {
					$accordion.closest( 'div' ).addClass( 'active' );
					$tabs_wrapper.find( $accordion.attr( 'href' ) ).show();
					if ( $tabs.length ) {
						$tabs.find( 'li' ).removeClass('active');
						$tabs.find( 'a[href="' + $accordion.attr( 'href' ) + '"]' ).closest( 'li').addClass( 'active' );
					}
				}
			});

		$('div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)').addClass('buttons_added').find('input[type="number"]').attr('type','text').wrap('<div class="quantity-inner">').parent().prepend('<button class="minus"><i class="genericon genericon-expand"></i></button>').append('<button class="plus"><i class="genericon genericon-collapse"></i></button>');

		$('.quantity.buttons_added').on('click', '.plus, .minus', function (e) {
			e.preventDefault();
			var $qty = $(this).closest('.quantity').find('.qty'),
				currentVal = parseFloat($qty.val()),
				max = parseFloat($qty.attr('max')),
				min = parseFloat($qty.attr('min')),
				step = $qty.attr('step');

			if (!currentVal || currentVal === '' || currentVal === 'NaN')
				currentVal = 0;
			if (max === '' || max === 'NaN')
				max = '';
			if (min === '' || min === 'NaN')
				min = 0;
			if (step === 'any' || step === '' || step === undefined || parseFloat(step) === 'NaN')
				step = 1;

			if ($(this).is('.plus')) {
				if (max && (max === currentVal || currentVal > max)) {
					$qty.val(max);
				} else {
					$qty.val(currentVal + parseFloat(step));
				}
			} else {
				if (min && (min === currentVal || currentVal < min)) {
					$qty.val(min);
				} else if (currentVal > 0) {
					$qty.val(currentVal - parseFloat(step));
				}
			}
			$qty.trigger('change');

		});

		// Count product categories.
		var $productList = $('.products');
		var $productCategory = $productList.find('.product-category');
		var $countProductCategory = $productCategory.length;

		if ( $countProductCategory > 0 ) {
			if ( 1 === $countProductCategory ) {
				$productCategory.addClass('grid__col grid__col--m-1-of-2 grid__col--12-of-12');
			} else if ( 2 === $countProductCategory ) {
				$productCategory.addClass('grid__col grid__col--m-1-of-2 grid__col--1-of-2');
			} else if ( 3 === $countProductCategory ) {
				$productCategory.addClass('grid__col grid__col--m-1-of-2 grid__col--1-of-3');
			} else {
				if ( $productList.hasClass('column-5') ) {
					$productCategory.addClass('grid__col grid__col--m-1-of-2 grid__col--1-of-3');
				} else {
					$productCategory.addClass('grid__col grid__col--m-1-of-2 grid__col--1-of-4');
				}
			}
		}

		// Add class if product removed from product widget woocommerce
		var $wooMessageFromWidget = $('.woocommerce-ordering').parent().find('.woocommerce-message');
		if ( $wooMessageFromWidget.length > 0 ) {
			$wooMessageFromWidget.prependTo('.shop-list-wrapper');
			$('.shop-list-wrapper .woocommerce-message').fadeIn().addClass('show');
		}

		// wrap dl & dt in mini-cart
		$('.variation dt').each(function() {
			var $dtMini = $(this),
			$selection = $dtMini.next('dd').addBack();
			$selection.wrapAll('<span>');
		});

		var $logoHeight = $('.site-title-container').height();
		$('.navigation-wrap').css({"height": $logoHeight + 'px', "opacity": "1"});

	});

	$( window ).resize(function() {

		var $hasHeaderYoutube = $('body').hasClass('has-header-youtube');
		if ( true === $hasHeaderYoutube ) {
			var $windowWidth = $('.custom-header').width();
			var $px = 900; //Breakpoint
			var $scaleValue = $windowWidth/$px;

			if ( $windowWidth > $px ) {
				$('.has-header-youtube .video-bg .video-fg').css('transform', 'scale(' + $scaleValue + ')');
			}
		}

	}).trigger('resize');

})(jQuery);
