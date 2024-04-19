<?php
if ( ! defined( 'ABSPATH' ) ) { die(); }

function dw_get_billing_details_from_order($order) {
    return array(
        'first_name'    => $order->get_billing_first_name(),
        'last_name'     => $order->get_billing_last_name(),
        'company'       => $order->get_billing_company(),
        'address_1'     => $order->get_billing_address_1(),
        'address_2'     => $order->get_billing_address_2(),
        'city'          => $order->get_billing_city(),
        'state'         => $order->get_billing_state(),
        'postcode'      => $order->get_billing_postcode(),
        'country'       => $order->get_billing_country(),
        'email'         => $order->get_billing_email(),
        'phone'         => $order->get_billing_phone(),
    );
}
