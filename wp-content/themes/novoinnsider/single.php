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

<div class="container mx-2 mx-lg-auto px-0">
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
                            <div class="col-12 d-flex justify-content-center align-items-center flex-column mt-lg-5 mt-2 mb-5">
                                <embed src="<?= $pdfPostTrend ?>" type="application/pdf" class="d-none d-lg-block" width="100%" height="100%" style="width: 90%; height: 100vh; border: none">
                                <iframe src="https://drive.google.com/viewerng/viewer?embedded=true&url=<?= $pdfPostTrend ?>" class="d-block d-lg-none" style="width: 90%; height: 100vh;" frameborder="0"></iframe>

                                <div class="w-75 btn-view-more mt-5 d-block d-lg-none">
                                    <a href="<?= $pdfPostTrend ?>" download class="text-decoration-none text-light">Descargar PDF</a>
                                </div>

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


<?php $ifVideoPostVisionInnsider = get_field('If_Post_Content_Module_Video_vision_innsider', $currentPostId) ?>
<?php $videoPostVisionInnsider = get_field('URL_Post_Content_Module_Video_vision_innsider', $currentPostId) ?>
<?php $thumbnailUrlVisionInnsider = obtenerMiniaturaVimeo($videoPostVisionInnsider);  ?>

<?php if (isset($ifVideoPostVisionInnsider) && !empty($ifVideoPostVisionInnsider)) : ?>
    <?php if (isset($videoPostVisionInnsider) && !empty($videoPostVisionInnsider)) : ?>

        <?php $currentTermParent = get_term($taxId); ?>

        <div class="container p-lg-5 p-1">
            <div class="container background-vision_single p-2">
                <div class="p-5">

                    <?php if (isset($currentTermParent->name) && !empty($currentTermParent->name)) : ?>
                        <h1 class="NotoSans-Bold title-color d-none d-lg-block mb-5 pb-2"><?= $currentTermParent->name ?></h1>
                        <h5 class="NotoSans-Bold title-color d-block d-lg-none mb-3 pb-2"><?= $currentTermParent->name; ?></h5>
                    <?php endif ?>

                    <?php $titlePost = get_the_title(); ?>

                    <?php if (isset($currentTermParent->name) && !empty($currentTermParent->name)) : ?>
                        <h2 class="NotoSans-Bold title-color mx-4 d-none d-lg-block name-info-video-speaker"><?= $titlePost ?></h2>
                        <h5 class="NotoSans-Bold title-color mx-2 d-block d-lg-none name-info-video-speaker"><?= $titlePost; ?></h5>
                    <?php endif ?>

                    <div class="col-lg-12">
                        <div class="row justify-content-center">
                            <div class="col-12 d-flex justify-content-center mt-lg-5 mt-2 mb-2 flex-column">
                                <div class="container banner-single preview-video"
                                    onclick="playVideo(<?= $moduleId ?>, '<?= $videoPostVisionInnsider ?>', event, 'preview-video', <?= $contentId ?>)">
                                    <?php if (isset($thumbnailUrlVisionInnsider) && !empty($thumbnailUrlVisionInnsider)) : ?>
                                        <img src="<?= esc_url($thumbnailUrlVisionInnsider); ?>" alt="Herramientas" class="bg-single">
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

                            <div>

                                <?php $DescriptionModuleInnsider = get_field('Description_Module_Innsider') ?>
                                <?php $IfSpeakerModuleInnsider = get_field('If_Speaker_Module_Innsider') ?>
                                <?php $ListOfSpeakerModuleInnsider = get_field('List_Of_Speaker_Module_Innsider') ?>
                                <?php $IfPostContentModuleVideovisioninnsider = get_field('If_Post_Content_Module_Video_vision_innsider') ?>
                                <?php $URLPostContentModuleVideovisioninnsider = get_field('URL_Post_Content_Module_Video_vision_innsider') ?>

                                <?php if (isset($DescriptionModuleInnsider) && !empty($DescriptionModuleInnsider)) : ?>
                                    <h5 class="NotoSans-SemiBold title-color d-none d-lg-block mx-0 mt-0 m-4 text-info-video-speaker"><?= $DescriptionModuleInnsider; ?></h5>
                                    <p class="NotoSans-SemiBold title-color d-block d-lg-none mx-0 mt-0 m-4 text-info-video-speaker"><?= $DescriptionModuleInnsider; ?></p>
                                <?php endif ?>

                                <?php if (isset($IfSpeakerModuleInnsider) && !empty($IfSpeakerModuleInnsider)) : ?>
                                    <?php if (isset($ListOfSpeakerModuleInnsider) && !empty($ListOfSpeakerModuleInnsider)) : ?>

                                        <?php $count = 0; ?>

                                        <h1 class="NotoSans-Bold title-color mx-0 m-4">Conferencistas</h1>

                                        <?php foreach ($ListOfSpeakerModuleInnsider as $index => $listSpeakerContentModule) : ?>

                                            <?php if ($listSpeakerContentModule) : ?>
                                                <?php $imageSpeakerModuleInnsider = $listSpeakerContentModule['Img_Speaker_Module_Innsider']; ?>
                                                <?php $nameSpeakerModuleInnsider = $listSpeakerContentModule['Name_Speaker_Module_Innsider']; ?>
                                                <?php $credentialsSpeakerModuleInnsider = $listSpeakerContentModule['Credentials_Speaker_Module_Innsider']; ?>

                                                <div x-data="{ open: null }">
                                                    <div class="accordion-item" data-index="<?= $index ?>">
                                                        <button @click="open = open === <?= $index ?> ? null : <?= $index ?>" class="accordion-header">
                                                            <div class="w-100 h-100 d-flex justify-content-start align-items-center">
                                                                <?php if ($imageSpeakerModuleInnsider) : ?>
                                                                    <img src="<?= esc_url(wp_get_attachment_url($imageSpeakerModuleInnsider)); ?>" alt="Herramientas" class="img-speaker-video-podcast">
                                                                <?php endif; ?>
                                                                <span class="mx-4 NotoSans-Bold title-color title-speaker-<?= $index ?>"><?= htmlspecialchars($nameSpeakerModuleInnsider) ?></span>
                                                            </div>
                                                            <i :class="open === <?= $index ?> ? 'fa-solid fa-minus' : 'fa-solid fa-plus'"></i>
                                                        </button>
                                                        <div :class="{ 'open': open === <?= $index ?>, 'closed': open !== <?= $index ?> }" class="accordion-body">
                                                            <div class="row m-0 p-0">
                                                                <p class="NotoSans-Regular title-color m-5 mx-0 credential-speaker-<?= $index ?>"><?= htmlspecialchars($credentialsSpeakerModuleInnsider) ?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            <?php endif; ?>


                                        <?php endforeach; ?>

                                    <?php endif; ?>
                                <?php endif; ?>

                            </div>

                            <div class="col-12 mx-1" id="linea">
                                <hr>
                            </div>
                        </div>

                    </div>

                    <?php
                    $listPostAcademy = new WP_Query(
                        [
                            'post__not_in' => [$moduleId],
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

                    <?php
                    $otherListPostAcademy = new WP_Query(
                        [
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

                    <?php
                    if ($otherListPostAcademy->have_posts()) {
                        while ($otherListPostAcademy->have_posts()) {
                            $otherListPostAcademy->the_post();
                            $postIds[] = get_the_ID();
                        }
                        wp_reset_postdata();
                    }
                    ?>

                    <?php
                    // Crea un array asociativo para mapear IDs a posiciones
                    $postPosition = array_flip($postIds);
                    foreach ($postPosition as $id => $index) {
                        $postPosition[$id] = $index + 1; // Asigna posiciones comenzando desde 1
                    }
                    ?>

                    <div class="container p-lg-5 pt-lg-0">
                        <?php if (isset($listPostAcademy) && !empty($listPostAcademy)) : ?>
                            <?php if ($listPostAcademy->have_posts()) : ?>

                                <div class="">
                                    <div class="row d-flex flex-lg-row flex-column ">

                                        <div class="row d-flex flex-lg-row flex-column ">

                                            <?php $i = 0; ?>

                                            <?php while ($listPostAcademy->have_posts()) : $listPostAcademy->the_post() ?>

                                                <?php $postActivityId = get_the_ID(); ?>
                                                <?php $postIndex = isset($postPosition[$postActivityId]) ? $postPosition[$postActivityId] : 0; ?>

                                                <?php $imageModuleVision = get_field('Img_Video_Mod', $currentPostId) ?>

                                                <?php $videoPostVisionInnsider = get_field('URL_Post_Content_Module_Video_vision_innsider', $postActivityId) ?>
                                                <?php $thumbnailUrlVisionInnsider = obtenerMiniaturaVimeo($videoPostVisionInnsider);  ?>

                                                <?php $descriptionModuleInnsider = get_field('Description_Module_Innsider', $postActivityId) ?>

                                                <?php $ListOfSpeakerModuleInnsider = get_field('List_Of_Speaker_Module_Innsider', $postActivityId) ?>

                                                <div class="col-12 col-md-4 col-lg-3 col-xl-3 col-xxl-3 col-xxxl-3 d-flex flex-column justify-content-start align-items-center card-single-post-podcast m-0 p-0 mt-3 mb-3">
                                                    <a class="custom-width-single item-playlist-videos" id="video-<?= $postIndex ?>" onclick="playVideo(<?= the_ID() ?>, '<?= get_field('URL_Post_Content_Module_Video_vision_innsider') ?>', event, 'item-playlist-videos', <?= $postIndex ?>)">
                                                        <div class="mb-4 figure">
                                                            <?php if (isset($thumbnailUrlVisionInnsider) && !empty($thumbnailUrlVisionInnsider)) : ?>
                                                                <img src="<?= esc_url($thumbnailUrlVisionInnsider); ?>" alt="Herramientas" class="bg-single" style="object-fit:cover">
                                                            <?php endif ?>
                                                        </div>
                                                        <div class="mt-1 p-0">
                                                            <div class="w-75 p-2 mb-4 btn-view-now">
                                                                <i class="fa-regular fa-circle-play mx-2"></i>
                                                                Ver ahora
                                                            </div>
                                                            <h5 class="NotoSans-Bold title-color"><?= the_title(); ?></h5>
                                                            <?php if (isset($subtitlePostTrend) && !empty($subtitlePostTrend)) : ?>
                                                                <p class="NotoSans-Regular description-color"><?= esc_html($subtitlePostTrend); ?></p>
                                                            <?php endif; ?>
                                                        </div>
                                                        <input type="hidden" class="name-playlist-video" value="<?= esc_html(the_title()) ?>">
                                                        <input type="hidden" id="description_video" value="<?= $descriptionModuleInnsider ?>">

                                                        <?php if(isset($ListOfSpeakerModuleInnsider) && !empty($ListOfSpeakerModuleInnsider)) : ?>

                                                            <?php foreach ($ListOfSpeakerModuleInnsider as $index => $speaker) : ?>

                                                                <?php $imageSpeakerModuleInnsider = $speaker['Img_Speaker_Module_Innsider']; ?>
                                                                <?php $nameSpeakerModuleInnsider = $speaker['Name_Speaker_Module_Innsider']; ?>
                                                                <?php $credentialsSpeakerModuleInnsider = $speaker['Credentials_Speaker_Module_Innsider']; ?>

                                                                
                                                                <input type="hidden" class="name-speaker" data-index="<?= $index ?>" value="<?= htmlspecialchars($nameSpeakerModuleInnsider) ?>">
                                                                <input type="hidden" class="credentials-speaker" data-index="<?= $index ?>" value="<?= htmlspecialchars($credentialsSpeakerModuleInnsider) ?>">
                                                                

                                                            <?php endforeach; ?>

                                                        <?php endif; ?>
                                                    </a>
                                                </div>

                                                <?php $i++; ?>

                                            <?php endwhile; ?>
                                            <?php wp_reset_postdata(); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>

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
                                <!-- Mostrar el contenido del módulo específico 1-->
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

                                <div class="container third-background-taxonomy mt-lg-5 mt-4 p-5 pb-lg-5 pb-1">
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
                                    <div class="container mt-lg-4">
                                        <div class="row m-0 p-0">
                                            <?php if (isset($titleVideoContentMod) && !empty($titleVideoContentMod)) : ?>
                                                <h1 class="NotoSans-Bold title-color mb-3 d-none d-lg-block"><?= esc_html($titleVideoContentMod); ?></h1>
                                                <h3 class="NotoSans-Bold title-color mb-3 mt-2 d-block d-lg-none"><?= esc_html($titleVideoContentMod); ?></h3>
                                            <?php endif; ?>
                                            <?php if (isset($DescriptionContentModule) && !empty($DescriptionContentModule)) : ?>
                                                <h5 class="NotoSans-SemiBold description-color line-height-2 text-align-justify mb-lg-5 mb-2 d-none d-lg-block"><?= esc_html($DescriptionContentModule); ?></h5>
                                                <p class="NotoSans-SemiBold description-color text-align-justify mb-lg-5 mb-2 d-block d-lg-none"><?= esc_html($DescriptionContentModule); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="col-12 mx-1" id="linea">
                                        <hr>
                                    </div>
                                </div>

                            <?php endif; ?>

                            <div class="container third-background-taxonomy pt-2 px-5">
                                <div class="container mt-4">

                                    <div class="col-12 d-flex flex-lg-row flex-column justify-content-start align-items-start container-card-category m-0 p-0 pt-3 mb-3">

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


                                            <div class="col-12 col-md-4 col-lg-3 col-xl-3 col-xxl-3 col-xxxl-3 d-flex flex-column justify-content-start align-items-center card-taxonomies-subcategory-academy-events m-0 p-0 mt-3 mb-3">
                                                <a class="custom-width" href="<?= esc_url(get_permalink($postActivityId) . '?module_id=' . $postActivityId . '&content_id=' . $index . '&tax=' . $taxId); ?>" style="text-decoration: none;">
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

                                    </div>
                                </div>
                            </div>

                            <?php $cat = get_term($taxId) ?>

                            <?php $code = get_field('description_complementary', $cat); ?>

                            <?php if (isset($code) && !empty($code)) : ?>
                                <div class="container m-lg-5 mx-lg-auto m-3 px-0">
                                    <h5 class="NotoSans-Bold title-color"><?= $code; ?></h5>
                                </div>
                            <?php endif ?>

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

                <div class="container banner-academy" data-aos="zoom-in">
                    <img class="bg-banner-academy" src="<?php echo wp_get_attachment_image_url($bannerPostTrend, 'full', ''); ?>" alt="Podcast">
                    <div class="wrapper-banner-academy">
                        <div class="container-text-banner-academy"></div>
                        <!-- <h4 class="text-white mt-3"><?php the_content(); ?></h4>
                    <div class="container-text-banner-academy w-100 h-100 m-auto d-flex justify-content-lg-start align-items-center">
                        <img src="<?= get_template_directory_uri() . '/assets/images/Icono-innsider-white.png'; ?>" alt="Herramientas" class="bg-banner-single-category">
                    </div> -->
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


                            <div class="container p-lg-5 pb-lg-0 p-1">
                                <div class="container background-single p-2">
                                    <div class="p-5">

                                        <h1 class="NotoSans-Bold title-color mb-5 pb-2"><?php the_title(); ?></h1>

                                        <div class="col-lg-12">
                                            <div class="row justify-content-center">
                                                <div class="col-12 d-flex justify-content-center align-items-center flex-column mt-lg-5 mt-2 mb-5">
                                                    <embed src="<?= $pdfPostTrend ?>" type="application/pdf" class="d-none d-lg-block" width="100%" height="100%" style="width: 90%; height: 100vh; border: none">
                                                    <iframe src="https://drive.google.com/viewerng/viewer?embedded=true&url=<?= $pdfPostTrend ?>" class="d-block d-lg-none" style="width: 90%; height: 100vh;" frameborder="0"></iframe>

                                                    <div class="w-75 btn-view-more mt-5 d-block d-lg-none">
                                                        <a href="<?= $pdfPostTrend ?>" download class="text-decoration-none text-light">Descargar PDF</a>
                                                    </div> 

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

                        <div class="container p-lg-5 pt-lg-0">

                            <div class="container background-taxonomy px-5">
                                <div class="container mt-4">

                                    <div class="col-12 d-flex flex-lg-row flex-column justify-content-start align-items-start container-card-category m-0 p-0 pt-3 mb-3">

                                        <?php while ($filteredPostsQuery->have_posts()) : $filteredPostsQuery->the_post() ?>

                                            <?php $thePermalink = get_the_permalink(); ?>

                                            <div class="col-12 col-md-4 col-lg-3 col-xl-3 col-xxl-3 col-xxxl-3 d-flex flex-column justify-content-start align-items-center card-taxonomies-subcategory-academy-events m-0 p-0 mt-3 mb-3">
                                                <a class="custom-width" href="<?= $thePermalink . '?tax=' . $taxId; ?>" style="text-decoration: none;">
                                                    <div class="mb-4 figure">
                                                        <?php if (isset($imgPostTrend) && !empty($imgPostTrend)) : ?>
                                                            <?php echo wp_get_attachment_image($imgPostTrend, 'full', '', ['style' => 'object-fit: fill']); ?>
                                                        <?php endif ?>
                                                    </div>
                                                    <div class="mt-1 p-0">
                                                        <div class="w-75 p-2 mb-4 btn-view-now">
                                                            <i class="fa-regular fa-circle-play mx-2"></i>
                                                            Ver ahora
                                                        </div>
                                                        <h5 class="NotoSans-Bold title-color"><?= the_title(); ?></h5>
                                                        <?php if (isset($subtitlePostTrend) && !empty($subtitlePostTrend)) : ?>
                                                            <p class="NotoSans-Regular description-color"><?= esc_html($subtitlePostTrend); ?></p>
                                                        <?php endif; ?>
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

                            <div class="container third-background-taxonomy pt-2 px-5">
                                <div class="container mt-4">

                                    <div class="col-12 d-flex flex-lg-row flex-column justify-content-start align-items-start container-card-category m-0 p-0 pt-3 mb-3">

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


                                            <div class="col-12 col-md-4 col-lg-3 col-xl-3 col-xxl-3 col-xxxl-3 d-flex flex-column justify-content-start align-items-center card-taxonomies-subcategory-academy-events m-0 p-0 mt-3 mb-3">
                                                <a class="custom-width" href="<?= esc_url(get_permalink($postActivityId) . '?module_id=' . $postActivityId . '&content_id=' . $index . '&tax=' . $taxId); ?>" style="text-decoration: none;">
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

                                    </div>
                                </div>
                            </div>

                        <?php endif; ?>

                    <?php endwhile; ?>
                <?php endif; ?>
            <?php endif; ?>



            <?php /* End Post display for Vision taxonomies */ ?>



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

                                <?php $SubtitleModule = get_field('Subtitle_Module_Courses'); ?>
                                <?php $postActivityId = get_the_ID(); ?>

                                <?php $listContentModules = get_field('list_of_content_module_Courses'); ?>

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
                                        <?php $secondTitleModuleAcademyCourse = $specificModule['Second_Title_Video_Mod']; ?>
                                        <?php $speakerModuleAcademy = $specificModule['Name_Speaker_Mod']; ?>
                                        <?php $descriptionModuleAcademy = $specificModule['Description_Module']; ?>
                                        <?php $urlModuleAcademy = $specificModule['URL_Video_Module']; ?>
                                        <?php $urlPdfModuleAcademy = $specificModule['URL_Pdf_Module_Courses']; ?>
                                        <?php $bannerContentModule = $specificModule['Banner_Content_Module']; ?>
                                        <?php $titleVideoContentMod = $specificModule['Title_Video_Content_Mod']; ?>
                                        <?php $DescriptionContentModule = $specificModule['Description_Content_Module']; ?>
                                        <?php $thumbnailUrl = obtenerMiniaturaVimeo($urlModuleAcademy);  ?>

                                        <div class="container background-single-init pt-2 px-5">
                                            <div class="mt-4">
                                                <?php if (isset($titleModuleAcademy) && !empty($titleModuleAcademy)) : ?>
                                                    <h3 class="NotoSans-Bold text-uppercase title-color"><?= esc_html($titleModuleAcademy); ?>
                                                        <?php if (isset($secondTitleModuleAcademyCourse) && !empty($secondTitleModuleAcademyCourse)) : ?>
                                                            - <?= esc_html($secondTitleModuleAcademyCourse); ?>
                                                        <?php endif; ?>
                                                    </h3>
                                                <?php endif; ?>


                                                <?php if (isset($descriptionModuleAcademy) && !empty($descriptionModuleAcademy)) : ?>
                                                    <p class="NotoSans-Regular description-color mt-3"><?= esc_html($descriptionModuleAcademy); ?></p>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                        <?php if (isset($urlPdfModuleAcademy) && !empty($urlPdfModuleAcademy)) : ?>

                                            <div class="container p-lg-5 pb-lg-0 p-1">
                                                <div class="container background-single p-2">
                                                    <div class="p-5">

                                                        <div class="col-lg-12">
                                                            <div class="row justify-content-center">
                                                                <div class="col-12 d-flex justify-content-center align-items-center flex-column mt-lg-5 mt-2 mb-5">
                                                                    <embed src="<?= $urlPdfModuleAcademy ?>" type="application/pdf" class="d-none d-lg-block" width="100%" height="100%" style="width: 90%; height: 100vh; border: none">
                                                                    <iframe src="https://drive.google.com/viewerng/viewer?embedded=true&url=<?= $urlPdfModuleAcademy ?>" class="d-block d-lg-none" style="width: 90%; height: 100vh;" frameborder="0"></iframe>

                                                                    <div class="w-75 btn-view-more mt-5 d-block d-lg-none">
                                                                        <a href="<?= $urlPdfModuleAcademy ?>" download class="text-decoration-none text-light">Descargar pdf</a>   
                                                                    </div> 

                                                                </div>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>
                                            </div>

                                        <?php endif ?>

                                        <?php if (isset($urlModuleAcademy) && !empty($urlModuleAcademy)) : ?>
                                            <div class="container third-background-taxonomy mt-lg-5 mt-4 p-5">
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
                                        <?php endif ?>



                                    <?php endif; ?>

                                    <div class="container mt-5">

                                        <?php foreach ($otherModules as $index => $listContentModule) : ?>

                                            <?php $imageModuleAcademy = $listContentModule['Img_Video_Mod']; ?>
                                            <?php $titleModuleAcademy = $listContentModule['Title_Video_Mod']; ?>
                                            <?php $secondTitleModuleAcademyCourse = $listContentModule['Second_Title_Video_Mod']; ?>
                                            <?php $speakerModuleAcademyCourse = $listContentModule['Name_Speaker_Mod']; ?>
                                            <?php $typeContentModuleAcademyCourse = $listContentModule['Type_Content_Course']; ?>
                                            <?php $timeContentModuleAcademyCourse = $listContentModule['Time_Content_Course']; ?>
                                            <?php $descriptionModuleAcademyCourse = $listContentModule['Description_Module']; ?>
                                            <?php $urlModuleAcademyCourse = $listContentModule['URL_Video_Module']; ?>
                                            <?php $thumbnailUrl = obtenerMiniaturaVimeo($urlModuleAcademyCourse);  ?>

                                            <a href="<?= esc_url(get_permalink($postActivityId) . '?module_id=' . $postActivityId . '&content_id=' . $index . '&tax=' . $taxId); ?>" class="session-a">
                                                <div class="session-row mb-3">
                                                    <div class="<?= ($counter % 2 === 0) ? 'session-icon' : 'session-second-icon'; ?>">
                                                        <?php if ($imageModuleAcademy) :  ?>
                                                            <div class="image">
                                                                <?php echo wp_get_attachment_image($imageModuleAcademy, 'full', '', ['style' => 'object-fit: fill']); ?>
                                                            </div>
                                                        <?php endif ?>
                                                        <?php if ($titleModuleAcademy) : ?>
                                                            <div class="NotoSans-Regular session-header text-uppercase"><?= $titleModuleAcademy; ?></div>
                                                        <?php endif; ?>
                                                    </div>
                                                    <?php if (isset($secondTitleModuleAcademyCourse) && !empty($secondTitleModuleAcademyCourse)) : ?>
                                                        <div class="session-content">
                                                            <div class="NotoSans-Regular session-header"><?= $secondTitleModuleAcademyCourse; ?></div>
                                                        </div>
                                                        <div class="session-second-content">
                                                            <?php if (isset($speakerModuleAcademyCourse) && !empty($speakerModuleAcademyCourse)) : ?>
                                                                <div class="NotoSans-Bold doctor"><?= $speakerModuleAcademyCourse; ?></div>
                                                            <?php endif ?>
                                                            <?php if (isset($typeContentModuleAcademyCourse) && !empty($typeContentModuleAcademyCourse)) : ?>
                                                                <div class="NotoSans-Regular session-subheader"><?= $typeContentModuleAcademyCourse; ?> |
                                                                    <?php if (isset($timeContentModuleAcademyCourse) && !empty($timeContentModuleAcademyCourse)) : ?>
                                                                        <?= $timeContentModuleAcademyCourse; ?>
                                                                    <?php endif ?>
                                                                </div>
                                                            <?php endif ?>
                                                        </div>
                                                    <?php else : ?>
                                                        <div class="session-content">
                                                            <div class="NotoSans-Bold doctor"><?= $speakerModuleAcademyCourse; ?></div>
                                                            <div class="NotoSans-Regular session-subheader"><?= $typeContentModuleAcademyCourse; ?> | <?= $timeContentModuleAcademyCourse; ?></div>
                                                        </div>
                                                        <div class="session-second-content-oth">
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            </a>

                                            <?php $counter++; ?>
                                        <?php endforeach; ?>

                                    </div>

                                <?php endif; ?>

                            <?php endwhile; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>


            <?php /* End Post display for Academia taxonomies */ ?>

        </div>
    </div>
        </div>

        <?php get_footer(); ?>