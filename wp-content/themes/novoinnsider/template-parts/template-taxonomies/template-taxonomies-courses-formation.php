<?php

/**
 * Taxonomy template Courses Formation
 *
 * @package Connexo
 */

$current_category = get_query_var('cat');
$term_for_category = get_term($current_category);
$id_page = get_the_id();
?>

<h1>Hola 2</h1>

<!-- <div class="row">
    <div class="banner-single-speaker">
        <div class="container">
            <div class="dinamic-width-banner">

                <?php $image_category = get_field('category_image', $category); ?>

                <?php if( $image_category ) :  ?>

                    <?php echo wp_get_attachment_image($image_category, 'full', '',['class' => 'bg-banner-single-speaker']); ?>

                <?php endif ?>

            </div>
            <div class="wrapper-banner-single-speaker">
                <div class="container-text-banner-single-speaker">
                    <h1 class="name-single-speaker Commissioner-Bold">
                        <?php echo $term_for_category->name ?>
                    </h1>

                    <div class="position-relative">
                        <div class="">
                            <p class=" text-single-speaker Commissioner-Bold" style="visibility: hidden">
                                <?php echo $term_for_category->description ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="position-relative">
        <div class="position-absolute" style="bottom: 1rem">
            <p class=" text-single-speaker Commissioner-Bold class-border-subtitle">
                <?php echo $term_for_category->description ?>
            </p>
        </div>
    </div>
</div> -->

<div class="container mt-2 mb-2">
    <div class="swiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide">
                <?php $banner_image = get_field('category_image_eje_tematico',$term_for_category) ?>
                <?php if(isset($banner_image) && !empty($banner_image)) : ?>
                    <?php $image_attributes = wp_get_attachment_image_src($banner_image, 'full'); ?>
                    <?php if(isset($image_attributes)) : ?>
                        <?php 
                            $image_url = $image_attributes[0];
                            $image_class = 'w-100 border-style-img';
                            $image_output = '<img src="' . $image_url . '" class="' . $image_class . '">';
                            echo $image_output;
                        ?>
                    <?php endif; ?>
                <?php else: ?>
                    <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/banner_5.jpg" class="w-100 border-style-img">
                <?php endif ?>
            </div>
        </div>
    </div>

</div>

<!--CONTENIDO DE INTERES-->
<div class="row m-0 p-0 position-relative">
    <div class="col-12 m-0 p-0">
        <div class="col-lg-6 col-10 fuente content-title-descripton" style="justify-content: start !important;">
            <?php $title_complementary = get_field('title_for_description_complementary',$term_for_category) ?>
            <?php if(isset($title_complementary) && !empty($title_complementary)) : ?>
                <h2 class="Commissioner-Bold mx-1 mx-lg-4"><?php echo $title_complementary; ?></h2>
            <?php else: ?>
                <h2 class="Commissioner-Bold mx-1 mx-lg-4">En este contenido usted encontrará eeeeee</h2>
            <?php endif ?>
        </div>
    </div>
</div>     

<div class="row m-0 p-0 position-relative d-flex justify-content-center align-items-center">
    <div class="col-12 mx-2 px-2">
        <div class="description-container">
            <?php $description_complementary = get_field('description_complementary',$term_for_category) ?>
            <?php if(isset($description_complementary) && !empty($description_complementary)) : ?>
                <p class="m-3"><?= esc_html(wp_strip_all_tags($description_complementary)) ?></p>
            <?php else: ?>
                <p class="m-3">Herramientas para promover una adecuada gestión del riesgo y fomentar la cultura de toma de decisiones basada en datos y así aprovechar las oportunidades de la  constante dinámica sectorial en pro de mejorar la calidad  de vida de los pacientes</p>
            <?php endif ?>
        </div>
    </div>
</div>    

<?php
    /* Consulta en base de datos que valida si la categoria cuenta con status activo, es decir si el campo True/False tiene
    check mostrara el conteido, de lo contrario lo ocultara  */

    global $wpdb;

    $table_termmeta = $wpdb->prefix . 'termmeta';

    $meta_key = 'status_categories';
    $meta_value = '1';

    $all_data = $wpdb->prepare("SELECT *  FROM {$table_termmeta} WHERE `meta_key` = '{$meta_key}' AND `meta_VALUE` = '{$meta_value}'");

    $all_categories_with_status_active = $wpdb->get_results($wpdb->prepare($all_data));
?>


<?php  if ( ! is_wp_error( $all_categories_with_status_active) && ! empty( $all_categories_with_status_active ) ) : ?>

<div class="row p-0 p-lg-5 m-5 d-flex justify-content-center">

    <?php $cont = 0 ?>

    <?php /* En este foreach se valida las subcategorias que debe cotener la variable $subsubtegories en relacion a la categoria Eventos */ ?>
    <?php foreach($subcategories as $subcatego) : ?>

        <?php $secondsubcategory = connexo_int_get_list_subcategories($subcatego->term_id); ?>

        <?php foreach($secondsubcategory as $secondsubcategories) : ?>

            <?php /* Definimos la variable $thissubcatego que almacena todos los id de las subcategorias de Eventos */ ?>
            <?php $thissubcatego = $secondsubcategories->term_id ?>

                <?php /* En este foreach se recorre el arreglo $all_categories_with_status_active para hacer uso de $categories_with_status->term_id */ ?>
                <?php foreach($all_categories_with_status_active as $categories_with_status_active) :  ?>

                    <?php /* Definimos la variable $category_status_active que almacena todos los id de las subcategorias de Eventos con status Activo */ ?>
                    <?php $category_status_active = $categories_with_status_active->term_id ?>

                    <?php /* En este IF se comparan las varaibles $thissubcatego y $category_status_active con el fin de validar que la categoria tenga el status activo
                        y correspondan a la lista de subcategorias */ ?>
                    <?php if($thissubcatego == $category_status_active) : ?>

                        <?php $parent_category_id = $current_category; ?>

                        <?php $parent_category_id; ?>

                            <?php  $validatesubcategory = get_term_children( $parent_category_id, 'category' ); ?>

                            <?php foreach($validatesubcategory as $validatesubcategories) : ?>

                                <?php if($validatesubcategories == $thissubcatego) : ?>

                                    <?php if ($cont % 2 === 0) : ?>

                                        <div class="col-12 col-md-6 col-lg-5 col-xl-5 d-flex flex-column justify-content-center align-items-lg-end align-items-center mx-lg-3 container-card-category-impact">

                                            <a href="<?php echo get_term_link($secondsubcategories->term_id) ?>">

                                                <?php $image_subcategory = get_field('category_image', $secondsubcategories); ?>
                                                <?php $description_complementary = get_field('description_complementary', $secondsubcategories); ?>
                                                <?php $second_description_complementary = get_field('description_complementary_two', $secondsubcategories); ?>

                                                <div class="mb-5 figure d-flex justify-content-center align-items-center" style="object-fit: cover; background-size: 100% 100%; background-image: url('<?php echo wp_get_attachment_image_url($image_subcategory, 'full', '',['style' => 'object-fit: cover;']); ?>');">
                                                    <a href="<?php echo get_term_link($secondsubcategories->term_id) ?>" style="text-decoration: none">
                                                        <div style="position: absolute; z-index: 99; width: 70px; height: 50px; right: 0px; top: 9px; background: #F05A24; border-bottom-left-radius: 2rem; border-top-left-radius: 2rem;" >
                                                            <?php if (get_field('show_pdf')) : ?>
                                                                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logo-libro.svg" style="width: 65px; height: 35px; margin-left: 0.3rem; margin-top: 0.3rem; object-fit: contain">
                                                            <?php elseif (get_field('show_video')) : ?>
                                                                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logo-video.svg" style="width: 65px; height: 35px; margin-left: 0.3rem; margin-top: 0.3rem; object-fit: contain">
                                                            <?php else: ?>
                                                                <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logo-libro.svg"  style="width: 65px; height: 35px; margin-left: 0.3rem; margin-top: 0.3rem; object-fit: contain">
                                                            <?php endif; ?>
                                                        </div>

                                                        <div class="d-flex justify-content-center align-items-center" >
                                                            <div class="card-community-video" style="object-fit: cover;">
                                                                <div class="mx-1 mt-2" style="display: flex; flex-direction: column; justify-content: star; align-items: center; text-align: left; bottom: 1px; text-decoration: none; width: 100%; color: white">
                                                                    <h4 class="class-title-card-events-new-title"><span style="font-weight: bold;"></span></h4>
                                                                    <div style="width: 70%;">
                                                                        <?php $list_of_benefits = get_field('list_of_benefits', $secondsubcategories); ?>

                                                                        <?php if(isset($list_of_benefits) && !empty($list_of_benefits)) : ?>

                                                                            <?php foreach($list_of_benefits as $list_of_benefit) : ?>

                                                                                <?php $image_prubasdasdada = $list_of_benefit['Ico_img_event']; ?>
                                                                                <?php $titlesubevent = $list_of_benefit['title_subeventos']; ?>

                                                                                <?php if(isset($image_prubasdasdada)) : ?>
                                                                                    <?php echo wp_get_attachment_image($image_prubasdasdada, 'full', '', ['class' => 'class-img-ico-events']); ?>
                                                                                <?php endif; ?>

                                                                                <?php if(isset($titlesubevent)) : ?>
                                                                                    <p class="class-title-sub-title-event"><?php echo $titlesubevent; ?></p>
                                                                                <?php endif; ?>

                                                                            <?php endforeach; ?>

                                                                        <?php endif; ?>  
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div style="display: flex; justify-content: center; align-items: center; position: absolute; text-align: center; bottom: 1px; text-decoration: none; width: 100%">
                                                            <a href="<?php echo get_term_link($secondsubcategories->term_id) ?>" style="text-decoration: none; color: white; background: #F05A24; padding: 0.5rem 3rem; border-radius: 0.5rem; font-size: 1rem">Ver más</a>
                                                        </div>
                                                    </a>
                                                </div>
                                            </a>
                                        </div>

                                        <?php else : ?>

                                        <div class=" col-12 col-md-6 col-lg-5 col-xl-5 d-flex flex-column justify-content-center align-items-lg-start align-items-center mx-lg-3 container-card-category-impact">

                                        <a href="<?php echo get_term_link($secondsubcategories->term_id) ?>">

                                                <?php $image_subcategory = get_field('category_image', $secondsubcategories); ?>
                                                <?php $description_complementary = get_field('description_complementary', $secondsubcategories); ?>
                                                <?php $second_description_complementary = get_field('description_complementary_two', $secondsubcategories); ?>

                                            <div class="mb-5 figure d-flex justify-content-center align-items-center" style="object-fit: cover; background-size: 100% 100%;  background-image: url('<?php echo wp_get_attachment_image_url($image_subcategory, 'full', '',['style' => 'object-fit: cover']); ?>');">
                                                <a href="<?php echo get_term_link($secondsubcategories->term_id) ?>" style="text-decoration: none">
                                                    <div style="position: absolute; z-index: 99; width: 70px; height: 50px; right: 0px; top: 9px; background: #F05A24; border-bottom-left-radius: 2rem; border-top-left-radius: 2rem;" >
                                                        <?php if (get_field('show_pdf')) : ?>
                                                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logo-libro.svg" style="width: 65px; height: 35px; margin-left: 0.3rem; margin-top: 0.3rem; object-fit: contain">
                                                        <?php elseif (get_field('show_video')) : ?>
                                                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logo-video.svg" style="width: 65px; height: 35px; margin-left: 0.3rem; margin-top: 0.3rem; object-fit: contain">
                                                        <?php else: ?>
                                                            <img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/logo-libro.svg"  style="width: 65px; height: 35px; margin-left: 0.3rem; margin-top: 0.3rem; object-fit: contain">
                                                        <?php endif; ?>
                                                    </div>

                                                    <div class="d-flex justify-content-center align-items-center" >
                                                        <div class="card-community-video" style="object-fit: cover;">
                                                            <div class="mx-1 mt-2" style="display: flex; flex-direction: column; justify-content: center; align-items: center; text-align: center; bottom: 1px; text-decoration: none; width: 100%; color: white">
                                                                <h4 class="class-title-card-events-new-title"></h4>
                                                                    <div style="width: 70%;">
                                                                        <?php $list_of_benefits = get_field('list_of_benefits', $secondsubcategories); ?>

                                                                        <?php if(isset($list_of_benefits) && !empty($list_of_benefits)) : ?>

                                                                            <?php foreach($list_of_benefits as $list_of_benefit) : ?>

                                                                                <?php $image_prubasdasdada = $list_of_benefit['Ico_img_event']; ?>
                                                                                <?php $titlesubevent = $list_of_benefit['title_subeventos']; ?>

                                                                                <?php if(isset($image_prubasdasdada)) : ?>
                                                                                    <?php echo wp_get_attachment_image($image_prubasdasdada, 'full', '', ['class' => 'class-img-ico-events']); ?>
                                                                                <?php endif; ?>

                                                                                <?php if(isset($titlesubevent)) : ?>
                                                                                    <p class="class-title-sub-title-event"><?php echo $titlesubevent; ?></p>
                                                                                <?php endif; ?>

                                                                            <?php endforeach; ?>

                                                                        <?php endif; ?>  
                                                                    </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div style="display: flex; justify-content: center; align-items: center; position: absolute; text-align: center; bottom: 1px; text-decoration: none; width: 100%">
                                                        <a href="<?php echo get_term_link($secondsubcategories->term_id) ?>" style="text-decoration: none; color: white; background: #F05A24; padding: 0.5rem 3rem; border-radius: 0.5rem; font-size: 1rem">Ver más</a>
                                                    </div>
                                                </a>
                                            </div>
                                            </a>
                                        </div>

                                    <?php endif; ?>

                                <?php endif; ?>

                            <?php endforeach; ?>

                    <?php endif ?>    

                <?php endforeach; ?>

            <?php $cont++ ?>
            
        <?php endforeach; ?>    

    <?php endforeach; ?>

</div>

<?php endif; ?>
