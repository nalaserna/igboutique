(function ($) {

    jQuery(document).ready(function () {

        var pagedNumber = parseInt(getValue());

        jQuery('#load-more-product').on('click', function () {

            pagedNumber = parseInt(getValue());

            //orderby value
            var orderby = jQuery('select.orderby').val();

            //post type value
            var postType = jQuery(this).attr('data-post');

            //category value
            var taxName = jQuery('#category-value').attr('data-cat');

            var tagName = jQuery('#category-value').attr('data-tag');

            //rating value
            var rating = jQuery('li.chosen').children('a').children('.star-rating').attr('title');

            if (rating != undefined) {
                var ratingInt = rating.replace(/[^\d.]/g, '');
            } else {
                var ratingInt = 0;
            }

            //price value
            if (jQuery('#min_price').attr('value') != undefined) {
                var minValue = jQuery('#min_price').attr('value');
            } else {
                var minValue = jQuery('#category-value').attr('data-min');
                ;
            }

            if (jQuery('#max_price').attr('value') != undefined) {
                var maxValue = jQuery('#max_price').attr('value');
            } else {
                var maxValue = jQuery('#category-value').attr('data-max');
                ;
            }

            //hover
            var hover = jQuery('.pro-hover').parent();
            if (hover.hasClass('promo-pro-image')) {
                hoverClass = 'style-two';
            } else {
                hoverClass = 'style-one';
            }

            //column number
            if (jQuery('.padding-left-right').hasClass('pro-column-2')) {
                var columnClass = 'pro-column-2';
            } else if (jQuery('.padding-left-right').hasClass('pro-column-3')) {
                var columnClass = 'pro-column-3';
            } else {
                var columnClass = 'pro-column-4';
            }

            //call ajax function
            ajaxLoadPost(postType, pagedNumber, orderby, taxName, tagName, ratingInt, minValue, maxValue, hoverClass, columnClass);
        });
    });


    function getValue() {
        var pagedNumber = jQuery('#load-more-product').attr('data-value');
        return pagedNumber;
    }

    function ajaxLoadPost(postType, pagedNumber, orderby, taxName, tagName, rating, minValue, maxValue, hoverClass, columnClass) {

        jQuery.ajax({
            type: 'post',
            url: moon_shop_loadmore_product.ajaxurl,
            dataType: 'json',
            data: {
                action: 'moon_shop_ajaxloader',
                postType: postType,
                pagedNumber: pagedNumber,
                orderby: orderby,
                taxName: taxName,
                tagName: tagName,
                rating: rating,
                minValue: minValue,
                maxValue: maxValue,
                hoverClass: hoverClass,
                columnClass: columnClass,
                postsPerPage: moon_shop_loadmore_product.posts_per_page,
            },

            success: function (response) {

                jQuery('#grid-view ul.products').append(response.grid);

                jQuery('#list-view').append(response.list);

                var pagedNumber = parseInt(getValue());

                pagedNumber++;

                jQuery('#load-more-product').attr('data-value', pagedNumber);

                if (response.count < moon_shop_loadmore_product.posts_per_page || response.data == 'no-data') {
                    jQuery('#load-more-product').parent('.more-product').parent('.loadmore-wraper').hide();
                }
            },
            error: function (data) {
            }
        });
    }

})(jQuery);	