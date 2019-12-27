<?php

// ---------------------------------------------------------------------------------------------------------------------
// ATUALIZAR ITENS DO SIDECART
// ---------------------------------------------------------------------------------------------------------------------

add_action( 'wp_ajax_change_cart_item_qty' , 'change_cart_item_qty' );
add_action( 'wp_ajax_nopriv_change_cart_item_qty' , 'change_cart_item_qty' );

function change_cart_item_qty() {

    ob_start();

    $product_id        = apply_filters( 'woocommerce_add_to_cart_product_id', absint( $_POST['product_id'] ) );

    $quantity          = empty( $_POST['quantity'] ) ? 0 : wc_stock_amount( $_POST['quantity'] );

    $product_status    = get_post_status( $product_id );

    $cart_item_key = $_POST['cart_item_key'];


    if ( WC()->cart->set_quantity( $cart_item_key, $quantity, true ) && 'publish' === $product_status ) {

        if ( get_option( 'woocommerce_cart_redirect_after_add' ) == 'yes' ) {

            wc_add_to_cart_message( $product_id );

        }

        // Return fragments

        WC_Ajax::get_refreshed_fragments();

    } else {

        // If there was an error adding to the cart, redirect to the product page to show any errors

        $data = array(

            'error'       => true,

            'product_url' => apply_filters( 'woocommerce_cart_redirect_after_error', get_permalink( $product_id ), $product_id )

        );

        wp_send_json( $data );

    }

    die();

}

// ---------------------------------------------------------------------------------------------------------------------
// FRAGMENTOS
// ---------------------------------------------------------------------------------------------------------------------

add_filter('woocommerce_add_to_cart_fragments', 'cart_fragments', 10, 1 );

// adiciona alguns novos dados aos fragmentos que são retornados via ajax
function cart_fragments( $fragments ) {

    ob_start();
    side_cart();
    $sideCart = ob_get_clean();

    $fragments['span.cart-count'] = cart_count_html('item', 'itens');
    $fragments['span.cart-total'] = cart_total_html();
    $fragments['.custom-side-cart']  = $sideCart;
    return $fragments;
}

