<?php

// Put this code on your function.php

function register_awaiting_shipment_order_status() {
    register_post_status( 'wc-awaiting-shipment', array(
        'label'                     => 'Dispatch',
        'public'                    => true,
        'exclude_from_search'       => false,
        'show_in_admin_all_list'    => true,
        'show_in_admin_status_list' => true,
        'label_count'               => _n_noop( 'Dispatch <span class="count">(%s)</span>', 'Dispatch <span class="count">(%s)</span>' )
    ) );
}
add_action( 'init', 'register_awaiting_shipment_order_status' );
// Add to list of WC Order statuses
function add_awaiting_shipment_to_order_statuses( $order_statuses ) {
    $new_order_statuses = array();
    // add new order status after processing
    foreach ( $order_statuses as $key => $status ) {
        $new_order_statuses[ $key ] = $status;
        if ( 'wc-processing' === $key ) {
            $new_order_statuses['wc-dispatch'] = 'dispatch';
        }
    }
    return $new_order_statuses;
}
add_filter( 'wc_order_statuses', 'add_awaiting_shipment_to_order_statuses' );

?>
