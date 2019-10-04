jQuery( document ).ready( function( $ ){
    
    /* Multiple Image Uploader */
    var file_frame;

    jQuery('#moon-shop-album-image-uploader-button').live('click', function( event ){

        event.preventDefault();

        /* If the media frame already exists, reopen it. */
        if ( file_frame ) {
            file_frame.open();
            return;
        }

        /* Create the media frame. */
        file_frame = wp.media.frames.file_frame = wp.media({
            title: jQuery( this ).data( 'uploader_title' ),
            button: {
                text: jQuery( this ).data( 'uploader_button_text' ),
            },
            multiple: true
        });

        /* When an image is selected, run a callback.*/
        file_frame.on( 'select', function() {
            var selection = file_frame.state().get('selection');
            selection.map( function( attachment ) {

                attachment = attachment.toJSON();
                
                /* Adding Input Field Having Image Url*/
                jQuery( '<span onclick="deleteImageUp( this )" >' ).attr({
					
                    id: attachment.id,
                    class: 'w-delete w-showHide'
					
                }).appendTo( '.msk-album-image-wrapper' );
                jQuery( '<input>' ).attr({
                    type: 'hidden',
                    id  : 'moon-shop-album-images',
                    name: 'moon-shop-album-images[]',
                    value: attachment.id,
					class: attachment.id
                }).appendTo( '.msk-album-image-wrapper' );
                jQuery( '<img onclick="deleteUpImage(this)">' ).attr({
                    class: 'msk-album-image-loader' + ' ' + attachment.id,
                    src  : attachment.url,
					value: attachment.id,
                }).appendTo( '.msk-album-image-wrapper' );				
                /* Do something with attachment.id and/or attachment.url here*/
            });
        });

        /* Finally, open the modal*/
        file_frame.open();
    });
});

function deleteImage( e ) {
    jQuery( '.'+e ).parent( '.msk-album-image' ).remove();
}

function deleteUpImage( e ) {
	jQuery( '.'+e.value ).remove();
}
