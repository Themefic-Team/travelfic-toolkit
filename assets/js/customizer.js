(function ($) {
    wp.customize('travelfic_customizer_settings_stiky_header', function (value) {
      // Function to toggle the visibility of the fields
      function toggleFields(value) {
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
})(jQuery);
  