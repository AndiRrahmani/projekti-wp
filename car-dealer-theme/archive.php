<?php
get_header(); ?>

<div class="archive-header">
    <h1 class="archive-title"><?php the_archive_title(); ?></h1>
    <div class="archive-description"><?php the_archive_description(); ?></div>
</div>

<div class="archive-content">
    <?php if (have_posts()) : ?>
        <div class="car-listings">
            <?php while (have_posts()) : the_post(); ?>
                <?php get_template_part('template-parts/content', 'car'); ?>
            <?php endwhile; ?>
        </div>

        <?php the_posts_navigation(); ?>
    <?php else : ?>
        <?php get_template_part('template-parts/content', 'none'); ?>
    <?php endif; ?>
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>