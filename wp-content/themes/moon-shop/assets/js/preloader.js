(function (jQuery) {
		var style = moon_shop_loader.style;

        jQuery(document).ready(function() {
            if (style == 'simple') {
                jQuery("#element").introLoader({
                    spinJs: {
                        lines: 13, // The number of lines to draw
                        length: 15, // The length of each line
                        width: 5, // The line thickness
                        radius: 20, // The radius of the inner circle
                        corners: 1, // Corner roundness (0..1)
                        color: '#fff', // #rgb or #rrggbb or array of colors
                    }
                });
            } else if(style == 'double') {
                jQuery("#element").introLoader({
                    animation: {
                        name: 'doubleLoader',
                        options: {
                            //ease: "easeInOutCirc",
                            style: 'light',
                            delayBefore: 500,
                            exitTime: 500,
                            progbarTime: 1000,
                            progbarDelayAfter: 400
                        }
                    }
                });
            } else if(style == 'count') {
                jQuery("#element").introLoader({
                    animation: {
                        name: 'counterLoader',
                        options: {
                            ease: "easeOutSine",
                            style: 'fluoGreen',
                            animationTime: 1500
                        }
                    }
                });
            }
        });
})(jQuery);	