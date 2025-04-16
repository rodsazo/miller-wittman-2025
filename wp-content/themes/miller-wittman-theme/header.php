<!DOCTYPE html>
<html lang="<?php echo get_locale(); ?>">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <!-- Disable automatic link creation in Safari -->
    <meta name="format-detection" content="telephone=no">
    <title>
        <?php wp_title('|', true, 'right') ?>
        <?php bloginfo('name'); ?>
    </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <?php foreach( \Theme\ThemeSetup::getFontsUrls() as $fonts_url ): ?>
        <link href="<?php echo $fonts_url; ?>" rel="stylesheet">
    <?php endforeach; ?>

    <?php wp_head(); ?>
    <?php echo get_field('header_tracking_codes', 'options'); ?>

    <script>
        document.addEventListener('alpine:init', function(){ Alpine.prefix('data-x-') })
    </script>

    <script src="<?php echo TEMPLATE_URL; ?>/assets/js/alpine.plugins.js" defer></script>
    <script src="<?php echo TEMPLATE_URL; ?>/assets/js/alpine.js" defer></script>

</head>

<body>
<?php echo get_field('body_tracking_codes', 'options'); ?>

<?php part('topBar'); ?>
<div class="page-container">
<?php part('siteHeader'); ?>