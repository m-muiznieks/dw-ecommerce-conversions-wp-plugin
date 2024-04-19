<?php
/*
Plugin Name: DW Ecommerce Conversions
Description: This plugin is used for ecommerce event creation, tracking ecommerce activities, and managing data layers for marketing analytics.
Version: 0.02 | UNSTABLE
Author: Martins Muiznieks | DIGIWORKS.DEV
*/

if ( ! defined( 'ABSPATH' ) ) { die(); }
register_activation_hook(__FILE__, 'dw_plugin_activate');
register_deactivation_hook(__FILE__, 'dw_plugin_deactivate');

require_once( ABSPATH . 'wp-admin/includes/admin.php' );
define('DW_BASE_DIR', plugin_dir_path(__FILE__)); // Base directory


// IMPORTANT ACTIONS AND FUNCTIONS HERE
require_once(DW_BASE_DIR . 'settings/check-dependencies.php');
require_once(DW_BASE_DIR . 'settings/register-settings.php'); // <<== REGISTER OPTION SETTINGS HERE
require_once(DW_BASE_DIR . 'actions/woocommerce/send-purchase-data.php');
require_once(DW_BASE_DIR . 'actions/other/change-order-status.php');
require_once(DW_BASE_DIR . 'settings/write-error.php');
require_once(DW_BASE_DIR . 'settings/register-meta.php'); // <<== REGISTER META BOXES AND FIELDS HERE

//OTHER ACTIONS AND FUNCTIONS HERE
require_once(DW_BASE_DIR . 'tracking/setting-scripts.php');


//CONTENT PAINTING RELATED
require_once(DW_BASE_DIR . 'components/plugin-main-page/admin-page-content.php');
require_once(DW_BASE_DIR . 'content/admin-menu-settings.php');


function dw_plugin_activate() {
    dw_check_dependencies();	
    // Code to run when your plugin is activated
}
 
function dw_plugin_deactivate() {
    // Code to run when your plugin is deactivated
}
