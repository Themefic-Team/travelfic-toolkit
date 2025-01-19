(function ($) {
    'use strict';

    let template_type = '';
    let template_all_types = '';
    let template_design = '';
    let plugin_slugs = travelfic_toolkit_script_params.actives_plugins;
    let plugin_facts = travelfic_toolkit_script_params.facts;
    let travelfic_imports_data = '';

    let plugin_slug_length = plugin_slugs.length-1;

    // Import Template
    $(document).on('click', '.template-import-btn', function (e) {

        $('.travelfic-import-confirmaiton-msg').addClass('show');
        template_type = $(this).attr('data-template');
        template_all_types = $(this).attr('data-template').split(',');
        template_design = $(this).attr('data-design');
        
    });

    // Confirmation Popup
    $("#submit_confirm").on("click", function() {
        let imports_data = $("input[name='imports[]']:checked").map(function() {
            return $(this).val();
        }).get();
        travelfic_imports_data = imports_data;

        // hide sync btn
        $('.travelfic-templte-sync-btn').hide();
        // hide exit btn
        $('.header-exit-btn').hide();
        $('.travelfic-import-confirmaiton-msg').removeClass('show');
        $("#travelfic-template-list-wrapper").slideUp();
        $("#travelfic-template-importing-wrapper").slideDown();
        $("#travelfic-template-importing-wrapper").addClass('travelfic-importing-showing');

        $('.demo-importing-loader .loader-heading .loader-label').text(travelfic_toolkit_script_params.installing);

        setTimeout(function() {
            if (plugin_facts.length > 0) {
                plugin_facts.forEach(function (fact, index) {
                    setTimeout(function () {
                        $('#travelfic-template-importing-wrapper .travelfic-template-list-heading .travelfic-installing-highlights-content').hide().html("<p><span class='icon'>💡</span>" + fact + "</p>").fadeIn(1000);
                    }, index * 10000);
                });
            }
            if (travelfic_imports_data.length > 0) {
                $('#travelfic-template-importing-wrapper .travelfic-template-list-heading h2').text("Do you know?");
            }
        }, 3000);

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
        let travelfic_active_action = plugin_slug+"_ajax_active_plugin"
        $.ajax({
            type: 'post',
            url: travelfic_toolkit_script_params.ajax_url,
            data: {
                action: travelfic_active_action,
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
                if(!active.success){
                    if(plugin_slug=="contact-form-7"){
                        $(".plug-active-cf7-btn").click();
                    }
                    if(plugin_slug=="tourfic"){
                        $(".plug-active-tourfic-btn").click();
                    }
                    if(plugin_slug=="woocommerce"){
                        $(".plug-active-woocommerce-btn").click();
                    }
                    if(plugin_slug=="elementor"){
                        $(".plug-active-elementor-btn").click();
                    }
                }
            },
            error: function(error) {
                console.log(error);
            }
        });
    }

    // CF7 Active If Failed
    $(document).on('click', '.plug-active-cf7-btn', function (e) {
        $.ajax({
            type: 'post',
            url: travelfic_toolkit_script_params.ajax_url,
            data: {
                action: 'contact-form-7_ajax_active_plugin',
                _ajax_nonce: travelfic_toolkit_script_params.travelfic_toolkit_nonce,
                slug: "contact-form-7",
            },
            success: function(active) {
                
            },
            error: function(error) {
                
            }
        });
    });

    // tourfic Active If Failed
    $(document).on('click', '.plug-active-tourfic-btn', function (e) {
        $.ajax({
            type: 'post',
            url: travelfic_toolkit_script_params.ajax_url,
            data: {
                action: 'tourfic_ajax_active_plugin',
                _ajax_nonce: travelfic_toolkit_script_params.travelfic_toolkit_nonce,
                slug: "tourfic",
            },
            success: function(active) {
                
            },
            error: function(error) {
                
            }
        });
    });

    // woocommerce Active If Failed
    $(document).on('click', '.plug-active-woocommerce-btn', function (e) {
        $.ajax({
            type: 'post',
            url: travelfic_toolkit_script_params.ajax_url,
            data: {
                action: 'woocommerce_ajax_active_plugin',
                _ajax_nonce: travelfic_toolkit_script_params.travelfic_toolkit_nonce,
                slug: "woocommerce",
            },
            success: function(active) {
                
            },
            error: function(error) {
                
            }
        });
    });

    // elementor Active If Failed
    $(document).on('click', '.plug-active-elementor-btn', function (e) {
        $.ajax({
            type: 'post',
            url: travelfic_toolkit_script_params.ajax_url,
            data: {
                action: 'elementor_ajax_active_plugin',
                _ajax_nonce: travelfic_toolkit_script_params.travelfic_toolkit_nonce,
                slug: "elementor",
            },
            success: function(active) {
                
            },
            error: function(error) {
                
            }
        });
    });

    // Global Settings importer
    $(document).on('click', '.settings-import-btn', function (e) {
        if ($.inArray("tourfic", travelfic_imports_data) !== -1) {
            $('.demo-importing-loader .loader-heading .loader-label').text("Global Settings importing...");
            $.ajax({
                type: 'post',
                url: travelfic_toolkit_script_params.ajax_url,
                data: {
                    action: 'travelfic-global-settings-import',
                    template_version: template_design,
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
        } else {
            $('.demo-importing-loader .loader-heading .loader-precent').text('35%');
            $('.demo-importing-loader .loader-bars .loader-precent-bar').css("width", "35%");
            $(".customizer-import-btn").click();
        }
    });

    // Customizer Settings importer
    $(document).on('click', '.customizer-import-btn', function (e) {
        if ($.inArray("customizer", travelfic_imports_data) !== -1) {
            $('.demo-importing-loader .loader-heading .loader-label').text("Customizer Settings importing...");
            $.ajax({
                type: 'post',
                url: travelfic_toolkit_script_params.ajax_url,
                data: {
                    action: 'travelfic-customizer-settings-import',
                    template_version: template_design,
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
        }else{
            $('.demo-importing-loader .loader-heading .loader-precent').text('45%');
            $('.demo-importing-loader .loader-bars .loader-precent-bar').css("width", "45%");
            $(".widget-import-btn").click();
        }
    });
    
    // Widgets importer
    $(document).on('click', '.widget-import-btn', function (e) {
        if ($.inArray("widgets", travelfic_imports_data) !== -1) {
            $('.demo-importing-loader .loader-heading .loader-label').text("Widget importing...");
            $.ajax({
                type: 'post',
                url: travelfic_toolkit_script_params.ajax_url,
                data: {
                    action: 'travelfic-demo-widget-import',
                    template: template_type,
                    template_version: template_design,
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
        }else{
            $('.demo-importing-loader .loader-heading .loader-precent').text('55%');
            $('.demo-importing-loader .loader-bars .loader-precent-bar').css("width", "55%");
            $(".menu-import-btn").click();
        }
    });

    // Menu importer
    $(document).on('click', '.menu-import-btn', function (e) {
        if ($.inArray("menu", travelfic_imports_data) !== -1) {
            $('.demo-importing-loader .loader-heading .loader-label').text("Menu importing...");
            $.ajax({
                type: 'post',
                url: travelfic_toolkit_script_params.ajax_url,
                data: {
                    action: 'travelfic-demo-menu-import',
                    template_version: template_design,
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
        }else{
            $('.demo-importing-loader .loader-heading .loader-precent').text('65%');
            $('.demo-importing-loader .loader-bars .loader-precent-bar').css("width", "65%");
            $(".demo-page-import-btn").click();
        }
    });

    // Demo Pages importer
    $(document).on('click', '.demo-page-import-btn', function (e) {
        
        if ($.inArray("demo", travelfic_imports_data) !== -1) {
            $('.demo-importing-loader .loader-heading .loader-label').text("Demo Pages importing...");
            $.ajax({
                type: 'post',
                url: travelfic_toolkit_script_params.ajax_url,
                data: {
                    action: 'travelfic-demo-pages-import',
                    template_version: template_design,
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
        }else{
            $('.demo-importing-loader .loader-heading .loader-precent').text('85%');
            $('.demo-importing-loader .loader-bars .loader-precent-bar').css("width", "85%");
            $(".demo-hotel-import-btn").click();
        }
    });

    // Demo Hotel importer
    $(document).on('click', '.demo-hotel-import-btn', function (e) {
        if("hotel"==template_type){
            if ($.inArray("demo", travelfic_imports_data) !== -1) {
                $('.demo-importing-loader .loader-heading .loader-label').text("Hotel Demo importing...");
                $('#travelfic-template-importing-wrapper .travelfic-template-list-heading h2').text("We are almost done...");
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
                        $('.demo-importing-loader .loader-heading .loader-label').text("Hurray! ready to go...");
                        $('#travelfic-template-importing-wrapper .travelfic-template-list-heading h2').text("Congratulations! your website is ready 👏");
                        $('#travelfic-template-importing-wrapper .travelfic-template-demo-importing .importing-img').hide();
                        $('#travelfic-template-importing-wrapper .travelfic-template-list-heading .travelfic-exits-highlights-finished').empty();
                        $('#travelfic-template-importing-wrapper .travelfic-template-demo-importing .importing-success').show();
                        
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }else{
                $('.demo-importing-loader .loader-heading .loader-precent').text('100%');
                $('.demo-importing-loader .loader-bars .loader-precent-bar').css("width", "100%");
                $('.demo-importing-loader .loader-heading .loader-label').text("Hurray! ready to go...");
                $('#travelfic-template-importing-wrapper .travelfic-template-list-heading h2').text("Congratulations! your website is ready 👏");
                $('#travelfic-template-importing-wrapper .travelfic-template-demo-importing .importing-img').hide();
                $('#travelfic-template-importing-wrapper .travelfic-template-list-heading .travelfic-exits-highlights-finished').empty();
                $('#travelfic-template-importing-wrapper .travelfic-template-demo-importing .importing-success').show();
            }
        }else if("car"==template_type){
            $('.demo-importing-loader .loader-heading .loader-precent').text('85%');
            $('.demo-importing-loader .loader-bars .loader-precent-bar').css("width", "85%");
            $(".demo-car-import-btn").click();
        }else if('tour'==template_type){
            $('.demo-importing-loader .loader-heading .loader-precent').text('85%');
            $('.demo-importing-loader .loader-bars .loader-precent-bar').css("width", "85%");
            $(".demo-tour-import-btn").click();
        }else{
            $('.demo-importing-loader .loader-heading .loader-precent').text('85%');
            $('.demo-importing-loader .loader-bars .loader-precent-bar').css("width", "85%");
            $(".demo-tragaway-import-btn").click();
        }
    });

    // Demo Car importer
    $(document).on('click', '.demo-car-import-btn', function (e) {
        if ($.inArray("demo", travelfic_imports_data) !== -1) {
            $('.demo-importing-loader .loader-heading .loader-label').text("Car Demo importing...");
            $('#travelfic-template-importing-wrapper .travelfic-template-list-heading h2').text("We are almost done...");
            $.ajax({
                type: 'post',
                url: travelfic_toolkit_script_params.ajax_url,
                data: {
                    action: 'travelfic-demo-car-import',
                    _ajax_nonce: travelfic_toolkit_script_params.travelfic_toolkit_nonce,
                },
                success: function(response) {
                    $('.demo-importing-loader .loader-heading .loader-precent').text('100%');
                    $('.demo-importing-loader .loader-bars .loader-precent-bar').css("width", "100%");
                    $('.demo-importing-loader .loader-heading .loader-label').text("Hurray! ready to go...");
                    $('#travelfic-template-importing-wrapper .travelfic-template-list-heading h2').text("Congratulations! your website is ready 👏");
                    $('#travelfic-template-importing-wrapper .travelfic-template-demo-importing .importing-img').hide();
                    $('#travelfic-template-importing-wrapper .travelfic-template-list-heading .travelfic-exits-highlights-finished').empty();
                    $('#travelfic-template-importing-wrapper .travelfic-template-demo-importing .importing-success').show();
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }else{
            $('.demo-importing-loader .loader-heading .loader-precent').text('100%');
            $('.demo-importing-loader .loader-bars .loader-precent-bar').css("width", "100%");
            $('.demo-importing-loader .loader-heading .loader-label').text("Hurray! ready to go...");
            $('#travelfic-template-importing-wrapper .travelfic-template-list-heading h2').text("Congratulations! your website is ready 👏");
            $('#travelfic-template-importing-wrapper .travelfic-template-demo-importing .importing-img').hide();
            $('#travelfic-template-importing-wrapper .travelfic-template-list-heading .travelfic-exits-highlights-finished').empty();
            $('#travelfic-template-importing-wrapper .travelfic-template-demo-importing .importing-success').show();
        }
    });

    // Demo Tour importer
    $(document).on('click', '.demo-tour-import-btn', function (e) {
        if ($.inArray("demo", travelfic_imports_data) !== -1) {
            $('.demo-importing-loader .loader-heading .loader-label').text("Tour Demo importing...");
            $('#travelfic-template-importing-wrapper .travelfic-template-list-heading h2').text("We are almost done...");
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
                    $('.demo-importing-loader .loader-heading .loader-label').text("Hurray! ready to go...");
                    $('#travelfic-template-importing-wrapper .travelfic-template-list-heading h2').text("Congratulations! your website is ready 👏");
                    $('#travelfic-template-importing-wrapper .travelfic-template-demo-importing .importing-img').hide();
                    $('#travelfic-template-importing-wrapper .travelfic-template-list-heading .travelfic-exits-highlights-finished').empty();
                    $('#travelfic-template-importing-wrapper .travelfic-template-demo-importing .importing-success').show();
                },
                error: function(error) {
                    console.log(error);
                }
            });
        }else{
            $('.demo-importing-loader .loader-heading .loader-precent').text('100%');
            $('.demo-importing-loader .loader-bars .loader-precent-bar').css("width", "100%");
            $('.demo-importing-loader .loader-heading .loader-label').text("Hurray! ready to go...");
            $('#travelfic-template-importing-wrapper .travelfic-template-list-heading h2').text("Congratulations! your website is ready 👏");
            $('#travelfic-template-importing-wrapper .travelfic-template-demo-importing .importing-img').hide();
            $('#travelfic-template-importing-wrapper .travelfic-template-list-heading .travelfic-exits-highlights-finished').empty();
            $('#travelfic-template-importing-wrapper .travelfic-template-demo-importing .importing-success').show();
        }
    });

    // Demo Tragaway importer
    $(document).on('click', '.demo-tragaway-import-btn', function (e) {
    
        $('.demo-importing-loader .loader-heading .loader-label').text("Tour, Hotel, Car Demo importing...");
        $('#travelfic-template-importing-wrapper .travelfic-template-list-heading h2').text("We are almost done...");

        console.log(template_all_types);

        template_all_types.forEach (function(type, index) {
            $.ajax({
                type: 'post',
                url: travelfic_toolkit_script_params.ajax_url,
                data: {
                    action: `travelfic-demo-${type}-import`,
                    _ajax_nonce: travelfic_toolkit_script_params.travelfic_toolkit_nonce,
                },
                success: function(response) {
                    $('.demo-importing-loader .loader-heading .loader-precent').text('100%');
                    $('.demo-importing-loader .loader-bars .loader-precent-bar').css("width", "100%");
                    $('.demo-importing-loader .loader-heading .loader-label').text("Hurray! ready to go...");
                    $('#travelfic-template-importing-wrapper .travelfic-template-list-heading h2').text("Congratulations! your website is ready 👏");
                    $('#travelfic-template-importing-wrapper .travelfic-template-demo-importing .importing-img').hide();
                    $('#travelfic-template-importing-wrapper .travelfic-template-list-heading .travelfic-exits-highlights-finished').empty();
                    $('#travelfic-template-importing-wrapper .travelfic-template-demo-importing .importing-success').show();
                },
                error: function(error) {
                    console.log(error);
                },
                complete: function() {
                    if(index==template_type.length-1){
                        $('.demo-importing-loader .loader-heading .loader-precent').text('100%');
                        $('.demo-importing-loader .loader-bars .loader-precent-bar').css("width", "100%");
                        $('.demo-importing-loader .loader-heading .loader-label').text("Hurray! ready to go...");
                        $('#travelfic-template-importing-wrapper .travelfic-template-list-heading h2').text("Congratulations! your website is ready 👏");
                        $('#travelfic-template-importing-wrapper .travelfic-template-demo-importing .importing-img').hide();
                        $('#travelfic-template-importing-wrapper .travelfic-template-list-heading .travelfic-exits-highlights-finished').empty();
                        $('#travelfic-template-importing-wrapper .travelfic-template-demo-importing .importing-success').show();
                    }
                }
            });
        });
    });

    // Template List Sync
    $(document).on('click', '.travelfic-templte-sync-btn', function (e) {
        let current = $(this);
        current.addClass('travelfic-templte-sync-loading');

        $.ajax({
            type: 'post',
            url: travelfic_toolkit_script_params.ajax_url,
            data: {
                action: 'travelfic-template-list-sync',
                _ajax_nonce: travelfic_toolkit_script_params.travelfic_toolkit_nonce,
            },
            success: function(response) {
                location.reload();
            },
            error: function(error) {
                
            }
        });
    });

    // Confirmation Msg Close
    $(document).on('click', '.import-confirmation-close', function (e) {
        $('.travelfic-import-confirmaiton-msg').removeClass('show');
    });

    // Search Bar Focus
    $(document).on('click', '#travelfic_template_search', function (e) {
        var $this = $(this);
        $this.parent().addClass('focused');
    });

    $(document).on('click', function (event) {
        if (!$(event.target).closest(".travelfic-search-form").length) {
            $(".travelfic-search-form").removeClass('focused');
        }
    });

    // Template Filter by Search Box
    $(document).on('click', '.travelfic-filter-selection ul li', function (e) {
        let Current = $(this);
        let Select_value = Current.attr('data-value');
        $('.travelfic-filter-selection ul li').removeClass('active');
        Current.addClass('active');
        $("#travelfic_filter_value").val(Select_value);
        Travelfic_Template_Filter();
    });
    $('#travelfic_template_search').on('input', function () {
        Travelfic_Template_Filter();
    });
    const Travelfic_Template_Filter = () =>{
        var searchTerm = $('#travelfic_template_search').val().toLowerCase();
        var filterValue = $('#travelfic_filter_value').val().toLowerCase();

        $('.travelfic-single-template').hide().filter(function () {
            var templateName = $(this).data('template_name').toLowerCase();
            var templateType = $(this).data('template_type').toLowerCase();
            
            if (filterValue === 'all') {
                return templateName.includes(searchTerm);
            } else {
                return templateName.includes(searchTerm) && templateType === filterValue;
            }
        }).fadeIn();
    }

})(jQuery);
  