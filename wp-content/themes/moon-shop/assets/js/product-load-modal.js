(function ($) {
    jQuery(document).ready(function () {

        jQuery('.quick-view').on('click', function () {
            jQuery('.ajax-product').empty();
            //product id
            var productId = jQuery(this).attr('data-id');
            //js file directory
            var rootDirectory = moon_shop_single_product_ajaxloader.jsDirectory;
            //call ajax function
            ajaxLoadProduct(productId, rootDirectory);
        });
    });

    function ajaxLoadProduct(productId, rootDirectory) {
        jQuery.ajax({
            async: false,
            type: 'post',
            url: moon_shop_single_product_ajaxloader.ajaxurl,
            dataType: 'html',
            data: {
                action: 'moon_shop_single_pro_ajaxloader',
                productId: productId,
            },
            success: function (response) {

                jQuery(response).prependTo('.ajax-product');

                /*-----
                 Cart Plus Minus Button
                 ------------------------------------*/
                jQuery(".modal-container .cart-qty, .modal-container .cart-plus-minus-2").prepend('<span class="dec qtybtn">-</span>');
                jQuery(".modal-container .cart-qty, .modal-container .cart-plus-minus-2").append('<span class="inc qtybtn">+</span>');
                jQuery(".modal-container .qtybtn").on("click", function () {
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
                    jQuerybutton.parent().find("input").val(newVal);
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
                        
                        resetSwatches($variation_form);
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
            },
            complete: function(){
                jQuery.getScript( rootDirectory + '/add-to-cart-variation.js' );
                jQuery.getScript( rootDirectory + '/single-product-modal.js' );
            },
            error: function (data) {

            }
        });
    }
})(jQuery);	