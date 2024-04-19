<?php
if ( ! defined( 'ABSPATH' ) ) { die(); }

//BUILD ITEMS ARRAY
function dw_order_get_items($order) {
    $items = array();
    foreach ($order->get_items() as $item_id => $item) {
        $product = $item->get_product();

        // Initialize the parent SKU variable
        $parent_sku = '';
        $variation_id = '';

        // Check if the product is a variation
        if ($product instanceof WC_Product_Variation) {
            // It's a variation, get the parent product ID
            $parent_id = $product->get_parent_id();
            // Load the parent product
            $parent_product = wc_get_product($parent_id);
            // Get the SKU of the parent product
            $parent_sku = $parent_product ? $parent_product->get_sku() : '';
            // Get the variation ID of the product
            $variation_id = $product->get_id();
        
        }

        // Build an array for each item containing relevant data
        $items[] = [
            'item_id'       => $item_id,
            'product_id'    => $product->get_id(),
            'variation_id'  => $variation_id,
            'product_name'  => $item->get_name(),
            'quantity'      => $item->get_quantity(),
            'subtotal'      => $item->get_subtotal(),
            'total'         => $item->get_total(),
            'sku'           => $product ? $product->get_sku() : '',
            'parent_sku'    => $parent_sku,  // Include parent SKU
            'price'         => $product ? $product->get_price() : 0,
            'categories'    => dw_get_product_categories($product),
            'is_variation'  => $product instanceof WC_Product_Variation // True if product is a variation
        ];
    }

    return $items;
}




//ITEM CATEGORIES
function dw_get_product_categories($product) {
    if (!$product) { return; }

    // Retrieve categories
    $category_terms = wc_get_product_terms($product->get_id(), 'product_cat', array('fields' => 'names'));

    if (empty($category_terms)) {
        return ['Uncategorized'];
    }

    return $category_terms; // Return the array of category names directly
}






// Get custom field from order items
function dw_get_custom_field_from_order_items($order_id, $meta_key) {
    // Fetch the order by ID
    $order = wc_get_order($order_id);
    if (!$order) {
        return 'Order not found.';
    }

    // Array to store results
    $item_meta_data = [];

    // Loop through order items
    foreach ($order->get_items() as $item_id => $item) {
        // Retrieve the custom field/meta data for each item
        $meta_value = $item->get_meta($meta_key, true);
        $item_meta_data[$item_id] = $meta_value;
    }

    return $item_meta_data;
}

// Get all meta fields from order items
function dw_get_all_meta_fields_from_order_items($order_id) {
    // Fetch the order by ID
    $order = wc_get_order($order_id);
    if (!$order) {
        return 'Order not found.';
    }

    // Array to store results
    $item_meta_data = [];

    // Loop through order items
    foreach ($order->get_items() as $item_id => $item) {
        // Retrieve all meta data for each item
        $meta_data = $item->get_formatted_meta_data('_', true);
        $item_meta = [];
        foreach ($meta_data as $meta_id => $meta) {
            $item_meta[$meta->key] = $meta->value;
        }
        $item_meta_data[$item_id] = $item_meta;
    }

    return $item_meta_data;
}

