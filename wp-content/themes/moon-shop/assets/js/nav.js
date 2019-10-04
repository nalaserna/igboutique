// Adding Color Picker
jQuery('.moon-shop-color-field').wpColorPicker();

// Image Uploader Option
// Instantiates the variable that holds the media library frame.
var meta_image_frame;
// Runs when the image button is clicked.
var id;
function imageUpload(id) {
    // If the frame already exists, re-open it.
    if (meta_image_frame) {
        meta_image_frame.open();
        return;
    }
    function ID() {
        return id;
    }

    // Sets up the media library frame
    meta_image_frame = wp.media.frames.meta_image_frame = wp.media({
        title: 'Upload Image' + '-' + id,
        button: { text: 'Upload' },
        library: { type: 'image' }
    });

    // Runs when an image is selected.
    meta_image_frame.on('select', function () {
        // Grabs the attachment selection and creates a JSON representation of the model.
        var media_attachment = meta_image_frame.state().get('selection').first().toJSON();
        // Sends the attachment URL to our custom image input field.
        alert(ID());
        jQuery('#moon-shop-banner-image' + id).val(media_attachment.url);
        jQuery('.moon-shop-banner-image-loader').attr('src', media_attachment.url);
        jQuery('.moon-shop-banner-image-wrapper').css('display', 'block');
        if (media_attachment.filename) {
            jQuery('img.was-img-uploaded.was-hide-img').toggleClass('was-hide-img was-show-img');
        }
    });

    // Opens the media library frame.
    meta_image_frame.open();
}



