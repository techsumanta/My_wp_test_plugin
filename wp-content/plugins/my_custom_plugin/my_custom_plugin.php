<?php

/**
 * Plugin Name: My Custom Plugin
 * Plugin URI: https://wordpress.org/
 * Description: This is a crud Employee management system
 * Version: 1.0.0
 * Author: Sumanta Halder
 * Author Uri: https://techsumanta.com/
 */

 if ( ! defined( 'ABSPATH' ) ) {    
    header("location:/my-plugin-test");
	die();
}

 define("EMS_PLUGIN_PATH", plugin_dir_path(__FILE__));
 

function cp_add_admin_menu() {
    
    // Main-menu
    add_menu_page("Employee Management System", "Employee System", "manage_options", "employee-system",
                    "ems_add_employee", "dashicons-menu", 67);

    // Sub-menu
    add_submenu_page("employee-system", "Add Employee", "Add Employee", "manage_options", "employee-system",
                    "ems_add_employee");
   
    add_submenu_page("employee-system", "List Employee", "List Employee", "manage_options", "list-employee",
                    "ems_list_employee");             
    
}

add_action("admin_menu", "cp_add_admin_menu");

// Main menu callback function
function ems_add_employee() {
    include_once(EMS_PLUGIN_PATH."pages/add-employee.php");
}

// Submenu callback function
function ems_list_employee() {
    include_once(EMS_PLUGIN_PATH."pages/list-employee.php");    
}

?>