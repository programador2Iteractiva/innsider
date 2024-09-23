<?php

/**
 * Template for page Academy
 */
$category = get_queried_object();
$content = get_the_content();
$page_id = get_queried_object_id();
$page_url = get_permalink($page_id);
$page_title = 'Home';
$home_id = get_option('page_on_front');
$pageHome = get_permalink($home_id);
?>

<div>
    <!-- <div class="container my-5 mb-0">
        <div class="row d-flex justify-content-center align-align-items-center mb-4">
            <div class="col-12 d-flex flex-lg-row">
                <h1 class="NotoSans-Bold"><?= strip_tags(the_title()); ?></h1>
                <div class="col-11 mx-1" id="linea">
                    <hr class="mx-5 px-4">
                </div>
            </div>
            <p><?= strip_tags($content); ?></p>
        </div>
    </div> -->

    <div class="container mx-2 mx-lg-auto px-0 ">
        <div class="container mt-lg-5 mb-lg-5 mt-4 mb-4 mx-0 px-0">
            <nav class="breadcrumbs">
                <a style="text-decoration:none !important" href="<?php echo $pageHome; ?>">
                    Inicio
                </a>
                /
                <a style="text-decoration:none !important" href="<?php echo $page_url; ?>">
                    <?php the_title(); ?>
                </a>
            </nav>
        </div>
    </div>

    <div class="container banner-academy" data-aos="zoom-in">
        <?php the_post_thumbnail('', ['class' => 'bg-banner-academy']) ?>
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

    $taxonomyAcademy = novo_inssider_get_all_academies_actives();
    ?>

    <?php if (count($taxonomyAcademy) == 1) : ?>

        <div class="container align-items-center mt-5 pt-1">
            <div class="row d-flex justify-content-start align-items-center m-0 mt-4 p-0">

            <?php else : ?>

                <div class="container mt-5 pt-1">
                    <div class="row d-flex justify-content-between align-items-start m-0 p-0">

                    <?php endif; ?>

                    <?php if (isset($allCategoriesWithStatusActive) && !empty($allCategoriesWithStatusActive)) : ?>

                        <?php foreach ($allCategoriesWithStatusActive as $CategoriesWithStatusActive) : ?>

                            <?php $idCategoriesWithStatusActive = $CategoriesWithStatusActive->term_id; ?>

                            <?php $listCategoriesAcademy = get_terms(
                                array(
                                    'taxonomy' => 'academia',
                                    'hide_empty' => false,
                                    'orderby' => 'id',
                                    'order' => 'ASC',
                                    'hierarchical' => true
                                )
                            )
                            ?>

                            <?php if (isset($listCategoriesAcademy) && !empty($listCategoriesAcademy)) : ?>
                                <?php $counter = 0; ?>
                                <?php foreach ($listCategoriesAcademy as $listCategoryAcademy) : ?>

                                    <?php if ($listCategoryAcademy->term_id == $idCategoriesWithStatusActive && $listCategoryAcademy->parent == 0) : ?>

                                        <?php $catId = $listCategoryAcademy->term_id ?>

                                        <?php $ContentRegisterAcademy = get_term_meta($catId, 'Content_Register_Academy', true); ?>
                                        <?php $urlCatRedirect = get_term_link($listCategoryAcademy->term_id); ?>

                                        <?php if($ContentRegisterAcademy === '1') : ?> 

                                            <?php if(!is_user_logged_in()) : ?>

                                                <?php $login_url = wp_login_url($urlCatRedirect); ?>
                                                <?php $linkCatRedirect = $login_url; ?>

                                            <?php else : ?> 

                                                <?php $linkCatRedirect = $urlCatRedirect; ?>

                                            <?php endif ?>

                                        <?php else : ?>    

                                            <?php $linkCatRedirect = $urlCatRedirect; ?>

                                        <?php endif; ?>

                                        <div class="col-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-xxxl-6 d-flex flex-column justify-content-center align-items-center card-category-academy m-0 p-0 mt-3 mb-3 pb-3 ">

                                            <a href="<?= $linkCatRedirect; ?>" onclick="saveLogsClick('Clic en tarjeta `<?= $listCategoryAcademy->name ?>`');"  class="w-100">
                                                <div class="<?= ($counter % 2 === 0) ? 'd-flex justify-content-center align-items-lg-start align-items-center flex-column' : 'd-flex justify-content-center align-items-lg-end align-items-center flex-column'; ?>">
                                                    <div class="col-10 col-lg-11">
                                                        <div class="mb-4 figure">
                                                            <?php $imageCategoryAcademy = get_field('Category_Image', $listCategoryAcademy); ?>

                                                            <?php if ($imageCategoryAcademy) :  ?>
                                                                <?php echo wp_get_attachment_image($imageCategoryAcademy, 'full', '', ['style' => 'object-fit: fill']); ?>
                                                            <?php endif ?>
                                                        </div>
                                                        <div class="col-12 d-flex w-100">
                                                            <div class="col-12 d-flex">
                                                                <div class="col h-100">
                                                                    <div class="d-flex justify-content-start align-items-start flex-column">
                                                                        <h4 class="NotoSans-Bold title-color"><?= $listCategoryAcademy->name; ?></h4>
                                                                        <p class="description-color NotoSans-Regular"><?= $listCategoryAcademy->description; ?></p>
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

                        <div class="container m-lg-5 mx-lg-auto m-3 px-0">
                            <h5 class="NotoSans-Bold title-color"><?= the_content(); ?></h5>
                        </div>

                    <?php endif ?>

                    </div>
                </div>

            </div>