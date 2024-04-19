<?php
if ( ! defined( 'ABSPATH' ) ) { die(); }

function dw_display_order_sync_status($order) {
    $already_synced = $order->get_meta('_already_synced_wh', true);
    echo '<span class="labelSynced" style="paddingTop:4px"><strong>' . __('Already Synced:', 'textdomain') . '</strong>'.' '.'<span class="isSynced">'. esc_html($already_synced ? $already_synced : 'No') . '</span></span>';
}
add_action('woocommerce_admin_order_data_after_order_details', 'dw_display_order_sync_status');
