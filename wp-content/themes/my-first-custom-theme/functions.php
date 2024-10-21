<?php

register_nav_menus(
    array('primary-menu' => 'Header Top Menu')
);

add_theme_support('post-thumbnails');

add_theme_support('custom-header');

register_sidebar(
    array(
        'name' => 'Sidebar Location',
        'id' => 'sidebar' // this id is calling in dynamic_sidebar('sidebar') for display user 
    )
);

add_theme_support('custom-background');

add_post_type_support('page', 'excerpt');

function ajax_contact_us() {
    $arr = array();
    wp_parse_str($_POST['contact_us'], $arr);
    global $wpdb, $table_prefix;
    $table = $table_prefix.'emp';
    $result = $wpdb->insert($table, array(
        'name' => $arr['user_name'],
        'email' => $arr['user_email'],
        'status' => 1
    ));
    
    if($result > 0) {
        wp_send_json_success("Data Inserted");
    } else {
        wp_send_json_error("Please Try Again");
    }
}

add_action('wp_ajax_contact_us', 'ajax_contact_us');

?>