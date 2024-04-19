<?php
if ( ! defined( 'ABSPATH' ) ) { die(); }

/**
 * This function gets the order notes for a given order.
 * The default limit is 5 notes. It can be adjusted by passing a limit parameter.
 * For example: dw_get_order_notes_details_from_order($order, 10) to get 10 notes.
 *
 * @param [type] $order
 * @param integer $limit as default 5
 * @return array $order_notes_details
 */
function dw_get_order_notes_details_from_order($order, $limit = 5) {
    $order_notes_details = array();
    // Adjust the function call to limit the number of notes returned
    $notes = wc_get_order_notes(array(
        'order_id' => $order->get_id(),
        'limit'    => $limit
    ));

    foreach ($notes as $note) {
        $order_notes_details[] = array(
            'note_id'      => $note->id,
            'note_date'    => $note->date_created->date('Y-m-d H:i:s'),
            'note_content' => $note->content,
        );
    }

    return $order_notes_details;
}


