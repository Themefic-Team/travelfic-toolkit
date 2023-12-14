(function ($) {
    'use strict';
    // Import Template
    $(document).on('click', '.template-import-btn', function (e) {
        $("#travelfic-template-list-wrapper").slideUp();
        $("#travelfic-template-importing-wrapper").slideDown();
        var plugin_slugs = ['woocommerce','tourfic', 'elementor'];
        $('.demo-importing-loader .loader-heading .loader-label').text(travelfic_toolkit_script_params.installing);

        $(".settings-import-btn").click();
        $(".customizer-import-btn").click();
        $(".demo-page-import-btn").click();
        plugin_slugs.forEach(function (slug) {
            let travelfic_install_action = slug+"_ajax_install_plugin"
            var data = {
                action: travelfic_install_action,
                _ajax_nonce: travelfic_toolkit_script_params.travelfic_toolkit_nonce,
                slug: slug,
            };
            // Installing Function
            jQuery.post(travelfic_toolkit_script_params.ajax_url, data, function (response) {
                if(response){
                    Travelfic_Activation_Actions(slug);
                }
            })
        });

    });
    
    // Activation Functions
    const Travelfic_Activation_Actions = (plugin_slug) => {
        $.ajax({
            type: 'post',
            url: travelfic_toolkit_script_params.ajax_url,
            data: {
                action: 'travelfic_toolkit_ajax_active_plugin',
                _ajax_nonce: travelfic_toolkit_script_params.travelfic_toolkit_nonce,
                slug: plugin_slug,
            },
            success: function(response) {
                console.log(plugin_slug);
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    // Global Settings importer
    $(document).on('click', '.settings-import-btn', function (e) {
        $.ajax({
            type: 'post',
            url: travelfic_toolkit_script_params.ajax_url,
            data: {
                action: 'travelfic-global-settings-import',
                _ajax_nonce: travelfic_toolkit_script_params.travelfic_toolkit_nonce,
            },
            success: function(response) {
                $(".demo-hotel-import-btn").click();
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

    // Customizer Settings importer
    $(document).on('click', '.customizer-import-btn', function (e) {
        $.ajax({
            type: 'post',
            url: travelfic_toolkit_script_params.ajax_url,
            data: {
                action: 'travelfic-customizer-settings-import',
                _ajax_nonce: travelfic_toolkit_script_params.travelfic_toolkit_nonce,
            },
            success: function(response) {
                $(".demo-tour-import-btn").click();
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

    // Demo Hotel importer
    $(document).on('click', '.demo-hotel-import-btn', function (e) {
        $.ajax({
            type: 'post',
            url: travelfic_toolkit_script_params.ajax_url,
            data: {
                action: 'travelfic-demo-hotel-import',
                _ajax_nonce: travelfic_toolkit_script_params.travelfic_toolkit_nonce,
            },
            success: function(response) {
                console.log(response);
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

    // Demo Tour importer
    $(document).on('click', '.demo-tour-import-btn', function (e) {
        $.ajax({
            type: 'post',
            url: travelfic_toolkit_script_params.ajax_url,
            data: {
                action: 'travelfic-demo-tour-import',
                _ajax_nonce: travelfic_toolkit_script_params.travelfic_toolkit_nonce,
            },
            success: function(response) {
                console.log(response);
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

    // Demo Pages importer
    $(document).on('click', '.demo-page-import-btn', function (e) {
        $.ajax({
            type: 'post',
            url: travelfic_toolkit_script_params.ajax_url,
            data: {
                action: 'travelfic-demo-pages-import',
                _ajax_nonce: travelfic_toolkit_script_params.travelfic_toolkit_nonce,
            },
            success: function(response) {
                console.log(response);
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

})(jQuery);
  