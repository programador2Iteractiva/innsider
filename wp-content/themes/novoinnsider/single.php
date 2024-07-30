<?php
/**
 * Single template post.
 *
 */

get_header();
?>

<div class="container mx-auto px-0">
    <div class="container mt-4 mx-0 px-0 pb-4">
        <?php custom_breadcrumbs(); ?>
    </div>
</div>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : ?>
        <?php the_post(); ?>
        <?php $category = get_the_category(); ?>

        <div class="container-single-post" style="background: whitesmoke">

            <?php if ($category[0]->term_id == 10): ?>
                <div class="container-single-image">
                    <?= the_post_thumbnail('', ['class' => 'single-img']); ?>
                </div>
            <?php else: ?>

                <a href="#" onclick="saveLogsClick('<?php esc_html(the_title())?>', '<?= $category[0]->name?>'); openVideo('<?= get_field('video_post') ?>', event);">
                    <div class="container-single-image">
                        <?php the_post_thumbnail('', ['class' => 'single-img']); ?>
                    </div>
                </a>

            <?php endif; ?>
            <div>
                <h2 class="single-title"><?= the_title(); ?></h2>
            </div>
            <div class="container-single-text">
                <?= the_content(); ?>
            </div>
        </div>

    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
