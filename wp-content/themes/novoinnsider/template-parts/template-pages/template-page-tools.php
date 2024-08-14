<?php

/**
 * Template for page Tools
 */
$category = get_queried_object();
$content = get_the_content();
?>


<?php if ( have_rows( 'Content_Page_Tools', $category) ) : ?>

    <?php while (have_rows('Content_Page_Tools', $category)) : the_row() ?>

        <div>
            <div class="container my-5 mb-0">
                <div class="row d-flex justify-content-center align-align-items-center mb-4">
                    <div class="col-12 d-flex flex-lg-row">

                        <?php $titlePageTools = get_sub_field('Title_Page_Tools') ?>
                        <?php if ( isset($titlePageTools) && !empty($titlePageTools)) : ?>
                            <h2 class="NotoSans-Bold title-color mb-3"><?= strip_tags($titlePageTools); ?></h2>
                        <?php endif; ?>                        
                        
                        <div class="col-9 mx-1" id="linea">
                            <hr class="mx-3 px-4">
                        </div>
                    </div>
                    <p><?= strip_tags($content); ?></p>
                </div>
            </div>
            <div class="container banner-academy">

                <?php $urlPageTools = get_sub_field('Url_Page_Tools') ?>
                <?php if (isset($urlPageTools) && !empty($urlPageTools))  : ?>

                    <a href="<?= $urlPageTools; ?>" target="_blank" style="text-decoration: none !important;">
                        <?php $bannerPageTools = get_sub_field('Banner_Page_Tools') ?>
                        <?php if ( isset($bannerPageTools) && !empty($bannerPageTools)) : ?>
                            <img class="bg-banner-academy" src="<?php echo wp_get_attachment_image_url($bannerPageTools, 'full', ''); ?>" alt="">
                        <?php endif; ?>
                            
                        <div class="wrapper-banner-academy">
                            <div class="container-text-banner-academy">
                                <?php $titlePageTools = get_sub_field('Title_Page_Tools') ?>
                                <?php if ( isset($titlePageTools) && !empty($titlePageTools)) : ?>
                                    <p>
                                        <?= strip_tags($titlePageTools); ?>
                                    </p>
                                <?php endif; ?>  
                            </div>
                        </div>
                    </a>

                <?php else : ?>

                    <?php $bannerPageTools = get_sub_field('Banner_Page_Tools') ?>
                    <?php if ( isset($bannerPageTools) && !empty($bannerPageTools)) : ?>
                        <img class="bg-banner-academy" src="<?php echo wp_get_attachment_image_url($bannerPageTools, 'full', ''); ?>" alt="">
                    <?php endif; ?>
                        
                    <div class="wrapper-banner-academy">
                        <div class="container-text-banner-academy">
                            <?php $titlePageTools = get_sub_field('Title_Page_Tools') ?>
                            <?php if ( isset($titlePageTools) && !empty($titlePageTools)) : ?>
                                <p>
                                    <?= strip_tags($titlePageTools); ?>
                                </p>
                            <?php endif; ?>  
                        </div>
                    </div>

                <?php endif; ?>

            </div>
        </div>

    <?php endwhile; ?>

<?php endif; ?>

