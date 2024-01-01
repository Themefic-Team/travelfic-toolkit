(function ($) {
    'use strict';

    let template_type = '';
    let plugin_slugs = travelfic_toolkit_script_params.actives_plugins;
    let plugin_slug_length = plugin_slugs.length-1;
    
    // Import Template
    $(document).on('click', '.template-import-btn', function (e) {
        $("#travelfic-template-list-wrapper").slideUp();
        $("#travelfic-template-importing-wrapper").slideDown();
        $("#travelfic-template-importing-wrapper").addClass('travelfic-importing-showing');
        template_type = $(this).attr('data-template');
        $('.demo-importing-loader .loader-heading .loader-label').text(travelfic_toolkit_script_params.installing);
        if (plugin_slugs.length > 0) {
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
                        if(response.success){
                            Travelfic_Activation_Actions(slug, index);
                        }else if(response.data && response.data.errorCode !== undefined && response.data.errorCode=="folder_exists"){
                            Travelfic_Activation_Actions(slug, index);
                        }else{
                            if("contact-form-7"==slug){
                                $('.plug-cf7-btn').click();
                            }
                            if("tourfic"==slug){
                                $('.plug-tourfic-btn').click();
                            }
                            if("woocommerce"==slug){
                                $('.plug-woocommerce-btn').click();
                            }
                            if("elementor"==slug){
                                $('.plug-elementor-btn').click();
                            }
                        }
                    }
                })
            });
        }else{
            $(".settings-import-btn").click();
        }

    });
    
    // CF7 Install
    $(document).on('click', '.plug-cf7-btn', function (e) {
        var data = {
            action: "contact-form-7_ajax_install_plugin",
            _ajax_nonce: travelfic_toolkit_script_params.travelfic_toolkit_nonce,
            slug: "contact-form-7",
        };
        // Installing Function
        jQuery.post(travelfic_toolkit_script_params.ajax_url, data, function (response) {
            if(response.success){
                Travelfic_Activation_Actions("contact-form-7", 0);
            }
        })
    });

    // Tourfic Install
    $(document).on('click', '.plug-tourfic-btn', function (e) {
        var data = {
            action: "tourfic_ajax_install_plugin",
            _ajax_nonce: travelfic_toolkit_script_params.travelfic_toolkit_nonce,
            slug: "tourfic",
        };
        // Installing Function
        jQuery.post(travelfic_toolkit_script_params.ajax_url, data, function (response) {
            if(response.success){
                Travelfic_Activation_Actions("tourfic", 1);
            }
        })
    });

    // woocommerce Install
    $(document).on('click', '.plug-woocommerce-btn', function (e) {
        var data = {
            action: "woocommerce_ajax_install_plugin",
            _ajax_nonce: travelfic_toolkit_script_params.travelfic_toolkit_nonce,
            slug: "woocommerce",
        };
        // Installing Function
        jQuery.post(travelfic_toolkit_script_params.ajax_url, data, function (response) {
            if(response.success){
                Travelfic_Activation_Actions("woocommerce", 3);
            }
        })
    });

    // elementor Install
    $(document).on('click', '.plug-elementor-btn', function (e) {
        var data = {
            action: "elementor_ajax_install_plugin",
            _ajax_nonce: travelfic_toolkit_script_params.travelfic_toolkit_nonce,
            slug: "elementor",
        };
        // Installing Function
        jQuery.post(travelfic_toolkit_script_params.ajax_url, data, function (response) {
            if(response.success){
                Travelfic_Activation_Actions("elementor", 2);
            }
        })
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
                if(index==0 && active.success){
                    $('.demo-importing-loader .loader-heading .loader-precent').text('10%');
                    $('.demo-importing-loader .loader-bars .loader-precent-bar').css("width", "10%");
                }
                if(index==plugin_slug_length && active.success){
                    $('.demo-importing-loader .loader-heading .loader-precent').text('20%');
                    $('.demo-importing-loader .loader-bars .loader-precent-bar').css("width", "20%");
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
                $(".widget-import-btn").click();
            },
            error: function(error) {
                console.log(error);
            }
        });
    });
    // Widgets importer
    $(document).on('click', '.widget-import-btn', function (e) {
        $('.demo-importing-loader .loader-heading .loader-label').text("Widget importing...");
        $.ajax({
            type: 'post',
            url: travelfic_toolkit_script_params.ajax_url,
            data: {
                action: 'travelfic-demo-widget-import',
                template: template_type,
                _ajax_nonce: travelfic_toolkit_script_params.travelfic_toolkit_nonce,
            },
            success: function(response) {
                $('.demo-importing-loader .loader-heading .loader-precent').text('55%');
                $('.demo-importing-loader .loader-bars .loader-precent-bar').css("width", "55%");
                $(".menu-import-btn").click();
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

    // Menu importer
    $(document).on('click', '.menu-import-btn', function (e) {
        $('.demo-importing-loader .loader-heading .loader-label').text("Menu importing...");
        $.ajax({
            type: 'post',
            url: travelfic_toolkit_script_params.ajax_url,
            data: {
                action: 'travelfic-demo-menu-import',
                _ajax_nonce: travelfic_toolkit_script_params.travelfic_toolkit_nonce,
            },
            success: function(response) {
                $('.demo-importing-loader .loader-heading .loader-precent').text('65%');
                $('.demo-importing-loader .loader-bars .loader-precent-bar').css("width", "65%");
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
                $('.demo-importing-loader .loader-heading .loader-precent').text('85%');
                $('.demo-importing-loader .loader-bars .loader-precent-bar').css("width", "85%");
                $(".demo-hotel-import-btn").click();
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

    // Demo Hotel importer
    $(document).on('click', '.demo-hotel-import-btn', function (e) {
        if("hotel"==template_type){
            $('.demo-importing-loader .loader-heading .loader-label').text("Hotel Demo importing...");
            $.ajax({
                type: 'post',
                url: travelfic_toolkit_script_params.ajax_url,
                data: {
                    action: 'travelfic-demo-hotel-import',
                    _ajax_nonce: travelfic_toolkit_script_params.travelfic_toolkit_nonce,
                },
                success: function(response) {
                    
                        $('.demo-importing-loader .loader-heading .loader-precent').text('100%');
                        $('.demo-importing-loader .loader-bars .loader-precent-bar').css("width", "100%");
                        $('.demo-importing-loader .loader-heading .loader-label').text("Done! ready to go...");
                        $('#travelfic-template-importing-wrapper .travelfic-template-list-heading h2').text("Congratulations! your website is ready 👏");
                        $('#travelfic-template-importing-wrapper .travelfic-template-demo-importing .importing-img').hide();
                        $('#travelfic-template-importing-wrapper .travelfic-template-demo-importing .importing-success').show();
                    
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }else{
            $('.demo-importing-loader .loader-heading .loader-precent').text('85%');
            $('.demo-importing-loader .loader-bars .loader-precent-bar').css("width", "85%");
            $(".demo-tour-import-btn").click();
        }
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
                $('.demo-importing-loader .loader-heading .loader-label').text("Done! ready to go...");
                $('#travelfic-template-importing-wrapper .travelfic-template-list-heading h2').text("Congratulations! your website is ready 👏");
                $('#travelfic-template-importing-wrapper .travelfic-template-demo-importing .importing-img').hide();
                $('#travelfic-template-importing-wrapper .travelfic-template-demo-importing .importing-success').show();
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

})(jQuery);
  