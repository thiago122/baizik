<?php
/**
 * Baseado em
 * https://github.com/creativelittledots/woocommerce-side-cart
 */

/**
 * Determina o caminho para os arquivos do sidecart
 */
define('SIDECARTPATH', TEMPLATEPATH . '/wc/side-cart/');


include(SIDECARTPATH . 'functions.php');

/**
 * Só inclui se for uma requisição ajax
 */
if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
    include(SIDECARTPATH . 'ajax.php');
}
