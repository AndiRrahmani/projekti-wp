<?php
<?php
// ...existing code...
if ( ! defined( 'ABSPATH' ) ) exit;
global $post;
$price = cdt_price( $post->ID );
$year  = get_post_meta( $post->ID, 'year', true );
$mileage = get_post_meta( $post->ID, 'mileage', true );
?>
<article class="car-listing" id="post-<?php the_ID(); ?>">
    <a href="<?php the_permalink(); ?>" class="car-media">
        <?php if ( has_post_thumbnail() ) {
            the_post_thumbnail( 'car-thumb' );
        } else { ?>
            <div class="placeholder">No image</div>
        <?php } ?>
    </a>
    <div class="car-info">
        <h3 class="car-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <div class="car-sub"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 18 ) ); ?></div>
        <div class="car-meta">
            <span class="badge"><?php echo esc_html( $year ); ?></span>
            <?php if ( $mileage ) : ?><span class="text-muted"><?php echo esc_html( $mileage ); ?></span><?php endif; ?>
        </div>
        <div class="car-bottom">
            <div class="car-price"><?php echo $price ? '&euro; ' . $price : 'Contact' ; ?></div>
            <a class="btn btn-primary" href="<?php the_permalink(); ?>"><?php _e( 'View', 'car-dealer-pro' ); ?></a>
        </div>
    </div>
</article>