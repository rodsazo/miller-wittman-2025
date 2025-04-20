<?php
the_post();
get_header();
?>

<?php the_content(); ?>

<?php if( is_singular( \Theme\CustomPostTypes::WORK ) ): ?>
    <?php part('more-work'); ?>
<?php endif; ?>

<?php
get_footer();