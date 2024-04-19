<?php
if ( ! defined( 'ABSPATH' ) ) { die(); }

add_action('admin_menu', 'dw_add_admin_page');

function dw_add_admin_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        return;
    }

    add_menu_page(
        'Settings', // Page Title
        'DW Ecom Admin', // Menu Title
        'manage_options', // Capability
        'dw-ecom-conversions', // Menu Slug
        'dw_plugin_content', // Callback Function
        'dashicons-admin-generic', // Icon URL (use dashicons for a built-in icon)
        1 // Position
    );
}
