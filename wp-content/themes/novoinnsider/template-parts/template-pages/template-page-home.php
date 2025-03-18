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
                    <?php $urlBanner = get_field('btn_banner'); ?>
                    <?php $bannerImage = get_field('img_banner'); ?>
                    <?php $bannerImageMovil = get_field('img_banner_movil'); ?>

                    <?php if ($bannerImage) : ?>
                        <div class="swiper-slide <?php if ($key == 0) {
                                                        echo "active";
                                                    } ?> d-none d-lg-block">

                            <?php if ($urlBanner) : ?>
                                <a href="<?= $urlBanner; ?>" target="_blank">
                                    <img src="<?= esc_url(wp_get_attachment_url($bannerImage)); ?>" alt="Herramientas" class="banner-image-all-speakers">
                                </a>
                            <?php else: ?>
                                <img src="<?= esc_url(wp_get_attachment_url($bannerImage)); ?>" alt="Herramientas" class="banner-image-all-speakers">
                            <?php endif; ?>

                        </div>
                    <?php endif ?>

                    <?php $key++; ?>

                <?php endwhile; ?>

            <?php endif; ?>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-pagination"></div>
    </div>
</div>

<div class="banner position-relative">
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">

            <?php $list_banner = new WP_Query(array('post_type' => 'Banner', 'posts_per_page' => -1, 'order' => 'ASC')); ?>

            <?php if ($list_banner->have_posts()) : ?>

                <?php $key = 0; ?>

                <?php while ($list_banner->have_posts()) : $list_banner->the_post(); ?>

                    <?php $link_banner_speaker = '#'; ?>
                    <?php $urlBanner = get_field('btn_banner'); ?>
                    <?php $bannerImage = get_field('img_banner'); ?>
                    <?php $bannerImageMovil = get_field('img_banner_movil'); ?>

                    <?php if ($bannerImageMovil) : ?>
                        <div class="swiper-slide <?php if ($key == 0) {
                                                        echo "active";
                                                    } ?> d-block d-lg-none">

                            <?php if ($urlBanner) : ?>
                                <a href="<?= $urlBanner; ?>" target="_blank">
                                    <img src="<?= esc_url(wp_get_attachment_url($bannerImageMovil)); ?>" alt="Herramientas" class="banner-image-all-speakers">
                                </a>
                            <?php else: ?>
                                <img src="<?= esc_url(wp_get_attachment_url($bannerImageMovil)); ?>" alt="Herramientas" class="banner-image-all-speakers">
                            <?php endif; ?>

                        </div>
                    <?php endif ?>

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
        <?php if ($test) : ?>
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
        <div class="content d-flex justify-content-center align-items-center align-items-sm-center align-items-lg-start flex-lg-row flex-column">

            <?php $listNewsHealth = new WP_Query(array('post_type' => 'Actualidad en salud', 'posts_per_page' => -1, 'order' => 'ASC')); ?>

            <?php if ($listNewsHealth->have_posts()) : ?>

                <?php $key = 0; ?>

                <?php while ($listNewsHealth->have_posts()) : $listNewsHealth->the_post(); ?>

                    <?php $Image_Card_News_Health = get_field('Image_Card_News_Health'); ?>
                    <?php $Ico_Button_Card_News_Health = get_field('Ico_Button_Card_News_Health'); ?>
                    <?php $Title_Button_Card_News_Health = get_field('Title_Button_Card_News_Health'); ?>
                    <?php $Subtitle_Card_News_Health = get_field('Subtitle_Card_News_Health'); ?>
                    <?php $Type_Card_News_Health = get_field('Type_Card_News_Health'); ?>
                    <?php $Url_Redirect_Card_News_Health = get_field('Url_Redirect_Card_News_Health'); ?>
                    <?php $postId = get_the_ID(); ?>
                    <?php $Content_Register = get_post_meta($postId, 'Content_Register', true); ?>

                    <?php if ($Content_Register === '1') : ?>

                        <?php if (!is_user_logged_in()) : ?>

                            <?php $login_url = wp_login_url($Url_Redirect_Card_News_Health); ?>
                            <?php $link = $login_url; ?>

                        <?php else : ?>

                            <?php $link = $Url_Redirect_Card_News_Health; ?>

                        <?php endif ?>

                    <?php else : ?>

                        <?php $link = $Url_Redirect_Card_News_Health; ?>

                    <?php endif; ?>

                    <?php if ($key == 0) : ?>

                        <div class="col-8 col-sm-8 card large d-flex flex-column">

                            <?php if ($Url_Redirect_Card_News_Health) : ?>

                                <a href="<?= $link ?>" target="_blank" onclick="saveLogsClick('Clic en tarjeta, actualidad en salud  `<?php the_title(); ?>`');">

                                    <?php if (isset($Image_Card_News_Health) && !empty($Image_Card_News_Health)) : ?>
                                        <?php echo wp_get_attachment_image($Image_Card_News_Health, 'full', '', ['class' => 'other-image-card-news-health']); ?>
                                    <?php endif ?>

                                    <div class="card-info mt-3">

                                        <?php if (isset($Title_Button_Card_News_Health) && !empty($Title_Button_Card_News_Health)) : ?>
                                            <div class="w-100 p-2 mb-2 btn-card-News_Health">

                                                <?php if (isset($Ico_Button_Card_News_Health) && !empty($Ico_Button_Card_News_Health)) : ?>
                                                    <?php echo wp_get_attachment_image($Ico_Button_Card_News_Health, 'full', '', ['class' => 'icon-button-card-news-health']) ?>
                                                <?php endif ?>

                                                <?= $Title_Button_Card_News_Health; ?>
                                            </div>
                                        <?php endif; ?>

                                        <h2 class="font-weight-bold"><?php the_title(); ?></h2>

                                        <?php if (isset($Subtitle_Card_News_Health) && !empty($Subtitle_Card_News_Health)) : ?>
                                            <p><?= $Subtitle_Card_News_Health; ?></p>
                                        <?php endif; ?>

                                        <?php if (isset($Type_Card_News_Health) && !empty($Type_Card_News_Health)) : ?>
                                            <p class="time"><?= $Type_Card_News_Health; ?></p>
                                        <?php endif ?>

                                    </div>

                                </a>

                            <?php else : ?>

                                <?php if (isset($Image_Card_News_Health) && !empty($Image_Card_News_Health)) : ?>
                                    <?php echo wp_get_attachment_image($Image_Card_News_Health, 'full', '', ['style' => 'object-fit: fill']) ?>
                                <?php endif ?>

                                <div class="card-info mt-3">

                                    <?php if (isset($Title_Button_Card_News_Health) && !empty($Title_Button_Card_News_Health)) : ?>
                                        <div class="w-100 p-2 mb-2 btn-card-News_Health">

                                            <?php if (isset($Ico_Button_Card_News_Health) && !empty($Ico_Button_Card_News_Health)) : ?>
                                                <?php echo wp_get_attachment_image($Ico_Button_Card_News_Health, 'full', '', ['class' => 'icon-button-card-news-health']) ?>
                                            <?php endif ?>

                                            <?= $Title_Button_Card_News_Health; ?>
                                        </div>
                                    <?php endif; ?>

                                    <h2 class="font-weight-bold"><?php the_title(); ?></h2>

                                    <?php if (isset($Subtitle_Card_News_Health) && !empty($Subtitle_Card_News_Health)) : ?>
                                        <p><?= $Subtitle_Card_News_Health; ?></p>
                                    <?php endif; ?>

                                    <?php if (isset($Type_Card_News_Health) && !empty($Type_Card_News_Health)) : ?>
                                        <p class="time"><?= $Type_Card_News_Health; ?></p>
                                    <?php endif ?>

                                </div>

                            <?php endif; ?>

                        </div>

                    <?php else : ?>

                        <div class="col-8 col-sm-8 card">

                            <?php if ($Url_Redirect_Card_News_Health) : ?>

                                <a href="<?= $link ?>" target="_blank" onclick="saveLogsClick('Clic en tarjeta, actualidad en salud  `<?php the_title(); ?>`');">

                                    <?php if (isset($Image_Card_News_Health) && !empty($Image_Card_News_Health)) : ?>
                                        <?php echo wp_get_attachment_image($Image_Card_News_Health, 'full', '', ['class' => 'image-card-news-health']); ?>
                                    <?php endif ?>

                                    <div class="card-info mt-3 p-0">

                                        <?php if (isset($Title_Button_Card_News_Health) && !empty($Title_Button_Card_News_Health)) : ?>
                                            <div class="w-100 p-2 mb-2 btn-card-News_Health">

                                                <?php if (isset($Ico_Button_Card_News_Health) && !empty($Ico_Button_Card_News_Health)) : ?>
                                                    <?php echo wp_get_attachment_image($Ico_Button_Card_News_Health, 'full', '', ['class' => 'icon-button-card-news-health']) ?>
                                                <?php endif ?>

                                                <?= $Title_Button_Card_News_Health; ?>
                                            </div>
                                        <?php endif; ?>

                                        <h2 class="font-weight-bold"><?php the_title(); ?></h2>

                                        <?php if (isset($Subtitle_Card_News_Health) && !empty($Subtitle_Card_News_Health)) : ?>
                                            <p><?= $Subtitle_Card_News_Health; ?></p>
                                        <?php endif; ?>

                                        <?php if (isset($Type_Card_News_Health) && !empty($Type_Card_News_Health)) : ?>
                                            <p class="time"><?= $Type_Card_News_Health; ?></p>
                                        <?php endif ?>

                                    </div>

                                </a>

                            <?php else : ?>

                                <?php if (isset($Image_Card_News_Health) && !empty($Image_Card_News_Health)) : ?>
                                    <?php echo wp_get_attachment_image($Image_Card_News_Health, 'full', '', ['class' => 'image-card-news-health']) ?>
                                <?php endif ?>

                                <div class="card-info mt-3 p-0">

                                    <?php if (isset($Title_Button_Card_News_Health) && !empty($Title_Button_Card_News_Health)) : ?>
                                        <div class="w-100 p-2 mb-2 btn-card-News_Health">

                                            <?php if (isset($Ico_Button_Card_News_Health) && !empty($Ico_Button_Card_News_Health)) : ?>
                                                <?php echo wp_get_attachment_image($Ico_Button_Card_News_Health, 'full', '', ['class' => 'icon-button-card-news-health']) ?>
                                            <?php endif ?>

                                            <?= $Title_Button_Card_News_Health; ?>
                                        </div>
                                    <?php endif; ?>

                                    <h2 class="font-weight-bold"><?php the_title(); ?></h2>

                                    <?php if (isset($Subtitle_Card_News_Health) && !empty($Subtitle_Card_News_Health)) : ?>
                                        <p><?= $Subtitle_Card_News_Health; ?></p>
                                    <?php endif; ?>

                                    <?php if (isset($Type_Card_News_Health) && !empty($Type_Card_News_Health)) : ?>
                                        <p class="time"><?= $Type_Card_News_Health; ?></p>
                                    <?php endif ?>

                                </div>

                            <?php endif; ?>

                        </div>

                    <?php endif ?>

                    <?php $key++; ?>

                <?php endwhile; ?>

            <?php endif; ?>

        </div>
    </div>

    <?php $listCards = new WP_Query(array('post_type' => 'tarjeta', 'posts_per_page' => -1, 'order' => 'ASC')); ?>

    <?php if ($listCards->have_posts()) : ?>

        <div class="container">

            <div class="row d-flex justify-content-center align-align-items-center mb-4">
                <div class="col-12 d-flex flex-lg-row">
                    <div class="col-12 mx-1 mt-3" id="linea">
                        <hr>
                    </div>
                </div>
            </div>
            <div class="row m-0 p-0">
                <?php $key = 0; ?>

                <div class="col-12 d-flex justify-content-around align-items-center flex-lg-row flex-column">

                    <?php while ($listCards->have_posts()) : $listCards->the_post(); ?>

                        <?php $urlCard = get_field('url_card'); ?>
                        <?php $imageCard = get_field('image_card'); ?>

                        <div class="col-12 col-lg-5 border mt-3 mb-3 mx-5" style="border-radius: 0.5rem">
                            <div class="row">
                                <a href=" <?= $urlCard ?>" target="_blank" class="h-100 w-100">
                                    <?= wp_get_attachment_image($imageCard, 'full', '', ['class' => 'image-height-card']); ?>
                                </a>
                            </div>
                        </div>

                        <?php $key++; ?>
                        <?php if ($key % 2 == 0 && $key < $listCards->post_count) : ?>
                </div>
                <div class="row m-0 p-0 d-flex justify-content-around align-items-start flex-lg-row flex-column">
                <?php endif; ?>

            <?php endwhile; ?>

                </div>
            </div>

        </div>
    <?php endif; ?>

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
                <?php $current_url = home_url(add_query_arg(array(), $_SERVER['REQUEST_URI'])); ?>
                <a href="<?= $current_url ?>/registro/">
                    <div class="d-flex align-items-center justify-content-lg-end justify-content-center h-100">
                        <img src="<?= get_template_directory_uri() . '/assets/images/BannerHome.jpg';  ?>" alt="Herramientas" class="bg-banner-single-category">
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>