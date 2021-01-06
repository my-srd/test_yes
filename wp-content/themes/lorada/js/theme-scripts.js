/**
 * Lorada Theme Scripts
 */
window.theme = {};

// Theme Configuration
(function(theme, $) {
	"use strict";

	theme = theme || {};

	$.extend(theme, {
		ajaxurl : js_lorada_vars.ajax_url,
		timer_days : js_lorada_vars.timer_days,
		timer_hours : js_lorada_vars.timer_hours,
		timer_mins : js_lorada_vars.timer_mins,
		timer_sec : js_lorada_vars.timer_sec,
		product_ajax_cart : js_lorada_vars.product_ajax_cart,
		shopping_mini_cart : js_lorada_vars.shopping_mini_cart,
		view_cart_after_added : js_lorada_vars.view_cart_after_added,
		product_carousel_auto_height : js_lorada_vars.product_carousel_auto_height,
		product_thumb_position : js_lorada_vars.product_thumb_position,
		product_img_zoom : js_lorada_vars.product_img_zoom,
		product_img_action : js_lorada_vars.product_img_action,
		upsells_product_column : js_lorada_vars.upsells_product_column,
		related_product_column : js_lorada_vars.related_product_column,
		view_all_results : js_lorada_vars.view_all_results,
		cookies_law_version : js_lorada_vars.cookies_law_version,
		promo_popup_enable : js_lorada_vars.promo_popup_enable,
		promo_popup_condition : js_lorada_vars.promo_popup_condition,
		promo_popup_delay : js_lorada_vars.promo_popup_delay,
		promo_popup_scroll : js_lorada_vars.promo_popup_scroll,
		promo_popup_page_num : js_lorada_vars.promo_popup_page_num,
		promo_popup_version : js_lorada_vars.promo_popup_version,
		promo_popup_mobile : js_lorada_vars.promo_popup_mobile,
		rtl : js_lorada_vars.rtl
	});
}).apply(this, [window.theme, jQuery]);

// Basic Functions
(function(theme, $) {
	"use strict";

	theme = theme || {};

	$.extend(theme, {
		basicFunctions: function() {
			// Vertical Menu Toggle
			$('.lorada-vertical-navigation .collection-menu-title').on('click', function(e) {
				$(this).toggleClass('collection-menu-dropped');
				$(this).next('.collection-menu-dropdown').toggleClass('menu-dropped');
			});

			$(document).on('click', 'body', function(e) {
				if ( $('.collection-menu-title.collection-menu-dropped').length > 0 && ! $(e.target).is('.collection-menu-title, .collection-menu-title *, .collection-menu-dropdown *') ) {
					$('.lorada-vertical-navigation .collection-menu-title').toggleClass('collection-menu-dropped');
					$('.lorada-vertical-navigation .collection-menu-title').next('.collection-menu-dropdown').toggleClass('menu-dropped');
				}
			});

			// Set Overlaid Header Top
			var headerFixedpos = 0;

			if ( $('.sticky-header-enable.header-clone').length > 0 ) {
				var headerHeight = $('header.main-header').height();

				headerFixedpos = headerHeight;
			}

			if ( $('#header-topbar').length > 0 ) {
				var topbarHeight = $('#header-topbar').height();

				if ( $('#page-wrapper').hasClass('lorada-header-overlap') ) {
					$('.lorada-header-overlap .main-header').css('top', topbarHeight);
				}

				headerFixedpos = headerFixedpos + topbarHeight;
			} else {
				if ( $('#page-wrapper').hasClass('lorada-header-overlap') ) {
					$('.lorada-header-overlap .main-header').css('top', '0px');
				}

				headerFixedpos = headerFixedpos + 0;
			}

			// Alternative Logo URL
			var alterURL = $('.site-logo a .sticky-logo').attr('src');
			var normalURL = $('.site-logo a .normal-logo').attr('src');
			var lightURL = $('.site-logo a .light-logo').attr('src');

			// Header Sticky Setting
			if ( ! $('#page-wrapper').hasClass('left_menu_bar_header') ) {
				$(window).scroll(function(e) {
					if ( $(this).scrollTop() > headerFixedpos ) {
						$('#page-wrapper .sticky-header-enable').addClass('page-scroll');
						$('.sticky-header-enable .site-logo a .normal-logo').attr('src', alterURL);
						$('.sticky-header-enable .site-logo a .light-logo').attr('src', alterURL);
					} else {
						$('#page-wrapper .sticky-header-enable').removeClass('page-scroll');
						$('.sticky-header-enable .site-logo a .normal-logo').attr('src', normalURL);
						$('.sticky-header-enable .site-logo a .light-logo').attr('src', lightURL);
					}
				});
			} else {
				$('#page-wrapper .sticky-header-enable').addClass('page-scroll');
				$('.sticky-header-enable .site-logo a .normal-logo').attr('src', alterURL);
				$('.sticky-header-enable .site-logo a .light-logo').attr('src', alterURL);
			}

			var orig_position = $(window).scrollTop();

			$(window).scroll(function(e) {
				var scroll_pos = $(window).scrollTop();

				if(scroll_pos > orig_position) {
					$('#page-wrapper .sticky-header-enable').removeClass('scroll-up').addClass('scroll-down');
				} else {
					$('#page-wrapper .sticky-header-enable').removeClass('scroll-down').addClass('scroll-up');
				}

				orig_position = scroll_pos;
			});

			// Mobile Header Setting
			function mobile_shopping_cart(width) {
				if ( $(window).width() < width ) {
					$('.lorada-shopping-cart').removeClass('lorada-cart-view-1').removeClass('lorada-cart-view-3')
					.addClass('lorada-cart-view-2');
				}
			}

			mobile_shopping_cart(600);
			$(window).resize(function(e) {
				mobile_shopping_cart(600);
			});

			// Mobile Menu Toggle
			$('.header-mobile-nav').off('click').on('click', function(e) {
				e.preventDefault();

				$('body').toggleClass('mobile-nav-active');
				$('#page-wrapper').toggleClass('sidebar-activated');

				return false;
			});

			$(document).on('click', 'body', function(e) {
				if ( $('.mobile-nav-active .mobile-nav').length > 0 && ! $(e.target).is('.mobile-nav-active .mobile-nav, .mobile-nav-active .mobile-nav *') ) {
					$('body').removeClass('mobile-nav-active');
					$('#page-wrapper').removeClass('sidebar-activated');
				}

				if ( $('.offcanvas-sidebar-desktop.sidebar-activated .show-hidden-sidebar').length > 0 && ! $(e.target).is('.offcanvas-sidebar-desktop.sidebar-activated .sidebar-container, .offcanvas-sidebar-desktop.sidebar-activated .sidebar-container *') ) {
					window.theme.hideShopSidebar();
				}
			});

			$('.lorada-mobile-nav .menu-item-has-children').append('<div class="drop-nav"><i class="lorada lorada-chevron-down"></i></div>');

			$('.lorada-mobile-nav').on('click', '.drop-nav', function(e) {
				e.stopPropagation();

				$(this).parent().toggleClass('active-submenu').children('.sub-menu-dropdown').toggleClass('opened');

				if ( $(this).parent().children('.sub-menu-dropdown').hasClass('opened') ) {
					$(this).parent().children('.sub-menu-dropdown').slideDown(300);
				} else {
					$(this).parent().children('.sub-menu-dropdown').slideUp(300);
				}
			});

			$('.mobile-navigation-tab').on('click', 'li', function(e) {
				$('.mobile-navigation-tab li').removeClass('active');
				$(this).addClass('active');
				$('.mobile-nav .mobile-navigation-tab-content').removeClass('active');

				if ( 'page-menu-nav' == $(this).attr('id') ) {
					$('.mobile-nav .mobile-page-menu').addClass('active');
				} else {
					$('.mobile-nav .mobile-category-menu').addClass('active');
				}
			});

			// WooCommerce - Account page
			$('.account-tab-item a').click( function(e) {
				e.preventDefault();

				$('.account-tab-item a').removeClass( 'active' );
				$(this).addClass( 'active' );

				var form = $(this).attr('href');

				$('.account-forms-container .account-form').removeClass('active');
				$(this).closest( '#customer_login' ).find(form).addClass('active');
			} );

			$(document).ajaxComplete(function() {
				if ( 'undefined' != typeof theme.ProductVariationSwatches ) {
					theme.ProductVariationSwatches.initialize();
				}

				$('.shop-loop-tools select.orderby').niceSelect();
			});

			// Select Tag Nice
			$('.shop-loop-tools select.orderby').niceSelect();
		},

		backToTop: function() {
			$(window).scroll(function() {
				if ( $(this).scrollTop() > 400 && ! $('.back-to-top').hasClass('is-visible') ) {
					$('.back-to-top').addClass('is-visible');
				}

				if ( $(this).scrollTop() < 400 && $('.back-to-top').hasClass('is-visible') ) {
					$('.back-to-top').removeClass('is-visible');
				}
			});

			$('body').off('click', '.back-to-top').on('click', '.back-to-top', function(e) {
				e.preventDefault();

				$('html, body').animate({scrollTop: 0}, 'slow');
				return false;
			});
		},

		shopInit: function() {
			if ( 'undefined' != typeof theme.ProductAddedCartLabel ) {
				theme.ProductAddedCartLabel.initialize();
			}

			if ( 'undefined' != typeof theme.ProductImgLazyLoad ) {
				theme.ProductImgLazyLoad.initialize();
			}

			if ( 'undefined' != typeof theme.ProductCountDown ) {
				theme.ProductCountDown.initialize();
			}

			if ( 'undefined' != typeof theme.CountDownResize ) {
				theme.CountDownResize.initialize();
			}

			if ( 'undefined' != typeof theme.ProductsFilterContent ) {
				theme.ProductsFilterContent.initialize();
			}

			if ( 'undefined' != typeof theme.SwitchVariationProductImg ) {
				theme.SwitchVariationProductImg.initialize();
			}

			if ( 'undefined' != typeof theme.WooPriceFilterSlider ) {
				theme.WooPriceFilterSlider.initialize();
			}

			if ( 'undefined' != typeof theme.SearchFormCatDropdown ) {
				theme.SearchFormCatDropdown.initialize();
			}

			if ( 'undefined' != typeof theme.AjaxAttrDropdownFilter ) {
				theme.AjaxAttrDropdownFilter.initialize();
			}

			if ( 'undefined' != typeof theme.showHiddenSidebar ) {
				theme.showHiddenSidebar();
			}

			if ( 'undefined' != typeof theme.productSubCatDropdown ) {
				theme.productSubCatDropdown();
			}

			if ( 'undefined' != typeof theme.ProductVariationSwatches ) {
				theme.ProductVariationSwatches.initialize();
			}

			if ( 'undefined' != typeof theme.WishlistBtn ) {
				theme.WishlistBtn.initialize();
			}

			if ( 'undefined' != typeof theme.CompareBtn ) {
				theme.CompareBtn.initialize();
			}

			if ( 'undefined' != typeof theme.ProductQty ) {
				theme.ProductQty.initialize();
			}

			if ( 'undefined' != typeof theme.WooNoticesAction ) {
				theme.WooNoticesAction.initialize();
			}

			if ( 'undefined' != typeof theme.WooOrdering ) {
				theme.WooOrdering.initialize();
			}

			if ( 'undefined' != typeof theme.WooCategoryDrop ) {
				theme.WooCategoryDrop.initialize();
			}

			if ( 'undefined' != typeof theme.GridColumnChange ) {
				$('.lorada-products-filter-element').each(function(index) {
					var $this = $(this),
						thisWrapper = $this.find('.products-filter-wrapper'),
						thisAtts = thisWrapper.data('atts'),
						thisInner = $this.find('.view-method-inner'),
						desktopCol = thisAtts['product_column'],
						tabletCol = thisAtts['product_column_tablet'],
						mobileCol = thisAtts['product_column_mobile'];

					if ( ! thisWrapper.hasClass('grid-view-method') ) return;

					theme.GridColumnChange.initialize( thisInner, desktopCol, tabletCol, mobileCol );
				});
			}

			if ( 'undefined' != typeof theme.AjaxTabCarousel ) {
				$('.elementor-widget-product_ajax_tabs').each(function(index) {
					theme.AjaxTabCarousel.initialize( $(this) );
				});
			}
		},

		ajaxTabInit: function() {
			if ( 'undefined' != typeof theme.ProductAddedCartLabel ) {
				theme.ProductAddedCartLabel.initialize();
			}

			if ( 'undefined' != typeof theme.ProductImgLazyLoad ) {
				theme.ProductImgLazyLoad.initialize();
			}

			if ( 'undefined' != typeof theme.ProductCountDown ) {
				theme.ProductCountDown.initialize();
			}

			if ( 'undefined' != typeof theme.CountDownResize ) {
				theme.CountDownResize.initialize();
			}

			if ( 'undefined' != typeof theme.SwitchVariationProductImg ) {
				theme.SwitchVariationProductImg.initialize();
			}

			if ( 'undefined' != typeof theme.WishlistBtn ) {
				theme.WishlistBtn.initialize();
			}

			if ( 'undefined' != typeof theme.CompareBtn ) {
				theme.CompareBtn.initialize();
			}

			if ( 'undefined' != typeof theme.GridColumnChange ) {
				$('.lorada-products-filter-element').each(function(index) {
					var $this = $(this),
						thisWrapper = $this.find('.products-filter-wrapper'),
						thisAtts = thisWrapper.data('atts'),
						thisInner = $this.find('.view-method-inner'),
						desktopCol = thisAtts['product_column'],
						tabletCol = thisAtts['product_column_tablet'],
						mobileCol = thisAtts['product_column_mobile'];

					if ( ! thisWrapper.hasClass('grid-view-method') ) return;

					theme.GridColumnChange.initialize( thisInner, desktopCol, tabletCol, mobileCol );
				});
			}

			if ( 'undefined' != typeof theme.AjaxTabCarousel ) {
				$('.elementor-widget-product_ajax_tabs').each(function(index) {
					theme.AjaxTabCarousel.initialize( $(this) );
				});
			}
		},

		ajaxFilters: function() {
			if ( ! $('#page-wrapper').hasClass( 'lorada-ajax-shop-on' ) || ! $('body').hasClass('woocommerce-page') || ! $('body').hasClass('archive') || 'undefined' == typeof ($.fn.pjax) ) {
				return;
			}

			var themeModule = this,
				filtersState = false,
				container, deviceOffset,
				containerWidth, containerHeight,
				containerLeftPos, scrollTop,
				btnShowTop, btnShowBottom,
				loadingAnim;

			var loadingPos = function() {
				container = $('.shop-content-area');
				loadingAnim = $('.shop-content-area .loading-effect');
				deviceOffset = $(window).height() / 2;
				containerWidth = container.width();
				containerHeight = container.height();
				containerLeftPos = container.offset().left;
				scrollTop = $(window).scrollTop();
				btnShowTop = container.offset().top - deviceOffset;
				btnShowBottom = btnShowTop + containerHeight;
				loadingAnim.css('left', containerLeftPos + (containerWidth / 2));

				if ( btnShowTop + 100 < scrollTop && btnShowBottom - 100 > scrollTop ) {
					loadingAnim.addClass('show-anim');
				} else {
					loadingAnim.removeClass('show-anim');
				}
			}

			loadingPos();
			$(window).scroll(function(e) {
				loadingPos();
			});

			$(document).on( 'click', '[class*="lorada-ajax-attribute-filter"] a, .lorada-product-categories a, .shop-products-per-page a, .shop-products-view .shop-view, .woocommerce-pagination a', function() {
				var action_url = $(this).attr('href');

				$.pjax({
					container: '.main-content-wrapper',
					fragment: '.main-content-wrapper',
					timeout: 5000,
					url: action_url,
					scrollTo: false
				});

				return false;
			} );


			$(document).on( 'click', '.widget_price_filter form .button', function() {
				var form = $( '.widget_price_filter form');

				$.pjax({
					container: '.main-content-wrapper',
					fragment: '.main-content-wrapper',
					timeout: 5000,
					url: form.attr('action'),
					data: form.serialize(),
					scrollTo: false
				});

				return false;
			} );

			$(document).on('pjax:error', function(xhr, textStatus, error, options) {
				console.log('pjax error ' + error);
			});

			$(document).on('pjax:start', function(xhr, options) {
				$('.shop-content-area').addClass('ajax-loading');
			});


			$(document).on('pjax:complete', function(xhr, textStatus, options) {
				themeModule.shopInit();
				pageScrollTop(true);

				$('.shop-content-area').removeClass('ajax-loading');
				loadingPos();
			});

			$(document).on('pjax:end', function(xhr, textStatus, options) {
				if ( filtersState ) {
					$( '.filters-area' ).css( 'display','block' );
					filtersState = false;
				}
			});

			var pageScrollTop = function(state) {
				if ( false == state ) {
					return false;
				}

				var topValue = $('.main-content-wrapper').offset().top - 150;

				$('html, body').stop().animate({
					scrollTop: topValue
				}, 500);
			}
		},

		showHiddenSidebar: function() {
			var themeModule = this;

			$('body').off('click', '.lorada-show-sidebar-btn, .mobile-sidebar-toggle-btn').on('click', '.lorada-show-sidebar-btn, .mobile-sidebar-toggle-btn', function() {
				if( $('.sidebar-container').hasClass('show-hidden-sidebar') ) {
					themeModule.hideShopSidebar();
				} else {
					showSidebar();
				}

				return false;
			});

			$(document).on('click', 'body', function(e) {
				if ( $(e.target).is('.close-side-widget') || $(e.target).is('#page-wrapper.sidebar-activated') ) {
					e.preventDefault();
					themeModule.hideShopSidebar();

					return false;
				}
			});

			var showSidebar = function() {
				$('.sidebar-container').addClass('show-hidden-sidebar');
				$('#page-wrapper').addClass('sidebar-activated');
			};

			$('.topside-filter-toggle > a').on('click', function(e) {
				e.preventDefault();

				$(this).toggleClass('toggled');
				$('.shop-content-area .topside-filter-widget').slideToggle(400);
			});
		},

		hideShopSidebar: function() {
			$('.sidebar-container').removeClass('show-hidden-sidebar');

			setTimeout(function() {
				$('#page-wrapper').removeClass('sidebar-activated');
			}, 300);
		},

		productSubCatDropdown: function() {
			var parentCategory = $('.widget_product_categories ul.product-categories li.cat-parent, .lorada-toolbar-product-cats-wrap .product-cats-list li.cat-parent');

			parentCategory.each(function(e) {
			    if ( $(this).hasClass('current-cat') || $(this).hasClass('current-cat-parent') ) {
			        $(this).removeClass('parent-close');
			        $(this).addClass('parent-open');
			    }

			    $(this).off('click').on('click', function(e) {
			        if ( ! $(this).hasClass('parent-open') ) {
			            $(this).removeClass('parent-close');
			            $(this).addClass('parent-open');
			            $(this).find('.children').slideDown(300);
			        } else {
			            $(this).removeClass('parent-open');
			            $(this).addClass('parent-close');
			            $(this).find('.children').slideUp(300);
			        }
			    });
			});
		},

		wooQuickView: function() {
			var self = this;

			var sliderFinalWidth = 470,
				maxQuickViewWidth = 910,
				allowClicks = true;

			$(document).on('click', '.quickview', function(event) {

				var $this = $(this),
					product_id = $(this).data('id'),
					selectedImage = $(this).parents('.product-content-item').find('.lorada-product-img-link img');

				$this.addClass('ajax-loading');

				$.ajax({
				url: theme.ajaxurl,
				data: {
					'action' : 'lorada_product_quickview',
					'pid' : product_id
				},
				success: function(results) {
					$('.lorada-quick-view').empty().html(results);
					animateQuickView(selectedImage, sliderFinalWidth, maxQuickViewWidth, 'open');

					if ( 'undefined' != typeof theme.ProductVariationSwatches ) {
						theme.ProductVariationSwatches.initialize();
					}
				},
				error: function(errorThrown) {
					console.log(errorThrown);
				},
				})
				.done(function() {
					$this.removeClass('ajax-loading');
				});
			});

			//close the quick view panel
			$(document).on('click', 'body', function(event) {
				if ( ( $(event.target).is('.quickview-close') || $(event.target).is('body.overlay-layer') ) && allowClicks === true ) {
					closeQuickView( sliderFinalWidth, maxQuickViewWidth );
				}
			});

			$(document).keyup(function(event) {
				if( '27' == event.which ) {
					closeQuickView( sliderFinalWidth, maxQuickViewWidth );
				}
			});

			$(window).on('resize', function() {
				if( $('.lorada-quick-view').hasClass('is-visible') ) {
					window.requestAnimationFrame(resizeQuickView);
				}
			});

			function resizeQuickView() {
				var quickViewLeft = ( $(window).width() - $('.lorada-quick-view').width() ) / 2,
					quickViewTop = ( $(window).height() - $('.lorada-quick-view').height() ) / 2;

				$('.lorada-quick-view').css({
					"top": quickViewTop,
					"left": quickViewLeft,
				});
			}

			function closeQuickView(finalWidth, maxQuickWidth) {
				var close = $('.quickview-close'),
				selectedImage = $('.empty-box').find('img');

				//update the image in the gallery
				if( ! $('.lorada-quick-view').hasClass('velocity-animating') && $('.lorada-quick-view').hasClass('add-content') ) {
					animateQuickView(selectedImage, finalWidth, maxQuickWidth, 'close');
				} else {
					if ( selectedImage.length > 0 ) {
						closeNoAnimation(selectedImage, finalWidth, maxQuickWidth);
					}
				}
			}

			function animateQuickView(image, finalWidth, maxQuickWidth, animationType) {
				var parentListItem = image.parents('.product-content-item'),
					topSelected = image.offset().top - $(window).scrollTop(),
					leftSelected = image.offset().left,
					widthSelected = image.width(),
					heightSelected = image.height(),
					windowWidth = $(window).width(),
					windowHeight = $(window).height(),
					finalLeft = (windowWidth - finalWidth) / 2,
					finalHeight = 440,
					finalTop = (windowHeight - finalHeight) / 2,
					quickViewWidth = maxQuickWidth ,
					quickViewLeft = (windowWidth - quickViewWidth) / 2;

				if( 'open' == animationType ) {

					$('body').addClass('overlay-layer');
					parentListItem.addClass('empty-box');

					$('.lorada-quick-view').css({
						"top": topSelected,
						"left": leftSelected,
						"width": widthSelected,
						"height": finalHeight
					})
					.velocity({
						'top': finalTop+ 'px',
						'left': finalLeft+'px',
						'width': finalWidth+'px',
					}, 1000, [100, 0], function() {
						$('.lorada-quick-view').addClass('animate-width').velocity({
							'left': quickViewLeft+'px',
							'width': quickViewWidth+'px',
						}, 300, 'ease', function(){
							$('.lorada-quick-view').addClass('add-content');

							var qvSlider = new Swiper('.lorada-quick-view .swiper-container', {
								pagination: {
									el: '.swiper-pagination',
									type: 'progressbar'
								},
								navigation: {
									nextEl: '.swiper-button-next',
									prevEl: '.swiper-button-prev',
								},
								preventClick: true,
								preventClicksPropagation: true,
								grabCursor: true,
								on: {
									touchStart: function() {
										allowClicks = false;
									},
									touchMove: function (){
										allowClicks = false;
									},
									touchEnd: function (){
										setTimeout( function() { allowClicks = true; }, 300 );
									}
								}
							});

							var form_variation = $('.lorada-quick-view').find('.variations_form');

							form_variation.wc_variation_form();
						});
					}).addClass('is-visible');

				} else {
					$('.lorada-quick-view').removeClass('add-content').velocity({
						'top': finalTop+ 'px',
						'left': finalLeft+'px',
						'width': finalWidth+'px',
					}, 300, 'ease', function(){
						$('body').removeClass('overlay-layer');
						$('.lorada-quick-view').removeClass('animate-width').velocity({
						'top': topSelected,
						'left': leftSelected,
						'width': widthSelected,
					}, 500, 'ease', function(){
						$('.lorada-quick-view').removeClass('is-visible');
						parentListItem.removeClass('empty-box');
					}); });
				}
			}

			function closeNoAnimation(image, finalWidth, maxQuickWidth) {
				var parentListItem = image.parents('.product-content-item'),
					topSelected = image.offset().top - $(window).scrollTop(),
					leftSelected = image.offset().left,
					widthSelected = image.width();

				$('body').removeClass('overlay-layer');
				parentListItem.removeClass('empty-box');

				$('.lorada-quick-view').velocity('stop').removeClass('add-content animate-width is-visible')
				.css({
					"top": topSelected,
					"left": leftSelected,
					"width": widthSelected,
				});
			}

			return self;
		},

		backPost: function() {
			history.go(-1);
		},

		fullScreenSearchForm: function() {
			"use strict";

			theme = theme || {};

			var $search_box = $('#lorada-full-screen-search');

			if ( $('#wpadminbar').length > 0 ) {
				var topPosition = $('#wpadminbar').height();
				$search_box.css('top', topPosition);
			}

			$('.search-form-full_screen > a').off('click').on('click', function(e) {
				e.preventDefault();

				if ( $search_box.hasClass('closed') ) {
					$search_box.removeClass('closed opened').addClass('opened');
					$search_box.find('input').focus();
					$('html').css('overflow-y', 'hidden');
				} else if ( $search_box.hasClass('opened') ) {
					$search_box.removeClass('closed opened').addClass('closed');
					$('html').css('overflow-y', 'auto');
				} else {
					$search_box.addClass('opened');
					$('html').css('overflow-y', 'hidden');
				}
			});

			$('#lorada-full-screen-search .form-close').off('click').on('click', function(e) {
				$search_box.removeClass('closed opened').addClass('closed');
				$('html').css('overflow-y', 'auto');
			});
		},

		cookiesPopup: function() {
			if ( typeof $.cookie === "undefined" ) {
				return;
			}

			var cookies_law_version = theme.cookies_law_version;

			if ( $.cookie( 'lorada_cookies_' + cookies_law_version ) == 'accepted' ) {
				return;
			}

			var popup = $( '.lorada-cookies-popup' );

			setTimeout( function() {
				popup.addClass( 'popup-display' );
				popup.on( 'click', '.accept-cookie-btn', function(e) {
					e.preventDefault();
					acceptCookies();
				} )
			}, 1000 );

			var acceptCookies = function() {
				popup.removeClass('popup-display').addClass('popup-hide');
				$.cookie( 'lorada_cookies_' + cookies_law_version, 'accepted', {
					expires: 60,
					path: '/'
				} );
			};
		},

		contentPopup: function() {
			var popUpBtn = $('.lorada-popup-btn');

			popUpBtn.magnificPopup({
				'type': 'inline',
				removalDelay: 350,
				callbacks: {
					beforeOpen: function() {
						this.st.mainClass = 'lorada-content-popup-wrap mfp-move-vertical';
					}
				}
			});
		},

		promoPopup: function() {
			if ( false == theme.promo_popup_enable || ( true == theme.promo_popup_mobile && $(window).width() < 580 ) ) {
				return;
			}

			var promo_version = theme.promo_popup_version,
				condition = false,
				pages = $.cookie('lorada_shown_pages');

			var popupShow = function() {
				$.magnificPopup.open({
					items: {
						src: '.lorada-promo-popup'
					},
					type: 'inline',
					removalDelay: 500,
					callbacks: {
						beforeOpen: function() {
							this.st.mainClass = 'lorada-promo-popup-wrap mfp-move-vertical';
						},
						close: function() {
							$.cookie( 'lorada_popup_' + promo_version, 'shown', { expires: 10, path: '/' } );
						}
					}
				});
			};

			if ( ! pages ) {
				pages = 0;
			}

			if ( pages < theme.promo_popup_page_num ) {
				pages++;
				$.cookie('lorada_shown_pages', pages, { expires: 10, path: '/' } );
				return false;
			}

			if ( $.cookie( 'lorada_popup_' + promo_version ) != 'shown' ) {

				if ( 'delay' == theme.promo_popup_condition ) {
					setTimeout(function() {
						popupShow();
					}, theme.promo_popup_delay);
				} else {
					$(window).scroll(function() {
						if ( condition ) {
							return false;
						}

						if ( theme.promo_popup_scroll <= $(document).scrollTop() ) {
							popupShow();
							condition = true;
						}
					});
				}
			}

			$('.lorada-newsletter-popup').on('click', function(e) {
				e.preventDefault();
				popupShow();
			});
		},

		blogInit: function() {
			var blogWrap = $('body.blog .lorada-blog-wrapper'),
				tagArchives = $('body.archive .lorada-blog-wrapper'),
				postWrap = $('.single-post-content .post-inner-content');

			if ( 'undefined' != typeof theme.BlogContentItemScript ) {
				theme.BlogContentItemScript.initialize(blogWrap);
				theme.BlogContentItemScript.initialize(tagArchives);
				theme.BlogContentItemScript.initialize(postWrap);
			}

			if ( 'undefined' != typeof theme.BlogMasonry ) {
				theme.BlogMasonry.initialize();
			}

			if ( 'undefined' != typeof theme.BlogLoadMore ) {
				theme.BlogLoadMore.initialize();
			}
		},

		lookBookSlide: function() {
			if ( $('.product-tabs-wrapper > div .wlb-lookbook-slide').length > 0 ) {
				$('.wlb-lookbook-slide').on('init', function(event, slick) {
		            /*Detect Popup Position*/
		            setTimeout(function() {
		                $(window).resize(function() {
		                    $('.wlb-lookbook-slide').each(function(index) {
		                        var sliderBottom = $(this).offset().top + $(this).height();

		                        $(this).find('.woocommerce-lookbook-inner .wlb-item').each(function(e) {
		                            var nodePosition = $(this).offset().top,
		                                contentHeight = $(this).find('.product-lookbook-content').outerHeight(),
		                                contentBottomPos = nodePosition + contentHeight;

		                            if ( sliderBottom < contentBottomPos ) {
		                                var diffPos = sliderBottom - contentBottomPos - 30;
		                                $(this).find('.product-lookbook-content').css('top', diffPos);
		                            }
		                        });
		                    });
		                });

		                $(window).trigger('resize');
		            }, 300);
		        });

		        $('.wlb-lookbook-slide').slick({
		            slidesToShow: 1,
		            slidesToScroll: 1,
		            infinite: true,
		            autoplay: false,
		            arrows: true,
		            fade: true
		        });
			}

			if ( $('.product-tabs-wrapper > div .wlb-lookbook-carousel').length > 0 ) {
				 /*Check responsive*/
		        var item_per_row = $('.wlb-lookbook-carousel').attr('data-col');

		        $('.wlb-lookbook-carousel .woocommerce-lookbook-inner').slick({
		            slidesToShow: item_per_row,
		            slidesToScroll: 1,
		            infinite: true,
		            responsive: [
		                {
		                    breakpoint: 1024,
		                    settings: {
		                        slidesToShow: 3
		                    }
		                },
		                {
		                    breakpoint: 768,
		                    settings: {
		                        slidesToShow: 2
		                    }
		                },
		                {
		                    breakpoint: 481,
		                    settings: {
		                        slidesToShow: 1
		                    }
		                }
		            ]
		        });
			}
		},

		initialize: function() {
			this.basicFunctions();
			this.backToTop();
			this.shopInit();
			this.ajaxFilters();
			this.wooQuickView();
			this.fullScreenSearchForm();
			this.cookiesPopup();
			this.contentPopup();
			this.promoPopup();
			this.blogInit();
			this.lookBookSlide();
		}
	});
}).apply(this, [window.theme, jQuery]);

// Button click when scroll page
(function(theme, $) {
	"use strict";

	theme = theme || {}	;

	$.extend(theme, {
		ClickBtnOnScroll : {
			initialize: function( $btnObject, $destroy, $offset ) {
				this.events( $btnObject, $destroy, $offset );
				return this;
			},

			events: function( btnObject, destroy, offset ) {
				if ( ( 'undefined' != typeof Waypoint ) && ( 'function' == typeof Waypoint ) ) {
					var btn = $(btnObject);

					if ( btn.length == 0 ) return;
					if ( ! offset ) offset = 0;

					var waypoint = new Waypoint({
						element: btn,
						handler: function(direction) {
							btn.trigger('click');
						},
						offset: $(window).outerHeight() - offset
					});
				}
			}
		}
	});
}).apply(this, [window.theme, jQuery]);

// Product Image LazyLoad
(function(theme, $) {
	"use strict";

	theme = theme || {};

	$.extend(theme, {
		ProductImgLazyLoad : {
			initialize: function() {
				this.events();
				return this;
			},

			events: function() {
				$('.products.products-grid, .products.products-list').each(function(index) {
					var $container = $(this);

					$container.imagesLoaded()
						.progress( onProgress );

					function onProgress( imgLoad, image ) {
						var $item = $(image.img).parent();
						$item.removeClass('is-loading');

						if ( !image.isLoaded ) {
							$item.addClass('is-broken');
						}
					}
				});
			}
		}
	});
}).apply(this, [window.theme, jQuery]);

// Product Added Cart Label
(function(theme, $) {
	"use strict";

	theme = theme || {};

	$.extend(theme, {
		ProductAddedCartLabel : {
			initialize: function() {
				this.events();
				return this;
			},

			events: function() {
				$( document.body ).on('wc_cart_button_updated', function(e, btn) {
					btn.next('.added_to_cart').html('<span class="down-triangle"></span>');
				});
			}
		}
	});
}).apply(this, [window.theme, jQuery]);

// Grid Column Change
(function(theme, $) {
	"use strict";

	theme = theme || {};

	$.extend(theme, {
		GridColumnChange : {
			initialize: function( $element, desktopCol, tabletCol, mobileCol ) {
				this.events( $element, desktopCol, tabletCol, mobileCol );
				return this;
			},

			events: function( element, desktopCol, tabletCol, mobileCol ) {
				var columnChange = function() {
					if ( $(window).width() >= 1026 ) {
						element.attr('data-column', desktopCol);
					} else if ( $(window).width() < 1026 && $(window).width() >= 740 ) {
						element.attr('data-column', tabletCol);
					} else if ( $(window).width() < 740 ) {
						element.attr('data-column', mobileCol);
					}
				}

				columnChange();
				$(window).resize(function(e) {
					columnChange();
				});
			}
		}
	});
}).apply(this, [window.theme, jQuery]);

// Ajax Tab Carousel
(function(theme, $) {
	"use strict";

	theme = theme || {};

	$.extend(theme, {
		AjaxTabCarousel : {
			initialize: function( $scope ) {
				this.events( $scope );
				return this;
			},

			events: function( $scope ) {
				var $this = $scope.find('.lorada-products-filter-element'),
					thisWrapper = $this.find('.products-filter-wrapper');

				if ( thisWrapper.hasClass( 'grid-view-method' ) ) return;

				var	thisInner = $this.find('.view-method-inner'),
					elementSettings = $scope.find('.lorada-elementor-products-ajax-tabs').data('atts'),
					thisAtts = thisWrapper.data('atts'),
					desktopCol = thisAtts['product_column'],
					tabletCol = thisAtts['product_column_tablet'],
					mobileCol = thisAtts['product_column_mobile'],
					navSpeed = elementSettings['nav_speed'],
					slideNav = ( 'true' == elementSettings['slider_nav'] ) ? true : false,
					dotsNav = ( 'true' == elementSettings['dots_nav'] ) ? true : false,
					loop = ( 'true' == elementSettings['slider_loop'] ) ? true : false,
					autoplay = ( 'true' == elementSettings['slider_auto'] ) ? true : false;

				thisInner.owlCarousel({
					items: desktopCol,
					nav: slideNav,
					dots: dotsNav,
					loop: loop,
					navSpeed: navSpeed,
					autoplay: autoplay,
					autoHeight: true,
					responsive: {
						1026: {
							items: desktopCol
						},
						767: {
							items: tabletCol
						},
						0: {
							items: mobileCol
						}
					}
				});
			}
		}
	});
}).apply(this, [window.theme, jQuery]);

// Product Ajax Single Tab
(function(theme, $) {
	"use strict";

	theme = theme || {};

	$.extend(theme, {
		ProductSingleTab : {
			initialize: function($scope) {
				this.events( $scope );
				return this;
			},

			events: function($scope) {
				var state = false,
					$this = $scope.find('.lorada-elementor-products-ajax-tabs'),
					cache = [],
					wrapper = $this.find('.lorada-tab-content'),
					arrowWidth = wrapper.find('.products-filter-nav .lorada-products-next').width();

				$this.find('.products-ajax-tab-title li').each(function(e) {
					if ( $(this).hasClass('actived-tab') && $(this).hasClass('pagination-arrow-top') ) {
						if ( theme.rtl ) {
							$(this).parent().css('margin-left', arrowWidth*2+50);
						} else {
							$(this).parent().css('margin-right', arrowWidth*2+50);
						}
					}
				});

				if ( wrapper.find('.owl-carousel').length < 1 ) {
					cache[0] = {
						html: wrapper.html()
					};
				}

				$this.find('.products-ajax-tab-title li').on('click', function(e) {
					e.preventDefault();

					var $this = $(this),
						tab_atts = $this.data('atts'),
						index = $this.index(),
						ajaxurl = theme.ajaxurl;

					if ( state || $this.hasClass('actived-tab') ) return;
					state = true;

					if ( $this.hasClass('pagination-arrow-top') ) {
						$(this).parent().css('margin-right', arrowWidth*2+50);
					} else {
						$(this).parent().css('margin-right', 0);
					}

					ajaxTab( tab_atts, wrapper, $this, cache, index, ajaxurl, function(data) {
						if ( data.html ) {
							wrapper.html(data.html);

							theme.shopInit();
						}
					} );
				});

				var ajaxTab = function( tab_atts, wrapper, btn, cache, index, ajaxurl, callback ) {
					btn.parent().find('.actived-tab').removeClass('actived-tab');
					btn.addClass('actived-tab');

					if ( cache[index] ) {
						wrapper.addClass('loading');

						setTimeout(function() {
							callback(cache[index]);
							wrapper.removeClass('loading');
							state = false;
						}, 300);

						return;
					}

					wrapper.addClass('loading').parent().addClass('tab-element-loading');
					btn.addClass('loading');

					$.ajax({
						url: ajaxurl,
						data: {
							atts: tab_atts,
							action: 'lorada_product_ajax_tab'
						},
						dataType: 'json',
						method: 'POST',
						success: function(data) {
							cache[index] = data;
							callback(data);
						},
						error: function(data) {
							console.log( 'Products Ajax Tab Loading Error.' );
						},
						complete: function() {
							wrapper.removeClass('loading').parent().removeClass('tab-element-loading');
							btn.removeClass('loading');
							state = false;
						}
					});
				}
			}
		}
	});
}).apply(this, [window.theme, jQuery]);

// Product Filter Content
(function(theme, $) {
	"use strict";

	theme = theme || {};

	$.extend(theme, {
		ProductsFilterContent : {
			initialize: function() {
				this.events();
				return this;
			},

			events: function () {
				var itemInterval,
					state = false;

				$('.lorada-products-filter-element').each(function(index) {
					var $this = $(this),
						cache = [],
						wrapper = $this.find('.products-filter-wrapper'),
						deviceOffset,
						containerWidth,
						containerHeight,
						containerLeftPos,
						scrollTop,
						btnShowTop,
						btnShowBottom,
						btnLeftPos,
						btnRightPos,
						arrowRTL = 'left',
						arrowWrap = $this.find('.arrow-navigation'),
						arrowLeft = arrowWrap.find('.lorada-products-prev'),
						arrowRight = arrowWrap.find('.lorada-products-next'),
						loadingAnim = $this.find('.loading-effect');

					if ( ! wrapper.is('div[class*="pagination-arrow"]') ) {
						return;
					}

					if ( theme.rtl ) {
						arrowRTL = 'right';
					}

					var navigationPos = function() {
						deviceOffset = $(window).height() / 2;
						containerWidth = $this.width();
						containerHeight = $this.height();
						containerLeftPos = $this.offset().left;
						scrollTop = $(window).scrollTop();
						btnShowTop = $this.offset().top - deviceOffset;
						btnShowBottom = btnShowTop + containerHeight;
						btnLeftPos = $this.offset().left - 75;
						btnRightPos = btnLeftPos + containerWidth + 125;
						arrowLeft.css(arrowRTL, btnLeftPos);
						arrowRight.css(arrowRTL, btnRightPos);
						loadingAnim.css('left', containerLeftPos + (containerWidth / 2));

						if ( btnShowTop < scrollTop && btnShowBottom > scrollTop ) {
							arrowWrap.addClass('show-arrow');
							loadingAnim.addClass('show-anim');
						} else {
							arrowWrap.removeClass('show-arrow');
							loadingAnim.removeClass('show-anim');
						}
					}

					navigationPos();
					$(window).scroll(function(e) {
						navigationPos();
					});

					cache[1] = {
						items: wrapper.find('.view-method-inner').html(),
						status: 'have-products'
					};

					$this.find('.lorada-products-prev, .lorada-products-next').off('click').on('click', function(e) {
						e.preventDefault();

						if ( $(this).hasClass('disabled') || state ) return;
						state = true;

						clearInterval(itemInterval);

						var $this = $(this),
							prev = $this.parent().find('.lorada-products-prev'),
							next = $this.parent().find('.lorada-products-next'),
							container = $this.parent().parent().prev(),
							atts = container.data('atts'),
							dataType = 'json',
							method = 'POST',
							pageNum = container.attr('data-page-num'),
							ajaxurl = theme.ajaxurl,
							action = 'lorada_products_filter';

						pageNum++;

						if ( $this.hasClass('lorada-products-prev') ) {
							if ( pageNum < 2 ) return;
							pageNum = pageNum - 2;
						}

						ajaxProducts( atts, container, ajaxurl, action, dataType, method, pageNum, 'arrow', $this, cache, function(data) {
							container.addClass('lorada-products-loaded');

							if ( data.items ) {
								container.find('.view-method-inner').html(data.items);
								container.attr('data-page-num', pageNum);

								theme.ajaxTabInit();
							}

							var itemCount = 0;
							itemInterval = setInterval(function() {
								container.find('.product-content-item').eq(itemCount).addClass('product-loaded');
								itemCount++;
							}, 50);

							if ( pageNum > 1 ) {
								prev.removeClass('disabled');
							} else {
								prev.addClass('disabled');
							}

							if ( 'no-more-products' == data.status ) {
								next.addClass('disabled');
							} else {
								next.removeClass('disabled');
							}
						} );
					});
				});

				if ( 'undefined' != typeof theme.ClickBtnOnScroll ) {
					theme.ClickBtnOnScroll.initialize( '.load-effect-scroll', false, 150 );
				}

				// LoadMore Btn action
				$('.lorada-products-load-more').off('click').on('click', function(e) {
					e.preventDefault();

					if ( state ) return;

					state = true;

					var $this = $(this),
						container = $this.parent().parent().prev(),
						atts = container.data('atts'),
						source    = $this.parent().siblings('.product-content-item-wrapper').data('source'),
						dataType = 'json',
						method = 'POST',
						pageNum = container.attr('data-page-num'),
						ajaxurl = theme.ajaxurl,
						action = 'lorada_products_filter';

					pageNum++;

					if ( source == 'main_loop' ) {
						ajaxurl   = $this.attr('href');
						method    = 'GET';
						container = $this.parent().siblings('.product-content-item-wrapper');
						action    = 'main_loop';
					}

					ajaxProducts( atts, container, ajaxurl, action, dataType, method, pageNum, 'more_btn', $this, [], function(data) {
						if ( data.items ) {
							container.find('.view-method-inner').append(data.items);
							container.attr('data-page-num', pageNum);

							theme.ajaxTabInit();

							container.imagesLoaded().progress(function() {
								if ( 'undefined' != typeof theme.ClickBtnOnScroll ) {
									theme.ClickBtnOnScroll.initialize( '.load-effect-scroll', true, 150 );
								}
							});
						}

						if ( 'main_loop' == action ) {
							$this.attr('href', data.nextPage);
						}

						if ( 'no-more-products' == data.status ) {
							$this.hide().remove();
						}
					} );
				});

				var ajaxProducts = function( atts, container, ajaxurl, action, dataType, method, pageNum, btnType, btn, cache, callback ) {
					var data = {
						action: action,
						atts: atts,
						pageNum: pageNum
					};

					if ( cache[pageNum] ) {
						container.addClass('loading');

						setTimeout(function() {
							callback( cache[pageNum] );
							container.removeClass('loading');
							state = false;
						}, 300);

						return;
					}

					if ( 'arrow' == btnType ) {
						container.addClass('loading').parent().addClass('products-loading');
					}

					btn.addClass('loading');

					if ( action == 'main_loop' ) {
						var loop = container.find('.product').last().data('loop');
						data = {
							loop: loop,
							ld_ajax: 1,
						};
					}

					$.ajax({
						url: ajaxurl,
						method: method,
						dataType: dataType,
						data: data,
						success: function(data) {
							cache[pageNum] = data;
							callback( data );
						},
						error: function(data) {
							console.log( 'Products Ajax Loading Error.' );
						},
						complete: function() {
							if ( 'arrow' == btnType ) {
								container.removeClass('loading').parent().removeClass('products-loading');
							}

							btn.removeClass('loading');
							state = false;
						}
					});
				}
			}
		}
	});
}).apply(this, [window.theme, jQuery]);

// Product Sale CountDown
(function(theme, $) {
	"use strict";

	theme = theme || {};

	$.extend(theme, {
		ProductCountDown : {
			initialize: function() {
				this.events();
				return this;
			},

			events: function() {
				$('.product-sale-countdown.countdown-timer').each(function() {
					var endTime = moment.tz( $(this).data('date-to'), $(this).data('timezone') );

					$(this).countdown( endTime.toDate(), function(event) {
						$(this).html( event.strftime( ''
							+ '<div class="time countdown-days">%-D <span>' + theme.timer_days + '</span></div>'
                            + '<div class="time countdown-hours">%H <span>' + theme.timer_hours + '</span></div>'
                            + '<div class="time countdown-min">%M <span>' + theme.timer_mins + '</span></div>'
                            + '<div class="time countdown-sec">%S <span>' + theme.timer_sec + '</span></div>'
						) );
					} );
				});
			}
		}
	});
}).apply(this, [window.theme, jQuery]);

// CountDown Template Resize
(function(theme, $) {
	"use strict";

	theme = theme || {};

	$.extend(theme, {
		CountDownResize : {
			initialize: function() {
				this.events();
				return this;
			},

			events: function() {
				function scaleResize() {
					$('.products .product').each(function(e) {
						if ( $(this).width() < 220 ) {
							$(this).find('.countdown-wrapper, .countdown-timer').addClass('scaled');
						} else {
							$(this).find('.countdown-wrapper, .countdown-timer').removeClass('scaled');
						}
					});
				}

				scaleResize();
				$(window).resize(function() {
					scaleResize();
				});
			}
		}
	});
}).apply(this, [window.theme, jQuery]);

// Variable Products Quick Shop on Content
(function(theme, $) {
	"use strict";

	theme = theme || {};

	$(document).on('click', '.product-quick-shop-enable.product-type-variable .add_to_cart_button', function(e) {
		e.preventDefault();

		var $this = $(this),
			variableProduct = $this.parents('.product').first(),
			productId = variableProduct.data('id'),
			quickShopForm = variableProduct.find('.shop-form-wrapper');

		if ( $this.hasClass('ajax-cart-loading') )
			return;

		if ( variableProduct.hasClass('ajax-shop-loaded') ) {
			variableProduct.addClass('ajax-shop-rendered');
			return;
		}

		$this.addClass('ajax-cart-loading');
		variableProduct.addClass('ajax-shop-loading-form');

		$.ajax({
			url: theme.ajaxurl,
			method: 'get',
			data: {
				action: 'lorada_variable_ajax_cart',
				id: productId
			},
			success: function(data) {
				quickShopForm.append(data);
				initializeVariationForm(variableProduct);

				if ( 'undefined' != typeof theme.ProductVariationSwatches ) {
					theme.ProductVariationSwatches.initialize();
				}
			},
			error: function() {
				console.log( 'Loading Ajax Shop From Error.' );
			},
			complete: function() {
				$this.removeClass('ajax-cart-loading');
				variableProduct.removeClass('ajax-shop-loading-form');
				variableProduct.addClass('ajax-shop-loaded ajax-shop-rendered');
			}
		});
	})
	.on('click', '.shop-form-close', function(e) {
		var $this = $(this),
			variableProduct = $this.parents('.product');

			variableProduct.removeClass('ajax-shop-rendered');
	});

	$(document).on('click', '.reset_variations', function(e) {
		var $this = $(this),
			cartBtn = $this.parents('form.cart').find('.button'),
			viewCartBtn = $this.parents('form.cart').find('.added_to_cart');

		cartBtn.removeClass('ajax-add-completed');
		viewCartBtn.addClass('hide-view-cart');
	});

	function initializeVariationForm( variableProduct ) {
		variableProduct.find('.variations_form').wc_variation_form().find('.variations select:eq(0)').change();
		variableProduct.find('.variations_form').trigger('wc_variation_form');
	}
}).apply(this, [window.theme, jQuery]);

// Ajax Add to Cart
(function(theme, $) {
	"use strict";

	theme = theme || {};

	if ( false == theme.product_ajax_cart ) return;

	$(document).on('submit', 'form.cart', function(e) {

		if ( $(this).hasClass('external-product-cart') ) {
			return;
		}

		e.preventDefault();

		var variationForm = $(this),
			submitBtn = variationForm.find('.button'),
			viewCartBtn = variationForm.find('.added_to_cart'),
			formData = variationForm.serialize();

		formData += '&action=lorada_ajax_add_to_cart';

		if ( submitBtn.val() ) {
			formData += '&add-to-cart=' + submitBtn.val();
		}

		submitBtn.removeClass('ajax-add-completed ajax-add-error');
		submitBtn.addClass('ajax-loading');

		// Event Trigger
		$(document.body).trigger( 'adding_to_cart', [ submitBtn, formData ] );

		$.ajax({
			url: theme.ajaxurl,
			method: 'POST',
			data: formData,
			success: function(response) {
				if ( ! response ) {
					return;
				}

				var currentPage = window.location.toString();
				currentPage = currentPage.replace( 'add-to-cart', 'added-to-cart' );

				if ( response.error && response.product_url ) {
					window.location = response.product_url;
					return;
				}

				// Redirect Cart Page Setting
				if ( 'yes' === wc_add_to_cart_params.cart_redirect_after_add ) {
					window.location = wc_add_to_cart_params.cart_url;
					return;
				} else {
					submitBtn.removeClass('ajax-loading');
					submitBtn.addClass('ajax-add-completed');
					viewCartBtn.removeClass('hide-view-cart');

					$(document.body).trigger( 'added_to_cart', [ response.fragments, response.cart_hash, submitBtn ] );
				}

			},
			error: function() {
				console.log( 'Ajax Cart Error.' );
			}
		});
	});
}).apply(this, [window.theme, jQuery]);

// Ajax Add to Cart handler
(function(theme, $) {
	"use strict";

	theme = theme || {};

	$(document.body).on('click', '.add_to_cart_button', function(e) {
		var $thisbutton = $( this );

		if ( $thisbutton.is( '.ajax_add_to_cart' ) ) {
			if ( ! $thisbutton.attr( 'data-product_id' ) ) {
				return true;
			}

			e.preventDefault();

			$thisbutton.removeClass( 'added' );
			$thisbutton.addClass( 'loading' );
		}
	});

	$( document ).on( 'added_to_cart', function(e, data) {
		if ( false != theme.shopping_mini_cart && false != theme.view_cart_after_added ) {
			$('.lorada-shopping-cart .cart-button:first').click();
		}
	} );
}).apply(this, [window.theme, jQuery]);

// Variable Product Swatches
(function(theme, $) {
	"use strict";

	theme = theme || {};

	$.extend(theme, {
		ProductVariationSwatches : {
			initialize: function() {
				this.events();
				return this;
			},

			events: function() {
				var variationForm = $('.variations_form');

				variationForm.each(function(e) {
					var $this = $(this);

					$('.lorada-swatch-inner[selected="selected"]').addClass('swatch-actived').attr('selected', false);

					if ( $('.select-swatches > div').hasClass('swatch-actived') ) {
						$this.addClass('variation-swatch-selected');
					}

					$this.on('click', '.lorada-swatch-inner', function() {
						var value = $(this).data('value');
						var attribute_id = $(this).parent().data('id');

						//$this.trigger( 'check_variations', [ 'attribute_' + attribute_id, true ] );
						//resetVariations($this);

						if ( $(this).hasClass('swatch-actived') || $(this).hasClass('disable-swatch') ) return;

						$this.find('select#' + attribute_id).val(value).trigger('change');
						$(this).parent().find('.swatch-actived').removeClass('swatch-actived');
						$(this).addClass('swatch-actived');

						resetVariations($this);
					})
					.on('click', '.reset_variations', function(e) {
						$this.find('.swatch-actived').removeClass('swatch-actived');
					})
					.on('reset_data', function() {
						var availableAllAttributes = true;

						$this.find('.variations select').each(function() {
							var value = $(this).val() || '';

							if ( value.length === 0 ) {
								availableAllAttributes = false;
							}
						});

						if ( availableAllAttributes ) {
							$(this).parent().find('.swatch-actived').removeClass('swatch-actived');
						}

						$this.removeClass('variation-swatch-selected');
						resetVariations($this);
					})
					.on('reset_image', function() {
						var thumbsImg = $('.images .thumbnails .product-thumbnail-wrap img').first();

						if ( 'left' != theme.product_thumb_position ) {
							thumbsImg.wc_reset_variation_attr('src');
						}
					})
					.on('show_variation', function(e, variation, purchasable) {
						var thumbsImg = $('.images .thumbnails .product-thumbnail-wrap img').first(),
							variationImg = variation.image.src;

						$this.addClass('variation-swatch-selected');

						if ( ! variationImg ) {
							return;
						}

						if ( 'left' != theme.product_thumb_position ) {
							thumbsImg.wc_set_variation_attr('src', variationImg);
						}
					});
				});

				var resetVariations = function( $variation_form ) {
					if ( ! $variation_form.data('product_variations') ) return;

					$variation_form.find('.variations select').each(function() {
						var variationSelect = $(this),
							swatchSelection = variationSelect.parent().find('.select-swatches'),
							selectOptions = variationSelect.html();

						selectOptions = $(selectOptions);

						swatchSelection.find('.lorada-swatch-inner').removeClass('enable-swatch').addClass('disable-swatch');
						selectOptions.each(function(e) {
							var value = $(this).val();

							if ( $(this).hasClass('enabled') ) {
								swatchSelection.find('div[data-value="' + value + '"]').removeClass('disable-swatch').addClass('enable-swatch');
							} else {
								swatchSelection.find('div[data-value="' + value + '"]').removeClass('enable-swatch').addClass('disable-swatch');
							}
						});
					});
				}
			}
		}
	});
}).apply(this, [window.theme, jQuery]);

// Switch Variable Product Image according to swatches
(function(theme, $) {
	"use strict";

	theme = theme || {};

	$.extend(theme, {
		SwitchVariationProductImg : {
			initialize: function() {
				this.events();
				return this;
			},

			events: function() {
				$('.product-attribute-inner[data-toggle="tooltip"]').tooltip();

				$('.product-attribute-inner').on('click', function() {
					var $this = $(this),
						swatch_image_src = $this.data('image-src'),
						swatch_image_srcset = $this.data('image-srcset'),
						swatch_image_sizes = $this.data('image-sizes'),
						product = $this.parents('.product-content-item'),
						product_img = product.find('.product-thumbs > .lorada-product-img-link img'),
						normal_src = product_img.data('normal-src'),
						normal_srcset = product_img.data('normal-srcset'),
						normal_sizes = product_img.data('normal-sizes'),
						switched_src,
						switched_srcset,
						switched_sizes;

					if ( 'undefined' == typeof swatch_image_src ) return;

					if ( 'undefined' == typeof normal_src ) {
						product_img.data('normal-src', product_img.attr('src'));
					}

					if ( 'undefined' == typeof normal_sizes ) {
						product_img.data('normal-sizes', product_img.attr('sizes'));
					}

					if ( 'undefined' == typeof normal_srcset ) {
						product_img.data('normal-srcset', product_img.attr('srcset'));
					}

					if ( $this.hasClass('swatch-actived') ) {
						switched_src = normal_src;
						switched_srcset = normal_srcset;
						switched_sizes = normal_sizes;
						product.removeClass('image-switched');
						$this.removeClass('swatch-actived');
					} else {
						$this.parent().find('.swatch-actived').removeClass('swatch-actived');
						$this.addClass('swatch-actived');
						product.addClass('image-switched');
						switched_src = swatch_image_src;
						switched_srcset = swatch_image_srcset;
						switched_sizes = swatch_image_sizes;
					}

					if ( switched_src == product_img.attr('src') ) return;

					product.addClass('image-loading');

					product_img.attr('src', switched_src).attr('srcset', switched_srcset)
								.attr('sizes', switched_sizes).one('load', function(e) {
									product.removeClass('image-loading');
								});
				});
			}
		}
	});
}).apply(this, [window.theme, jQuery]);

// WooCommerce Default Price Filter Widget Slider
(function(theme, $) {
	"use strict";

	theme = theme || {};

	$.extend(theme, {
		WooPriceFilterSlider : {
			initialize: function() {
				this.events();
				return this;
			},

			events: function() {
				// woocommerce_price_slider_params is required to continue, ensure the object exists
				if ( typeof woocommerce_price_slider_params === 'undefined' || $( '.price_slider_amount #min_price' ).length < 1 || ! $.fn.slider ) {
					return false;
				}

				var $slider = $( '.price_slider' );

				if ( $slider.slider('instance') !== undefined ) {
					return;
				}

				// Get markup ready for slider
				$( 'input#min_price, input#max_price' ).hide();
				$( '.price_slider, .price_label' ).show();

				// Price slider uses jquery ui
				var min_price         = $( '.price_slider_amount #min_price' ).data( 'min' ),
					max_price         = $( '.price_slider_amount #max_price' ).data( 'max' ),
					current_min_price = $( '.price_slider_amount #min_price' ).val(),
					current_max_price = $( '.price_slider_amount #max_price' ).val();

				$slider.slider({
					range: true,
					animate: true,
					min: min_price,
					max: max_price,
					values: [ current_min_price, current_max_price ],

					create: function() {
						$( '.price_slider_amount #min_price' ).val( current_min_price );
						$( '.price_slider_amount #max_price' ).val( current_max_price );

						$( document.body ).trigger( 'price_slider_create', [ current_min_price, current_max_price ] );
					},

					slide: function( event, ui ) {
						$( 'input#min_price' ).val( ui.values[0] );
						$( 'input#max_price' ).val( ui.values[1] );

						$( document.body ).trigger( 'price_slider_slide', [ ui.values[0], ui.values[1] ] );
					},

					change: function( event, ui ) {
						$( document.body ).trigger( 'price_slider_change', [ ui.values[0], ui.values[1] ] );
					}
				});

				setTimeout(function() {
					$( document.body ).trigger( 'price_slider_create', [ current_min_price, current_max_price ] );

					if ( $slider.find('.ui-slider-range').length > 1 ) {
						$slider.find('.ui-slider-range').first().remove();
					}
				}, 10);
			}
		}
	});
}).apply(this, [window.theme, jQuery]);

// Search Form Category Dropdown
(function(theme, $) {
 	"use strict";

	theme = theme || {};

	$.extend(theme, {
		SearchFormCatDropdown : {
			initialize: function() {
				this.events();
				return this;
			},

			events: function() {
				$('.search-by-category .search-dropdown-category-inner').each(function() {
					var drop_inner = $(this);
					var selected_cat = $(this).find('> a');
					var hidden_val = $(this).find('> input');
					var cat_list = $(this).find('> .category-list');

					$(document).on('click', function(e) {
						var target = e.target;

						if ( drop_inner.hasClass('dropped-list') && !$(target).is('.search-dropdown-category-inner') && !$(target).parents().is('.search-dropdown-category-inner') ) {
							drop_inner.removeClass('dropped-list');
							drop_inner.addClass('fold-up-list');

							return false;
						}
					});

					selected_cat.off('click').on('click', function(e) {
						e.preventDefault();

						if ( drop_inner.hasClass('dropped-list') ) {
							drop_inner.removeClass('dropped-list');
							drop_inner.addClass('fold-up-list');
						} else {
							drop_inner.addClass('dropped-list');
							drop_inner.removeClass('fold-up-list');
						}
					});

					cat_list.off('click', 'a').on('click', 'a', function(e) {
						e.preventDefault();

						var list_value = $(this).data('val');
						var list_label = $(this).text();
						cat_list.find('.current-cat').removeClass('current-cat');
						$(this).parent('li').addClass('current-cat');

						if ( 0 != list_value ) {
							cat_list.find('li:first-child').show();
						} else if ( 0 == list_value ) {
							cat_list.find(' ul.category-list-content > li:first-child').hide();
						}

						selected_cat.text(list_label);
						hidden_val.val(list_value).trigger('cat_changed');
						drop_inner.removeClass('dropped-list');
						drop_inner.addClass('fold-up-list');
					});
				});
			}
		}
	});
}).apply(this, [window.theme, jQuery]);

// Add filter function for Ajax product attribute dropdown
(function(theme, $) {
 	"use strict";

	theme = theme || {};

	$.extend(theme, {
		AjaxAttrDropdownFilter : {
			initialize: function() {
				this.events();
				return this;
			},

			events: function() {

				$('.lorada-ajax-attribute-filter').on( 'change', 'select', function() {
					var slug = $(this).val(),
						href = $(this).data('filter-url').replace( 'LORADA_FILTER_VALUE', slug );

					$(this).siblings( '.filter-pseudo-link' ).attr( 'href', href );

					var event,
						pseudoLink = $(this).siblings('.filter-pseudo-link');

					//This is true only for IE,firefox
					if(document.createEvent){
						// To create a mouse event , first we need to create an event and then initialize it.
						event = document.createEvent("MouseEvent");
						event.initMouseEvent("click",true,true,window,0,0,0,0,0,false,false,false,false,0,null);
					}
					else{
						event = new MouseEvent('click', {
							'view': window,
							'bubbles': true,
							'cancelable': true
						});
					}

					pseudoLink[0].dispatchEvent(event);
				} );
			}
		}
	});
}).apply(this, [window.theme, jQuery]);

// Blog Content Item Script
(function(theme, $) {
	"use strict";

	theme = theme || {};

	$.extend(theme, {
		BlogContentItemScript: {
			initialize: function($item) {
				this.events($item);
				return this;
			},

			events: function($item) {
				$item.find('.post-gallery-slider').each(function(index) {
					$(this).slick({
						draggable: false,
						dots: false,
						infinite: false,
						slidesToShow: 1,
						slidesToScroll: 1,
					});
				});

				$item.find('.featured-video-cover .play-button').each(function(index) {
					$(this).on('click', function(e) {
						e.preventDefault();

						$(this).parent('.cover-wrapper').addClass('video-playing');

						var videoURL = $(this).parent('.cover-wrapper').next('iframe').attr('src');
						var autoPlayURL = videoURL + '&autoplay=1&loop=1';

						$(this).parent('.cover-wrapper').next('iframe').attr( 'src', autoPlayURL );
					});
				});
			}
		}
	});
}).apply(this, [window.theme, jQuery]);

// Initialize Masonry mode for Blog
(function(theme, $) {
 	"use strict";

	theme = theme || {};

	$.extend(theme, {
		BlogMasonry : {
			initialize: function() {
				this.events();
				return this;
			},

			events: function() {
				if (typeof($.fn.isotope) == 'undefined' || typeof($.fn.imagesLoaded) == 'undefined') {
					return;
				}

				var $container = $('.display-masonry-grid .latest-post-inner');

				// initialize Masonry after all images have loaded
				$container.imagesLoaded(function() {
					$container.isotope({
						gutter: 0,
						isOriginLeft: ! $('body').hasClass('rtl'),
						itemSelector: '.blog-post-item'
					});
				});
			}
		}
	});
}).apply(this, [window.theme, jQuery]);

// "Load more" action for blog page
(function(theme, $) {
 	"use strict";

	theme = theme || {};

	$.extend(theme, {
		BlogLoadMore : {
			initialize: function() {
				this.events();
				return this;
			},

			events: function() {
				var btnClass = '.lorada-blog-load-more.load-on-scroll',
					process = false;

				theme.ClickBtnOnScroll.initialize( btnClass, false, false );

				$('.lorada-blog-load-more').off('click').on('click', function(e) {
					e.preventDefault();

					if( process ) return;

					process = true;

					var $this    = $(this),
						holder   = $this.parent().siblings('.lorada-blog-wrapper'),
						source   = holder.data('source'),
						action   = 'lorada_get_blog_' + source,
						ajaxurl  = theme.ajaxurl,
						dataType = 'json',
						method   = 'POST',
						atts     = holder.data('atts'),
						paged    = holder.data('paged');

					$this.addClass('loading');

					var data = {
						atts: atts,
						paged: paged,
						action: action
					};

					if( source == 'main_loop' ) {
						ajaxurl = $(this).attr('href');
						method  = 'GET';
						data    = {};
					}

					$.ajax({
						url: ajaxurl,
						data: data,
						dataType: dataType,
						method: method,
						success: function(data) {
							var items = $(data.items);

							if ( items ) {
								if ( holder.hasClass('display-masonry-grid') ) {
									// initialize Masonry after all images have loaded
									holder.find('.latest-post-inner').append(items).isotope( 'appended', items );
									holder.find('.latest-post-inner').imagesLoaded().progress(function() {
										holder.find('.latest-post-inner').isotope('layout');
										theme.ClickBtnOnScroll.initialize( btnClass, true, false );
									});
								} else {
									holder.find('.latest-post-inner').append(items);
									theme.ClickBtnOnScroll.initialize( btnClass, true, false );
								}

								holder.data('paged', paged + 1);

								if ( source == 'main_loop' ) {
									$this.attr('href', data.nextPage);

									if( data.status == 'no-more-posts' ) {
										$this.hide().remove();
									}
								}
							}

							if( data.status == 'no-more-posts' ) {
								$this.hide();
							}
						},

						error: function(data) {
							console.log('ajax error');
						},

						complete: function() {
							$this.removeClass('loading');
							process = false;
						},
					});
				});
			}
		}
	});
}).apply(this, [window.theme, jQuery]);

// WooCommerce Wishlist Button
(function(theme, $) {
	"use strict";

	theme = theme || {};

	$.extend(theme, {
		WishlistBtn: {
			initialize: function() {
				this.events();
				return this;
			},

			events: function() {
				$('.products .wishlist-button').off('click').on('click', function() {
					var $wishlist_btn = $(this);

					if ( $wishlist_btn.hasClass('add-to-wishlist') ) {
						// When click button to add product to wishlist
						$wishlist_btn.parent().find('a.add_to_wishlist').trigger('click');
						$wishlist_btn.removeClass('add-to-wishlist');
						$wishlist_btn.addClass('ajax-loading');

						var timer = -1;

						timer = setInterval(
							function() {
								if ( $wishlist_btn.parent().find('.yith-wcwl-wishlistaddedbrowse').length > 0 ) {
									$wishlist_btn.addClass('added-wishlist');
									$wishlist_btn.removeClass('ajax-loading');

									clearTimeout(timer);
								}
							},
							500
						);
					} else if ( $wishlist_btn.hasClass('added-wishlist') ) {
						// When click button to browser wishlist after added
						$wishlist_btn.parent().find('.yith-wcwl-wishlistaddedbrowse a')[0].click();
					} else if ( $wishlist_btn.hasClass('browse-wishlist') ) {
						// When click button to browse wishlist
						$wishlist_btn.parent().find('.yith-wcwl-wishlistexistsbrowse a')[0].click();
					}

					return true;
				});
			}
		}
	});
}).apply(this, [window.theme, jQuery]);

// Wishlist Ajax Count
(function(theme, $) {
	"use strict";

	theme = theme || {};

	$(document).on( 'added_to_wishlist removed_from_wishlist', function() {
		var counter = $('.header-wishlist .wishlist-count');

		$.ajax({
			url: yith_wcwl_l10n.ajax_url,
			data: {
				action: 'lorada_update_wishlist_count'
			},
			dataType: 'json',
			success: function( data ){
				counter.html( data.count );
			},
			beforeSend: function(){
				console.log('Updating wishlist count.');
			},
			complete: function(){
				console.log('Updated wishlist count.');
			}
		});
	} );
}).apply(this, [window.theme, jQuery]);

// WooCommerce Compare Button
(function(theme, $) {
	"use strict";

	theme = theme || {};

	$.extend(theme, {
		CompareBtn: {
			initialize: function() {
				this.events();
				return this;
			},

			events: function() {
				var compare = $('a.compare'),
					topPosition = 0;

				if ( $('#wpadminbar').length > 0 ) {
					topPosition = $('#wpadminbar').height();
				}

				$('body').on('click', 'a.compare', function() {
					$(this).addClass('ajax-loading');
				});

				$('body').on('yith_woocompare_open_popup', function() {
					compare.removeClass('ajax-loading');
					$('#cboxClose').css('top', topPosition);
					$('html').css('overflow-y', 'hidden');
				});

				$('body').on('click', '#cboxOverlay, #cboxClose', function() {
					$('html').css('overflow-y', 'auto');
				});
			}
		}
	});
}).apply(this, [window.theme, jQuery]);

// Product Image Gallery
(function(theme, $) {
	"use strict";

	theme = theme || {};

	var featuredImages = $('.woocommerce-product-gallery__image:eq(0) img'),
		thumbsWrap = $('.product-images .images .thumbnails'),
		featuredOwlWrap = $('.woocommerce-product-gallery__wrapper'),
		variationForm = $('.variations_form'),
		productMainSliderArgs = {
			rtl: ( theme.rtl ) ? true : false,
			items: 1,
			loop: false,
			dots: false,
			nav: true,
			autoHeight: ( true == theme.product_carousel_auto_height ) ? true : false,
			navText: false,
			onRefreshed: function() {
				$(window).resize();
			}
		};

	if ( 'left' == theme.product_thumb_position || 'bottom' == theme.product_thumb_position || 'without_thumbs' == theme.product_thumb_position ) {
		if ( true == theme.product_carousel_auto_height ) {
			$('.product-images').imagesLoaded(function() {
				initFeaturedCarousel();
			});
		} else {
			initFeaturedCarousel();
		}
	}

	if ( ( $(window).width() < 992 ) && ( 'img_list' == theme.product_thumb_position ) ) {
		featuredOwlWrap.addClass('owl-carousel');

		if ( true == theme.product_carousel_auto_height ) {
			$('.product-images').imagesLoaded(function() {
				initFeaturedCarousel();
			});
		} else {
			initFeaturedCarousel();
		}
	}

	if ( 'left' == theme.product_thumb_position || 'bottom' == theme.product_thumb_position ) {
		initProductThumbsConfig();

		if ( 'left' == theme.product_thumb_position ) {
			initProductVerticalThumbs();
		} else {
			initProductHorizontalThumbs();
		}
	}

	if ( 'img_list_thumbs' == theme.product_thumb_position ) {
		initProductThumbsConfig();

		thumbsWrap.find('.product-thumbnail-wrap:first-child').addClass('active');

		// Thumb gallery action
		thumbsWrap.find('.product-thumbnail-wrap').on('click', function(e) {
			var $this = $(this),
				indexVal = $this.data('index'),
				selectedMainImg = featuredOwlWrap.find('.product-image-wrap[data-index="' + indexVal + '"]'),
				imgPosition = selectedMainImg.offset().top;

			thumbsWrap.find('.product-thumbnail-wrap').removeClass('active');

			$('html, body').stop().animate({
				scrollTop: imgPosition - 80
			}, 500);
		});

		$(window).scroll(function(e) {
			var scrollPos = $(window).scrollTop();

			featuredOwlWrap.find('.product-image-wrap').each(function(index) {
				var $this = $(this),
					dataIndex = $this.data('index'),
					imgHeight = $this.outerHeight(),
					offsetTop = $this.offset().top - 81,
					offsetBottom = offsetTop + imgHeight / 2;


				if ( scrollPos > offsetTop && scrollPos < offsetBottom ) {
					thumbsWrap.find('.product-thumbnail-wrap').removeClass('active');
					thumbsWrap.find('.product-thumbnail-wrap[data-index="' + dataIndex + '"]').addClass('active');
				}
			});
		});

		// Thumb gallery sticky
		var stickyContent = $('.product-images .vertical-thumb-gallery'),
			stickyInner = stickyContent.find('.thumbnails'),
			mainImageList = stickyContent.parent().find('.main-gallery-list'),
			$offset = 10,
			$stickyHeader = $('.sticky-header-enable.header-clone');

		if ( $stickyHeader.length > 0 ) {
			$offset = $offset + $stickyHeader.outerHeight();
		}

		stickyInner.stick_in_parent({
			offset_top : $offset,
			recalc_every: 1
		});

		if ( $stickyHeader.length > 0 && $stickyHeader.hasClass('hide_sticky_scrolldown') ) {
			var orig_position = $(window).scrollTop();

			$(window).scroll(function(e) {
				var scroll_pos = $(window).scrollTop();

				stickyInner.on('sticky_kit:stick', function(e) {
					if ( scroll_pos > orig_position ) {
						$(e.target).addClass('scroll-down');
					} else {
						$(e.target).removeClass('scroll-down');
					}

					orig_position = scroll_pos;
				});

				stickyInner.on('sticky_kit:bottom', function(e) {
					$(e.target).removeClass('scroll-down');
				});
			});
		}
	}

	function initFeaturedCarousel() {
		featuredOwlWrap.owlCarousel(productMainSliderArgs);
	}

	function initProductThumbsConfig() {
		var html = '';

		$('.woocommerce-product-gallery__image').each(function(index) {
			var thumbsImg = $(this).data('thumb'),
				alt = $(this).find('.wp-post-image').attr('alt'),
				title = $(this).find('.wp-post-image').attr('title');

			html += '<div class="product-thumbnail-wrap" data-index="' + index + '"><img src="' + thumbsImg + '" alt="' + alt + '" title="' + title + '"/></div>';
		});

		thumbsWrap.append(html);
	}

	function initProductVerticalThumbs() {
		thumbsWrap.slick({
			slidesToShow: 4,
			slidesToScroll: 1,
			arrows: false,
			vertical: true,
			verticalSwiping: true,
			infinite: false,
			responsive: [
				{
					breakpoint: 992,
					settings: {
						arrows: false,
						vertical: false,
						verticalSwiping: false,
					}
				}
			]
		});

		thumbsWrap.on('click', '.product-thumbnail-wrap', function(e) {
			var i = $(this).index();
			featuredOwlWrap.trigger('to.owl.carousel', i);
		});

		featuredOwlWrap.on('changed.owl.carousel', function(e) {
			var i = e.item.index;

			thumbsWrap.slick('slickGoTo', i);
			thumbsWrap.find('.current-thumb').removeClass('current-thumb');
			thumbsWrap.find('.product-thumbnail-wrap').eq(i).addClass('current-thumb');
		});

		thumbsWrap.find('.product-thumbnail-wrap').eq(0).addClass('current-thumb');
	}

	function initProductHorizontalThumbs() {
		thumbsWrap.owlCarousel({
			rtl: ( theme.rtl ) ? true : false,
			items: 4,
			dots: false,
			nav: false,
			navText: false,
			responsive: {
				479: {
					items: 4
				},
				0: {
					items: 3
				}
			},
		});

		var thumbsOwl = thumbsWrap.owlCarousel();

		thumbsWrap.on('click', '.owl-item', function(e) {

			var i = $(this).index();
			featuredOwlWrap.trigger('to.owl.carousel', i);
			thumbsOwl.trigger('to.owl.carousel', i);
		});

		featuredOwlWrap.on('changed.owl.carousel', function(e) {
			var i = e.item.index;

			thumbsOwl.trigger('to.owl.carousel', i);
			thumbsWrap.find('.current-thumb').removeClass('current-thumb');
			thumbsWrap.find('.product-thumbnail-wrap').eq(i).addClass('current-thumb');
		});

		thumbsWrap.find('.product-thumbnail-wrap').eq(0).addClass('current-thumb');
	}

	$(window).resize(function() {
		if ( 'img_list' == theme.product_thumb_position ) {
			if ( $(window).width() < 991 ) {
				featuredOwlWrap.addClass('owl-carousel');

				if ( true == theme.product_carousel_auto_height ) {
					$('.product-images').imagesLoaded(function() {
						initFeaturedCarousel();
					});
				} else {
					initFeaturedCarousel();
				}
			} else {
				featuredOwlWrap.removeClass('owl-carousel');
				featuredOwlWrap.owlCarousel('destroy');
			}
		}
	});

	/* Carousel Switch in variation form */
	variationForm.on('show_variation', function(e, variation, purchasable) {
		featuredOwlWrap.trigger('to.owl.carousel', 0);
	});
}).apply(this, [window.theme, jQuery]);

// Sidebar Products Slider
(function(theme, $) {
	"use strict";

	theme = theme || {};

	var upsellsCol = parseInt(theme.upsells_product_column),
		relatedCol = parseInt(theme.related_product_column),
		upsellContainer = $('.upsells-widget .product_list_widget'),
		relatedContainer = $('.related-widget .product_list_widget');

	if ( 'undefined' != upsellsCol ) {
		upsellsCol = upsellsCol;
	} else {
		upsellsCol = 4;
	}

	if ( 'undefined' != relatedCol ) {
		relatedCol = relatedCol;
	} else {
		relatedCol = 4;
	}

	function sidebarSlickInit( container, col ) {
		container.slick({
			slidesToShow: col,
			slidesToScroll: 1,
			vertical: true,
			verticalSwiping: true,
			infinite: false,
			responsive: [
				{
					breakpoint: 992,
					settings: {
						slidesToShow: 4,
						vertical: false,
						verticalSwiping: false
					}
				},
				{
					breakpoint: 768,
					settings: {
						slidesToShow: 3,
						vertical: false,
						verticalSwiping: false
					}
				},
				{
					breakpoint: 481,
					settings: {
						slidesToShow: 2,
						vertical: false,
						verticalSwiping: false
					}
				},
				{
					breakpoint: 426,
					settings: {
						slidesToShow: 1,
						vertical: false,
						verticalSwiping: false
					}
				}
			]
		});
	}

	sidebarSlickInit( upsellContainer, upsellsCol );
	sidebarSlickInit( relatedContainer, relatedCol );
}).apply(this, [window.theme, jQuery]);

// After Single Product Slider
(function(theme, $) {
	"use strict";

	theme = theme || {};

	$('.after_single_product-slider, .after_product_cart-slider').each(function(index) {
		var $this = $(this),
			productCol = $this.data('columns');

		$this.slick({
			slidesToShow: productCol,
			slidesToScroll: 1,
			infinite: false,
			responsive: [
				{
					breakpoint: 992,
					settings: {
						slidesToShow: 3,
					}
				},
				{
					breakpoint: 768,
					settings: {
						slidesToShow: 2,
					}
				},
				{
					breakpoint: 426,
					settings: {
						slidesToShow: 1,
					}
				}
			]
		});
	});
}).apply(this, [window.theme, jQuery]);

// Product Image Zoom
(function(theme, $) {
	"use strict";

	theme = theme || {};

	if ( 'true' != theme.product_img_zoom ) {
		return false;
	}

	var zoomElement = $('.woocommerce-product-gallery__image'),
		zoomState = false;

	zoomElement.each(function( index, target ) {
		var mainImg = $(target).find('img');

		if ( $(target).width() < mainImg.data('large_image_width') ) {
			zoomState = true;

			$(this).trigger('zoom.destroy');
			$(this).zoom({
				touch: false
			});
		}
	});

	/* Reset Zoom Image in variation form */
	$('.variations_form').on('show_variation reset_image', function(e, variation, purchasable) {
		var zoomElement = $('.woocommerce-product-gallery__image:first-child'),
			image = zoomElement.find('a img');

		if ( $('.woocommerce-product-gallery').width() < image.data('large_image_width') ) {
			zoomElement.trigger('zoom.destroy');
			zoomElement.zoom({
				touch: false
			});
		}
	});
}).apply(this, [window.theme, jQuery]);

// Product Image PopUp
(function(theme, $) {
	"use strict";

	theme = theme || {};

	var productPhotoSwipe = '.product-image-enlarge-btn',
		productGalleryWrap = $('.woocommerce-product-gallery');

	if ( 'swipe_popup' == theme.product_img_action ) {
		productGalleryWrap.find( '.woocommerce-product-gallery__image').removeClass('woocommerce-product-gallery__image');

		setTimeout(function() {
			productGalleryWrap.find( '.product-image-wrap > div').addClass('woocommerce-product-gallery__image');
		}, 300);

		productPhotoSwipe += ', .woocommerce-product-gallery__image a';
	}

	var getGalleryItems = function() {
		var $slides = $('.woocommerce-product-gallery__wrapper .woocommerce-product-gallery__image'),
			items   = [];

		if ( $slides.length > 0 ) {
			$slides.each( function( i, el ) {
				var img = $( el ).find( 'a img' );

				if ( img.length ) {
					var large_image_src = img.attr( 'data-large_image' ),
						large_image_w   = img.attr( 'data-large_image_width' ),
						large_image_h   = img.attr( 'data-large_image_height' ),
						item            = {
							src  : large_image_src,
							w    : large_image_w,
							h    : large_image_h,
							title: img.attr( 'data-caption' ) ? img.attr( 'data-caption' ) : img.attr( 'title' )
						};
					items.push( item );
				}
			} );
		}

		return items;
	}

	productGalleryWrap.on('click', productPhotoSwipe, function(e) {
		e.preventDefault();

		var pswpElement = $( '.pswp' )[0],
			items       = getGalleryItems(),
			eventTarget = $( e.target ),
			galleryWrapper = $('.woocommerce-product-gallery__wrapper'),
			clicked;

		if ( galleryWrapper.hasClass('owl-carousel') ) {
			clicked = galleryWrapper.find('.owl-item.active');
		} else {
			clicked = eventTarget.closest( '.product-image-wrap' );
		}

		var options = $.extend( {
			index: $( clicked ).index()
		}, wc_single_product_params.photoswipe_options );

		// Initializes and opens PhotoSwipe.
		var photoswipe = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options );
		photoswipe.init();
	});
}).apply(this, [window.theme, jQuery]);

// Product 360deg View & Video
(function(theme, $) {
	"use strict";

	theme = theme || {};

	$('.lorada-product-360-view a').magnificPopup({
		type: 'inline',
		mainClass: 'mfp-fade',
		preloader: false,
		fixedContentPos: false,
		callbacks: {
		    open: function() {
		        $(window).resize()
		    },
		},
	});

	$('.lorada-product-video-view a').magnificPopup({
		type: 'iframe',
		iframe: {
			patterns: {
				youtube: {
					index: 'youtube.com/',
					id: 'v=',
					src: '//www.youtube.com/embed/%id%?rel=0&autoplay=1'
				},
				vimeo: {
					index: 'vimeo.com/',
					id: '/',
					src: '//player.vimeo.com/video/%id%?autoplay=1'
				},
			}
		},
		preloader: false,
		fixedContentPos: false
	});
}).apply(this, [window.theme, jQuery]);

// Product Content Sticky
(function(theme, $) {
	"use strict";

	theme = theme || {};

	if ( ! $('.single-content-product-area > div.product').hasClass('product-sticky-on') || $(window).width() <= 1024 ) {
		return;
	}

	var stickyContent = $('.entry-summary');

	stickyContent.each(function() {
		var $this = $(this),
			$inner = $this.find('.product-summary-inner'),
			$productImg = $this.parent().find('.product-images-inner'),
			$offset = 70,
			$stickyHeader = $('.sticky-header-enable.header-clone');

		if ( $stickyHeader.length > 0 ) {
			$offset = $offset + $stickyHeader.outerHeight();
		}

		$productImg.imagesLoaded(function() {
			var diffHeight = $productImg.outerHeight() - $inner.outerHeight();

			if ( 0 < diffHeight ) {
				$inner.stick_in_parent({
					offset_top : $offset,
					recalc_every: 1
				});
			} else if ( 0 > diffHeight ) {
				$productImg.stick_in_parent({
					offset_top : $offset,
					recalc_every: 1
				});
			}

			$(window).resize(function() {
				if ( $(window).width() <= 1024 ) {
					$inner.trigger('sticky_kit:detach');
					$productImg.trigger('sticky_kit:detach');
				} else if ( 0 < diffHeight ) {
					$inner.stick_in_parent({
						offset_top : $offset,
						recalc_every: 1
					});
				} else {
					$productImg.stick_in_parent({
						offset_top : $offset,
						recalc_every: 1
					});
				}
			});

			if ( $stickyHeader.length > 0 && $stickyHeader.hasClass('hide_sticky_scrolldown') ) {
				var orig_position = $(window).scrollTop();

				$(window).scroll(function(e) {
					var scroll_pos = $(window).scrollTop();

					if ( 0 < diffHeight ) {
						$inner.on('sticky_kit:stick', function(e) {
							if ( scroll_pos > orig_position ) {
								$(e.target).addClass('scroll-down');
							} else {
								$(e.target).removeClass('scroll-down');
							}

							orig_position = scroll_pos;
						});

						$inner.on('sticky_kit:bottom', function(e) {
							$(e.target).removeClass('scroll-down');
						});
					} else if ( 0 > diffHeight ) {
						$productImg.on('sticky_kit:stick', function(e) {
							if ( scroll_pos > orig_position ) {
								$(e.target).addClass('scroll-down');
							} else {
								$(e.target).removeClass('scroll-down');
							}

							orig_position = scroll_pos;
						});

						$productImg.on('sticky_kit:bottom', function(e) {
							$(e.target).removeClass('scroll-down');
						});
					}
				});
			}
		});
	});
}).apply(this, [window.theme, jQuery]);

// Woocommerce Notices Action
(function(theme, $) {
	"use strict";

	theme = theme || {};

	$.extend(theme, {
		WooNoticesAction : {
			initialize: function() {
				this.events();
				return this;
			},

			events: function() {
				var wooNotices = '.woocommerce-error, .woocommerce-info, .woocommerce-message, #yith-wcwl-popup-message, .yith_ywraq_add_item_product_message, div.wpcf7-response-output, .mc4wp-alert, .dokan-store-contact .alert-success';

				$('body').off('click', wooNotices).on('click', wooNotices, function() {
					$(this).slideToggle(300);
				});
			}
		}
	});
}).apply(this, [window.theme, jQuery]);

// Woocommerce Ordering Action
(function(theme, $) {
	"use strict";

	theme = theme || {};

	$.extend(theme, {
		WooOrdering : {
			initialize: function() {
				this.events();
				return this;
			},

			events: function() {
				$('.woocommerce-ordering').on('change', 'select.orderby', function() {
					$(this).closest('form').find('[name="_pjax"]').remove();
					$(this).closest('form').submit();
				});
			}
		}
	});
}).apply(this, [window.theme, jQuery]);

// Shop Category Dropdown
(function(theme, $) {
	"se strict";

	theme = theme || {};

	$.extend(theme, {
		WooCategoryDrop : {
			initialize: function() {
				this.events();
				return this;
			},

			events: function() {
				$('.lorada-show-categories').off('click', 'a').on('click', 'a', function(e) {
					e.preventDefault();

					$(this).parent().toggleClass('category-shown');
					$(this).parent().next('.lorada-product-categories').slideToggle(300);
				});
			}
		}
	});
}).apply(this, [window.theme, jQuery]);

// Product Quantity Field
(function(theme, $) {
	"use strict";

	theme = theme || {};

	$.extend(theme, {
		ProductQty: {
			initialize: function() {
				this.events();
				return this;
			},

			events: function() {
				/* Target quantity inputs on product pages */
				$('input.qty:not(.product-quantity input.qty)').each(function() {
					var min = parseFloat( $(this).attr('min') );

					if ( min && min > 0 && parseFloat( $(this).val() ) < min ) {
						$(this).val(min);
					}
				});

				$(document).off('click', '.qty-btn.minus-btn, .qty-btn.plus-btn').on('click', '.qty-btn.minus-btn, .qty-btn.plus-btn', function(e) {
					/* Get values */
					var $qty = $(this).closest('.quantity-inner').find('.qty'),
						currentVal = parseFloat( $qty.val() ),
						max = parseFloat( $qty.attr('max') ),
						min = parseFloat( $qty.attr('min') ),
						step = $qty.attr('step');

					/* Format Values */
					if ( ! currentVal || '' == currentVal ) {
						currentVal = 0;
					}

					if ( '' == max || 'NaN' == max ) {
						max = '';
					}

					if ( '' == min || 'NaN' == min ) {
						min = 0;
					}

					if ( '' == step || 'NaN' == parseFloat( step ) ) {
						step = 1;
					}

					/* Change the Value */
					if ( $(this).hasClass('plus-btn') ) {
						if ( max && ( max == currentVal || currentVal > max ) ) {
							$qty.val(max);
						} else {
							$qty.val( currentVal + parseFloat(step) );
						}
					} else {
						if ( min && ( min == currentVal || currentVal < min ) ) {
							$qty.val(min);
						} else {
							$qty.val( currentVal - parseFloat(step) );
						}
					}

					/* Trigger Change Event */
					$qty.trigger('change');
				});
			}
		}
	});
}).apply(this, [window.theme, jQuery]);

// Product Tab Accordion
(function(theme, $) {
	"use strict";

	theme = theme || {};

	var productAccordion = $('.wc-tabs-wrapper'),
		hash = window.location.hash,
		url = window.location.href;

	if ( '#tab-reviews' === hash || '#reviews' == hash ||  hash.toLowerCase().indexOf('comment-') >= 0 ) {
		productAccordion.find('.tab-title-reviews').addClass('active');
	} else if ( url.indexOf('cpage=') > 0 || url.indexOf('comment-page-') > 0 ) {
		productAccordion.find('.tab-title-reviews').addClass('active');
	} else {
		productAccordion.find('.product-accordion-title').first().addClass('active');
	}

	productAccordion.on('click', '.product-accordion-title', function(e) {
		e.preventDefault();

		var $this = $(this),
			tabPanel = $this.next('.woocommerce-Tabs-panel'),
			currentIndex = $this.parent().index(),
			prevIndex = $this.parent().siblings().find('.active').parent('.product-tab-wrapper').index();

		if ( $this.hasClass('active') ) {
			prevIndex = currentIndex;
			$this.removeClass('active');
			tabPanel.stop().slideUp(300);
		} else {
			productAccordion.find('.product-accordion-title').removeClass('active');
			productAccordion.find('.woocommerce-Tabs-panel').slideUp();
			$this.addClass('active');
			tabPanel.stop().slideDown(300);
		}

		if ( -1 == prevIndex ) {
			prevIndex = currentIndex;
		}
	});
}).apply(this, [window.theme, jQuery]);

// Full Ajax Search
(function(theme, $) {
	"use strict";

	theme = theme || {};

	var escapeRegExChars = function(value) {
			return value.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
		};

	$('.lorada-search-form form.lorada-ajax-search').each(function() {
		var $this = $(this),
			viewNumber = parseInt( $this.data('count') ),
			postType = $this.data('post_type'),
			thumbnail = parseInt( $this.data('thumbnail') ),
			price = parseInt( $this.data('price') ),
			productCat = $this.find('[name="product_cat"]'),
			searchResult = $this.parent().find('.lorada-search-result'),
			url = theme.ajaxurl + '?action=lorada_ajax_search',
			suggestionURL = '';

		searchResult.on('click', '.view-all-results', function() {
			$this.submit();
		});

		$this.submit(function(e) {
			if ( suggestionURL.length > 0 ) {
				e.preventDefault();

				window.location.href = suggestionURL;
			}
		});

		if ( viewNumber > 0 ) {
			url += '&viewNumber=' + viewNumber;
		}

		url += '&post_type=' + postType;

		if ( '' !== productCat.val() && productCat.length ) {
			url += '&product_cat=' + productCat.val();
		}

		$this.find('[type="text"]').devbridgeAutocomplete({
			serviceUrl: url,
			appendTo: searchResult,
			onSelect: function(suggestion) {
				if ( suggestion.permalink.length > 0 ) {
					window.location.href = suggestion.permalink;
				}
			},
			onSearchStart: function(query) {
				$this.addClass('ajax-search-loading');
				$('#lorada-full-screen-search').addClass('form-loading');
			},
			beforeRender: function(container) {
				if ( container[0].childElementCount == viewNumber ) {
					$(container).append('<div class="view-all-results"><span>' + theme.view_all_results + '</span></div>');
				}
			},
			onSearchComplete: function(query, suggestions) {
				$this.removeClass('ajax-search-loading');
				$('#lorada-full-screen-search').removeClass('form-loading');

				if ( 1 == suggestions.length && suggestions[0].permalink.length > 0 ) {
					suggestionURL = suggestions[0].permalink;
				} else {
					suggestionURL = '';
				}
			},
			formatResult: function(suggestion, currentValue) {
				if ( '&' == currentValue ) {
					currentValue = "&#038;";
				}

				var pattern = '(' + escapeRegExChars(currentValue) + ')',
					returnValue = '';

				if( thumbnail && suggestion.thumbnail ) {
					returnValue += ' <div class="suggestion-thumb">' + suggestion.thumbnail + '</div>';
				}

				returnValue += '<div class="suggestion-title title">' + suggestion.value
					.replace(new RegExp(pattern, 'gi'), '<strong>$1<\/strong>')
					.replace(/</g, '&lt;')
					.replace(/>/g, '&gt;')
					.replace(/"/g, '&quot;')
					.replace(/&lt;(\/?strong)&gt;/g, '<$1>') + '</div>';

				if ( suggestion.no_found ) {
					returnValue = '<div class="suggestion-title no-result-msg">' + suggestion.value + '</div>';
				}

				if( price && suggestion.price ) {
					returnValue += ' <div class="suggestion-price price">' + suggestion.price + '</div>';
				}

				return returnValue;
			}
		});

		if ( productCat.length ) {
			var searchForm = $this.find( '[type="text"]' ).devbridgeAutocomplete(),
				serviceUrl = theme.ajaxurl + '?action=lorada_ajax_search';

			if( viewNumber > 0 ) {
				serviceUrl += '&viewNumber=' + viewNumber;
			}

			serviceUrl += '&post_type=' + postType;

			productCat.on( 'cat_changed', function() {
				if( '' != productCat.val() ) {
					searchForm.setOptions({
						serviceUrl: serviceUrl + '&product_cat=' + productCat.val()
					});
				}else{
					searchForm.setOptions({
						serviceUrl: serviceUrl
					});
				}

				searchForm.hide();
				searchForm.onValueChange();
			});
		}

		$('.lorada-search-result').on('click', function(e) {
			e.stopPropagation();
		});

		$('body').on('click', function() {
			$this.find('[type="text"]').devbridgeAutocomplete( 'hide' );
		});
	});
}).apply(this, [window.theme, jQuery]);

// Mini-Cart Dropdown Action
(function(theme, $) {
	"use strict";

	theme = theme || {};

	$('.lorada-shopping-cart.mini-cart-dropdown').each(function() {

		var $this = $(this),
			cartBtn = $this.find('.cart-button');

		cartBtn.off('click').on('click', function(e) {
			e.preventDefault();

			var $miniCartContain = $(this).parent().find('.mini-cart-container');

			if ( $miniCartContain.hasClass('closed') ) {
				$miniCartContain.removeClass('closed opened').addClass('opened');
			} else if ( $miniCartContain.hasClass('opened') ) {
				$miniCartContain.removeClass('closed opened').addClass('closed');
			} else {
				$miniCartContain.addClass('opened');
			}

			return false;
		});
	});

	$(document).keyup(function(event) {
		if( '27' == event.which ) {
			if ( $('.mini-cart-container.opened').length > 0 ) {
				event.preventDefault();

				$('.mini-cart-container.opened').removeClass('closed opened').addClass('closed');
			}
		}
	});

	$(document).on('click', 'body', function(e) {
		if ( $('.mini-cart-container.opened').length > 0 && ! $(e.target).is('.mini-cart-container.opened *') ) {
			$('.mini-cart-container.opened').removeClass('closed opened').addClass('closed');
		}
	});

}).apply(this, [window.theme, jQuery]);

// Mini-Cart Sidebar Action
(function(theme, $) {
	"use strict";

	theme = theme || {};

	$('.lorada-shopping-cart.mini-cart-side-bar').each(function() {
		$(this).on('click', '.cart-button', function(e) {
			e.preventDefault();

			if ( ! $('.lorada-sidebar-mini-cart').hasClass('sidebar-open') ) {
				$('.lorada-sidebar-mini-cart').addClass('sidebar-open');
				$('body').addClass('dark-overlay');
			} else {
				$('.lorada-sidebar-mini-cart').removeClass('sidebar-open');
				$('body').removeClass('dark-overlay');
			}
		});
	});

	$('.lorada-mobile-toolbar .lorada-toolbar-cart > a').on('click', function(e) {
		e.preventDefault();

		if ( ! $('.lorada-sidebar-mini-cart').hasClass('sidebar-open') ) {
			$('.lorada-sidebar-mini-cart').addClass('sidebar-open');
			$('body').addClass('dark-overlay');
		} else {
			$('.lorada-sidebar-mini-cart').removeClass('sidebar-open');
			$('body').removeClass('dark-overlay');
		}
	});

	$('.lorada-sidebar-mini-cart .close-sidebar').on('click', function(e) {
		e.preventDefault();

		$('.lorada-sidebar-mini-cart').removeClass('sidebar-open');
		$('body').removeClass('dark-overlay');
	});

	$(document).on('click', 'body', function(e) {
		if ( $(e.target).is('.lorada-sidebar-mini-cart .close-sidebar') || $(e.target).is('body.dark-overlay') ) {
			e.preventDefault();

			$('.lorada-sidebar-mini-cart').removeClass('sidebar-open');
			$('body').removeClass('dark-overlay');
		}
	});

	$(document).keyup(function(event) {
		if( '27' == event.which ) {
			if ( $('.lorada-sidebar-mini-cart.sidebar-open').length > 0 ) {
				event.preventDefault();

				$('.lorada-sidebar-mini-cart.sidebar-open').removeClass('sidebar-open');
				$('body').removeClass('dark-overlay');
			}
		}
	});
}).apply(this, [window.theme, jQuery]);

// Product Add to Cart Sticky
(function(theme, $) {
	"use strict";

	theme = theme || {};

	if ( ! $('body').hasClass( 'single-product' ) || $('.lorada-grouped-products').length > 0 || ! $('.product-summary-inner form .single_add_to_cart_button').length || ! $('.lorada-sticky-add-cart-wrap').length ) {
		return;
	}

	var cartBtnPos = $('.product-summary-inner form .single_add_to_cart_button').offset().top;

	$(window).scroll(function(e) {
		var nearBottom = $(document).height() - $(window).height() - 90;

		if ( ( $(this).scrollTop() > cartBtnPos ) && ( $(this).scrollTop() < nearBottom ) ) {
			$('.lorada-sticky-add-cart-wrap').addClass('sticky-enable');
			$('.back-to-top').addClass('sticky-add-cart');
		} else {
			$('.lorada-sticky-add-cart-wrap').removeClass('sticky-enable');
			$('.back-to-top').removeClass('sticky-add-cart');
		}
	});
}).apply(this, [window.theme, jQuery]);

// Mobile Categories Sidebar Action
(function(theme, $) {
	"use strict";

	theme = theme || {};

	var mobileCatIcon = $('.lorada-mobile-toolbar .lorada-toolbar-categories > a'),
		catSidebar = $('.lorada-toolbar-product-cats-wrap'),
		closeIcon = $('.lorada-toolbar-product-cats-wrap .close-sidebar');

	mobileCatIcon.off('click').on('click', function(e) {
		e.preventDefault();

		if ( ! catSidebar.hasClass('sidebar-open') ) {
			catSidebar.addClass('sidebar-open');
			$('body').addClass('dark-overlay');
		} else {
			catSidebar.removeClass('sidebar-open');
			$('body').removeClass('dark-overlay');
		}
	});

	closeIcon.on('click', function(e) {
		e.preventDefault();

		catSidebar.removeClass('sidebar-open');
		$('body').removeClass('dark-overlay');
	});

	$(document).on('click', 'body', function(e) {
		if ( $('.lorada-toolbar-product-cats-wrap.sidebar-open').length > 0 && ! $(e.target).is('.lorada-mobile-toolbar .lorada-toolbar-categories, .lorada-mobile-toolbar .lorada-toolbar-categories *, .lorada-toolbar-product-cats-wrap, .lorada-toolbar-product-cats-wrap *') ) {
			e.preventDefault();

			catSidebar.removeClass('sidebar-open');
			$('body').removeClass('dark-overlay');
		}
	});
}).apply(this, [window.theme, jQuery]);

// Lorada Initialize
(function(theme, $) {
	$(document).ready( function() {
		theme.initialize();
	} ) ;
}).apply(this, [window.theme, jQuery]);
