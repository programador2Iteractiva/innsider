<?php

/**
 * Taxonomy template Resources Interest
 *
 * @package Connexo
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


    <div class="container third-background-taxonomy mt-lg-3 mt-3 p-5">
        <div class="container banner-taxonomy-academy" data-aos="zoom-in">
            <?php if (isset($bannerCategory) && !empty($bannerCategory)) : ?>
                <img src="<?= esc_url(wp_get_attachment_url($bannerCategory)); ?>" alt="Herramientas" class="bg-taxonomy-academy">
            <?php endif; ?>
            <div class="wrapper-taxonomy-academy"></div>
        </div>
        <div class="container mt-4">
            <div class="row m-0 p-0">
                <?php if (isset($descriptioonCategory) && !empty($descriptioonCategory)) : ?>
                    <h1 class="NotoSans-Bold title-color mb-3 text-uppercase d-none d-lg-block"><?= $descriptioonCategory; ?></h1>
                    <h3 class="NotoSans-Bold title-color mb-3 mt-2 d-block d-lg-none"><?= $descriptioonCategory; ?></h3>
                <?php endif ?>
                <?php if (isset($subtitleCategory) && !empty($subtitleCategory)) : ?>
                    <h5 class="NotoSans-SemiBold description-color line-height-2 text-align-justify mb-lg-5 mb-2 d-none d-lg-block"><?= $subtitleCategory; ?></h5>
                    <p class="NotoSans-SemiBold description-color line-height-2 text-align-justify mb-lg-5 mb-2 d-block d-lg-none"><?= $subtitleCategory; ?></p>
                <?php endif ?>
            </div>
        </div>
    </div>

    <div class="container mt-lg-5 mt-3 p-0">
        <div id="linea">
            <hr>
        </div>
    </div>

    <div class="container mx-auto px-0">
        <div class="container mt-4 mx-lg-0 mx-2 px-0 pb-4">
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

                        <div class="container mt-5 mb-4">
                            <div class="row">
                                <div class="col-12 card-subcategory-academy-course background-taxonomy-card-subcategory-academy-course">
                                    <?php $thePermalink = get_the_permalink(); ?>
                                    <?php $postActivityId = get_the_ID(); ?>

                                    <a href="<?php echo get_permalink($postActivityId) . '?module_id=' . $postActivityId . '&content_id=' . $counter . '&tax=' . $taxonomy->term_id; ?>" onclick="saveLogsClick('Clic en tarjeta `<?= the_title(); ?>`');">
                                        <div class="d-flex flex-md-row flex-column position-relative justify-content-center align-items-center">
                                            <div class="col-md-4 col-lg-4" style="border-radius: 1rem;">
                                                <div class="figure">
                                                    <?php $imageSubcategoryAcademy = get_field('Img_Post_Content'); ?>

                                                    <?php if ($imageSubcategoryAcademy) :  ?>
                                                        <?php echo wp_get_attachment_image($imageSubcategoryAcademy, 'full', '', ['class' => 'img-featured-content']); ?>
                                                    <?php endif ?>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-lg-8 d-flex justify-content-center align-items-center">
                                                <div class="col-11 col-md-12 col-lg-12 p-0 m-0 pt-4 pb-4 background-text-subcategory-academy-course">
                                                    <div class="container-title-speaker-content-out mx-lg-5 ms-3">
                                                        <div class="container-content-outstanding">
                                                            <h4 class="container-title-speaker-content-outstanding">
                                                                <?= the_title(); ?>
                                                            </h4>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-11 col-lg-6 d-flex justify-content-start align-items-center mx-lg-5 ms-3">
                                                            <div class="w-50">
                                                                <div class="w-100 p-lg-2 mt-lg-3 mb-lg-2 btn-view-more">Ver más</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
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