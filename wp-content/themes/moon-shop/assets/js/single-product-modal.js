;(function ( $, window, document, undefined ) {

    /**
     * Product gallery class.
     */
    var ProductGallery = function( $target, args ) {
        this.$target = $target;
        this.$images = $( '.woocommerce-product-gallery__image', $target );

        // No images? Abort.
        if ( 0 === this.$images.length ) {
            return;
        }

        // Make this object available.
        $target.data( 'product_gallery', this );

        // Pick functionality to initialize...
        this.flexslider_enabled = $.isFunction( $.fn.flexslider ) && wc_single_product_params.flexslider_enabled;
        this.zoom_enabled       = $.isFunction( $.fn.zoom ) && wc_single_product_params.zoom_enabled;
        this.photoswipe_enabled = typeof PhotoSwipe !== 'undefined' && wc_single_product_params.photoswipe_enabled;

        // ...also taking args into account.
        if ( args ) {
            this.flexslider_enabled = false === args.photoswipe_enabled ? false : this.flexslider_enabled;
            this.zoom_enabled       = false === args.zoom_enabled ? false : this.zoom_enabled;
            this.photoswipe_enabled = false === args.photoswipe_enabled ? false : this.photoswipe_enabled;
        }

        // Bind functions to this.
        this.initFlexslider       = this.initFlexslider.bind( this );
        this.initZoom             = this.initZoom.bind( this );
        this.onResetSlidePosition = this.onResetSlidePosition.bind( this );
        this.getGalleryItems      = this.getGalleryItems.bind( this );
        this.openPhotoswipe       = this.openPhotoswipe.bind( this );

        if ( this.flexslider_enabled ) {
            this.initFlexslider();
            $target.on( 'woocommerce_gallery_reset_slide_position', this.onResetSlidePosition );
        } else {
            this.$target.css( 'opacity', 1 );
        }

        if ( this.zoom_enabled ) {
            this.initZoom();
            $target.on( 'woocommerce_gallery_init_zoom', this.initZoom );
        }
    };

    /**
     * Initialize flexSlider.
     */
    ProductGallery.prototype.initFlexslider = function() {
        var images  = this.$images,
            $target = this.$target;

        $target.flexslider( {
            selector:       '.woocommerce-product-gallery__wrapper > .woocommerce-product-gallery__image',
            animation:      wc_single_product_params.flexslider.animation,
            smoothHeight:   wc_single_product_params.flexslider.smoothHeight,
            directionNav:   wc_single_product_params.flexslider.directionNav,
            controlNav:     wc_single_product_params.flexslider.controlNav,
            slideshow:      wc_single_product_params.flexslider.slideshow,
            animationSpeed: wc_single_product_params.flexslider.animationSpeed,
            animationLoop:  wc_single_product_params.flexslider.animationLoop, // Breaks photoswipe pagination if true.
            start: function() {
                $target.css( 'opacity', 1 );

                images.each( function() {
                    $( this ).css( 'min-height', '570px' );
                } );
            }
        } );
    };

    /**
     * Init zoom.
     */
    ProductGallery.prototype.initZoom = function() {
        var zoomTarget   = this.$images,
            galleryWidth = this.$target.width(),
            zoomEnabled  = false;

        if ( ! this.flexslider_enabled ) {
            zoomTarget = zoomTarget.first();
        }

        $( zoomTarget ).each( function( index, target ) {
            var image = $( target ).find( 'img' );

            if ( image.data( 'large_image_width' ) > galleryWidth ) {
                zoomEnabled = true;
                return false;
            }
        } );

        // But only zoom if the img is larger than its container.
        if ( zoomEnabled ) {
            var zoom_options = {
                touch: false
            };

            if ( 'ontouchstart' in window ) {
                zoom_options.on = 'click';
            }

            zoomTarget.trigger( 'zoom.destroy' );
            zoomTarget.zoom( zoom_options );
        }
    };

    /**
     * Reset slide position to 0.
     */
    ProductGallery.prototype.onResetSlidePosition = function() {
        this.$target.flexslider( 0 );
    };

    /**
     * Get product gallery image items.
     */
    ProductGallery.prototype.getGalleryItems = function() {
        var $slides = this.$images,
            items   = [];

        if ( $slides.length > 0 ) {
            $slides.each( function( i, el ) {
                var img = $( el ).find( 'img' ),
                    large_image_src = img.attr( 'data-large_image' ),
                    large_image_w   = img.attr( 'data-large_image_width' ),
                    large_image_h   = img.attr( 'data-large_image_height' ),
                    item            = {
                        src: large_image_src,
                        w:   large_image_w,
                        h:   large_image_h,
                        title: img.attr( 'title' )
                    };
                items.push( item );
            } );
        }

        return items;
    };

    /**
     * Open photoswipe modal.
     */
    ProductGallery.prototype.openPhotoswipe = function( e ) {
        e.preventDefault();

        var pswpElement = $( '.pswp' )[0],
            items       = this.getGalleryItems(),
            eventTarget = $( e.target ),
            clicked;

        if ( ! eventTarget.is( '.woocommerce-product-gallery__trigger' ) ) {
            clicked = eventTarget.closest( '.woocommerce-product-gallery__image' );
        } else {
            clicked = this.$target.find( '.flex-active-slide' );
        }

        var options = {
            index:                 $( clicked ).index(),
            shareEl:               false,
            closeOnScroll:         false,
            history:               false,
            hideAnimationDuration: 0,
            showAnimationDuration: 0
        };

        // Initializes and opens PhotoSwipe.
        var photoswipe = new PhotoSwipe( pswpElement, PhotoSwipeUI_Default, items, options );
        photoswipe.init();
    };

    /**
     * Function to call wc_product_gallery on jquery selector.
     */
    $.fn.wc_product_gallery = function( args ) {
        new ProductGallery( this, args );
        return this;
    };

    /*
     * Initialize all galleries on page.
     */
    $( '.woocommerce-product-gallery' ).each( function() {
        $( this ).wc_product_gallery();
    } );

})( jQuery, window, document );