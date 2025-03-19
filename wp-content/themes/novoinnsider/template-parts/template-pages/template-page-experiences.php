<?php

/**
 * Template for page Experiences
 */
$page_id = get_queried_object_id();
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
    
    <?php $bannerPage = get_field('Page_Image_Banner', $page_id); ?>
    <?php $bannerPageMovil = get_field('Page_Image_Banner_Movil', $page_id); ?>

    <div class="container banner-academy d-none d-lg-block" data-aos="zoom-in">
        <?php if (isset($bannerPage) && !empty($bannerPage)) : ?>
            <img src="<?= esc_url(wp_get_attachment_url($bannerPage)); ?>" alt="Banner-Academy" class="bg-banner-academy">
        <?php endif ?>
        <div class="wrapper-banner-academy">
        </div>
    </div>

    <div class="container banner-academy d-block d-lg-none" data-aos="zoom-in">
        <?php if (isset($bannerPageMovil) && !empty($bannerPageMovil)) : ?>
            <img src="<?= esc_url(wp_get_attachment_url($bannerPageMovil)); ?>" alt="Banner-Academy" class="bg-banner-academy">
        <?php endif ?>
        <div class="wrapper-banner-academy">
        </div>
    </div>

    <?php /* New code for this new page Experience */ ?>

    <?php $listPostTools = new WP_Query(array('post_type' => 'experiences', 'posts_per_page' => -1, 'order' => 'ASC', 'orderby' => 'id')); ?>

    <?php if (isset($listPostTools) && !empty($listPostTools)) : ?>

        <?php if ($listPostTools->have_posts()) : ?>

            <?php $totalPost = $listPostTools->found_posts; ?>

            <?php if (isset($totalPost) && !empty($totalPost) && $totalPost == 1) : ?>

                <div class="container align-items-center mt-5 pt-1">
                    <div class="row d-flex justify-content-start align-items-center m-0 mt-4 p-0">
                    <?php else : ?>

                        <div class="container mt-5 pt-1">
                            <div class="row d-flex justify-content-between align-items-start m-0 p-0">

                            <?php endif; ?>

                            <?php while ($listPostTools->have_posts()) : $listPostTools->the_post() ?>

                                <?php $postId = get_the_ID(); ?>
                                <?php $contentRegister = get_post_meta($postId, 'Content_Register', true); ?>
                                <?php $imgPostTools = get_the_post_thumbnail_url(); ?>
                                <?php $titlePostTools = get_the_title(); ?>
                                <?php $thePermalink = get_the_permalink(); ?>

                                <?php if ($contentRegister === '1') : ?>

                                    <?php if (!is_user_logged_in()) : ?>

                                        <?php $login_url = wp_login_url($thePermalink); ?>
                                        <?php $link = $login_url; ?>

                                    <?php else : ?>

                                        <?php $link = $thePermalink; ?>

                                    <?php endif ?>

                                <?php else : ?>

                                    <?php $link = $thePermalink; ?>

                                <?php endif; ?>

                                <div class="col-12 col-md-6 col-lg-6 col-xl-6 col-xxl-6 col-xxxl-6 d-flex flex-column justify-content-center align-items-center card-category-academy m-0 p-0 mt-3 mb-3 pb-3 "> <a href="<?= $link; ?>" onclick="saveLogsClick('Clic en experiencias `<?= $titlePostTools ?>`');" class="w-100">
                                        <div class="<?= ($counter % 2 === 0) ? 'd-flex justify-content-center align-items-lg-start align-items-center flex-column' : 'd-flex justify-content-center align-items-lg-end align-items-center flex-column'; ?>">
                                            <div class="col-10 col-lg-11">
                                                <div class="mb-4 figure">

                                                    <?php if (isset($imgPostTools) && !empty($imgPostTools)) : ?>
                                                        <img class="bg-banner-academy" style="object-fit: fill;" src="<?= $imgPostTools; ?>" />
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

                <div class="container m-lg-3 mx-lg-auto m-3 px-0">
                    <h5 class="NotoSans-Bold title-color mx-2">
                        <?php $codePromomats = get_field('code_promomats', $pageid); ?>
                        <p><?= $codePromomats ?></p>
                    </h5>
                </div>

                <?php /* End New code for new page Experience */ ?>