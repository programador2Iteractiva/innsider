<?php

/**
 * Taxonomy template Events Nationals
 *
 * @package Connexo
 */

$taxonomy = get_queried_object();
$cuttentTaxonomyId = $taxonomy->term_taxonomy_id;
$cuttentTaxonomyParentId = $taxonomy->parent;

?>
<div class="container mx-2 mx-lg-auto px-0">
    <div class="container mt-4 mx-0 px-0 pb-4">
        <?php custom_breadcrumbs(); ?>
    </div>
</div>

<?php $descriptioonCategory = $taxonomy->description; ?>
<?php $subtitleCategory = get_field('title_for_description_complementary', $taxonomy); ?>
<?php $bannerCategory = get_field('Category_Image_Banner', $taxonomy); ?>

<?php /* template con el contenido de las subcategoria de la categoria princiapl "Eventos Nacionales" term_id 6 */  ?>
<?php if (!empty($cuttentTaxonomyParentId) && $cuttentTaxonomyParentId == 6) : ?>
    <div class="container third-background-taxonomy mt-lg-3 mt-3 p-5">
        <div class="container banner-taxonomy-academy">
            <?php if (isset($bannerCategory) && !empty($bannerCategory)) : ?>
                <img src="<?= esc_url(wp_get_attachment_url($bannerCategory)); ?>" alt="Herramientas" class="bg-taxonomy-academy">
            <?php endif; ?>
            <div class="wrapper-taxonomy-academy"></div>
        </div>
        <div class="container mt-4">
            <div class="row m-0 p-0">
                <?php if (isset($descriptioonCategory) && !empty($descriptioonCategory)) : ?>
                    <h2 class="NotoSans-Bold title-color text-uppercase d-none d-lg-block mx-0 p-0"><?= $descriptioonCategory; ?></h2>
                    <h5 class="NotoSans-Bold title-color text-uppercase d-block d-lg-none mx-0 p-0"><?= $descriptioonCategory; ?></h5>
                <?php endif ?>
                <?php if (isset($subtitleCategory) && !empty($subtitleCategory)) : ?>
                    <h5 class="NotoSans-SemiBold description-color line-height-2 text-align-justify d-none d-lg-block mx-0 p-0"><?= $subtitleCategory; ?></h5>
                    <p class="NotoSans-SemiBold description-color line-height-2 text-align-justify d-block d-lg-none mx-0 p-0"><?= $subtitleCategory; ?></p>
                <?php endif ?>
            </div>
        </div>
    </div>

    <div class="container mx-auto px-0">
        <div class="container mt-4 mx-lg-0 mx-2 px-0 pb-4">
            <div class="row m-0 p-0">

                <?php
                $listPostAcademy = new WP_Query(
                    [
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'academia',
                                'field' => 'id',
                                'terms' => $taxonomy->term_id,
                            )
                        ),
                        'orderby' => 'post_date',
                        'order' => 'ASC',
                        'posts_per_page' => -1,
                        'post_status' => 'publish'
                    ]
                );
                ?>

                <?php if (isset($listPostAcademy) && !empty($listPostAcademy)) : ?>
                    <?php if ($listPostAcademy->have_posts()) : ?>
                        <?php while ($listPostAcademy->have_posts()) : $listPostAcademy->the_post() ?>

                            <?php $SubtitleModule = get_field('Subtitle_Module'); ?>
                            <?php $postActivityId = get_the_ID(); ?>

                            <h3 class="NotoSans-Bold title-color"><?= the_title() ?></h3>
                            <h2 class="NotoSans-Bold m-0 text-uppercase text-linear-gradient"><?= $SubtitleModule; ?></h2>

                            <div class="col-12 mx-1" id="linea">
                                <hr>
                            </div>

                            <?php $listContentModules = get_field('list_of_content_module'); ?>

                            <?php if (isset($listContentModules) && !empty($listContentModules)) : ?>

                                <?php $counter = 0; ?>

                                <?php foreach ($listContentModules as $listContentModule) : ?>

                                    <?php $imageModuleAcademy = $listContentModule['Img_Video_Mod']; ?>
                                    <?php $titleModuleAcademy = $listContentModule['Title_Video_Mod']; ?>
                                    <?php $speakerModuleAcademy = $listContentModule['Name_Speaker_Mod']; ?>
                                    <?php $descriptionModuleAcademy = $listContentModule['Description_Module']; ?>
                                    <?php $urlModuleAcademy = $listContentModule['URL_Video_Module']; ?>

                                    <div class="col-12 col-md-4 col-lg-3 col-xl-3 col-xxl-3 col-xxxl-3 d-flex flex-column justify-content-start align-items-center card-taxonomies-subcategory-academy-events m-0 p-0 mt-3 mb-3">
                                        <a class="custom-width" href="<?php echo get_permalink($postActivityId) . '?module_id=' . $postActivityId . '&content_id=' . $counter . '&tax=' . $taxonomy->term_id; ?>" style="text-decoration: none;">
                                            <div class="mb-4 figure">
                                                <?php if ($imageModuleAcademy) :  ?>
                                                    <?php echo wp_get_attachment_image($imageModuleAcademy, 'full', '', ['style' => 'object-fit: fill']); ?>
                                                <?php endif ?>
                                            </div>
                                            <div class="mt-1 p-0">
                                                <div class="w-75 p-2 mb-4 btn-view-now">
                                                    <i class="fa-regular fa-circle-play mx-2"></i>
                                                    Ver ahora
                                                </div>
                                                <?php if ($titleModuleAcademy) : ?>
                                                    <h5 class="NotoSans-Bold title-color"><?= $titleModuleAcademy; ?></h5>
                                                <?php endif; ?>
                                                <?php if ($speakerModuleAcademy) : ?>
                                                    <p class="NotoSans-Regular description-color"><?= $speakerModuleAcademy; ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </a>
                                    </div>

                                    <?php $counter++; ?>

                                <?php endforeach; ?>

                            <?php endif; ?>

                        <?php endwhile; ?>
                    <?php endif; ?>
                <?php endif; ?>

            </div>
        </div>
    </div>
    <?php /* template con el contenido de las subcategoria de la categoria princiapl "Cursos de formación" term_id 5 */  ?>
<?php elseif (!empty($cuttentTaxonomyParentId) && $cuttentTaxonomyParentId == 5) : ?>
    <div class="container">
        <div class="row m-0 pt-5 pb-5 p-0 w-100 h-auto row-section">
            <div class="col-12 d-flex justify-content-center align-items-center container-toolbox">
                <main class="main white">
                    <div class="container">
                        <article class="conpes">
                            <div class="row justify-content-evenly justify-content-md-center">
                                <div class="container-not-found text-center p-5">
                                    <i class="fas fa-exclamation-circle text-white mt-5"></i>
                                    <h2 class="text-not-found text-white mb-5">Aún no hay contenido disponible para este curso.</h2>
                                </div>
                            </div>
                        </article>
                    </div>
                </main>
            </div>

        </div>
    </div>
<?php endif; ?>