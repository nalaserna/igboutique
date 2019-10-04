/*!
 * WooCommerce Add to Cart JS
 */

jQuery(function ($) {
    /* global wc_add_to_cart_params */
    if (typeof wc_add_to_cart_params === 'undefined') {
        return false;
    }

    // Ajax add to cart
    $(document).on('click', '.add_to_cart_button', function (e) {
        if (!jQuery(this).hasClass('product_type_variable')) {
            e.preventDefault();
        } else {
            return
        }

        // AJAX add to cart request
        var $thisbutton = $(this);

        if ($thisbutton.is('.ajax_add_to_cart')) {
            if (!$thisbutton.attr('data-product_id')) {
                return true;
            }

            $thisbutton.removeClass('added');
            $thisbutton.addClass('loading');

            var data = {};

            $.each($thisbutton.data(), function (key, value) {
                data[key] = value;
            });

            // Trigger event
            $(document.body).trigger('adding_to_cart', [ $thisbutton, data ]);

            // Ajax action
            $.post(wc_add_to_cart_params.wc_ajax_url.toString().replace('%%endpoint%%', 'add_to_cart'), data, function (response) {

                if (!response) {
                    return;
                }

                var this_page = window.location.toString();

                this_page = this_page.replace('add-to-cart', 'added-to-cart');

                if (response.error && response.product_url) {
                    window.location = response.product_url;
                    return;
                }

                // Redirect to cart option
                if (wc_add_to_cart_params.cart_redirect_after_add === 'yes') {

                    window.location = wc_add_to_cart_params.cart_url;
                    return;
                } else {
                    $thisbutton.removeClass('loading');

                    var fragments = response.fragments;

                    var cart_hash = response.cart_hash;

                    // Block fragments class

                    if (fragments) {
                        $.each(fragments, function (key) {
                            $(key).addClass('updating');
                        });
                    }

                    // Block widgets and fragments
                    $('.shop_table.cart, .updating, .cart_totals').fadeTo('400', '0.6').block({
                        message: null,
                        overlayCSS: {
                            opacity: 0.6
                        }
                    });

                    // Changes button classes
                    $thisbutton.addClass('added').removeClass('add_to_cart_button');
                    $thisbutton.attr('href', wc_add_to_cart_params.cart_url);
                    $thisbutton.children('.fa-shopping-cart').removeClass('fa-shopping-cart').addClass('fa-cart-plus');
                    //cart number increase
                    var cartCurrent = $('.moon-find-cart').find('.cart-btn').children('.cart-number').html();
                    cartCurrent++;
                    $('.moon-find-cart').find('.cart-btn').children('.cart-number').html(cartCurrent);
                    var productId = $thisbutton.attr('data-product_id');
                    //ajax to update cart icon
                    clickAjaxLoadProduct(productId);
                    clickAjaxLoadProductPrice();

                    // View cart text
                    // if ( ! wc_add_to_cart_params.is_cart && $thisbutton.parent().find( '.added_to_cart' ).length === 0 ) {
                    // 	$thisbutton.after( ' <a href="' + wc_add_to_cart_params.cart_url + '" class="added_to_cart wc-forward" title="' +
                    // 		wc_add_to_cart_params.i18n_view_cart + '">' + wc_add_to_cart_params.i18n_view_cart + '</a>' );
                    // }

                    // Replace fragments
                    if (fragments) {
                        $.each(fragments, function (key, value) {
                            $(key).replaceWith(value);
                        });
                    }

                    // Unblock
                    $('.widget_shopping_cart, .updating').stop(true).css('opacity', '1').unblock();
                    // Cart page elements
                    $('.shop_table.cart').load(this_page + ' .shop_table.cart:eq(0) > *', function () {
                        $('.shop_table.cart').stop(true).css('opacity', '1').unblock();
                        $(document.body).trigger('cart_page_refreshed');
                    });
                    $('.cart_totals').load(this_page + ' .cart_totals:eq(0) > *', function () {
                        $('.cart_totals').stop(true).css('opacity', '1').unblock();
                    });
                    // Trigger event so themes can refresh other areas
                    $(document.body).trigger('added_to_cart', [ fragments, cart_hash, $thisbutton ]);
                }
            });
            return false;
        }
        return true;
    });

    function clickAjaxLoadProduct(productId) {
        jQuery.ajax({
            async: false,
            type: 'post',
            url: moon_shop_productCart.ajaxurl,
            dataType: 'html',
            data: {
                action: 'moon_shop_ajaxloader_cart',
                productId: productId,
            },
            success: function (response) {
                jQuery('.headercart-wrapper ul.products').empty();
                jQuery(response).prependTo('.headercart-wrapper ul.products');
            },
            error: function (data) {}
        });
    }

    function clickAjaxLoadProductPrice() {
        jQuery.ajax({
            async: false,
            type: 'post',
            url: moon_shop_productCart.ajaxurl,
            dataType: 'html',
            data: {
                action: 'moon_shop_ajaxloader_cart_price',
            },
            success: function (response) {
                jQuery('.headercart-wrapper .total-price .price').empty();
                jQuery(response).prependTo('.headercart-wrapper .total-price .price');
            },
            error: function (data) {}
        });
    }
});