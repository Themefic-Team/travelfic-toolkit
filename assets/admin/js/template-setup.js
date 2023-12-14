(function ($) {
    'use strict';
    // Import Template
    $(document).on('click', '.template-import-btn', function (e) {
        $("#travelfic-template-list-wrapper").slideUp();
        $("#travelfic-template-importing-wrapper").slideDown();
        var plugin_slugs = ['woocommerce', 'tourfic', 'elementor'];
        $('.demo-importing-loader .loader-heading .loader-label').text(travelfic_toolkit_script_params.installing);

        plugin_slugs.forEach(function (slug, index) {
            let travelfic_install_action = slug+"_ajax_install_plugin"
            var data = {
                action: travelfic_install_action,
                _ajax_nonce: travelfic_toolkit_script_params.travelfic_toolkit_nonce,
                slug: slug,
            };
            // Installing Function
            jQuery.post(travelfic_toolkit_script_params.ajax_url, data, function (response) {
                if(response){
                    Travelfic_Activation_Actions(slug, index);
                }
            })
        });

    });
    
    // Activation Functions
    const Travelfic_Activation_Actions = (plugin_slug, index) => {
        $.ajax({
            type: 'post',
            url: travelfic_toolkit_script_params.ajax_url,
            data: {
                action: 'travelfic_toolkit_ajax_active_plugin',
                _ajax_nonce: travelfic_toolkit_script_params.travelfic_toolkit_nonce,
                slug: plugin_slug,
            },
            success: function(active) {
                if(index==1 && active.success){
                    $('.demo-importing-loader .loader-heading .loader-precent').text('5%');
                    $('.demo-importing-loader .loader-bars .loader-precent-bar').css("width", "5%");
                }
                if(index==0 && active.success){
                    $('.demo-importing-loader .loader-heading .loader-precent').text('10%');
                    $('.demo-importing-loader .loader-bars .loader-precent-bar').css("width", "10%");
                }
                if(index==2 && active.success){
                    $('.demo-importing-loader .loader-heading .loader-precent').text('15%');
                    $('.demo-importing-loader .loader-bars .loader-precent-bar').css("width", "15%");

                    $(".settings-import-btn").click();
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    // Global Settings importer
    $(document).on('click', '.settings-import-btn', function (e) {
        $('.demo-importing-loader .loader-heading .loader-label').text("Global Settings importing...");
        $.ajax({
            type: 'post',
            url: travelfic_toolkit_script_params.ajax_url,
            data: {
                action: 'travelfic-global-settings-import',
                _ajax_nonce: travelfic_toolkit_script_params.travelfic_toolkit_nonce,
            },
            success: function(response) {
                $('.demo-importing-loader .loader-heading .loader-precent').text('35%');
                $('.demo-importing-loader .loader-bars .loader-precent-bar').css("width", "35%");
                $(".customizer-import-btn").click();
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

    // Customizer Settings importer
    $(document).on('click', '.customizer-import-btn', function (e) {
        $('.demo-importing-loader .loader-heading .loader-label').text("Customizer Settings importing...");
        $.ajax({
            type: 'post',
            url: travelfic_toolkit_script_params.ajax_url,
            data: {
                action: 'travelfic-customizer-settings-import',
                _ajax_nonce: travelfic_toolkit_script_params.travelfic_toolkit_nonce,
            },
            success: function(response) {
                $('.demo-importing-loader .loader-heading .loader-precent').text('45%');
                $('.demo-importing-loader .loader-bars .loader-precent-bar').css("width", "45%");
                $(".demo-page-import-btn").click();
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

    // Demo Pages importer
    $(document).on('click', '.demo-page-import-btn', function (e) {
        $('.demo-importing-loader .loader-heading .loader-label').text("Demo Pages importing...");
        $.ajax({
            type: 'post',
            url: travelfic_toolkit_script_params.ajax_url,
            data: {
                action: 'travelfic-demo-pages-import',
                _ajax_nonce: travelfic_toolkit_script_params.travelfic_toolkit_nonce,
            },
            success: function(response) {
                $('.demo-importing-loader .loader-heading .loader-precent').text('65%');
                $('.demo-importing-loader .loader-bars .loader-precent-bar').css("width", "65%");
                $(".demo-hotel-import-btn").click();
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

    // Demo Hotel importer
    $(document).on('click', '.demo-hotel-import-btn', function (e) {
        $('.demo-importing-loader .loader-heading .loader-label').text("Hotel Demo importing...");
        $.ajax({
            type: 'post',
            url: travelfic_toolkit_script_params.ajax_url,
            data: {
                action: 'travelfic-demo-hotel-import',
                _ajax_nonce: travelfic_toolkit_script_params.travelfic_toolkit_nonce,
            },
            success: function(response) {
                $('.demo-importing-loader .loader-heading .loader-precent').text('85%');
                $('.demo-importing-loader .loader-bars .loader-precent-bar').css("width", "85%");
                $(".demo-tour-import-btn").click();
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

    // Demo Tour importer
    $(document).on('click', '.demo-tour-import-btn', function (e) {
        $('.demo-importing-loader .loader-heading .loader-label').text("Tour Demo importing...");
        $.ajax({
            type: 'post',
            url: travelfic_toolkit_script_params.ajax_url,
            data: {
                action: 'travelfic-demo-tour-import',
                _ajax_nonce: travelfic_toolkit_script_params.travelfic_toolkit_nonce,
            },
            success: function(response) {
                $('.demo-importing-loader .loader-heading .loader-precent').text('100%');
                $('.demo-importing-loader .loader-bars .loader-precent-bar').css("width", "100%");
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

})(jQuery);
  