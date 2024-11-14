<?php

/**
 * Template for page Trends
 */
$content = get_the_content();
?>

<div>
    <div class="container mx-2 mx-lg-auto px-0 ">
        <div class="container mt-lg-5 mb-lg-5 mt-4 mb-4 mx-0 px-0">
            <nav class="breadcrumbs">
                <a style="text-decoration:none !important" href="<?php echo $pageHome; ?>">
                    Inicio
                </a>
                /
                <a style="text-decoration:none !important" href="<?php echo $page_url; ?>">
                    <?php the_title(); ?>
                </a>
            </nav>
        </div>
    </div>
    <div class="container banner-academy" data-aos="zoom-in">
        <?php the_post_thumbnail('', ['class' => 'bg-banner-academy']) ?>
        <div class="wrapper-banner-academy"></div>
    </div>

    <?php /* New code for this section */ ?>

    <?php $listPostTools = new WP_Query( array('post_type' => 'herramientas', 'posts_per_page' => -1, 'order' => 'ASC')); ?>

    <?php if( isset($listPostTools) && !empty($listPostTools)) : ?>

        <?php if($listPostTools->have_posts()) : ?>

            <?php $totalPost = $listPostTools->found_posts; ?>

            <?php if(isset($totalPost) && !empty($totalPost) && $totalPost == 1) : ?>

                <div class="container align-items-center mt-5 pt-1">
                    <div class="row d-flex justify-content-start align-items-center m-0 mt-4 p-0">
            <?php else : ?>
                
                <div class="container mt-5 pt-1">
                    <div class="row d-flex justify-content-between align-items-start m-0 p-0">
                        
            <?php endif; ?>

                    <?php while($listPostTools->have_posts()) : $listPostTools->the_post() ?>

                        <?php $postId = get_the_ID(); ?>
                        <?php $contentRegister = get_post_meta($postId, 'Content_Register', true); ?>
                        <?php $imgPostTools = get_field('Img_Post_Tools'); ?>
                        <?php $titlePostTools = get_the_title(); ?>
                        <?php $thePermalink = get_the_permalink(); ?>

                        <?php if($Content_Register === '1') : ?> 

                            <?php if(!is_user_logged_in()) : ?>

                                <?php $login_url = wp_login_url($thePermalink); ?>
                                <?php $link = $login_url; ?>

                            <?php else : ?> 

                                <?php $link = $thePermalink; ?>

                            <?php endif ?>

                        <?php else : ?>    

                            <?php $link = $thePermalink; ?>

                        <?php endif; ?>                       
                        
                        <div class="col-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-xxxl-6 d-flex flex-column justify-content-center align-items-center card-category-academy m-0 p-0 mt-3 mb-3 pb-3 ">
                            <a href="<?= $link; ?>" onclick="saveLogsClick('Clic en herramienta `<?= $titlePostTools ?>`');"  class="w-100">
                                <div class="<?= ($counter % 2 === 0) ? 'd-flex justify-content-center align-items-lg-start align-items-center flex-column' : 'd-flex justify-content-center align-items-lg-end align-items-center flex-column'; ?>">
                                    <div class="col-10 col-lg-11">
                                        <div class="mb-4 figure">

                                            <?php if(isset($imgPostTools) && !empty($imgPostTools)) : ?>
                                                <?php echo wp_get_attachment_image($imgPostTools, 'full', '', ['style' => 'object-fit: fill', 'class' => '']); ?>
                                            <?php endif; ?>  
                                        </div>
                                        <div class="col-12 d-flex w-100">
                                            <div class="col-12 d-flex">
                                                <div class="col h-100">
                                                    <div class="d-flex justify-content-start align-items-start flex-column">
                                                        <h4 class="NotoSans-Bold title-color"><?= $titlePostTools; ?></h4>
                                                    </div>
                                                </div>
                                                <div class="col d-flex justify-content-center align-items-start">
                                                    <div class="w-75">
                                                        <div class="w-100 p-2 mb-2 btn-view-more">Ver más</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>

                    <?php endwhile; ?>
                    </div>
                </div>  
        <?php endif; ?>

    <?php endif; ?>
    
    <?php /* End New code for this section */ ?>



