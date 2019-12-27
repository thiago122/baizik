<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
    <link rel="stylesheet" type="text/css" href="<?php bloginfo('template_url') ?>/style.css">
</head>

<body <?php body_class(); ?>>

<div id="page" class="site">

    <div class="custom-side-cart">TESTE asd asdas asd as asd</div>

    <?php // side_cart() ?>


    <?php echo cart_count_html('item', 'itens') ?> -  Total <?php echo cart_total_html() ?>


