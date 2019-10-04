(function (jQuery) {
    "use strict";

    new WOW().init();

    /*----- 
     Mobile Menu
     -----------------------------------*/
    jQuery('.main-menu nav').meanmenu(

    );

    jQuery(document).ready(function () {
        jQuery.each(jQuery('.venobox'), function(key, value) {
            jQuery(this).venobox(); 
        })

        jQuery('<div id="ajax-product" class="modal fade ajax-product woocommerce"></div>').prependTo('body');

        //woocommerce sidebar category add icon
        jQuery('.cat-item.cat-parent > a').after('<button class="toggle"><i class="fa fa-angle-down"></i></button>');
        jQuery('.cat-item.cat-parent .toggle').on('click',function () {
            jQuery(this).parent('.cat-parent').children('ul.children').toggleClass('active');
            if (jQuery(this).parent('.cat-parent').children('ul.children').hasClass('active')) {
                jQuery(this).parent('.cat-parent').children('ul.children').slideDown();
                jQuery(this).children('.fa').addClass('rotate');
            } else {
                jQuery(this).parent('.cat-parent').children('ul.children').slideUp();
                jQuery(this).children('.fa').removeClass('rotate');
            }
        });
    });

    /*-----
     Search & Minicart Open on Click
     -------------------------------------*/
    jQuery(".search-open").click(function () {
        jQuery(".search-page").animate({
            top: '0',
            width: '100%',
        }, 500);
    });

    jQuery(".close").click(function () {
        jQuery(".search-page").animate({
            top: '-100%',
            width: '0',
        }, 500);
    });

    /*-----
     tab Product Slider
     ------------------------------------*/
    var rtl_var = '';
    if ( jQuery('body').hasClass('rtl') ) {
        rtl_var = true;
    } else {
        rtl_var = false;
    }
    jQuery('.columns-4 .tab-pro-slider, .related-products .products.columns-4').slick({
        arrows: true,
        rtl: rtl_var,
        prevArrow: '<button type="button" class="slick-prev pro-slick-prev"><i class="fa fa-long-arrow-left"></i></button>',
        nextArrow: '<button type="button" class="slick-next pro-slick-next"><i class="fa fa-long-arrow-right"></i></button>',
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
            {
                breakpoint: 1169,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                }
            },
            {
                breakpoint: 969,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
        ]
    });

    jQuery('.columns-3 .tab-pro-slider').slick({
        arrows: true,
        rtl: rtl_var,
        prevArrow: '<button type="button" class="slick-prev pro-slick-prev"><i class="fa fa-long-arrow-left"></i></button>',
        nextArrow: '<button type="button" class="slick-next pro-slick-next"><i class="fa fa-long-arrow-right"></i></button>',
        speed: 300,
        slidesToShow: 3,
        slidesToScroll: 3,
        responsive: [
            {
                breakpoint: 1169,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 3,
                }
            },
            {
                breakpoint: 969,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
        ]
    });

    jQuery('.columns-2 .tab-pro-slider').slick({
        arrows: true,
        rtl: rtl_var,
        prevArrow: '<button type="button" class="slick-prev pro-slick-prev"><i class="fa fa-long-arrow-left"></i></button>',
        nextArrow: '<button type="button" class="slick-next pro-slick-next"><i class="fa fa-long-arrow-right"></i></button>',
        speed: 300,
        slidesToShow: 2,
        slidesToScroll: 2,
        responsive: [
            {
                breakpoint: 1169,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                }
            },
            {
                breakpoint: 969,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            },
        ]
    });

    /*-----
     Blog Slider
     ---------------------------------*/
    jQuery('.blog-slider').slick({
        arrows: true,
        rtl: rtl_var,
        prevArrow: '<button type="button" class="slick-prev pro-slick-prev"><i class="fa fa-long-arrow-left"></i></button>',
        nextArrow: '<button type="button" class="slick-next pro-slick-next"><i class="fa fa-long-arrow-right"></i></button>',
        speed: 300,
        slidesToShow: 2,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1169,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            },
        ]
    });

    /*-----
     pro-img-tab-carousel
     ----------------------------------*/
    jQuery('.pro-img-tab-carousel').slick({
        prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-angle-left"></i></button>',
        nextArrow: '<button type="button" class="slick-next"><i class="fa fa-angle-right"></i></button>',
        dots: false,
        rtl: rtl_var,
        speed: 800,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2
                }
            },
        ]
    });

    /*-----
     Cart Plus Minus Button For Product Details 1
     ----------------------------------------------*/

    /*-----
     Cart Plus Minus Button
     ------------------------------------*/
    jQuery(".cart-qty, .cart-plus-minus-2").prepend('<span class="dec qtybtn">-</span>');
    jQuery(".cart-qty, .cart-plus-minus-2").append('<span class="inc qtybtn">+</span>');
    jQuery(".qtybtn").on("click", function () {
        var jQuerybutton = jQuery(this);
        var oldValue = jQuerybutton.parent().find("input").val();
        if (jQuerybutton.hasClass('inc')) {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        jQuerybutton.parent().find("input").attr('value', newVal);
        jQuery( '.woocommerce-cart-form :input[name="update_cart"]' ).prop( 'disabled', false );
    });

    /*----- cart-plus-minus-button -----*/
    jQuery(".cart-plus-minus").append('<div class="dec qtybutton"><span class="icon_minus-06"></span></div><div class="inc qtybutton"><span class="icon_plus"></span></div>');
    jQuery(".qtybutton").on("click", function () {
        var jQuerybutton = jQuery(this);
        var oldValue = jQuerybutton.parent().find("input").val();
        if (jQuerybutton.html() == '<span class="icon_plus"></span>') {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        jQuerybutton.parent().find("input").val(newVal);
    });
    /*-----
     Scroll Up
     -------------------------------------*/
    if (moonShopMain.moonIntroLoader == '1') {
        jQuery.scrollUp({
            scrollText: '<i class="fa fa-long-arrow-up"></i>',
            easingType: 'linear',
            scrollSpeed: 900,
            animation: 'fade'
        });
    }

    /*-----
     Category Sidebar Treeview
     -------------------------------------*/
    // jQuery("#cat-treeview ul").treeview({
    //     animated: "normal",
    //     persist: "location",
    //     collapsed: true,
    //     unique: true,
    // });

    /*-----
     Get Arrow Icon In Treeview
     -------------------------------------*/
    jQuery('<i class="fa fa-caret-right"></i>').appendTo('.hitarea');

    /*-----
     Get Down Arrow For Expanded List
     ------------------------------------*/
    if (jQuery('.product-cat > ul > li').hasClass('collapsable')) {
        jQuery('.collapsable .hitarea i').addClass('mo-caret-down').removeClass('mo-caret-right');
    }
    ;

    /*-----
     Change Arrow Icon onClick
     -----------------------------------*/
    jQuery('.hitarea').on('click', function () {
        if (jQuery(this).find('i').hasClass('mo-caret-down')) {
            jQuery(this).find('i').addClass('mo-caret-right').removeClass('mo-caret-down');
        } else {
            jQuery('.hitarea i').addClass('mo-caret-right').removeClass('mo-caret-down');
            jQuery(this).find('i').addClass('mo-caret-down').removeClass('mo-caret-right');
        }
    });

    /*-----
     Price Slider
     -------------------------------*/
    jQuery("#slider-range").slider({
        range: true,
        min: 0,
        max: 800,
        values: [ 90, 250 ],
        slide: function (event, ui) {
            jQuery("#price-amount").val("jQuery" + ui.values[ 0 ] + " - jQuery" + ui.values[ 1 ]);
        }
    });
    jQuery("#price-amount").val("jQuery" + jQuery("#slider-range").slider("values", 0) +
        " - jQuery" + jQuery("#slider-range").slider("values", 1));

    /*-----
     Cart Page tab List
     ----------------------------------*/
    jQuery('.cart-page-tablist ul li a').on("click", function () {
        jQuery(this).addClass("active");
        jQuery(this).parent('li').prevAll('li').find('a').addClass("active");
        jQuery(this).parent('li').nextAll('li').find('a').removeClass("active");
    });

    /*-----
     Payment Select
     ------------------------------------*/
    jQuery('.single-payment .select-btn').on("click", function () {
        jQuery('.single-payment .select-btn').removeClass("active");
        jQuery(this).addClass("active");
    });

    /*-----
     Check Out Accordion
     -------------------------------------*/
    jQuery(".panel-heading a").on("click", function () {
        jQuery(".panel-heading a").removeClass("active");
        jQuery(this).addClass("active");
    });

    /*---------------------
     Menu Stick
     --------------------- */
    var s = jQuery("#sticker");
    var pos = s.position();
    jQuery(window).on('scroll', function () {
        var windowpos = jQuery(window).scrollTop();
        if (windowpos > pos.top) {
            s.addClass("stick");
        } else {
            s.removeClass("stick");
        }
    });
    /*---------------------
     Push top menu
     --------------------- */
    jQuery("div.header-contact-info").clone().appendTo(".main-menu nav > ul");
     
     /*---------------------
     Multiple product tab active
     --------------------- */
    jQuery(".pro-tab-list li:nth-child(1)").addClass("active");
    jQuery(".tab-short .tab-pane:nth-child(1)").addClass("active");
	
	//match equal height
    var screenWidth = jQuery(window).width();
    if (screenWidth > 768) {
		jQuery('.product.padding-left-right').matchHeight({
			byRow: true,
			property: 'height',
			target: null,
			remove: false
		});
    }

    //rtl for visual composer strech row
    // jQuery(window).on('load', function() {
    //     if( jQuery('html').attr('dir') == 'rtl' ) {
    //         //jQuery('.vc_row').css('right', '-' + posleft).css('left', 'auto');
    //         jQuery('[data-vc-full-width="true"]').each( function(i,v) {
    //             jQuery(this).css('right' , jQuery(this).css('left') ).css( 'left' , 'auto');
    //             var rightVal = jQuery(this).css('left'); 
    //             var paddingL = jQuery(this).css('padding-left');
    //             var paddingR = jQuery(this).css('padding-right'); 
    //             var width = jQuery(this).css('width'); 
    //             var position = jQuery(this).css('position'); 
    //             jQuery(this).attr( 'style', 'right:' + rightVal + ' !important; left: ' + rightVal +'; padding-left:' + paddingL + '; padding-right: ' + paddingR + '; width: ' + width + '; position: ' + position );
    //         });
    //     }
    // });

    // notice close
    jQuery('.notice-close').on('click', function() {
        jQuery(this).parent('div').addClass('close-notice');
    });

    if (moonShopMain.shopTooltip == '1') {
        jQuery('.swatch-on-grid').tooltipster({theme: moonShopMain.shopTooltipTheme});
    }
    if (moonShopMain.singleTooltip == '1') {
        jQuery('.moon-shop-swatch').tooltipster({theme: moonShopMain.singleTooltipTheme});
    }

    jQuery('.moon-widget-swatch').tooltipster({theme: 'tooltipster-borderless'});

    jQuery('body').on('click', '.swatch-on-grid', function() {

        var src, srcset, image_sizes;

        var imageSrc = jQuery(this).data('image-src'),
            imageSrcset = jQuery(this).data('image-srcset'),
            imageSizes = jQuery(this).data('image-sizes');

        if( typeof imageSrc == 'undefined' ) return;

        var product = jQuery(this).parents('.pro-image'),
            productHover = jQuery(this).parents('.pro-hover'),
            image = product.find('a > img'),
            srcOrig = image.data('original-src'),
            srcsetOrig = image.data('original-srcset'),
            sizesOrig = image.data('original-sizes');

        if( typeof srcOrig == 'undefined' ) {
            image.data('original-src', image.attr('src'));
        }

        if( typeof srcsetOrig == 'undefined' ) {
            image.data('original-srcset', image.attr('srcset'));
        }

        if( typeof sizesOrig == 'undefined' ) {
            image.data('original-sizes', image.attr('sizes'));
        }


        if( jQuery(this).hasClass('current-swatch') ) {
            src = srcOrig;
            srcset = srcsetOrig;
            image_sizes = sizesOrig;
            jQuery(this).removeClass('current-swatch');
            product.removeClass('product-swatched');
        } else {
            jQuery(this).parent().find('.current-swatch').removeClass('current-swatch');
            jQuery(this).addClass('current-swatch');
            product.addClass('product-swatched');
            src = imageSrc;
            srcset = imageSrcset;
            image_sizes = imageSizes;
        }

        if( image.attr('src') == src ) return;

        product.addClass('loading-image');

        if (jQuery(this).parent().parent().parent().hasClass('promo-pro-image')) {
            jQuery(this).parents('.promo-pro-image').find('> a > img').attr('src', src);
            jQuery(this).parents('.promo-pro-image').find('> a > img').attr('srcset', imageSrcset);
        } else if(jQuery(this).parent().parent().parent().hasClass('pro-image')) {
            productHover.css('background-image', 'url('+src+')');
        }

        if (jQuery(this).parent().parent().parent().hasClass('sin-product-list')) {
            var listImg = jQuery(this).parents('.sin-product-list').find('.list-pro-image a img');
            listImg.attr('src', src);
            listImg.attr('srcset', imageSrcset);
        }

        image.attr('src', src).attr('srcset', srcset).attr('image_sizes', image_sizes).one('load', function() {
            product.removeClass('loading-image');
        });
    });

    var $variation_forms = jQuery('.variations_form');

    $variation_forms.each(function() {
        var $variation_form = jQuery(this);

        if( $variation_form.data('swatches') ) return;
        $variation_form.data('swatches', true);

        // If AJX
        if( ! $variation_form.data('product_variations') ) {
            $variation_form.find('.swatches-select').find('> div').addClass('swatch-enabled');
        }

        jQuery('.moon-shop-swatch[selected="selected"]').addClass('active-swatch').attr('selected', false);

        $variation_form.on('click', '.swatches-select > div', function() {
            var value = jQuery(this).data('value');
            var id = jQuery(this).parent().data('id');

            $variation_form.trigger( 'check_variations', [ 'attribute_' + id, true ] );
            resetSwatches($variation_form);
            if (jQuery(this).hasClass('active-swatch')) {
                return;
            }

            if (jQuery(this).hasClass('swatch-disabled')) return;
            $variation_form.find('select#' + id).val(value).trigger('change');
            jQuery(this).parent().find('.active-swatch').removeClass('active-swatch');
            jQuery(this).addClass('active-swatch');
            resetSwatches($variation_form);
        })

        // On clicking the reset variation button
        .on( 'click', '.reset_variations', function( event ) {
            $variation_form.find('.active-swatch').removeClass('active-swatch');
        } )

        .on('reset_data', function() {

            var all_attributes_chosen  = true;
            var some_attributes_chosen = false;

            $variation_form.find( '.variations select' ).each( function() {
                var attribute_name = jQuery( this ).data( 'attribute_name' ) || jQuery( this ).attr( 'name' );
                var value          = jQuery( this ).val() || '';

                if ( value.length === 0 ) {
                    all_attributes_chosen = false;
                } else {
                    some_attributes_chosen = true;
                }

            });

            if( all_attributes_chosen ) {
                jQuery(this).parent().find('.active-swatch').removeClass('active-swatch');
            }

            var $mainOwl = jQuery('.woocommerce-product-gallery__wrapper');
            
            resetSwatches($variation_form);

            if( ! $mainOwl.hasClass('owl-carousel') ) return;

            $mainOwl = $mainOwl.owlCarousel({
                rtl: jQuery('body').hasClass('rtl'),
                items: 1,
                autoplay: false,
                autoplayTimeout:3000,
                loop: false,
                dots: false,
                nav: false,
                navText:false,
                onRefreshed: function() {
                    jQuery(window).resize();
                }
            });
            $mainOwl.trigger('refresh.owl.carousel');

            $mainOwl.trigger('to.owl.carousel', 0);
        })

        // Update first tumbnail
        .on('reset_image', function() {
            var $thumb = jQuery( '.thumbnails img' ).first();
            if ( !isQuickView() ) {
                $thumb.wc_reset_variation_attr( 'src' );
            }
        })
        .on( 'show_variation', function( e, variation, purchasable) {
            var $thumb = jQuery('.thumbnails img').first();

            var image_src = variation.image.src;
            
            if ( !image_src ) return;

            if ( !isQuickView() ) {
                $thumb.wc_set_variation_attr('src', image_src);
            }

            var $mainOwl = jQuery('.woocommerce-product-gallery__wrapper');

            if( ! $mainOwl.hasClass('owl-carousel') ) return;

            $mainOwl = $mainOwl.owlCarousel({
                rtl: jQuery('body').hasClass('rtl'),
                items: 1,
                autoplay: false,
                autoplayTimeout:3000,
                loop: false,
                dots: false,
                nav: false,
                navText:false,
                onRefreshed: function() {
                    jQuery(window).resize();
                }
            });
            $mainOwl.trigger('refresh.owl.carousel');

            var $thumbs = jQuery('.images .thumbnails');

            $mainOwl.trigger('to.owl.carousel', 0);

            if( $thumbs.hasClass('owl-carousel') ) {
                $thumbs.owlCarousel().trigger('to.owl.carousel', 0);
                $thumbs.find('.active-thumb').removeClass('active-thumb');
                $thumbs.find('.owl-item').eq(0).addClass('active-thumb');
            } else {
                $thumbs.slick('slickGoTo', 0);
                $thumbs.find('.active-thumb').removeClass('active-thumb');
                $thumbs.find('img').eq(0).addClass('active-thumb');
            }

        } );
    })

    var resetSwatches = function($variation_form) {

        // If using AJAX
        if( ! $variation_form.data('product_variations') ) return;

        $variation_form.find('.variations select').each(function() {

            var select = jQuery(this);
            var swatch = select.parent().find('.swatches-select');
            var options = select.html();
            // var options = select.data('attribute_html');
            options = jQuery(options);

            swatch.find('> div').removeClass('swatch-enabled').addClass('swatch-disabled');

            options.each(function(el) {
                var value = jQuery(this).val();

                if( jQuery(this).hasClass('enabled') ) {
                // if( ! el.disabled ) {
                    swatch.find('div[data-value="' + value + '"]').removeClass('swatch-disabled').addClass('swatch-enabled');
                } else {
                    swatch.find('div[data-value="' + value + '"]').addClass('swatch-disabled').removeClass('swatch-enabled');
                }

            });

        });
    };

    var isQuickView = function() {
        return jQuery( '.single-product-content' ).hasClass( 'product-quick-view' );
    };

    var productStyle =  jQuery('.woocommerce-product-gallery').data('style');

    if (productStyle == 'bottom-carousel' || productStyle == 'side-carousel' || productStyle == 'full-images') {
        if (productStyle == 'bottom-carousel' || productStyle == 'side-carousel') {
            var $mainImages = jQuery('.woocommerce-product-gallery__image:eq(0) img'),
                $thumbs = jQuery('.single-product-thumbnails .thumbnails'),
                $mainOwl = jQuery('.woocommerce-product-gallery__wrapper');

            $mainOwl.addClass('owl-carousel').owlCarousel({
                rtl: jQuery('body').hasClass('rtl'),
                items: 1,
                autoplay: false,
                autoplayTimeout:3000,
                loop: false,
                dots: false,
                nav: false,
                navText:false,
                onRefreshed: function() {
                    jQuery(window).resize();
                }
            });

            var markup = '';
            jQuery('.woocommerce-product-gallery__image').each(function() {
                var image = jQuery( this ).find('img').attr( 'src' ),
                    alt = jQuery( this ).find( '.attachment-woocommerce_single' ).attr( 'alt' ),
                    title = jQuery( this ).find( '.attachment-woocommerce_single' ).attr( 'title' );
                
                markup += '<img alt="' + alt + '" title="' + title + '" src="' + image + '" />';
            });
            $thumbs.append(markup);

            if (productStyle == 'bottom-carousel') {
                $thumbs.addClass('owl-carousel').owlCarousel({
                    rtl: jQuery('body').hasClass('rtl'),
                    items: jQuery('.woocommerce-product-gallery').data('columns'),
                    responsive: {
                        991: {
                            items: jQuery('.woocommerce-product-gallery').data('columns')
                        },
                        768: {
                            items: (jQuery('.woocommerce-product-gallery').data('columns')-1)
                        },
                        479: {
                            items: (jQuery('.woocommerce-product-gallery').data('columns')-2)
                        },
                        0: {
                            items: 2
                        }
                    },
                    dots:false,
                    nav: true,
                    navText: ['<svg width="20px" height="20px" viewBox="0 0 11 20"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M9.554,1.001l-8.607,8.607l8.607,8.606"/></svg>','<svg width="20px" height="20px" viewBox="0 0 11 20" version="1.1"><path style="fill:none;stroke-width: 1px;stroke: #000;" d="M1.054,18.214l8.606,-8.606l-8.606,-8.607"/></svg>'],
                });

                var $thumbsOwl = $thumbs.owlCarousel();

                $thumbs.on('click', '.owl-item', function(e) {
                    var i = jQuery(this).index();
                    $thumbsOwl.trigger('to.owl.carousel', i);
                    $mainOwl.trigger('to.owl.carousel', i);
                });

                $mainOwl.on('changed.owl.carousel', function(e) {
                    var i = e.item.index;
                    $thumbsOwl.trigger('to.owl.carousel', i);
                    $thumbs.find('.active-thumb').removeClass('active-thumb');
                    $thumbs.find('.owl-item').eq(i).addClass('active-thumb');
                });

                $thumbs.find('.owl-item').eq(0).addClass('active-thumb');
            } else if (productStyle == 'side-carousel') {
                $thumbs.slick({
                    slidesToShow: jQuery('.woocommerce-product-gallery').data('columns'),
                    slidesToScroll: jQuery('.woocommerce-product-gallery').data('columns'),
                    vertical: true,
                    verticalSwiping: true,
                    infinite: false,
                    prevArrow: '<button type="button" class="slick-prev"><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M23.245 20l-11.245-14.374-11.219 14.374-.781-.619 12-15.381 12 15.391-.755.609z"/></svg></button>',
                    nextArrow: '<button type="button" class="slick-next"><svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M23.245 4l-11.245 14.374-11.219-14.374-.781.619 12 15.381 12-15.391-.755-.609z"/></svg></button>'
                });

                $thumbs.on('click', 'img', function(e) {
                    var i = jQuery(this).index();
                    console.log(i);
                    $mainOwl.trigger('to.owl.carousel', i);
                });

                $mainOwl.on('changed.owl.carousel', function(e) {
                    var i = e.item.index;
                    $thumbs.slick('slickGoTo', i);
                    $thumbs.find('.active-thumb').removeClass('active-thumb');
                    $thumbs.find('img').eq(i).addClass('active-thumb');
                });
                
                $thumbs.find('img').eq(0).addClass('active-thumb');

                if (jQuery('.product-image').has('.onsale')) {
                    if (jQuery('.onsale').parent('.product-image').hasClass('pull-right')) {
                        var rightBlankSpace = jQuery('.single-product-thumbnails').outerWidth() + 40;
                        jQuery('.onsale').css({'right': rightBlankSpace, 'left': 'auto'});
                    } else {
                        var leftOffsetOfImage = jQuery('.woocommerce-product-gallery__wrapper').position().left + 25;
                        jQuery('.onsale').css('left', leftOffsetOfImage);
                    }
                }
            }
        }

        jQuery('.woocommerce-product-gallery__image').attr('data-zoom', 'easyzoom easyzoom--overlay').addClass('easyzoom easyzoom--overlay');
        var $easyzoom = jQuery('.woocommerce-product-gallery__image').easyZoom();
        var zoomApi = $easyzoom.data('easyZoom');
        // ensures this works for some older browsers
        MutationObserver = window.MutationObserver || window.WebKitMutationObserver || window.MozMutationObserver;
        // the element you want to observe. change the selector to fit your use case
        var variationImg = document.querySelector('img.wp-post-image');
        new MutationObserver(function onSrcChange(){
            // src attribute just changed!!! put code here
            var imgsrc = jQuery('img.wp-post-image').attr('src');
            if (productStyle == 'bottom-carousel') {
                $thumbs.find('.owl-item').eq(0).find('img').attr('src', imgsrc);
                $mainOwl.find('.owl-stage').css('transform', 'translate3d(0px, 0px, 0px)');
                $thumbs.find('.owl-stage').css('transform', 'translate3d(0px, 0px, 0px)');
                $thumbs.find('.active-thumb').removeClass('active-thumb');
                $thumbs.find('.owl-item').eq(0).addClass('active-thumb');
                $mainOwl.find('.active').removeClass('active');
                $mainOwl.find('.owl-item').eq(0).addClass('active');
            } else if (productStyle == 'bottom-carousel') {
                $thumbs.find('.slick-slide').eq(0).attr('src', imgsrc);
                $mainOwl.find('.owl-stage').css('transform', 'translate3d(0px, 0px, 0px)');
                $thumbs.find('.slick-track').css('transform', 'translate3d(0px, 0px, 0px)');
                $thumbs.find('.slick-current').removeClass('slick-current');
                $thumbs.find('.slick-slide').eq(0).addClass('slick-current');
                $mainOwl.find('.active').removeClass('active');
                $mainOwl.find('.owl-item').eq(0).addClass('active');
            }

            zoomApi.teardown();
            $easyzoom = jQuery('.woocommerce-product-gallery__image').easyZoom();
            zoomApi = $easyzoom.data('easyZoom');
        }).observe(variationImg,{attributes:true,attributeFilter:["src"]});
        zoomApi.teardown();
        if (jQuery('.woocommerce-product-gallery').data('zoom-on') == 'yes') {
            zoomApi._init();
        }

        /*----------------------------
           magnificPopup
        ------------------------------ */
        jQuery('.zoom').on('click', function (e) {
            e.preventDefault();
            jQuery.magnificPopup.close();
            var links = []; var i = 0; var currentItem = ''; var currentIndex;
            if (productStyle == 'full-images') {
                jQuery('.woocommerce-product-gallery__image').each(function() {
                    var slide = {};
                    slide.src = jQuery(this).children('a').children('img').attr('data-large_image');
                    links[i] = slide;
                    currentIndex = 0;
                    i++;
                });
            } else {
                jQuery('.woocommerce-product-gallery__wrapper').find('.owl-item').each(function() {
                    var slide = {};
                    slide.src = jQuery(this).children('.woocommerce-product-gallery__image').children('a').children('img').attr('data-large_image');
                    links[i] = slide;
                    if (jQuery(this).hasClass('active')) {
                        currentItem = jQuery(this).children('.woocommerce-product-gallery__image').children('a').children('img').attr('data-large_image');
                        currentIndex = i;
                    }
                    i++;
                });
            }
            var mpDefaults = {
                tClose: 'Close (Esc)',
                tLoading: 'Loading...',
                gallery: {
                    tPrev: 'Previous (Left arrow key)',
                    tNext: 'Next (Right arrow key)',
                    tCounter: '%curr% of %total%'
                },
                image: {
                    tError: 'The image could not be loaded.'
                },
                ajax: {
                    tError: 'The image could not be loaded.'
                }
            }
            jQuery.magnificPopup.open(jQuery.extend(true, {}, mpDefaults, {
                items: links,
                gallery: {
                    enabled: true
                },
                type: 'image' // this is default type
            }), currentIndex);
        });
    }

    var stickyInstance = null;
    if (jQuery('.product-single-details').hasClass('single-content-sticky') && jQuery(window).width() > 991) {
        var topSpacing = jQuery('.product-single-details').data('offset');
        var stickyOptions = {
            innerWrapperSelector: '.product-info',
            topSpacing: parseInt(topSpacing),
        };
        stickyInstance = new StickySidebar('.single-content-sticky', stickyOptions);
    }

    if (jQuery('body').hasClass('single-product')) {
        var $trigger = jQuery('.product-info .cart');
        var $stickyBtn = jQuery('.moon-sticky-btn');

        if ($stickyBtn.length <= 0 || (jQuery(window).width() <= 768 && $stickyBtn.hasClass('mobile-off'))) return;

        var summaryOffset = $trigger.offset().top + $trigger.outerHeight();

        var stickyAddToCartToggle = function () {
            var windowScroll = jQuery(window).scrollTop();
            var windowHeight = jQuery(window).height();
            var documentHeight = jQuery(document).height();

            if (summaryOffset < windowScroll && windowScroll + windowHeight != documentHeight) {
                $stickyBtn.addClass('moon-sticky-btn-shown');

            } else if (windowScroll + windowHeight == documentHeight || summaryOffset > windowScroll) {
                $stickyBtn.removeClass('moon-sticky-btn-shown');
            }
        };

        stickyAddToCartToggle();

        jQuery(window).scroll(stickyAddToCartToggle);

        jQuery('.moon-sticky-add-to-cart').click(function (e) {
            e.preventDefault();
            jQuery('html, body').animate({
                scrollTop: jQuery('.product-info').offset().top
            }, 800);
        });
    }

    //countdown product
    // jQuery('.moon-timer').each(function() {
    //     var time = moment.tz( jQuery(this).data('end-date'), jQuery(this).data('timezone') );
    //     jQuery( this ).countdown( time.toDate(), function( event ) {
    //         jQuery(this).html(event.strftime(''
    //             + '<span class="countdown-days">%-D <span>' + timerTranslations.countdown_days + '</span></span> '
    //             + '<span class="countdown-hours">%H <span>' + timerTranslations.countdown_hours + '</span></span> '
    //             + '<span class="countdown-min">%M <span>' + timerTranslations.countdown_mins + '</span></span> '
    //             + '<span class="countdown-sec">%S <span>' + timerTranslations.countdown_sec + '</span></span>'));
    //     });
    // });

})(jQuery);	