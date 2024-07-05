<?php

/**
 * Template for page Home
 */
?>

<div class="banner position-relative">
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">

            <?php $list_banner = new WP_Query(array('post_type' => 'Banner', 'posts_per_page' => -1, 'order' => 'ASC')); ?>

            <?php if ($list_banner->have_posts()) : ?>

                <?php $key = 0; ?>

                <?php while ($list_banner->have_posts()) : $list_banner->the_post(); ?>

                    <?php $link_banner_speaker = '#'; ?>

                    <?php if (has_post_thumbnail()) : ?>

                        <div class="swiper-slide <?php if ($key == 0) {
                                                        echo "active";
                                                    } ?>">
                            <?php echo the_post_thumbnail('', ['class' => 'banner-image-all-speakers']); ?>
                        </div>

                    <?php endif; ?>

                    <?php $key++; ?>

                <?php endwhile; ?>

            <?php endif; ?>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </div>
</div>
<div>
    <div class="container my-5">
        <div class="row d-flex justify-content-center align-align-items-center mb-4">
            <div class="col-12 d-flex flex-lg-row">
                <h1 class="title">HERRAMIENTAS INNSIDER</h1>
                <div class="col-9 mx-1" id="linea">
                    <hr>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-12 col-11 banner-category">
                <div class="d-flex align-items-center justify-content-lg-end justify-content-center h-100">
                    <img src="<?= get_template_directory_uri() . '/assets/images/Fondo1.svg';  ?>" alt="Herramientas" class="bg-banner-single-category">
                    <div class="mx-2 px-1 mx-lg-2 px-lg-2 mx-xl-5 px-xl-5 text-center test1">
                        <h2>Conozca más sobre herramientas</h2>
                        <p>que le permitirán tomar decisiones basadas en datos</p>
                        <div class="button-group">
                            <button class="btn btn-outline-primary">Calculadoras de salud</button>
                            <button class="btn btn-outline-primary">Simulador de modelo</button>
                            <button class="btn btn-outline-primary">Simulador de cobertura</button>
                        </div>
                        <div class="button-group mt-3">
                            <button class="btn btn-primary">Registro</button>
                            <button class="btn btn-secondary">Inicio</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row d-flex justify-content-center align-align-items-center mb-4">
            <div class="col-12 d-flex flex-lg-row">
                <h1 class="title">Actualidad en Salud</h1>
                <div class="col-9 mx-1" id="linea">
                    <hr>
                </div>
            </div>
        </div>
        <div class="content d-flex justify-content-center flex-lg-row flex-column">
            <div class="card large d-flex flex-column">
                <img src="<?= get_template_directory_uri() . '/assets/images/Fondo1.svg'; ?>" alt="Podcast">
                <div class="card-info mt-3">
                    <h2>Banner PodCast Innsider</h2>
                    <p>Paciente con dificultad en la marcha</p>
                    <p class="time">Video | 5 min</p>
                </div>
            </div>
            <div class="card">
                <img src="<?= get_template_directory_uri() . '/assets/images/Fondo1.svg'; ?>" alt="Podcast">
                <div class="card-info mt-3">
                    <div class="w-75 p-2 mb-2" style="border-radius: 0.5rem; background: blue; color: white;"><i class="fa-solid fa-power-off mx-2"></i>Infografias</div>
                    <h2>Lorem Ipsum 1</h2>
                    <p>Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum</p>
                    <p class="time">Video | 5 min</p>
                </div>
            </div>
            <div class="card">
                <img src="<?= get_template_directory_uri() . '/assets/images/Fondo1.svg'; ?>" alt="Podcast">
                <div class="card-info mt-3">
                    <div class="w-75 p-2 mb-2" style="border-radius: 0.5rem; background: blue; color: white;"><i class="fa-solid fa-power-off mx-2"></i>Infografias</div>
                    <h2>Lorem Ipsum 2</h2>
                    <p>Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum</p>
                    <p class="time">Video | 5 min</p>
                </div>
            </div>
            <div class="card">
                <img src="<?= get_template_directory_uri() . '/assets/images/Fondo1.svg'; ?>" alt="Podcast">
                <div class="card-info mt-3">
                    <div class="w-75 p-2 mb-2" style="border-radius: 0.5rem; background: blue; color: white;"><i class="fa-solid fa-power-off mx-2"></i>Infografias</div>
                    <h2>Lorem Ipsum 3</h2>
                    <p>Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum</p>
                    <p class="time">Video | 5 min</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container my-5">
        <div class="row d-flex justify-content-center align-align-items-center mb-4">
            <div class="col-12 d-flex flex-lg-row">
                <h1 class="title">HERRAMIENTAS INNSIDER</h1>
                <div class="col-9 mx-1" id="linea">
                    <hr>
                </div>
            </div>
        </div>
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-lg-12 col-11 second-banner-category">
                <div class="d-flex align-items-center justify-content-lg-end justify-content-center h-100">
                    <img src="<?= get_template_directory_uri() . '/assets/images/BannerHome.jpg';  ?>" alt="Herramientas" class="bg-banner-single-category">
                </div>
            </div>
        </div>
    </div>
</div>