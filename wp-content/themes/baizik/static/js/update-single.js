// https://elartica.com/2017/08/03/woocommerce-ajax-add-cart-single-product-page/
// https://givemeans.wordpress.com/2018/08/16/woocommerce-calculate-shipping-without-reloading-page-by-ajax/


var $ = jQuery;

var $warp_fragment_refresh = {
    url: woocommerce_params.wc_ajax_url.toString().replace( '%%endpoint%%', 'get_refreshed_fragments' ),
    type: 'POST',
    success: function( data ) {
        if ( data && data.fragments ) {
            // jQuery( document.body ).trigger( 'wc_fragments_refreshed', data );
            replaceFragmentsOnCode(data.fragments)
        }
    }
};


// $('.entry-summary form.cart').on('submit', function (e)
// {
//     e.preventDefault();

//     $('.entry-summary').block({
//         message: null,
//         overlayCSS: {
//             cursor: 'none'
//         }
//     });

//     var product_url = window.location;
//     var form = $(this);

//     $.post(product_url, form.serialize() + '&_wp_http_referer=' + product_url, function (result)
//     {

//         // update fragments
//         updateCartFragments()

//         $('.entry-summary').unblock();

//     });
// });


$(document).on('wc_fragments_refreshed', replaceFragmentsOnCode );
$(document).on('change', '.js-side-cart-change-qty', updateQuantity );
$(document).on('click', '.js-remove-basket-item', removeSideCartItem );
$(document).on('click', '.side-cart__add-item', increaseSideCartItem );
$(document).on('click', '.side-cart__rm-item', decreaseSideCartItem );

function increaseSideCartItem(){
    console.log('Action: Increase item')

    item = $(this).parents('.side-cart__control-item')
    $input = item.find('.input-text');

    var qt = $input.val();
        qt++;

    if( qt ){
        $input.val(qt);
        $input.trigger('change', $(this));
    }

}

function decreaseSideCartItem(){
    console.log('Action: Increase item')

    item = $(this).parents('.side-cart__control-item')
    $input = item.find('.input-text');

    var qt = $input.val();
        qt--;

    if( qt && qt > 0 ){
        $input.val(qt);
        $input.trigger('change', $(this));
    }

}

function updateCartFragments(){
    jQuery.ajax($warp_fragment_refresh);
}

function replaceFragmentsOnCode(fragments){
    console.log('Action: replaceFragmentsOnCode')
    if ( fragments ) {
        $.each( fragments, function( key, value ) {
            $( key ).replaceWith( value );
        });
    }
}

function updateQuantity(e, button){

    $input = $(this);

    if ( typeof woocommerce_params === 'undefined' ){
        return false;
    }

    var item = $input.parents('.custom-side-cart__item').block({
        message: null,
        overlayCSS: {
            background: '#000',
            opacity: 0.6
        }
    });

    var data = {
        action: 'change_cart_item_qty',
    };

    $.each( $input.data(), function( key, value ) {
        data[key] = value;
    });

    data.quantity = $input.val();

    $.post( woocommerce_params.ajax_url, data, function( response ) {

        if ( ! response ){
            return;
        }

        replaceFragmentsOnCode(response.fragments)

        if ( response.fragments ) {
            $.each( response.fragments, function( key, value ) {
                $( key ).addClass( 'updating' );
            });
        }

    });

}

function removeSideCartItem(e){

    console.log('Action: removeSideCartItem');

    e.stopPropagation();
    e.preventDefault();

    var item = $(this).parents('.custom-side-cart__item');

    item.block({
        message: null,
        overlayCSS: {
            background: '#000',
            opacity: 0.6
        }
    });

    item.find('.input-text').val(0).trigger('change', $(this));
}

