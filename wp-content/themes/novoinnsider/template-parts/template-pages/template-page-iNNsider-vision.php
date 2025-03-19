<?php

/**
 * Template for page iNNsider Vision
 */
$page_id = get_queried_object_id();
$category = get_queried_object();
$content = get_the_content();
?>

<div class="container mx-2 mx-lg-auto px-0">
    <div class="container mt-lg-5 mb-lg-5 mt-4 mb-4 mx-0 px-0">
        <?php custom_breadcrumbs(); ?>
    </div>
</div>

<div>

    <?php $bannerPage = get_field('Page_Image_Banner', $page_id); ?>
    <?php $bannerPageMovil = get_field('Page_Image_Banner_Movil', $page_id); ?>

    <div class="container banner-academy d-none d-lg-block" data-aos="zoom-in">
        <?php if (isset($bannerPage) && !empty($bannerPage)) : ?>
            <img src="<?= esc_url(wp_get_attachment_url($bannerPage)); ?>" alt="Banner-Academy" class="bg-banner-academy">
        <?php endif ?>
        <div class="wrapper-banner-academy">
        </div>
    </div>

    <div class="container banner-academy d-block d-lg-none" data-aos="zoom-in">
        <?php if (isset($bannerPageMovil) && !empty($bannerPageMovil)) : ?>
            <img src="<?= esc_url(wp_get_attachment_url($bannerPageMovil)); ?>" alt="Banner-Academy" class="bg-banner-academy">
        <?php endif ?>
        <div class="wrapper-banner-academy">
        </div>
    </div>

    <?php
    /* Consulta en base de datos que valida si la categoria cuenta con status activo, es decir si el campo True/False tiene
        check mostrara el conteido, de lo contrario lo ocultara  */

    global $wpdb;

    $tableTermmeta = $wpdb->prefix . 'termmeta';

    $metaKey = 'Status_Categories';
    $metaValue = '1';

    $allData = $wpdb->prepare("SELECT *  FROM {$tableTermmeta} WHERE `meta_key` = '{$metaKey}' AND `meta_VALUE` = '{$metaValue}'");

    $allCategoriesWithStatusActive = $wpdb->get_results($wpdb->prepare($allData));

    $taxonomyVisionInnsiderCategory = novo_inssider_get_all_visioninnsider_category_actives();
    ?>

    <?php if (count($taxonomyVisionInnsiderCategory) == 1) : ?>

        <div class="container align-items-center mt-5 pt-1">
            <div class="row d-flex justify-content-center align-items-center m-0 mt-4 p-0">

            <?php else : ?>

                <div class="container d-flex justify-content-center align-items-center mt-5 pt-1">
                    <div class="row d-flex justify-content-center align-items-start m-0 mt-4 p-0">

                    <?php endif; ?>

                    <?php if (isset($allCategoriesWithStatusActive) && !empty($allCategoriesWithStatusActive)) : ?>

                        <?php foreach ($allCategoriesWithStatusActive as $CategoriesWithStatusActive) : ?>

                            <?php $idCategoriesWithStatusActive = $CategoriesWithStatusActive->term_id; ?>

                            <?php $listCategoriesVisionInnsider = get_terms(
                                array(
                                    'taxonomy' => 'visioninnsider-category',
                                    'hide_empty' => false,
                                    'order' => 'ASC'
                                )
                            )
                            ?>

                            <?php if (isset($listCategoriesVisionInnsider) && !empty($listCategoriesVisionInnsider)) : ?>
                                <?php $counter = 0; ?>
                                <?php foreach ($listCategoriesVisionInnsider as $listCategoryVision) : ?>

                                    <?php if ($listCategoryVision->term_id == $idCategoriesWithStatusActive) : ?>

                                        <div class="col-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-xxxl-6 d-flex flex-column justify-content-center align-items-center card-category-academy m-0 p-0 mt-3 mb-3 pb-3 ">
                                            <a href="<?= get_term_link($listCategoryVision->term_id); ?>" class="w-100" onclick="saveLogsClick('Clic en tarjeta `<?= $listCategoryVision->name; ?>`');">
                                                <div class="<?= ($counter % 2 === 0) ? 'd-flex justify-content-center align-items-lg-start align-items-center flex-column' : 'd-flex justify-content-center align-items-lg-end align-items-center flex-column'; ?>">
                                                    <div class="col-10 col-lg-11">
                                                        <div class="mb-4 figure">
                                                            <?php $imageCategoryVision = get_field('Category_Image', $listCategoryVision); ?>

                                                            <?php if ($imageCategoryVision) :  ?>
                                                                <?php echo wp_get_attachment_image($imageCategoryVision, 'full', '', ['style' => 'object-fit: fill']); ?>
                                                            <?php endif ?>
                                                        </div>
                                                        <div class="col-12 d-flex w-100">
                                                            <div class="col-12 d-flex">
                                                                <div class="col h-100">
                                                                    <div class="d-flex justify-content-start align-items-start flex-column">
                                                                        <h4 class="NotoSans-Bold title-color"><?= $listCategoryVision->name; ?></h4>
                                                                        <p class="description-color NotoSans-Regular"><?= $listCategoryVision->description; ?></p>
                                                                    </div>
                                                                </div>
                                                                <div class="col d-flex justify-content-center align-items-start">
                                                                    <div class="w-75">
                                                                        <div class="w-100 p-2 mb-2 btn-view-more">Ver más</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>

                                    <?php endif; ?>

                                    <?php $counter++; ?>
                                <?php endforeach ?>
                            <?php endif ?>

                        <?php endforeach; ?>

                    <?php endif ?>

                    </div>
                </div>

            </div>