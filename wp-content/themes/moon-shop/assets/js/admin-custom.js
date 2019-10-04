(function ($) {

    "use strict";


    $(".sidebar-open").on('click', function () {

        $(".sidebar-open").css("display", "none");

    });


    $(".sidebar-open").on('click', function () {

        $(".sidebar-close").css("display", "block");

    });


    $(".sidebar-open").on('click', function () {

        $(".msk-theme-option-menu").css("left", "0px");

    });


    $(".sidebar-close").on('click', function () {

        $(".msk-theme-option-menu").css("left", "-100%");

    });


    $(".sidebar-close").on('click', function () {

        $(".sidebar-open").css("display", "block");

    });


    $(".sidebar-close").on('click', function () {

        $(".sidebar-close").css("display", "none");

    });


    /* dropkick */

    $(".opt_group").dropkick({

        mobile: true

    });


    /* range-slider */

    (function () {


        var selector = '[data-rangeSlider]',

            elements = document.querySelectorAll(selector); console.log(elements);


        // Example functionality to demonstrate a value feedback

        function valueOutput(element) {

            var value = element.value,

                output = element.parentNode.getElementsByTagName('output')[0];

            output.innerHTML = value;

        }


        for (var i = elements.length - 1; i >= 0; i--) {

            valueOutput(elements[i]);

        }


        Array.prototype.slice.call(document.querySelectorAll('input[type="range"]')).forEach(function (el) {

            el.addEventListener('input', function (e) {

                valueOutput(e.target);

            }, false);

        });


        // Basic rangeSlider initialization

        rangeSlider.create(elements, {

            min: 0,

            max: 1,

            value: 0,

            borderRadius: 3,

            buffer: 0,

            minEventInterval: 1000,


            // Callback function

            onInit: function () {

            },


            // Callback function

            onSlideStart: function (value, percent, position) {

                console.info('onSlideStart', 'value: ' + value, 'percent: ' + percent, 'position: ' + position);

            },


            // Callback function

            onSlide: function (value, percent, position) {

                console.log('onSlide', 'value: ' + value, 'percent: ' + percent, 'position: ' + position);

            },


            // Callback function

            onSlideEnd: function (value, percent, position) {

                console.warn('onSlideEnd', 'value: ' + value, 'percent: ' + percent, 'position: ' + position);

            }

        });


    })();


})(jQuery); 