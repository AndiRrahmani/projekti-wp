<?php
get_header(); ?>

<div class="search-results">
    <h1><?php printf( esc_html__( 'Search Results for: %s', 'car-dealer-theme' ), '<span>' . get_search_query() . '</span>' ); ?></h1>

    <?php if ( have_posts() ) : ?>
        <div class="search-results-list">
            <?php while ( have_posts() ) : the_post(); ?>
                <?php get_template_part( 'template-parts/content', 'car' ); ?>
            <?php endwhile; ?>
        </div>

        <?php the_posts_navigation(); ?>
    <?php else : ?>
        <?php get_template_part( 'template-parts/content', 'none' ); ?>
    <?php endif; ?>
</div>

<?php
get_sidebar();
get_footer();