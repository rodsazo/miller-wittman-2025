<div class="mobMenu">
    <div class="mobMenu__layout">
        <?php wp_nav_menu([
            'theme_location' => \Theme\ThemeMenus::MAIN_MENU,
            'menu_class' => 'mobMenu__nav',
            'container' => false
        ]) ?>
    </div>
</div>