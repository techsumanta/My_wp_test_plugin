<?php
function my_child_theme() {
    wp_enqueue_script('my-child-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'my_child_theme', PHP_INT_MAX);
?>