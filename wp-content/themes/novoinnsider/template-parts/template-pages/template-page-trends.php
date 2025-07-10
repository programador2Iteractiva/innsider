<?php

/**
 * Template for page Trends
 */
$page_id = get_queried_object_id();
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
    <?php $bannerPage = get_field('Page_Image_Banner', $page_id); ?>
    <?php $bannerPageMovil = get_field('Page_Image_Banner_Movil', $page_id); ?>

    <div class="container banner-academy d-none d-lg-block" data-aos="zoom-in">
        <?php if(isset($bannerPage) && !empty($bannerPage)) : ?>
            <img src="<?= esc_url(wp_get_attachment_url($bannerPage)); ?>" alt="Banner-Academy" class="bg-banner-academy">
        <?php endif ?>
        <div class="wrapper-banner-academy">
        </div>
    </div>
    
    <div class="container banner-academy d-block d-lg-none" data-aos="zoom-in">
        <?php if(isset($bannerPageMovil) && !empty($bannerPageMovil)) : ?>
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

<?php 
// Obtener todos los términos de la taxonomía 'tendencias'
$listCategoriesTrends = get_terms(
    array(
        'taxonomy' => 'tendencias',
        'hide_empty' => true,
        'order' => 'DESC'
    )
);
?>

<?php if (isset($listCategoriesTrends) && !empty($listCategoriesTrends)) : ?>
    
    <?php
    // Crear una lista de los términos activos para el tax_query
    $activeTerms = [];
    foreach ($allCategoriesWithStatusActive as $CategoriesWithStatusActive) {
        $activeTerms[] = $CategoriesWithStatusActive->term_id;
    }

    // Consulta global de los posts, ordenados por fecha de publicación
    $listPostTrends = new WP_Query(
        [
            'tax_query' => [
                [
                    'taxonomy' => 'tendencias',
                    'field' => 'id',
                    'terms' => $activeTerms,
                    'operator' => 'IN', // Filtra los posts por los términos activos
                ]
            ],
            'orderby' => 'post_date',
            'order' => 'DESC',
            'posts_per_page' => -1,
            'post_status' => 'publish',
        ]
    );
    ?>
    <?php $counter = 0; ?>
    <?php if ($listPostTrends->have_posts()) : ?>
        <?php while ($listPostTrends->have_posts()) : $listPostTrends->the_post() ?>

            <?php 
            // Variables personalizadas de los posts
            $thePermalink = get_the_permalink();
            $imgPostTrend = get_field('Img_Post_Trend');
            $bannerPostTrend = get_field('Banner_Post_Trend');
            $subtitlePostTrend = get_field('Subtitle_Post_Trend');
            $ifPostTrendVideo = get_field('If_Post_Trend_Video');
            $uRLPostTrend = get_field('URL_Post_Trend');
            $contentPostTrend = get_field('Content_Post_Trend');

            // Obtener el término al que pertenece el post actual
            $terms = get_the_terms(get_the_ID(), 'tendencias');
            $currentTermID = ($terms && !is_wp_error($terms)) ? $terms[0]->term_id : null;
            ?>

            <div class="col-12 col-md-4 col-lg-3 col-xl-3 col-xxl-3 col-xxxl-3 d-flex flex-column justify-content-center align-items-center card-category-academy m-0 p-0 mt-3 mb-3 pb-3 ">
                <a href="<?= $thePermalink . '?tax=' . $currentTermID; ?>" onclick="saveLogsClick('Clic en tarjeta <?= the_title(); ?>');" class="w-100">
                    <div class="<?= ($counter % 2 === 0) ? 'd-flex justify-content-center align-items-lg-center align-items-center flex-column' : 'd-flex justify-content-center align-items-lg-center align-items-center flex-column'; ?>">
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
            
            <?php $counter++; ?>
        <?php endwhile; ?>
    <?php endif ?>

<?php endif; ?>

<div class="container m-lg-3 mx-lg-auto m-3 px-0">
    <h5 class="NotoSans-Bold title-color">
        <?php $codePromomats = $content; ?>
        <p><?= $codePromomats ?></p>
    </h5>
</div>

<?php endif; ?>



                    </div>
                </div>

            </div>