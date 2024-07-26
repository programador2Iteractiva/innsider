<?php

/**
 * Template for page Academy
 */
?>

<div>
    <div class="container my-5 mb-0">
        <div class="row d-flex justify-content-center align-align-items-center mb-4">
            <div class="col-12 d-flex flex-lg-row">
                <h2 class="title">ACADEMIA</h2>
                <div class="col-11 mx-1" id="linea">
                    <hr class="mx-5 px-4">
                </div>
            </div>
            <P>Encuentre información educativa y nuestros eventos nacionales.</P>
        </div>
    </div>
    <div class="container banner-speakers">
        <?php the_post_thumbnail('', ['class' => 'bg-banner-speakers']) ?>
        <div class="wrapper-banner-speakers">
            <div class="container-text-banner-speakers">
                <p>
                    ACADEMIA
                </p>
            </div>
            <h4 class="text-white mt-3">Encuentre información educativa y <br>nuestros eventos nacionales.</h4>
            <div class="container-text-banner-speakers w-100 h-100 m-auto d-flex justify-content-lg-start align-items-center">
                <img src="<?= get_template_directory_uri() . '/assets/images/Icono-innsider-white.png'; ?>" alt="Herramientas" class="bg-banner-single-category">
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="content d-flex justify-content-center flex-lg-row flex-column">
            <div class="col-lg-6 mb-4">
                <a href="" style="text-decoration: none;">
                    <img src="<?= get_template_directory_uri() . '/assets/images/NOTICIA-01.png'; ?>" alt="Podcast">
                    <div class="card-info mt-3">
                        <div class="d-flex align-items-start flex-lg-row flex-column">
                            <div class="col-4">
                                <h2 class="font-weight-bold">Eventos nacionales</h2>
                                <p>Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum</p>
                            </div>
                            <div class="col-4">
                                <div class="w-75 p-1 mb-2" style="border-radius: 2.5rem; background: #001965; color: white; text-align: center;">Ver más</div>
                            </div>
                        </div>

                    </div>
                </div>
            </a>
            <!-- <div class="col-lg-6">
                <img src="<?= get_template_directory_uri() . '/assets/images/NOTICIA-01.png'; ?>" alt="Podcast">
                <div class="card-info mt-3">
                    <div class="w-75 p-2 mb-2" style="border-radius: 0.5rem; background: #001965; color: white;"><i class="fa-solid fa-newspaper mx-2"></i></i>Infografias</div>
                    <h2 class="font-weight-bold">Lorem Ipsum 1</h2>
                    <p>Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum</p>
                    <p class="time">Video | 5 min</p>
                </div>
            </div> -->
        </div>
    </div>
</div>