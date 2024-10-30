<?php

/**
 * Template for page login
 */
?>
<div class="banner-speakers">
    <?php the_post_thumbnail('', ['class' => 'bg-banner-speakers']) ?>
    <div class="wrapper-banner-speakers">
        <div class="container-text-banner-speakers">
            <p>
                INICIAR SESIÓN
            </p>
        </div>
        <div class="container-text-banner-speakers w-100 h-100 m-auto d-flex justify-content-lg-start align-items-center">
            <img src="<?= get_template_directory_uri() . '/assets/images/Icono-innsider-white.png'; ?>" alt="Herramientas" class="bg-banner-single-category">
        </div>
    </div>
</div>
<div class="container">
    <div class="container-page-login">
        <div class="wrapper-page-login d-flex flex-column">
            <div class="col-12 col-lg-7 d-flex justify-content-center align-items-center">
                <div class="card mt-3 mb-3 px-3 form-login-style">
                    <div class="m-0 p-0 w-100">

                        <form id="form-login" class="d-flex justify-content-center align-items-center flex-column w-100" action="<?php echo get_site_url() ?>/wp-login.php" method="post">
                            <div class="m-0 p-0 w-100">
                                <div class="form-group mt-2 mb-3">
                                    <div class="col col-12 px-2 position-relative">
                                        <label for="exampleInputEmail1" class="form-label">E-mail*</label>
                                        <input type="email" class="form-control input-password" id="email"  name="log"  autocomplete="username" required>
                                    </div>
                                </div>
                                <div class="form-group mt-2 mb-3">
                                    <div class="col col-12 px-2 position-relative">
                                        <label for="exampleInputEmail1" class="form-label">Cédula*</label>
                                        <input type="password" class="form-control input-password" id="password" name="pwd"  autocomplete="username" required>
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="redirect_to"
                                       value="<?php echo esc_url(isset($_GET['redirect_to']) && !empty($_GET['redirect_to']) ? $_GET['redirect_to'] : get_site_url()); ?>"/>

                            <div class="m-0 p-0 w-100 px-5 mt-4 mb-5">
                                <button type="submit" class="btn-login-two p-2">Login</button>
                            </div>

                        </form>

                        <?php $pageRegister = get_page_by_path('Registro'); ?>
                        <?php if($pageRegister) : ?>
                            <?php $permalink = get_permalink($pageRegister->ID); ?>
                            <a href="<?php echo esc_url($permalink); ?>" class="link-redirect-login d-flex justify-content-center align-items-center flex-lg-row flex-column mt-2 mb-2" style="text-decoration: none; color: #001965; font-weight: bold">¿Aún no está registrado? </a>
                        <?php endif ?>   
                        <a href="<?php echo esc_url(wp_lostpassword_url()); ?>" class="link-redirect-login d-flex justify-content-center align-items-center flex-lg-row flex-column mt-2 mb-2" style="text-decoration: none; color: #001965; font-weight: bold">¿Olvidó su contraseña? </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if (isset($_GET['login'])): ?>
    <?php if(isset($_GET['login']) && $_GET['login'] == 'success') : ?>
    <?php else : ?>
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Usuario o contraseña incorrectos.',
                showConfirmButton: false,
                showCancelButton: false,
                customClass: {
                    popup: "swal-styles"
                },
                confirmButtonText: "Acepto",
                confirmButtonColor: "#3085d6",
                color: "#000000",
            });
        </script>
    <?php endif; ?>
<?php endif; ?>