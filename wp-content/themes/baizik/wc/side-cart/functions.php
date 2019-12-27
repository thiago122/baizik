<?php



/**
 * Baseado em woocommerce/templates/cart/mini-cart.php
 *
 */
function cart_items(){

    foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
        $_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
        $product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

        if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

            $item = array(
                'name'       => apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ),
                'thumbnail'  => apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key ),
                'price'      => apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ),
                'permalink'  => apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key ),
                'remove_url' => esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
                'quantity'   => $cart_item['quantity'],
                'cart_item_key'   => $cart_item_key,
                'id'         => $_product->get_id(),
                'sku'        => $_product->get_sku()
            );

            require SIDECARTPATH.'templates/cart-item.php';

        }

    }

}

function side_cart(){
    include(SIDECARTPATH.'templates/cart.php');
}

/**
 * Retorna o total de itens no carrinho
 * a classe do html adicionado é utilizado no ajax dos fragmentos
 */
function cart_count_html( $singular = '', $plural = '' ){

    $itens = WC()->cart->get_cart_contents_count();

    $text = ( $itens == 1 ) ? $singular : $plural;

    return '<span class="cart-count">' . $itens . ' ' . $text. '</span>';
}

/**
 * Retorna o valor total no carrinho
 * inclui o cifrão Ex:€1,245.00
 * a classe do html adicionado é utilizado no ajax dos fragmentos
 */
function cart_total_html(){
    return '<span class="cart-total">' . WC()->cart->get_cart_subtotal() . '</span>';
}



/**
 * @snippet       Disable WooCommerce Ajax Cart Fragments On Static Homepage
 * @how-to        Get CustomizeWoo.com FREE
 * @author        Rodolfo Melogli
 * @compatible    WooCommerce 3.6.4
 * @donate $9     https://businessbloomer.com/bloomer-armada/
 */

add_action( 'wp_enqueue_scripts', 'bbloomer_disable_woocommerce_cart_fragments', 11 );

function bbloomer_disable_woocommerce_cart_fragments() {
    // if ( is_front_page() )
    wp_dequeue_script( 'wc-cart-fragments' );
}
