<?php

if(!defined('WP_UNINSTALL_PLUGIN')) {
    header('location: /my-plugin-test/wp-admin');
    die();
}

global $wpdb, $table_prefix;
    
    $wp_emp = $table_prefix."emp";

    $drop_table_sql = "DROP TABLE `$wp_emp`";
    $wpdb->query($drop_table_sql);

?>