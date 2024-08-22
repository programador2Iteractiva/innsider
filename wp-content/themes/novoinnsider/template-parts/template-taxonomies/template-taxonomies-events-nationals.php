<?php

/**
 * Taxonomy template Events Nationals
 *
 * @package Connexo
 */

$taxonomy = get_queried_object();
?>


<?php if (isset($taxonomy->term_id) && !empty($taxonomy->term_id)) : ?>

    <?php $currentTermId = $taxonomy->term_id; ?>

    <?php

    $subcategories = get_terms(
        array(
            'taxonomy' => $taxonomy->taxonomy,
            'hide_empty' => false,
            'parent' => $currentTermId,
            'order' => 'ASC',
        )
    )

    ?>

    <?php if (!empty($subcategories) && !is_wp_error($subcategories)) : ?>

        <div class="container mx-5 mx-lg-auto px-0">
            <div class="container mt-4 mx-0 px-0 pb-4">
                <?php custom_breadcrumbs(); ?>
            </div>
        </div>


        <?php $descriptioonCategory = $taxonomy->description; ?>
        <?php $subtitleCategory = get_field('title_for_description_complementary', $taxonomy); ?>
        <?php $bannerCategory = get_field('Category_Image_Banner', $taxonomy); ?>


        <div class="container background-taxonomy mt-lg-3 mt-3 px-5">
            <div class="container banner-taxonomy-academy">
                <?php if (isset($bannerCategory) && !empty($bannerCategory)) : ?>
                    <img src="<?= esc_url(wp_get_attachment_url($bannerCategory)); ?>" alt="Herramientas" class="bg-taxonomy-academy">
                <?php endif; ?>
                <div class="wrapper-taxonomy-academy"></div>
            </div>
            <div class="container mt-4">
                <div class="row m-0 p-0">
                    <?php if (isset($descriptioonCategory) && !empty($descriptioonCategory)) : ?>
                        <h1 class="NotoSans-Bold title-color mb-3 text-uppercase"><?= $descriptioonCategory; ?></h1>
                    <?php endif ?>
                    <?php if (isset($subtitleCategory) && !empty($subtitleCategory)) : ?>
                        <h5 class="NotoSans-SemiBold description-color line-height-2 text-align-justify mb-lg-5 mb-2"><?= $subtitleCategory; ?></h5>
                    <?php endif ?>
                </div>
            </div>
        </div>

        <div class="container mt-lg-5 mt-3 p-0">
            <div id="linea">
                <hr>
            </div>
        </div>



        <div class="container">                        
            <div class="row p-3 m-3 d-flex justify-content-center align-items-start">

                <?php foreach ($subcategories as $subcategory) :  ?>

                    <?php $listIdWithNationalEvents = $CategoriesWithNationalEvents->term_id; ?>

                    <div class="col-12 col-md-4 col-lg-3 d-flex flex-column justify-content-center align-items-center container-card-category-impact m-0 p-0 mt-3 mb-5 pb-4 mx-4">

                        <a href="<?php echo get_term_link($subcategory->term_id) ?>">
                            <div class="mb-4 figure">
                                <?php $imageSubcategoryAcademy = get_field('Category_Image', $subcategory); ?>

                                <?php if ($imageSubcategoryAcademy) :  ?>
                                    <?php echo wp_get_attachment_image($imageSubcategoryAcademy, 'full', '', ['style' => 'object-fit: cover']); ?>
                                <?php endif ?>
                            </div>
                            <div class="info_description col-12">
                                <div class="col-12 h-100">
                                    <div class="col-12 h-100">
                                        <div class="d-flex justify-content-start align-items-start flex-column">
                                            <h4 class="NotoSans-Bold title-color"><?= $subcategory->name; ?></h4>
                                            <p class="description-color NotoSans-Regular"><?= $subcategory->description; ?></p>
                                        </div>
                                    </div>
                                    <div class="col-12 d-flex justify-content-center align-items-center">
                                        <div class="w-75">
                                            <div class="w-100 p-2 mb-2 btn-view-more">Ver más</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>


                <?php endforeach ?>

            </div>
        </div>

        <?php $codePromomats = get_field('description_complementary', $taxonomy) ?>

        <div class="container m-lg-5 mx-lg-auto m-3 px-0">
            <?php if(isset($codePromomats) && !empty($codePromomats)) : ?>
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

    <?php endif ?>

<?php endif; ?>