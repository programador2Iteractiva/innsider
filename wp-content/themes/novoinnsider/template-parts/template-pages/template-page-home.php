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
        <div class="row">
            <div class="col-12">
                <h1 class="title">HERRAMIENTAS INNSIDER</h1>
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
        <h1>Actualidad en Salud</h1>
        <div class="content">
            <div class="card large d-flex flex-column">
                <img src="<?= get_template_directory_uri() . '/assets/images/Fondo1.svg';?>" alt="Podcast">
                <div class="card-info">
                    <h2>Banner PodCast Innsider</h2>
                    <p>Paciente con dificultad en la marcha</p>
                    <p class="time">Video | 5 min</p>
                </div>
            </div>
            <div class="card">
                <img src="<?= get_template_directory_uri() . '/assets/images/Fondo1.svg';?>" alt="Podcast">
                <div class="card-info">
                    <div class="w-75 p-2 mb-2" style="border-radius: 0.5rem; background: blue; color: white;"><i class="fa-solid fa-power-off mx-2"></i>Infografias</div>
                    <h2>Lorem Ipsum 1</h2>
                    <p>Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum</p>
                    <p class="time">Video | 5 min</p>
                </div>
            </div>
            <div class="card">
                <img src="<?= get_template_directory_uri() . '/assets/images/Fondo1.svg';?>" alt="Podcast">
                <div class="card-info">
                    <div class="w-75 p-2 mb-2" style="border-radius: 0.5rem; background: blue; color: white;"><i class="fa-solid fa-power-off mx-2"></i>Infografias</div>
                    <h2>Lorem Ipsum 2</h2>
                    <p>Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum</p>
                    <p class="time">Video | 5 min</p>
                </div>
            </div>
            <div class="card">
                <img src="<?= get_template_directory_uri() . '/assets/images/Fondo1.svg';?>" alt="Podcast">
                <div class="card-info">
                    <div class="w-75 p-2 mb-2" style="border-radius: 0.5rem; background: blue; color: white;"><i class="fa-solid fa-power-off mx-2"></i>Infografias</div>
                    <h2>Lorem Ipsum 3</h2>
                    <p>Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum</p>
                    <p class="time">Video | 5 min</p>
                </div>
            </div>
        </div>
    </div>
    <section class="tools">
        <h2>Herramientas INNSIDER</h2>
        <div class="tools-content">
        <img src="<?= get_template_directory_uri() . '/assets/images/Fondo1.png';  ?>" class="backimage" alt="Herramientas">
            <p>Conozca más sobre herramientas que le permitirán tomar decisiones basadas en datos.</p>
            <div class="tools-buttons">
                <a href="#" class="btn">Calculadoras de salud</a>
                <a href="#" class="btn">Simulador de modelo</a>
                <a href="#" class="btn">Simulador de cobertura</a>
            </div>
            <div class="tools-auth">
                <a href="#" class="btn">Registro</a>
                <a href="#" class="btn">Inicio</a>
            </div>
        </div>
    </section>
    <section class="news">
        <h2>Actualidad en Salud</h2>
        <div class="news-items">
            <div class="news-item">
                <img src="news1.png" alt="Podcast">
                <h3>Banner Podcast Innsider</h3>
                <p>Paciente con dificultad en la marcha</p>
                <span>Video | 5 min</span>
            </div>
            <div class="news-item">
                <img src="news2.png" alt="Artículo">
                <h3>Lorem Ipsum 1</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <span>Video | 5 min</span>
            </div>
            <div class="news-item">
                <img src="news3.png" alt="Video">
                <h3>Lorem Ipsum 2</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <span>Video | 5 min</span>
            </div>
            <div class="news-item">
                <img src="news4.png" alt="Infografía">
                <h3>Lorem Ipsum 3</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <span>Video | 5 min</span>
            </div>
        </div>
    </section>
    <section class="newsletter">
        <h2>Newsletter</h2>
        <p>INNSIDER Novo Nordisk</p>
        <a href="#" class="btn">Suscripción</a>
    </section>
</div>