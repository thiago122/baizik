<?php get_header() ?>

<?php if ( have_posts() ): while ( have_posts() ) :?>
    <?php the_post(); ?>

    <h2><?php the_title(); ?></h2>
    <?php woocommerce_content(); ?>

<?php endwhile; endif; ?>

<?php get_footer() ?>
