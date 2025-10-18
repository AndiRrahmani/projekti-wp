<div class="car-listing">
    <h2 class="car-title"><?php the_title(); ?></h2>
    <div class="car-image">
        <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail('medium'); ?>
        <?php endif; ?>
    </div>
    <div class="car-details">
        <p class="car-price"><?php echo get_post_meta(get_the_ID(), 'car_price', true); ?></p>
        <p class="car-year"><?php echo get_post_meta(get_the_ID(), 'car_year', true); ?></p>
        <p class="car-mileage"><?php echo get_post_meta(get_the_ID(), 'car_mileage', true); ?></p>
        <p class="car-description"><?php the_excerpt(); ?></p>
    </div>
    <a class="car-link" href="<?php the_permalink(); ?>">View Details</a>
</div>