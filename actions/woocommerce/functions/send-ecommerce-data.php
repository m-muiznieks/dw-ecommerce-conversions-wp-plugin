<?php
if ( ! defined( 'ABSPATH' ) ) { die(); }

function dw_send_ecommerce_data($order_data) {
    $webhook_url = get_option('dw_webhook_url');
    if (!$webhook_url) {
        return null;  // Early exit if no webhook URL is set
    }
    
    // Post data to the webhook
    $response = wp_remote_post($webhook_url, array(
        'method'      => 'POST',
        'headers'     => array('Content-Type' => 'application/json; charset=utf-8'),
        'body'        => json_encode($order_data),
        'data_format' => 'body'
    ));

    if (is_wp_error($response)) {
        $error_message = $response->get_error_message();
        dw_ecom_log_error("Error sending purchase data to webhook: $error_message");
        return "Something went wrong: $error_message";
    }

    $response_code = wp_remote_retrieve_response_code($response);
    $response_body = wp_remote_retrieve_body($response);

    if ($response_code < 200 || $response_code >= 300) {
        dw_ecom_log_error("HTTP error at sending purchase data to webhook: $response_code, Message: $response_body");
        return "HTTP error: $response_code, Message: $response_body";
    } else { 
        // Successful webhook call
        $order_id = $order_data['order_id'];
        $order = wc_get_order($order_id);
        
        if ($order) {
            $do_not_send_twice = get_option('dw_do_not_send_purchase_data_twice', 'FALSE');
            if ($do_not_send_twice === 'TRUE') {
                $order->update_meta_data('_already_synced_wh', 'TRUE');
                $order->save();
            }
        }
        
        return $response_body;
    }
}

