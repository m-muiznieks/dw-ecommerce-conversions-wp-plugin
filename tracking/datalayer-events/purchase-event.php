<?php
if ( ! defined( 'ABSPATH' ) ) { die(); }

include_once(DW_BASE_DIR . 'actions/woocommerce/functions/get-order-details.php');
include_once(DW_BASE_DIR . 'utils/get-current-hostname.php');

add_action('woocommerce_thankyou', 'dw_custom_gtm_data_layer_push');


function dw_custom_gtm_data_layer_push($order_id) {
    if (!$order_id) return;

    $order_data = dw_order_details($order_id);
    if (!$order_data) return;  // Check if order data is null and return if true

    // Extract items formatted for the data layer
    $items = array_map(function($item) {
        // Handling categories
        $categoryData = [];
        if (!empty($item['categories'])) {
            foreach ($item['categories'] as $index => $category) {
                // Ensure the first category is 'item_category', subsequent ones 'item_category2', 'item_category3', etc.
                $categoryIndex = $index == 0 ? '' : $index + 1;
                $categoryData["item_category$categoryIndex"] = $category;
            }
        } else {
            $categoryData['item_category'] = 'Uncategorized'; // Default if no categories
        }

        // Include parent SKU if the item is a variation
        $parentSku = !empty($item['parent_sku']) ? $item['parent_sku'] : '';

        return array_merge([
            'item_id' => $item['product_id'],
            'item_name' => $item['product_name'],
            'quantity' => $item['quantity'],
            'price' => $item['price'],
            'variant' => $item['variation_id'] ?? '',
            'sku' => $item['sku'],
            'parent_sku' => $parentSku  // Include parent SKU
        ], $categoryData);
    }, $order_data['items']);

    // Coupons details
    $coupon_codes = array_map(function($coupon) {
        return $coupon['code'];
    }, $order_data['coupons_details']);
    $coupons_applied = implode(', ', $coupon_codes);

    ?>
    <script>
        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push({
            'event': 'purchase',
            'ecommerce': {
                'transaction_id': '<?php echo esc_js($order_data['order_id']); ?>',
                'affiliation': '<?php echo esc_js(dw_get_current_hostname()); ?>',
                'value': <?php echo esc_js($order_data['order_total']); ?>,
                'currency': '<?php echo esc_js($order_data['order_currency']); ?>',
                'tax': <?php echo esc_js($order_data['order_tax']); ?>,
                'shipping': <?php echo esc_js($order_data['order_shipping']); ?>, 
                'coupon': '<?php echo esc_js($coupons_applied); ?>',
                'items': <?php echo json_encode($items); ?>
            }
        });
    </script>
    <?php
}






