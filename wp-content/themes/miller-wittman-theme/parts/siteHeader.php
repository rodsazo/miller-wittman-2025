<?php
$header_bg = get_field('header_background');
?>
<div class="siteHeader siteHeader--<?php echo $header_bg; ?>">
    <div class="container">
        <div class="siteHeader__layout">

            <a href="/" class="siteHeader__logo">
                <?php part('site-logo'); ?>
            </a>

            <div class="siteHeader__menu">
                <?php
                wp_nav_menu([
                    'theme_location' => \Theme\ThemeMenus::MAIN_MENU,
                    'container' => false,
                    'menu_class' => 'siteHeader__nav'
                ]);
                ?>
            </div>

            <button class="siteHeader__mobBtn">
                <span></span>
                <span></span>
                <span></span>
            </button>

        </div>
    </div>
</div>

<div class="siteHeader__spacer"></div>