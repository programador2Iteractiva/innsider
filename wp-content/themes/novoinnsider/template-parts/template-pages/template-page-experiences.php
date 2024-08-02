<?php

/**
 * Template for page Experiences
 */
$category = get_queried_object();
$content = get_the_content();
?>

<div class="container my-5 mb-0">
    <div class="row d-flex justify-content-center align-align-items-center mb-4">
        <div class="col-12 d-flex flex-lg-row">
            <h1 class="NotoSans-Bold"><?= strip_tags(the_title()); ?></h1>
            <div class="col-10 mx-1" id="linea">
                <hr class="mx-5 px-4">
            </div>
        </div>
        <p><?= strip_tags($content); ?></p>
    </div>
</div>

<div class="container mt-lg-3 mt-3 px-5">
    <div class="background-taxonomy pt-0 pb-0 px-4">
        <div class="container banner-academy">
            <?php the_post_thumbnail('', ['class' => 'bg-banner-academy']) ?>
            <div class="wrapper-banner-academy">
                <div class="container-text-banner-academy">
                    <p class="text-transform-uppercase">
                        <?php the_title(); ?>
                    </p>
                </div>
                <h4 class="text-white mt-3"><?php the_content(); ?></h4>
                <div class="container-text-banner-academy w-100 h-100 m-auto d-flex justify-content-lg-start align-items-center">
                    <img src="<?= get_template_directory_uri() . '/assets/images/Icono-innsider-white.png'; ?>" alt="Herramientas" class="bg-banner-single-category">
                </div>
            </div>
        </div>
        <div class="container mt-4">
            <div class="row m-0 p-0">
                <h1 class="NotoSans-Bold title-color mb-3 text-uppercase">What is Lorem Ipsum?</h1>
            
                <p class="NotoSans-SemiBold description-color line-height-2 text-align-justify mb-lg-5 mb-2">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type.</p>
            </div>
        </div>
    </div>
</div>

