<?php

/**
 * Template for page Ayuda y soporte
 */
?>
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="m-5 font-weight-bold titleone"><?= the_title(); ?></h1>
        </div>
    </div>
</div>

<div class="container px-5">
    <div class="row" style="background:#DFEFEE">
        <div class="col-12">
            <p class="m-5 px-4 font-weight-bold titleone"><?php echo wp_strip_all_tags(get_the_content()); ?></p>
        </div>
    </div>
</div>

<div class="container">
    <div class="container-page-login">
        <div class="wrapper-page-login d-flex flex-column">
            <div class="col-12 col-lg-12 d-flex justify-content-center align-items-center">
                <div class="card mt-3 mb-3 px-3 form-login-style">
                    <div class="m-0 p-0 w-100">

                    <form action="#" id="form-support" autocomplete="off">
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
                                    <label class="mb-2 label-left2 form-label" for="email">Correo Electrónico*</label>
                                    <input class="form-control subs-email2" name="email" id="email" type="email" placeholder="" required>
                                </div>
                                <div class="col col-12 col-md-6 px-2">
                                    <label class="mb-2 label-left2 form-label" for="phone">Celular*</label>
                                    <input class="form-control subs-email2" name="phone" id="phone" type="number" placeholder="" required>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 px-4 position-relative">
                            <label class="mb-2 label-left2 form-label" for="description">Descripción*</label>
                            <textarea rows="10" class="form-control subs-email2" name="description" id="description" required></textarea>
                        </div>

                        <div class="d-flex justify-content-center mt-5">
                            <button class="btn-login-two p-2 w-50" type="submit">Continuar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>