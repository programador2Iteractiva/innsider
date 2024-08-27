<?php

/**
 * Single template post.
 *
 */

get_header();

$post = get_queried_object();
$taxId = isset($_GET['tax']) ? intval($_GET['tax']) : 0;
$moduleId = isset($_GET['module_id']) ? intval($_GET['module_id']) : 0;
$contentId = isset($_GET['content_id']) ? intval($_GET['content_id']) : 0;
$currentPostId = get_the_ID();
$titlePostId = get_the_title();
?>

<div class="container mx-5 mx-lg-auto px-0">
    <div class="mt-4 mx-0 px-0 pb-4">
        <?php custom_breadcrumbs(); ?>
    </div>
</div>


<?php $ifPostTrendPdf = get_field('If_Post_Content_Module_Pdf', $currentPostId) ?>
<?php $pdfPostTrend = get_field('URL_Post_Content_Module_Pdf', $currentPostId) ?>

<?php if (isset($ifPostTrendPdf) && !empty($ifPostTrendPdf)) : ?>
    <?php if (isset($pdfPostTrend) && !empty($pdfPostTrend)) : ?>


        <div class="container p-lg-5 p-1">
            <div class="container background-single p-2">
                <div class="p-5">

                    <h1 class="NotoSans-Bold title-color mb-5 pb-2"><?php the_title(); ?></h1>

                    <div class="col-lg-12">
                        <div class="row justify-content-center">
                            <div class="col-12 d-flex justify-content-center mt-5 mb-5">
                                <embed src="<?= $pdfPostTrend ?>" type="application/pdf" width="100%" height="100%" style="width: 90%; height: 100vh; border: none">
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    <?php endif; ?>
<?php endif; ?>

<?php $ifVideoPostEvent = get_field('If_Post_Content_Module_Video', $currentPostId) ?>
<?php $videoPostEvent = get_field('URL_Post_Content_Module_Video', $currentPostId) ?>
<?php $thumbnailUrl = obtenerMiniaturaVimeo($videoPostEvent);  ?>

<?php if (isset($ifVideoPostEvent) && !empty($ifVideoPostEvent)) : ?>
    <?php if (isset($videoPostEvent) && !empty($videoPostEvent)) : ?>

        <div class="container p-lg-5 p-1">
            <div class="container background-single p-2">
                <div class="p-5">

                    <h1 class="NotoSans-Bold title-color mb-5 pb-2"><?php the_title(); ?></h1>

                    <div class="col-lg-12">
                        <div class="row justify-content-center">
                            <div class="col-12 d-flex justify-content-center mt-5 mb-5 flex-column">
                                <div class="container banner-single preview-video"
                                    onclick="playVideo(<?= $moduleId ?>, '<?= $videoPostEvent ?>', event, 'preview-video')">
                                    <?php if (isset($thumbnailUrl) && !empty($thumbnailUrl)) : ?>
                                        <img src="<?= esc_url($thumbnailUrl); ?>" alt="Herramientas" class="bg-single">
                                    <?php elseif (isset($bannerContentModule) && !empty($bannerContentModule)) : ?>
                                        <img src="<?= esc_url(wp_get_attachment_url($bannerContentModule)); ?>" alt="Herramientas" class="bg-single">
                                    <?php endif; ?>

                                    <i class="fas fa-play icon-play-video"></i>

                                    <div class="wrapper-single"></div>
                                </div>

                                <div class="player-video banner-single " id="player"></div>
                                <div class="container mt-4">
                                    <div class="row m-0 p-0">
                                        <?php if (isset($titleVideoContentMod) && !empty($titleVideoContentMod)) : ?>
                                            <h1 class="NotoSans-Bold title-color mb-3 text-uppercase"><?= esc_html($titleVideoContentMod); ?></h1>
                                        <?php endif; ?>
                                        <?php if (isset($DescriptionContentModule) && !empty($DescriptionContentModule)) : ?>
                                            <h5 class="NotoSans-SemiBold description-color line-height-2 text-align-justify mb-lg-5 mb-2"><?= esc_html($DescriptionContentModule); ?></h5>
                                        <?php endif; ?>
                                    </div>
                                </div>

                            </div>
                            <div class="col-12 mx-1" id="linea">
                                <hr>
                            </div> 
                        </div>

                    </div>

                </div>
            </div>
        </div>

    <?php endif; ?>
<?php endif; ?>

<div class="container mx-auto px-0">
    <div class="mt-4 mx-lg-0 mx-2 px-0 pb-4">
        <div class="row m-0 p-0"></div>

        <?php /* Post display for Academia taxonomies */ ?>

        <?php
        $listPostAcademy = new WP_Query(
            [
                'post__in' => [$moduleId],
                'tax_query' => array(
                    array(
                        'taxonomy' => 'academia',
                        'field' => 'id',
                        'terms' => $taxId,
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

                    <?php $listContentModules = get_field('list_of_content_module'); ?>

                    <?php if (isset($listContentModules) && !empty($listContentModules)) : ?>

                        <?php $counter = 0; ?>
                        <?php $counter = 0; ?>
                        <?php $specificModule = null; ?>
                        <?php $otherModules = []; ?>

                        <?php foreach ($listContentModules as $index => $listContentModule) : ?>
                            <?php if ($index == $contentId) : ?>
                                <?php $specificModule = $listContentModule; ?>
                            <?php else : ?>
                                <?php $otherModules[$index] = $listContentModule; ?>
                            <?php endif ?>
                        <?php endforeach; ?>

                        <?php if ($specificModule) : ?>
                            <!-- Mostrar el contenido del módulo específico -->
                            <?php $imageModuleAcademy = $specificModule['Img_Video_Mod']; ?>
                            <?php $titleModuleAcademy = $specificModule['Title_Video_Mod']; ?>
                            <?php $speakerModuleAcademy = $specificModule['Name_Speaker_Mod']; ?>
                            <?php $descriptionModuleAcademy = $specificModule['Description_Module']; ?>
                            <?php $urlModuleAcademy = $specificModule['URL_Video_Module']; ?>
                            <?php $bannerContentModule = $specificModule['Banner_Content_Module']; ?>
                            <?php $titleVideoContentMod = $specificModule['Title_Video_Content_Mod']; ?>
                            <?php $DescriptionContentModule = $specificModule['Description_Content_Module']; ?>
                            <?php $thumbnailUrl = obtenerMiniaturaVimeo($urlModuleAcademy);  ?>

                            <div class="container background-single-init pt-2 px-5">
                                <div class="mt-4">
                                    <?php if (isset($titleModuleAcademy) && !empty($titleModuleAcademy)) : ?>
                                        <h3 class="NotoSans-Bold title-color"><?= esc_html($titleModuleAcademy); ?></h3>
                                    <?php endif; ?>

                                    <?php if (isset($descriptionModuleAcademy) && !empty($descriptionModuleAcademy)) : ?>
                                        <p class="NotoSans-Regular description-color mt-3"><?= esc_html($descriptionModuleAcademy); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="container background-taxonomy mt-lg-5 mt-4 px-5">
                                <div class="container banner-single preview-video"
                                    onclick="playVideo(<?= $moduleId ?>, '<?= $urlModuleAcademy ?>', event, 'preview-video')">
                                    <?php if (isset($thumbnailUrl) && !empty($thumbnailUrl)) : ?>
                                        <img src="<?= esc_url($thumbnailUrl); ?>" alt="Herramientas" class="bg-single">
                                    <?php elseif (isset($bannerContentModule) && !empty($bannerContentModule)) : ?>
                                        <img src="<?= esc_url(wp_get_attachment_url($bannerContentModule)); ?>" alt="Herramientas" class="bg-single">
                                    <?php endif; ?>

                                    <i class="fas fa-play icon-play-video"></i>

                                    <div class="wrapper-single"></div>
                                </div>

                                <div class="player-video banner-single " id="player"></div>
                                <div class="container mt-4">
                                    <div class="row m-0 p-0">
                                        <?php if (isset($titleVideoContentMod) && !empty($titleVideoContentMod)) : ?>
                                            <h1 class="NotoSans-Bold title-color mb-3 text-uppercase"><?= esc_html($titleVideoContentMod); ?></h1>
                                        <?php endif; ?>
                                        <?php if (isset($DescriptionContentModule) && !empty($DescriptionContentModule)) : ?>
                                            <h5 class="NotoSans-SemiBold description-color line-height-2 text-align-justify mb-lg-5 mb-2"><?= esc_html($DescriptionContentModule); ?></h5>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-12 mx-1" id="linea">
                                    <hr>
                                </div>
                            </div>

                        <?php endif; ?>

                        <div class="container background-single pt-2 px-5">
                            <div class="container mt-4">

                                <div class="col-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-xxxl-4 d-flex flex-lg-row flex-column justify-content-start align-items-start container-card-category m-0 p-0 pt-3 mb-3">

                                    <?php foreach ($otherModules as $index => $listContentModule) : ?>

                                        <?php $imageModuleAcademy = $listContentModule['Img_Video_Mod']; ?>
                                        <?php $titleModuleAcademy = $listContentModule['Title_Video_Mod']; ?>
                                        <?php $speakerModuleAcademy = $listContentModule['Name_Speaker_Mod']; ?>
                                        <?php $descriptionModuleAcademy = $listContentModule['Description_Module']; ?>
                                        <?php $urlModuleAcademy = $listContentModule['URL_Video_Module']; ?>
                                        <?php $bannerContentModule = $listContentModule['Banner_Content_Module']; ?>
                                        <?php $titleVideoContentMod = $listContentModule['Title_Video_Content_Mod']; ?>
                                        <?php $DescriptionContentModule = $listContentModule['Description_Content_Module']; ?>
                                        <?php $thumbnailUrl = obtenerMiniaturaVimeo($urlModuleAcademy);  ?>

                                        <div class="col-11 d-flex justify-content-center align-items-center">
                                            <a href="<?= esc_url(get_permalink($postActivityId) . '?module_id=' . $postActivityId . '&content_id=' . $index . '&tax=' . $taxId); ?>" style="text-decoration: none;">
                                                <div class="card bg-transparent" style="border: none !important">
                                                    <?php if ($imageModuleAcademy) : ?>
                                                        <img class="img-card-event" src="<?= esc_url(wp_get_attachment_url($imageModuleAcademy)); ?>" alt="Podcast">
                                                    <?php endif; ?>
                                                    <div class="card-info mt-lg-4 mt-3 p-0">
                                                        <div class="w-75 p-2 mb-2" style="border-radius: 0.5rem; background: #001965; color: white;">
                                                            <i class="fa-regular fa-circle-play mx-2"></i>Ver ahora
                                                        </div>
                                                        <?php if ($titleModuleAcademy) : ?>
                                                            <h5 class="NotoSans-Bold title-color"><?= esc_html($titleModuleAcademy); ?></h5>
                                                        <?php endif; ?>
                                                        <?php if ($speakerModuleAcademy) : ?>
                                                            <p class="NotoSans-Regular description-color"><?= esc_html($speakerModuleAcademy); ?></p>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>

                                        <?php $counter++; ?>
                                    <?php endforeach; ?>

                                </div>
                            </div>
                        </div>

                    <?php endif; ?>

                <?php endwhile; ?>
            <?php endif; ?>
        <?php endif; ?>


        <?php /* End Post display for Academia taxonomies */ ?>


        <?php /* Post display for Tendencias taxonomies */ ?>

        <?php $listPostTrends = new WP_Query(
            [
                'tax_query' => array(
                    array(
                        'taxonomy' => 'tendencias',
                        'field' => 'id',
                        'terms' => $taxId,
                    )
                ),
                'orderby' => 'post_date',
                'order' => 'ASC',
                'posts_per_page' => -1,
                'post_status' => 'publish'
            ]
        );
        ?>

        <?php $taxonomy = 'tendencias'; ?>

        <?php $term = get_term($taxId, $taxonomy); ?>

        <?php $imgPostTrend = get_field('Img_Post_Trend'); ?>
        <?php $bannerPostTrend = get_field('Banner_Post_Trend'); ?>
        <?php $subtitlePostTrend = get_field('Subtitle_Post_Trend'); ?>
        <?php $ifPostTrendVideo = get_field('If_Post_Trend_Video'); ?>
        <?php $uRLPostTrend = get_field('URL_Post_Trend'); ?>
        <?php $ifPostTrendPdf = get_field('If_Post_Trend_Pdf'); ?>
        <?php $pdfPostTrend = get_field('Pdf_Post_Trend'); ?>
        <?php $contentPostTrend = get_field('Content_Post_Trend'); ?>
        <?php $postsIds = wp_list_pluck($listPostTrends->posts, 'ID') ?>
        <?php $thumbnailUrlPostTrend = obtenerMiniaturaVimeo($uRLPostTrend);  ?>

        <?php if (is_single() && in_array($currentPostId, $postsIds)) : ?>

            <div class="container my-2 mb-0">
                <div class="row d-flex justify-content-center align-align-items-center mb-4">
                    <div class="col-12 d-flex flex-lg-row">
                        <h2 class="NotoSans-Bold text-transform-uppercase"><?= esc_html($term->name); ?></h2>
                        <div class="col-9 mx-1" id="linea">
                            <hr class="mx-4">
                        </div>
                    </div>
                </div>
            </div>

            <div class="container banner-academy">
                <img class="bg-banner-academy" src="<?php echo wp_get_attachment_image_url($bannerPostTrend, 'full', ''); ?>" alt="Podcast">
                <div class="wrapper-banner-academy">
                    <div class="container-text-banner-academy"></div>
                    <h4 class="text-white mt-3"><?php the_content(); ?></h4>
                    <div class="container-text-banner-academy w-100 h-100 m-auto d-flex justify-content-lg-start align-items-center">
                        <img src="<?= get_template_directory_uri() . '/assets/images/Icono-innsider-white.png'; ?>" alt="Herramientas" class="bg-banner-single-category">
                    </div>
                </div>
            </div>

            <?php if (isset($ifPostTrendVideo) && !empty($ifPostTrendVideo)) : ?>
                <?php if (isset($uRLPostTrend) && !empty($uRLPostTrend)) : ?>


                    <div class="container background-taxonomy mt-lg-5 mt-4 px-5">
                        <div class="container banner-single preview-video"
                            onclick="playVideo(<?= $moduleId ?>, '<?= $uRLPostTrend; ?>', event, 'preview-video')">
                            <?php if (isset($thumbnailUrlPostTrend) && !empty($thumbnailUrlPostTrend)) : ?>
                                <img src="<?= esc_url($thumbnailUrlPostTrend); ?>" alt="Herramientas" class="bg-single">
                            <?php elseif (isset($bannerPostTrend) && !empty($bannerPostTrend)) : ?>
                                <img src="<?= esc_url(wp_get_attachment_url($bannerPostTrend)); ?>" alt="Herramientas" class="bg-single">
                            <?php endif; ?>

                            <i class="fas fa-play icon-play-video"></i>

                            <div class="wrapper-single"></div>
                        </div>

                        <div class="player-video banner-single " id="player"></div>

                        <div class="container mt-4">
                            <div class="row m-0 p-0">
                                <div class="container p-lg-5 p-1">
                                    <div class="container background-single p-2">
                                        <div class="p-1">

                                            <h1 class="NotoSans-Bold title-color mb-5 pb-2"><?php the_title(); ?></h1>

                                            <?php if (have_rows('Content_Post_Trend')) : ?>

                                                <?php while (have_rows('Content_Post_Trend')) : the_row() ?>

                                                    <div class="col-lg-12">

                                                        <?php $titleContentPostTrend = get_sub_field('Title_Content_Post_Trend') ?>
                                                        <?php if (isset($titleContentPostTrend) && !empty($titleContentPostTrend)) : ?>
                                                            <div class="col-12">
                                                                <h2 class="NotoSans-Bold title-color mb-3"><?php echo $titleContentPostTrend ?></h2>
                                                            </div>
                                                        <?php endif; ?>

                                                        <?php $descriptionContentPostTrend = get_sub_field('Description_Content_Post_Trend') ?>
                                                        <?php if (isset($descriptionContentPostTrend) && !empty($descriptionContentPostTrend)) : ?>
                                                            <div class="col-12">
                                                                <p class="NotoSans-Regular description-color"><?= strip_tags($descriptionContentPostTrend); ?></p>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>

                                                <?php endwhile; ?>

                                            <?php endif; ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endif; ?>
            <?php else : ?>

                <?php if (isset($ifPostTrendPdf) && !empty($ifPostTrendPdf)) : ?>
                    <?php if (isset($pdfPostTrend) && !empty($pdfPostTrend)) : ?>


                        <div class="container p-lg-5 p-1">
                            <div class="container background-single p-2">
                                <div class="p-5">

                                    <h1 class="NotoSans-Bold title-color mb-5 pb-2"><?php the_title(); ?></h1>

                                    <div class="col-lg-12">
                                        <div class="row justify-content-center">
                                            <div class="col-12 d-flex justify-content-center mt-5 mb-5">
                                                <embed src="<?= $pdfPostTrend ?>" type="application/pdf" width="100%" height="100%" style="width: 90%; height: 100vh; border: none">
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                    <?php endif; ?>

                <?php else : ?>

                    <div class="container p-lg-5 p-1">
                        <div class="container background-single p-2">
                            <div class="p-5">

                                <h1 class="NotoSans-Bold title-color mb-5 pb-2"><?php the_title(); ?></h1>

                                <?php if (have_rows('Content_Post_Trend')) : ?>

                                    <?php while (have_rows('Content_Post_Trend')) : the_row() ?>

                                        <div class="col-lg-12">

                                            <?php $titleContentPostTrend = get_sub_field('Title_Content_Post_Trend') ?>
                                            <?php if (isset($titleContentPostTrend) && !empty($titleContentPostTrend)) : ?>
                                                <div class="col-12">
                                                    <h2 class="NotoSans-Bold title-color mb-3"><?php echo $titleContentPostTrend ?></h2>
                                                </div>
                                            <?php endif; ?>

                                            <?php $descriptionContentPostTrend = get_sub_field('Description_Content_Post_Trend') ?>
                                            <?php if (isset($descriptionContentPostTrend) && !empty($descriptionContentPostTrend)) : ?>
                                                <div class="col-12">
                                                    <span class="NotoSans-Regular description-color"><?php echo wp_kses_post($descriptionContentPostTrend); ?></span>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                    <?php endwhile; ?>

                                <?php endif; ?>

                            </div>
                        </div>
                    </div>

                <?php endif; ?>

            <?php endif; ?>

            <?php $currentPostTrends = array($currentPostId); ?>

            <?php $filteredPosts = array_diff($postsIds, $currentPostTrends); ?>

            <?php if (!empty($filteredPosts)) : ?>

                <?php
                $newArgs = array(
                    'post__in' => $filteredPosts,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'tendencias',
                            'field' => 'id',
                            'terms' => $taxId, // Asegúrate de que $taxId está definido
                        )
                    ),
                    'orderby' => 'post_date',
                    'order' => 'ASC',
                    'posts_per_page' => -1,
                    'post_status' => 'publish'
                );
                ?>

                <?php $filteredPostsQuery = new WP_Query($newArgs); ?>

                <?php if ($filteredPostsQuery->have_posts()) : ?>

                    <div class="container p-lg-5 pt-lg-1 p-1">
                        <div class="container background-single-init p-2">
                            <div class="p-3">

                                <div class="col-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-xxxl-4 d-flex flex-lg-row flex-column justify-content-start align-items-start container-card-category m-0 p-0 pt-3 mb-3">
                                    <?php while ($filteredPostsQuery->have_posts()) : $filteredPostsQuery->the_post() ?>

                                        <?php $thePermalink = get_the_permalink(); ?>
                                        <?php $imgPostTrend = get_field('Img_Post_Trend'); ?>
                                        <?php $subtitlePostTrend = get_field('Subtitle_Post_Trend'); ?>

                                        <div class="col-11 d-flex justify-content-center align-items-center">
                                            <a href="<?= $thePermalink . '?tax=' . $taxId; ?>" style="text-decoration: none;">
                                                <div class="card bg-transparent" style="border: none !important">
                                                    <?php if (isset($imgPostTrend) && !empty($imgPostTrend)) : ?>
                                                        <img class="img-card-event" src="<?= esc_url(wp_get_attachment_url($imgPostTrend)); ?>" alt="Podcast">
                                                    <?php endif; ?>
                                                    <div class="card-info mt-lg-4 mt-3 p-0">
                                                        <div class="w-75 p-2 mb-2" style="border-radius: 0.5rem; background: #001965; color: white;">
                                                            <i class="fa-regular fa-circle-play mx-2"></i>Ver ahora
                                                        </div>
                                                        <h5 class="NotoSans-Bold title-color"><?= the_title(); ?></h5>
                                                        <?php if (isset($subtitlePostTrend) && !empty($subtitlePostTrend)) : ?>
                                                            <p class="NotoSans-Regular description-color"><?= esc_html($subtitlePostTrend); ?></p>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>

                                    <?php endwhile; ?>
                                    <?php wp_reset_postdata(); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endif; ?>

            <?php endif ?>

        <?php endif; ?>

        <?php /* End Post display for Academia taxonomies */ ?>

        <?php /* Post display for Vision taxonomies */ ?>

        <?php
        $listPostAcademy = new WP_Query(
            [
                'post__in' => [$moduleId],
                'tax_query' => array(
                    array(
                        'taxonomy' => 'visioninnsider-category',
                        'field' => 'id',
                        'terms' => $taxId,
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

                    <?php $listContentModules = get_field('list_of_content_module'); ?>

                    <?php if (isset($listContentModules) && !empty($listContentModules)) : ?>

                        <?php $counter = 0; ?>
                        <?php $counter = 0; ?>
                        <?php $specificModule = null; ?>
                        <?php $otherModules = []; ?>

                        <?php foreach ($listContentModules as $index => $listContentModule) : ?>
                            <?php if ($index == $contentId) : ?>
                                <?php $specificModule = $listContentModule; ?>
                            <?php else : ?>
                                <?php $otherModules[$index] = $listContentModule; ?>
                            <?php endif ?>
                        <?php endforeach; ?>

                        <?php if ($specificModule) : ?>
                            <!-- Mostrar el contenido del módulo específico -->
                            <?php $imageModuleAcademy = $specificModule['Img_Video_Mod']; ?>
                            <?php $titleModuleAcademy = $specificModule['Title_Video_Mod']; ?>
                            <?php $speakerModuleAcademy = $specificModule['Name_Speaker_Mod']; ?>
                            <?php $descriptionModuleAcademy = $specificModule['Description_Module']; ?>
                            <?php $urlModuleAcademy = $specificModule['URL_Video_Module']; ?>
                            <?php $bannerContentModule = $specificModule['Banner_Content_Module']; ?>
                            <?php $titleVideoContentMod = $specificModule['Title_Video_Content_Mod']; ?>
                            <?php $DescriptionContentModule = $specificModule['Description_Content_Module']; ?>
                            <?php $thumbnailUrl = obtenerMiniaturaVimeo($urlModuleAcademy);  ?>

                            <div class="container background-single-init pt-2 px-5">
                                <div class="mt-4">
                                    <?php if (isset($titleModuleAcademy) && !empty($titleModuleAcademy)) : ?>
                                        <h3 class="NotoSans-Bold title-color"><?= esc_html($titleModuleAcademy); ?></h3>
                                    <?php endif; ?>

                                    <?php if (isset($descriptionModuleAcademy) && !empty($descriptionModuleAcademy)) : ?>
                                        <p class="NotoSans-Regular description-color mt-3"><?= esc_html($descriptionModuleAcademy); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="container background-taxonomy mt-lg-5 mt-4 px-5">
                                <div class="container banner-single preview-video"
                                    onclick="playVideo(<?= $moduleId ?>, '<?= $urlModuleAcademy ?>', event, 'preview-video')">
                                    <?php if (isset($thumbnailUrl) && !empty($thumbnailUrl)) : ?>
                                        <img src="<?= esc_url($thumbnailUrl); ?>" alt="Herramientas" class="bg-single">
                                    <?php elseif (isset($bannerContentModule) && !empty($bannerContentModule)) : ?>
                                        <img src="<?= esc_url(wp_get_attachment_url($bannerContentModule)); ?>" alt="Herramientas" class="bg-single">
                                    <?php endif; ?>

                                    <i class="fas fa-play icon-play-video"></i>

                                    <div class="wrapper-single"></div>
                                </div>

                                <div class="player-video banner-single " id="player"></div>
                                <div class="container mt-4">
                                    <div class="row m-0 p-0">
                                        <?php if (isset($titleVideoContentMod) && !empty($titleVideoContentMod)) : ?>
                                            <h1 class="NotoSans-Bold title-color mb-3 text-uppercase"><?= esc_html($titleVideoContentMod); ?></h1>
                                        <?php endif; ?>
                                        <?php if (isset($DescriptionContentModule) && !empty($DescriptionContentModule)) : ?>
                                            <h5 class="NotoSans-SemiBold description-color line-height-2 text-align-justify mb-lg-5 mb-2"><?= esc_html($DescriptionContentModule); ?></h5>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <div class="col-12 mx-1" id="linea">
                                    <hr>
                                </div>
                            </div>

                        <?php endif; ?>

                        <div class="container background-single pt-2 px-5">
                            <div class="container mt-4">

                                <div class="col-12 col-md-4 col-lg-4 col-xl-4 col-xxl-4 col-xxxl-4 d-flex flex-lg-row flex-column justify-content-start align-items-start container-card-category m-0 p-0 pt-3 mb-3">

                                    <?php foreach ($otherModules as $index => $listContentModule) : ?>

                                        <?php $imageModuleAcademy = $listContentModule['Img_Video_Mod']; ?>
                                        <?php $titleModuleAcademy = $listContentModule['Title_Video_Mod']; ?>
                                        <?php $speakerModuleAcademy = $listContentModule['Name_Speaker_Mod']; ?>
                                        <?php $descriptionModuleAcademy = $listContentModule['Description_Module']; ?>
                                        <?php $urlModuleAcademy = $listContentModule['URL_Video_Module']; ?>
                                        <?php $bannerContentModule = $listContentModule['Banner_Content_Module']; ?>
                                        <?php $titleVideoContentMod = $listContentModule['Title_Video_Content_Mod']; ?>
                                        <?php $DescriptionContentModule = $listContentModule['Description_Content_Module']; ?>
                                        <?php $thumbnailUrl = obtenerMiniaturaVimeo($urlModuleAcademy);  ?>

                                        <div class="col-11 d-flex justify-content-center align-items-center">
                                            <a href="<?= esc_url(get_permalink($postActivityId) . '?module_id=' . $postActivityId . '&content_id=' . $index . '&tax=' . $taxId); ?>" style="text-decoration: none;">
                                                <div class="card bg-transparent" style="border: none !important">
                                                    <?php if ($imageModuleAcademy) : ?>
                                                        <img class="img-card-event" src="<?= esc_url(wp_get_attachment_url($imageModuleAcademy)); ?>" alt="Podcast">
                                                    <?php endif; ?>
                                                    <div class="card-info mt-lg-4 mt-3 p-0">
                                                        <div class="w-75 p-2 mb-2" style="border-radius: 0.5rem; background: #001965; color: white;">
                                                            <i class="fa-regular fa-circle-play mx-2"></i>Ver ahora
                                                        </div>
                                                        <?php if ($titleModuleAcademy) : ?>
                                                            <h5 class="NotoSans-Bold title-color"><?= esc_html($titleModuleAcademy); ?></h5>
                                                        <?php endif; ?>
                                                        <?php if ($speakerModuleAcademy) : ?>
                                                            <p class="NotoSans-Regular description-color"><?= esc_html($speakerModuleAcademy); ?></p>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>

                                        <?php $counter++; ?>
                                    <?php endforeach; ?>

                                </div>
                            </div>
                        </div>

                    <?php endif; ?>

                <?php endwhile; ?>
            <?php endif; ?>
        <?php endif; ?>


        <?php /* End Post display for Vision taxonomies */ ?>

    </div>
</div>
</div>

<?php get_footer(); ?>