<?php
/**
 * The template for displaying taxonomy pages.
 */

get_header(); 
$taxonomy = get_queried_object();
$current_category = get_query_var('cat');
$cuttentTaxonomyId = $taxonomy->term_taxonomy_id;
$currentTermId = $taxonomy->parent;
?>


<!-- Codigo que asigna la plantilla de las taxonomias y subcategorias provenientes de los distintos post-types del proyecto -->


<?php
    /* Consulta en base de datos que valida si la categoria cuenta con status activo, es decir si el campo True/False tiene
    check mostrara el conteido, de lo contrario lo ocultara  */

    global $wpdb;

    $tableTermmeta = $wpdb->prefix . 'termmeta';

    $metaKey = 'View_With_National_Events';
    $otherMetaKey = 'View_With_Training_Course';
    $visionMetaKey = 'View_With_Vision_Innsider';
    $metaValue = '1';

    $allData = $wpdb->prepare("SELECT *  FROM {$tableTermmeta} WHERE `meta_key` = '{$metaKey}' AND `meta_VALUE` = '{$metaValue}'");

    $allCategoriesWithNationalEvents = $wpdb->get_results($wpdb->prepare($allData));

    $otherAllData = $wpdb->prepare("SELECT *  FROM {$tableTermmeta} WHERE `meta_key` = '{$otherMetaKey}' AND `meta_VALUE` = '{$metaValue}'");

    $allCategoriesViewWithTrainingCourse = $wpdb->get_results($wpdb->prepare($otherAllData));

    $otherAllDataVision = $wpdb->prepare("SELECT *  FROM {$tableTermmeta} WHERE `meta_key` = '{$visionMetaKey}' AND `meta_VALUE` = '{$metaValue}'");

    $allCategoriesViewWithVision = $wpdb->get_results($wpdb->prepare($otherAllDataVision));
?>


<?php  if ( ! is_wp_error( $allCategoriesWithNationalEvents) && ! empty( $allCategoriesWithNationalEvents ) ) : ?>

    <?php /* En este foreach se recorre el arreglo $all_categories_with_status_active
    para hacer uso de $categories_with_status->term_id */ ?>
    <?php foreach($allCategoriesWithNationalEvents as $CategoriesWithNationalEvents) :  ?>

        <?php $listIdWithNationalEvents = $CategoriesWithNationalEvents->term_id; ?>

        <?php if($taxonomy->term_id == $listIdWithNationalEvents) : ?>
            <?php get_template_part('template-parts/template-taxonomies/template-taxonomies-events-nationals'); ?>
        <?php endif ?>

    <?php endforeach ?>

<?php endif; ?>


<?php  if ( ! is_wp_error( $allCategoriesViewWithTrainingCourse) && ! empty( $allCategoriesViewWithTrainingCourse ) ) : ?>

    <?php /* En este foreach se recorre el arreglo $all_categories_with_status_active
    para hacer uso de $categories_with_status->term_id */ ?>
    <?php foreach($allCategoriesViewWithTrainingCourse as $CategoriesViewWithTrainingCourse) :  ?>

        <?php $listIdViewWithTrainingCourse = $CategoriesViewWithTrainingCourse->term_id; ?>

        <?php if($taxonomy->term_id == $listIdViewWithTrainingCourse) : ?>
            <?php get_template_part('template-parts/template-taxonomies/template-taxonomies-courses-formation'); ?>
        <?php endif ?>

    <?php endforeach ?>

<?php endif; ?>



<?php  if ( ! is_wp_error( $allCategoriesViewWithVision) && ! empty( $allCategoriesViewWithVision) ) : ?>

    <?php /* En este foreach se recorre el arreglo $all_categories_with_status_active
    para hacer uso de $categories_with_status->term_id */ ?>
    <?php foreach($allCategoriesViewWithVision as $CategoriesViewWithVision) :  ?>

        <?php $listIdViewWithVision = $CategoriesViewWithVision->term_id; ?>

        <?php if($taxonomy->term_id == $listIdViewWithVision) : ?>
            <?php get_template_part('template-parts/template-taxonomies/template-taxonomies-vision'); ?>
        <?php endif ?>

    <?php endforeach ?>

<?php endif; ?>


<?php /* Código que asigna una template a las subcategorias de la taxonomia academia */ ?>



<?php if(isset($currentTermId) && !empty($currentTermId) && !0) : ?>
    <?php 

        $subcategoriesAcademy = get_terms(
            array(
                'taxonomy' => 'academia',
                'hide_empty' => false,
                'parent' => $currentTermId,
                'order' => 'ASC',
            )
        );

    ?>
<?php endif; ?>


<?php if(!empty($subcategoriesAcademy) && !is_wp_error($subcategoriesAcademy)) : ?>
    <?php foreach($subcategoriesAcademy as $subcategoryAcademy) : ?>
        <?php $subcategoryAcademyId = $subcategoryAcademy->term_id; ?>
            <?php if($cuttentTaxonomyId == $subcategoryAcademyId) : ?>
                <?php get_template_part('template-parts/template-taxonomies/template-subcategories-taxonomies/template-taxonomies-subcategories-events'); ?>
            <?php endif ?>
    <?php endforeach; ?>
<?php endif ?>

<?php /* Fin del código que asigna una template a las subcategorias de la taxonomia academia */ ?>

<!-- Fin de codigo -->


<?php get_footer(); ?>