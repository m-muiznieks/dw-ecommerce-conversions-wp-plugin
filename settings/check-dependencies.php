<?php
if ( ! defined( 'ABSPATH' ) ) { die(); }

/**
 * Add plugin data to the plugin list. 
 * These functions are called when the plugin is activated or deactivated.
 */
function dw_check_plugin_deactivation($plugin, $network_deactivating) {
    if (strpos($plugin, 'woocommerce/woocommerce.php') !== false) {
        update_option('dw_woocommerce_active', 'no');
    }
}

function dw_check_plugin_activation($plugin, $network_deactivating) {
    if (strpos($plugin, 'woocommerce/woocommerce.php') !== false) {
        update_option('dw_woocommerce_active', 'yes');
    }
}

add_action('deactivated_plugin', 'dw_check_plugin_deactivation', 10, 2);
add_action('activated_plugin', 'dw_check_plugin_activation', 10, 2);

// Check if WooCommerce is active
function dw_is_woocommerce_active() {
    return get_option('dw_woocommerce_active', 'no') === 'yes';
}

function dw_check_dependencies() {
    // Check if WooCommerce is active
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
    if (is_plugin_active('woocommerce/woocommerce.php')) {
        update_option('dw_woocommerce_active', 'yes');
    } else {
        update_option('dw_woocommerce_active', 'no');
    }
}
