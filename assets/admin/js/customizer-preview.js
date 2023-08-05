(function ($) {
  wp.customize("travelfic_customizer_settings_site_phone", function (value) {
    value.bind(function (newValue) {
      $("#tft-site-phone").html(newValue);
      console.log(newValue);
    });
  });

  wp.customize("travelfic_customizer_settings_site_email", function (value) {
    value.bind(function (newValue) {
      $("#tft-site-email").html(newValue);
      console.log(newValue);
    });
  });

  wp.customize("travelfic_customizer_settings_site_address", function (value) {
    value.bind(function (newValue) {
      $("#tft-site-address").html(newValue);
      console.log(newValue);
    });
  });
})(jQuery);
