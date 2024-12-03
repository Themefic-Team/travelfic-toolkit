(function ($) {
  "use strict";

  $(document).ready(function () {
    // Stiky Menu
    $(window).scroll(function () {
      if ($(this).scrollTop() > 0) {
        $(".tft_has_sticky").addClass("tft-navbar-shrink");
      } else {
        $(".tft_has_sticky").removeClass("tft-navbar-shrink");
      }
    });

    // Open the sidenav
    $("#mobile-menu-toggle").on("click", function () {
      $("#mobile-sidenav").addClass("open");
    });

    // Close the sidenav
    $("#close-mobile-menu").on("click", function () {
      $("#mobile-sidenav").removeClass("open");
    });

    // Close sidenav when clicking outside
    $(document).on("click", function (e) {
      if (!$(e.target).closest("#mobile-sidenav, #mobile-menu-toggle").length) {
        $("#mobile-sidenav").removeClass("open");
      }
    });

    // Hero slider
    $(".tft-hero-design-4__slider").slick({
      infinite: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 6000,
      speed: 1500,
      dots: true,
      arrows: false,
      pauseOnFocus: false,
      pauseOnHover: false,
    });

    // Share button for mobile
    function initializeMobileShare() {
      $(".tft-hero-design-4__mobile--share").off("click");
      $(document).off("click");

      if ($(window).width() <= 1199) {
        $(".tft-hero-design-4__mobile--share").on("click", function () {
          $(".tft-hero-design-4__social")
            .addClass("visible")
            .animate({ left: "0px" }, 400);
        });

        $(document).on("click", function (event) {
          if (
            !$(event.target).closest(
              ".tft-hero-design-4__mobile--share, .tft-hero-design-4__social"
            ).length
          ) {
            $(".tft-hero-design-4__social").animate(
              { left: "-100%" },
              400,
              function () {
                $(this).removeClass("visible");
              }
            );
          }
        });
      }
    }

    initializeMobileShare();

    $(window).resize(function () {
      initializeMobileShare();
    });

    // loader
    setTimeout(function () {
      $("#loader").fadeOut(500, function () {});
    }, 500);
  });
})(jQuery);
