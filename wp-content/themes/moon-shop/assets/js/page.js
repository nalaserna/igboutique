jQuery(function () {

    // Adding Color Picker
    jQuery('.moon-shop-color-field').wpColorPicker();

    // Image Uploader Option
    // Instantiates the variable that holds the media library frame.
    var meta_image_frame;
    // Runs when the image button is clicked.
    jQuery('#moon-shop-banner-image-uploader').click(function (e) {
        // Prevents the default action from occuring.
        e.preventDefault();

        // If the frame already exists, re-open it.
        if (meta_image_frame) {
            meta_image_frame.open();
            return;
        }

        // Sets up the media library frame
        meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
            title: moon_shop_page_image.title,
            button: { text: moon_shop_page_image.button },
            library: { type: 'image' }
        });

        // Runs when an image is selected.
        meta_image_frame.on('select', function () {

            // Grabs the attachment selection and creates a JSON representation of the model.
            var media_attachment = meta_image_frame.state().get('selection').first().toJSON();

            // Sends the attachment URL to our custom image input field.
            jQuery('#moon-shop-banner-image').val(media_attachment.url);
            jQuery('.moon-shop-banner-image-loader').attr('src', media_attachment.url);
            jQuery('.moon-shop-banner-image-wrapper').css('display', 'block');
            if (media_attachment.filename) {
                jQuery('img.was-img-uploaded.was-hide-img').toggleClass('was-hide-img was-show-img');
            }
        });

        // Opens the media library frame.
        meta_image_frame.open();
    });

    // logo uploader clicked.
    jQuery('#moon-shop-page-logo-uploader').click(function (e) {
        // Prevents the default action from occuring.
        e.preventDefault();

        // If the frame already exists, re-open it.
        if (meta_image_frame) {
            meta_image_frame.open();
            return;
        }

        // Sets up the media library frame
        meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
            title: moon_shop_page_image.title,
            button: { text: moon_shop_page_image.button },
            library: { type: 'image' }
        });

        // Runs when an image is selected.
        meta_image_frame.on('select', function () {

            // Grabs the attachment selection and creates a JSON representation of the model.
            var media_attachment = meta_image_frame.state().get('selection').first().toJSON();

            // Sends the attachment URL to our custom image input field.
            jQuery('#moon-shop-page-logo').val(media_attachment.url);
            jQuery('.moon-shop-page-logo-loader').attr('src', media_attachment.url);
            jQuery('.moon-shop-page-logo-wrapper').css('display', 'block');
            if (media_attachment.filename) {
                jQuery('img.was-img-uploaded.was-hide-img').toggleClass('was-hide-img was-show-img');
            }
        });

        // Opens the media library frame.
        meta_image_frame.open();
    });

    //page logo image is blank
    if (jQuery('.moon-shop-page-logo-loader').attr('src') == '') {
        jQuery('.moon-shop-page-logo-wrapper').css('display', 'none');
    }

    //page logo close
    jQuery('.moon-shop-page-logo-close').on('click', '#moon-shop-page-logo-close', function () {
        jQuery('.moon-shop-page-logo-wrapper').css('display', 'none');
        jQuery('#moon-shop-page-logo').val('');
        jQuery('.moon-shop-page-logo-loader').attr('src', '');
    });

    //page slider option
    if (jQuery("#moon-shop-page-silder-select").val() != 'none') {
        moon_shop_slider_optionShow();
    } else {
        moon_shop_slider_optionHide();
    }

    //slider on change option
    jQuery('body').on("change", "#moon-shop-page-silder-select", function () {
        if (jQuery(this).val() != 'none') {
            moon_shop_slider_optionShow();
        } else {
            moon_shop_slider_optionHide();
        }
    });

    //Page banner options
    if (jQuery("#moon-shop-page-banner-on-off").prop("checked")) {
        moon_shop_banner_optionsShow();
    } else {
        moon_shop_banner_optionsHide();
    }
    jQuery('body').on("change", "#moon-shop-page-banner-on-off", function () {
        if (this.checked) {
            moon_shop_banner_optionsShow();
        } else {
            moon_shop_banner_optionsHide();
        }
    });

    //banner image is blank
    if (jQuery('.moon-shop-banner-image-loader').attr('src') == '') {
        jQuery('.moon-shop-banner-image-wrapper').css('display', 'none');
    }

    //banner background option
    jQuery('body').on("change", "#moon-shop-page-banner-select", function () {
        if (jQuery(this).val() == 'background-image') {
            jQuery('.moon-shop-banner-image').parent('tr').show(500);
            jQuery('.moon-shop-banner-overlay-color').parent('tr').show(500);
            jQuery('.moon-shop-banner-image-opacity').parent('tr').show(500);
        } else {
            jQuery('.moon-shop-banner-image').parent('tr').hide(500);
            jQuery('.moon-shop-banner-overlay-color').parent('tr').hide(500);
            jQuery('.moon-shop-banner-image-opacity').parent('tr').hide(500);
        }
    });

    //banner background color option
    jQuery('body').on("change", "#moon-shop-page-banner-select", function () {
        if (jQuery(this).val() == 'banner-color') {
            jQuery('.moon-shop-banner-background-color').parent('tr').show(500);
        } else {
            jQuery('.moon-shop-banner-background-color').parent('tr').hide(500);
        }
    });

    //banner height option
    jQuery('body').on("change", "#moon-shop-page-banner-select", function () {
        if (jQuery(this).val() != 'default') {
            jQuery('.moon-shop-page-banner-height-select').parent('tr').show(500);
            if (jQuery('#moon-shop-page-banner-height-select').val() == 'custom-height') {
                jQuery(".moon-shop-banner-custom-height").parent("tr").show(500);
            } else {
                jQuery(".moon-shop-banner-custom-height").parent("tr").hide(500);
            }
        } else {
            jQuery('.moon-shop-page-banner-height-select').parent('tr').hide(500);
            jQuery(".moon-shop-banner-custom-height").parent("tr").hide(500);
        }
    });

    //banner custom height option
    jQuery('body').on("change", "#moon-shop-page-banner-height-select", function () {
        if (jQuery(this).val() == 'custom-height') {
            jQuery('.moon-shop-banner-custom-height').parent('tr').show(500);
        } else {
            jQuery('.moon-shop-banner-custom-height').parent('tr').hide(500);
        }
    });

    //banner image close
    jQuery('.moon-shop-banner-close').on('click', '#moon-shop-banner-close', function () {
        jQuery('.moon-shop-banner-image-wrapper').css('display', 'none');
        jQuery('#moon-shop-banner-image').val('');
        jQuery('.moon-shop-banner-image-loader').attr('src', '');
    });

});

//page slider option show function
function moon_shop_slider_optionShow() {
    if (jQuery('#moon-shop-page-silder-select').val() == 'revulotion-slider') {
        jQuery('.moon-shop-rv-silder-sc-select').parent('tr').show(500);
        jQuery('.moon-shop-page-silder-category-select').parent('tr').hide(500);
        jQuery('.moon-shop-slider-per-page').parent('tr').hide(500);
        jQuery('.moon-shop-slider-height').parent('tr').hide(500);
        jQuery('.moon-shop-page-silder-width').parent('tr').hide(500);
        jQuery('.moon-shop-slider-direction-nav-on-off').parent('tr').hide(500);
        jQuery('.moon-shop-slider-control-nav-on-off').parent('tr').hide(500);
        jQuery('.moon-shop-slider-animation-select').parent('tr').hide(500);
        jQuery('.moon-shop-slider-auto-play-on-off').parent('tr').hide(500);
    } else {
        jQuery('.moon-shop-rv-silder-sc-select').parent('tr').hide(500);
        jQuery('.moon-shop-page-silder-category-select').parent('tr').show(500);
        jQuery('.moon-shop-slider-per-page').parent('tr').show(500);
        jQuery('.moon-shop-slider-height').parent('tr').show(500);
        jQuery('.moon-shop-page-silder-width').parent('tr').show(500);
        jQuery('.moon-shop-slider-direction-nav-on-off').parent('tr').show(500);
        jQuery('.moon-shop-slider-control-nav-on-off').parent('tr').show(500);
        jQuery('.moon-shop-slider-animation-select').parent('tr').show(500);
        jQuery('.moon-shop-slider-auto-play-on-off').parent('tr').show(500);
    }

}

//page slider option hide function
function moon_shop_slider_optionHide() {
    jQuery('.moon-shop-page-silder-category-select').parent('tr').hide(500);
    jQuery('.moon-shop-rv-silder-sc-select').parent('tr').hide(500);
    jQuery('.moon-shop-slider-per-page').parent('tr').hide(500);
    jQuery('.moon-shop-slider-height').parent('tr').hide(500);
    jQuery('.moon-shop-page-silder-width').parent('tr').hide(500);
    jQuery('.moon-shop-slider-direction-nav-on-off').parent('tr').hide(500);
    jQuery('.moon-shop-slider-control-nav-on-off').parent('tr').hide(500);
    jQuery('.moon-shop-slider-animation-select').parent('tr').hide(500);
    jQuery('.moon-shop-slider-auto-play-on-off').parent('tr').hide(500);
}

//page banner option show function
function moon_shop_banner_optionsShow() {
    jQuery(".moon-shop-page-banner-select").parent("tr").show(500);
    if (jQuery('#moon-shop-page-banner-select').val() == 'background-image') {
        jQuery('.moon-shop-banner-image').parent('tr').show(500);
        jQuery('.moon-shop-banner-overlay-color').parent('tr').show(500);
        jQuery('.moon-shop-banner-image-opacity').parent('tr').show(500);
    } else {
        jQuery('.moon-shop-banner-image').parent('tr').hide(500);
        jQuery('.moon-shop-banner-overlay-color').parent('tr').hide(500);
        jQuery('.moon-shop-banner-image-opacity').parent('tr').hide(500);
    }
    if (jQuery('#moon-shop-page-banner-select').val() == 'banner-color') {
        jQuery('.moon-shop-banner-background-color').parent('tr').show(500);
    } else {
        jQuery(".moon-shop-banner-background-color").parent("tr").hide(500);
    }
    if (jQuery('#moon-shop-page-banner-select').val() != 'default') {
        jQuery(".moon-shop-page-banner-height-select").parent("tr").show(500);
    } else {
        jQuery(".moon-shop-page-banner-height-select").parent("tr").hide(500);
    }
    if (jQuery('#moon-shop-page-banner-height-select').val() == 'custom-height' && jQuery('#moon-shop-page-banner-select').val() != 'default') {
        jQuery(".moon-shop-banner-custom-height").parent("tr").show(500);
    } else {
        jQuery(".moon-shop-banner-custom-height").parent("tr").hide(500);
    }
}

//page banner option hide function
function moon_shop_banner_optionsHide() {
    jQuery(".moon-shop-page-banner-select").parent("tr").hide(500);
    jQuery('.moon-shop-banner-image').parent('tr').hide(500);
    jQuery('.moon-shop-banner-overlay-color').parent('tr').hide(500);
    jQuery('.moon-shop-banner-image-opacity').parent('tr').hide(500);
    jQuery(".moon-shop-banner-background-color").parent("tr").hide(500);
    jQuery(".moon-shop-page-banner-height-select").parent("tr").hide(500);
    jQuery(".moon-shop-banner-custom-height").parent("tr").hide(500);
}