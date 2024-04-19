<?php
if ( ! defined( 'ABSPATH' ) ) { die(); }

function dw_get_payment_details_from_order($order) {
    if (!$order) { return null; }
    return array(
        'payment_method'            => $order->get_payment_method(),
        'payment_method_title'      => $order->get_payment_method_title(),
        'transaction_id'            => $order->get_transaction_id(),
    );
}