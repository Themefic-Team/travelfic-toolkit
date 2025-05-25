<?php
if (! defined('ABSPATH')) exit; // Exit if accessed directly 

add_action('init', 'tft_customizer_migrator');
function tft_customizer_migrator()
{

    if (get_option('tft_customizer_options_migrated')) {
        return;
    }

    // Color setting migration
    $color_fields_migrate = [
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

    foreach ($color_fields_migrate as $field) {
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


    // Typography setting migration
    $typography_fields_to_migrate = [
        'header_menu_typo' => 'menu',
        'header_submenu_typo' => 'submenu',
    ];

    foreach ($typography_fields_to_migrate as $old_key => $new_prefix) {
        $full_old_key = 'travelfic_customizer_settings_' . $old_key;
        $old_values = get_theme_mod($full_old_key);

        if (is_array($old_values)) {

            // Migrate font-size
            if (!empty($old_values['font-size'])) {
                set_theme_mod("travelfic_customizer_settings_{$new_prefix}_font_size", [
                    'desktop' => $old_values['font-size'],
                ]);
            }

            // Migrate line-height
            if (!empty($old_values['line-height'])) {
                set_theme_mod("travelfic_customizer_settings_{$new_prefix}_font_line_height", $old_values['line-height']);
            }

            // Migrate text-transform
            if (!empty($old_values['text-transform'])) {
                set_theme_mod("travelfic_customizer_settings_{$new_prefix}_font_transform", $old_values['text-transform']);
            }

            remove_theme_mod($full_old_key);
        }
    }

    // rename customizer keys
    $tft_customizer_key_renames = [
        'travelfic_customizer_settings_design_3_top_header_bg' => 'travelfic_customizer_settings_header_topbar_background',
        'travelfic_customizer_settings_design_3_top_header_text_color' => 'travelfic_customizer_settings_header_topbar_color',
    ];

    foreach ($tft_customizer_key_renames as $old_key => $new_key) {
        $value = get_theme_mod($old_key);
        if (!empty($value) && get_theme_mod($new_key) === false) {
            set_theme_mod($new_key, $value);
        }
    }

    update_option('tft_customizer_options_migrated', true);
}
