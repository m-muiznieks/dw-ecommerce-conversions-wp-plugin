<?php
if ( ! defined( 'ABSPATH' ) ) { die(); }

require_once(plugin_dir_path(__FILE__) . 'order-parts/get-items.php');
require_once(plugin_dir_path(__FILE__) . 'order-parts/get-coupons.php');
require_once(plugin_dir_path(__FILE__) . 'order-parts/get-order-notes.php');
require_once(plugin_dir_path(__FILE__) . 'order-parts/get-billing-details.php');
require_once(plugin_dir_path(__FILE__) . 'order-parts/get-shipping-details.php');
require_once(plugin_dir_path(__FILE__) . 'order-parts/get-customer-environment.php');
require_once(plugin_dir_path(__FILE__) . 'order-parts/get-payment-details.php');

/**
 * Gets order details from a given order ID.
 * The function returns an array with the order details so you can pass it to the desired functions.
 *
 * @param [type] $order_id
 * @return void
 */
function dw_order_details($order_id) {
    $order = wc_get_order($order_id);
    if (!$order) {
        return null;
    }

    // Preparing order data
    $order_data = array(
        'order_id'                  => $order->get_id(),
        'order_total'               => $order->get_total(),
        'order_subtotal'            => $order->get_subtotal(),
        'order_tax'                 => $order->get_total_tax(),
        'order_discount'            => $order->get_total_discount(),
        'order_shipping'            => $order->get_shipping_total(),
        'order_currency'            => $order->get_currency(),
        'order_status'              => $order->get_status(),
        'date_created'              => $order->get_date_created(),
        'date_modified'             => $order->get_date_modified(),
        'payment_details'           => dw_get_payment_details_from_order($order),
        'order_url'                 => $order->get_checkout_order_received_url(),
        'billing'                   => dw_get_billing_details_from_order($order),
        'shipping'                  => dw_get_shipping_details_from_order($order),
        'items'                     => dw_order_get_items($order),
        'coupons_details'           => dw_get_coupon_details_from_order($order),
        'order_notes'               => dw_get_order_notes_details_from_order($order),
        'customer_note'             => $order->get_customer_note(),
        'environment'               => dw_get_customer_environment_details_from_order($order),
    );
    
    return $order_data;
};