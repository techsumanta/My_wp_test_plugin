<?php

/**
 * Plugin Name: My Test Plugin
 * Plugin URI: https://wordpress.org/
 * Description: This is a Test Plugin
 * Version: 1.0.0
 * Author: Sumanta Halder
 * Author Uri: https://techsumanta.com/
 */

if(!defined('ABSPATH')) {
    header('location: /my-plugin-test/wp-admin');
    die();
}

register_activation_hook(__FILE__, 'my_plugin_activation');

function my_plugin_activation() {
    global $wpdb, $table_prefix;

    $wp_emp = $table_prefix."emp";
    
    $create_table_sql = "CREATE TABLE IF NOT EXISTS `$wp_emp` 
                        (`id` INT NOT NULL AUTO_INCREMENT , `name` VARCHAR(100) NOT NULL ,
                         `email` VARCHAR(255) NOT NULL , `status` SMALLINT(2) NOT NULL ,
                          PRIMARY KEY (`id`)) ENGINE = InnoDB";
    
    $wpdb->query($create_table_sql);

    $insert_data = array(
        'name' => 'Sumanta',
        'email' => 'abc@gmail.com',
        'status' => 1
    );

    $wpdb->insert($wp_emp, $insert_data);
}

register_deactivation_hook(__FILE__, 'my_plugin_deactivation');

function my_plugin_deactivation() {
    global $wpdb, $table_prefix;
    
    $wp_emp = $table_prefix."emp";

    $truncate_table_sql = "TRUNCATE TABLE `$wp_emp`";
    $wpdb->query($truncate_table_sql);
}

function my_custom_scripts() {
    $path_js = plugins_url('js/main.js', __FILE__);
    $path_style = plugins_url('css/style.css', __FILE__);
    $dep = array('jquery');
    $js_ver = filemtime(plugin_dir_path(__FILE__).'js/main.js');
    $style_ver = filemtime(plugin_dir_path(__FILE__).'css/style.css');

    if(is_page('home')) {
        wp_enqueue_style('my-custom-style', $path_style, '', $style_ver);
    }

    wp_enqueue_script('my-custom-js', $path_js, $dep, $js_ver, true);
    wp_add_inline_script('my-custom-js', 'var is_login = '.is_user_logged_in().';', 'before');

}

add_action('wp_enqueue_scripts', 'my_custom_scripts');
add_action('admin_enqueue_scripts', 'my_custom_scripts');

function my_shortcode($atts) {
    $atts = array_change_key_case((array) $atts, CASE_LOWER);
    
    $atts = shortcode_atts(array(
        'type' => 'img-gallery'
    ), $atts);

    include $atts['type'].'.php';
}

add_shortcode('my-shortcode', 'my_shortcode');

function my_post_info() {
    ob_start();
    $args = array(
        'post_type' => 'post',
        // 's' => 'my test post'   // 's' for searching
        'posts_per_page' => 2,
        'order' => 'desc',
        'category_name' => 'cat_plugin_test2',        
    );    

    $query = new WP_Query($args); 

    
    if($query->have_posts()) {        
    ?>
    <ul>        
        <?php
        while($query->have_posts()) {
            $query->the_post();
            echo "<li>".get_the_title()." -> ".get_the_content()."</li>";
        }
        ?>
    </ul>
    <?php
    }

    wp_reset_postdata();
    return ob_get_clean();    
}

add_shortcode('my-post-info', 'my_post_info');

function head_fun() {
    if(is_singular()) {
        global $post;
        
        $views = get_post_meta($post->ID, 'views', true);
        
        if($views == '') {
            add_post_meta($post->ID, 'views', 1);
        } else {
            $views++;
            update_post_meta($post->ID, 'views', $views);
        }

        echo get_post_meta($post->ID, 'views', true);
    }
}

add_action('wp_head', 'head_fun');

function views_count() {
    global $post;
    return "Total views count - ".get_post_meta($post->ID, 'views', true);
}
add_shortcode('views-count', 'views_count');


// Create custom post type

function events_custom_post() {
    $labels = array(
        'name' => 'Events',
        'singula_name' => 'Event'
    );
    $supports = array('title', 'editor', 'thumbnail', 'supports', 'excerpt');
    $options = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'rewrite' => array('slug' => 'events'),
        'show_in_rest' => true,
        'supports' => $supports,
        'menu_position' => 6,
        'taxonomies' => array('event_categories'),
        'publicly_queriable' => true
    );
    register_post_type('events', $options);
}

add_action('init', 'events_custom_post');

// Creaate Custom Taxonomy

function custom_event_categories() {
    $labels = array(
        'name' => 'Events Categories',
        'singular_name' => 'Event Category'
    );
    $options = array(
        'labels' => $labels,
        'hierarchical' => true,
        'rewrite' => array('slug' => 'event-category'),
        'show_in_rest' => true
    );
    register_taxonomy('event-category', array('events'), $options);
}

add_action('init', 'custom_event_categories');

// Create Custom Fields

function my_meta_fields() {
    ?>
    <label for="my-meta-field1">My Meta Field 1</label>
    <input type="text" name="my-meta-field1" id="my-meta-field1" value="<?php echo get_post_meta(get_the_id(), 'my-meta-data', true); ?>">
    <p>
        <label for="my-meta-field2">My Meta Field 2</label>
        <input type="text" name="my-meta-field2" id="my-meta-field2" value="<?php echo get_post_meta(get_the_id(), 'my-meta-data2', true); ?>">
    </p>    
    <?php
}

function add_my_meta_box() {
    add_meta_box('my-meta-box', 'My Meta Box', 'my_meta_fields', 'events');
}

add_action('add_meta_boxes', 'add_my_meta_box');

// Save Custom Field Data

function save_my_meta_data($post_id) {
    $field_data = $_POST['my-meta-field1'];
    $field_data2 = $_POST['my-meta-field2'];

    if(isset($_POST['my-meta-field1'])) {
        if(get_post_meta($post_id, 'my-meta-data', true) != "") {
            update_post_meta($post_id, 'my-meta-data', $field_data);
        } else {
            add_post_meta($post_id, 'my-meta-data', $field_data);
        }
    }

    if(isset($_POST['my-meta-field2'])) {
        if(get_post_meta($post_id, 'my-meta-data2', true) != "") {
            update_post_meta($post_id, 'my-meta-data2', $field_data2);
        } else {
            add_post_meta($post_id, 'my-meta-data2', $field_data2);
        }
    }
}

add_action('save_post', 'save_my_meta_data');

?>