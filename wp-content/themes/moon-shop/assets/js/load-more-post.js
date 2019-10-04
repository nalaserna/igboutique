(function ($) {

    jQuery('#load-more-post').on('click', function () {

        var pageNumber = parseInt(jQuery(this).attr('data-value'));
        var postType = jQuery(this).attr('data-post');
        var terms = jQuery(this).attr('data-terms');
        var archive = jQuery(this).attr('data-arc');
        var author = jQuery(this).attr('data-author');

        ajaxLoadMorePost(postType, pageNumber, terms, archive, author);

    });

})(jQuery);


function ajaxLoadMorePost(postType, pageNumber, terms, archive, author) {

    jQuery.ajax({

        type: 'post',

        url: moon_shop_loadmorePost.ajaxurl,

        dataType: 'json',

        data: {

            action: 'moon_shop_ajax_loadmore_post',

            postType: postType,

            pageNumber: pageNumber,

            postsPerPage: moon_shop_loadmorePost.posts_per_page,

            terms: terms,

            archive: archive,

            author: author

        },

        success: function (response) {
            if (response.post != null) {
                pageNumber++;
                jQuery('#addMore').append(response.post);
                jQuery('#load-more-post').attr('data-value', pageNumber);
				if( (moon_shop_loadmorePost.posts_per_page !== response.count) && (moon_shop_loadmorePost.posts_per_page > response.count) ) {
					jQuery('#load-more-post').parent('.more-product').parent('.load-more-post').hide();
				}
            } else {
                jQuery('#load-more-post').parent('.more-product').parent('.load-more-post').hide();
            }
        }
    });
}