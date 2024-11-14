<?php
if (!is_user_logged_in() && (is_page('herramientas'))) {
    auth_redirect();
    exit;
} elseif (is_user_logged_in() && (is_page('login')) || is_user_logged_in() && (is_page('registro'))) {
    wp_safe_redirect(get_site_url());
}

novo_innsider_save_logs();

?>


<!DOCTYPE html>
<html lang="en" style="margin: 0 !important;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title(); ?></title>
    
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-DK3B6EZZD4"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-DK3B6EZZD4');
    </script>


    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-PV3QN9VR');</script>
    <!-- End Google Tag Manager -->

    <?php wp_head(); ?>
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PV3QN9VR"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
     
    <header id="header">
        <div class="">
            <div class="">
                <nav class="navbar navbar-expand-lg py-4 d-lg-flex justify-content-between align-items-lg-center flex-row mx-4 mx-lg-0">
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="d-block mx-lg-5 custom-logo-container d-flex justify-content-center align-items-center">
                            <?php if (has_custom_logo()) : ?>
                                <?php the_custom_logo(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#main-menu" aria-controls="main-menu">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="offcanvas offcanvas-end" tabindex="-1" id="main-menu" aria-labelledby="main-menu-label">
                        <div class="offcanvas-header">
                            <h5 class="offcanvas-title" id="main-menu-label">Menu</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body d-lg-flex d-block justify-content-lg-center align-items-lg-center">

                            <div class="d-none d-lg-block row m-0 p-0">

                                <?php if (function_exists('max_mega_menu_is_enabled') && max_mega_menu_is_enabled('primary')) : ?>
                                    <?php wp_nav_menu(array('theme_location' => 'primary')); ?>
                                <?php else: ?>
                                    <?php
                                    wp_nav_menu(array(
                                        'theme_location' => 'primary',
                                        'container' => false,
                                        'menu_class' => 'navbar-nav',
                                        'fallback_cb' => '__return_false',
                                        'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                        'depth' => 3,
                                        'walker' => new bootstrap_5_wp_nav_menu_walker()
                                    ));
                                    ?>
                                <?php endif; ?>

                            </div>

                            <div class="d-block d-lg-none col-12">
                                <?php
                                wp_nav_menu(array(
                                    'theme_location' => 'secundary',
                                    'container' => false,
                                    'menu_class' => 'navbar-nav',
                                    'fallback_cb' => '__return_false',
                                    'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                    'depth' => 3,
                                    'walker' => new bootstrap_5_wp_nav_menu_walker()
                                ));
                                ?>
                            </div>

                        </div>
                    </div>

                    <div class="d-none d-lg-block row m-0 p-0">
                        <div class="class-btns-register d-flex justify-content-center">
                            <div class="d-flex justify-content-center align-items-center flex-row container-btn-login">
                                <?php if (is_page('login') || is_page('registro') || !is_user_logged_in()) : ?>

                                    <?php $pageLogin = get_page_by_path('login'); ?>
                                    <?php if ($pageLogin) : ?>
                                        <?php $permalink = get_permalink($pageLogin->ID); ?>
                                        <a class="btn-login mx-2" id="btn-login" href="<?php echo esc_url($permalink); ?>">Ingresar</a>
                                    <?php endif ?>
                                    <?php $pageRegister = get_page_by_path('Registro'); ?>
                                    <?php if ($pageRegister) : ?>
                                        <?php $permalink = get_permalink($pageRegister->ID); ?>
                                        <a class="btn-login mx-2" id="btn-register" href="<?php echo esc_url($permalink); ?>">Registro</a>
                                    <?php endif ?>

                                <?php else : ?>

                                    <?php $data = novo_innsider_name_user(); ?>

                                    <div class="d-flex justify-content-center align-items-center flex-row container-btn-login">
                                        <div class="btn-login d-none">
                                            <?= novo_innsider_logout(); ?>
                                        </div>
                                        <div class="mx-3 d-flex justify-content-center align-items-center text-center">
                                            <?php echo novo_innsider_display_user_name(); ?>
                                        </div>
                                    </div>

                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="d-block d-lg-none col-12">
                        <div class="class-btns-register d-flex justify-content-center mt-4">
                            <div class="d-flex justify-content-center align-items-center flex-row container-btn-login">
                                <?php if (is_page('login') || is_page('registro') || !is_user_logged_in()) : ?>
                                    <?php $pageLogin = get_page_by_path('login'); ?>
                                    <?php if ($pageLogin) : ?>
                                        <?php $permalink = get_permalink($pageLogin->ID); ?>
                                        <a class="btn-login mx-2" id="btn-login" href="<?php echo esc_url($permalink); ?>">Ingresar</a>
                                    <?php endif ?>
                                    <?php $pageRegister = get_page_by_path('Registro'); ?>
                                    <?php if ($pageRegister) : ?>
                                        <?php $permalink = get_permalink($pageRegister->ID); ?>
                                        <a class="btn-login mx-2" id="btn-register" href="<?php echo esc_url($permalink); ?>">Registro</a>
                                    <?php endif ?>
                                <?php else : ?>
                                    <?php $data = novo_innsider_name_user(); ?>

                                    <div class="d-flex justify-content-center align-items-center flex-lg-row flex-column container-btn-login">
                                        <div class="mx-3 d-flex justify-content-center align-items-center text-center">
                                            <?php echo novo_innsider_display_user_name(); ?>
                                        </div>
                                        <div class="btn-login mt-2">
                                            <?= novo_innsider_logout(); ?><i class="mx-2 fas fa-power-off"></i>
                                        </div>
                                    </div>
                                <?php endif ?>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>