<?php

/**
 * Taxonomy template Events Nationals
 *
 * @package Connexo
 */

$taxonomy = get_queried_object();
?>
<div class="container mx-5 mx-lg-auto px-0">
    <div class="container mt-4 mx-0 px-0 pb-4">
        <?php custom_breadcrumbs(); ?>
    </div>
</div>

<div class="container background-taxonomy mt-lg-3 mt-3 px-5">
    <div class="container banner-taxonomy-academy">
        <img src="<?= get_template_directory_uri() . '/assets/images/BannerHome.jpg';  ?>" alt="Herramientas" class="bg-taxonomy-academy">
        <div class="wrapper-taxonomy-academy"></div>
    </div>
    <div class="container mt-4">
        <div class="row m-0 p-0">
            <h1 class="NotoSans-Bold title-color mb-3 text-uppercase">más de 280 líderes del sector salud se dieron cita en barranquilla</h1>
            <h5 class="NotoSans-SemiBold description-color line-height-2 text-align-justify mb-lg-5 mb-2">Por cuarto año consecutivo, los actores clave del sector salud en Colombia participaron en un espacio de conocimiento y apropiación de su situación actual. El evento abordó una aproximación de corto, mediano y largo plazo a la adaptabilidad de las organizaciones en tiempos de crisis para tener una visión de un mejor sistema de salud.</h5>
        </div>
    </div>
</div>

<div class="container mx-auto px-0">
    <div class="container mt-4 mx-lg-0 mx-2 px-0 pb-4">
        <div class="row m-0 p-0">

            <?php
                $listPostAcademy = new WP_Query
                (
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
        
            <?php if(isset($listPostAcademy) && !empty($listPostAcademy)) : ?> 
                <?php if($listPostAcademy->have_posts()) : ?>
                    <?php while($listPostAcademy->have_posts()) : $listPostAcademy->the_post() ?>

                        <?php $SubtitleModule = get_field('Subtitle_Module'); ?>
                        <?php $postActivityId = get_the_ID(); ?>

                        <h3 class="NotoSans-Bold title-color"><?= the_title() ?></h3>
                        <h2 class="NotoSans-Bold m-0 text-uppercase text-linear-gradient"><?= $SubtitleModule; ?></h2>

                        <div class="col-12 mx-1" id="linea">
                            <hr>
                        </div>

                        <?php $listContentModules = get_field('list_of_content_module'); ?>

                        <?php if(isset($listContentModules) && !empty($listContentModules)) : ?>

                            <?php $counter = 0; ?>

                            <?php foreach($listContentModules as $listContentModule) : ?>

                                <?php $imageModuleAcademy = $listContentModule['Img_Video_Mod']; ?>
                                <?php $titleModuleAcademy = $listContentModule['Title_Video_Mod']; ?>
                                <?php $speakerModuleAcademy = $listContentModule['Name_Speaker_Mod']; ?>
                                <?php $descriptionModuleAcademy = $listContentModule['Description_Module']; ?>
                                <?php $urlModuleAcademy = $listContentModule['URL_Video_Module']; ?>

                                <div class="col-12 col-md-4 col-lg-3 col-xl-3 col-xxl-3 col-xxxl-3 d-flex flex-column justify-content-start align-items-center container-card-category m-0 p-0 mt-3 mb-3">
                                    <div class="col-11 d-flex justify-content-center align-items-center">
                                        <a href="<?php echo get_permalink($postActivityId) . '?module_id=' . $postActivityId . '&content_id=' . $counter . '&tax=' . $taxonomy->term_id; ?>" style="text-decoration: none;">
                                            <div class="card" style="border: none !important">
                                                <?php if($imageModuleAcademy) : ?>
                                                    <img class="img-card-event" src="<?php echo wp_get_attachment_url($imageModuleAcademy); ?>" alt="Podcast">
                                                <?php endif; ?>
                                                <div class="card-info mt-lg-4 mt-3 p-0">
                                                    <div class="w-75 p-2 mb-2" style="border-radius: 0.5rem; background: #001965; color: white;"><i class="fa-regular fa-circle-play mx-2"></i>Ver ahora</div>
                                                    <?php if($titleModuleAcademy) : ?>
                                                        <h5 class="NotoSans-Bold title-color"><?= $titleModuleAcademy; ?></h5>
                                                    <?php endif; ?>
                                                    <?php if($speakerModuleAcademy) : ?>
                                                        <p class="NotoSans-Regular description-color"><?= $speakerModuleAcademy; ?></p>
                                                    <?php endif; ?>     
                                                </div>
                                            </div>
                                        </a>
                                    </div>
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