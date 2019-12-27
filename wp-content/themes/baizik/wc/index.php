<?php

include(TEMPLATEPATH . '/wc/support.php');
include(TEMPLATEPATH . '/wc/side-cart/index.php');
include(TEMPLATEPATH . '/wc/customize-admin/index.php');


$user = wp_get_current_user();
$roles = ( array ) $user->roles;

// print_r($roles);

$role = get_role('Loja');
// var_dump( $role );


if( is_admin() && current_user_can( 'edit_posts' ) ){
    include(TEMPLATEPATH . '/wc/vendor-user.php');
}




// -------------------------------------------------------------------------
//

// Plugin
// https://github.com/wcmarketplace/dc-woocommerce-multi-vendor

// MARKETPLACE
// https://www.ecommercebrasil.com.br/artigos/criar-e-gerenciar-um-marketplace-no-brasil/

// SPLIT <-------------------------------
// https://www.xadapter.com/woocommerce-split-cart-items-order-ship-via-multiple-shipping-methods/
// https://jeroensormani.com/splitting-shipping-packages-in-woocommerce/
//



/**
 * Split all shipping class 'A' products in a separate package
 */

 // https://jeroensormani.com/splitting-shipping-packages-in-woocommerce/
function custom_split_shipping_packages_shipping_class( $packages ) {

    // Reset all packages
    $packages              = array();
    $regular_package_items = array();
    $vendor_package_items   = array();


    foreach ( WC()->cart->get_cart() as $item_key => $item ) {

        $vendor_id = get_post_meta( $item['product_id'], 'vendor_id', true );

        if ( $item['data']->needs_shipping() ) {

            if ( !empty($vendor_id) ) {
                $vendor_package_items['vendor_'.$vendor_id][ $item_key ] = $item;
            } else {
                $regular_package_items[ $item_key ] = $item;
            }
        }

    }

    // Create shipping packages
    if ( $regular_package_items ) {
        $packages[] = array(
            'contents'        => $regular_package_items,
            'contents_cost'   => array_sum( wp_list_pluck( $regular_package_items, 'line_total' ) ),
            'applied_coupons' => WC()->cart->get_applied_coupons(),
            'user'            => array(
                 'ID' => get_current_user_id(),
            ),
            'destination'    => array(
                'country'    => WC()->customer->get_shipping_country(),
                'state'      => WC()->customer->get_shipping_state(),
                'postcode'   => WC()->customer->get_shipping_postcode(),
                'city'       => WC()->customer->get_shipping_city(),
                'address'    => WC()->customer->get_shipping_address(),
                'address_2'  => WC()->customer->get_shipping_address_2()
            )
        );
    }

    if ( $vendor_package_items ) {

        foreach ($vendor_package_items as $key => $value) {

            $packages[] = array(
                'contents'        => $value,
                'contents_cost'   => array_sum( wp_list_pluck( $value, 'line_total' ) ),
                'applied_coupons' => WC()->cart->get_applied_coupons(),
                'user'            => array(
                     'ID' => get_current_user_id(),
                ),
                'destination'    => array(
                    'country'    => WC()->customer->get_shipping_country(),
                    'state'      => WC()->customer->get_shipping_state(),
                    'postcode'   => WC()->customer->get_shipping_postcode(),
                    'city'       => WC()->customer->get_shipping_city(),
                    'address'    => WC()->customer->get_shipping_address(),
                    'address_2'  => WC()->customer->get_shipping_address_2()
                )
            );

        }

    }

    // var_dump( WC() ); die();

    return $packages;

}
add_filter( 'woocommerce_cart_shipping_packages', 'custom_split_shipping_packages_shipping_class' );


// ===============================================================================================
//
