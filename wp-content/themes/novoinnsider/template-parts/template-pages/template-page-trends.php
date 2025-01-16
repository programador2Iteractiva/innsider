<?php

/**
 * Template for page Trends
 */
$content = get_the_content();
?>

<div>
    <!-- <div class="container my-5 mb-0">
        <div class="row d-flex justify-content-center align-align-items-center mb-4">
            <div class="col-12 d-flex flex-lg-row">
                <h1 class="NotoSans-Bold text-transform-uppercase"><?= strip_tags(the_title()); ?></h1>
                <div class="col-11 mx-1" id="linea">
                    <hr class="mx-5 px-4">
                </div>
            </div>
            <P><?= strip_tags($content); ?></P>
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
            <!-- <div class="container-text-banner-academy">
                <p class="text-transform-uppercase">
                    <?php the_title(); ?>
                </p>
            </div> -->
            <!-- <h4 class="text-white mt-3"><?php the_content(); ?></h4> -->
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

    $taxonomyTrends = novo_inssider_get_all_trends_actives();
    ?>

    <?php if (count($taxonomyTrends) == 1) : ?>

        <div class="container align-items-center mt-5 pt-1">
            <div class="row d-flex justify-content-center align-items-center m-0 mt-4 p-0">

            <?php else : ?>

                <div class="container align-items-center mt-5 pt-1">
                    <div class="row d-flex justify-content-center align-items-start m-0 mt-4 p-0">

                    <?php endif; ?>

                    <?php if (isset($allCategoriesWithStatusActive) && !empty($allCategoriesWithStatusActive)) : ?>

                        <?php foreach ($allCategoriesWithStatusActive as $CategoriesWithStatusActive) : ?>

                            <?php $idCategoriesWithStatusActive = $CategoriesWithStatusActive->term_id; ?>

                            <?php $listCategoriesTrends = get_terms(
                                array(
                                    'taxonomy' => 'tendencias',
                                    'hide_empty' => true,
                                    'orderby' => 'id',
                                    'order' => 'ASC',
                                )
                            )
                            ?>

                            <?php if (isset($listCategoriesTrends) && !empty($listCategoriesTrends)) : ?>
                                <?php foreach ($listCategoriesTrends as $listCategoryTrends) : ?>
                                    <?php if ($listCategoryTrends->term_id == $idCategoriesWithStatusActive) : ?>

                                        <?php $listPostTrends = new WP_Query(
                                                [
                                                    'tax_query' => array(
                                                        array(
                                                            'taxonomy' => 'tendencias',
                                                            'field' => 'id',
                                                            'terms' => $listCategoryTrends->term_id,
                                                        )
                                                    ),
                                                    'orderby' => 'id',
                                                    'order' => 'ASC',
                                                    'posts_per_page' => -1,
                                                    'post_status' => 'publish'
                                                ]
                                            );
                                        ?>

                                        <?php if ($listPostTrends->have_posts()) : ?>
                                            <?php while ($listPostTrends->have_posts()) : $listPostTrends->the_post() ?>

                                                <?php $thePermalink = get_the_permalink(); ?>
                                                <?php $imgPostTrend = get_field('Img_Post_Trend'); ?>
                                                <?php $bannerPostTrend = get_field('Banner_Post_Trend'); ?>
                                                <?php $subtitlePostTrend = get_field('Subtitle_Post_Trend'); ?>
                                                <?php $ifPostTrendVideo = get_field('If_Post_Trend_Video'); ?>
                                                <?php $uRLPostTrend = get_field('URL_Post_Trend'); ?>
                                                <?php $contentPostTrend = get_field('Content_Post_Trend'); ?>

                                                <div class="col-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-xxxl-6 d-flex flex-column justify-content-center align-items-center card-category-academy m-0 p-0 mt-3 mb-3 pb-3 ">
                                                    <a href="<?= $thePermalink  . '?tax=' . $listCategoryTrends->term_id; ?>" onclick="saveLogsClick('Clic en tarjeta `<?= the_title(); ?>`');"  class="w-100">
                                                        <div class="<?= ($counter % 2 === 0) ? 'd-flex justify-content-center align-items-lg-start align-items-center flex-column' : 'd-flex justify-content-center align-items-lg-end align-items-center flex-column'; ?>">
                                                            <div class="col-10 col-lg-11">
                                                                <div class="mb-4 figure">

                                                                    <?php if ($imgPostTrend) :  ?>
                                                                        <?php echo wp_get_attachment_image($imgPostTrend, 'full', '', ['style' => 'object-fit: fill']); ?>
                                                                    <?php endif ?>
                                                                </div>
                                                                <div class="col-12 d-flex w-100">
                                                                    <div class="col-12 d-flex">
                                                                        <div class="col h-100">
                                                                            <div class="d-flex justify-content-start align-items-start flex-column">
                                                                                <h5 class="NotoSans-Bold title-color"><?= the_title(); ?></h5>
                                                                                <p class="description-color NotoSans-Regular"><?= $subtitlePostTrend; ?></p>
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

                                            <?php endwhile; ?>
                                        <?php endif ?>

                                    <?php endif; ?>
                                <?php endforeach ?>
                            <?php endif ?>

                        <?php endforeach; ?>

                        <div class="container m-lg-3 mx-lg-auto m-3 px-0">
                            <h5 class="NotoSans-Bold title-color">
                                <?php $codePromomats = $content; ?>
                                <p><?= $codePromomats ?></p>
                            </h5>
                        </div>

                    <?php endif ?>

                    </div>
                </div>

            </div>