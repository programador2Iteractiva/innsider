<?php

/**
 * Template for page Registro
 */
?>
<div class="banner-speakers">
    <?php the_post_thumbnail('', ['class' => 'bg-banner-speakers']) ?>
    <div class="wrapper-banner-speakers">
        <div class="container-text-banner-speakers">
            <p>
                REGÍSTRESE <br>
                AHORA
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
            <div class="col-12 col-lg-12 d-flex justify-content-center align-items-center">
                <div class="card mt-3 mb-3 px-3 form-login-style">
                    <div class="m-0 p-0 w-100">

                        <form id="form-login" class="d-flex justify-content-center align-items-center flex-column w-100" name="form-login" action="<?php echo get_site_url() ?>/wp-login.php" method="post">
                            <div class="m-0 p-0 w-100">
                                <div class="form-group m-0 p-0 d-flex flex-row justify-content-around">
                                    <div class="col col-5 px-2 mb-2">
                                        <label class="label-left2" for="name">Nombres*</label>
                                        <input class="form-control" id="name" name="name" type="text" placeholder="" required>
                                    </div>
                                    <div class="col col-5 px-2 mb-2">
                                        <label class="label-left2" for="last_name">Apellidos*</label>
                                        <input class="form-control" id="last_name" name="last_name" type="text"
                                                placeholder="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="m-0 p-0 w-100">
                                <div class="form-group m-0 p-0 d-flex flex-row justify-content-around">
                                    <div class="col col-5 px-2 mb-2">
                                        <label class="label-left2" for="name">Cédula*</label>
                                        <input class="form-control" id="name" name="name" type="text" placeholder="" required>
                                    </div>
                                    <div class="col col-5 px-2 mb-2">
                                        <label class="label-left2" for="last_name">Confirmar Cédula*</label>
                                        <input class="form-control" id="last_name" name="last_name" type="text"
                                                placeholder="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="m-0 p-0 w-100">
                                <div class="form-group m-0 p-0 d-flex flex-row justify-content-around">
                                    <div class="col col-5 px-2 mb-2">
                                        <label class="label-left2" for="name">E-mail*</label>
                                        <input class="form-control" id="name" name="name" type="text" placeholder="" required>
                                    </div>
                                    <div class="col col-5 px-2 mb-2">
                                        <label class="label-left2" for="last_name">Teléfono*</label>
                                        <input class="form-control" id="last_name" name="last_name" type="text"
                                                placeholder="" required>
                                    </div>
                                </div>
                            </div>
                            <div class="m-0 p-0 w-100">
                                <div class="form-group m-0 p-0 d-flex flex-row justify-content-around">
                                    <div class="col col-11 px-2 position-relative">
                                        <label for="exampleInputEmail1" class="form-label">Especialidad*</label>
                                        <input type="text" class="form-control input-password" id="password" name="pwd" required>
                                    </div>
                                </div>
                                <div class="form-group m-0 p-0 d-flex flex-row justify-content-around">
                                    <div class="col col-11 px-2 position-relative">
                                        <label for="exampleInputEmail1" class="form-label">Institución*</label>
                                        <input type="email" class="form-control input-password" id="password" name="pwd" required>
                                    </div>
                                </div>
                            </div>
                            <div class="m-0 p-0 w-100">
                                <div class="form-group m-0 p-0 d-flex flex-row justify-content-around">
                                    <div class="col col-11 px-2 position-relative">
                                        <label for="exampleInputEmail1" class="form-label">Cargo en la institución*</label>
                                        <input type="text" class="form-control input-password" id="password" name="pwd" required>
                                    </div>
                                </div>
                            </div>
                            <div class="m-0 p-0 w-100">
                                <div class="form-group m-0 p-0 d-flex flex-row justify-content-around">
                                    <div class="col col-5 px-2 mb-2">
                                        <label class="label-left2" for="name">País*</label>
                                        <input class="form-control" id="name" name="name" type="text" placeholder="" required>
                                    </div>
                                    <div class="col col-5 px-2 mb-2">
                                        <label class="label-left2" for="last_name">Ciudad*</label>
                                        <input class="form-control" id="last_name" name="last_name" type="text"
                                                placeholder="" required>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center align-items-center flex-lg-row flex-column mt-4">

                                <div class="d-flex justify-content-center align-items-center flex-row">
                                    <input class="mx-2" type="checkbox" id="terms_condition" name="terms_condition" required>
                                    <span class="checkmark"></span>
                                    <label class="container-checkbox Commissioner-Light" id="c2">
                                        He leído y acepto los terminos y condiciones*
                                    </label>
                                </div>
                            </div>

                            <div class="d-flex justify-content-center align-items-center flex-row">
                                    <input class="mx-2" type="checkbox" id="terms_condition" name="terms_condition" required>
                                    <span class="checkmark"></span>
                                    <label class="container-checkbox Commissioner-Light" id="c2">
                                        Acepto tratamiento de datos*
                                    </label>
                                </div>
                            </div>

                            <div class="m-0 p-0 w-100 px-5 mt-4 mb-5">
                                <button type="submit" onclick="enviarp()" class="btn-login-two p-2">Regístrese</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>