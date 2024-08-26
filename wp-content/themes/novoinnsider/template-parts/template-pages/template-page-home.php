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
                            <?php $urlBanner = get_field('btn_banner'); ?>

                            <?php if($urlBanner) : ?>
                                <a href="<?= $urlBanner; ?>" target="_blank">
                                    <?php echo the_post_thumbnail('', ['class' => 'banner-image-all-speakers']); ?>
                                </a>
                            <?php else: ?>
                                <?php echo the_post_thumbnail('', ['class' => 'banner-image-all-speakers']); ?>
                            <?php endif; ?>                        

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
        <?php $test = novo_innsider_check_menu_items_with_class(); ?>
        <?php if($test) : ?>
            <?php echo $test; ?>
        <?php endif; ?>                        
    </div>
    <div class="container">
        <div class="row d-flex justify-content-center align-align-items-center mb-4">
            <div class="col-12 d-flex flex-lg-row">
                <h1 class="title">ACTUALIDAD EN SALUD</h1>
                <div class="col-9 mx-1" id="linea">
                    <hr>
                </div>
            </div>
        </div>
        <div class="content d-flex justify-content-center flex-lg-row flex-column">
            <div class="card large d-flex flex-column">
                <img src="<?= get_template_directory_uri() . '/assets/images/Component5.png'; ?>" alt="Podcast">
                <div class="card-info mt-3">
                    <h2 class="font-weight-bold">Visión Innsider</h2>
                    <p>Podcast</p>
                    <p class="time">Video | 5 min</p>
                </div>
            </div>
            <div class="card">
                <img src="<?= get_template_directory_uri() . '/assets/images/NOTICIA-01.png'; ?>" alt="Podcast">
                <div class="card-info mt-3">
                    <div class="w-75 p-2 mb-2" style="border-radius: 0.5rem; background: #001965; color: white;"><i class="fa-solid fa-newspaper mx-2"></i></i>Infografias</div>
                    <h2 class="font-weight-bold">Tendencias</h2>
                    <p>Circular 19: Regulación de precios</p>
                    <p class="time">Video | 5 min</p>
                </div>
            </div>
            <div class="card">
                <img src="<?= get_template_directory_uri() . '/assets/images/NOTICIA-02.png'; ?>" alt="Podcast">
                <div class="card-info mt-3">
                    <div class="w-75 p-2 mb-2" style="border-radius: 0.5rem; background: #001965; color: white;"><i class="fa-regular fa-circle-play mx-2"></i></i>Artículos</div>
                    <h2 class="font-weight-bold">Cursos de formación</h2>
                    <p>Curso multidisciplinario en gestión de la atención en hemofilia</p>
                    <p class="time">Video | 5 min</p>
                </div>
            </div>
            <div class="card">
                <img src="<?= get_template_directory_uri() . '/assets/images/NOTICIA-03.png'; ?>" alt="Podcast">
                <div class="card-info mt-3">
                    <div class="w-75 p-2 mb-2" style="border-radius: 0.5rem; background: #001965; color: white;"><i class="fa-solid fa-newspaper mx-2"></i>Videos</div>
                    <h2 class="font-weight-bold">Recursos de interés</h2>
                    <p>Webinar sobre el impacto socieconómico de las enfermedades en América Latina</p>
                    <p class="time">Video | 5 min</p>
                </div>
            </div>
        </div>
    </div>
    <div class="container my-5">
        <div class="row d-flex justify-content-center align-align-items-center mb-4">
            <div class="col-12 d-flex flex-lg-row">
                <!-- <h1 class="title">HERRAMIENTAS INNSIDER</h1> -->
                <div class="col-12 mx-1" id="linea">
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