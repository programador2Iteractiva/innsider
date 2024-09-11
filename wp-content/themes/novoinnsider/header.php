<?php
if (!is_user_logged_in() && (is_page('herramientas'))) {
    auth_redirect();
    exit;
}elseif (is_user_logged_in() && (is_page('login')) || is_user_logged_in() && (is_page('registro')) ) { 
    wp_safe_redirect(get_site_url());
}
?>


<!DOCTYPE html>
<html lang="en" style="margin: 0 !important;">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title(); ?></title>
    <script id="cookieyes" type="text/javascript" src="https://cdn-cookieyes.com/client_data/11fba7f348bf2f0313186e00/script.js"></script>
    <script type="text/javascript"></script>
    <?php wp_head(); ?>
</head>

<body>

    <header>
        <div class="">
            <div class="">
                <nav class="navbar navbar-expand-lg py-lg-5 py-4 d-lg-flex justify-content-between align-items-lg-center flex-row mx-4 mx-lg-0">
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
                        </div>
                    </div>

                    <div class="d-none d-lg-block row m-0 p-0">
                        <div class="class-btns-register d-flex justify-content-center">
                            <div class="d-flex justify-content-center align-items-center flex-row container-btn-login">
                                <?php if (is_page('login') || is_page('registro') || !is_user_logged_in()) : ?>

                                    <?php $pageLogin = get_page_by_path('login'); ?>
                                    <?php if($pageLogin) : ?>
                                        <?php $permalink = get_permalink($pageLogin->ID); ?>
                                        <a class="btn-login mx-2" id="btn-login" href="<?php echo esc_url($permalink); ?>">Ingresar</a>
                                    <?php endif ?>
                                    <?php $pageRegister = get_page_by_path('Registro'); ?>
                                    <?php if($pageRegister) : ?>
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
                                    <?php if($pageLogin) : ?>
                                        <?php $permalink = get_permalink($pageLogin->ID); ?>
                                        <a class="btn-login mx-2" id="btn-login" href="<?php echo esc_url($permalink); ?>">Ingresar</a>
                                    <?php endif ?>
                                    <?php $pageRegister = get_page_by_path('Registro'); ?>
                                    <?php if($pageRegister) : ?>
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