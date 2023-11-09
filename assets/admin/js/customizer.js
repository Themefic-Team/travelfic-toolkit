(function ($) {
    
    // Header Builder Tabs

    // Sticky Design
    const makeStickyDesign = () => {
      wp.customize('travelfic_customizer_settings_stiky_header', function (value) {
        // Function to toggle the visibility of the fields
        function toggleFields(value) {
          if ('enabled' === value) {
            $('li[id*="travelfic_customizer_settings_stiky_header_bg_color"],li[id*="travelfic_customizer_settings_stiky_header_blur"],li[id*="travelfic_customizer_settings_stiky_header_menu_text_color"]').show();
          } else {
            $('li[id*="travelfic_customizer_settings_stiky_header_bg_color"],li[id*="travelfic_customizer_settings_stiky_header_blur"],li[id*="travelfic_customizer_settings_stiky_header_menu_text_color"]').hide();
          }
        }
    
        toggleFields(value.get());
    
        value.bind(function (newVal) {
          toggleFields(newVal);
        });
      });
    }

    // Transparent Design
    const makeTransparentDesign = () => {
      wp.customize('travelfic_customizer_settings_transparent_header', function (value) {
        // Function to toggle the visibility of the fields
        function toggleFields(value) {
          if ('enabled' === value) {
            $('li[id*="travelfic_customizer_settings_transparent_showing"]').show();
          } else {
            $('li[id*="travelfic_customizer_settings_transparent_showing"]').hide();
          }
        }
    
        toggleFields(value.get());
    
        value.bind(function (newVal) {
          toggleFields(newVal);
        });
      });
    }

    const makeDesign2 = () => {
      wp.customize('travelfic_customizer_settings_header_design_select', function (value) {
        function toggleFields(value) {
          if ('design2' === value) {
            $('li[id*="travelfic_customizer_settings_header_design_2_topbar"], li[id*="travelfic_customizer_settings_design_2_top_header_bg"], li[id*="travelfic_customizer_settings_design_2_top_header_color"], li[id*="travelfic_customizer_settings_header_design_2_section_opt"],li[id*="travelfic_customizer_settings_design_2_phone"],li[id*="travelfic_customizer_settings_design_2_email"], li[id*="travelfic_customizer_settings_design_2_registration_url"], li[id*="travelfic_customizer_settings_design_2_login_url"]').show();

            
            // Topbar bg site for settings tab
            $('li[id*="travelfic_customizer_settings_design_2_top_header_bg"], li[id*="travelfic_customizer_settings_design_2_top_header_color"]').hide();
          } else {
            $('li[id*="travelfic_customizer_settings_header_design_2_topbar"], li[id*="travelfic_customizer_settings_design_2_top_header_bg"], li[id*="travelfic_customizer_settings_header_design_2_section_opt"],li[id*="travelfic_customizer_settings_design_2_phone"],li[id*="travelfic_customizer_settings_design_2_email"], li[id*="travelfic_customizer_settings_design_2_registration_url"], li[id*="travelfic_customizer_settings_design_2_login_url"]').hide();
          }
        }
    
        toggleFields(value.get());
    
        value.bind(function (newVal) {
          toggleFields(newVal);
        });
      });
    }

    wp.customize('travelfic_customizer_settings_header_tab_select', function (value) {

      function tab_toggleFields(value) {

        // Tab Dependancy Checked
        if ('design' === value) {
          $('li[id*="travelfic_customizer_settings_design_2_top_header_bg"], li[id*="travelfic_customizer_settings_design_2_top_header_color"], li[id*="customize-control-travelfic_customizer_settings_header_section_opt"], li[id*="customize-control-travelfic_customizer_settings_menu_color"], li[id*="customize-control-travelfic_customizer_settings_menu_hover_color"], li[id*="customize-control-travelfic_customizer_settings_submenu_bg"], li[id*="customize-control-travelfic_customizer_settings_submenu_text_color"], li[id*="customize-control-travelfic_customizer_settings_submenu_text_hover_color"], li[id*="customize-control-travelfic_customizer_settings_header_menu_typo"], li[id*="customize-control-travelfic_customizer_settings_header_submenu_typo"] ').show();
          
          $('li[id*="customize-control-travelfic_customizer_settings_header_design_select"], li[id*="customize-control-travelfic_customizer_settings_header_sticky_section_opt"], #customize-control-travelfic_customizer_settings_stiky_header, li[id*="customize-control-travelfic_customizer_settings_transparent_header"], li[id*="customize-control-travelfic_customizer_settings_header_width"]').hide();

          // Design 2 settings hide for design tab
          $('li[id*="travelfic_customizer_settings_header_design_2_topbar"], li[id*="travelfic_customizer_settings_header_design_2_section_opt"],li[id*="travelfic_customizer_settings_design_2_phone"],li[id*="travelfic_customizer_settings_design_2_email"], li[id*="travelfic_customizer_settings_design_2_registration_url"], li[id*="travelfic_customizer_settings_design_2_login_url"]').hide();
          
          // Transparent Header Design settings hide for settings Design Tab
          $('li[id*="travelfic_customizer_settings_transparent_showing"]').hide();

          makeStickyDesign();

        } else {
      
          $('li[id*="customize-control-travelfic_customizer_settings_header_section_opt"], li[id*="customize-control-travelfic_customizer_settings_menu_color"], li[id*="customize-control-travelfic_customizer_settings_menu_hover_color"], li[id*="customize-control-travelfic_customizer_settings_submenu_bg"], li[id*="customize-control-travelfic_customizer_settings_submenu_text_color"], li[id*="customize-control-travelfic_customizer_settings_submenu_text_hover_color"], li[id*="customize-control-travelfic_customizer_settings_header_menu_typo"], li[id*="customize-control-travelfic_customizer_settings_header_submenu_typo"] ').hide();
          
          $('li[id*="customize-control-travelfic_customizer_settings_header_design_select"], li[id*="customize-control-travelfic_customizer_settings_header_sticky_section_opt"], #customize-control-travelfic_customizer_settings_stiky_header, li[id*="customize-control-travelfic_customizer_settings_transparent_header"], li[id*="customize-control-travelfic_customizer_settings_header_width"]').show();

          // Sticky Design settings hide for settings tab
          $('li[id*="travelfic_customizer_settings_stiky_header_bg_color"],li[id*="travelfic_customizer_settings_stiky_header_blur"],li[id*="travelfic_customizer_settings_stiky_header_menu_text_color"]').hide();

          makeDesign2();
          makeTransparentDesign();

        }
      }
      
      // Toggle the fields on initial load
      tab_toggleFields(value.get());
  
      // Toggle the fields when the option value changes
      value.bind(function (newVal) {
        tab_toggleFields(newVal);
      });
    });


    // Footer Builder Tabs

    wp.customize('travelfic_customizer_settings_footer_tab_select', function (value) {
      function tab_toggleFields(value) {
        
        if ('design' === value) {
          $('li[id*="customize-control-travelfic_customizer_settings_footer_bg_color"], li[id*="customize-control-travelfic_customizer_settings_footer_text_color"] ').show();
          
          $('li[id*="customize-control-travelfic_customizer_settings_footer_width"], li[id*="customize-control-travelfic_customizer_settings_footer_design_select"], li[id*="customize-control-travelfic_customizer_settings_copyright_text"] ').hide();
          
        } else {
      
          $('li[id*="customize-control-travelfic_customizer_settings_footer_width"], li[id*="customize-control-travelfic_customizer_settings_footer_design_select"], li[id*="customize-control-travelfic_customizer_settings_copyright_text"] ').show();
          
          $('li[id*="customize-control-travelfic_customizer_settings_footer_bg_color"], li[id*="customize-control-travelfic_customizer_settings_footer_text_color"] ').hide();
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
              wp.customize.previewer.refresh();
          });
      }
    });

    // Switcher Input Bind
    wp.customize.controlConstructor['switcher_section'] = wp.customize.Control.extend({
      ready: function() {
          var control = this;
          var value = (undefined !== control.setting._value) ? control.setting._value : '';
  
          this.container.on('change', 'input:checkbox', function() {
            value = jQuery(this).prop('checked') ? 'true' : '';
            control.setting.set(value);
            wp.customize.previewer.refresh();
        });
      }
    });

  // Typography Trigger & Input Bind
  wp.customize.controlConstructor['typography'] = wp.customize.Control.extend({
    ready: function () {
        var control = this;

        control.container.on('change', 'input, select', function () {
            control.settings.default['value'] = control.getValue();
            control.setting.set(control.getValue());
        });
    },

    getValue: function () {
        var control = this,
            value = {};

        control.container.find('input, select').each(function () {
            var input = $(this),
                settingId = input.data('customize-setting-link'),
                inputValue = '';

            if ('SELECT' === input.prop('tagName')) {
                inputValue = input.find('option:selected').val();
            } else {
                inputValue = input.val();
            }

            value[settingId] = inputValue;
        });

        return value;
    }
  });

})(jQuery);
  