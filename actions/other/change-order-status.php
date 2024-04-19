<?php
if ( ! defined( 'ABSPATH' ) ) { die(); }

function dw_auto_complete_order($order_id) {
    if (!$order_id) {
        return;
    }

    $order = wc_get_order($order_id);
    if ($order) {
        $order->update_status('completed', 'Order marked as completed automatically by plugin.');
    }
}

function dw_setup_auto_complete_order_hook() {
    $change_processing_status = get_option('dw_change_processing_to_completed', 'FALSE');

    if ($change_processing_status === 'TRUE') {
        add_action('woocommerce_order_status_processing', 'dw_auto_complete_order');
    }
}

add_action('woocommerce_loaded', 'dw_setup_auto_complete_order_hook');
