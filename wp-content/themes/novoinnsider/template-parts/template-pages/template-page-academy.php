<?php

/**
 * Template for page Academy
 */
$category = get_queried_object();
$content = get_the_content();
?>

<div>
    <div class="container my-5 mb-0">
        <div class="row d-flex justify-content-center align-align-items-center mb-4">
            <div class="col-12 d-flex flex-lg-row">
                <h1 class="NotoSans-Bold"><?= strip_tags(the_title()); ?></h1>
                <div class="col-11 mx-1" id="linea">
                    <hr class="mx-5 px-4">
                </div>
            </div>
            <p><?= strip_tags($content); ?></p>
        </div>
    </div>
    <div class="container banner-academy">
        <?php the_post_thumbnail('', ['class' => 'bg-banner-academy']) ?>
        <div class="wrapper-banner-academy">
            <div class="container-text-banner-academy">
                <!-- <p>
                    <?php the_title(); ?>
                </p> -->
            </div>
            <h4 class="text-white mt-3"><?php the_content(); ?></h4>
            <!-- <div class="container-text-banner-academy w-100 h-100 m-auto d-flex justify-content-lg-start align-items-center">
                <img src="<?= get_template_directory_uri() . '/assets/images/Icono-innsider-white.png'; ?>" alt="Herramientas" class="bg-banner-single-category">
            </div> -->
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

    $taxonomyAcademy = novo_inssider_get_all_academies_actives();
    ?>

    <?php if(count($taxonomyAcademy) == 1) : ?>

        <div class="container align-items-center mt-5 pt-1">
            <div class="row d-flex justify-content-center align-items-center m-0 mt-4 p-0">

    <?php else : ?> 

        <div class="container d-flex justify-content-center align-items-center mt-5 pt-1">
            <div class="row d-flex justify-content-center align-items-center m-0 mt-4 p-0">

    <?php endif; ?>

                <?php if (isset($allCategoriesWithStatusActive) && !empty($allCategoriesWithStatusActive)) : ?>

                    <?php foreach ($allCategoriesWithStatusActive as $CategoriesWithStatusActive) : ?>

                        <?php $idCategoriesWithStatusActive = $CategoriesWithStatusActive->term_id; ?>

                        <?php $listCategoriesAcademy = get_terms(
                            array(
                                'taxonomy' => 'academia',
                                'hide_empty' => false,
                                'order' => 'DESC'
                            )
                        )
                        ?>

                        <?php if (isset($listCategoriesAcademy) && !empty($listCategoriesAcademy)) : ?>
                            <?php foreach ($listCategoriesAcademy as $listCategoryAcademy) : ?>
                                <?php if ($listCategoryAcademy->term_id == $idCategoriesWithStatusActive) : ?>

                                    <div class="col-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-xxxl-6 d-flex flex-column justify-content-center align-items-center container-card-category pb-5" style="border-radius: 2rem">
                                        <div class="col-12 d-flex justify-content-center align-items-center">
                                            <a href="<?= get_term_link($listCategoryAcademy->term_id)  ?>" style="text-decoration: none;">
                                                <div class="figure" style="border-radius: 2rem">
                                                    <?php $imageCategoryAcademy = get_field('Category_Image', $listCategoryAcademy); ?>
                                                    <img src="<?php echo wp_get_attachment_image_url($imageCategoryAcademy); ?>" alt="Podcast">
                                                    <h3 class="position-absolute title-slide-system class-title-card-system"><?= esc_html(the_title()) ?></h3>
                                                </div>
                                                <div class="info_description d-flex align-items-center mt-3">
                                                    <div class="d-flex flex-lg-row flex-column position-relative col-11">
                                                        <div class="col-12 col-lg-8">
                                                            <h3 class="NotoSans-Bold title-color"><?= $listCategoryAcademy->name; ?></h3>
                                                            <p class="description-color NotoSans-Regular"><?= $listCategoryAcademy->description; ?></p>
                                                        </div>
                                                        <div class="col-12 col-lg-4">
                                                            <div class="w-100 p-1 mb-2 btn-view-more">Ver más</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach ?>
                        <?php endif ?>

                    <?php endforeach; ?>

                <?php endif ?>

            </div>
        </div>

</div>