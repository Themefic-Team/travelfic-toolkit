(function ($) {
    // Heading Typography Selection
    wp.customize.control( 'travelfic_customizer_settings_heading_font_family', function( control ) {
      control.container.find( 'select' ).select2({
        placeholder: 'Select Fonts Family',
        allowClear: true
      });
    });

    // Body Typography Selection
    wp.customize.control( 'travelfic_customizer_settings_body_font_family', function( control ) {
      control.container.find( 'select' ).select2({
        placeholder: 'Select Fonts Family',
        allowClear: true
      });
    });

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
            $('li[id*="travelfic_customizer_settings_transparent_showing"], li[id*="travelfic_customizer_settings_trasnparent_logo"]').show();
          } else {
            $('li[id*="travelfic_customizer_settings_transparent_showing"], li[id*="travelfic_customizer_settings_trasnparent_logo"]').hide();
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

          
          if ('design3' === value) {
            // show design 3 settings
            $('li[id*="travelfic_customizer_settings_header_design_3_location"], li[id*="travelfic_customizer_settings_header_design_3_topbar"], li[id*="travelfic_customizer_settings_design_3_top_header_bg"], li[id*="travelfic_customizer_settings_design_3_top_header_color"], li[id*="travelfic_customizer_settings_header_design_3_section_opt"],li[id*="travelfic_customizer_settings_design_3_phone"],li[id*="travelfic_customizer_settings_design_3_email"], li[id*="travelfic_customizer_settings_design_3_login_label"], li[id*="travelfic_customizer_settings_design_3_login_url"], li[id*="travelfic_customizer_settings_design_3_discover_label"] , li[id*="travelfic_customizer_settings_design_3_discover_url"], li[id*="customize-control-travelfic_customizer_settings_design_3_top_header_text_color"]').show();

             // hide design 2 settings
            $('li[id*="travelfic_customizer_settings_header_design_2_topbar"], li[id*="travelfic_customizer_settings_design_2_top_header_bg"], li[id*="travelfic_customizer_settings_design_2_top_header_color"], li[id*="travelfic_customizer_settings_header_design_2_section_opt"],li[id*="travelfic_customizer_settings_design_2_phone"],li[id*="travelfic_customizer_settings_design_2_email"], li[id*="travelfic_customizer_settings_design_2_registration_url"], li[id*="travelfic_customizer_settings_design_2_login_url"]').hide();
          }
          else if ('design2' === value) {
            
            // show design 2 settings
            $('li[id*="travelfic_customizer_settings_header_design_2_topbar"], li[id*="travelfic_customizer_settings_design_2_top_header_bg"], li[id*="travelfic_customizer_settings_design_2_top_header_color"], li[id*="travelfic_customizer_settings_header_design_2_section_opt"],li[id*="travelfic_customizer_settings_design_2_phone"],li[id*="travelfic_customizer_settings_design_2_email"], li[id*="travelfic_customizer_settings_design_2_registration_url"], li[id*="travelfic_customizer_settings_design_2_login_url"]').show();

            // hide design 3 settings
            $('li[id*="travelfic_customizer_settings_header_design_3_location"], li[id*="travelfic_customizer_settings_header_design_3_topbar"], li[id*="travelfic_customizer_settings_design_3_top_header_bg"], li[id*="travelfic_customizer_settings_design_3_top_header_color"], li[id*="travelfic_customizer_settings_header_design_3_section_opt"],li[id*="travelfic_customizer_settings_design_3_phone"],li[id*="travelfic_customizer_settings_design_3_email"], li[id*="travelfic_customizer_settings_design_3_login_label"], li[id*="travelfic_customizer_settings_design_3_login_url"], li[id*="travelfic_customizer_settings_design_3_discover_label"] , li[id*="travelfic_customizer_settings_design_3_discover_url"]').hide();
            
            // Topbar bg site for settings tab
            $('li[id*="travelfic_customizer_settings_design_2_top_header_bg"], li[id*="travelfic_customizer_settings_design_2_top_header_color"]').hide();
          } else {

            // hide design 3 settings
            $('li[id*="customize-control-travelfic_customizer_settings_design_3_location"], li[id*="travelfic_customizer_settings_header_design_3_topbar"], li[id*="travelfic_customizer_settings_design_3_top_header_bg"], li[id*="travelfic_customizer_settings_design_3_top_header_color"], li[id*="travelfic_customizer_settings_header_design_3_section_opt"],li[id*="travelfic_customizer_settings_design_3_phone"],li[id*="travelfic_customizer_settings_design_3_email"], li[id*="travelfic_customizer_settings_design_3_login_label"], li[id*="travelfic_customizer_settings_design_3_login_url"], li[id*="travelfic_customizer_settings_design_3_discover_label"] , li[id*="travelfic_customizer_settings_design_3_discover_url"], li[id*="customize-control-travelfic_customizer_settings_design_3_top_header_text_color"]').hide();
            
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
          
          $('li[id*="customize-control-travelfic_customizer_settings_header_design_select"], li[id*="customize-control-travelfic_customizer_settings_header_sticky_section_opt"], #customize-control-travelfic_customizer_settings_stiky_header, li[id*="customize-control-travelfic_customizer_settings_transparent_header"], li[id*="customize-control-travelfic_customizer_settings_header_width"],li[id*="customize-control-travelfic_customizer_settings_design_3_header_btn_bg_color"], li[id*="customize-control-travelfic_customizer_settings_design_3_header_btn_hover_bg_color"]').hide();

          // Design 2 settings hide for design tab
          $('li[id*="customize-control-travelfic_customizer_settings_design_2_top_header_color"], li[id*="customize-control-travelfic_customizer_settings_design_2_top_header_bg"], li[id*="travelfic_customizer_settings_header_design_2_topbar"], li[id*="travelfic_customizer_settings_header_design_2_section_opt"],li[id*="travelfic_customizer_settings_design_2_phone"],li[id*="travelfic_customizer_settings_design_2_email"], li[id*="travelfic_customizer_settings_design_2_registration_url"], li[id*="travelfic_customizer_settings_design_2_login_url"]').hide();
          
           // Design 3 settings hide for design tab
          $('li[id*="customize-control-travelfic_customizer_settings_design_3_location"], li[id*="travelfic_customizer_settings_header_design_3_topbar"], li[id*="travelfic_customizer_settings_design_3_top_header_bg"], li[id*="travelfic_customizer_settings_design_3_top_header_color"], li[id*="travelfic_customizer_settings_header_design_3_section_opt"],li[id*="travelfic_customizer_settings_design_3_phone"],li[id*="travelfic_customizer_settings_design_3_email"], li[id*="travelfic_customizer_settings_design_3_login_label"], li[id*="travelfic_customizer_settings_design_3_login_url"], li[id*="travelfic_customizer_settings_design_3_discover_label"], li[id*="travelfic_customizer_settings_design_3_discover_url"], li[id*="customize-control-travelfic_customizer_settings_design_3_top_header_text_color"]').hide();
          

          // Transparent Header Design settings hide for settings Design Tab
          $('li[id*="travelfic_customizer_settings_transparent_showing"], li[id*="travelfic_customizer_settings_trasnparent_logo"]').hide();

          $('li[id*="customize-control-travelfic_customizer_settings_transparent_menu_color"], li[id*="customize-control-travelfic_customizer_settings_transparent_menu_hover_color"], li[id*="customize-control-travelfic_customizer_settings_header_bg_color"], li[id*="customize-control-travelfic_customizer_settings_transparent_header_section_opt"], li[id*="customize-control-travelfic_customizer_settings_transparent_header_bg_color"], li[id*="customize-control-travelfic_customizer_settings_transparent_submenu_bg"], li[id*="customize-control-travelfic_customizer_settings_transparent_submenu_text_color"], li[id*="customize-control-travelfic_customizer_settings_transparent_submenu_text_hover_color"]').show();


          const headerDesign = $('input[name="travelfic_customizer_settings_header_design_select"]:checked').val();
          if ('design3' === headerDesign) {
            $('li[id*="customize-control-travelfic_customizer_settings_design_3_header_btn_bg_color"], li[id*="customize-control-travelfic_customizer_settings_design_3_header_btn_hover_bg_color"]').show();
          }

          makeStickyDesign();

        } else {
      
          $('li[id*="customize-control-travelfic_customizer_settings_header_section_opt"], li[id*="customize-control-travelfic_customizer_settings_menu_color"], li[id*="customize-control-travelfic_customizer_settings_menu_hover_color"], li[id*="customize-control-travelfic_customizer_settings_submenu_bg"], li[id*="customize-control-travelfic_customizer_settings_submenu_text_color"], li[id*="customize-control-travelfic_customizer_settings_submenu_text_hover_color"], li[id*="customize-control-travelfic_customizer_settings_header_menu_typo"], li[id*="customize-control-travelfic_customizer_settings_header_submenu_typo"] ').hide();
          
          $('li[id*="customize-control-travelfic_customizer_settings_header_design_select"], li[id*="customize-control-travelfic_customizer_settings_header_sticky_section_opt"], #customize-control-travelfic_customizer_settings_stiky_header, li[id*="customize-control-travelfic_customizer_settings_transparent_header"], li[id*="customize-control-travelfic_customizer_settings_header_width"]').show();

          // Sticky Design settings hide for settings tab
          $('li[id*="travelfic_customizer_settings_stiky_header_bg_color"],li[id*="travelfic_customizer_settings_stiky_header_blur"],li[id*="travelfic_customizer_settings_stiky_header_menu_text_color"]').hide();

          $('li[id*="customize-control-travelfic_customizer_settings_transparent_menu_color"], li[id*="customize-control-travelfic_customizer_settings_transparent_menu_hover_color"], li[id*="customize-control-travelfic_customizer_settings_header_bg_color"], li[id*="customize-control-travelfic_customizer_settings_transparent_header_section_opt"], li[id*="customize-control-travelfic_customizer_settings_transparent_header_bg_color"], li[id*="customize-control-travelfic_customizer_settings_transparent_submenu_bg"], li[id*="customize-control-travelfic_customizer_settings_transparent_submenu_text_color"], li[id*="customize-control-travelfic_customizer_settings_transparent_submenu_text_hover_color"]').hide();

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


    // Footer Builder 
    const footerDesign = () => {
      wp.customize('travelfic_customizer_settings_footer_design_select', function (value) {
   
        function toggleFields(value) {

          
          if ('design3' === value) {
            // show design 3 settings
            $('li[id*="customize-control-travelfic_customizer_settings_footer_menu_label_1"], li[id*="customize-control-travelfic_customizer_settings_footer_menu_url_1"], li[id*="customize-control-travelfic_customizer_settings_footer_menu_label_2"], li[id*="customize-control-travelfic_customizer_settings_footer_menu_url_2"], li[id*="customize-control-travelfic_customizer_settings_footer_3_section_opt"], li[id*="#customize-control-travelfic_customizer_settings_footer_bg_image_toggle"], li[id*="customize-control-travelfic_customizer_settings_footer_bg_image"], li[id*= "customize-control-travelfic_customizer_settings_footer_bg_overlay_color"], li[id*="customize-control-travelfic_customizer_settings_footer_3_bg_image"], li[id*= "customize-control-travelfic_customizer_settings_footer_3_bg_overlay_color"]').show();

            $('li[id*="customize-control-travelfic_customizer_settings_footer_design_3_section_opt"], li[id*="customize-control-travelfic_customizer_settings_footer_bottom_left_bg_color"], li[id*="customize-control-travelfic_customizer_settings_footer_bottom_left_text_color"],li[id*="customize-control-travelfic_customizer_settings_footer_bottom_right_bg_color"], li[id*="customize-control-travelfic_customizer_settings_footer_bottom_right_text_color"]').hide();

          }
          else if ('design2' === value) {
            $('li[id*="customize-control-travelfic_customizer_settings_footer_menu_label_1"], li[id*="customize-control-travelfic_customizer_settings_footer_menu_url_1"], li[id*="customize-control-travelfic_customizer_settings_footer_menu_label_2"], li[id*="customize-control-travelfic_customizer_settings_footer_menu_url_2"], li[id*="customize-control-travelfic_customizer_settings_footer_design_3_section_opt"], li[id*="customize-control-travelfic_customizer_settings_footer_bottom_left_bg_color"], li[id*="customize-control-travelfic_customizer_settings_footer_bottom_left_text_color"],li[id*="customize-control-travelfic_customizer_settings_footer_bottom_right_bg_color"], li[id*="customize-control-travelfic_customizer_settings_footer_bottom_right_text_color"],li[id*="customize-control-travelfic_customizer_settings_footer_3_section_opt"], li[id*="#customize-control-travelfic_customizer_settings_footer_bg_image_toggle"], li[id*="customize-control-travelfic_customizer_settings_footer_bg_image"], li[id*= "customize-control-travelfic_customizer_settings_footer_bg_overlay_color"], li[id*="customize-control-travelfic_customizer_settings_footer_3_bg_image"], li[id*= "customize-control-travelfic_customizer_settings_footer_3_bg_overlay_color"]').hide();

          } else {
            $('li[id*="customize-control-travelfic_customizer_settings_footer_menu_label_1"], li[id*="customize-control-travelfic_customizer_settings_footer_menu_url_1"], li[id*="customize-control-travelfic_customizer_settings_footer_menu_label_2"], li[id*="customize-control-travelfic_customizer_settings_footer_menu_url_2"], li[id*="customize-control-travelfic_customizer_settings_footer_design_3_section_opt"], li[id*="customize-control-travelfic_customizer_settings_footer_bottom_left_bg_color"], li[id*="customize-control-travelfic_customizer_settings_footer_bottom_left_text_color"],li[id*="customize-control-travelfic_customizer_settings_footer_bottom_right_bg_color"], li[id*="customize-control-travelfic_customizer_settings_footer_bottom_right_text_color"],li[id*="customize-control-travelfic_customizer_settings_footer_3_section_opt"], li[id*="#customize-control-travelfic_customizer_settings_footer_bg_image_toggle"], li[id*="customize-control-travelfic_customizer_settings_footer_bg_image"], li[id*= "customize-control-travelfic_customizer_settings_footer_bg_overlay_color"], li[id*="customize-control-travelfic_customizer_settings_footer_3_bg_image"], li[id*= "customize-control-travelfic_customizer_settings_footer_3_bg_overlay_color"]').hide();
          }
        }
    
        toggleFields(value.get());
    
        value.bind(function (newVal) {
          toggleFields(newVal);
        });
      });
    }

    wp.customize('travelfic_customizer_settings_footer_tab_select', function (value) {
      function tab_toggleFields(value) {
        
        if ('design' === value) {
        
          $('li[id*="customize-control-travelfic_customizer_settings_footer_bg_color"], li[id*="customize-control-travelfic_customizer_settings_footer_text_color"]').show();
          
          $('li[id*="customize-control-travelfic_customizer_settings_footer_width"], li[id*="customize-control-travelfic_customizer_settings_footer_design_select"], li[id*="customize-control-travelfic_customizer_settings_copyright_text"], li[id*="customize-control-travelfic_customizer_settings_footer_3_section_opt"], li[id*="customize-control-travelfic_customizer_settings_footer_menu_label_1"], li[id*="customize-control-travelfic_customizer_settings_footer_menu_url_1"], li[id*="customize-control-travelfic_customizer_settings_footer_menu_label_2"], li[id*="customize-control-travelfic_customizer_settings_footer_menu_url_2"], li[id*="#customize-control-travelfic_customizer_settings_footer_bg_image_toggle"], li[id*="customize-control-travelfic_customizer_settings_footer_bg_image"], li[id*= "customize-control-travelfic_customizer_settings_footer_bg_overlay_color"], li[id*="customize-control-travelfic_customizer_settings_footer_3_bg_image"], li[id*= "customize-control-travelfic_customizer_settings_footer_3_bg_overlay_color"]').hide();

          const footerDesign = $('input[name="travelfic_customizer_settings_footer_design_select"]:checked').val();
          if ('design3' === footerDesign) {
            $('li[id*="customize-control-travelfic_customizer_settings_footer_design_3_section_opt"], li[id*="customize-control-travelfic_customizer_settings_footer_bottom_left_bg_color"], li[id*="customize-control-travelfic_customizer_settings_footer_bottom_left_text_color"],li[id*="customize-control-travelfic_customizer_settings_footer_bottom_right_bg_color"], li[id*="customize-control-travelfic_customizer_settings_footer_bottom_right_text_color"]').show();
          }
        } else {
          
          $('li[id*="customize-control-travelfic_customizer_settings_footer_width"], li[id*="customize-control-travelfic_customizer_settings_footer_design_select"], li[id*="customize-control-travelfic_customizer_settings_copyright_text"] ').show();
          $('li[id*="customize-control-travelfic_customizer_settings_footer_bg_color"], li[id*="customize-control-travelfic_customizer_settings_footer_text_color"], li[id*="customize-control-travelfic_customizer_settings_footer_design_3_section_opt"], li[id*="customize-control-travelfic_customizer_settings_footer_bottom_left_bg_color"], li[id*="customize-control-travelfic_customizer_settings_footer_bottom_left_text_color"],li[id*="customize-control-travelfic_customizer_settings_footer_bottom_right_bg_color"], li[id*="customize-control-travelfic_customizer_settings_footer_bottom_right_text_color"], li[id*="#customize-control-travelfic_customizer_settings_footer_bg_image_toggle"], li[id*="customize-control-travelfic_customizer_settings_footer_bg_image"], li[id*= "customize-control-travelfic_customizer_settings_footer_bg_overlay_color"] ').hide();
          footerDesign();
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
      var control = this, value = {};
      control.container.find('input, select').each(function () {
        var input = $(this),
        settingId = input.data('customize-setting-link'),
        inputValue = '';
        if ('SELECT' === input.prop('tagName')) {
          inputValue = input.find('option:selected').val() || '';
        } else {
          inputValue = input.val() || '';
        }
        value[settingId] = inputValue;
      });

      return value;
    }
  });

})(jQuery);
