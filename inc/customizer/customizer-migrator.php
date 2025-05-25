<?php
if (! defined('ABSPATH')) exit; // Exit if accessed directly 

add_action('init', 'tft_customizer_migrator');
function tft_customizer_migrator()
{

    if (get_option('tft_customizer_options_migrated')) {
        return;
    }

    $fields_to_migrate = [
        'header_menu_color' => [
            'new_key' => 'travelfic_customizer_settings_header_menu_color',
            'normal_key' => 'travelfic_customizer_settings_menu_color',
            'hover_key' => 'travelfic_customizer_settings_menu_hover_color',
        ],
        'header_submenu_color' => [
            'new_key' => 'travelfic_customizer_settings_header_submenu_color',
            'normal_key' => 'travelfic_customizer_settings_submenu_text_color',
            'hover_key' => 'travelfic_customizer_settings_submenu_text_hover_color',
        ],
        'header_button_background_color' => [
            'new_key' => 'travelfic_customizer_settings_header_button_background_color',
            'normal_key' => 'travelfic_customizer_settings_design_3_header_btn_bg_color',
            'hover_key' => 'travelfic_customizer_settings_design_3_header_btn_hover_bg_color',
        ],
        'transparent_header_menu_color' => [
            'new_key' => 'travelfic_customizer_settings_transparent_header_menu_color',
            'normal_key' => 'travelfic_customizer_settings_transparent_menu_color',
            'hover_key' => 'travelfic_customizer_settings_transparent_menu_hover_color',
        ],
        'transparent_header_submenu_color' => [
            'new_key' => 'travelfic_customizer_settings_transparent_submenu_color',
            'normal_key' => 'travelfic_customizer_settings_transparent_submenu_text_color',
            'hover_key' => 'travelfic_customizer_settings_transparent_submenu_text_hover_color',
        ],
    ];

    foreach ($fields_to_migrate as $field) {
        $normal = get_theme_mod($field['normal_key']);
        $hover  = get_theme_mod($field['hover_key']);

        // Skip if already in array format
        if (is_array($normal)) {
            continue;
        }

        // If either value exists, convert to array
        if (!empty($normal) || !empty($hover)) {
            set_theme_mod($field['new_key'], [
                'normal' => $normal ?: '',
                'hover'  => $hover  ?: '',
            ]);

            // Optionally remove the legacy hover key
            remove_theme_mod($field['hover_key']);
        }
    }
    update_option('tft_customizer_options_migrated', true);
}
