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

    $viewcategoryEvents = 'View_With_National_Events';
    $viewcategoryCourse = 'View_With_Training_Course';
    $viewContentResourcesInterest = 'View_With_Resources_Interest';
    $viewContentFirstTempVisionInnsider = 'View_With_First_Temp_Vision_Innsider';
    $viewContentSecondTempVisionInnsider = 'View_With_Second_Temp_Vision_Innsider';
    $ViewWithInnsiderReview = 'View_With_Innsider_Review';

    $metaValue = '1';

    $allData = $wpdb->prepare("SELECT *  FROM {$tableTermmeta} WHERE `meta_key` = '{$viewcategoryEvents}' AND `meta_VALUE` = '{$metaValue}'");
    $allCategoriesWithNationalEvents = $wpdb->get_results($wpdb->prepare($allData));


    $otherAllData = $wpdb->prepare("SELECT *  FROM {$tableTermmeta} WHERE `meta_key` = '{$viewcategoryCourse}' AND `meta_VALUE` = '{$metaValue}'");
    $allCategoriesViewWithTrainingCourse = $wpdb->get_results($wpdb->prepare($otherAllData));


    $AllResourcesInterest = $wpdb->prepare("SELECT *  FROM {$tableTermmeta} WHERE `meta_key` = '{$viewContentResourcesInterest}' AND `meta_VALUE` = '{$metaValue}'");
    $allCategoriesContentResourcesInterest = $wpdb->get_results($wpdb->prepare($AllResourcesInterest));

    
    $otherAllDataVisionFirstTemp = $wpdb->prepare("SELECT *  FROM {$tableTermmeta} WHERE `meta_key` = '{$viewContentFirstTempVisionInnsider}' AND `meta_VALUE` = '{$metaValue}'");
    $allCategoriesViewWithVisionFirstTemp = $wpdb->get_results($wpdb->prepare($otherAllDataVisionFirstTemp));


    $otherAllDataVisionSecondTemp = $wpdb->prepare("SELECT *  FROM {$tableTermmeta} WHERE `meta_key` = '{$viewContentSecondTempVisionInnsider}' AND `meta_VALUE` = '{$metaValue}'");
    $allCategoriesViewWithVisionSecondTemp = $wpdb->get_results($wpdb->prepare($otherAllDataVisionSecondTemp));


    $checkInnsiderReview = $wpdb->prepare("SELECT *  FROM {$tableTermmeta} WHERE `meta_key` = '{$ViewWithInnsiderReview}' AND `meta_VALUE` = '{$metaValue}'");
    $validatCheckInnsiderReview = $wpdb->get_results($wpdb->prepare($checkInnsiderReview));
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


<?php  if ( ! is_wp_error( $allCategoriesContentResourcesInterest) && ! empty( $allCategoriesContentResourcesInterest ) ) : ?>

    <?php /* En este foreach se recorre el arreglo $all_categories_with_status_active
    para hacer uso de $categories_with_status->term_id */ ?>
    <?php foreach($allCategoriesContentResourcesInterest as $CategoriesContentResourcesInterest) :  ?>

        <?php $listIdWithResourcesInterest = $CategoriesContentResourcesInterest->term_id; ?>

        <?php if($taxonomy->term_id == $listIdWithResourcesInterest) : ?>
            <?php get_template_part('template-parts/template-taxonomies/template-taxonomies-resources-Interest'); ?>
        <?php endif ?>

    <?php endforeach ?>

<?php endif; ?>


<?php  if ( ! is_wp_error( $allCategoriesViewWithVisionFirstTemp) && ! empty( $allCategoriesViewWithVisionFirstTemp) ) : ?>

    <?php /* En este foreach se recorre el arreglo $all_categories_with_status_active
    para hacer uso de $categories_with_status->term_id */ ?>
    <?php foreach($allCategoriesViewWithVisionFirstTemp as $CategoriesViewWithVisionFirstTemp) :  ?>

        <?php $listIdViewWithVisionFirstTemp = $CategoriesViewWithVisionFirstTemp->term_id; ?>

        <?php if($taxonomy->term_id == $listIdViewWithVisionFirstTemp) : ?>
            <?php get_template_part('template-parts/template-taxonomies/template-taxonomies-vision'); ?>
        <?php endif ?>

    <?php endforeach ?>

<?php endif; ?>



<?php  if ( ! is_wp_error( $validatCheckInnsiderReview) && ! empty( $validatCheckInnsiderReview ) ) : ?>

    <?php /* En este foreach se recorre el arreglo $all_categories_with_status_active
    para hacer uso de $categories_with_status->term_id */ ?>

    <?php foreach($validatCheckInnsiderReview as $CheckInnsiderReview) :  ?>

        <?php $listIdWithInnsiderReview = $CheckInnsiderReview->term_id; ?>

        <?php if($taxonomy->term_id == $listIdWithInnsiderReview) : ?>
            <?php get_template_part('template-parts/template-taxonomies/template-taxonomies-innsider-review'); ?>
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