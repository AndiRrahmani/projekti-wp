<?php
// This file contains the markup for displaying a list of car listings.

if ( have_posts() ) :
    while ( have_posts() ) : the_post(); ?>
        <div class="car-listing">
            <h2 class="car-title"><?php the_title(); ?></h2>
            <div class="car-excerpt"><?php the_excerpt(); ?></div>
            <a href="<?php the_permalink(); ?>" class="car-link">View Details</a>
        </div>
    <?php endwhile;
else : 
    get_template_part( 'template-parts/content', 'none' );
endif;
?>