<?php
if ( ! defined( 'ABSPATH' ) ) { die(); }

function dw_get_shipping_details_from_order($order) {
    return array(
        'first_name'    => $order->get_shipping_first_name(),
        'last_name'     => $order->get_shipping_last_name(),
        'company'       => $order->get_shipping_company(),
        'address_1'     => $order->get_shipping_address_1(),
        'address_2'     => $order->get_shipping_address_2(),
        'city'          => $order->get_shipping_city(),
        'state'         => $order->get_shipping_state(),
        'postcode'      => $order->get_shipping_postcode(),
        'country'       => $order->get_shipping_country(),
        'method'        => $order->get_shipping_method(),
    );
}
