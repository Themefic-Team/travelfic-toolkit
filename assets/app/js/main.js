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

    // submenu toggle
    $(".tft-design-3 .menu-item-has-children").click(function (e) {
      e.preventDefault();
      e.stopPropagation();
  
      // Get the current submenu
      var $submenu = $(this).children('.sub-menu');
    
      // Toggle visibility of the current submenu and hide others
      if ($submenu.is(":visible")) {
        $submenu.fadeOut();
      } else {
        $(".mobile-sidenav__nav ul.sub-menu").fadeOut(); // Hide all other submenus
        $submenu.fadeIn(); // Show the current submenu
      }
    });

    // Hover over parent to show the submenu
    $('.tft-design-3 .menu-item-has-children').hover(function() {
      $(this).children('ul.sub-menu').stop(true, true).slideDown(100);
    }, function() {
      $(this).children('ul.sub-menu').stop(true, true).slideUp(100);
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
 * Sidebar
 * 
*/

 const mobileMenuToggle = document.getElementById("mobile-menu-toggle");
 const mobileSidenav = document.getElementById("mobile-sidenav");
 const closeMobileMenu = document.getElementById("close-mobile-menu");

//  Toggle the sidenav
 mobileMenuToggle.addEventListener("click", function () {
   mobileSidenav.classList.toggle("open");
 });

 // Close the sidenav
 closeMobileMenu.addEventListener("click", function () {
   mobileSidenav.classList.remove("open");
 });

/**
 * 
 * Search Form
 * 
*/
 // Select the button and the form
 const tftSearchBtn = document.getElementById("tftSearchBtn");
 const tftSearchForm = document.getElementById("tftSearchForm");

//  Toggle the form
 tftSearchBtn.addEventListener("click", function (event) {
     event.stopPropagation();
     tftSearchForm.classList.toggle("active");
 });

 tftSearchForm.addEventListener("click", function (event) {
     event.stopPropagation();
 });

 /**
 * 
 * Team Social Icons
 * 
*/
 const shareButtons = document.querySelectorAll(".share-btn");
 const socialMediaIcons = document.querySelectorAll(".social-media");

//  Toggle social media icons
 shareButtons.forEach((button) => {
     button.addEventListener("click", function (e) {
         e.stopPropagation();
         const socialMedia = this.closest(".social-media-icons").querySelector(".social-media");
         socialMedia.classList.toggle("active");
     });
 });

 socialMediaIcons.forEach((icon) => {
     icon.addEventListener("click", function (e) {
         e.stopPropagation();
     });
 });


/**
 * 
 * Click outside
 * 
*/
document.body.addEventListener("click", function (e) {
  // Check if the clicked element is outside the search form
   tftSearchForm.classList.remove("active");

  //  Check if the clicked element is outside the mobile sidenav
   if (!mobileSidenav.contains(e.target) && !mobileMenuToggle.contains(e.target)) {
     mobileSidenav.classList.remove("open");
   }
  //  Check if the clicked element is outside the social media icons
   socialMediaIcons.forEach((icon) => {
     icon.classList.remove("active");
   });
});