<?php
add_filter( 'moon_shop_head_css', 'Moon_Shop_theme_color_css' );
function Moon_Shop_theme_color_css() {
	// change theme color
	$moon_shop_optionsValue = get_option( 'moon_shop' );

	//for page title section
	$moon_shop_title = isset($moon_shop_optionsValue['moon-shop-page-title-background-select']) ? $moon_shop_optionsValue['moon-shop-page-title-background-select'] : 'background-color';
	$moon_shop_title_bc = isset($moon_shop_optionsValue['moon-shop-page-title-background-color']) ? $moon_shop_optionsValue['moon-shop-page-title-background-color']["background-color"] : '';

	//for archive page title section
	$moon_shop_archive_title = isset($moon_shop_optionsValue['moon-shop-blog-archive-background-select']) ? $moon_shop_optionsValue['moon-shop-blog-archive-background-select'] : 'background-color';
	$moon_shop_archive_title_bc = isset($moon_shop_optionsValue['moon-shop-blog-archive-background-color']) ? $moon_shop_optionsValue['moon-shop-blog-archive-background-color']["background-color"] : '';

	//for index page title section
	$moon_shop_index_title = isset($moon_shop_optionsValue['moon-shop-blog-index-background-select']) ? $moon_shop_optionsValue['moon-shop-blog-index-background-select'] : 'background-color';
	$moon_shop_index_title_bc = isset($moon_shop_optionsValue['moon-shop-blog-index-background-color']["background-color"]) ? $moon_shop_optionsValue['moon-shop-blog-index-background-color']["background-color"] : '';
	$moon_shop_swatch_width = isset($moon_shop_optionsValue['moon-shop-swatch-width']) ? $moon_shop_optionsValue['moon-shop-swatch-width'] : 32;

	//color controller
	$moon_shop_custom_color = isset($moon_shop_optionsValue['moon-shop-deafult-colors']) ? $moon_shop_optionsValue['moon-shop-deafult-colors'] : '1';
	if ($moon_shop_custom_color == '1') {
		$moon_shop_theme_color = '#e2214b';
	} else if ($moon_shop_custom_color == '2') {
		$moon_shop_theme_color = '#1e73be';
	} else if ($moon_shop_custom_color == '3') {
		$moon_shop_theme_color = '#f57c00';
	} else if ($moon_shop_custom_color == '4') {
		$moon_shop_theme_color = '#ab47bc';
	} else if ($moon_shop_custom_color == '5') {
		$moon_shop_theme_color = '#e67fb9';
	} else if ($moon_shop_custom_color == '6') {
		$moon_shop_theme_color = '#00acc1';
	} else if ($moon_shop_custom_color == '7') {
		$moon_shop_theme_color = '#8b82d5';
	} else if ($moon_shop_custom_color == '8') {
		$moon_shop_theme_color = '#43a047';
	} else if ($moon_shop_custom_color == '9') {
		$moon_shop_theme_color = '#ab8b65';
	} else if ($moon_shop_custom_color == '10') {
		$moon_shop_theme_color = (isset($moon_shop_optionsValue['moon-shop-theme-color-options']) && $moon_shop_optionsValue['moon-shop-theme-color-options'] != '') ? $moon_shop_optionsValue['moon-shop-theme-color-options'] : '#e2214b';
	}

	$moon_shop_selection_color = isset($moon_shop_optionsValue['moon-shop-selectin-hightlight-color']) ? $moon_shop_optionsValue['moon-shop-selectin-hightlight-color'] : '';
	$moon_shop_selection_back_color = isset($moon_shop_optionsValue['moon-shop-selectin-hightlight-back-color']) ? $moon_shop_optionsValue['moon-shop-selectin-hightlight-back-color'] : '';

	$output = '';
	$output .= '::-moz-selection {
		    color: '.$moon_shop_theme_color.';
		    background: transparent;
		}
		::selection {
		    color: '.$moon_shop_theme_color.';
		    background: transparent;
		}
		::-moz-selection {
		    color: '.$moon_shop_selection_color.';
		    background: '.$moon_shop_selection_back_color.';
		}
		::selection {
		    color: '.$moon_shop_selection_color.';
		    background: '.$moon_shop_selection_back_color.';
		}
		.theme-light.introLoader.simpleLoader {
		  background-color: '.$moon_shop_theme_color.';
		}
		.doubleLoader.theme-light .doubleLoaderProgBar span {
		  background-color: '.$moon_shop_theme_color.';
		}
		.theme-fluoGreen.introLoader.counterLoader {
		  background-color: '.$moon_shop_theme_color.';
		}
		.theme-fluoGreen.introLoader.counterLoader .counterLoaderBox {
		  background-color: #fff;
		  color: '.$moon_shop_theme_color.';
		}
		a:hover {
		  color: '.$moon_shop_theme_color.';
		}
		.language-currency > li > a:hover, #menu-top-menu li a:hover, .header-contact-info li a:hover {
		  color: '.$moon_shop_theme_color.';
		}
		.main-menu nav > ul > li > a::before {
		  background: '.$moon_shop_theme_color.' none repeat scroll 0 0;
		}
		.main-menu .sub-menu > li > a:hover {
		  color: '.$moon_shop_theme_color.';
		}
		.header-cart .cart-btn .cart-number {
		  background: '.$moon_shop_theme_color.' none repeat scroll 0 0;
		}
		.headercart-wrapper .products .content p.price {
		  color: '.$moon_shop_theme_color.';
		}
		.headercart-wrapper .products .content h3 a:hover {
		  color: '.$moon_shop_theme_color.';
		}
		.headercart-wrapper .products .remove:hover {
		  color: '.$moon_shop_theme_color.';
		}
		.headercart-wrapper .view-cart a:hover {
		  color: '.$moon_shop_theme_color.';
		}
		.headercart-wrapper .cart-footer a:hover {
		  background: '.$moon_shop_theme_color.' none repeat scroll 0 0;
		}
		.links a:hover {
		  color: '.$moon_shop_theme_color.';
		}
		.pro-tab-list li::before {
		  background: '.$moon_shop_theme_color.' none repeat scroll 0 0;
		}
		.woocommerce span.pro-label.great-deal, .woocommerce span.pro-label.hot-deal, .modal-container span.pro-label.great-deal, .modal-container span.pro-label.hot-deal {
		  background: '.$moon_shop_theme_color.' none repeat scroll 0 0;
		}
		.pro-content h3 a:hover, .pro-content a:hover h3 {
		  color: '.$moon_shop_theme_color.';
		}
		.pro-cat:hover {
		  color: '.$moon_shop_theme_color.';
		}
		.woocommerce ul.products li.product .sin-product:hover .onsale {
		  color: '.$moon_shop_theme_color.';
		}
		.pro-hover {
		  background: '.$moon_shop_theme_color.' none no-repeat scroll 0 0 / cover ;
		}
		.slick-arrow:hover {
		  color: '.$moon_shop_theme_color.';
		}
		.blog-item .blog-content h2 a:hover {
		  color: '.$moon_shop_theme_color.';
		}
		.blog-item .blog-image a::after {
		  background: '.$moon_shop_theme_color.' none repeat scroll 0 0;
		}
		.subscribe-form input[type="submit"]:hover {
		  background: '.$moon_shop_theme_color.' none repeat scroll 0 0;
		}
		.footer-area ul.product_list_widget .product-title:hover {
		  color: '.$moon_shop_theme_color.';
		}
		#scrollUp {
		  color: '.$moon_shop_theme_color.';
		}
		.sin-product:hover .pro-image span.pro-label {
		    color: '.$moon_shop_theme_color.';
		}
		/* Shop css */';
		if($moon_shop_title == 'background-color' && $moon_shop_title_bc == '') {
			$output .= '.page-banner {
				background: '.$moon_shop_theme_color.' none repeat scroll 0 0;
			}';
		}
		if($moon_shop_archive_title == 'background-color' && $moon_shop_archive_title_bc == '') {
			$output .= '.archive-banner {
				background: '.$moon_shop_theme_color.' none repeat scroll 0 0;
			}';
		}
		if($moon_shop_index_title == 'background-color' && $moon_shop_index_title_bc == '') {
			$output .= '.blog-banner {
				background: '.$moon_shop_theme_color.' none repeat scroll 0 0;
			}';
		}
		$output .= '.product-categories li ul li a:hover {
		  color: '.$moon_shop_theme_color.';
		}
		.shop-sidebar .price_slider_wrapper .price_slider_amount button.button:hover {
		  background-color: '.$moon_shop_theme_color.';
		}
		.woocommerce .widget_price_filter .ui-slider .ui-slider-handle {
		  border: 2px solid '.$moon_shop_theme_color.';
		}
		.view-mode li.active a {
		  color: '.$moon_shop_theme_color.';
		}
		.woocommerce nav.woocommerce-pagination ul.page-numbers li a:hover, .woocommerce nav.woocommerce-pagination ul.page-numbers li span.current, .page-links a:hover span, .page-links span, nav.pagination a:hover, nav.pagination .current {
		  color: '.$moon_shop_theme_color.';
		}
		.model-close {
		  background: '.$moon_shop_theme_color.' none repeat scroll 0 0;
		}
		.woocommerce .single_variation_wrap .woocommerce-variation-add-to-cart button.button-cart:hover, .woocommerce form.cart button.button-cart:hover, .woocommerce p.cart a.button-cart:hover {
		  background: '.$moon_shop_theme_color.' none repeat scroll 0 0;
		}
		.yith-wcwl-add-to-wishlist .yith-wcwl-wishlistaddedbrowse a.like i, .yith-wcwl-add-to-wishlist .yith-wcwl-wishlistexistsbrowse a.like i, .yith-wcwl-add-to-wishlist .yith-wcwl-add-button a.like i {
		  color: '.$moon_shop_theme_color.';
		}
		.releted a:hover {
		  color: '.$moon_shop_theme_color.';
		}
		.pro-info-tab-list li.active a {
		  border-color: '.$moon_shop_theme_color.';
		}
		.moon-form .input-box input[type="submit"]:hover, .post-password-form input[type="submit"]:hover {
		  background: '.$moon_shop_theme_color.' none repeat scroll 0 0;
		}
		.out-of-stock .availabity a {
		  color: '.$moon_shop_theme_color.';
		}
		.woocommerce .product-info div.pro-info-price .price ins span,
		.woocommerce .product-info div.pro-info-price .price ins {
		  color: '.$moon_shop_theme_color.';
		}
		.cart-page-tablist ul li a.active .number {
		  background: '.$moon_shop_theme_color.' none repeat scroll 0 0;
		}
		.table-cart .cart-item-content .title a:hover {
		  color: '.$moon_shop_theme_color.';
		}
		.cart-page-container table.table-cart .update-btn:hover {
		  background: '.$moon_shop_theme_color.' none repeat scroll 0 0;
		}
		.woocommerce .shipping-cost input[type="submit"]:hover {
		  background: '.$moon_shop_theme_color.' none repeat scroll 0 0;
		}
		.payment-details table.shop_table tbody tr.cart-total > td span {
		  color: '.$moon_shop_theme_color.';
		}
		.payment-details .wc-proceed-to-checkout.procced-checkout a.checkout-btn:hover {
		  background: '.$moon_shop_theme_color.' none repeat scroll 0 0;
		}
		.woocommerce .woocommerce-info {
		  border-top-color: '.$moon_shop_theme_color.';
		}
		.order-total .amount, .order-total .amount span {
		  color: '.$moon_shop_theme_color.';
		}
		.order-details #order_review .place-order .place-order-btn:hover, .woocommerce .place-order a.place-order-btn:hover {
		  background: '.$moon_shop_theme_color.' none repeat scroll 0 0;
		}
		.vc_column-inner .product.woocommerce a.button:hover {
		  background-color: '.$moon_shop_theme_color.';
		}
		/* blog css */
		.sin-blog .blog-image a:hover {
		  color: '.$moon_shop_theme_color.';
		}
		.sin-blog .blog-details .blog-cat, .blog-categories .blog-cat {
		  background: '.$moon_shop_theme_color.' none repeat scroll 0 0;
		}
		.sin-blog .blog-details .title a:hover {
		  color: '.$moon_shop_theme_color.';
		}
		.sin-blog .blog-details .blog-meta a:hover {
		  color: '.$moon_shop_theme_color.';
		}
		.more-product a.shop-link {
		  color: '.$moon_shop_theme_color.';
		}
		.recent-post-text a:hover {
		  color: '.$moon_shop_theme_color.';
		}
		.recent-com ul li a:hover,
		#recentcomments li a:hover	{
		  color: '.$moon_shop_theme_color.';
		}
		.blog-cat ul li a:hover, .widget_nav_menu ul li a:hover, .widget_rss ul li a:hover, .widget_pages ul li a:hover, .widget_meta ul li a:hover, .widget_recent_entries ul li a:hover {
		  color: '.$moon_shop_theme_color.';
		}
		.post-tag-share .post-share a:hover {
		  color: '.$moon_shop_theme_color.';
		}
		.prev-next-post .prev-post a:hover, .prev-next-post .next-post a:hover {
		  color: '.$moon_shop_theme_color.';
		}
		.sin-comment .comment-details .bottom .reply:hover {
		  background: '.$moon_shop_theme_color.' none repeat scroll 0 0;
		}
		/* pages css */
		blockquote {
		  border-left: 4px solid '.$moon_shop_theme_color.';
		}
		.wpcf7-form input[type="submit"]:hover {
		  background: '.$moon_shop_theme_color.' none repeat scroll 0 0;
		}
		.error-404 a:hover {
		  background: '.$moon_shop_theme_color.' none repeat scroll 0 0;
		}
		.blog-item .blog-image a::before {
	  		background: '.$moon_shop_theme_color.' none repeat scroll 0 0;
	  	}
	  	.close:focus, .close:hover {
	  		color: '.$moon_shop_theme_color.';
	  	}
	  	.sin-blog-post .blog-details .blog-meta a:hover {
		  color: '.$moon_shop_theme_color.';
		}
		.prev-next-buttons > a:hover{
		  background-color: '.$moon_shop_theme_color.';
		}
		table.shop_table tfoot .yith-wcwl-share ul li a:hover {
		  color: '.$moon_shop_theme_color.';
		}
		.woocommerce .wishlist_table td.product-add-to-cart a.button:hover {
		  background: '.$moon_shop_theme_color.' none repeat scroll 0 0;
		}
		.shop-sidebar .widget_shopping_cart_content .buttons a.checkout:hover {
		  background-color: '.$moon_shop_theme_color.';
		}
		.woocommerce-MyAccount-content p a:hover {
		  color: '.$moon_shop_theme_color.';
		}
		.product-cat > ul > li.collapsable > a, .product-cat > ul > li > a:hover {
		  color: '.$moon_shop_theme_color.';
		}
		.woocommerce-MyAccount-navigation.product-cat > ul > li.is-active > a {
		  color: '.$moon_shop_theme_color.';
		}
		.woocommerce-MyAccount-content table.table-cart tbody tr td.order-actions .view:hover, 
		.woocommerce-MyAccount-content table.table-cart tbody tr td.download-actions .download:hover, 
		.woocommerce-MyAccount-content .woocommerce-Message a.woocommerce-Button:hover, 
		.woocommerce .woocommerce-MyAccount-content .col2-set a.edit:hover {
		  background: '.$moon_shop_theme_color.' none repeat scroll 0 0;
		}
		.woocommerce-MyAccount-content table.table-cart tbody tr td a:hover {
		  color: '.$moon_shop_theme_color.';
		}
		.header-cart .headercart-wrapper ul.products p.price span {
		  color: '.$moon_shop_theme_color.';
		}
		.woocommerce-product-rating .woocommerce-review-link:hover {
		  color: '.$moon_shop_theme_color.';
		}
		.headercart-wrapper .buttons .button:first-child:hover {
			color: '.$moon_shop_theme_color.';
			background-color: transparent;
		}
		.headercart-wrapper .buttons .button.checkout:hover {
			background-color: '.$moon_shop_theme_color.';
		}
		.woocommerce .widget_layered_nav ul li a:hover {
			color: '.$moon_shop_theme_color.';
		}
		span.moon-menu-badge {
			background-color: '.$moon_shop_theme_color.';
		}
		span.moon-menu-badge:before {
			border-color: '.$moon_shop_theme_color.';
		}
		.active-swatch:after {
			background-color: '.$moon_shop_theme_color.';
		}
		.with-swatches .moon-shop-swatch {
			width: '.$moon_shop_swatch_width.'px; height: '.$moon_shop_swatch_width.'px;
		}';
		$moon_shop_rgba = fnn_hex2RGB($moon_shop_theme_color);
		$output .= '@media all and (-ms-high-contrast: none), (-ms-high-contrast: active) {
		    .pro-hover {
		        background: rgba('.$moon_shop_rgba['red'].','.$moon_shop_rgba['green'].','.$moon_shop_rgba['blue'].',0.75) none !important;
		    }
		}
		@supports (-ms-accelerator:true) {
		    .pro-hover {
		        background: rgba('.$moon_shop_rgba['red'].','.$moon_shop_rgba['green'].','.$moon_shop_rgba['blue'].',0.75; ?>) none !important;
		    }
		}
		/*loader section*/';

		$moon_shop_preloader_desktop_display = isset($moon_shop_optionsValue['moon-shop-preloader-enable-desktop']) ? $moon_shop_optionsValue['moon-shop-preloader-enable-desktop'] : '1';
		$moon_shop_preloader_tab_display = isset($moon_shop_optionsValue['moon-shop-preloader-enable-tab']) ? $moon_shop_optionsValue['moon-shop-preloader-enable-tab'] : '1';
		$moon_shop_preloader_mobile_display = isset($moon_shop_optionsValue['moon-shop-preloader-enable-mobile']) ? $moon_shop_optionsValue['moon-shop-preloader-enable-mobile'] : '1';
		if ($moon_shop_preloader_desktop_display != '1') {
			$output .= '@media only screen and (min-width: 991px) {
				#element.introLoading {
					display: none !important;
				}
			}';
		} if ($moon_shop_preloader_tab_display != '1') {
			$output .= '@media only screen and (max-width: 991px) and (min-width: 768px) {
				#element.introLoading {
					display: none !important;
				}
			}';
		} if ($moon_shop_preloader_mobile_display != '1') {
			$output .= '@media only screen and (max-width: 767px) {
				#element.introLoading {
					display: none !important;
				}
			}';
		}

		$moon_shop_product_image_style = isset($moon_shop_optionsValue['moon-shop-single-product-style']) ? $moon_shop_optionsValue['moon-shop-single-product-style'] : 'bottom-carousel';
		$moon_shop_thumbs_number = isset($moon_shop_optionsValue['moon-shop-single-product-thumbs-number']) ? $moon_shop_optionsValue['moon-shop-single-product-thumbs-number'] : '4';
		if ($moon_shop_product_image_style == 'thumbs-simple' && $moon_shop_thumbs_number == '3') {
			$output .= '.woocommerce div.product .woocommerce-product-gallery--columns-4 .flex-control-thumbs li:nth-child(4n+1) {
				clear: none;
			}
			.woocommerce div.product div.images .flex-control-thumbs li {
			    width: 33.33%;
			}';
		} else if ($moon_shop_product_image_style == 'thumbs-simple' && $moon_shop_thumbs_number == '5') {
			$output .= '.woocommerce div.product .woocommerce-product-gallery--columns-4 .flex-control-thumbs li:nth-child(4n+1) {
				clear: none;
			}
			.woocommerce div.product div.images .flex-control-thumbs li {
			    width: 20%;
			}';
		} else if ($moon_shop_product_image_style == 'thumbs-simple' && $moon_shop_thumbs_number == '6') {
			$output .= '.woocommerce div.product .woocommerce-product-gallery--columns-4 .flex-control-thumbs li:nth-child(4n+1) {
				clear: none;
			}
			.woocommerce div.product div.images .flex-control-thumbs li {
			    width: 16.66%;
			}';
		}

	return $output;
}