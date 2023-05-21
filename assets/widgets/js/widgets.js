(function ($) {
  "use strict";
  $(document).ready(function () {
    //Testimonials
    $(".tft-testimonials-selector").slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 6000,
      speed: 700,
      dots: false,
      pauseOnHover: true,
      infinite: true,
      cssEase: "linear",
      arrows: true,
      prevArrow:
        "<button type='button' class='slick-prev pull-left'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
      nextArrow:
        "<button type='button' class='slick-next pull-right'><i class='fa fa-angle-right' aria-hidden='true'></i></button>",
      responsive: [
        {
          breakpoint: 991,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
            infinite: true,
            dots: false,
          },
        },
        {
          breakpoint: 767,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
      ],
    });

    //Popular Tours
    $(".tft-popular-tour-selector").slick({
      infinite: true,
      slidesToShow: 3,
      slidesToScroll: 1,
      arrows: true,
      centerMode: true,
      dots: false,
      pauseOnHover: true,
      autoplay: true,
      autoplaySpeed: 7000,
      arrows: true,
      prevArrow:
        "<button type='button' class='slick-prev pull-left'><i class='fa fa-angle-left' aria-hidden='true'></i></button>",
      nextArrow:
        "<button type='button' class='slick-next pull-right'><i class='fa fa-angle-right' aria-hidden='true'></i></button>",
      speed: 700,
      responsive: [
        {
          breakpoint: 1024,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 991,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          },
        },
        {
          breakpoint: 480,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
          },
        },
      ],
    });
  });
})(jQuery);
