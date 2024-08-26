<?php

/**
 * Taxonomy template Courses Formation
 *
 */

 $taxonomy = get_queried_object();
 ?>
 
 
<?php if (isset($taxonomy->term_id) && !empty($taxonomy->term_id)) : ?>
 
     <?php $currentTermId = $taxonomy->term_id; ?>
 
     <?php
 
     $subcategories = get_terms(
         array(
             'taxonomy' => $taxonomy->taxonomy,
             'hide_empty' => false,
             'parent' => $currentTermId,
             'order' => 'ASC',
         )
     )
 
     ?>
 
     <?php if (!empty($subcategories) && !is_wp_error($subcategories)) : ?>
 
         <div class="container mx-5 mx-lg-auto px-0">
             <div class="container mt-4 mx-0 px-0 pb-4">
                 <?php custom_breadcrumbs(); ?>
             </div>
         </div>
 
 
         <?php $descriptioonCategory = $taxonomy->description; ?>
         <?php $subtitleCategory = get_field('title_for_description_complementary', $taxonomy); ?>
         <?php $bannerCategory = get_field('Category_Image_Banner', $taxonomy); ?>
 
 
         <div class="container background-taxonomy mt-lg-3 mt-3 px-5">
             <div class="container banner-taxonomy-academy" data-aos="zoom-in">
                 <?php if (isset($bannerCategory) && !empty($bannerCategory)) : ?>
                     <img src="<?= esc_url(wp_get_attachment_url($bannerCategory)); ?>" alt="Herramientas" class="bg-taxonomy-academy">
                 <?php endif; ?>
                 <div class="wrapper-taxonomy-academy"></div>
             </div>
             <div class="container mt-4">
                 <div class="row m-0 p-0">
                     <?php if (isset($descriptioonCategory) && !empty($descriptioonCategory)) : ?>
                        <h1 class="NotoSans-Bold title-color mb-3 text-uppercase d-none d-lg-block"><?= $descriptioonCategory; ?></h1>
                        <h5 class="NotoSans-Bold title-color mb-3 text-uppercase d-block d-lg-none"><?= $descriptioonCategory; ?></h5>
                     <?php endif ?>
                     <?php if (isset($subtitleCategory) && !empty($subtitleCategory)) : ?>
                        <h5 class="NotoSans-SemiBold description-color line-height-2 text-align-justify mb-lg-5 mb-2"><?= $subtitleCategory; ?></h5>
                     <?php endif ?>
                 </div>
             </div>
         </div>
 
         <div class="container mt-lg-5 mt-3 p-0">
             <div id="linea">
                 <hr>
             </div>
         </div>
 
 
 
         <div class="container p-0">                        
             <div class="row m-0 mt-5 mb-4 p-0 d-flex justify-content-center align-items-start">
 
                 <?php foreach ($subcategories as $subcategory) :  ?>
 
                    <div class="container mt-3 mb-3">
                        <div class="row">
                            <div class="col-12 card-subcategory-academy-course background-taxonomy-card-subcategory-academy-course">
                                <a href="<?php echo get_term_link($subcategory->term_id) ?>">
                                    <div class="d-flex flex-md-row flex-column position-relative justify-content-center align-items-center">
                                        <div class="col-md-4 col-lg-4" style="border-radius: 1rem;">
                                            <div class="figure">
                                                <?php $imageSubcategoryAcademy = get_field('Category_Image', $subcategory); ?>

                                                <?php if ($imageSubcategoryAcademy) :  ?>
                                                    <?php echo wp_get_attachment_image($imageSubcategoryAcademy, 'full', '', ['class' => 'img-featured-content']); ?>
                                                <?php endif ?>
                                            </div>   
                                        </div>
                                        <div class="col-md-8 col-lg-8 d-flex justify-content-center align-items-center">
                                            <div class="col-12 p-0 m-0 pt-4 pb-4 background-text-subcategory-academy-course">
                                                <div class="container-title-speaker-content-out mx-lg-5 ms-3">
                                                    <div class="container-content-outstanding">
                                                        <h4 class="container-title-speaker-content-outstanding">
                                                            <?= $subcategory->name; ?>
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6 d-flex justify-content-start align-items-center mx-lg-5 ms-3">
                                                        <div class="w-50">
                                                            <div class="w-100 p-lg-2 mt-lg-3 mb-lg-2 btn-view-more">Ver más</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
 
                 <?php endforeach ?>
 
             </div>
         </div>

        <div class="col-12 border p-5 mb-5 mt-5 background-section-logo-innsider">
            <div class="col-12 d-flex justify-content-center align-items-center p-4">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php endif; ?>
            </div>
        </div>
 
         <?php $codePromomats = get_field('description_complementary', $taxonomy) ?>
 
         <div class="container m-lg-5 mx-lg-auto m-3 px-0">
             <?php if(isset($codePromomats) && !empty($codePromomats)) : ?>
                 <h5 class="NotoSans-Bold title-color"><?= $codePromomats; ?></h5>
             <?php endif ?>
         </div>
 
 
     <?php endif ?>
 
 <?php endif; ?>