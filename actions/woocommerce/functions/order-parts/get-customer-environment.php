<?php
if ( ! defined( 'ABSPATH' ) ) { die(); }

function dw_get_customer_environment_details_from_order($order) {
    if (!$order) {
        return null;
    }

    // Basic customer details from the order
    $customer_details = array(
        'ip_address'    => $order->get_customer_ip_address(), // Get the IP address of the customer
        'user_agent'    => $order->get_customer_user_agent(), // Get the browser user agent of the customer
        'created_via'   => $order->get_created_via(),         // Describes how the order was created (e.g., admin, checkout)
        'order_key'     => $order->get_order_key(),           // Unique order key
        'cookies'       => array()                            // Subarray for cookies
    );

    // Adding Facebook cookies to the 'cookies' subarray
    $customer_details['cookies']['fbp'] = isset($_COOKIE['_fbp']) ? sanitize_text_field($_COOKIE['_fbp']) : '';
    $customer_details['cookies']['fbc'] = isset($_COOKIE['_fbc']) ? sanitize_text_field($_COOKIE['_fbc']) : '';

    return $customer_details;
}

