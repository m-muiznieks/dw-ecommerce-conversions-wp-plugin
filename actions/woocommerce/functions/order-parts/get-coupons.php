<?php
if ( ! defined( 'ABSPATH' ) ) { die(); }

function dw_get_coupon_details_from_order($order) {
    $coupon_codes = $order->get_coupon_codes();
    $coupons_details = array();

    foreach ($coupon_codes as $coupon_code) {
        $coupon = new WC_Coupon($coupon_code);
        $coupons_details[] = array(
            'code'              => $coupon_code,
            'amount'            => $coupon->get_amount(),
            'type'              => $coupon->get_discount_type(),
            'usage_count'       => $coupon->get_usage_count(),
            'usage_limit'       => $coupon->get_usage_limit(),
            'usage_limit_per_user' => $coupon->get_usage_limit_per_user(),
            'expiry_date'       => $coupon->get_date_expires() ? $coupon->get_date_expires()->date('Y-m-d') : '',
            'minimum_spend'     => $coupon->get_minimum_amount(),
            'maximum_spend'     => $coupon->get_maximum_amount(),
            'product_ids'       => $coupon->get_product_ids(),
            'excluded_product_ids' => $coupon->get_excluded_product_ids(),
            'product_categories' => $coupon->get_product_categories(),
            'excluded_product_categories' => $coupon->get_excluded_product_categories(),
            'email_restrictions' => $coupon->get_email_restrictions(),
            'free_shipping'     => $coupon->get_free_shipping(),
        );
    }

    return $coupons_details;
}
