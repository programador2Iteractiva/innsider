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
                                <iframe src="https://drive.google.com/viewerng/viewer?embedded=true&url=<?= $pdfPostTrend ?>" class="d-block d-lg-none" style="width: 90%; height: 500px;" frameborder="0"></iframe>

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
                                <?php $IfSocialButtonModuleInnsider = get_field('If_Social_Button_Module_Innsider') ?>
                                <?php $ListOfSocialButtonModuleInnsider = get_field('List_Of_Social_Button_Module_Innsider') ?>

                                <?php if (isset($DescriptionModuleInnsider) && !empty($DescriptionModuleInnsider)) : ?>
                                    <h5 class="NotoSans-SemiBold title-color d-none d-lg-block mx-0 mt-0 m-4 text-info-video-speaker"><?= $DescriptionModuleInnsider; ?></h5>
                                    <p class="NotoSans-SemiBold title-color d-block d-lg-none mx-0 mt-0 m-4 text-info-video-speaker"><?= $DescriptionModuleInnsider; ?></p>
                                <?php endif ?>

                                <?php if (isset($IfSocialButtonModuleInnsider) && !empty($IfSocialButtonModuleInnsider)) : ?>
                                    <?php if (isset($ListOfSocialButtonModuleInnsider) && !empty($ListOfSocialButtonModuleInnsider)) : ?>

                                        <div class="d-flex justify-content-start align-items-center content-share-social-icons">
                                            <H5 class="me-4 NotoSans-Regular title-color text-share" style="text-decoration: underline;">Compartir</H5>
                                            <div class="buttons">
                                                <button class="main-button" style="color: white">
                                                    <svg width="30" height="30" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M15.75 5.125a3.125 3.125 0 1 1 .754 2.035l-8.397 3.9a3.124 3.124 0 0 1 0 1.88l8.397 3.9a3.125 3.125 0 1 1-.61 1.095l-8.397-3.9a3.125 3.125 0 1 1 0-4.07l8.397-3.9a3.125 3.125 0 0 1-.144-.94Z"></path>
                                                    </svg>
                                                </button>

                                                <?php if (isset($IfSocialButtonModuleInnsider) && !empty($IfSocialButtonModuleInnsider)) : ?>
                                                    <?php if (isset($ListOfSocialButtonModuleInnsider) && !empty($ListOfSocialButtonModuleInnsider)) : ?>
                                                        <?php foreach ($ListOfSocialButtonModuleInnsider as $index => $ListOfSocialButton) : ?>

                                                            <?php $ClassButtonSocialModuleInnsider = $ListOfSocialButton['Class_Button_Social_Module_Innsider']; ?>
                                                            <?php $SVGSocialModuleInnsider = $ListOfSocialButton['SVG_Social_Module_Innsider']; ?>
                                                            <?php $UrlSpeakerModuleInnsider = $ListOfSocialButton['Url_Speaker_Module_Innsider']; ?>

                                                            <button class="class-btn-social <?= htmlspecialchars($ClassButtonSocialModuleInnsider); ?> button" data-index="<?= $index; ?>">
                                                                <a class="url-redirect-btn-social" data-index="<?= $index; ?>" href="<?= htmlspecialchars($UrlSpeakerModuleInnsider); ?>" target="_blank" style="text-decoration: none; color: black;">
                                                                    <span class="svg-btn-social" data-index="<?= $index; ?>"><?= $SVGSocialModuleInnsider; ?></span>
                                                                </a>
                                                            </button>

                                                        <?php endforeach; ?>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>

                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php if (isset($IfSpeakerModuleInnsider) && !empty($IfSpeakerModuleInnsider)) : ?>
                                    <?php if (isset($ListOfSpeakerModuleInnsider) && !empty($ListOfSpeakerModuleInnsider)) : ?>

                                        <?php $count = 0; ?>

                                        <h1 class="NotoSans-Bold title-color mx-0 m-4">Expertos</h1>


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
                                                            <span class="span-icon-accordeon" x-text="open === <?= $index ?> ? '-' : '+'"></span>
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

                                                <?php $IfSocialButtonModuleInnsider = get_field('If_Social_Button_Module_Innsider', $postActivityId) ?>
                                                <?php $ListOfSocialButtonModuleInnsider = get_field('List_Of_Social_Button_Module_Innsider', $postActivityId) ?>

                                                <?php $contentRegister = get_post_meta($postActivityId, 'Content_Register', true); ?>

                                                <?php $thePermalink = get_the_permalink(); ?>
                                                <?php $taxonomies = get_object_taxonomies(get_post_type($postActivityId)); ?>

                                                <?php $terms = get_the_terms($postActivityId, $taxonomies[0]); ?>

                                                <?php $completePermalink = $thePermalink . '?module_id=' . urlencode($postActivityId) . '&content_id=' . urlencode($postIndex) . '&tax=' . urlencode($terms[0]->term_id); ?>

                                                <?php if ($contentRegister === '1') : ?>

                                                    <?php if (!is_user_logged_in()) : ?>

                                                        <?php $login_url = wp_login_url($completePermalink); ?>
                                                        <?php $link = $login_url; ?>


                                                        <div class="col-12 col-md-4 col-lg-3 col-xl-3 col-xxl-3 col-xxxl-3 d-flex flex-column justify-content-start align-items-center card-single-post-podcast m-0 p-0 mt-3 mb-3">
                                                            <a class="custom-width-single item-playlist-videos" id="video-<?= $postIndex ?>"
                                                                onclick="redirectVideo('<?= $link; ?>'); saveLogsClick('redirect a `<?= the_title(); ?>`');">
                                                                <div class="mb-4 figure">
                                                                    <?php if (isset($thumbnailUrlVisionInnsider) && !empty($thumbnailUrlVisionInnsider)) : ?>
                                                                        <img src="<?= esc_url($thumbnailUrlVisionInnsider); ?>" alt="Herramientas" class="bg-single" style="object-fit:cover">
                                                                    <?php endif ?>
                                                                </div>
                                                                <div class="mt-1 p-0">
                                                                    <div class="w-75 p-2 mb-4 btn-view-now">
                                                                        <i class="fa-regular fa-circle-play mx-2"></i>
                                                                        Ver ahora 1
                                                                    </div>
                                                                    <h5 class="NotoSans-Bold title-color"><?= the_title(); ?></h5>
                                                                    <?php if (isset($subtitlePostTrend) && !empty($subtitlePostTrend)) : ?>
                                                                        <p class="NotoSans-Regular description-color"><?= esc_html($subtitlePostTrend); ?></p>
                                                                    <?php endif; ?>
                                                                </div>
                                                                <input type="hidden" class="name-playlist-video" value="<?= esc_html(the_title()) ?>">
                                                                <input type="hidden" id="description_video" value="<?= $descriptionModuleInnsider ?>">

                                                                <?php if (isset($ListOfSpeakerModuleInnsider) && !empty($ListOfSpeakerModuleInnsider)) : ?>

                                                                    <?php foreach ($ListOfSpeakerModuleInnsider as $index => $speaker) : ?>

                                                                        <?php $imageSpeakerModuleInnsider = $speaker['Img_Speaker_Module_Innsider']; ?>
                                                                        <?php $nameSpeakerModuleInnsider = $speaker['Name_Speaker_Module_Innsider']; ?>
                                                                        <?php $credentialsSpeakerModuleInnsider = $speaker['Credentials_Speaker_Module_Innsider']; ?>


                                                                        <input type="hidden" class="name-speaker" data-index="<?= $index ?>" value="<?= htmlspecialchars($nameSpeakerModuleInnsider) ?>">
                                                                        <input type="hidden" class="credentials-speaker" data-index="<?= $index ?>" value="<?= htmlspecialchars($credentialsSpeakerModuleInnsider) ?>">


                                                                    <?php endforeach; ?>

                                                                <?php endif; ?>

                                                                <?php if (isset($IfSocialButtonModuleInnsider) && !empty($IfSocialButtonModuleInnsider)) : ?>
                                                                    <?php if (isset($ListOfSocialButtonModuleInnsider) && !empty($ListOfSocialButtonModuleInnsider)) : ?>
                                                                        <?php foreach ($ListOfSocialButtonModuleInnsider as $index => $ListOfSocialButton) : ?>

                                                                            <?php $ClassButtonSocialModuleInnsider = $ListOfSocialButton['Class_Button_Social_Module_Innsider']; ?>
                                                                            <?php $SVGSocialModuleInnsider = $ListOfSocialButton['SVG_Social_Module_Innsider']; ?>
                                                                            <?php $UrlSpeakerModuleInnsider = $ListOfSocialButton['Url_Speaker_Module_Innsider']; ?>

                                                                            <input type="hidden" class="class-btn-social" data-index="<?= $index ?>" value="<?= htmlspecialchars($ClassButtonSocialModuleInnsider) ?>">
                                                                            <input type="hidden" class="svg-btn-social" data-index="<?= $index ?>" value="<?= htmlspecialchars($SVGSocialModuleInnsider) ?>">
                                                                            <input type="hidden" class="url-redirect-btn-social" data-index="<?= $index ?>" value="<?= htmlspecialchars($UrlSpeakerModuleInnsider) ?>">

                                                                        <?php endforeach; ?>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            </a>
                                                        </div>

                                                    <?php else : ?>

                                                        <div class="col-12 col-md-4 col-lg-3 col-xl-3 col-xxl-3 col-xxxl-3 d-flex flex-column justify-content-start align-items-center card-single-post-podcast m-0 p-0 mt-3 mb-3">
                                                            <a class="custom-width-single item-playlist-videos" id="video-<?= $postIndex ?>" onclick="playVideo(<?= the_ID() ?>, '<?= get_field('URL_Post_Content_Module_Video_vision_innsider') ?>', event, 'item-playlist-videos', <?= $postIndex ?>); saveLogsClick('Clic en tarjeta `<?= the_title(); ?>`');">
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

                                                                <?php if (isset($ListOfSpeakerModuleInnsider) && !empty($ListOfSpeakerModuleInnsider)) : ?>

                                                                    <?php foreach ($ListOfSpeakerModuleInnsider as $index => $speaker) : ?>

                                                                        <?php $imageSpeakerModuleInnsider = $speaker['Img_Speaker_Module_Innsider']; ?>
                                                                        <?php $nameSpeakerModuleInnsider = $speaker['Name_Speaker_Module_Innsider']; ?>
                                                                        <?php $credentialsSpeakerModuleInnsider = $speaker['Credentials_Speaker_Module_Innsider']; ?>


                                                                        <input type="hidden" class="name-speaker" data-index="<?= $index ?>" value="<?= htmlspecialchars($nameSpeakerModuleInnsider) ?>">
                                                                        <input type="hidden" class="credentials-speaker" data-index="<?= $index ?>" value="<?= htmlspecialchars($credentialsSpeakerModuleInnsider) ?>">


                                                                    <?php endforeach; ?>

                                                                <?php endif; ?>


                                                                <?php if (isset($IfSocialButtonModuleInnsider) && !empty($IfSocialButtonModuleInnsider)) : ?>
                                                                    <?php if (isset($ListOfSocialButtonModuleInnsider) && !empty($ListOfSocialButtonModuleInnsider)) : ?>
                                                                        <?php foreach ($ListOfSocialButtonModuleInnsider as $index => $ListOfSocialButton) : ?>

                                                                            <?php $ClassButtonSocialModuleInnsider = $ListOfSocialButton['Class_Button_Social_Module_Innsider']; ?>
                                                                            <?php $SVGSocialModuleInnsider = $ListOfSocialButton['SVG_Social_Module_Innsider']; ?>
                                                                            <?php $UrlSpeakerModuleInnsider = $ListOfSocialButton['Url_Speaker_Module_Innsider']; ?>

                                                                            <input type="hidden" class="class-btn-social" data-index="<?= $index ?>" value="<?= htmlspecialchars($ClassButtonSocialModuleInnsider) ?>">
                                                                            <input type="hidden" class="svg-btn-social" data-index="<?= $index ?>" value="<?= htmlspecialchars($SVGSocialModuleInnsider) ?>">
                                                                            <input type="hidden" class="url-redirect-btn-social" data-index="<?= $index ?>" value="<?= htmlspecialchars($UrlSpeakerModuleInnsider) ?>">

                                                                        <?php endforeach; ?>
                                                                    <?php endif; ?>
                                                                <?php endif; ?>
                                                            </a>
                                                        </div>

                                                    <?php endif ?>

                                                <?php else : ?>

                                                    <div class="col-12 col-md-4 col-lg-3 col-xl-3 col-xxl-3 col-xxxl-3 d-flex flex-column justify-content-start align-items-center card-single-post-podcast m-0 p-0 mt-3 mb-3">
                                                        <a class="custom-width-single item-playlist-videos" id="video-<?= $postIndex ?>" onclick="playVideo(<?= the_ID() ?>, '<?= get_field('URL_Post_Content_Module_Video_vision_innsider') ?>', event, 'item-playlist-videos', <?= $postIndex ?>); saveLogsClick('Clic en tarjeta `<?= the_title(); ?>`');">
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

                                                            <?php if (isset($ListOfSpeakerModuleInnsider) && !empty($ListOfSpeakerModuleInnsider)) : ?>

                                                                <?php foreach ($ListOfSpeakerModuleInnsider as $index => $speaker) : ?>

                                                                    <?php $imageSpeakerModuleInnsider = $speaker['Img_Speaker_Module_Innsider']; ?>
                                                                    <?php $nameSpeakerModuleInnsider = $speaker['Name_Speaker_Module_Innsider']; ?>
                                                                    <?php $credentialsSpeakerModuleInnsider = $speaker['Credentials_Speaker_Module_Innsider']; ?>


                                                                    <input type="hidden" class="name-speaker" data-index="<?= $index ?>" value="<?= htmlspecialchars($nameSpeakerModuleInnsider) ?>">
                                                                    <input type="hidden" class="credentials-speaker" data-index="<?= $index ?>" value="<?= htmlspecialchars($credentialsSpeakerModuleInnsider) ?>">


                                                                <?php endforeach; ?>

                                                            <?php endif; ?>


                                                            <?php if (isset($IfSocialButtonModuleInnsider) && !empty($IfSocialButtonModuleInnsider)) : ?>
                                                                <?php if (isset($ListOfSocialButtonModuleInnsider) && !empty($ListOfSocialButtonModuleInnsider)) : ?>
                                                                    <?php foreach ($ListOfSocialButtonModuleInnsider as $index => $ListOfSocialButton) : ?>

                                                                        <?php $ClassButtonSocialModuleInnsider = $ListOfSocialButton['Class_Button_Social_Module_Innsider']; ?>
                                                                        <?php $SVGSocialModuleInnsider = $ListOfSocialButton['SVG_Social_Module_Innsider']; ?>
                                                                        <?php $UrlSpeakerModuleInnsider = $ListOfSocialButton['Url_Speaker_Module_Innsider']; ?>

                                                                        <input type="hidden" class="class-btn-social" data-index="<?= $index ?>" value="<?= htmlspecialchars($ClassButtonSocialModuleInnsider) ?>">
                                                                        <input type="hidden" class="svg-btn-social" data-index="<?= $index ?>" value="<?= htmlspecialchars($SVGSocialModuleInnsider) ?>">
                                                                        <input type="hidden" class="url-redirect-btn-social" data-index="<?= $index ?>" value="<?= htmlspecialchars($UrlSpeakerModuleInnsider) ?>">

                                                                    <?php endforeach; ?>
                                                                <?php endif; ?>
                                                            <?php endif; ?>
                                                        </a>
                                                    </div>

                                                <?php endif ?>

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

            <?php $termSingle = get_term($taxId); ?>
            <?php $codePromomats = get_field('description_complementary', $termSingle) ?>

            <div class="container m-lg-5 mx-lg-auto m-3 px-0">
                <?php if (isset($codePromomats) && !empty($codePromomats)) : ?>
                    <h5 class="NotoSans-Bold title-color"><?= $codePromomats; ?></h5>
                <?php endif ?>
            </div>

        <?php endif; ?>
    <?php endif; ?>

    <?php /* Post display for Tools Post Types */ ?>

    <?php $listPostTools = new WP_Query(
        array(
            'post_type' => 'herramientas',
            'posts_per_page' => -1,
            'order' => 'ASC'
        )
    );
    ?>

    <?php $postsIds = wp_list_pluck($listPostTools->posts, 'ID') ?>

    <?php if (is_single() && in_array($currentPostId, $postsIds)) : ?>

        <?php $contentRegister = get_post_meta($currentPostId, 'Content_Register', true); ?>
        <?php $thePermalink = get_the_permalink(); ?>
        <?php $titlePostTools = get_the_title(); ?>
        <?php $bannerPostTools = get_field('Banner_Post_Tools'); ?>
        <?php $ifPostTrendWithDiferentOptions = get_field('If_Post_Trend_With_Diferent_Options'); ?>
        <?php $contentPostTrendWithDifferentOptions = get_field('Content_Post_Trend_With_Different_Options');  ?>
        <?php $codePromomats = get_field('code_promomats');  ?>
        <?php $ifPostToolsVideo = get_field('If_Post_Tools_Video');  ?>
        <?php $uRLPostTools = get_field('URL_Post_Tools');  ?>
        <?php $colorSectionURLPostTools = get_field('Seccion_Color_Post_Tools'); ?>
        <?php $ifPostToolsPdf = get_field('If_Post_Tools_Pdf');  ?>
        <?php $pdfPostTools = get_field('Pdf_Post_Tools');  ?>
        <?php $colorSectionPdfPostTools = get_field('Seccion_Color_Pdf_Post_Tools'); ?>
        <?php $thumbnailUrlPostTools = obtenerMiniaturaVimeo($uRLPostTools);  ?>

        <?php if ($contentRegister === '1') : ?>

            <?php if (!is_user_logged_in()) : ?>

                <?php $login_url = wp_login_url($thePermalink); ?>
                <?php $link = $login_url; ?>
                <script>
                    window.location.href = '<?php echo $link; ?>';
                </script>

            <?php endif ?>

        <?php endif; ?>

        <?php if (isset($ifPostTrendWithDiferentOptions) && !empty($ifPostTrendWithDiferentOptions)) : ?>
            <?php if (isset($contentPostTrendWithDifferentOptions) && !empty($contentPostTrendWithDifferentOptions)) : ?>

                <?php if (have_rows('Content_Post_Trend_With_Different_Options')) : ?>
                    <?php while (have_rows('Content_Post_Trend_With_Different_Options')) : the_row() ?>

                        <?php /* Description To Banner */  ?>
                        <?php $descriptionBannerPostTrendContent = get_sub_field('Description_Banner_Post_Trend_Content'); ?>

                        <?php if (isset($descriptionBannerPostTrendContent) && !empty($descriptionBannerPostTrendContent)) : ?>

                            <div class="container four-background-taxonomy mt-lg-3 mt-3 p-lg-5 p-2 pb-lg-0 pb-2">
                                <div class="container container-bg-single banner-taxonomy-academy" data-aos="zoom-in">
                                    <?php if (isset($bannerPostTools) && !empty($bannerPostTools)) : ?>
                                        <img src="<?= esc_url(wp_get_attachment_url($bannerPostTools)); ?>" alt="Herramientas" class="bg-single-trend">
                                    <?php endif; ?>
                                    <div class="wrapper-taxonomy-academy"></div>
                                </div>
                                <div class="container">
                                    <div class="row m-0 p-0">
                                        <?php if (isset($descriptionBannerPostTrendContent) && !empty($descriptionBannerPostTrendContent)) : ?>
                                            <p class="NotoSans-Regular text-align-justify mb-lg-4 mb-4 container-content-single mx-auto mt-4">
                                                <?= strip_tags($descriptionBannerPostTrendContent, '<strong><em><ul><li><blockquote><a><br>'); ?>
                                            </p>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>

                        <?php endif; ?>

                    <?php endwhile; ?>
                <?php endif; ?>

            <?php endif; ?>

        <?php endif; ?>

        <?php if (isset($bannerPostTools) && !empty($bannerPostTools)) : ?>
            <?php if (isset($ifPostToolsPdf) && !empty($ifPostToolsPdf)) : ?>

                <div class="container banner-academy" data-aos="zoom-in">
                    <img class="bg-banner-academy" src="<?php echo wp_get_attachment_image_url($bannerPostTools, 'full', ''); ?>" alt="Podcast">
                    <div class="wrapper-banner-academy">
                        <div class="container-text-banner-academy"></div>
                        <!-- <h4 class="text-white mt-3"><?php the_content(); ?></h4>
                    <div class="container-text-banner-academy w-100 h-100 m-auto d-flex justify-content-lg-start align-items-center">
                        <img src="<?= get_template_directory_uri() . '/assets/images/Icono-innsider-white.png'; ?>" alt="Herramientas" class="bg-banner-single-category">
                    </div> -->

                    </div>
                </div>

            <?php endif ?>

        <?php endif; ?>

        <?php if (isset($ifPostToolsVideo) && !empty($ifPostToolsVideo)) : ?>
            <?php if (isset($uRLPostTools) && !empty($uRLPostTools)) : ?>

                <div class="container background-taxonomy px-5 pt-5" <?php echo $colorSectionURLPostTools ? 'data-bg-color="' . esc_attr($colorSectionURLPostTools) . '"' : ''; ?>>
                    <div class="container banner-single preview-video mt-lg-5 mt-4"
                        onclick="playVideo(<?= $currentPostId ?>, '<?= $uRLPostTools; ?>', event, 'preview-video')">
                        <?php if (isset($thumbnailUrlPostTools) && !empty($thumbnailUrlPostTools)) : ?>
                            <img src="<?= esc_url($thumbnailUrlPostTools); ?>" alt="Herramientas" class="bg-single">
                        <?php elseif (isset($bannerPostTools) && !empty($bannerPostTools)) : ?>
                            <img src="<?= esc_url(wp_get_attachment_url($bannerPostTools)); ?>" alt="Herramientas" class="bg-single">
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
                                        <h1 class="NotoSans-Bold title-color mb-5 pb-2 name-info-video-speaker"><?php the_title(); ?></h1>

                                        <?php if (have_rows('Content_Post_Tools')) : ?>

                                            <?php while (have_rows('Content_Post_Tools')) : the_row() ?>

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

        <?php elseif (isset($ifPostToolsPdf) && !empty($ifPostToolsPdf)) : ?>

            <?php if (isset($pdfPostTools) && !empty($pdfPostTools)) : ?>

                <div class="container p-lg-5 pb-lg-0 p-1">
                    <div class="container background-single p-2" <?php echo $colorSectionPdfPostTools ? 'data-bg-color="' . esc_attr($colorSectionPdfPostTools) . '"' : ''; ?>>
                        <div class="p-4 pt-3 pt-lg-5 w-100">

                            <h1 class="NotoSans-Bold title-color mb-5 pb-2 d-none d-lg-block"><?php the_title(); ?></h1>
                            <h5 class="NotoSans-Bold title-color mb-2 pb-2 d-block d-lg-none"><?php the_title(); ?></h5>

                            <div class="col-lg-12">
                                <div class="row justify-content-center">
                                    <div class="col-12 d-flex justify-content-center align-items-center flex-column mt-lg-5 mt-2 mb-5">
                                        <embed src="<?= $pdfPostTools ?>" type="application/pdf" class="d-none d-lg-block" width="100%" height="100%" style="width: 90%; height: 100vh; border: none">
                                        <iframe src="https://drive.google.com/viewerng/viewer?embedded=true&url=<?= $pdfPostTools ?>" class="d-block d-lg-none" style="width: 100%; height: 500px;" frameborder="0"></iframe>

                                        <div class="w-75 btn-view-more mt-5 d-block d-lg-none">
                                            <a href="<?= $pdfPostTools ?>" download class="text-decoration-none text-light">Descargar PDF</a>
                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

            <?php endif; ?>

        <?php elseif (isset($ifPostTrendWithDiferentOptions) && !empty($ifPostTrendWithDiferentOptions)) : ?>

            <?php if (isset($contentPostTrendWithDifferentOptions) && !empty($contentPostTrendWithDifferentOptions)) : ?>

                <?php if (have_rows('Content_Post_Trend_With_Different_Options')) : ?>
                    <?php while (have_rows('Content_Post_Trend_With_Different_Options')) : the_row() ?>

                        <?php /* Content With Background Color */  ?>
                        <?php $ifPostTrendContentColor = get_sub_field('If_Post_Trend_Content_Color'); ?>
                        <?php $contentPostTrendColor = get_sub_field('Content_Post_Trend_Color'); ?>

                        <?php if (isset($ifPostTrendContentColor) && !empty($ifPostTrendContentColor)) : ?>
                            <?php if (isset($contentPostTrendColor) && !empty($contentPostTrendColor)) : ?>

                                <?php if (have_rows('Content_Post_Trend_Color')) : ?>

                                    <?php while (have_rows('Content_Post_Trend_Color')) : the_row()  ?>

                                        <?php /* Image - Title  /  Content With Background Color */  ?>
                                        <?php $ifPostTrendContentImageTitleColor = get_sub_field('If_Post_Trend_Content_Image_Title'); ?>
                                        <?php $contentPostTrendContentImageTitleColor = get_sub_field('Content_Post_Trend_Content_Image_Title'); ?>
                                        <?php $seccionColorContentPostTrendContentImageTitle = get_sub_field('Seccion_Color_Content_Post_Trend_Content_Image_Title'); ?>

                                        <?php if (isset($ifPostTrendContentImageTitleColor) && !empty($ifPostTrendContentImageTitleColor)) : ?>

                                            <div class="" style="position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; width: 100vw; background-color: <?= $seccionColorContentPostTrendContentImageTitle ?>; margin-top: 1rem; margin-botton: 2rem;">

                                                <div class="container mx-auto px-lg-0 px-4">
                                                    <div class="p-0 w-100 px-0">
                                                        <div class="col-12 p-0 pb-lg-0 pt-0 pb-0">
                                                            <div class="row">

                                                                <?php if (have_rows('Content_Post_Trend_Content_Image_Title')) : ?>

                                                                    <?php while (have_rows('Content_Post_Trend_Content_Image_Title')) : the_row() ?>

                                                                        <?php $titleContentPostTrendContentImageTitleColor = get_sub_field('Title_Content_Post_Trend_Content_Image_Title'); ?>
                                                                        <?php $imageContentPostTrendContentImageTitleColor = get_sub_field('Image__Content_Post_Trend_Content_Image_Title'); ?>

                                                                        <h2 class="NotoSans-Bold title-color mb-4 pt-4">
                                                                            <?= strip_tags($titleContentPostTrendContentImageTitleColor); ?>
                                                                        </h2>
                                                                        <div class="d-flex justify-content-start align-items-center">
                                                                            <div class="col-12 col-lg-12">
                                                                                <?= wp_get_attachment_image($imageContentPostTrendContentImageTitleColor, 'full', '', ['class' => '', 'style' => 'width: 100%; height: 100%; object-fit: cover;']); ?>
                                                                            </div>
                                                                        </div>

                                                                    <?php endwhile; ?>

                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        <?php endif; ?>


                                        <?php /* Title - Description  /  Content With Background Color */  ?>
                                        <?php $ifPostTrendContentTitleDescriptionColor = get_sub_field('If_Post_Trend_Content_Title_Description'); ?>
                                        <?php $contentPostTrendContentTitleDescriptionColor = get_sub_field('Content_Post_Trend_Content_Title_Description'); ?>
                                        <?php $seccionColorContentPostTrendContentTitleDescription = get_sub_field('Seccion_Color_Content_Post_Trend_Content_Title_Description'); ?>

                                        <?php if (isset($ifPostTrendContentTitleDescriptionColor) && !empty($ifPostTrendContentTitleDescriptionColor)) : ?>

                                            <div class="" style="position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; width: 100vw; background-color: <?= $seccionColorContentPostTrendContentTitleDescription ?>; margin-top: 1rem; margin-botton: 2rem;">

                                                <div class="container mx-auto px-lg-0 px-4">
                                                    <div class="p-5 pt-3 pt-lg-5 w-100 px-0">
                                                        <div class="col-12 p-0">
                                                            <div class="row">
                                                                <?php $counter = 0 ?>
                                                                <?php if (have_rows('Content_Post_Trend_Content_Title_Description')) : ?>

                                                                    <?php while (have_rows('Content_Post_Trend_Content_Title_Description')) : the_row() ?>

                                                                        <?php $titleContentPostTrendContentTitleDescriptionColor = get_sub_field('Title_Content_Post_Trend_Content_Title_Description'); ?>
                                                                        <?php $descriptioncontentPostTrendContentTitleDescriptionColor = get_sub_field('Description_Content_Post_Trend_Content_Title_Description'); ?>

                                                                        <h2 class="NotoSans-Bold title-color mb-4 <?= $counter > 0 ? 'pt-4' : ''; ?>">
                                                                            <?= strip_tags($titleContentPostTrendContentTitleDescriptionColor); ?>
                                                                        </h2>
                                                                        <div class="NotoSans-Regular description-color px-2">
                                                                            <?= strip_tags($descriptioncontentPostTrendContentTitleDescriptionColor, '<strong><em><ul><li><blockquote><a><br>'); ?>
                                                                        </div>

                                                                        <?php $counter++ ?>
                                                                    <?php endwhile; ?>

                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        <?php endif; ?>


                                        <?php /* Title - Image - Others  /  Content With Background Color */  ?>
                                        <?php $ifPostTrendContentTitleImageDescriptionColor = get_sub_field('If_Post_Trend_Content_Title_Image_Description'); ?>
                                        <?php $contentPostTrendContentTitleImageDescriptionColor = get_sub_field('Content_Post_Trend_Content_Title_Image_Description'); ?>
                                        <?php $seccionColorContentPostTrendContentTitleImageDescription = get_sub_field('Seccion_Color_Content_Post_Trend_Content_Title_Image_Description'); ?>

                                        <?php if (isset($ifPostTrendContentTitleImageDescriptionColor) && !empty($ifPostTrendContentTitleImageDescriptionColor)) : ?>

                                            <div class="" style="position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; width: 100vw; background-color: <?= $seccionColorContentPostTrendContentTitleImageDescription ?>; margin-top: 1rem; margin-botton: 2rem; z-index: 2;">

                                                <div class="container mx-auto px-lg-0 px-4">
                                                    <div class="p-0 w-100 px-0">
                                                        <div class="col-12 p-0 pt-0 pb-0">
                                                            <div class="row">
                                                                <?php if (have_rows('Content_Post_Trend_Content_Title_Image_Description')) : ?>

                                                                    <?php while (have_rows('Content_Post_Trend_Content_Title_Image_Description')) : the_row() ?>

                                                                        <?php $titleContentPostTrendContentTitleImageDescriptionColor = get_sub_field('Title_Content_Post_Trend_Content_Title_Image_Description'); ?>
                                                                        <?php $titleColorContent = get_sub_field('Title_Color_Content_Post_Trend_Content_Title_Image_Description'); ?>
                                                                        <?php $backgroundTitleColor = get_sub_field('Background_Title_Color_Content_Post_Trend_Content_Title_Image_Description_copy'); ?>
                                                                        <?php $firstDescriptionContentPostTrendContentTitleImageDescriptionColor = get_sub_field('First_Description_Content_Post_Trend_Content_Title_Image_Description'); ?>
                                                                        <?php $secondDescriptionContentPostTrendContentTitleImageDescriptionColor = get_sub_field('Second_Description_Content_Post_Trend_Content_Title_Image_Description'); ?>
                                                                        <?php $imageContentPostTrendContentTitleImageDescriptionColor = get_sub_field('Image_Content_Post_Trend_Content_Title_Image_Description'); ?>
                                                                        <?php $lastDescriptionContentPostTrendContentTitleImageDescriptionColor = get_sub_field('Last_Description_Content_Post_Trend_Content_Title_Image_Description'); ?>


                                                                        <h2 class="NotoSans-Bold title-color mb-4 pt-4 position-relative">
                                                                            <span class="background-title-round" <?php echo $backgroundTitleColor ? 'data-bg-color="' . esc_attr($backgroundTitleColor) . '"' : ''; ?> style="color: <?= $titleColorContent ?> !important"><?= strip_tags($titleContentPostTrendContentTitleImageDescriptionColor); ?></span>
                                                                        </h2>
                                                                        <div class="NotoSans-Regular description-color px-2 mt-2 pb-2">
                                                                            <?= strip_tags($firstDescriptionContentPostTrendContentTitleImageDescriptionColor, '<strong><em><ul><li><blockquote><a><br><h1><h2><h3><h4><h5>'); ?>
                                                                        </div>
                                                                        <div class="NotoSans-Regular description-color px-2 mt-2 pb-3">
                                                                            <?= strip_tags($secondDescriptionContentPostTrendContentTitleImageDescriptionColor, '<strong><em><ul><li><blockquote><a><br><h1><h2><h3><h4><h5>'); ?>
                                                                        </div>
                                                                        <div class="d-flex justify-content-center align-items-center">
                                                                            <div class="col-12 col-lg-10">
                                                                                <?= wp_get_attachment_image($imageContentPostTrendContentTitleImageDescriptionColor, 'full', '', ['class' => '', 'style' => 'width: 100%; height: 100%; object-fit: cover;']); ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="NotoSans-Regular description-color px-2 mb-4 pt-4">
                                                                            <?= strip_tags($lastDescriptionContentPostTrendContentTitleImageDescriptionColor, '<strong><em><ul><li><blockquote><a><br><div><span><h1><h2><h3><h4><h5><style>'); ?>
                                                                        </div>

                                                                    <?php endwhile; ?>

                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        <?php endif; ?>


                                        <?php /* Content with Subcontent  /  Content With Background Color */  ?>
                                        <?php $ifPostTrendContentSubcontentColor = get_sub_field('If_Post_Trend_Content_Subcontent'); ?>
                                        <?php $contentPostTrendSubcontentColor = get_sub_field('Content_Post_Trend_Subcontent'); ?>
                                        <?php $seccionColorContentPostTrendSubcontent = get_sub_field('Seccion_Color_Content_Post_Trend_Subcontent'); ?>


                                        <?php if (isset($ifPostTrendContentSubcontentColor) && !empty($ifPostTrendContentSubcontentColor)) : ?>

                                            <div class="" style="position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; width: 100vw; background-color: <?= $seccionColorContentPostTrendSubcontent ?>; margin-top: 1rem; margin-bottom: 2rem;">

                                                <div class="container mx-auto px-lg-0 px-4">
                                                    <div class="p-5 pt-3 w-100 px-0">
                                                        <div class="col-12 p-lg-5 p-3 pt-lg-0 pb-lg-0 pt-0 pb-0">
                                                            <div class="row">
                                                                <?php if (have_rows('Content_Post_Trend_Subcontent')) : ?>

                                                                    <?php while (have_rows('Content_Post_Trend_Subcontent')) : the_row() ?>

                                                                        <?php $titleContentPostTrendSubcontentColor = get_sub_field('Title_Content_Post_Trend_Subcontent'); ?>
                                                                        <?php $subcontentPostTrendColor = get_sub_field('Subcontent_Post_Trend'); ?>

                                                                        <h2 class="NotoSans-Bold title-color mb-4 pt-4">
                                                                            <?= strip_tags($titleContentPostTrendSubcontentColor); ?>
                                                                        </h2>
                                                                        <div class="container mx-auto px-0">
                                                                            <div class="p-5 pt-3 w-100 px-0">
                                                                                <div class="col-12 p-lg-5 p-3 pt-lg-0 pb-lg-0 pt-0 pb-0">
                                                                                    <div class="row">
                                                                                        <?php if (have_rows('Subcontent_Post_Trend')) : ?>

                                                                                            <?php while (have_rows('Subcontent_Post_Trend')) : the_row() ?>

                                                                                                <?php $titleSubcontentPostTrendColor = get_sub_field('Title_Subcontent_Post_Trend'); ?>
                                                                                                <?php $imageSubcontentPostTrendColor = get_sub_field('Image_Subcontent_Post_Trend'); ?>
                                                                                                <?php $firstDescriptionSubcontentPostTrendColor = get_sub_field('First_Description_Subcontent_Post_Trend'); ?>

                                                                                                <h3 class="NotoSans-Bold title-color mb-4 pt-4 text-center">
                                                                                                    <?= strip_tags($titleSubcontentPostTrendColor); ?>
                                                                                                </h3>

                                                                                                <div class="d-flex flex-md-row flex-column position-relative justify-content-center align-items-center">
                                                                                                    <div class="col-md-4 col-lg-4" style="border-radius: 1rem;">
                                                                                                        <div class="col-12">
                                                                                                            <?= wp_get_attachment_image($imageSubcontentPostTrendColor, 'full', '', ['style' => 'height: 170px;width: 100%;object-fit: contain;']); ?>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-8 col-lg-8 d-flex justify-content-center align-items-center">
                                                                                                        <div class="col-11 col-md-12 col-lg-12 p-0 m-0 pt-4 pb-4">
                                                                                                            <div class="container-title-speaker-content-out mx-lg-5 ms-3">
                                                                                                                <div class="container-content-outstanding">
                                                                                                                    <p class="NotoSans-Regular container-title-speaker-content-outstanding">
                                                                                                                        <?= strip_tags($firstDescriptionSubcontentPostTrendColor, '<strong><em><ul><li><blockquote><a><br>'); ?>
                                                                                                                    </p>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>

                                                                                            <?php endwhile; ?>

                                                                                        <?php endif; ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    <?php endwhile; ?>

                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        <?php endif; ?>


                                    <?php endwhile; ?>

                                <?php endif; ?>

                            <?php endif; ?>
                        <?php endif; ?>


                        <?php /* Content Without Background Color */  ?>
                        <?php $ifPostTrendContentWithoutColor = get_sub_field('If_Post_Trend_Content_Without_Color'); ?>
                        <?php $contentPostTrendWithoutColor = get_sub_field('Content_Post_Trend_Without_Color_c'); ?>

                        <?php if (isset($ifPostTrendContentWithoutColor) && !empty($ifPostTrendContentWithoutColor)) : ?>
                            <?php if (isset($contentPostTrendWithoutColor) && !empty($contentPostTrendWithoutColor)) : ?>

                                <?php if (have_rows('Content_Post_Trend_Without_Color_c')) : ?>

                                    <?php while (have_rows('Content_Post_Trend_Without_Color_c')) : the_row()  ?>

                                        <?php /* Title - Image  /  Content With Background Color */  ?>
                                        <?php $ifPostTrendContentImageTitle = get_sub_field('If_Post_Trend_Content_Image_Title'); ?>
                                        <?php $contentPostTrendContentImageTitle = get_sub_field('Content_Post_Trend_Content_Image_Title'); ?>

                                        <?php if (isset($ifPostTrendContentImageTitle) && !empty($ifPostTrendContentImageTitle)) : ?>

                                            <div class="" style="position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; width: 100vw; background-color: white;">

                                                <div class="container mx-auto px-lg-0 px-4">
                                                    <div class="p-0 w-100 px-0">
                                                        <div class="col-12 p-0 pt-0 pb-0">
                                                            <div class="row">

                                                                <?php if (have_rows('Content_Post_Trend_Content_Image_Title')) : ?>

                                                                    <?php while (have_rows('Content_Post_Trend_Content_Image_Title')) : the_row() ?>

                                                                        <?php $titleContentPostTrendContentImageTitle = get_sub_field('Title_Content_Post_Trend_Content_Image_Title'); ?>
                                                                        <?php $imageContentPostTrendContentImageTitle = get_sub_field('Image__Content_Post_Trend_Content_Image_Title'); ?>

                                                                        <h2 class="NotoSans-Bold title-color mb-4 pt-4">
                                                                            <?= strip_tags($titleContentPostTrendContentImageTitle); ?>
                                                                        </h2>
                                                                        <div class="d-flex justify-content-start align-items-center">
                                                                            <div class="col-12 col-lg-12">
                                                                                <?= wp_get_attachment_image($imageContentPostTrendContentImageTitle, 'full', '', ['class' => '', 'style' => 'width: 100%; height: 100%; object-fit: cover;']); ?>
                                                                            </div>
                                                                        </div>

                                                                    <?php endwhile; ?>

                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        <?php endif; ?>


                                        <?php /* Title - Description  /  Content With Background Color */  ?>
                                        <?php $ifPostTrendContentTitleDescription = get_sub_field('If_Post_Trend_Content_Title_Description'); ?>
                                        <?php $contentPostTrendContentTitleDescription = get_sub_field('Content_Post_Trend_Content_Title_Description'); ?>

                                        <?php if (isset($ifPostTrendContentTitleDescription) && !empty($ifPostTrendContentTitleDescription)) : ?>

                                            <div class="" style="position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; width: 100vw; background-color: white; margin-top: 1rem; margin-botton: 2rem;">

                                                <div class="container mx-auto px-lg-0 px-4">
                                                    <div class="p-5 pt-3 pt-lg-5 w-100 px-0">
                                                        <div class="col-12 p-0">
                                                            <div class="row">
                                                                <?php $counter = 0 ?>

                                                                <?php if (have_rows('Content_Post_Trend_Content_Title_Description')) : ?>

                                                                    <?php while (have_rows('Content_Post_Trend_Content_Title_Description')) : the_row() ?>

                                                                        <?php $titleContentPostTrendContentTitleDescription = get_sub_field('Title_Content_Post_Trend_Content_Title_Description'); ?>
                                                                        <?php $descriptioncontentPostTrendContentTitleDescription = get_sub_field('Description_Content_Post_Trend_Content_Title_Description'); ?>

                                                                        <h2 class="NotoSans-Bold title-color mb-4 <?= $counter > 0 ? 'pt-4' : ''; ?>">
                                                                            <?= strip_tags($titleContentPostTrendContentTitleDescription); ?>
                                                                        </h2>
                                                                        <div class="NotoSans-Regular description-color px-2">
                                                                            <?= strip_tags($descriptioncontentPostTrendContentTitleDescription, '<strong><em><ul><li><blockquote><a><br>'); ?>
                                                                        </div>

                                                                        <?php $counter++ ?>
                                                                    <?php endwhile; ?>

                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        <?php endif; ?>


                                        <?php /* Title - Image - Others  /  Content With Background Color */  ?>
                                        <?php $ifPostTrendContentTitleImageDescription = get_sub_field('If_Post_Trend_Content_Title_Image_Description'); ?>
                                        <?php $contentPostTrendContentTitleImageDescription = get_sub_field('Content_Post_Trend_Content_Title_Image_Description'); ?>


                                        <?php if (isset($ifPostTrendContentTitleImageDescription) && !empty($ifPostTrendContentTitleImageDescription)) : ?>

                                            <div class="pt-4 pb-4" style="position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; width: 100vw; background-color: white;">

                                                <div class="container mx-auto px-lg-0 px-4">
                                                    <div class="p-0 w-100 px-0">
                                                        <div class="col-12 p-0 pt-0 pb-0">
                                                            <div class="row">
                                                                <?php if (have_rows('Content_Post_Trend_Content_Title_Image_Description')) : ?>

                                                                    <?php while (have_rows('Content_Post_Trend_Content_Title_Image_Description')) : the_row() ?>

                                                                        <?php $titleContentPostTrendContentTitleImageDescription = get_sub_field('Title_Content_Post_Trend_Content_Title_Image_Description'); ?>
                                                                        <?php $titleColorContent = get_sub_field('Title_Color_Content_Post_Trend_Content_Title_Image_Description'); ?>
                                                                        <?php $backgroundTitleColor = get_sub_field('Background_Title_Color_Content_Post_Trend_Content_Title_Image_Description_copy'); ?>
                                                                        <?php $firstDescriptionContentPostTrendContentTitleImageDescription = get_sub_field('First_Description_Content_Post_Trend_Content_Title_Image_Description'); ?>
                                                                        <?php $secondDescriptionContentPostTrendContentTitleImageDescription = get_sub_field('Second_Description_Content_Post_Trend_Content_Title_Image_Description'); ?>
                                                                        <?php $imageContentPostTrendContentTitleImageDescription = get_sub_field('Image_Content_Post_Trend_Content_Title_Image_Description'); ?>
                                                                        <?php $lastDescriptionContentPostTrendContentTitleImageDescription = get_sub_field('Last_Description_Content_Post_Trend_Content_Title_Image_Description'); ?>

                                                                        <h2 class="NotoSans-Bold title-color mb-4 pt-4 position-relative" style="z-index: 1;">
                                                                            <span class="background-title-round-two" <?php echo $backgroundTitleColor ? 'data-bg-color="' . esc_attr($backgroundTitleColor) . '"' : ''; ?> style="color: <?= $titleColorContent ?> !important"><?= strip_tags($titleContentPostTrendContentTitleImageDescription); ?></span>
                                                                        </h2>
                                                                        <div class="NotoSans-Regular description-color px-2 mt-2 pb-2">
                                                                            <?= strip_tags($firstDescriptionContentPostTrendContentTitleImageDescription, '<strong><em><ul><li><blockquote><a><br><h1><h2><h3><h4><h5>'); ?>
                                                                        </div>
                                                                        <div class="NotoSans-Regular description-color px-2 mt-2 pb-3">
                                                                            <?= strip_tags($secondDescriptionContentPostTrendContentTitleImageDescription, '<strong><em><ul><li><blockquote><a><br><h1><h2><h3><h4><h5>'); ?>
                                                                        </div>
                                                                        <div class="d-flex justify-content-center align-items-center">
                                                                            <div class="col-12 col-lg-10">
                                                                                <?= wp_get_attachment_image($imageContentPostTrendContentTitleImageDescription, 'full', '', ['class' => '', 'style' => 'width: 100%; height: 100%; object-fit: cover;']); ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="NotoSans-Regular description-color px-2 mb-4 pt-4">
                                                                            <?= strip_tags($lastDescriptionContentPostTrendContentTitleImageDescription, '<strong><em><ul><li><blockquote><a><br><div><span><h1><h2><h3><h4><h5><style>'); ?>
                                                                        </div>

                                                                    <?php endwhile; ?>

                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        <?php endif; ?>


                                        <?php /* Content with Subcontent  /  Content With Background Color */  ?>
                                        <?php $ifPostTrendContentSubcontent = get_sub_field('If_Post_Trend_Content_Subcontent'); ?>
                                        <?php $contentPostTrendSubcontent = get_sub_field('Content_Post_Trend_Subcontent'); ?>


                                        <?php if (isset($ifPostTrendContentSubcontent) && !empty($ifPostTrendContentSubcontent)) : ?>

                                            <div class="" style="position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; width: 100vw; background-color: white; margin-top: 1rem; margin-bottom: 2rem;">

                                                <div class="container mx-auto px-lg-0 px-4">
                                                    <div class="p-5 pt-3 w-100 px-0">
                                                        <div class="col-12 p-lg-5 p-3 pt-lg-0 pb-lg-0 pt-0 pb-0">
                                                            <div class="row">
                                                                <?php if (have_rows('Content_Post_Trend_Subcontent')) : ?>

                                                                    <?php while (have_rows('Content_Post_Trend_Subcontent')) : the_row() ?>


                                                                        <?php $titleContentPostTrendSubcontent = get_sub_field('Title_Content_Post_Trend_Subcontent'); ?>
                                                                        <?php $subcontentPostTrend = get_sub_field('Subcontent_Post_Trend'); ?>

                                                                        <h2 class="NotoSans-Bold title-color mb-4 pt-4">
                                                                            <?= strip_tags($titleContentPostTrendSubcontent); ?>
                                                                        </h2>
                                                                        <a href="" target="_blank"></a>
                                                                        <div class="container mx-auto px-0">
                                                                            <div class="p-5 pt-3 w-100 px-0">
                                                                                <div class="col-12 p-lg-5 p-3 pt-lg-0 pb-lg-0 pt-0 pb-0">
                                                                                    <div class="row">
                                                                                        <?php if (have_rows('Subcontent_Post_Trend')) : ?>

                                                                                            <?php while (have_rows('Subcontent_Post_Trend')) : the_row() ?>

                                                                                                <?php $titleSubcontentPostTrend = get_sub_field('Title_Subcontent_Post_Trend'); ?>
                                                                                                <?php $imageSubcontentPostTrend = get_sub_field('Image_Subcontent_Post_Trend'); ?>
                                                                                                <?php $firstDescriptionSubcontentPostTrend = get_sub_field('First_Description_Subcontent_Post_Trend'); ?>

                                                                                                <h3 class="NotoSans-Bold title-color mb-4 pt-4 text-center">
                                                                                                    <?= strip_tags($titleSubcontentPostTrend); ?>
                                                                                                </h3>

                                                                                                <div class="d-flex flex-md-row flex-column position-relative justify-content-center align-items-center">
                                                                                                    <div class="col-md-4 col-lg-4" style="border-radius: 1rem;">
                                                                                                        <div class="col-12">
                                                                                                            <?= wp_get_attachment_image($imageSubcontentPostTrend, 'full', '', ['style' => 'height: 170px;width: 100%;object-fit: contain;']); ?>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-8 col-lg-8 d-flex justify-content-center align-items-center">
                                                                                                        <div class="col-11 col-md-12 col-lg-12 p-0 m-0 pt-4 pb-4">
                                                                                                            <div class="container-title-speaker-content-out mx-lg-5 ms-3">
                                                                                                                <div class="container-content-outstanding">
                                                                                                                    <p class="NotoSans-Regular container-title-speaker-content-outstanding">
                                                                                                                        <?= strip_tags($firstDescriptionSubcontentPostTrend, '<strong><em><ul><li><blockquote><a><br>'); ?>
                                                                                                                    </p>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>

                                                                                            <?php endwhile; ?>

                                                                                        <?php endif; ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    <?php endwhile; ?>

                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        <?php endif; ?>


                                    <?php endwhile; ?>

                                <?php endif; ?>

                            <?php endif; ?>
                        <?php endif; ?>


                    <?php endwhile; ?>
                <?php endif; ?>

            <?php endif ?>

        <?php endif; ?>



        <!-- Code Test -->
        <?php $currentPostTools = array($currentPostId); ?>

        <?php $listPostTools = new WP_Query(
            array(
                'post_type' => 'herramientas',
                'posts_per_page' => -1,
                'order' => 'ASC'
            )
        );
        ?>

        <?php $postsIds = wp_list_pluck($listPostTools->posts, 'ID') ?>

        <?php $filteredPostsTools = array_diff($postsIds, $currentPostTools); ?>

        <?php if (!empty($filteredPostsTools)) : ?>

            <?php $filteredPostsQueryTools = new WP_Query(
                array(
                    'post__in' => $filteredPostsTools,
                    'post_type' => 'herramientas',
                    'posts_per_page' => -1,
                    'order' => 'ASC',
                    'orderby' => 'post_date',
                    'post_status' => 'publish'
                )
            ); ?>

            <?php if ($filteredPostsQueryTools->have_posts()) : ?>

                <div class="container p-0 pt-lg-0">

                    <div class="" style="background-color: #F9ECEA !important;">
                        <div class="row d-flex flex-lg-row flex-column p-0 pt-4 m-0 px-lg-5">

                            <div class="row d-flex flex-lg-row flex-column justify-content-start align-items-center">

                                <?php while ($filteredPostsQueryTools->have_posts()) : $filteredPostsQueryTools->the_post() ?>

                                    <?php $thePermalink = get_the_permalink(); ?>

                                    <?php $imgPostTools = get_field('Img_Post_Tools'); ?>

                                    <div class="col-12 col-md-4 col-lg-4 col-xl-3 col-xxl-3 col-xxxl-3 d-flex flex-column justify-content-start align-items-center card-taxonomies-subcategory-academy-events m-0 p-0 mt-3 mb-3">
                                        <a class="custom-width" href="<?= $thePermalink ?>" onclick="saveLogsClick('Clic en tarjeta `<?= the_title(); ?>`');" style="text-decoration: none;">
                                            <div class="mb-4 figure">
                                                <?php if (isset($imgPostTools) && !empty($imgPostTools)) : ?>
                                                    <?php echo wp_get_attachment_image($imgPostTools, 'full', '', ['style' => 'object-fit: fill']); ?>
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
        <!-- End Code Test -->

        <div class="container m-lg-3 mx-lg-auto m-3 px-0">
            <h5 class="NotoSans-Bold title-color">
                <?php $codePromomats = get_field('code_promomats'); ?>
                <p><?= $codePromomats ?></p>
            </h5>
        </div>

    <?php endif; ?>

    <?php /* End Post display for Tools Post Types */ ?>

    <?php /* Post display for Innsider Data Post Types */ ?>
    <?php $listPostInnsiderData = new WP_Query(
        array(
            'post_type' => 'innsiderdata',
            'posts_per_page' => -1,
            'order' => 'ASC'
        )
    );
    ?>

    <?php $postsIds = wp_list_pluck($listPostInnsiderData->posts, 'ID') ?>

    <?php if (is_single() && in_array($currentPostId, $postsIds)) : ?>

        <?php $contentRegister = get_post_meta($currentPostId, 'Content_Register', true); ?>
        <?php $thePermalink = get_the_permalink(); ?>
        <?php $titlePostInnsiderData = get_the_title(); ?>
        <?php $bannerPostInnsiderData = get_field('Banner_Post_Tools'); ?>
        <?php $ifPostTrendWithDiferentOptions = get_field('If_Post_Trend_With_Diferent_Options'); ?>
        <?php $contentPostTrendWithDifferentOptions = get_field('Content_Post_Trend_With_Different_Options');  ?>
        <?php $codePromomats = get_field('code_promomats');  ?>
        <?php $ifPostInnsiderDataVideo = get_field('If_Post_Tools_Video');  ?>
        <?php $uRLPostInnsiderData = get_field('URL_Post_Tools');  ?>
        <?php $colorSectionURLPostInnsiderData = get_field('Seccion_Color_Post_Tools'); ?>
        <?php $ifPostInnsiderDataPdf = get_field('If_Post_Tools_Pdf');  ?>
        <?php $pdfPostInnsiderData = get_field('Pdf_Post_Tools');  ?>
        <?php $colorSectionPdfPostInnsiderData = get_field('Seccion_Color_Pdf_Post_Tools'); ?>
        <?php $thumbnailUrlPostInnsiderData = obtenerMiniaturaVimeo($uRLPostInnsiderData);  ?>

        <?php if ($contentRegister === '1') : ?>

            <?php if (!is_user_logged_in()) : ?>

                <?php $login_url = wp_login_url($thePermalink); ?>
                <?php $link = $login_url; ?>
                <script>
                    window.location.href = '<?php echo $link; ?>';
                </script>

            <?php endif ?>

        <?php endif; ?>

        <?php if (isset($ifPostTrendWithDiferentOptions) && !empty($ifPostTrendWithDiferentOptions)) : ?>
            <?php if (isset($contentPostTrendWithDifferentOptions) && !empty($contentPostTrendWithDifferentOptions)) : ?>

                <?php if (have_rows('Content_Post_Trend_With_Different_Options')) : ?>
                    <?php while (have_rows('Content_Post_Trend_With_Different_Options')) : the_row() ?>

                        <?php /* Description To Banner */  ?>
                        <?php $descriptionBannerPostTrendContent = get_sub_field('Description_Banner_Post_Trend_Content'); ?>

                        <?php if (isset($descriptionBannerPostTrendContent) && !empty($descriptionBannerPostTrendContent)) : ?>

                            <div class="container four-background-taxonomy mt-lg-3 mt-3 p-lg-5 p-2 pb-lg-0 pb-2">
                                <div class="container container-bg-single banner-taxonomy-academy" data-aos="zoom-in">
                                    <?php if (isset($bannerPostTools) && !empty($bannerPostTools)) : ?>
                                        <img src="<?= esc_url(wp_get_attachment_url($bannerPostTools)); ?>" alt="Herramientas" class="bg-single-trend">
                                    <?php endif; ?>
                                    <div class="wrapper-taxonomy-academy"></div>
                                </div>
                                <div class="container">
                                    <div class="row m-0 p-0">
                                        <?php if (isset($descriptionBannerPostTrendContent) && !empty($descriptionBannerPostTrendContent)) : ?>
                                            <p class="NotoSans-Regular text-align-justify mb-lg-4 mb-4 container-content-single mx-auto mt-4">
                                                <?= strip_tags($descriptionBannerPostTrendContent, '<strong><em><ul><li><blockquote><a><br>'); ?>
                                            </p>
                                        <?php endif ?>
                                    </div>
                                </div>
                            </div>

                        <?php endif; ?>

                    <?php endwhile; ?>
                <?php endif; ?>

            <?php endif; ?>

        <?php endif; ?>

        <?php if (isset($bannerPostTools) && !empty($bannerPostTools)) : ?>
            <?php if (isset($ifPostToolsPdf) && !empty($ifPostToolsPdf)) : ?>

                <div class="container banner-academy" data-aos="zoom-in">
                    <img class="bg-banner-academy" src="<?php echo wp_get_attachment_image_url($bannerPostTools, 'full', ''); ?>" alt="Podcast">
                    <div class="wrapper-banner-academy">
                        <div class="container-text-banner-academy"></div>
                        <!-- <h4 class="text-white mt-3"><?php the_content(); ?></h4>
                    <div class="container-text-banner-academy w-100 h-100 m-auto d-flex justify-content-lg-start align-items-center">
                        <img src="<?= get_template_directory_uri() . '/assets/images/Icono-innsider-white.png'; ?>" alt="Herramientas" class="bg-banner-single-category">
                    </div> -->

                    </div>
                </div>

            <?php endif ?>

        <?php endif; ?>

        <?php if (isset($ifPostToolsVideo) && !empty($ifPostToolsVideo)) : ?>
            <?php if (isset($uRLPostTools) && !empty($uRLPostTools)) : ?>

                <div class="container background-taxonomy px-5 pt-5" <?php echo $colorSectionURLPostTools ? 'data-bg-color="' . esc_attr($colorSectionURLPostTools) . '"' : ''; ?>>
                    <div class="container banner-single preview-video mt-lg-5 mt-4"
                        onclick="playVideo(<?= $currentPostId ?>, '<?= $uRLPostTools; ?>', event, 'preview-video')">
                        <?php if (isset($thumbnailUrlPostTools) && !empty($thumbnailUrlPostTools)) : ?>
                            <img src="<?= esc_url($thumbnailUrlPostTools); ?>" alt="Herramientas" class="bg-single">
                        <?php elseif (isset($bannerPostTools) && !empty($bannerPostTools)) : ?>
                            <img src="<?= esc_url(wp_get_attachment_url($bannerPostTools)); ?>" alt="Herramientas" class="bg-single">
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
                                        <h1 class="NotoSans-Bold title-color mb-5 pb-2 name-info-video-speaker"><?php the_title(); ?></h1>

                                        <?php if (have_rows('Content_Post_Tools')) : ?>

                                            <?php while (have_rows('Content_Post_Tools')) : the_row() ?>

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

        <?php elseif (isset($ifPostToolsPdf) && !empty($ifPostToolsPdf)) : ?>

            <?php if (isset($pdfPostTools) && !empty($pdfPostTools)) : ?>

                <div class="container p-lg-5 pb-lg-0 p-1">
                    <div class="container background-single p-2" <?php echo $colorSectionPdfPostTools ? 'data-bg-color="' . esc_attr($colorSectionPdfPostTools) . '"' : ''; ?>>
                        <div class="p-4 pt-3 pt-lg-5 w-100">

                            <h1 class="NotoSans-Bold title-color mb-5 pb-2 d-none d-lg-block"><?php the_title(); ?></h1>
                            <h5 class="NotoSans-Bold title-color mb-2 pb-2 d-block d-lg-none"><?php the_title(); ?></h5>

                            <div class="col-lg-12">
                                <div class="row justify-content-center">
                                    <div class="col-12 d-flex justify-content-center align-items-center flex-column mt-lg-5 mt-2 mb-5">
                                        <embed src="<?= $pdfPostTools ?>" type="application/pdf" class="d-none d-lg-block" width="100%" height="100%" style="width: 90%; height: 100vh; border: none">
                                        <iframe src="https://drive.google.com/viewerng/viewer?embedded=true&url=<?= $pdfPostTools ?>" class="d-block d-lg-none" style="width: 100%; height: 500px;" frameborder="0"></iframe>

                                        <div class="w-75 btn-view-more mt-5 d-block d-lg-none">
                                            <a href="<?= $pdfPostTools ?>" download class="text-decoration-none text-light">Descargar PDF</a>
                                        </div>

                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

            <?php endif; ?>

        <?php elseif (isset($ifPostTrendWithDiferentOptions) && !empty($ifPostTrendWithDiferentOptions)) : ?>

            <?php if (isset($contentPostTrendWithDifferentOptions) && !empty($contentPostTrendWithDifferentOptions)) : ?>

                <?php if (have_rows('Content_Post_Trend_With_Different_Options')) : ?>
                    <?php while (have_rows('Content_Post_Trend_With_Different_Options')) : the_row() ?>

                        <?php /* Content With Background Color */  ?>
                        <?php $ifPostTrendContentColor = get_sub_field('If_Post_Trend_Content_Color'); ?>
                        <?php $contentPostTrendColor = get_sub_field('Content_Post_Trend_Color'); ?>

                        <?php if (isset($ifPostTrendContentColor) && !empty($ifPostTrendContentColor)) : ?>
                            <?php if (isset($contentPostTrendColor) && !empty($contentPostTrendColor)) : ?>

                                <?php if (have_rows('Content_Post_Trend_Color')) : ?>

                                    <?php while (have_rows('Content_Post_Trend_Color')) : the_row()  ?>

                                        <?php /* Image - Title  /  Content With Background Color */  ?>
                                        <?php $ifPostTrendContentImageTitleColor = get_sub_field('If_Post_Trend_Content_Image_Title'); ?>
                                        <?php $contentPostTrendContentImageTitleColor = get_sub_field('Content_Post_Trend_Content_Image_Title'); ?>
                                        <?php $seccionColorContentPostTrendContentImageTitle = get_sub_field('Seccion_Color_Content_Post_Trend_Content_Image_Title'); ?>

                                        <?php if (isset($ifPostTrendContentImageTitleColor) && !empty($ifPostTrendContentImageTitleColor)) : ?>

                                            <div class="" style="position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; width: 100vw; background-color: <?= $seccionColorContentPostTrendContentImageTitle ?>; margin-top: 1rem; margin-botton: 2rem;">

                                                <div class="container mx-auto px-lg-0 px-4">
                                                    <div class="p-0 w-100 px-0">
                                                        <div class="col-12 p-0 pb-lg-0 pt-0 pb-0">
                                                            <div class="row">

                                                                <?php if (have_rows('Content_Post_Trend_Content_Image_Title')) : ?>

                                                                    <?php while (have_rows('Content_Post_Trend_Content_Image_Title')) : the_row() ?>

                                                                        <?php $titleContentPostTrendContentImageTitleColor = get_sub_field('Title_Content_Post_Trend_Content_Image_Title'); ?>
                                                                        <?php $imageContentPostTrendContentImageTitleColor = get_sub_field('Image__Content_Post_Trend_Content_Image_Title'); ?>

                                                                        <h2 class="NotoSans-Bold title-color mb-4 pt-4">
                                                                            <?= strip_tags($titleContentPostTrendContentImageTitleColor); ?>
                                                                        </h2>
                                                                        <div class="d-flex justify-content-start align-items-center">
                                                                            <div class="col-12 col-lg-12">
                                                                                <?= wp_get_attachment_image($imageContentPostTrendContentImageTitleColor, 'full', '', ['class' => '', 'style' => 'width: 100%; height: 100%; object-fit: cover;']); ?>
                                                                            </div>
                                                                        </div>

                                                                    <?php endwhile; ?>

                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        <?php endif; ?>


                                        <?php /* Title - Description  /  Content With Background Color */  ?>
                                        <?php $ifPostTrendContentTitleDescriptionColor = get_sub_field('If_Post_Trend_Content_Title_Description'); ?>
                                        <?php $contentPostTrendContentTitleDescriptionColor = get_sub_field('Content_Post_Trend_Content_Title_Description'); ?>
                                        <?php $seccionColorContentPostTrendContentTitleDescription = get_sub_field('Seccion_Color_Content_Post_Trend_Content_Title_Description'); ?>

                                        <?php if (isset($ifPostTrendContentTitleDescriptionColor) && !empty($ifPostTrendContentTitleDescriptionColor)) : ?>

                                            <div class="" style="position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; width: 100vw; background-color: <?= $seccionColorContentPostTrendContentTitleDescription ?>; margin-top: 1rem; margin-botton: 2rem;">

                                                <div class="container mx-auto px-lg-0 px-4">
                                                    <div class="p-5 pt-3 pt-lg-5 w-100 px-0">
                                                        <div class="col-12 p-0">
                                                            <div class="row">
                                                                <?php $counter = 0 ?>
                                                                <?php if (have_rows('Content_Post_Trend_Content_Title_Description')) : ?>

                                                                    <?php while (have_rows('Content_Post_Trend_Content_Title_Description')) : the_row() ?>

                                                                        <?php $titleContentPostTrendContentTitleDescriptionColor = get_sub_field('Title_Content_Post_Trend_Content_Title_Description'); ?>
                                                                        <?php $descriptioncontentPostTrendContentTitleDescriptionColor = get_sub_field('Description_Content_Post_Trend_Content_Title_Description'); ?>

                                                                        <h2 class="NotoSans-Bold title-color mb-4 <?= $counter > 0 ? 'pt-4' : ''; ?>">
                                                                            <?= strip_tags($titleContentPostTrendContentTitleDescriptionColor); ?>
                                                                        </h2>
                                                                        <div class="NotoSans-Regular description-color px-2">
                                                                            <?= strip_tags($descriptioncontentPostTrendContentTitleDescriptionColor, '<strong><em><ul><li><blockquote><a><br>'); ?>
                                                                        </div>

                                                                        <?php $counter++ ?>
                                                                    <?php endwhile; ?>

                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        <?php endif; ?>


                                        <?php /* Title - Image - Others  /  Content With Background Color */  ?>
                                        <?php $ifPostTrendContentTitleImageDescriptionColor = get_sub_field('If_Post_Trend_Content_Title_Image_Description'); ?>
                                        <?php $contentPostTrendContentTitleImageDescriptionColor = get_sub_field('Content_Post_Trend_Content_Title_Image_Description'); ?>
                                        <?php $seccionColorContentPostTrendContentTitleImageDescription = get_sub_field('Seccion_Color_Content_Post_Trend_Content_Title_Image_Description'); ?>

                                        <?php if (isset($ifPostTrendContentTitleImageDescriptionColor) && !empty($ifPostTrendContentTitleImageDescriptionColor)) : ?>

                                            <div class="" style="position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; width: 100vw; background-color: <?= $seccionColorContentPostTrendContentTitleImageDescription ?>; margin-top: 1rem; margin-botton: 2rem; z-index: 2;">

                                                <div class="container mx-auto px-lg-0 px-4">
                                                    <div class="p-0 w-100 px-0">
                                                        <div class="col-12 p-0 pt-0 pb-0">
                                                            <div class="row">
                                                                <?php if (have_rows('Content_Post_Trend_Content_Title_Image_Description')) : ?>

                                                                    <?php while (have_rows('Content_Post_Trend_Content_Title_Image_Description')) : the_row() ?>

                                                                        <?php $titleContentPostTrendContentTitleImageDescriptionColor = get_sub_field('Title_Content_Post_Trend_Content_Title_Image_Description'); ?>
                                                                        <?php $titleColorContent = get_sub_field('Title_Color_Content_Post_Trend_Content_Title_Image_Description'); ?>
                                                                        <?php $backgroundTitleColor = get_sub_field('Background_Title_Color_Content_Post_Trend_Content_Title_Image_Description_copy'); ?>
                                                                        <?php $firstDescriptionContentPostTrendContentTitleImageDescriptionColor = get_sub_field('First_Description_Content_Post_Trend_Content_Title_Image_Description'); ?>
                                                                        <?php $secondDescriptionContentPostTrendContentTitleImageDescriptionColor = get_sub_field('Second_Description_Content_Post_Trend_Content_Title_Image_Description'); ?>
                                                                        <?php $imageContentPostTrendContentTitleImageDescriptionColor = get_sub_field('Image_Content_Post_Trend_Content_Title_Image_Description'); ?>
                                                                        <?php $lastDescriptionContentPostTrendContentTitleImageDescriptionColor = get_sub_field('Last_Description_Content_Post_Trend_Content_Title_Image_Description'); ?>


                                                                        <h2 class="NotoSans-Bold title-color mb-4 pt-4 position-relative">
                                                                            <span class="background-title-round" <?php echo $backgroundTitleColor ? 'data-bg-color="' . esc_attr($backgroundTitleColor) . '"' : ''; ?> style="color: <?= $titleColorContent ?> !important"><?= strip_tags($titleContentPostTrendContentTitleImageDescriptionColor); ?></span>
                                                                        </h2>
                                                                        <div class="NotoSans-Regular description-color px-2 mt-2 pb-2">
                                                                            <?= strip_tags($firstDescriptionContentPostTrendContentTitleImageDescriptionColor, '<strong><em><ul><li><blockquote><a><br><h1><h2><h3><h4><h5>'); ?>
                                                                        </div>
                                                                        <div class="NotoSans-Regular description-color px-2 mt-2 pb-3">
                                                                            <?= strip_tags($secondDescriptionContentPostTrendContentTitleImageDescriptionColor, '<strong><em><ul><li><blockquote><a><br><h1><h2><h3><h4><h5>'); ?>
                                                                        </div>
                                                                        <div class="d-flex justify-content-center align-items-center">
                                                                            <div class="col-12 col-lg-10">
                                                                                <?= wp_get_attachment_image($imageContentPostTrendContentTitleImageDescriptionColor, 'full', '', ['class' => '', 'style' => 'width: 100%; height: 100%; object-fit: cover;']); ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="NotoSans-Regular description-color px-2 mb-4 pt-4">
                                                                            <?= strip_tags($lastDescriptionContentPostTrendContentTitleImageDescriptionColor, '<strong><em><ul><li><blockquote><a><br><div><span><h1><h2><h3><h4><h5><style>'); ?>
                                                                        </div>

                                                                    <?php endwhile; ?>

                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        <?php endif; ?>


                                        <?php /* Content with Subcontent  /  Content With Background Color */  ?>
                                        <?php $ifPostTrendContentSubcontentColor = get_sub_field('If_Post_Trend_Content_Subcontent'); ?>
                                        <?php $contentPostTrendSubcontentColor = get_sub_field('Content_Post_Trend_Subcontent'); ?>
                                        <?php $seccionColorContentPostTrendSubcontent = get_sub_field('Seccion_Color_Content_Post_Trend_Subcontent'); ?>


                                        <?php if (isset($ifPostTrendContentSubcontentColor) && !empty($ifPostTrendContentSubcontentColor)) : ?>

                                            <div class="" style="position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; width: 100vw; background-color: <?= $seccionColorContentPostTrendSubcontent ?>; margin-top: 1rem; margin-bottom: 2rem;">

                                                <div class="container mx-auto px-lg-0 px-4">
                                                    <div class="p-5 pt-3 w-100 px-0">
                                                        <div class="col-12 p-lg-5 p-3 pt-lg-0 pb-lg-0 pt-0 pb-0">
                                                            <div class="row">
                                                                <?php if (have_rows('Content_Post_Trend_Subcontent')) : ?>

                                                                    <?php while (have_rows('Content_Post_Trend_Subcontent')) : the_row() ?>

                                                                        <?php $titleContentPostTrendSubcontentColor = get_sub_field('Title_Content_Post_Trend_Subcontent'); ?>
                                                                        <?php $subcontentPostTrendColor = get_sub_field('Subcontent_Post_Trend'); ?>

                                                                        <h2 class="NotoSans-Bold title-color mb-4 pt-4">
                                                                            <?= strip_tags($titleContentPostTrendSubcontentColor); ?>
                                                                        </h2>
                                                                        <div class="container mx-auto px-0">
                                                                            <div class="p-5 pt-3 w-100 px-0">
                                                                                <div class="col-12 p-lg-5 p-3 pt-lg-0 pb-lg-0 pt-0 pb-0">
                                                                                    <div class="row">
                                                                                        <?php if (have_rows('Subcontent_Post_Trend')) : ?>

                                                                                            <?php while (have_rows('Subcontent_Post_Trend')) : the_row() ?>

                                                                                                <?php $titleSubcontentPostTrendColor = get_sub_field('Title_Subcontent_Post_Trend'); ?>
                                                                                                <?php $imageSubcontentPostTrendColor = get_sub_field('Image_Subcontent_Post_Trend'); ?>
                                                                                                <?php $firstDescriptionSubcontentPostTrendColor = get_sub_field('First_Description_Subcontent_Post_Trend'); ?>

                                                                                                <h3 class="NotoSans-Bold title-color mb-4 pt-4 text-center">
                                                                                                    <?= strip_tags($titleSubcontentPostTrendColor); ?>
                                                                                                </h3>

                                                                                                <div class="d-flex flex-md-row flex-column position-relative justify-content-center align-items-center">
                                                                                                    <div class="col-md-4 col-lg-4" style="border-radius: 1rem;">
                                                                                                        <div class="col-12">
                                                                                                            <?= wp_get_attachment_image($imageSubcontentPostTrendColor, 'full', '', ['style' => 'height: 170px;width: 100%;object-fit: contain;']); ?>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-8 col-lg-8 d-flex justify-content-center align-items-center">
                                                                                                        <div class="col-11 col-md-12 col-lg-12 p-0 m-0 pt-4 pb-4">
                                                                                                            <div class="container-title-speaker-content-out mx-lg-5 ms-3">
                                                                                                                <div class="container-content-outstanding">
                                                                                                                    <p class="NotoSans-Regular container-title-speaker-content-outstanding">
                                                                                                                        <?= strip_tags($firstDescriptionSubcontentPostTrendColor, '<strong><em><ul><li><blockquote><a><br>'); ?>
                                                                                                                    </p>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>

                                                                                            <?php endwhile; ?>

                                                                                        <?php endif; ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    <?php endwhile; ?>

                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        <?php endif; ?>


                                    <?php endwhile; ?>

                                <?php endif; ?>

                            <?php endif; ?>
                        <?php endif; ?>


                        <?php /* Content Without Background Color */  ?>
                        <?php $ifPostTrendContentWithoutColor = get_sub_field('If_Post_Trend_Content_Without_Color'); ?>
                        <?php $contentPostTrendWithoutColor = get_sub_field('Content_Post_Trend_Without_Color_c'); ?>

                        <?php if (isset($ifPostTrendContentWithoutColor) && !empty($ifPostTrendContentWithoutColor)) : ?>
                            <?php if (isset($contentPostTrendWithoutColor) && !empty($contentPostTrendWithoutColor)) : ?>

                                <?php if (have_rows('Content_Post_Trend_Without_Color_c')) : ?>

                                    <?php while (have_rows('Content_Post_Trend_Without_Color_c')) : the_row()  ?>

                                        <?php /* Title - Image  /  Content With Background Color */  ?>
                                        <?php $ifPostTrendContentImageTitle = get_sub_field('If_Post_Trend_Content_Image_Title'); ?>
                                        <?php $contentPostTrendContentImageTitle = get_sub_field('Content_Post_Trend_Content_Image_Title'); ?>

                                        <?php if (isset($ifPostTrendContentImageTitle) && !empty($ifPostTrendContentImageTitle)) : ?>

                                            <div class="" style="position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; width: 100vw; background-color: white;">

                                                <div class="container mx-auto px-lg-0 px-4">
                                                    <div class="p-0 w-100 px-0">
                                                        <div class="col-12 p-0 pt-0 pb-0">
                                                            <div class="row">

                                                                <?php if (have_rows('Content_Post_Trend_Content_Image_Title')) : ?>

                                                                    <?php while (have_rows('Content_Post_Trend_Content_Image_Title')) : the_row() ?>

                                                                        <?php $titleContentPostTrendContentImageTitle = get_sub_field('Title_Content_Post_Trend_Content_Image_Title'); ?>
                                                                        <?php $imageContentPostTrendContentImageTitle = get_sub_field('Image__Content_Post_Trend_Content_Image_Title'); ?>

                                                                        <h2 class="NotoSans-Bold title-color mb-4 pt-4">
                                                                            <?= strip_tags($titleContentPostTrendContentImageTitle); ?>
                                                                        </h2>
                                                                        <div class="d-flex justify-content-start align-items-center">
                                                                            <div class="col-12 col-lg-12">
                                                                                <?= wp_get_attachment_image($imageContentPostTrendContentImageTitle, 'full', '', ['class' => '', 'style' => 'width: 100%; height: 100%; object-fit: cover;']); ?>
                                                                            </div>
                                                                        </div>

                                                                    <?php endwhile; ?>

                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        <?php endif; ?>


                                        <?php /* Title - Description  /  Content With Background Color */  ?>
                                        <?php $ifPostTrendContentTitleDescription = get_sub_field('If_Post_Trend_Content_Title_Description'); ?>
                                        <?php $contentPostTrendContentTitleDescription = get_sub_field('Content_Post_Trend_Content_Title_Description'); ?>

                                        <?php if (isset($ifPostTrendContentTitleDescription) && !empty($ifPostTrendContentTitleDescription)) : ?>

                                            <div class="" style="position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; width: 100vw; background-color: white; margin-top: 1rem; margin-botton: 2rem;">

                                                <div class="container mx-auto px-lg-0 px-4">
                                                    <div class="p-5 pt-3 pt-lg-5 w-100 px-0">
                                                        <div class="col-12 p-0">
                                                            <div class="row">
                                                                <?php $counter = 0 ?>

                                                                <?php if (have_rows('Content_Post_Trend_Content_Title_Description')) : ?>

                                                                    <?php while (have_rows('Content_Post_Trend_Content_Title_Description')) : the_row() ?>

                                                                        <?php $titleContentPostTrendContentTitleDescription = get_sub_field('Title_Content_Post_Trend_Content_Title_Description'); ?>
                                                                        <?php $descriptioncontentPostTrendContentTitleDescription = get_sub_field('Description_Content_Post_Trend_Content_Title_Description'); ?>

                                                                        <h2 class="NotoSans-Bold title-color mb-4 <?= $counter > 0 ? 'pt-4' : ''; ?>">
                                                                            <?= strip_tags($titleContentPostTrendContentTitleDescription); ?>
                                                                        </h2>
                                                                        <div class="NotoSans-Regular description-color px-2">
                                                                            <?= strip_tags($descriptioncontentPostTrendContentTitleDescription, '<strong><em><ul><li><blockquote><a><br>'); ?>
                                                                        </div>

                                                                        <?php $counter++ ?>
                                                                    <?php endwhile; ?>

                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        <?php endif; ?>


                                        <?php /* Title - Image - Others  /  Content With Background Color */  ?>
                                        <?php $ifPostTrendContentTitleImageDescription = get_sub_field('If_Post_Trend_Content_Title_Image_Description'); ?>
                                        <?php $contentPostTrendContentTitleImageDescription = get_sub_field('Content_Post_Trend_Content_Title_Image_Description'); ?>


                                        <?php if (isset($ifPostTrendContentTitleImageDescription) && !empty($ifPostTrendContentTitleImageDescription)) : ?>

                                            <div class="pt-4 pb-4" style="position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; width: 100vw; background-color: white;">

                                                <div class="container mx-auto px-lg-0 px-4">
                                                    <div class="p-0 w-100 px-0">
                                                        <div class="col-12 p-0 pt-0 pb-0">
                                                            <div class="row">
                                                                <?php if (have_rows('Content_Post_Trend_Content_Title_Image_Description')) : ?>

                                                                    <?php while (have_rows('Content_Post_Trend_Content_Title_Image_Description')) : the_row() ?>

                                                                        <?php $titleContentPostTrendContentTitleImageDescription = get_sub_field('Title_Content_Post_Trend_Content_Title_Image_Description'); ?>
                                                                        <?php $titleColorContent = get_sub_field('Title_Color_Content_Post_Trend_Content_Title_Image_Description'); ?>
                                                                        <?php $backgroundTitleColor = get_sub_field('Background_Title_Color_Content_Post_Trend_Content_Title_Image_Description_copy'); ?>
                                                                        <?php $firstDescriptionContentPostTrendContentTitleImageDescription = get_sub_field('First_Description_Content_Post_Trend_Content_Title_Image_Description'); ?>
                                                                        <?php $secondDescriptionContentPostTrendContentTitleImageDescription = get_sub_field('Second_Description_Content_Post_Trend_Content_Title_Image_Description'); ?>
                                                                        <?php $imageContentPostTrendContentTitleImageDescription = get_sub_field('Image_Content_Post_Trend_Content_Title_Image_Description'); ?>
                                                                        <?php $lastDescriptionContentPostTrendContentTitleImageDescription = get_sub_field('Last_Description_Content_Post_Trend_Content_Title_Image_Description'); ?>

                                                                        <h2 class="NotoSans-Bold title-color mb-4 pt-4 position-relative" style="z-index: 1;">
                                                                            <span class="background-title-round-two" <?php echo $backgroundTitleColor ? 'data-bg-color="' . esc_attr($backgroundTitleColor) . '"' : ''; ?> style="color: <?= $titleColorContent ?> !important"><?= strip_tags($titleContentPostTrendContentTitleImageDescription); ?></span>
                                                                        </h2>
                                                                        <div class="NotoSans-Regular description-color px-2 mt-2 pb-2">
                                                                            <?= strip_tags($firstDescriptionContentPostTrendContentTitleImageDescription, '<strong><em><ul><li><blockquote><a><br><h1><h2><h3><h4><h5>'); ?>
                                                                        </div>
                                                                        <div class="NotoSans-Regular description-color px-2 mt-2 pb-3">
                                                                            <?= strip_tags($secondDescriptionContentPostTrendContentTitleImageDescription, '<strong><em><ul><li><blockquote><a><br><h1><h2><h3><h4><h5>'); ?>
                                                                        </div>
                                                                        <div class="d-flex justify-content-center align-items-center">
                                                                            <div class="col-12 col-lg-10">
                                                                                <?= wp_get_attachment_image($imageContentPostTrendContentTitleImageDescription, 'full', '', ['class' => '', 'style' => 'width: 100%; height: 100%; object-fit: cover;']); ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="NotoSans-Regular description-color px-2 mb-4 pt-4">
                                                                            <?= strip_tags($lastDescriptionContentPostTrendContentTitleImageDescription, '<strong><em><ul><li><blockquote><a><br><div><span><h1><h2><h3><h4><h5><style>'); ?>
                                                                        </div>

                                                                    <?php endwhile; ?>

                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        <?php endif; ?>


                                        <?php /* Content with Subcontent  /  Content With Background Color */  ?>
                                        <?php $ifPostTrendContentSubcontent = get_sub_field('If_Post_Trend_Content_Subcontent'); ?>
                                        <?php $contentPostTrendSubcontent = get_sub_field('Content_Post_Trend_Subcontent'); ?>


                                        <?php if (isset($ifPostTrendContentSubcontent) && !empty($ifPostTrendContentSubcontent)) : ?>

                                            <div class="" style="position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; width: 100vw; background-color: white; margin-top: 1rem; margin-bottom: 2rem;">

                                                <div class="container mx-auto px-lg-0 px-4">
                                                    <div class="p-5 pt-3 w-100 px-0">
                                                        <div class="col-12 p-lg-5 p-3 pt-lg-0 pb-lg-0 pt-0 pb-0">
                                                            <div class="row">
                                                                <?php if (have_rows('Content_Post_Trend_Subcontent')) : ?>

                                                                    <?php while (have_rows('Content_Post_Trend_Subcontent')) : the_row() ?>


                                                                        <?php $titleContentPostTrendSubcontent = get_sub_field('Title_Content_Post_Trend_Subcontent'); ?>
                                                                        <?php $subcontentPostTrend = get_sub_field('Subcontent_Post_Trend'); ?>

                                                                        <h2 class="NotoSans-Bold title-color mb-4 pt-4">
                                                                            <?= strip_tags($titleContentPostTrendSubcontent); ?>
                                                                        </h2>
                                                                        <a href="" target="_blank"></a>
                                                                        <div class="container mx-auto px-0">
                                                                            <div class="p-5 pt-3 w-100 px-0">
                                                                                <div class="col-12 p-lg-5 p-3 pt-lg-0 pb-lg-0 pt-0 pb-0">
                                                                                    <div class="row">
                                                                                        <?php if (have_rows('Subcontent_Post_Trend')) : ?>

                                                                                            <?php while (have_rows('Subcontent_Post_Trend')) : the_row() ?>

                                                                                                <?php $titleSubcontentPostTrend = get_sub_field('Title_Subcontent_Post_Trend'); ?>
                                                                                                <?php $imageSubcontentPostTrend = get_sub_field('Image_Subcontent_Post_Trend'); ?>
                                                                                                <?php $firstDescriptionSubcontentPostTrend = get_sub_field('First_Description_Subcontent_Post_Trend'); ?>

                                                                                                <h3 class="NotoSans-Bold title-color mb-4 pt-4 text-center">
                                                                                                    <?= strip_tags($titleSubcontentPostTrend); ?>
                                                                                                </h3>

                                                                                                <div class="d-flex flex-md-row flex-column position-relative justify-content-center align-items-center">
                                                                                                    <div class="col-md-4 col-lg-4" style="border-radius: 1rem;">
                                                                                                        <div class="col-12">
                                                                                                            <?= wp_get_attachment_image($imageSubcontentPostTrend, 'full', '', ['style' => 'height: 170px;width: 100%;object-fit: contain;']); ?>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                    <div class="col-md-8 col-lg-8 d-flex justify-content-center align-items-center">
                                                                                                        <div class="col-11 col-md-12 col-lg-12 p-0 m-0 pt-4 pb-4">
                                                                                                            <div class="container-title-speaker-content-out mx-lg-5 ms-3">
                                                                                                                <div class="container-content-outstanding">
                                                                                                                    <p class="NotoSans-Regular container-title-speaker-content-outstanding">
                                                                                                                        <?= strip_tags($firstDescriptionSubcontentPostTrend, '<strong><em><ul><li><blockquote><a><br>'); ?>
                                                                                                                    </p>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>

                                                                                            <?php endwhile; ?>

                                                                                        <?php endif; ?>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    <?php endwhile; ?>

                                                                <?php endif; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                        <?php endif; ?>


                                    <?php endwhile; ?>

                                <?php endif; ?>

                            <?php endif; ?>
                        <?php endif; ?>


                    <?php endwhile; ?>
                <?php endif; ?>

            <?php endif ?>

        <?php endif; ?>

        <?php if ($currentPostId == 840) : ?>

            <?php /* burned code for this single post Innsider Data */ ?>

            <?php if (isset($bannerPostInnsiderData) && !empty($bannerPostInnsiderData)) : ?>
                <div class="five-background-taxonomy" style="position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; width: 100vw; margin-top: 1rem; padding-bottom: 1.5rem;">
                    <div class="container container-bg-single banner-taxonomy-academy" data-aos="zoom-in">
                        <?php if (isset($bannerPostInnsiderData) && !empty($bannerPostInnsiderData)) : ?>
                            <img src="<?= esc_url(wp_get_attachment_url($bannerPostInnsiderData)); ?>" alt="Herramientas" class="bg-single-iNNsider-Data">
                        <?php endif; ?>
                        <div class="wrapper-taxonomy-academy"></div>
                    </div>
                    <div class="container p-0">
                        <div class="row m-0 p-0">
                            <p class="NotoSans-Regular title-color text-align-justify mb-lg-4 mb-4 m-0 p-0 mt-4 px-3 px-lg-0">
                                Las recomendaciones actuales incluyen un abordaje terapéutico centrado en la persona a través de
                                modificaciones del estilo de vida como la actividad física, pérdida de peso, alimentación saludable
                                así como medicamentos que controlan los niveles de glicemia en sangre.
                            </p>
                        </div>
                    </div>
                </div>

            <?php endif; ?>

            <div class="container mt-4">
                <div class="row d-flex justify-content-center align-align-items-center">
                    <div class="col-12 d-flex flex-lg-row">
                        <div class="col-12 mx-1" id="secondline">
                            <hr>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mt-2 p-1 pb-lg-0 pb-2">
                <div class="row m-0 p-0">
                    <div class="container d-flex justify-content-center align-items-center">
                        <div class="col-12 d-flex justify-content-center align-items-center flex-lg-row flex-column">
                            <div class="col-12 col-lg-6 container-card-single-innsiderdata me-lg-4 mt-3">
                                <div class="card-single-innsiderdata">
                                    <div class="row m-0 p-0 d-flex justify-content-start align-items-center flex-lg-row flex-column">
                                        <div class="col-6 figure m-4 p-0">
                                            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/Icono1.png">
                                        </div>
                                        <div class="col-6 text-center text-lg-start">
                                            <h3 class="NotoSans-Bold title-color" style="text-transform: uppercase;">Objetivos:</h3>
                                        </div>
                                    </div>
                                    <div class="row m-0 p-0">
                                        <div class="col-12">
                                            <p class="NotoSans-Regular title-color mx-4 p-0 text-justify">
                                                Determinar los patrones de prescripción de antidiabéticos
                                                no insulínicos en un grupo de pacientes de Colombia.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-6 container-card-single-innsiderdata mt-3">
                                <div class="card-single-innsiderdata">
                                    <div class="row m-0 p-0 d-flex justify-content-start align-items-center flex-lg-row flex-column">
                                        <div class="col-6 figure m-4 p-0">
                                            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/Icono2.png">
                                        </div>
                                        <div class="col-6 text-center text-lg-start">
                                            <h3 class="NotoSans-Bold title-color" style="text-transform: uppercase;">Métodos:</h3>
                                        </div>
                                    </div>
                                    <div class="row m-0 p-0">
                                        <div class="col-12">
                                            <p class="NotoSans-Regular title-color mx-4 p-0 text-justify">
                                                Estudio de corte transversal sobre el uso de antidiabéticos
                                                no insulínicos, a partir de una base de datos poblacionales
                                                de pacientes en tratamiento en 2022. Se establecieron frecuencias,
                                                proporciones y se determinó la dosis diaria definida de cada
                                                antidiabético por 1000 habitantes/día (DHD).
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mt-5 pt-3 pb-3 border" style="background-color: #033572; color: white; border-radius: 1rem; text-transform: uppercase;">
                <div class="row m-0 p-0">
                    <div class="container d-flex justify-content-center align-items-center NotoSans-Bold">
                        <h4>Resultados</h4>
                    </div>
                </div>
            </div>

            <div class="container mt-4 mb-3 pt-5 pb-5 border" style="background: #00A1DE; color: white; border-radius: 1rem;">
                <div class="row m-0 p-0">
                    <div class="container px-lg-5 text-justify NotoSans-Regular">
                        <p class="m-0 p-0">
                            1. Se identificaron <strong>155.381</strong> pacientes con <strong>DM tipo 2,</strong> con edad media de <strong>67,1±12,0</strong> años.
                        </p>
                    </div>
                </div>
            </div>

            <div class="container mt-4 mb-3 pt-5 pb-5 border" style="background: #00A1DE; color: white; border-radius: 1rem;">
                <div class="row m-0 p-0">
                    <div class="container px-lg-5 text-justify NotoSans-Regular">
                        <p class="m-0 p-0">
                            2. Los antidiabéticos más empleados según DHD fueron metformina <strong>(9,46 DHD),</strong>
                            empagliflozina <strong>(5,53),</strong> sitagliptina <strong>(2,86),</strong> linagliptina <strong>(2,44)</strong> y dapagliflozina <strong>(2,3).</strong>
                            Los esquemas terapéuticos más frecuentes fueron metformina en monodosis y metformina
                            en combinación con inhibidores de la enzima dipeptidil peptidasa 4 (iDPP-4).
                            En total se identificaron 61 combinaciones diferentes.
                        </p>
                    </div>
                </div>
            </div>

            <div class="container mt-4 mb-5 mb-3 pt-5 pb-5 border" style="background: #00A1DE; color: white; border-radius: 1rem;">
                <div class="row m-0 p-0">
                    <div class="container px-lg-5 text-justify NotoSans-Regular">
                        <p class="m-0 p-0">
                            3. Las comorbilidades de tipo cardiovascular más frecuentes fueron:

                        <ul class="mt-4 mx-4" style="list-style-type: none;">
                            <li><strong>- Hipertensión arterial (67,6%)</strong></li>
                            <li><strong>- Enfermedad renal crónica (6,3%)</strong></li>
                            <li><strong>- Cardiopatía isquémica coronaria (3,8%)</strong></li>
                        </ul>
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-5" style="position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; width: 100vw; background: #FBE5EC; margin-top: 1rem;">
                <div class="container mt-2 p-1 pb-lg-0 pb-2">
                    <div class="row m-0 p-0">
                        <div class="container d-flex justify-content-center align-items-center">
                            <div class="col-12 d-flex justify-content-center align-items-center flex-lg-row flex-column">
                                <div class="col-12 col-lg-6 container-card-single-innsiderdata d-flex justify-content-center align-items-center" style="background-color: transparent !important;">
                                    <div class="card-other-single-innsiderdata w-100">
                                        <div class="row m-0 p-0 d-flex justify-content-center align-items-center flex-column">
                                            <div class="col-12 figure m-4 p-0">
                                                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/Icono3.png">
                                            </div>
                                            <div class="col-12 text-center">
                                                <h3 class="NotoSans-Bold title-color" style="text-transform: uppercase;">Objetivos:</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 container-card-single-innsiderdata d-flex justify-content-center align-items-center" style="background-color: transparent !important;">
                                    <div class="card-single-innsiderdata">
                                        <div class="row m-0 p-0">
                                            <div class="col-12">
                                                <p class="NotoSans-Regular title-color mx-4 p-0 text-justify">
                                                    Este grupo de pacientes con DM tipo 2 fue tratado principalmente con
                                                    metformina sola o asociada con otros antidiabéticos orales; a pesar
                                                    de los cambios en el tratamiento en los últimos años, un número
                                                    significativo de pacientes con condiciones cardiovasculares concomitantes
                                                    no están recibiendo agentes antidiabéticos adecuados, como el cotransportador
                                                    de sodio-glucosa tipo 2 (iSLGT-2) o los agonistas del receptor del
                                                    péptido-1similar al glucagón (arGLP-1) que pueden ofrecer beneficios
                                                    adicionales con un menor riesgo cardiovascular.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="" style="position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; width: 100vw; background-color: #ffffff; margin-top: 1rem;">
                <div class="container mx-auto px-lg-0 px-4">
                    <div class="p-3 p-lg-5 pt-1 pt-lg-5 w-100 px-0">
                        <div class="col-12 p-0">
                            <div class="row">
                                <div class="NotoSans-Regular description-color px-2">
                                    Estos hallazgos son el resultado del estudio <strong>“Noninsulin Antidiabetic Prescription Patterns in Colombia:
                                        A Cross-sectional Study”.</strong>
                                    <br>
                                    <br>
                                    <br>
                                </div>
                                <div class="NotoSans-Regular description-color px-2">
                                    Referencia: Machado-Alba JE, Gaviria-Mendoza A, et al. Noninsulin antidiabetic prescription
                                    patterns in Colombia: a cross-sectional study. Therapeutic Advances in Endocrinology
                                    and Metabolism. 2024;15. doi:10.1177/20420188241271806.
                                    <br>
                                    <br>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="NotoSans-Regular description-color px-2 mb-4">
                <div class="d-flex justify-content-center align-items-center mt-1" style="text-align: center;">
                    <a class="px-4 p-3 NotoSans-Regular" style="border-radius: 1.3rem; text-align: center; background: #00A1DE; color: white; font-size: 1.5rem; text-decoration: none;" href="https://journals.sagepub.com/doi/10.1177/20420188241271806" target="_blank" rel="noopener">
                        <strong> Conozca el estudio aquí </strong>
                    </a>
                </div>
            </div>

            <?php /* End burned code for this single post Innsider Data*/ ?>

        <?php endif; ?>

        <?php if ($currentPostId == 854) : ?>

            <?php /* burned code for this single post Innsider Data */ ?>

            <?php if (isset($bannerPostInnsiderData) && !empty($bannerPostInnsiderData)) : ?>
                <div class="container six-background-taxonomy mt-lg-3 mt-3 p-lg-5 p-2 pb-lg-0 pb-2">
                    <div class="container container-bg-single banner-taxonomy-academy aos-init aos-animate" data-aos="zoom-in">
                        <?php if (isset($bannerPostInnsiderData) && !empty($bannerPostInnsiderData)) : ?>
                            <img src="<?= esc_url(wp_get_attachment_url($bannerPostInnsiderData)); ?>" alt="Herramientas" class="bg-single-trend">
                        <?php endif; ?>
                        <div class="wrapper-taxonomy-academy"></div>
                    </div>
                    <div class="container">
                        <div class="row m-0 p-0">
                            <p class="NotoSans-Regular title-color text-align-justify mb-lg-4 mb-4 m-0 p-0 mt-4 px-3 px-lg-0">
                                Las recomendaciones actuales incluyen un abordaje terapéutico centrado en la persona a través de
                                modificaciones del estilo de vida como la actividad física, pérdida de peso, alimentación saludable
                                así como medicamentos que controlan los niveles de glicemia en sangre.
                            </p>
                        </div>
                    </div>
                </div>

            <?php endif; ?>

            <div class="container mt-4">
                <div class="row d-flex justify-content-center align-align-items-center">
                    <div class="col-12 d-flex flex-lg-row">
                        <div class="col-12 mx-1" id="secondline">
                            <h1 class="NotoSans-Bold title-color mx-4 p-0 text-start">¿QUIÉNES FUERON INCLUIDOS?</h1>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mt-2 p-1 pb-lg-0 pb-2">
                <div class="row m-0 p-0">
                    <div class="container d-flex justify-content-center align-items-center">
                        <div class="col-12 d-flex justify-content-center align-items-center flex-lg-row flex-column">
                            <div class="col-12 col-lg-3 container-other-card-single-innsiderdata mt-3" style="background: white !important;">
                                <div class="card-other-single-innsiderdata w-100">
                                    <div class="row m-0 p-0 d-flex justify-content-center align-items-center flex-lg-row flex-column">
                                        <div class="col-12 figure p-0 w-100">
                                            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/NOTICIA--01.png">
                                        </div>
                                    </div>
                                    <div class="row m-0 p-0">
                                        <div class="col-12">
                                            <p class="NotoSans-Bold title-color mt-2 mx-4 p-0 text-center">
                                                2.860 hogares de <br>
                                                Bogotá encuestados <br>
                                                Entre 2022 – 2023
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3 container-other-card-single-innsiderdata mt-3" style="background: white !important;">
                                <div class="card-other-single-innsiderdata w-100">
                                    <div class="row m-0 p-0 d-flex justify-content-center align-items-center flex-lg-row flex-column">
                                        <div class="col-12 figure p-0 w-100">
                                            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/NOTICIA--02.png">
                                        </div>
                                    </div>
                                    <div class="row m-0 p-0">
                                        <div class="col-12">
                                            <p class="NotoSans-Bold title-color mt-2 mx-4 p-0 text-center">
                                                65.3% mujeres <br>
                                                34.7% hombres
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3 container-other-card-single-innsiderdata mt-3" style="background: white !important;">
                                <div class="card-other-single-innsiderdata w-100">
                                    <div class="row m-0 p-0 d-flex justify-content-center align-items-center flex-lg-row flex-column">
                                        <div class="col-12 figure p-0 w-100">
                                            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/NOTICIA--03.png">
                                        </div>
                                    </div>
                                    <div class="row m-0 p-0">
                                        <div class="col-12">
                                            <p class="NotoSans-Bold title-color mt-2 mx-4 p-0 text-center">
                                                1.071 muestras de <br>
                                                laboratorio
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-lg-3 container-other-card-single-innsiderdata mt-3" style="background: white !important;">
                                <div class="card-other-single-innsiderdata w-100">
                                    <div class="row m-0 p-0 d-flex justify-content-center align-items-center flex-lg-row flex-column">
                                        <div class="col-12 figure p-0 w-100">
                                            <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/NOTICIA--04.png">
                                        </div>
                                    </div>
                                    <div class="row m-0 p-0">
                                        <div class="col-12">
                                            <p class="NotoSans-Bold title-color mt-2 mx-4 p-0 text-center">
                                                81.7% estratos <br>
                                                socioeconómicos bajo <br>
                                                y medio bajo
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mt-5 pt-3 pb-3 border" style="background-color: #033572; color: white; border-radius: 1rem; text-transform: uppercase;">
                <div class="row m-0 p-0">
                    <div class="container d-flex justify-content-center align-items-center NotoSans-Bold">
                        <h4>Resultados</h4>
                    </div>
                    <div class="container d-flex justify-content-center align-items-center NotoSans-Bold">
                        <h4>PREVALENCIA ESTIMADA</h4>
                    </div>
                </div>
            </div>

            <div class="container mt-4 mb-3 pt-5 pb-5 border" style="background: #00A1DE; color: white; border-radius: 1rem;">
                <div class="row m-0 p-0">
                    <div class="container px-lg-5 text-justify NotoSans-Regular">
                        <p class="m-0 p-0">
                            <strong>DM2* ≥18 años en Bogotá: </strong>11,0 % (IC 95 %, 9,0–13,5 %; error estándar relativo, 10,5%)
                        </p>
                    </div>
                </div>
            </div>

            <div class="container mt-4 mb-3 pt-5 pb-5 border" style="background: #00A1DE; color: white; border-radius: 1rem;">
                <div class="row m-0 p-0">
                    <div class="container px-lg-5 text-justify NotoSans-Regular">
                        <p class="m-0 p-0">
                            <strong>Síndrome Metabólico, ATP III: </strong>33.9 % (IC 95 %, 29.5–38.6 %; error estándar relativo, 6,8%)
                        </p>
                    </div>
                </div>
            </div>

            <div class="container mt-4 mb-5 mb-3 pt-5 pb-5 border" style="background: #00A1DE; color: white; border-radius: 1rem;">
                <div class="row m-0 p-0">
                    <div class="container px-lg-5 text-justify NotoSans-Regular">
                        <p class="m-0 p-0">
                            <strong>Obesidad abdominal: </strong>47.8 % (IC 95 %, 45.2-50.3 %; error estándar relativo, 2.7%)
                        </p>
                    </div>
                </div>
            </div>

            <div class="container mt-4 mb-5 mb-3 pt-5 pb-5 border" style="background: #00A1DE; color: white; border-radius: 1rem;">
                <div class="row m-0 p-0">
                    <div class="container px-lg-5 text-justify NotoSans-Regular">
                        <p class="m-0 p-0">
                            <strong>Niveles de triglicéridos altos: </strong>44.1 % (IC 95 %, 39.6 – 48.7 %; error estándar relativo, 5.3%)
                        </p>
                    </div>
                </div>
            </div>

            <div class="container mt-4 mb-5 mb-3 pt-5 pb-5 border" style="background: #00A1DE; color: white; border-radius: 1rem;">
                <div class="row m-0 p-0">
                    <div class="container px-lg-5 text-justify NotoSans-Regular">
                        <p class="m-0 p-0">
                            <strong>Hipertensión: </strong>28.3% (IC 95 %, 26.3 – 30.4%; error estándar relativo, 3.7%)
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-0 mb-0 pb-0" style="position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; width: 100vw; background: #FBE5EC; margin-top: 1rem;">
                <div class="container mt-2 p-1 pb-lg-0">
                    <div class="row m-0 p-0">
                        <div class="container d-flex justify-content-center align-items-center">
                            <div class="col-12 d-flex justify-content-center align-items-center flex-lg-row flex-column">
                                <div class="col-12 col-lg-4 container-card-single-innsiderdata d-flex justify-content-center align-items-center" style="background-color: transparent !important;">
                                    <div class="card-other-single-innsiderdata w-100">
                                        <div class="row m-0 p-0 d-flex justify-content-center align-items-center flex-column">
                                            <div class="col-12 text-center">
                                                <h3 class="NotoSans-Bold title-color" style="text-transform: uppercase;">Conclusiones</h3>
                                            </div>
                                            <div class="col-12 figure m-4 p-0">
                                                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/NOTICIA--05.png">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-8 container-card-single-innsiderdata d-flex justify-content-center align-items-center" style="background-color: transparent !important;">
                                    <div class="card-single-innsiderdata">
                                        <div class="row m-0 p-0">
                                            <div class="col-12">
                                                <ul class="mt-4 mx-4 NotoSans-Regular title-color text-justify" style="">
                                                    <li><strong>Uno de los estudios de campo más grandes realizados en Colombia</strong></li>
                                                    <li><strong>La prevalencia de DM2 en la ciudad de Bogotá fue superior a las reportadas en análisis previos. Esta prevalencia comienza a acercarse a la de otras capitales como Ciudad de México o Sao Paulo. Explicado posiblemente por:</strong></li>
                                                    <li><strong>Rápido crecimiento de la población relacionado con la migración</strong></li>
                                                    <li><strong>Los factores que se asociaron con la prevalencia de DM2 fueron el bajo nivel educativo, la obesidad abdominal, el nivel socioeconómico bajo y muy bajo, el sobrepeso y la obesidad, el nivel alto de triglicéridos y edad ≥55 años.</strong></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="mt-0 mb-0 pb-0" style="position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; width: 100vw; background: #EEA7BF; margin-top: 1rem;">
                <div class="container p-1 pb-lg-0 pb-2">
                    <div class="row m-0 p-0">
                        <div class="container d-flex justify-content-center align-items-center">
                            <div class="col-12 d-flex justify-content-center align-items-center flex-lg-row flex-column">
                                <div class="col-12 col-lg-12 mt-2 mb-2" style="background-color: transparent !important;">
                                    <div class="card-single-innsiderdata">
                                        <div class="row m-0 p-0">
                                            <div class="col-12">
                                                <p class="mt-4 mx-4 NotoSans-Regular title-color text-justify" style="">
                                                    Los resultados de este estudio deben alarmar a las autoridades sanitarias de la ciudad dado el rápido incremento de DM2, por lo que se deben implementar programas integrales de prevención, detección y manejo de la DM2, sus complicaciones y los factores de riesgo determinantes.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="" style="position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; width: 100vw; background-color: #ffffff; margin-top: 1rem;">
                <div class="container mx-auto px-lg-0 px-4">
                    <div class="p-3 p-lg-5 pt-1 pt-lg-5 w-100 px-0">
                        <div class="col-12 p-0">
                            <div class="row">
                                <div class="NotoSans-Regular description-color px-2">
                                    DM2; diabetes mellitus tipo 2.
                                    <br>
                                    <br>
                                    <br>
                                </div>
                                <div class="NotoSans-Regular description-color px-2">
                                    Estos hallazgos son el resultado del estudio: “Prevalence of Type 2 Diabetes, Overweight, Obesity, and Metabolic Syndrome in Adults in Bogotá, Colombia, 2022– 2023: A Cross-Sectional Population Survey”
                                    <br>
                                    <br>
                                    <br>
                                </div>
                                <div class="NotoSans-Regular description-color px-2">
                                    Referencia: Arteaga JM, Latorre-Santos C, Ibáñez-Pinilla M,et al. Prevalence of Type 2 Diabetes, Overweight, Obesity, and Metabolic Syndrome in Adults in Bogotá, Colombia, 2022–2023: A Cross-Sectional Population Survey. Annals of Global Health. 2024; 90(1): 67, 1–14. DOI: https://doi.org/10.5334/aogh.4539
                                    <br>
                                    <br>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="NotoSans-Regular description-color px-2 mb-4">
                <div class="d-flex justify-content-center align-items-center mt-1" style="text-align: center;">
                    <a class="px-4 p-3 NotoSans-Regular" style="border-radius: 1.3rem; text-align: center; background: #00A1DE; color: white; font-size: 1.5rem;" href="https://doi.org/10.5334/aogh.4539" target="_blank" rel="noopener">
                        <strong> Conozca el estudio aquí </strong>
                    </a>
                </div>
            </div>

            <?php /* End burned code for this single post Innsider Data*/ ?>

        <?php endif; ?>

        <?php /* Code Other Post */  ?>
        <?php $currentPostInnsiderData = array($currentPostId); ?>

        <?php $listPostInnsiderData = new WP_Query(
            array(
                'post_type' => 'innsiderdata',
                'posts_per_page' => -1,
                'order' => 'ASC'
            )
        );
        ?>

        <?php $postsIds = wp_list_pluck($listPostInnsiderData->posts, 'ID') ?>

        <?php $filteredPostsInnsiderData = array_diff($postsIds, $currentPostInnsiderData); ?>

        <?php if (!empty($filteredPostsInnsiderData)) : ?>

            <?php $filteredPostsQueryInnsiderData = new WP_Query(
                array(
                    'post__in' => $filteredPostsInnsiderData,
                    'post_type' => 'innsiderdata',
                    'posts_per_page' => -1,
                    'order' => 'ASC',
                    'orderby' => 'post_date',
                    'post_status' => 'publish'
                )
            ); ?>

            <?php if ($filteredPostsQueryInnsiderData->have_posts()) : ?>

                <div class="container p-0 pt-lg-0">

                    <div class="" style="background-color: #F9ECEA !important;">
                        <div class="row d-flex flex-lg-row flex-column p-0 pt-4 m-0 px-lg-5">

                            <div class="row d-flex flex-lg-row flex-column justify-content-start align-items-center">

                                <?php while ($filteredPostsQueryInnsiderData->have_posts()) : $filteredPostsQueryInnsiderData->the_post() ?>

                                    <?php $thePermalink = get_the_permalink(); ?>

                                    <?php $imgPostInnsiderData = get_field('Img_Post_Tools'); ?>

                                    <div class="col-12 col-md-4 col-lg-4 col-xl-3 col-xxl-3 col-xxxl-3 d-flex flex-column justify-content-start align-items-center card-taxonomies-subcategory-academy-events m-0 p-0 mt-3 mb-3">
                                        <a class="custom-width" href="<?= $thePermalink ?>" onclick="saveLogsClick('Clic en tarjeta `<?= the_title(); ?>`');" style="text-decoration: none;">
                                            <div class="mb-4 figure">
                                                <?php if (isset($imgPostInnsiderData) && !empty($imgPostInnsiderData)) : ?>
                                                    <?php echo wp_get_attachment_image($imgPostInnsiderData, 'full', '', ['style' => 'object-fit: fill']); ?>
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
        <?php /* End Code Other Post */ ?>

        <div class="container m-lg-3 mx-lg-auto m-3 px-0">
            <h5 class="NotoSans-Bold title-color">
                <?php $codePromomats = get_field('code_promomats'); ?>
                <p><?= $codePromomats ?></p>
            </h5>
        </div>

    <?php endif; ?>

    <?php /* End Post display for Innsider Data Post Types */ ?>



    <?php /* Post display for experiences Post Types */ ?>

    <?php $listPostExperiences = new WP_Query(
        array(
            'post_type' => 'experiences',
            'posts_per_page' => -1,
            'order' => 'ASC'
        )
    );
    ?>

    <?php $postsIds = wp_list_pluck($listPostExperiences->posts, 'ID') ?>

    <?php if (is_single() && in_array($currentPostId, $postsIds)) : ?>

        <?php if ($currentPostId === 871) : ?>

            <?php $contentRegister = get_post_meta($currentPostId, 'Content_Register', true); ?>

            <?php if (isset($currentPostId) && !empty($currentPostId)) : ?>

                <?php $fileContent = get_posts(array(
                    'post_type' => 'attachment',
                    'posts_per_page' => 1,
                    'post_parent' => $currentPostId,
                )) ?>

                <?php $thePermalink = get_the_permalink(); ?>

                <?php foreach ($fileContent as $file) : ?>
                    <?php $urlPdfFile = $file->guid; ?>
                <?php endforeach; ?>

                <?php if ($contentRegister === '1') : ?>

                    <?php if (!is_user_logged_in()) : ?>

                        <?php $login_url = wp_login_url($thePermalink); ?>
                        <?php $link = $login_url; ?>
                        <script>
                            window.location.href = '<?php echo $link; ?>';
                        </script>

                    <?php endif ?>

                <?php endif; ?>

                <?php if (is_singular('experiences')) :  ?>
                    <?php $experiences_page = get_page_by_title('Experiencias'); ?>
                    <?php $experiences_url = $experiences_page; ?>
                    <?php $bannerPostType = get_the_post_thumbnail_url($experiences_url); ?>

                <?php endif; ?>

                <div class="container banner-academy mt-5" data-aos="zoom-in">
                    <img class="bg-banner-academy" src="<?= $bannerPostType; ?>" alt="Podcast">
                    <div class="wrapper-banner-academy">
                        <div class="container-text-banner-academy"></div>
                    </div>
                </div>

                <div class="container p-lg-5 pb-lg-0 p-1">
                    <div class="container background-single-experience p-2">
                        <div class="p-5 pt-3 pt-lg-5 w-100">

                            <h1 class="NotoSans-Bold title-color mb-5 pb-2 d-none d-lg-block"><?php the_title(); ?></h1>
                            <h5 class="NotoSans-Bold title-color mb-2 pb-2 d-block d-lg-none"><?php the_title(); ?></h5>

                            <div class="col-lg-12">
                                <div class="row justify-content-center">
                                    <div class="col-12 d-flex justify-content-center align-items-center flex-column mt-lg-5 mt-2 mb-5">

                                        <?php if ($urlPdfFile) : ?>
                                            <embed src="<?= $urlPdfFile ?>" type="application/pdf" class="d-none d-lg-block" width="100%" height="100%" style="width: 90%; height: 100vh; border: none">
                                            <iframe src="https://drive.google.com/viewerng/viewer?embedded=true&url=<?= $urlPdfFile ?>" class="d-block d-lg-none" style="width: 90%; height: 500px;" frameborder="0"></iframe>

                                            <div class="w-75 btn-view-more mt-5 d-block d-lg-none">
                                                <a href="<?= $urlPdfFile ?>" download class="text-decoration-none text-light">Descargar PDF</a>
                                            </div>

                                        <?php endif; ?>

                                        <?php $otherPdf = '' ?>


                                        <?php if (isset($otherPdf) && !empty($otherPdf)) : ?>

                                            <embed src="<?= $otherPdf ?>" type="application/pdf" class="d-none d-lg-block" width="100%" height="100%" style="width: 90%; height: 100vh; border: none">
                                            <iframe src="https://drive.google.com/viewerng/viewer?embedded=true&url=<?= $otherPdf ?>" class="d-block d-lg-none" style="width: 90%; height: 500px;" frameborder="0"></iframe>

                                            <div class="w-75 btn-view-more mt-5 d-block d-lg-none">
                                                <a href="<?= $otherPdf ?>" download class="text-decoration-none text-light">Descargar PDF</a>
                                            </div>

                                        <?php endif; ?>

                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

            <?php endif; ?>

        <?php endif; ?>

        <div class="container m-lg-3 mx-lg-auto m-3 px-0">
            <h5 class="NotoSans-Bold title-color">
                <?php $codePromomats = get_field('code_promomats'); ?>
                <p><?= $codePromomats ?></p>
            </h5>
        </div>

    <?php endif; ?>

    <?php /* End Post display for experiences Post Types */ ?>





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
                                                <a class="custom-width" href="<?= esc_url(get_permalink($postActivityId) . '?module_id=' . $postActivityId . '&content_id=' . $index . '&tax=' . $taxId); ?>" onclick="saveLogsClick('Clic en tarjeta `<?= $titleModuleAcademy; ?>`');" style="text-decoration: none;">
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
            <?php $bannerPostTrendMovil = get_field('Banner_Post_Trend_movil'); ?>
            <?php $subtitlePostTrend = get_field('Subtitle_Post_Trend'); ?>
            <?php $ifPostTrendVideo = get_field('If_Post_Trend_Video'); ?>
            <?php $uRLPostTrend = get_field('URL_Post_Trend'); ?>
            <?php $ifPostTrendPdf = get_field('If_Post_Trend_Pdf'); ?>
            <?php $pdfPostTrend = get_field('Pdf_Post_Trend'); ?>
            <?php $contentPostTrend = get_field('Content_Post_Trend'); ?>
            <?php $postsIds = wp_list_pluck($listPostTrends->posts, 'ID') ?>
            <?php $thumbnailUrlPostTrend = obtenerMiniaturaVimeo($uRLPostTrend);  ?>

            <?php /* New Variables to Content With Different Options */  ?>
            <?php $ifPostTrendWithDiferentOptions = get_field('If_Post_Trend_With_Diferent_Options'); ?>
            <?php $contentPostTrendWithDifferentOptions = get_field('Content_Post_Trend_With_Different_Options'); ?>


            <?php if (is_single() && in_array($currentPostId, $postsIds)) : ?>

                <?php if (isset($ifPostTrendWithDiferentOptions) && !empty($ifPostTrendWithDiferentOptions)) : ?>
                    <?php if (isset($contentPostTrendWithDifferentOptions) && !empty($contentPostTrendWithDifferentOptions)) : ?>

                        <?php if (have_rows('Content_Post_Trend_With_Different_Options')) : ?>
                            <?php while (have_rows('Content_Post_Trend_With_Different_Options')) : the_row() ?>

                                <?php /* Description To Banner */  ?>
                                <?php $descriptionBannerPostTrendContent = get_sub_field('Description_Banner_Post_Trend_Content'); ?>

                                <?php if (isset($descriptionBannerPostTrendContent) && !empty($descriptionBannerPostTrendContent)) : ?>

                                    <div class="container four-background-taxonomy mt-lg-3 mt-3 p-3 pt-4 pt-lg-5 p-lg-5 pb-lg-0 pb-2">
                                        <?php if (isset($bannerPostTrend) && !empty($bannerPostTrend)) : ?>
                                            <div class="container banner-academy d-lg-block d-none" data-aos="zoom-in">
                                                <img class="bg-banner-academy" src="<?php echo wp_get_attachment_image_url($bannerPostTrend, 'full', ''); ?>" alt="Podcast">
                                                <div class="wrapper-banner-academy">
                                                    <div class="container-text-banner-academy"></div>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (isset($bannerPostTrendMovil) && !empty($bannerPostTrendMovil)) : ?>
                                            <div class="container banner-academy d-block d-lg-none" data-aos="zoom-in">
                                                <img class="bg-banner-academy" src="<?php echo wp_get_attachment_image_url($bannerPostTrendMovil, 'full', ''); ?>" alt="Podcast">
                                                <div class="wrapper-banner-academy">
                                                    <div class="container-text-banner-academy"></div>
                                                </div>
                                            </div>
                                        <?php endif; ?>

                                        <div class="container">
                                            <div class="row m-0 p-0">
                                                <?php if (isset($descriptionBannerPostTrendContent) && !empty($descriptionBannerPostTrendContent)) : ?>
                                                    <p class="NotoSans-Regular text-align-justify mb-lg-4 mb-4 container-content-single mx-auto mt-4">
                                                        <?= strip_tags($descriptionBannerPostTrendContent, '<strong><em><ul><li><blockquote><a><br>'); ?>
                                                    </p>
                                                <?php endif ?>
                                            </div>
                                        </div>
                                    </div>

                                <?php endif; ?>

                            <?php endwhile; ?>
                        <?php endif; ?>

                    <?php endif; ?>

                <?php else : ?>

                    <?php if (isset($bannerPostTrend) && !empty($bannerPostTrend)) : ?>
                        <div class="container banner-academy d-lg-block d-none" data-aos="zoom-in">
                            <img class="bg-banner-academy" src="<?php echo wp_get_attachment_image_url($bannerPostTrend, 'full', ''); ?>" alt="Podcast">
                            <div class="wrapper-banner-academy">
                                <div class="container-text-banner-academy"></div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if (isset($bannerPostTrendMovil) && !empty($bannerPostTrendMovil)) : ?>
                        <div class="container banner-academy d-block d-lg-none mb-4" data-aos="zoom-in">
                            <img class="bg-banner-academy" src="<?php echo wp_get_attachment_image_url($bannerPostTrendMovil, 'full', ''); ?>" alt="Podcast">
                            <div class="wrapper-banner-academy">
                                <div class="container-text-banner-academy"></div>
                            </div>
                        </div>
                    <?php endif; ?>

                <?php endif; ?>



                <?php if (isset($ifPostTrendVideo) && !empty($ifPostTrendVideo)) : ?>
                    <?php if (isset($uRLPostTrend) && !empty($uRLPostTrend)) : ?>

                        <div class="container">
                            <div class="container-content-capsule banner-single preview-video"
                                onclick="playVideo(<?= $moduleId ?>, '<?= $uRLPostTrend; ?>', event, 'preview-video')">
                                <?php if (isset($thumbnailUrlPostTrend) && !empty($thumbnailUrlPostTrend)) : ?>
                                    <img src="<?= esc_url($thumbnailUrlPostTrend); ?>" alt="Herramientas" class="bg-single">
                                <?php elseif (isset($bannerPostTrend) && !empty($bannerPostTrend)) : ?>
                                    <img src="<?= esc_url(wp_get_attachment_url($bannerPostTrend)); ?>" alt="Herramientas" class="bg-single">
                                <?php endif; ?>

                                <i class="fas fa-play icon-play-video"></i>

                                <div class="wrapper-single second-wrapper-single p-0 m-0"></div>
                            </div>

                            <div class="player-video player-video-taxonomy banner-single " id="player"></div>

                        </div>

                        <div>
                            <?php if (isset($ifPostTrendWithDiferentOptions) && !empty($ifPostTrendWithDiferentOptions)) : ?>

                                <?php if (isset($contentPostTrendWithDifferentOptions) && !empty($contentPostTrendWithDifferentOptions)) : ?>

                                    <?php if (have_rows('Content_Post_Trend_With_Different_Options')) : ?>
                                        <?php while (have_rows('Content_Post_Trend_With_Different_Options')) : the_row() ?>

                                            <?php /* Content With Background Color */  ?>
                                            <?php $ifPostTrendContentColor = get_sub_field('If_Post_Trend_Content_Color'); ?>
                                            <?php $contentPostTrendColor = get_sub_field('Content_Post_Trend_Color'); ?>

                                            <?php if (isset($ifPostTrendContentColor) && !empty($ifPostTrendContentColor)) : ?>
                                                <?php if (isset($contentPostTrendColor) && !empty($contentPostTrendColor)) : ?>

                                                    <?php if (have_rows('Content_Post_Trend_Color')) : ?>

                                                        <?php while (have_rows('Content_Post_Trend_Color')) : the_row()  ?>

                                                            <?php /* Image - Title  /  Content With Background Color */  ?>
                                                            <?php $ifPostTrendContentImageTitleColor = get_sub_field('If_Post_Trend_Content_Image_Title'); ?>
                                                            <?php $contentPostTrendContentImageTitleColor = get_sub_field('Content_Post_Trend_Content_Image_Title'); ?>

                                                            <?php $color_content = get_sub_field('color_content'); ?>
                                                            <?php $color_title = get_sub_field('color_title'); ?>
                                                            <?php $color_description = get_sub_field('color_description'); ?>


                                                            <?php if (isset($ifPostTrendContentImageTitleColor) && !empty($ifPostTrendContentImageTitleColor)) : ?>

                                                                <div class="" style="position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; width: 100vw; background-color: <?php echo ($color_content) ?  $color_content : '#F9ECEA'; ?>   margin-top: 1rem; margin-botton: 2rem;">

                                                                    <div class="container mx-auto px-lg-0 px-4">
                                                                        <div class="p-0 w-100 px-0">
                                                                            <div class="col-12 p-0 pb-lg-0 pt-0 pb-0">
                                                                                <div class="row">

                                                                                    <?php if (have_rows('Content_Post_Trend_Content_Image_Title')) : ?>

                                                                                        <?php while (have_rows('Content_Post_Trend_Content_Image_Title')) : the_row() ?>

                                                                                            <?php $titleContentPostTrendContentImageTitleColor = get_sub_field('Title_Content_Post_Trend_Content_Image_Title'); ?>
                                                                                            <?php $imageContentPostTrendContentImageTitleColor = get_sub_field('Image__Content_Post_Trend_Content_Image_Title'); ?>

                                                                                            <h2 class="NotoSans-Bold title-color mb-4 pt-4" style="color: <?php echo ($color_title) ?  $color_title . '!important' : '#001965 !important'; ?>">
                                                                                                <?= strip_tags($titleContentPostTrendContentImageTitleColor); ?>
                                                                                            </h2>
                                                                                            <div class="d-flex justify-content-start align-items-center">
                                                                                                <div class="col-12 col-lg-12">
                                                                                                    <?= wp_get_attachment_image($imageContentPostTrendContentImageTitleColor, 'full', '', ['class' => '', 'style' => 'width: 100%; height: 100%; object-fit: cover;']); ?>
                                                                                                </div>
                                                                                            </div>

                                                                                        <?php endwhile; ?>

                                                                                    <?php endif; ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                            <?php endif; ?>


                                                            <?php /* Title - Description  /  Content With Background Color */  ?>
                                                            <?php $ifPostTrendContentTitleDescriptionColor = get_sub_field('If_Post_Trend_Content_Title_Description'); ?>
                                                            <?php $contentPostTrendContentTitleDescriptionColor = get_sub_field('Content_Post_Trend_Content_Title_Description'); ?>

                                                            <?php if (isset($ifPostTrendContentTitleDescriptionColor) && !empty($ifPostTrendContentTitleDescriptionColor)) : ?>

                                                                <div class="" style="position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; width: 100vw; background-color: <?php echo ($color_content) ?  $color_content . ';' : '#F9ECEA'; ?> margin-top: 1rem; margin-botton: 2rem;">

                                                                    <div class="container-content-capsule">
                                                                        <div class="p-5 px-lg-5 mx-lg-3 px-0 mx-md-0 mx-0 pt-3 pt-lg-5 w-100 px-0">
                                                                            <div class="col-12 p-0 px-lg-3 mx-lg-3">
                                                                                <div class="row">
                                                                                    <?php $counter = 0 ?>
                                                                                    <?php if (have_rows('Content_Post_Trend_Content_Title_Description')) : ?>

                                                                                        <?php while (have_rows('Content_Post_Trend_Content_Title_Description')) : the_row() ?>

                                                                                            <?php $titleContentPostTrendContentTitleDescriptionColor = get_sub_field('Title_Content_Post_Trend_Content_Title_Description'); ?>
                                                                                            <?php $descriptioncontentPostTrendContentTitleDescriptionColor = get_sub_field('Description_Content_Post_Trend_Content_Title_Description'); ?>

                                                                                            <h2 class="NotoSans-Bold title-color mb-4 <?= $counter > 0 ? 'pt-4' : ''; ?>" style="color: <?php echo ($color_title) ?  $color_title . '!important' : '#001965 !important'; ?>">
                                                                                                <?= strip_tags($titleContentPostTrendContentTitleDescriptionColor); ?>
                                                                                            </h2>
                                                                                            <div class="NotoSans-Regular description-color px-2" style="color: <?php echo ($color_description) ?  $color_description . '!important' : '#001965 !important'; ?>">
                                                                                                <?= strip_tags($descriptioncontentPostTrendContentTitleDescriptionColor, '<strong><em><ul><li><blockquote><a><br>'); ?>
                                                                                            </div>

                                                                                            <?php $counter++ ?>
                                                                                        <?php endwhile; ?>

                                                                                    <?php endif; ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                            <?php endif; ?>


                                                            <?php /* Title - Image - Others  /  Content With Background Color */  ?>
                                                            <?php $ifPostTrendContentTitleImageDescriptionColor = get_sub_field('If_Post_Trend_Content_Title_Image_Description'); ?>
                                                            <?php $contentPostTrendContentTitleImageDescriptionColor = get_sub_field('Content_Post_Trend_Content_Title_Image_Description'); ?>


                                                            <?php if (isset($ifPostTrendContentTitleImageDescriptionColor) && !empty($ifPostTrendContentTitleImageDescriptionColor)) : ?>

                                                                <div class="" style="position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; width: 100vw; background-color: <?php echo ($color_content) ?  $color_content . '!important' : '#F9ECEA !important'; ?>; margin-top: 1rem; margin-botton: 2rem;">

                                                                    <div class="container mx-auto px-lg-0 px-4">
                                                                        <div class="p-0 w-100 px-0">
                                                                            <div class="col-12 p-0 pt-0 pb-0">
                                                                                <div class="row">
                                                                                    <?php if (have_rows('Content_Post_Trend_Content_Title_Image_Description')) : ?>

                                                                                        <?php while (have_rows('Content_Post_Trend_Content_Title_Image_Description')) : the_row() ?>

                                                                                            <?php $titleContentPostTrendContentTitleImageDescriptionColor = get_sub_field('Title_Content_Post_Trend_Content_Title_Image_Description'); ?>
                                                                                            <?php $firstDescriptionContentPostTrendContentTitleImageDescriptionColor = get_sub_field('First_Description_Content_Post_Trend_Content_Title_Image_Description'); ?>
                                                                                            <?php $secondDescriptionContentPostTrendContentTitleImageDescriptionColor = get_sub_field('Second_Description_Content_Post_Trend_Content_Title_Image_Description'); ?>
                                                                                            <?php $imageContentPostTrendContentTitleImageDescriptionColor = get_sub_field('Image_Content_Post_Trend_Content_Title_Image_Description'); ?>
                                                                                            <?php $lastDescriptionContentPostTrendContentTitleImageDescriptionColor = get_sub_field('Last_Description_Content_Post_Trend_Content_Title_Image_Description'); ?>


                                                                                            <h2 class="NotoSans-Bold title-color mb-4 pt-4" style="color: <?php echo ($color_title) ?  $color_title . '!important' : '#001965 !important'; ?>">
                                                                                                <?= strip_tags($titleContentPostTrendContentTitleImageDescriptionColor); ?>
                                                                                            </h2>
                                                                                            <div class="NotoSans-Regular description-color px-2 mt-2 pb-2" style="color: <?php echo ($color_description) ?  $color_description . '!important' : '#001965 !important'; ?>">
                                                                                                <?= strip_tags($firstDescriptionContentPostTrendContentTitleImageDescriptionColor, '<strong><em><ul><li><blockquote><a><br><h1><h2><h3><h4><h5>'); ?>
                                                                                            </div>
                                                                                            <div class="NotoSans-Regular description-color px-2 mt-2 pb-3" style="color: <?php echo ($color_description) ?  $color_description . '!important' : '#001965 !important'; ?>">
                                                                                                <?= strip_tags($secondDescriptionContentPostTrendContentTitleImageDescriptionColor, '<strong><em><ul><li><blockquote><a><br><h1><h2><h3><h4><h5>'); ?>
                                                                                            </div>
                                                                                            <div class="d-flex justify-content-center align-items-center">
                                                                                                <div class="col-12 col-lg-10">
                                                                                                    <?= wp_get_attachment_image($imageContentPostTrendContentTitleImageDescriptionColor, 'full', '', ['class' => '', 'style' => 'width: 100%; height: 100%; object-fit: cover;']); ?>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="NotoSans-Regular description-color px-2 mb-4 pt-4">
                                                                                                <?= strip_tags($lastDescriptionContentPostTrendContentTitleImageDescriptionColor, '<strong><em><ul><li><blockquote><a><br><h1><h2><h3><h4><h5>'); ?>
                                                                                            </div>

                                                                                        <?php endwhile; ?>

                                                                                    <?php endif; ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                            <?php endif; ?>


                                                            <?php /* Content with Subcontent  /  Content With Background Color */  ?>
                                                            <?php $ifPostTrendContentSubcontentColor = get_sub_field('If_Post_Trend_Content_Subcontent'); ?>
                                                            <?php $contentPostTrendSubcontentColor = get_sub_field('Content_Post_Trend_Subcontent'); ?>


                                                            <?php if (isset($ifPostTrendContentSubcontentColor) && !empty($ifPostTrendContentSubcontentColor)) : ?>

                                                                <div class="" style="position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; width: 100vw; background-color: <?php echo ($color_content) ?  $color_content . '!important' : '#F9ECEA !important'; ?> margin-top: 1rem; margin-bottom: 2rem;">

                                                                    <div class="container mx-auto px-lg-0 px-4">
                                                                        <div class="p-5 pt-3 w-100 px-0">
                                                                            <div class="col-12 p-lg-5 p-3 pt-lg-0 pb-lg-0 pt-0 pb-0">
                                                                                <div class="row">
                                                                                    <?php if (have_rows('Content_Post_Trend_Subcontent')) : ?>

                                                                                        <?php while (have_rows('Content_Post_Trend_Subcontent')) : the_row() ?>

                                                                                            <?php $titleContentPostTrendSubcontentColor = get_sub_field('Title_Content_Post_Trend_Subcontent'); ?>
                                                                                            <?php $subcontentPostTrendColor = get_sub_field('Subcontent_Post_Trend'); ?>

                                                                                            <h2 class="NotoSans-Bold title-color mb-4 pt-4" style="color: <?php echo ($color_title) ?  $color_title . '!important' : '#001965 !important'; ?>">
                                                                                                <?= strip_tags($titleContentPostTrendSubcontentColor); ?>
                                                                                            </h2>
                                                                                            <div class="container mx-auto px-0">
                                                                                                <div class="p-5 pt-3 w-100 px-0">
                                                                                                    <div class="col-12 p-lg-5 p-3 pt-lg-0 pb-lg-0 pt-0 pb-0">
                                                                                                        <div class="row">
                                                                                                            <?php if (have_rows('Subcontent_Post_Trend')) : ?>

                                                                                                                <?php while (have_rows('Subcontent_Post_Trend')) : the_row() ?>

                                                                                                                    <?php $titleSubcontentPostTrendColor = get_sub_field('Title_Subcontent_Post_Trend'); ?>
                                                                                                                    <?php $imageSubcontentPostTrendColor = get_sub_field('Image_Subcontent_Post_Trend'); ?>
                                                                                                                    <?php $firstDescriptionSubcontentPostTrendColor = get_sub_field('First_Description_Subcontent_Post_Trend'); ?>

                                                                                                                    <h3 class="NotoSans-Bold title-color mb-4 pt-4 text-center">
                                                                                                                        <?= strip_tags($titleSubcontentPostTrendColor); ?>
                                                                                                                    </h3>

                                                                                                                    <div class="d-flex flex-md-row flex-column position-relative justify-content-center align-items-center">
                                                                                                                        <div class="col-md-4 col-lg-4" style="border-radius: 1rem;">
                                                                                                                            <div class="col-12">
                                                                                                                                <?= wp_get_attachment_image($imageSubcontentPostTrendColor, 'full', '', ['style' => 'height: 170px;width: 100%;object-fit: contain;']); ?>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div class="col-md-8 col-lg-8 d-flex justify-content-center align-items-center">
                                                                                                                            <div class="col-11 col-md-12 col-lg-12 p-0 m-0 pt-4 pb-4">
                                                                                                                                <div class="container-title-speaker-content-out mx-lg-5 ms-3">
                                                                                                                                    <div class="container-content-outstanding">
                                                                                                                                        <p class="NotoSans-Regular container-title-speaker-content-outstanding">
                                                                                                                                            <?= strip_tags($firstDescriptionSubcontentPostTrendColor, '<strong><em><ul><li><blockquote><a><br>'); ?>
                                                                                                                                        </p>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>

                                                                                                                <?php endwhile; ?>

                                                                                                            <?php endif; ?>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>

                                                                                        <?php endwhile; ?>

                                                                                    <?php endif; ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                            <?php endif; ?>


                                                        <?php endwhile; ?>

                                                    <?php endif; ?>

                                                <?php endif; ?>
                                            <?php endif; ?>


                                            <?php /* Content Without Background Color */  ?>
                                            <?php $ifPostTrendContentWithoutColor = get_sub_field('If_Post_Trend_Content_Without_Color'); ?>
                                            <?php $contentPostTrendWithoutColor = get_sub_field('Content_Post_Trend_Without_Color_c'); ?>

                                            <?php if (isset($ifPostTrendContentWithoutColor) && !empty($ifPostTrendContentWithoutColor)) : ?>
                                                <?php if (isset($contentPostTrendWithoutColor) && !empty($contentPostTrendWithoutColor)) : ?>

                                                    <?php if (have_rows('Content_Post_Trend_Without_Color_c')) : ?>

                                                        <?php while (have_rows('Content_Post_Trend_Without_Color_c')) : the_row()  ?>

                                                            <?php /* Title - Image  /  Content With Background Color */  ?>
                                                            <?php $ifPostTrendContentImageTitle = get_sub_field('If_Post_Trend_Content_Image_Title'); ?>
                                                            <?php $contentPostTrendContentImageTitle = get_sub_field('Content_Post_Trend_Content_Image_Title'); ?>

                                                            <?php if (isset($ifPostTrendContentImageTitle) && !empty($ifPostTrendContentImageTitle)) : ?>

                                                                <div class="" style="position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; width: 100vw; background-color: white;">

                                                                    <div class="container mx-auto px-lg-0 px-4">
                                                                        <div class="p-0 w-100 px-0">
                                                                            <div class="col-12 p-0 pt-0 pb-0">
                                                                                <div class="row">

                                                                                    <?php if (have_rows('Content_Post_Trend_Content_Image_Title')) : ?>

                                                                                        <?php while (have_rows('Content_Post_Trend_Content_Image_Title')) : the_row() ?>

                                                                                            <?php $titleContentPostTrendContentImageTitle = get_sub_field('Title_Content_Post_Trend_Content_Image_Title'); ?>
                                                                                            <?php $imageContentPostTrendContentImageTitle = get_sub_field('Image__Content_Post_Trend_Content_Image_Title'); ?>

                                                                                            <h2 class="NotoSans-Bold title-color mb-4 pt-4">
                                                                                                <?= strip_tags($titleContentPostTrendContentImageTitle); ?>
                                                                                            </h2>
                                                                                            <div class="d-flex justify-content-start align-items-center">
                                                                                                <div class="col-12 col-lg-12">
                                                                                                    <?= wp_get_attachment_image($imageContentPostTrendContentImageTitle, 'full', '', ['class' => '', 'style' => 'width: 100%; height: 100%; object-fit: cover;']); ?>
                                                                                                </div>
                                                                                            </div>

                                                                                        <?php endwhile; ?>

                                                                                    <?php endif; ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                            <?php endif; ?>


                                                            <?php /* Title - Description  /  Content With Background Color */  ?>
                                                            <?php $ifPostTrendContentTitleDescription = get_sub_field('If_Post_Trend_Content_Title_Description'); ?>
                                                            <?php $contentPostTrendContentTitleDescription = get_sub_field('Content_Post_Trend_Content_Title_Description'); ?>

                                                            <?php if (isset($ifPostTrendContentTitleDescription) && !empty($ifPostTrendContentTitleDescription)) : ?>

                                                                <div class="" style="position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; width: 100vw; background-color: white; margin-top: 1rem; margin-botton: 2rem;">

                                                                    <div class="container mx-auto px-lg-0 px-4">
                                                                        <div class="p-5 pt-3 pt-lg-5 w-100 px-0">
                                                                            <div class="col-12 p-0">
                                                                                <div class="row">
                                                                                    <?php $counter = 0 ?>

                                                                                    <?php if (have_rows('Content_Post_Trend_Content_Title_Description')) : ?>

                                                                                        <?php while (have_rows('Content_Post_Trend_Content_Title_Description')) : the_row() ?>

                                                                                            <?php $titleContentPostTrendContentTitleDescription = get_sub_field('Title_Content_Post_Trend_Content_Title_Description'); ?>
                                                                                            <?php $descriptioncontentPostTrendContentTitleDescription = get_sub_field('Description_Content_Post_Trend_Content_Title_Description'); ?>

                                                                                            <h2 class="NotoSans-Bold title-color mb-4 <?= $counter > 0 ? 'pt-4' : ''; ?>">
                                                                                                <?= strip_tags($titleContentPostTrendContentTitleDescription); ?>
                                                                                            </h2>
                                                                                            <div class="NotoSans-Regular description-color px-2">
                                                                                                <?= strip_tags($descriptioncontentPostTrendContentTitleDescription, '<strong><em><ul><li><blockquote><a><br>'); ?>
                                                                                            </div>

                                                                                            <?php $counter++ ?>
                                                                                        <?php endwhile; ?>

                                                                                    <?php endif; ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                            <?php endif; ?>


                                                            <?php /* Title - Image - Others  /  Content With Background Color */  ?>
                                                            <?php $ifPostTrendContentTitleImageDescription = get_sub_field('If_Post_Trend_Content_Title_Image_Description'); ?>
                                                            <?php $contentPostTrendContentTitleImageDescription = get_sub_field('Content_Post_Trend_Content_Title_Image_Description'); ?>


                                                            <?php if (isset($ifPostTrendContentTitleImageDescription) && !empty($ifPostTrendContentTitleImageDescription)) : ?>

                                                                <div class="pt-4 pb-4" style="position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; width: 100vw; background-color: white;">

                                                                    <div class="container mx-auto px-lg-0 px-4">
                                                                        <div class="p-0 w-100 px-0">
                                                                            <div class="col-12 p-0 pt-0 pb-0">
                                                                                <div class="row">
                                                                                    <?php if (have_rows('Content_Post_Trend_Content_Title_Image_Description')) : ?>

                                                                                        <?php while (have_rows('Content_Post_Trend_Content_Title_Image_Description')) : the_row() ?>

                                                                                            <?php $titleContentPostTrendContentTitleImageDescription = get_sub_field('Title_Content_Post_Trend_Content_Title_Image_Description'); ?>
                                                                                            <?php $firstDescriptionContentPostTrendContentTitleImageDescription = get_sub_field('First_Description_Content_Post_Trend_Content_Title_Image_Description'); ?>
                                                                                            <?php $secondDescriptionContentPostTrendContentTitleImageDescription = get_sub_field('Second_Description_Content_Post_Trend_Content_Title_Image_Description'); ?>
                                                                                            <?php $imageContentPostTrendContentTitleImageDescription = get_sub_field('Image_Content_Post_Trend_Content_Title_Image_Description'); ?>
                                                                                            <?php $lastDescriptionContentPostTrendContentTitleImageDescription = get_sub_field('Last_Description_Content_Post_Trend_Content_Title_Image_Description'); ?>


                                                                                            <h2 class="NotoSans-Bold title-color mb-4 pt-4">
                                                                                                <?= strip_tags($titleContentPostTrendContentTitleImageDescription, '<strong><em><ul><li><blockquote><a><br><h1><h2><h3><h4><h5>'); ?>
                                                                                            </h2>
                                                                                            <div class="NotoSans-Regular description-color px-2 mt-2 pb-2">
                                                                                                <?= strip_tags($firstDescriptionContentPostTrendContentTitleImageDescription, '<strong><em><ul><li><blockquote><a><br><h1><h2><h3><h4><h5>'); ?>
                                                                                            </div>
                                                                                            <div class="NotoSans-Regular description-color px-2 mt-2 pb-3">
                                                                                                <?= strip_tags($secondDescriptionContentPostTrendContentTitleImageDescription, '<strong><em><ul><li><blockquote><a><br><h1><h2><h3><h4><h5>'); ?>
                                                                                            </div>
                                                                                            <div class="d-flex justify-content-center align-items-center">
                                                                                                <div class="col-12 col-lg-10">
                                                                                                    <?= wp_get_attachment_image($imageContentPostTrendContentTitleImageDescription, 'full', '', ['class' => '', 'style' => 'width: 100%; height: 100%; object-fit: cover;']); ?>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="NotoSans-Regular description-color px-2 mb-4 pt-4">
                                                                                                <?= strip_tags($lastDescriptionContentPostTrendContentTitleImageDescription, '<strong><em><ul><li><blockquote><a><br><h1><h2><h3><h4><h5>'); ?>
                                                                                            </div>

                                                                                        <?php endwhile; ?>

                                                                                    <?php endif; ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                            <?php endif; ?>


                                                            <?php /* Content with Subcontent  /  Content With Background Color */  ?>
                                                            <?php $ifPostTrendContentSubcontent = get_sub_field('If_Post_Trend_Content_Subcontent'); ?>
                                                            <?php $contentPostTrendSubcontent = get_sub_field('Content_Post_Trend_Subcontent'); ?>


                                                            <?php if (isset($ifPostTrendContentSubcontent) && !empty($ifPostTrendContentSubcontent)) : ?>

                                                                <div class="" style="position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; width: 100vw; background-color: white; margin-top: 1rem; margin-bottom: 2rem;">

                                                                    <div class="container mx-auto px-lg-0 px-4">
                                                                        <div class="p-5 pt-3 w-100 px-0">
                                                                            <div class="col-12 p-lg-5 p-3 pt-lg-0 pb-lg-0 pt-0 pb-0">
                                                                                <div class="row">
                                                                                    <?php if (have_rows('Content_Post_Trend_Subcontent')) : ?>

                                                                                        <?php while (have_rows('Content_Post_Trend_Subcontent')) : the_row() ?>


                                                                                            <?php $titleContentPostTrendSubcontent = get_sub_field('Title_Content_Post_Trend_Subcontent'); ?>
                                                                                            <?php $subcontentPostTrend = get_sub_field('Subcontent_Post_Trend'); ?>

                                                                                            <h2 class="NotoSans-Bold title-color mb-4 pt-4">
                                                                                                <?= strip_tags($titleContentPostTrendSubcontent); ?>
                                                                                            </h2>
                                                                                            <a href="" target="_blank"></a>
                                                                                            <div class="container mx-auto px-0">
                                                                                                <div class="p-5 pt-3 w-100 px-0">
                                                                                                    <div class="col-12 p-lg-5 p-3 pt-lg-0 pb-lg-0 pt-0 pb-0">
                                                                                                        <div class="row">
                                                                                                            <?php if (have_rows('Subcontent_Post_Trend')) : ?>

                                                                                                                <?php while (have_rows('Subcontent_Post_Trend')) : the_row() ?>

                                                                                                                    <?php $titleSubcontentPostTrend = get_sub_field('Title_Subcontent_Post_Trend'); ?>
                                                                                                                    <?php $imageSubcontentPostTrend = get_sub_field('Image_Subcontent_Post_Trend'); ?>
                                                                                                                    <?php $firstDescriptionSubcontentPostTrend = get_sub_field('First_Description_Subcontent_Post_Trend'); ?>

                                                                                                                    <h3 class="NotoSans-Bold title-color mb-4 pt-4 text-center">
                                                                                                                        <?= strip_tags($titleSubcontentPostTrend); ?>
                                                                                                                    </h3>

                                                                                                                    <div class="d-flex flex-md-row flex-column position-relative justify-content-center align-items-center">
                                                                                                                        <div class="col-md-4 col-lg-4" style="border-radius: 1rem;">
                                                                                                                            <div class="col-12">
                                                                                                                                <?= wp_get_attachment_image($imageSubcontentPostTrend, 'full', '', ['style' => 'height: 170px;width: 100%;object-fit: contain;']); ?>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                        <div class="col-md-8 col-lg-8 d-flex justify-content-center align-items-center">
                                                                                                                            <div class="col-11 col-md-12 col-lg-12 p-0 m-0 pt-4 pb-4">
                                                                                                                                <div class="container-title-speaker-content-out mx-lg-5 ms-3">
                                                                                                                                    <div class="container-content-outstanding">
                                                                                                                                        <p class="NotoSans-Regular container-title-speaker-content-outstanding">
                                                                                                                                            <?= strip_tags($firstDescriptionSubcontentPostTrend, '<strong><em><ul><li><blockquote><a><br>'); ?>
                                                                                                                                        </p>
                                                                                                                                    </div>
                                                                                                                                </div>
                                                                                                                            </div>
                                                                                                                        </div>
                                                                                                                    </div>

                                                                                                                <?php endwhile; ?>

                                                                                                            <?php endif; ?>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>

                                                                                        <?php endwhile; ?>

                                                                                    <?php endif; ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                            <?php endif; ?>


                                                        <?php endwhile; ?>

                                                    <?php endif; ?>

                                                <?php endif; ?>
                                            <?php endif; ?>


                                        <?php endwhile; ?>
                                    <?php endif; ?>

                                <?php endif ?>

                            <?php endif ?>


                        </div>

                        <div class="col-12 mx-1" id="linea">
                            <hr>
                        </div>

                        <div>
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

                                    <?php if (isset($ifPostTrendWithDiferentOptions) && !empty($ifPostTrendWithDiferentOptions)) : ?>
                                        <?php if (isset($contentPostTrendWithDifferentOptions) && !empty($contentPostTrendWithDifferentOptions)) : ?>

                                            <div class="container p-0 pt-lg-0">

                                                <div class="container background-single p-0 m-0 px-lg-5" style="background-color: #FFFFFF !important;">
                                                    <div class="row d-flex flex-lg-row flex-column mt-3">

                                                        <div class="row d-flex flex-lg-row flex-column d-flex flex-lg-row flex-column justify-content-start align-items-start container-card-category m-0 p-0 pt-3 mb-3">

                                                            <?php while ($filteredPostsQuery->have_posts()) : $filteredPostsQuery->the_post() ?>

                                                                <?php $thePermalink = get_the_permalink(); ?>

                                                                <?php $imgPostTrend = get_field('Img_Post_Trend'); ?>

                                                                <div class="col-12 col-md-4 col-lg-4 col-xl-3 col-xxl-3 col-xxxl-3 d-flex flex-column justify-content-start align-items-center card-taxonomies-subcategory-academy-events m-0 p-0 mt-3 mb-3">
                                                                    <a class="custom-width" href="<?= $thePermalink . '?tax=' . $taxId; ?>" onclick="saveLogsClick('Clic en tarjeta `<?= the_title(); ?>`');" style="text-decoration: none;">
                                                                        <div class="mb-4 figure" style="border-radius: 0px">
                                                                            <?php if (isset($imgPostTrend) && !empty($imgPostTrend)) : ?>
                                                                                <?php echo wp_get_attachment_image($imgPostTrend, 'full', '', ['style' => 'object-fit: fill; border-radius: 0px']); ?>
                                                                            <?php endif ?>
                                                                        </div>
                                                                        <div class="mt-1 p-0">
                                                                            <div class="w-75 p-2 mb-4 second-btn-view-now" style="display: flex; justify-content: start; align-items: start;">
                                                                                <i class="fa-regular fa-circle-play mx-2" style="font-size: 1.8rem;"></i>
                                                                                Videos
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

                                    <?php else : ?>

                                        <div class="container p-lg-5 pt-lg-0">

                                            <div class="container background-single p-0 m-0 px-lg-5">
                                                <div class="row d-flex flex-lg-row flex-column  mt-3">

                                                    <div class="row d-flex flex-lg-row flex-column d-flex flex-lg-row flex-column justify-content-start align-items-start container-card-category m-0 p-0 pt-3 mb-3">

                                                        <?php while ($filteredPostsQuery->have_posts()) : $filteredPostsQuery->the_post() ?>

                                                            <?php $thePermalink = get_the_permalink(); ?>

                                                            <?php $imgPostTrend = get_field('Img_Post_Trend'); ?>

                                                            <div class="col-12 col-md-4 col-lg-4 col-xl-3 col-xxl-3 col-xxxl-3 d-flex flex-column justify-content-start align-items-center card-taxonomies-subcategory-academy-events m-0 p-0 mt-3 mb-3">
                                                                <a class="custom-width" href="<?= $thePermalink . '?tax=' . $taxId; ?>" onclick="saveLogsClick('Clic en tarjeta `<?= the_title(); ?>`');" style="text-decoration: none;">
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

                                <?php endif; ?>

                            <?php endif ?>
                        </div>

                    <?php endif ?>

                <?php elseif (isset($ifPostTrendPdf) && !empty($ifPostTrendPdf)) : ?>

                    <?php if (isset($pdfPostTrend) && !empty($pdfPostTrend)) : ?>

                        <div class="container p-lg-5 pb-lg-0 p-1">
                            <div class="container background-single p-2">
                                <div class="p-5 pt-3 pt-lg-5 w-100">

                                    <h1 class="NotoSans-Bold title-color mb-5 pb-2 d-none d-lg-block"><?php the_title(); ?></h1>
                                    <h5 class="NotoSans-Bold title-color mb-2 pb-2 d-block d-lg-none"><?php the_title(); ?></h5>

                                    <div class="col-lg-12">
                                        <div class="row justify-content-center">
                                            <div class="col-12 d-flex justify-content-center align-items-center flex-column mt-lg-5 mt-2 mb-5">
                                                <embed src="<?= $pdfPostTrend ?>" type="application/pdf" class="d-none d-lg-block" width="100%" height="100%" style="width: 90%; height: 100vh; border: none">
                                                <iframe src="https://drive.google.com/viewerng/viewer?embedded=true&url=<?= $pdfPostTrend ?>" class="d-block d-lg-none" style="width: 90%; height: 500px;" frameborder="0"></iframe>

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

                <?php elseif (isset($ifPostTrendWithDiferentOptions) && !empty($ifPostTrendWithDiferentOptions)) : ?>

                    <?php if (isset($contentPostTrendWithDifferentOptions) && !empty($contentPostTrendWithDifferentOptions)) : ?>

                        <?php if (have_rows('Content_Post_Trend_With_Different_Options')) : ?>
                            <?php while (have_rows('Content_Post_Trend_With_Different_Options')) : the_row() ?>

                                <?php /* Content With Background Color */  ?>
                                <?php $ifPostTrendContentColor = get_sub_field('If_Post_Trend_Content_Color'); ?>
                                <?php $contentPostTrendColor = get_sub_field('Content_Post_Trend_Color'); ?>

                                <?php if (isset($ifPostTrendContentColor) && !empty($ifPostTrendContentColor)) : ?>
                                    <?php if (isset($contentPostTrendColor) && !empty($contentPostTrendColor)) : ?>

                                        <?php if (have_rows('Content_Post_Trend_Color')) : ?>

                                            <?php while (have_rows('Content_Post_Trend_Color')) : the_row()  ?>

                                                <?php /* Image - Title  /  Content With Background Color */  ?>
                                                <?php $ifPostTrendContentImageTitleColor = get_sub_field('If_Post_Trend_Content_Image_Title'); ?>
                                                <?php $contentPostTrendContentImageTitleColor = get_sub_field('Content_Post_Trend_Content_Image_Title'); ?>

                                                <?php $color_content = get_sub_field('color_content'); ?>
                                                <?php $color_title = get_sub_field('color_title'); ?>
                                                <?php $color_description = get_sub_field('color_description'); ?>


                                                <?php if (isset($ifPostTrendContentImageTitleColor) && !empty($ifPostTrendContentImageTitleColor)) : ?>

                                                    <div class="" style="position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; width: 100vw; background-color: <?php echo ($color_content) ?  $color_content : '#F9ECEA'; ?>   margin-top: 1rem; margin-botton: 2rem;">

                                                        <div class="container mx-auto px-lg-0 px-4">
                                                            <div class="p-0 w-100 px-0">
                                                                <div class="col-12 p-0 pb-lg-0 pt-0 pb-0">
                                                                    <div class="row">

                                                                        <?php if (have_rows('Content_Post_Trend_Content_Image_Title')) : ?>

                                                                            <?php while (have_rows('Content_Post_Trend_Content_Image_Title')) : the_row() ?>

                                                                                <?php $titleContentPostTrendContentImageTitleColor = get_sub_field('Title_Content_Post_Trend_Content_Image_Title'); ?>
                                                                                <?php $imageContentPostTrendContentImageTitleColor = get_sub_field('Image__Content_Post_Trend_Content_Image_Title'); ?>

                                                                                <h2 class="NotoSans-Bold title-color mb-4 pt-4" style="color: <?php echo ($color_title) ?  $color_title . '!important' : '#001965 !important'; ?>">
                                                                                    <?= strip_tags($titleContentPostTrendContentImageTitleColor); ?>
                                                                                </h2>
                                                                                <div class="d-flex justify-content-start align-items-center">
                                                                                    <div class="col-12 col-lg-12">
                                                                                        <?= wp_get_attachment_image($imageContentPostTrendContentImageTitleColor, 'full', '', ['class' => '', 'style' => 'width: 100%; height: 100%; object-fit: cover;']); ?>
                                                                                    </div>
                                                                                </div>

                                                                            <?php endwhile; ?>

                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                <?php endif; ?>


                                                <?php /* Title - Description  /  Content With Background Color */  ?>
                                                <?php $ifPostTrendContentTitleDescriptionColor = get_sub_field('If_Post_Trend_Content_Title_Description'); ?>
                                                <?php $contentPostTrendContentTitleDescriptionColor = get_sub_field('Content_Post_Trend_Content_Title_Description'); ?>

                                                <?php if (isset($ifPostTrendContentTitleDescriptionColor) && !empty($ifPostTrendContentTitleDescriptionColor)) : ?>

                                                    <div class="" style="position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; width: 100vw; background-color: <?php echo ($color_content) ?  $color_content . ';' : '#F9ECEA'; ?> margin-top: 1rem; margin-botton: 2rem;">

                                                        <div class="container mx-auto px-lg-0 px-4">
                                                            <div class="p-5 pt-3 pt-lg-5 w-100 px-0">
                                                                <div class="col-12 p-0">
                                                                    <div class="row">
                                                                        <?php $counter = 0 ?>
                                                                        <?php if (have_rows('Content_Post_Trend_Content_Title_Description')) : ?>

                                                                            <?php while (have_rows('Content_Post_Trend_Content_Title_Description')) : the_row() ?>

                                                                                <?php $titleContentPostTrendContentTitleDescriptionColor = get_sub_field('Title_Content_Post_Trend_Content_Title_Description'); ?>
                                                                                <?php $descriptioncontentPostTrendContentTitleDescriptionColor = get_sub_field('Description_Content_Post_Trend_Content_Title_Description'); ?>

                                                                                <h2 class="NotoSans-Bold title-color mb-4 <?= $counter > 0 ? 'pt-4' : ''; ?>" style="color: <?php echo ($color_title) ?  $color_title . '!important' : '#001965 !important'; ?>">
                                                                                    <?= strip_tags($titleContentPostTrendContentTitleDescriptionColor); ?>
                                                                                </h2>
                                                                                <div class="NotoSans-Regular description-color px-2" style="color: <?php echo ($color_description) ?  $color_description . '!important' : '#001965 !important'; ?>">
                                                                                    <?= strip_tags($descriptioncontentPostTrendContentTitleDescriptionColor, '<strong><em><ul><li><blockquote><a><br>'); ?>
                                                                                </div>

                                                                                <?php $counter++ ?>
                                                                            <?php endwhile; ?>

                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                <?php endif; ?>


                                                <?php /* Title - Image - Others  /  Content With Background Color */  ?>
                                                <?php $ifPostTrendContentTitleImageDescriptionColor = get_sub_field('If_Post_Trend_Content_Title_Image_Description'); ?>
                                                <?php $contentPostTrendContentTitleImageDescriptionColor = get_sub_field('Content_Post_Trend_Content_Title_Image_Description'); ?>


                                                <?php if (isset($ifPostTrendContentTitleImageDescriptionColor) && !empty($ifPostTrendContentTitleImageDescriptionColor)) : ?>

                                                    <div class="" style="position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; width: 100vw; background-color: <?php echo ($color_content) ?  $color_content . '!important' : '#F9ECEA !important'; ?>; margin-top: 1rem; margin-botton: 2rem;">

                                                        <div class="container mx-auto px-lg-0 px-4">
                                                            <div class="p-0 w-100 px-0">
                                                                <div class="col-12 p-0 pt-0 pb-0">
                                                                    <div class="row">
                                                                        <?php if (have_rows('Content_Post_Trend_Content_Title_Image_Description')) : ?>

                                                                            <?php while (have_rows('Content_Post_Trend_Content_Title_Image_Description')) : the_row() ?>

                                                                                <?php $titleContentPostTrendContentTitleImageDescriptionColor = get_sub_field('Title_Content_Post_Trend_Content_Title_Image_Description'); ?>
                                                                                <?php $firstDescriptionContentPostTrendContentTitleImageDescriptionColor = get_sub_field('First_Description_Content_Post_Trend_Content_Title_Image_Description'); ?>
                                                                                <?php $secondDescriptionContentPostTrendContentTitleImageDescriptionColor = get_sub_field('Second_Description_Content_Post_Trend_Content_Title_Image_Description'); ?>
                                                                                <?php $imageContentPostTrendContentTitleImageDescriptionColor = get_sub_field('Image_Content_Post_Trend_Content_Title_Image_Description'); ?>
                                                                                <?php $lastDescriptionContentPostTrendContentTitleImageDescriptionColor = get_sub_field('Last_Description_Content_Post_Trend_Content_Title_Image_Description'); ?>


                                                                                <h2 class="NotoSans-Bold title-color mb-4 pt-4" style="color: <?php echo ($color_title) ?  $color_title . '!important' : '#001965 !important'; ?>">
                                                                                    <?= strip_tags($titleContentPostTrendContentTitleImageDescriptionColor); ?>
                                                                                </h2>
                                                                                <div class="NotoSans-Regular description-color px-2 mt-2 pb-2" style="color: <?php echo ($color_description) ?  $color_description . '!important' : '#001965 !important'; ?>">
                                                                                    <?= strip_tags($firstDescriptionContentPostTrendContentTitleImageDescriptionColor, '<strong><em><ul><li><blockquote><a><br><h1><h2><h3><h4><h5>'); ?>
                                                                                </div>
                                                                                <div class="NotoSans-Regular description-color px-2 mt-2 pb-3" style="color: <?php echo ($color_description) ?  $color_description . '!important' : '#001965 !important'; ?>">
                                                                                    <?= strip_tags($secondDescriptionContentPostTrendContentTitleImageDescriptionColor, '<strong><em><ul><li><blockquote><a><br><h1><h2><h3><h4><h5>'); ?>
                                                                                </div>
                                                                                <div class="d-flex justify-content-center align-items-center">
                                                                                    <div class="col-12 col-lg-10">
                                                                                        <?= wp_get_attachment_image($imageContentPostTrendContentTitleImageDescriptionColor, 'full', '', ['class' => '', 'style' => 'width: 100%; height: 100%; object-fit: cover;']); ?>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="NotoSans-Regular description-color px-2 mb-4 pt-4">
                                                                                    <?= strip_tags($lastDescriptionContentPostTrendContentTitleImageDescriptionColor, '<strong><em><ul><li><blockquote><a><br><h1><h2><h3><h4><h5>'); ?>
                                                                                </div>

                                                                            <?php endwhile; ?>

                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                <?php endif; ?>


                                                <?php /* Content with Subcontent  /  Content With Background Color */  ?>
                                                <?php $ifPostTrendContentSubcontentColor = get_sub_field('If_Post_Trend_Content_Subcontent'); ?>
                                                <?php $contentPostTrendSubcontentColor = get_sub_field('Content_Post_Trend_Subcontent'); ?>


                                                <?php if (isset($ifPostTrendContentSubcontentColor) && !empty($ifPostTrendContentSubcontentColor)) : ?>

                                                    <div class="" style="position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; width: 100vw; background-color: <?php echo ($color_content) ?  $color_content . '!important' : '#F9ECEA !important'; ?> margin-top: 1rem; margin-bottom: 2rem;">

                                                        <div class="container mx-auto px-lg-0 px-4">
                                                            <div class="p-5 pt-3 w-100 px-0">
                                                                <div class="col-12 p-lg-5 p-3 pt-lg-0 pb-lg-0 pt-0 pb-0">
                                                                    <div class="row">
                                                                        <?php if (have_rows('Content_Post_Trend_Subcontent')) : ?>

                                                                            <?php while (have_rows('Content_Post_Trend_Subcontent')) : the_row() ?>

                                                                                <?php $titleContentPostTrendSubcontentColor = get_sub_field('Title_Content_Post_Trend_Subcontent'); ?>
                                                                                <?php $subcontentPostTrendColor = get_sub_field('Subcontent_Post_Trend'); ?>

                                                                                <h2 class="NotoSans-Bold title-color mb-4 pt-4" style="color: <?php echo ($color_title) ?  $color_title . '!important' : '#001965 !important'; ?>">
                                                                                    <?= strip_tags($titleContentPostTrendSubcontentColor); ?>
                                                                                </h2>
                                                                                <div class="container mx-auto px-0">
                                                                                    <div class="p-5 pt-3 w-100 px-0">
                                                                                        <div class="col-12 p-lg-5 p-3 pt-lg-0 pb-lg-0 pt-0 pb-0">
                                                                                            <div class="row">
                                                                                                <?php if (have_rows('Subcontent_Post_Trend')) : ?>

                                                                                                    <?php while (have_rows('Subcontent_Post_Trend')) : the_row() ?>

                                                                                                        <?php $titleSubcontentPostTrendColor = get_sub_field('Title_Subcontent_Post_Trend'); ?>
                                                                                                        <?php $imageSubcontentPostTrendColor = get_sub_field('Image_Subcontent_Post_Trend'); ?>
                                                                                                        <?php $firstDescriptionSubcontentPostTrendColor = get_sub_field('First_Description_Subcontent_Post_Trend'); ?>

                                                                                                        <h3 class="NotoSans-Bold title-color mb-4 pt-4 text-center">
                                                                                                            <?= strip_tags($titleSubcontentPostTrendColor); ?>
                                                                                                        </h3>

                                                                                                        <div class="d-flex flex-md-row flex-column position-relative justify-content-center align-items-center">
                                                                                                            <div class="col-md-4 col-lg-4" style="border-radius: 1rem;">
                                                                                                                <div class="col-12">
                                                                                                                    <?= wp_get_attachment_image($imageSubcontentPostTrendColor, 'full', '', ['style' => 'height: 170px;width: 100%;object-fit: contain;']); ?>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-md-8 col-lg-8 d-flex justify-content-center align-items-center">
                                                                                                                <div class="col-11 col-md-12 col-lg-12 p-0 m-0 pt-4 pb-4">
                                                                                                                    <div class="container-title-speaker-content-out mx-lg-5 ms-3">
                                                                                                                        <div class="container-content-outstanding">
                                                                                                                            <p class="NotoSans-Regular container-title-speaker-content-outstanding">
                                                                                                                                <?= strip_tags($firstDescriptionSubcontentPostTrendColor, '<strong><em><ul><li><blockquote><a><br>'); ?>
                                                                                                                            </p>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>

                                                                                                    <?php endwhile; ?>

                                                                                                <?php endif; ?>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                            <?php endwhile; ?>

                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                <?php endif; ?>


                                            <?php endwhile; ?>

                                        <?php endif; ?>

                                    <?php endif; ?>
                                <?php endif; ?>


                                <?php /* Content Without Background Color */  ?>
                                <?php $ifPostTrendContentWithoutColor = get_sub_field('If_Post_Trend_Content_Without_Color'); ?>
                                <?php $contentPostTrendWithoutColor = get_sub_field('Content_Post_Trend_Without_Color_c'); ?>

                                <?php if (isset($ifPostTrendContentWithoutColor) && !empty($ifPostTrendContentWithoutColor)) : ?>
                                    <?php if (isset($contentPostTrendWithoutColor) && !empty($contentPostTrendWithoutColor)) : ?>

                                        <?php if (have_rows('Content_Post_Trend_Without_Color_c')) : ?>

                                            <?php while (have_rows('Content_Post_Trend_Without_Color_c')) : the_row()  ?>

                                                <?php /* Title - Image  /  Content With Background Color */  ?>
                                                <?php $ifPostTrendContentImageTitle = get_sub_field('If_Post_Trend_Content_Image_Title'); ?>
                                                <?php $contentPostTrendContentImageTitle = get_sub_field('Content_Post_Trend_Content_Image_Title'); ?>

                                                <?php if (isset($ifPostTrendContentImageTitle) && !empty($ifPostTrendContentImageTitle)) : ?>

                                                    <div class="" style="position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; width: 100vw; background-color: white;">

                                                        <div class="container mx-auto px-lg-0 px-4">
                                                            <div class="p-0 w-100 px-0">
                                                                <div class="col-12 p-0 pt-0 pb-0">
                                                                    <div class="row">

                                                                        <?php if (have_rows('Content_Post_Trend_Content_Image_Title')) : ?>

                                                                            <?php while (have_rows('Content_Post_Trend_Content_Image_Title')) : the_row() ?>

                                                                                <?php $titleContentPostTrendContentImageTitle = get_sub_field('Title_Content_Post_Trend_Content_Image_Title'); ?>
                                                                                <?php $imageContentPostTrendContentImageTitle = get_sub_field('Image__Content_Post_Trend_Content_Image_Title'); ?>

                                                                                <h2 class="NotoSans-Bold title-color mb-4 pt-4">
                                                                                    <?= strip_tags($titleContentPostTrendContentImageTitle); ?>
                                                                                </h2>
                                                                                <div class="d-flex justify-content-start align-items-center">
                                                                                    <div class="col-12 col-lg-12">
                                                                                        <?= wp_get_attachment_image($imageContentPostTrendContentImageTitle, 'full', '', ['class' => '', 'style' => 'width: 100%; height: 100%; object-fit: cover;']); ?>
                                                                                    </div>
                                                                                </div>

                                                                            <?php endwhile; ?>

                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                <?php endif; ?>


                                                <?php /* Title - Description  /  Content With Background Color */  ?>
                                                <?php $ifPostTrendContentTitleDescription = get_sub_field('If_Post_Trend_Content_Title_Description'); ?>
                                                <?php $contentPostTrendContentTitleDescription = get_sub_field('Content_Post_Trend_Content_Title_Description'); ?>

                                                <?php if (isset($ifPostTrendContentTitleDescription) && !empty($ifPostTrendContentTitleDescription)) : ?>

                                                    <div class="" style="position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; width: 100vw; background-color: white; margin-top: 1rem; margin-botton: 2rem;">

                                                        <div class="container mx-auto px-lg-0 px-4">
                                                            <div class="p-5 pt-3 pt-lg-5 w-100 px-0">
                                                                <div class="col-12 p-0">
                                                                    <div class="row">
                                                                        <?php $counter = 0 ?>

                                                                        <?php if (have_rows('Content_Post_Trend_Content_Title_Description')) : ?>

                                                                            <?php while (have_rows('Content_Post_Trend_Content_Title_Description')) : the_row() ?>

                                                                                <?php $titleContentPostTrendContentTitleDescription = get_sub_field('Title_Content_Post_Trend_Content_Title_Description'); ?>
                                                                                <?php $descriptioncontentPostTrendContentTitleDescription = get_sub_field('Description_Content_Post_Trend_Content_Title_Description'); ?>

                                                                                <h2 class="NotoSans-Bold title-color mb-4 <?= $counter > 0 ? 'pt-4' : ''; ?>">
                                                                                    <?= strip_tags($titleContentPostTrendContentTitleDescription); ?>
                                                                                </h2>
                                                                                <div class="NotoSans-Regular description-color px-2">
                                                                                    <?= strip_tags($descriptioncontentPostTrendContentTitleDescription, '<strong><em><ul><li><blockquote><a><br>'); ?>
                                                                                </div>

                                                                                <?php $counter++ ?>
                                                                            <?php endwhile; ?>

                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                <?php endif; ?>


                                                <?php /* Title - Image - Others  /  Content With Background Color */  ?>
                                                <?php $ifPostTrendContentTitleImageDescription = get_sub_field('If_Post_Trend_Content_Title_Image_Description'); ?>
                                                <?php $contentPostTrendContentTitleImageDescription = get_sub_field('Content_Post_Trend_Content_Title_Image_Description'); ?>


                                                <?php if (isset($ifPostTrendContentTitleImageDescription) && !empty($ifPostTrendContentTitleImageDescription)) : ?>

                                                    <div class="pt-4 pb-4" style="position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; width: 100vw; background-color: white;">

                                                        <div class="container mx-auto px-lg-0 px-4">
                                                            <div class="p-0 w-100 px-0">
                                                                <div class="col-12 p-0 pt-0 pb-0">
                                                                    <div class="row">
                                                                        <?php if (have_rows('Content_Post_Trend_Content_Title_Image_Description')) : ?>

                                                                            <?php while (have_rows('Content_Post_Trend_Content_Title_Image_Description')) : the_row() ?>

                                                                                <?php $titleContentPostTrendContentTitleImageDescription = get_sub_field('Title_Content_Post_Trend_Content_Title_Image_Description'); ?>
                                                                                <?php $firstDescriptionContentPostTrendContentTitleImageDescription = get_sub_field('First_Description_Content_Post_Trend_Content_Title_Image_Description'); ?>
                                                                                <?php $secondDescriptionContentPostTrendContentTitleImageDescription = get_sub_field('Second_Description_Content_Post_Trend_Content_Title_Image_Description'); ?>
                                                                                <?php $imageContentPostTrendContentTitleImageDescription = get_sub_field('Image_Content_Post_Trend_Content_Title_Image_Description'); ?>
                                                                                <?php $lastDescriptionContentPostTrendContentTitleImageDescription = get_sub_field('Last_Description_Content_Post_Trend_Content_Title_Image_Description'); ?>


                                                                                <h2 class="NotoSans-Bold title-color mb-4 pt-4">
                                                                                    <?= strip_tags($titleContentPostTrendContentTitleImageDescription, '<strong><em><ul><li><blockquote><a><br><h1><h2><h3><h4><h5>'); ?>
                                                                                </h2>
                                                                                <div class="NotoSans-Regular description-color px-2 mt-2 pb-2">
                                                                                    <?= strip_tags($firstDescriptionContentPostTrendContentTitleImageDescription, '<strong><em><ul><li><blockquote><a><br><h1><h2><h3><h4><h5>'); ?>
                                                                                </div>
                                                                                <div class="NotoSans-Regular description-color px-2 mt-2 pb-3">
                                                                                    <?= strip_tags($secondDescriptionContentPostTrendContentTitleImageDescription, '<strong><em><ul><li><blockquote><a><br><h1><h2><h3><h4><h5>'); ?>
                                                                                </div>
                                                                                <div class="d-flex justify-content-center align-items-center">
                                                                                    <div class="col-12 col-lg-10">
                                                                                        <?= wp_get_attachment_image($imageContentPostTrendContentTitleImageDescription, 'full', '', ['class' => '', 'style' => 'width: 100%; height: 100%; object-fit: cover;']); ?>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="NotoSans-Regular description-color px-2 mb-4 pt-4">
                                                                                    <?= strip_tags($lastDescriptionContentPostTrendContentTitleImageDescription, '<strong><em><ul><li><blockquote><a><br><h1><h2><h3><h4><h5>'); ?>
                                                                                </div>

                                                                            <?php endwhile; ?>

                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                <?php endif; ?>


                                                <?php /* Content with Subcontent  /  Content With Background Color */  ?>
                                                <?php $ifPostTrendContentSubcontent = get_sub_field('If_Post_Trend_Content_Subcontent'); ?>
                                                <?php $contentPostTrendSubcontent = get_sub_field('Content_Post_Trend_Subcontent'); ?>


                                                <?php if (isset($ifPostTrendContentSubcontent) && !empty($ifPostTrendContentSubcontent)) : ?>

                                                    <div class="" style="position: relative; left: 50%; right: 50%; margin-left: -50vw; margin-right: -50vw; width: 100vw; background-color: white; margin-top: 1rem; margin-bottom: 2rem;">

                                                        <div class="container mx-auto px-lg-0 px-4">
                                                            <div class="p-5 pt-3 w-100 px-0">
                                                                <div class="col-12 p-lg-5 p-3 pt-lg-0 pb-lg-0 pt-0 pb-0">
                                                                    <div class="row">
                                                                        <?php if (have_rows('Content_Post_Trend_Subcontent')) : ?>

                                                                            <?php while (have_rows('Content_Post_Trend_Subcontent')) : the_row() ?>


                                                                                <?php $titleContentPostTrendSubcontent = get_sub_field('Title_Content_Post_Trend_Subcontent'); ?>
                                                                                <?php $subcontentPostTrend = get_sub_field('Subcontent_Post_Trend'); ?>

                                                                                <h2 class="NotoSans-Bold title-color mb-4 pt-4">
                                                                                    <?= strip_tags($titleContentPostTrendSubcontent); ?>
                                                                                </h2>
                                                                                <a href="" target="_blank"></a>
                                                                                <div class="container mx-auto px-0">
                                                                                    <div class="p-5 pt-3 w-100 px-0">
                                                                                        <div class="col-12 p-lg-5 p-3 pt-lg-0 pb-lg-0 pt-0 pb-0">
                                                                                            <div class="row">
                                                                                                <?php if (have_rows('Subcontent_Post_Trend')) : ?>

                                                                                                    <?php while (have_rows('Subcontent_Post_Trend')) : the_row() ?>

                                                                                                        <?php $titleSubcontentPostTrend = get_sub_field('Title_Subcontent_Post_Trend'); ?>
                                                                                                        <?php $imageSubcontentPostTrend = get_sub_field('Image_Subcontent_Post_Trend'); ?>
                                                                                                        <?php $firstDescriptionSubcontentPostTrend = get_sub_field('First_Description_Subcontent_Post_Trend'); ?>

                                                                                                        <h3 class="NotoSans-Bold title-color mb-4 pt-4 text-center">
                                                                                                            <?= strip_tags($titleSubcontentPostTrend); ?>
                                                                                                        </h3>

                                                                                                        <div class="d-flex flex-md-row flex-column position-relative justify-content-center align-items-center">
                                                                                                            <div class="col-md-4 col-lg-4" style="border-radius: 1rem;">
                                                                                                                <div class="col-12">
                                                                                                                    <?= wp_get_attachment_image($imageSubcontentPostTrend, 'full', '', ['style' => 'height: 170px;width: 100%;object-fit: contain;']); ?>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                            <div class="col-md-8 col-lg-8 d-flex justify-content-center align-items-center">
                                                                                                                <div class="col-11 col-md-12 col-lg-12 p-0 m-0 pt-4 pb-4">
                                                                                                                    <div class="container-title-speaker-content-out mx-lg-5 ms-3">
                                                                                                                        <div class="container-content-outstanding">
                                                                                                                            <p class="NotoSans-Regular container-title-speaker-content-outstanding">
                                                                                                                                <?= strip_tags($firstDescriptionSubcontentPostTrend, '<strong><em><ul><li><blockquote><a><br>'); ?>
                                                                                                                            </p>
                                                                                                                        </div>
                                                                                                                    </div>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>

                                                                                                    <?php endwhile; ?>

                                                                                                <?php endif; ?>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                            <?php endwhile; ?>

                                                                        <?php endif; ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>

                                                <?php endif; ?>


                                            <?php endwhile; ?>

                                        <?php endif; ?>

                                    <?php endif; ?>
                                <?php endif; ?>


                            <?php endwhile; ?>
                        <?php endif; ?>

                    <?php endif ?>

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

                <?php $currentPostTrends = array($currentPostId); ?>

                <?php $excludeTaxId = 10 ?>

                <?php $filteredPosts = array_diff($postsIds, $currentPostTrends); ?>

                <?php if (!empty($filteredPosts)) : ?>

                    <?php
                    $newArgs = array(
                        'post__in' => $filteredPosts,
                        'tax_query' => array(
                            'relation' => 'AND',
                            array(
                                'taxonomy' => 'tendencias',
                                'field' => 'id',
                                'terms' => $taxId, // Asegúrate de que $taxId está definido
                                'operator' => 'IN',
                            ),
                            array(
                                'taxonomy' => 'tendencias',
                                'field' => 'id',
                                'terms' => $excludeTaxId, // Asegúrate de que $taxId está definido
                                'operator' => 'NOT IN',
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

                        <?php if (isset($ifPostTrendWithDiferentOptions) && !empty($ifPostTrendWithDiferentOptions)) : ?>
                            <?php if (isset($contentPostTrendWithDifferentOptions) && !empty($contentPostTrendWithDifferentOptions)) : ?>

                                <div class="container p-0 pt-lg-0">

                                    <div class="container background-single p-0 m-0 px-lg-5" style="background-color: #F9ECEA !important;">
                                        <div class="row d-flex flex-lg-row flex-column mt-3">

                                            <div class="row d-flex flex-lg-row flex-column d-flex flex-lg-row flex-column justify-content-start align-items-start container-card-category m-0 p-0 pt-3 mb-3">

                                                <?php while ($filteredPostsQuery->have_posts()) : $filteredPostsQuery->the_post() ?>

                                                    <?php $thePermalink = get_the_permalink(); ?>

                                                    <?php $imgPostTrend = get_field('Img_Post_Trend'); ?>

                                                    <div class="col-12 col-md-4 col-lg-4 col-xl-3 col-xxl-3 col-xxxl-3 d-flex flex-column justify-content-start align-items-center card-taxonomies-subcategory-academy-events m-0 p-0 mt-3 mb-3">
                                                        <a class="custom-width" href="<?= $thePermalink . '?tax=' . $taxId; ?>" onclick="saveLogsClick('Clic en tarjeta `<?= the_title(); ?>`');" style="text-decoration: none;">
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

                        <?php else : ?>

                            <div class="container p-lg-5 pt-lg-0">

                                <div class="container background-single p-0 m-0 px-lg-5">
                                    <div class="row d-flex flex-lg-row flex-column  mt-3">

                                        <div class="row d-flex flex-lg-row flex-column d-flex flex-lg-row flex-column justify-content-start align-items-start container-card-category m-0 p-0 pt-3 mb-3">

                                            <?php while ($filteredPostsQuery->have_posts()) : $filteredPostsQuery->the_post() ?>

                                                <?php $thePermalink = get_the_permalink(); ?>

                                                <?php $imgPostTrend = get_field('Img_Post_Trend'); ?>

                                                <div class="col-12 col-md-4 col-lg-4 col-xl-3 col-xxl-3 col-xxxl-3 d-flex flex-column justify-content-start align-items-center card-taxonomies-subcategory-academy-events m-0 p-0 mt-3 mb-3">
                                                    <a class="custom-width" href="<?= $thePermalink . '?tax=' . $taxId; ?>" onclick="saveLogsClick('Clic en tarjeta `<?= the_title(); ?>`');" style="text-decoration: none;">
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

                    <?php endif; ?>


                    <div class="container m-lg-3 mx-lg-auto m-3 px-0">
                        <h5 class="NotoSans-Bold title-color">
                            <?php $codePromomats = get_field('code_promomats'); ?>
                            <p><?= $codePromomats ?></p>
                        </h5>
                    </div>

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
                                                                    <iframe src="https://drive.google.com/viewerng/viewer?embedded=true&url=<?= $urlPdfModuleAcademy ?>" class="d-block d-lg-none" style="width: 90%; height: 500px;" frameborder="0"></iframe>

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

                                            <a href="<?= esc_url(get_permalink($postActivityId) . '?module_id=' . $postActivityId . '&content_id=' . $index . '&tax=' . $taxId); ?>" onclick="saveLogsClick('Clic en `<?= the_title() ?>`, `<?= $SubtitleModule; ?>` `<?= isset($titleModuleAcademy) ? $titleModuleAcademy : '' ?><?= isset($secondTitleModuleAcademyCourse) ? ' - ' . $secondTitleModuleAcademyCourse : '' ?>`');" class="session-a">
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