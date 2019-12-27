<?php
// https://docs.woocommerce.com/wc-apidocs/source-function-woocommerce_wp_text_input.html#14-79


function prefix_add_text_input() {
  $args = array(
    'label'         => 'Loja', // Text in the label in the editor.
    'placeholder'   => '', // Give examples or suggestions as placeholder
    'class'         => 'short',
    'style'         => '',
    'wrapper_class' => 'form-field',
    'value'         => get_post_meta( get_the_ID(), 'vendor_id', true ), // if empty, retrieved from post_meta
    'id'            => 'vendor_id', // required, will be used as meta_key
    'name'          => 'vendor_id', // name will be set automatically from id if empty
    'type'          => 'text',
    'desc_tip'      => '',
    'data_type'     => '',
    'custom_attributes' => '', // array of attributes you want to pass
    'description'   => ''
  );
  woocommerce_wp_text_input( $args );
}

// Salva os dados
function prefix_add_text_input_save( $post_id ){
    $value =  $_POST['vendor_id'];
    // var_dump($value); die();
    update_post_meta( $post_id, 'vendor_id', $value );
}

add_action( 'woocommerce_product_options_general_product_data', 'prefix_add_text_input' );
add_action( 'woocommerce_process_product_meta',    'prefix_add_text_input_save' );
