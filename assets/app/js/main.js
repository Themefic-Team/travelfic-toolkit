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

    SubMenuHandleEvents();

    // Reinitialize the menu events on window resize
    $(window).resize(function () {
      SubMenuHandleEvents();
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



/**
 *
 * Navbar Submenu handler
 *
 */
function SubMenuHandleEvents() {
  var windowWidth = jQuery(window).width();

  if (windowWidth > 1199) {
    jQuery(".tft-design-3 .menu-item-has-children")
      .off("click")
      .hover(
        function () {
          jQuery(this).children("ul.sub-menu").css("transform", "translateY(5px)").stop(true, true).slideDown(100);
        },
        function () {
          jQuery(this).children("ul.sub-menu").stop(true, true).slideUp(100);
        }
      );
  } else {
  
    jQuery(".tft-design-3 .menu-item-has-children > a")
      .off("click")
      .click(function (e) {
        var $parentLi = jQuery(this).parent();
        var $submenu = $parentLi.children(".sub-menu");

        if ($submenu.length > 0) {
          e.preventDefault();
          e.stopPropagation();

          if ($submenu.is(":visible")) {
            $submenu.slideUp();
          } else {
            $parentLi.siblings().children(".sub-menu").slideUp(); 
            $submenu.slideDown(); 
          }
        }
      });

    // Allow links without children to redirect
    jQuery(".tft-design-3 .menu-item-has-children .sub-menu a")
      .off("click")
      .click(function (e) {
        var $submenu = jQuery(this).siblings("ul.sub-menu");

        if ($submenu.length > 0) {
          // Prevent redirection and toggle visibility of the nested submenu
          e.preventDefault();
          e.stopPropagation();

          if ($submenu.is(":visible")) {
            $submenu.slideUp();
          } else {
            jQuery(this).parent().siblings().children(".sub-menu").slideUp(); 
            $submenu.slideDown(); 
          }
        }
      });
  }
}

/**
 *
 * Sidebar
 *
 */

const mobileMenuToggle = document.getElementById("mobile-menu-toggle");
const mobileSidenav = document.getElementById("mobile-sidenav");
const closeMobileMenu = document.getElementById("close-mobile-menu");

//  Toggle the sidenav
if(mobileMenuToggle && mobileSidenav) {
  mobileMenuToggle.addEventListener("click", function () {
    mobileSidenav.classList.toggle("open");
  });
}

// Close the sidenav
if(closeMobileMenu && mobileSidenav) {
  closeMobileMenu.addEventListener("click", function () {
    mobileSidenav.classList.remove("open");
  });
}

/**
 *
 * Search Form
 *
 */

const toggleSearchForm = (button, form) => {
  if(button && form) {
    button.addEventListener("click", function (event) {
      event.stopPropagation();
      form.classList.toggle("active");
    });

    form.addEventListener("click", function (event) {
      event.stopPropagation();
    });
  }
};

toggleSearchForm(document.getElementById("tftSearchBtn"), document.getElementById("tftSearchForm"));
toggleSearchForm(document.getElementById("tftMobileSearchBtn"), document.getElementById("tftMobileSearchForm"));

/**
 *
 * Team Social Icons
 *
 */
const shareButtons = document.querySelectorAll(".share-btn");
const socialMediaIcons = document.querySelectorAll(".social-media");

//  Toggle social media icons
if(shareButtons){
  shareButtons.forEach((button) => {
    button.addEventListener("click", function (e) {
      e.stopPropagation();
      const socialMedia = this.closest(".social-media-icons").querySelector(
        ".social-media"
      );
      if(socialMedia){
        socialMedia.classList.toggle("active");
      }
    });
  });
}


if(socialMediaIcons){
  socialMediaIcons.forEach((icon) => {
    icon.addEventListener("click", function (e) {
      e.stopPropagation();
    });
  });
}


/**
 *
 * Click outside
 *
 */
document.body.addEventListener("click", function (e) {
  // Check if the clicked element is outside the search form
  const searchForm = document.getElementById("tftSearchForm");
  const mobileSearchForm = document.getElementById("tftMobileSearchForm");

  if(searchForm){
    searchForm.classList.remove("active");
  }

  if(mobileSearchForm){
    mobileSearchForm.classList.remove("active");
  }

  //  Check if the clicked element is outside the mobile sidenav
  if(mobileSidenav && mobileMenuToggle){
    if (!mobileSidenav.contains(e.target) && !mobileMenuToggle.contains(e.target)) {
      mobileSidenav.classList.remove("open");
    }
  }

  if(socialMediaIcons){
    socialMediaIcons.forEach((icon) => {
      icon.classList.remove("active");
    });
  }
});
