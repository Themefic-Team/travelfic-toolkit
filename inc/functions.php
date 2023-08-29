<?php
//option function
if( ! function_exists('travelfic_get_meta') ){
    function travelfic_get_meta( $id, $key, $attr=''){
        if( !empty($attr)){
            $data = get_post_meta( $id, $key, true )[$attr];
        }else{
            $data = get_post_meta( $id, $key, true );
        }
        return $data;
    }
}

// Primary Menu Limit
function travelfic_toolkit_limit_menu_items($items, $args) {
    if ($args->theme_location == 'primary_menu') {
        $limit = 4; 
        $new_menu_items = array();
        $submenu_counts = array();

        foreach ($items as $menu_item) {
            if ($menu_item->menu_item_parent) {
                // Count submenu items
                $parent_id = $menu_item->menu_item_parent;
                if (!isset($submenu_counts[$parent_id])) {
                    $submenu_counts[$parent_id] = 0;
                }
                if ($submenu_counts[$parent_id] < $limit) {
                    $submenu_counts[$parent_id]++;
                    $new_menu_items[] = $menu_item;
                }
            } else {
                if (count($new_menu_items) < $limit) {
                    $new_menu_items[] = $menu_item;
                }
            }
        }
        return $new_menu_items;
    }
    return $items;
}
add_filter('wp_nav_menu_objects', 'travelfic_toolkit_limit_menu_items', 10, 2);