<?php

/**
 * Taxonomy template Events Vision iNNsider
 *
 * @package Connexo
 */

$taxonomy = get_queried_object();
?>



<div class="container mx-2 mx-lg-auto px-0">
    <div class="container mt-4 mx-0 px-0 pb-4">
        <?php custom_breadcrumbs(); ?>
    </div>
</div>


<?php $descriptioonCategory = $taxonomy->description; ?>
<?php $subtitleCategory = get_field('title_for_description_complementary', $taxonomy); ?>
<?php $bannerCategory = get_field('Category_Image_Banner', $taxonomy); ?>

<div class="container px-5 mx-auto">

    <div class="container second-background-taxonomy mt-lg-3 mt-3 p-5">
        <div class="container banner-taxonomy-academy" data-aos="zoom-in">
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
                    <h5 class="NotoSans-SemiBold description-color line-height-2 text-align-justify mb-lg-5 mb-2"><?= $subtitleCategory; ?></h5>
                <?php endif ?>
            </div>
        </div>
    </div>

</div>

<div class="container mx-auto px-0">
    <div class="container mt-4 mx-lg-0 mx-2 px-0 second-background-taxonomy">
        <div class="row m-0 px-5 d-flex justify-content-center align-items-start">

            <!-- Contenido de prueba -->
            <?php $idCategoriesWithStatusActive = $taxonomy->term_id; ?>

            <?php $listPostVisionFirstTemp = new WP_Query(
                [
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'visioninnsider-category',
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

            <?php if ($listPostVisionFirstTemp->have_posts()) : ?>
                <?php $counter = 1; ?>
                <?php while ($listPostVisionFirstTemp->have_posts()) : $listPostVisionFirstTemp->the_post() ?>

                    <div class="container mt-5 mb-5">
                        <div class="row">
                            <div class="col-12 card-subcategory-content-academy">
                                <?php $thePermalink = get_the_permalink(); ?>
                                <?php $postActivityId = get_the_ID(); ?>

                                <a href="<?php echo get_permalink($postActivityId) . '?module_id=' . $postActivityId . '&content_id=' . $counter . '&tax=' . $taxonomy->term_id; ?>">
                                    <div class="d-flex flex-md-row flex-column position-relative justify-content-start align-items-start">
                                        <div class="col-md-6 col-lg-5">
                                            <div class="figure">
                                                <?php $imageSubcategoryAcademy = get_field('Img_Post_Content'); ?>

                                                <?php if ($imageSubcategoryAcademy) :  ?>
                                                    <?php echo wp_get_attachment_image($imageSubcategoryAcademy, 'full', '', ['class' => 'img-featured-content']); ?>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-7 d-flex justify-content-center align-items-center">
                                            <div class="col-11 col-md-12 col-lg-12 p-0 m-0 pt-lg-4 pb-4">
                                                <div class="container-title-speaker-content-out mx-lg-5 ms-auto ms-md-4 ms-lg-5">
                                                    <div class="container-content-outstanding mb-3">
                                                        <p class="container-title-speaker-content-outstanding m-0 p-0">
                                                            Episodio <?= $counter; ?>
                                                        </p>
                                                    </div>
                                                    <div class="container-content-outstanding w-75 mb-3">
                                                        <h4 class="container-title-speaker-content-outstanding">
                                                            <?= the_title(); ?>
                                                        </h4>
                                                    </div>
                                                    <div class="container-content-outstanding mb-3">
                                                        <p class="container-title-speaker-content-outstanding m-0 p-0">
                                                            <?= the_content(); ?>
                                                        </p>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-7 col-md-6 col-lg-5 d-flex justify-content-start align-items-center">
                                                            <div class="w-100 p-2 mb-2" style="border-radius: 0.5rem; background: #001965; color: white;">
                                                                <i class="fa-regular fa-circle-play mx-2"></i>Reproducir
                                                            </div>
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
