;(function ($) {
  $(document).ready(function () {
    wp.customize('travelfic_customizer_settings_header_design_select', function (value) {
      value.bind(function (newValue) {
        if(newValue){
          setTimeout(function () {
            $('#customize-control-travelfic_customizer_settings_menu_font_line_height').hide();
            $('#customize-control-travelfic_customizer_settings_menu_font_line_height').hide();
            $('#customize-control-travelfic_customizer_settings_menu_font_transform').hide();
            $('#customize-control-travelfic_customizer_settings_menu_font_letter_space').hide();
            $('#customize-control-travelfic_customizer_settings_menu_font_decoration').hide();
      
            $('#customize-control-travelfic_customizer_settings_submenu_font_line_height').hide();
            $('#customize-control-travelfic_customizer_settings_submenu_font_line_height').hide();
            $('#customize-control-travelfic_customizer_settings_submenu_font_transform').hide();
            $('#customize-control-travelfic_customizer_settings_submenu_font_letter_space').hide();
            $('#customize-control-travelfic_customizer_settings_submenu_font_decoration').hide();
          }, 200);
        }
      });
    });
  });
})(jQuery);
