<?php
/**
 * Single template post.
 *
 */

get_header();


$taxId = isset($_GET['tax']) ? intval($_GET['tax']) : 0;
$moduleId = isset($_GET['module_id']) ? intval($_GET['module_id']) : 0;
$contentId = isset($_GET['content_id']) ? intval($_GET['content_id']) : 0;

?>

<div class="container mx-5 mx-lg-auto px-0">
    <div class="mt-4 mx-0 px-0 pb-4">
        <?php custom_breadcrumbs(); ?>
    </div>
</div>

<div class="container mx-auto px-0">
    <div class="mt-4 mx-lg-0 mx-2 px-0 pb-4">
        <div class="row m-0 p-0"></div>

            <?php
                $listPostAcademy = new WP_Query
                (
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
                    
            <?php if(isset($listPostAcademy) && !empty($listPostAcademy)) : ?> 
                <?php if($listPostAcademy->have_posts()) : ?>

                    <?php while($listPostAcademy->have_posts()) : $listPostAcademy->the_post() ?>

                        <?php $SubtitleModule = get_field('Subtitle_Module'); ?>
                        <?php $postActivityId = get_the_ID(); ?>

                        <?php $listContentModules = get_field('list_of_content_module'); ?>

                        <?php if(isset($listContentModules) && !empty($listContentModules)) : ?>

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

        </div>  
    </div>
</div>    

<?php get_footer(); ?>
