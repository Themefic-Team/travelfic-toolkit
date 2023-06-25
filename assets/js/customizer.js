(function ($) {
    wp.customize('travelfic_customizer_settings_stiky_header', function (value) {
      // Function to toggle the visibility of the fields
      function toggleFields(value) {
        console.log(value);
        if ('enabled' === value) {
          $('li[id*="travelfic_customizer_settings_stiky_header_bg_color"]').show();
          $('li[id*="travelfic_customizer_settings_stiky_header_blur"]').show();
          $('li[id*="travelfic_customizer_settings_stiky_header_menu_text_color"]').show();
        } else {
          $('li[id*="travelfic_customizer_settings_stiky_header_bg_color"]').hide();
          $('li[id*="travelfic_customizer_settings_stiky_header_blur"]').hide();
          $('li[id*="travelfic_customizer_settings_stiky_header_menu_text_color"]').hide();
        }
      }
  
      // Toggle the fields on initial load
      toggleFields(value.get());
  
      // Toggle the fields when the option value changes
      value.bind(function (newVal) {
        toggleFields(newVal);
      });
    });


    // Header Builder Tabs

    wp.customize('travelfic_customizer_settings_header_tab_select', function (value) {
      // Function to toggle the visibility of the fields
      function tab_toggleFields(value) {
        if ('design' === value) {
          $('li[id*="customize-control-travelfic_customizer_settings_header_section_opt"]').show();
          $('li[id*="customize-control-travelfic_customizer_settings_menu_color"]').show();
          $('li[id*="customize-control-travelfic_customizer_settings_menu_hover_color"]').show();
          $('li[id*="customize-control-travelfic_customizer_settings_submenu_bg"]').show();
          $('li[id*="customize-control-travelfic_customizer_settings_submenu_text_color"]').show();
          $('li[id*="customize-control-travelfic_customizer_settings_submenu_text_hover_color"]').show();
          $('li[id*="customize-control-travelfic_customizer_settings_header_design_select"]').hide();
          $('li[id*="customize-control-travelfic_customizer_settings_header_sticky_section_opt"]').hide();
          $('li[id*="customize-control-travelfic_customizer_settings_stiky_header"]').hide();
          $('li[id*="customize-control-travelfic_customizer_settings_transparent_header"]').hide();
        } else {
          $('li[id*="customize-control-travelfic_customizer_settings_header_section_opt"]').hide();
          $('li[id*="customize-control-travelfic_customizer_settings_menu_color"]').hide();
          $('li[id*="customize-control-travelfic_customizer_settings_menu_hover_color"]').hide();
          $('li[id*="customize-control-travelfic_customizer_settings_submenu_bg"]').hide();
          $('li[id*="customize-control-travelfic_customizer_settings_submenu_text_color"]').hide();
          $('li[id*="customize-control-travelfic_customizer_settings_submenu_text_hover_color"]').hide();
          $('li[id*="customize-control-travelfic_customizer_settings_header_design_select"]').show();
          $('li[id*="customize-control-travelfic_customizer_settings_header_sticky_section_opt"]').show();
          $('li[id*="customize-control-travelfic_customizer_settings_stiky_header"]').show();
          $('li[id*="customize-control-travelfic_customizer_settings_transparent_header"]').show();
        }
      }
  
      // Toggle the fields on initial load
      tab_toggleFields(value.get());
  
      // Toggle the fields when the option value changes
      value.bind(function (newVal) {
        tab_toggleFields(newVal);
      });
    });

    // Image Select Input Bind
    wp.customize.controlConstructor['image_select'] = wp.customize.Control.extend({
        ready: function() {
            var control = this;
            var value = (undefined !== control.setting._value) ? control.setting._value : '';
    
            this.container.on( 'change', 'input:radio', function() {
                value = jQuery( this ).val();
                control.setting.set( value );
                // refresh the preview
                wp.customize.previewer.refresh();
            });
        }
    });
    // Tab Select Input Bind
    wp.customize.controlConstructor['tab_select'] = wp.customize.Control.extend({
      ready: function() {
          var control = this;
          var value = (undefined !== control.setting._value) ? control.setting._value : '';
  
          this.container.on( 'change', 'input:radio', function() {
              value = jQuery( this ).val();
              control.setting.set( value );
              // refresh the preview
              wp.customize.previewer.refresh();
          });
      }
  });

})(jQuery);
  