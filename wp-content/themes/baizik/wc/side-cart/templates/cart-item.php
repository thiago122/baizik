<?php
    $product_anchor_open  = '';
    $product_anchor_close = '';

    if ( !empty( $item['permalink'] ) ) :
        $product_anchor_open  = '<a href="'. esc_url( $item['permalink'] ) .'">';
        $product_anchor_close = '</a>';
    endif;
?>

<li class="custom-side-cart__item">
    <a class="js-remove-basket-item" href="<?php echo $item['remove_url'] ?>">Remover</a>


    <?php echo $product_anchor_open ?>

    <?php echo $item['thumbnail'] ?>
    <h5><?php echo $item['name'] ?></h5>
    <p>Por <?php echo $item['price'] ?></p>

    <?php echo $product_anchor_close ?>

    <div class="side-cart__control-item">
        <span class="side-cart__rm-item">-</span>
        <input class="input-text qty js-side-cart-change-qty text side-cart__qty" type="number" step="1" min="0" name="cart[<?php echo $item['cart_item_key']; ?>][qty]" value="<?php echo $item['quantity']; ?>" title="Qty" size="4" data-product_id="<?php echo esc_attr( $item['id'] ); ?>" data-product_sku="<?php echo esc_attr( $item['sku'] ); ?>" data-cart_item_key="<?php echo $cart_item_key; ?>" />
        <span class="side-cart__add-item">+</span>
    </div>

</li>





