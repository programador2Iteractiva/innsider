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