;
(function ($) {
    "use strict";

    $(document).ready(function () {

        // Stiky Menu
        $(window).scroll(function () {
            if ($(this).scrollTop() > 0) {
                $('.tft_has_sticky').addClass("tft-navbar-shrink");
            } else {
                $('.tft_has_sticky').removeClass("tft-navbar-shrink");
            }
        });

    });

}(jQuery));