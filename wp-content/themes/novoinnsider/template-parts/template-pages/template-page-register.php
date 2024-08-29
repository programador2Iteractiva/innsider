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

                    <form action="#" id="form-register" autocomplete="off">
                        <div class="mb-3 mt-4 px-3">
                            <div class="row m-0">
                                <div class="col col-12 col-md-6 px-2">
                                    <label class="mb-2 label-left2 form-label" for="name">Nombres*</label>
                                    <input class="form-control subs-email2" name="name" id="name" type="text" placeholder="" required>
                                </div>
                                <div class="col col-12 col-md-6 px-2">
                                    <label class="mb-2 label-left2 form-label" for="last_name">Apellidos*</label>
                                    <input class="form-control subs-email2" name="last_name" id="last_name" type="text" placeholder="" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 px-3">
                            <div class="row m-0">
                                <div class="col col-12 col-md-6 px-2">
                                    <label class="mb-2 label-left2 form-label" for="document">Documento de identidad*</label>
                                    <input class="form-control subs-email2" name="document" id="document" type="text" placeholder="" required>
                                </div>
                                <div class="col col-12 col-md-6 px-2">
                                    <label class="mb-2 label-left2 form-label" for="confirm-document">Confirmar documento de identidad*</label>
                                    <input class="form-control subs-email2" name="confirm-document" id="confirm-document" type="text" placeholder="" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 px-3">
                            <div class="row m-0">
                                <div class="col col-12 col-md-6 px-2">
                                    <label class="mb-2 label-left2 form-label" for="email-r">E-mail*</label>
                                    <input class="form-control subs-email2" name="email-r" id="email-r" type="email" placeholder="" required>
                                </div>
                                <div class="col col-12 col-md-6 px-2">
                                    <label class="mb-2 label-left2 form-label" for="phone">Telefono*</label>
                                    <input class="form-control subs-email2" name="phone" id="phone" type="number" placeholder="" required>
                                </div>
                            </div>
                        </div>


                        <div class="mb-3 px-4">
                            <label class="mb-2 label-left2 form-label" for="speciality">Especialidad*</label>
                            <select class="form-control form-select subs-email2" name="speciality" id="speciality" required>
                                <?php $specialties = novo_inssider_get_specialities();
                                if (!empty($specialties)) :
                                    foreach ($specialties as $specialty) : ?>
                                        <option value="<?= $specialty->name_speciality ?>"><?= $specialty->name_speciality ?></option>
                                    <?php endforeach; ?>

                                <?php else : ?>
                                    <option value="">Vacio</option>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="mb-3 px-4 position-relative">
                            <label class="mb-2 label-left2 form-label" for="institution">Institución*</label>
                            <input class="form-control subs-email2" name="institution" id="institution" type="text" required>

                            <div class="position-relative">
                                <ul id="lista" class="custom-select-list"></ul>
                            </div>           
                        </div>
                        <div class="mb-3 px-4 d-none" id="input13">
                            <label class="mb-2 label-left2 form-label" for="other_institution">Otra Institución*</label>
                            <input class="form-control subs-email2" name="other_institution" id="other_institution" type="text" placeholder="Nombre de la Institución">
                        </div>
                        <div class="mb-3 px-3">
                            <div class="row m-0">
                                <div class="">
                                    <label class="mb-2 label-left2 form-label" for="position_institution">Cargo en la institución*</label>
                                    <select class="form-control form-select subs-email2" name="position_institution" id="position_institution" required>
                                        <?php $positionInstitution = novo_inssider_get_position_institution();
                                        if (!empty($positionInstitution)) :
                                            foreach ($positionInstitution as $positionInst) : ?>
                                                <option value="<?= $positionInst->name_pos_institution ?>"><?= $positionInst->name_pos_institution ?></option>
                                            <?php endforeach; ?>

                                        <?php else : ?>
                                            <option value="">Vacio</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="mb-3 px-3">
                            <div class="row m-0">
                                <div class="col col-12 col-md-6 px-2">
                                    <label class="mb-2 label-left2 form-label" for="speciality">País*</label>
                                    <select class="form-control form-select subs-email2" name="country" id="country" required>
                                        <?php $countries = novo_inssider_get_countries();
                                        if (!empty($countries)) :
                                            foreach ($countries as $country) : ?>
                                                <option value="<?= $country->code ?>"><?= $country->name_country ?></option>
                                            <?php endforeach; ?>

                                        <?php else : ?>
                                            <option value="">Vacio</option>
                                        <?php endif; ?>
                                    </select>
                                </div>
                                <div class="col col-12 col-md-6 px-2" id="prueba">
                                    <label class='mb-2 label-left2 form-label' for='city'>Ciudad*</label>
                                    <input class="form-control subs-email2" name="city" id="city" type="text" required>

                                    <div class="position-relative">
                                        <ul id="listCity" class="custom-select-list"></ul>
                                    </div>   
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="d-flex justify-content-center align-items-center mb-3 px-3">
                                <label class="container-checkbox Commissioner-Light form-label d-flex align-items-center flex-row-reverse" id="c1">He leído y acepto los terminos y condiciones*
                                    <input type="checkbox" id="check_terms" class="mx-2" required>
                                    <span class="checkmark"></span>
                                </label>
                            </div>

                            <div class="d-flex justify-content-center align-items-center mb-3 px-3">
                                <label class="container-checkbox Commissioner-Light form-label d-flex align-items-center flex-row-reverse" id="c2">Acepto tratamiento de datos*
                                    <input type="checkbox" id="dataTreatment" class="mx-2" required>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button class="btn-login-two p-2 w-75" type="submit">Registrarse</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>