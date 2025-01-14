<?php

/**
 * Taxonomy template Innsider Review
 *
 * @package Innsider
 */

$taxonomy = get_queried_object();
?>


<?php if (isset($taxonomy->term_id) && !empty($taxonomy->term_id)) : ?>

    <?php $currentTermId = $taxonomy->term_id; ?>

    <div class="container mx-2 mx-lg-auto px-0">
        <div class="container mt-lg-5 mb-lg-5 mt-4 mb-4 mx-0 px-0">
            <?php custom_breadcrumbs(); ?>
        </div>
    </div>


    <?php $descriptioonCategory = $taxonomy->description; ?>
    <?php $subtitleCategory = get_field('title_for_description_complementary', $taxonomy); ?>
    <?php $bannerCategory = get_field('Category_Image_Banner', $taxonomy); ?>
    <?php $subDescriptioonCategory = get_field('subdescription_complementary', $taxonomy); ?>


    <div class="container third-background-taxonomy mt-lg-3 mt-3 p-5">
        <div class="container banner-taxonomy-academy" data-aos="zoom-in">
            <?php if (isset($bannerCategory) && !empty($bannerCategory)) : ?>
                <img src="<?= esc_url(wp_get_attachment_url($bannerCategory)); ?>" alt="Herramientas" class="bg-taxonomy-academy">
            <?php endif; ?>
            <div class="wrapper-taxonomy-academy"></div>
        </div>
        <div class="container mt-4">
            <div class="row m-0 p-0">
            <?php if (isset($subtitleCategory) && !empty($subtitleCategory)) : ?>
                    <h2 class="NotoSans-Bold title-color text-uppercase d-none d-lg-block mx-0 p-0"><?= $subtitleCategory; ?></h2>
                    <h5 class="NotoSans-Bold title-color text-uppercase d-block d-lg-none mx-0 p-0"><?= $subtitleCategory; ?></h5>
                <?php endif ?>
                <?php if (isset($subDescriptioonCategory) && !empty($subDescriptioonCategory)) : ?>
                    <h5 class="NotoSans-SemiBold description-color line-height-2 text-align-justify d-none d-lg-block mx-0 p-0"><?= $subDescriptioonCategory; ?></h5>
                    <p class="NotoSans-SemiBold description-color line-height-2 text-align-justify d-block d-lg-none mx-0 p-0"><?= $subDescriptioonCategory; ?></p>
                <?php endif ?>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-0">
        <div class="container mt-4 mx-lg-0 px-0 pb-4">
            <div class="row m-0 mt-5 mb-4 p-0 d-flex justify-content-center align-items-start">

                <!-- Contenido de prueba -->
                <?php $idCategoriesWithStatusActive = $taxonomy->term_id; ?>

                <?php $listPostTrends = new WP_Query(
                        [
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'academia',
                                    'field' => 'id',
                                    'terms' => $idCategoriesWithStatusActive,
                                )
                            ),
                            'orderby' => 'post_date',
                            'order' => 'DESC',
                            'posts_per_page' => -1,
                            'post_status' => 'publish'
                        ]
                    );
                ?>

                <?php if ($listPostTrends->have_posts()) : ?>
                    <?php $counter = 0; ?>
                    <?php while ($listPostTrends->have_posts()) : $listPostTrends->the_post() ?>

                        <?php $postActivityId = get_the_ID(); ?>

                        <?php $ifVideoPostEvent = get_field('If_Post_Content_Module_Video', $postActivityId) ?>
                        <?php $videoPostEvent = get_field('URL_Post_Content_Module_Video', $postActivityId) ?>
                        <?php $thumbnailUrl = obtenerMiniaturaVimeo($videoPostEvent);  ?>

                        <?php if (isset($ifVideoPostEvent) && !empty($ifVideoPostEvent)) : ?>
                            <?php if (isset($videoPostEvent) && !empty($videoPostEvent)) : ?>

                                <div class="container m-0 p-0">
                                    <div class="container p-0 p-lg-2 ">
                                        <div class="">

                                            <div class="col-lg-12">
                                                <div class="row justify-content-center">
                                                    <div class="col-12 d-flex justify-content-center mt-5 mb-5 flex-column">
                                                        <div class="container banner-single preview-video"
                                                            onclick="playVideo(1, '<?= $videoPostEvent ?>', event, 'preview-video')">
                                                            <?php if (isset($thumbnailUrl) && !empty($thumbnailUrl)) : ?>
                                                                <img src="<?= esc_url($thumbnailUrl); ?>" alt="Herramientas" class="bg-single">
                                                            <?php elseif (isset($bannerContentModule) && !empty($bannerContentModule)) : ?>
                                                                <img src="<?= esc_url(wp_get_attachment_url($bannerContentModule)); ?>" alt="Herramientas" class="bg-single">
                                                            <?php endif; ?>

                                                            <i class="fas fa-play icon-play-video"></i>

                                                            <div class="wrapper-single p-0"></div>
                                                        </div>

                                                        <div class="player-video player-video-taxonomy banner-single " id="player"></div>

                                                    </div>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>

                            <?php endif; ?>
                        <?php endif; ?>

                    <?php $counter++; ?>
                    <?php endwhile; ?>
                <?php endif ?>
                <!-- Fin contenido de prueba -->

            </div>
        </div>
    </div>

    <?php $codePromomats = get_field('description_complementary', $taxonomy) ?>

    <div class="container m-lg-5 mx-lg-auto m-3 px-0">
        <?php if (isset($codePromomats) && !empty($codePromomats)) : ?>
            <h5 class="NotoSans-Bold title-color"><?= $codePromomats; ?></h5>
        <?php endif ?>
    </div>

    <div class="col-12 border p-5 mb-5 background-section-logo-innsider">
        <div class="col-12 d-flex justify-content-center align-items-center p-4">
            <?php if (has_custom_logo()) : ?>
                <?php the_custom_logo(); ?>
            <?php endif; ?>
        </div>
    </div>



<?php endif; ?>