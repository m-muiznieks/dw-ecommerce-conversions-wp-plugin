<?php
if ( ! defined( 'ABSPATH' ) ) { die(); }

function dw_add_note_to_order($order_id, $note, $note_type = 'private') {
    // Get the order object
    $order = wc_get_order($order_id);
    if (!$order) {
        return 'Order not found.';
    }

    // Add the note
    $order->add_order_note($note, $note_type === 'customer');

    // Save the changes
    $order->save();

    return 'Note added successfully.';
}