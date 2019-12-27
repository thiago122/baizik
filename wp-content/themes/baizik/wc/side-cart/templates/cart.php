


<div class="custom-side-cart is-open" style="overflow: auto">
    <div class="custom-side-cart__header">
        <?php echo cart_count_html('item', 'itens') ?>
    </div>
    <div class="custom-side-cart__content">
        <?php if ( WC()->cart->cart_contents_count == 0 ) : ?>
            Carrinho vazio
        <?php else : ?>
            <ul>
                <?php cart_items() ?>
            </ul>
        <?php endif; ?>
    </div>
     <div class="custom-side-cart__footer">
        Total <span class="cart-total"><?php echo cart_total_html() ?></span>
        <hr>
        <a href="<?php echo wc_get_checkout_url() ?>">Ir ao carrinho</a>
        <a href="<?php echo wc_get_cart_url() ?>">Finalizar compra</a>
    </div>
</div>
