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

    <div class="container mx-5 mx-lg-auto px-0">
        <div class="container mt-4 mx-0 px-0 pb-4">
            <?php custom_breadcrumbs(); ?>
        </div>
    </div>


    <?php $descriptioonCategory = $taxonomy->description; ?>
    <?php $subtitleCategory = get_field('title_for_description_complementary', $taxonomy); ?>
    <?php $bannerCategory = get_field('Category_Image_Banner', $taxonomy); ?>


    <div class="container background-taxonomy mt-lg-3 mt-3 px-5">
        <div class="container banner-taxonomy-academy" data-aos="zoom-in">
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

    <div class="container mx-auto px-0">
        <div class="container mt-4 mx-lg-0 mx-2 px-0 pb-4">
            <div class="row m-0 p-0">

                <!-- Contenido de prueba -->
                <?php $idCategoriesWithStatusActive = $taxonomy->term_id; ?>

                <?php $listPostTrends = new WP_Query
                    (
                        [
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'academia',
                                    'field' => 'id',
                                    'terms' => $idCategoriesWithStatusActive,
                                )
                            ),
                            'orderby' => 'post_date',
                            'order' => 'ASC',
                            'posts_per_page' => -1,
                            'post_status' => 'publish'
                        ]
                    );
                ?>

                <?php if($listPostTrends->have_posts()) : ?>
                    <?php while($listPostTrends->have_posts()) : $listPostTrends->the_post() ?>

                        <div class="col-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-xxxl-6 d-flex flex-column justify-content-center align-items-center container-card-category pb-5" style="border-radius: 2rem">
                            <div class="col-12">
                                
                                <?php $thePermalink = get_the_permalink(); ?>

                                <a href="<?= $thePermalink; ?>" style="text-decoration: none;">
                                    <div class="figure" style="border-radius: 2rem">
                                        <h3 class="position-absolute title-slide-system class-title-card-system"><?= esc_html(the_title()) ?></h3>
                                    </div>
                                    <div class="info_description d-flex align-items-center mt-3">
                                        <div class="d-flex flex-lg-row flex-column position-relative col-11">
                                            <div class="col-12 col-lg-8">
                                                <h3 class="NotoSans-Bold title-color"><?= the_title(); ?></h3>
                                            </div>
                                            <div class="col-12 col-lg-4">
                                                <div class="w-100 p-1 mb-2 btn-view-more">Ver más</div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                    <?php endwhile; ?>   
                <?php endif ?>
                <!-- Fin contenido de prueba -->

            </div>
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



<?php endif; ?>