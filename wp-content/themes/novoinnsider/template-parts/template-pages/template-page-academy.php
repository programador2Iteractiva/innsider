<?php

/**
 * Template for page Academy
 */
$category = get_queried_object();
?>

<div>
    <div class="container my-5 mb-0">
        <div class="row d-flex justify-content-center align-align-items-center mb-4">
            <div class="col-12 d-flex flex-lg-row">
                <h1 class="NotoSans-Bold">ACADEMIA</h1>
                <div class="col-11 mx-1" id="linea">
                    <hr class="mx-5 px-4">
                </div>
            </div>
            <P>Encuentre información educativa y nuestros eventos nacionales.</P>
        </div>
    </div>
    <div class="container banner-speakers">
        <?php the_post_thumbnail('', ['class' => 'bg-banner-speakers']) ?>
        <div class="wrapper-banner-speakers">
            <div class="container-text-banner-speakers">
                <p>
                    ACADEMIA
                </p>
            </div>
            <h4 class="text-white mt-3">Encuentre información educativa y <br>nuestros eventos nacionales.</h4>
            <div class="container-text-banner-speakers w-100 h-100 m-auto d-flex justify-content-lg-start align-items-center">
                <img src="<?= get_template_directory_uri() . '/assets/images/Icono-innsider-white.png'; ?>" alt="Herramientas" class="bg-banner-single-category">
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="content d-flex justify-content-center flex-lg-row flex-column">
            <div class="col-lg-6 mb-4">
                <a href="" style="text-decoration: none;">
                    <img src="<?= get_template_directory_uri() . '/assets/images/NOTICIA-01.png'; ?>" alt="Podcast">
                    <div class="card-info mt-3">
                        <div class="d-flex align-items-start flex-lg-row flex-column">
                            <div class="col-4">
                                <h2 class="font-weight-bold">Eventos nacionales</h2>
                                <p>Lorem ipsum Lorem ipsum Lorem ipsum Lorem ipsum</p>
                            </div>
                            <div class="col-4">
                                <div class="w-75 p-1 mb-2" style="border-radius: 2.5rem; background: #001965; color: white; text-align: center;">Ver más</div>
                            </div>
                        </div>

                    </div>
            </div>
            </a>
            <?php
            /* Consulta en base de datos que valida si la categoria cuenta con status activo, es decir si el campo True/False tiene
                check mostrara el conteido, de lo contrario lo ocultara  */

                global $wpdb;

                $tableTermmeta = $wpdb->prefix . 'termmeta';

                $metaKey = 'Status_Categories';
                $metaValue = '1';

                $allData = $wpdb->prepare("SELECT *  FROM {$tableTermmeta} WHERE `meta_key` = '{$metaKey}' AND `meta_VALUE` = '{$metaValue}'");

                $allCategoriesWithStatusActive = $wpdb->get_results($wpdb->prepare($allData));

            ?>

            <?php if(isset($allCategoriesWithStatusActive) && !empty($allCategoriesWithStatusActive)) : ?> 

                <?php foreach($allCategoriesWithStatusActive as $CategoriesWithStatusActive) : ?>

                    <?php $idCategoriesWithStatusActive = $CategoriesWithStatusActive->term_id; ?>

                    <?php $listCategoriesAcademy = get_terms(
                        array(
                            'taxonomy' => 'academia',
                            'hide_empty' => true,
                            'order' => 'DESC'
                            )
                        ) 
                    ?>

                    <?php if(isset($listCategoriesAcademy) && !empty($listCategoriesAcademy)) : ?>
                        <?php foreach($listCategoriesAcademy as $listCategoryAcademy) : ?>
                            <?php if($listCategoryAcademy->term_id == $idCategoriesWithStatusActive) : ?>
                                <div class="col-lg-6 mb-4">
                                    <a href="<?= get_term_link($listCategoryAcademy->term_id)  ?>" style="text-decoration: none;">
                                        <?php $imageCategoryAcademy = get_field('Category_Image', $listCategoryAcademy); ?>
                                        <img src="<?php echo wp_get_attachment_image_url($imageCategoryAcademy, 'full', '',['style' => 'object-fit: cover;']); ?>" alt="Podcast">
                                        <div class="card-info mt-3">
                                            <div class="d-flex align-items-start flex-lg-row flex-column">
                                                <div class="col-4">
                                                    <h2 class="font-weight-bold"><?= $listCategoryAcademy->name; ?></h2>
                                                    <p><?= $listCategoryAcademy->description; ?></p>
                                                </div>
                                                <div class="col-4">
                                                    <div class="w-75 p-1 mb-2" style="border-radius: 2.5rem; background: #001965; color: white; text-align: center;">Ver más</div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php endif; ?>
                        <?php endforeach ?>
                    <?php endif ?>

                <?php endforeach; ?>

            <?php endif ?> 

        </div>
    </div>
</div>