(function ($) {
    wp.customize('travelfic_customizer_settings_stiky_header', function (value) {
      // Function to toggle the visibility of the fields
      function toggleFields(value) {
        if ('enabled' === value) {
          $('li[id*="travelfic_customizer_settings_stiky_header_bg_color"],li[id*="travelfic_customizer_settings_stiky_header_blur"],li[id*="travelfic_customizer_settings_stiky_header_menu_text_color"]').show();
        } else {
          $('li[id*="travelfic_customizer_settings_stiky_header_bg_color"],li[id*="travelfic_customizer_settings_stiky_header_blur"],li[id*="travelfic_customizer_settings_stiky_header_menu_text_color"]').hide();
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

      function tab_toggleFields(value) {
        // var Sticky_checked = wp.customize.instance('travelfic_customizer_settings_stiky_header').get();
        // // Sticky Checked
        // if ('enabled' === Sticky_checked) {
        //   $('li[id*="customize-control-travelfic_customizer_settings_stiky_header_bg_color"]').show();
        // } else {
        //   $('li[id*="customize-control-travelfic_customizer_settings_stiky_header_bg_color"]').hide();
        // }
        
        // Tab Dependancy Checked
        if ('design' === value) {
          $('li[id*="customize-control-travelfic_customizer_settings_header_section_opt"], li[id*="customize-control-travelfic_customizer_settings_menu_color"], li[id*="customize-control-travelfic_customizer_settings_menu_hover_color"], li[id*="customize-control-travelfic_customizer_settings_submenu_bg"], li[id*="customize-control-travelfic_customizer_settings_submenu_text_color"], li[id*="customize-control-travelfic_customizer_settings_submenu_text_hover_color"], li[id*="customize-control-travelfic_customizer_settings_header_menu_typo"], li[id*="customize-control-travelfic_customizer_settings_header_submenu_typo"] ').show();
          
          $('li[id*="customize-control-travelfic_customizer_settings_header_design_select"], li[id*="customize-control-travelfic_customizer_settings_header_sticky_section_opt"], #customize-control-travelfic_customizer_settings_stiky_header, li[id*="customize-control-travelfic_customizer_settings_transparent_header"], li[id*="customize-control-travelfic_customizer_settings_header_width"]').hide();
          
        } else {
      
          $('li[id*="customize-control-travelfic_customizer_settings_header_section_opt"], li[id*="customize-control-travelfic_customizer_settings_menu_color"], li[id*="customize-control-travelfic_customizer_settings_menu_hover_color"], li[id*="customize-control-travelfic_customizer_settings_submenu_bg"], li[id*="customize-control-travelfic_customizer_settings_submenu_text_color"], li[id*="customize-control-travelfic_customizer_settings_submenu_text_hover_color"], li[id*="customize-control-travelfic_customizer_settings_header_menu_typo"], li[id*="customize-control-travelfic_customizer_settings_header_submenu_typo"] ').hide();
          
          $('li[id*="customize-control-travelfic_customizer_settings_header_design_select"], li[id*="customize-control-travelfic_customizer_settings_header_sticky_section_opt"], #customize-control-travelfic_customizer_settings_stiky_header, li[id*="customize-control-travelfic_customizer_settings_transparent_header"], li[id*="customize-control-travelfic_customizer_settings_header_width"]').show();
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
          
          $('li[id*="customize-control-travelfic_customizer_settings_footer_width"], li[id*="customize-control-travelfic_customizer_settings_footer_design_select"] ').hide();
          
        } else {
      
          $('li[id*="customize-control-travelfic_customizer_settings_footer_width"], li[id*="customize-control-travelfic_customizer_settings_footer_design_select"] ').show();
          
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
  