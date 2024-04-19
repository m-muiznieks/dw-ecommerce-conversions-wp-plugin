<?php
if ( ! defined( 'ABSPATH' ) ) { die(); };

include_once(plugin_dir_path(__FILE__) . 'functions/get-order-details.php');
include_once(plugin_dir_path(__FILE__) . 'functions/send-ecommerce-data.php');
include_once(plugin_dir_path(__FILE__) . 'functions/add-order-notes.php');

add_action('woocommerce_order_status_completed', 'dw_verify_settings_and_send_purchase_data');
add_action('woocommerce_order_status_processing', 'dw_verify_settings_and_send_purchase_data');
add_action('woocommerce_thankyou', 'dw_verify_settings_and_send_purchase_data');


/**
 * Handles sending purchase data to a webhook based on the plugin settings when an order status changes.
 * 
 * @param int $order_id The ID of the order.
 */
function dw_verify_settings_and_send_purchase_data($order_id) {
    // Retrieve the current plugin setting
    $when_to_send_purchase_data = get_option('dw_when_to_send_purchase_data', 'do_not_send_purchase_data');

    // Retrieve the current action hook to match against the setting
    $current_action = current_action();

    // Check if the order has already been marked as synced and should not be sent again
    $order = wc_get_order($order_id);
    if (!$order) {
        dw_ecom_log_error('Order not found or invalid Order ID: ' . $order_id);
        return; // Exit if the order object is not found
    }

    $already_synced = $order->get_meta('_already_synced_wh', true);
    
    if ($already_synced === 'TRUE') {
        return; 
    }

    // Check if the action matches the setting and if purchase data should be sent
    if ($when_to_send_purchase_data === $current_action) {
        dw_send_detailed_purchase_data_to_webhook($order_id);
        
    } else {
        dw_ecom_log_error('Not sending purchase data to webhook, because ' . $current_action . ' is not equal to ' . $when_to_send_purchase_data);
    }
}


/**
 * Sends detailed purchase data to a webhook.
 * 
 * @param int $order_id The ID of the order.
 */
function dw_send_detailed_purchase_data_to_webhook($order_id) {
    $order = dw_order_details($order_id);
    if (!$order) {
        return;
    }

    dw_send_ecommerce_data($order);
}


