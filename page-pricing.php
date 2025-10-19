<?php
/*
Template Name: Pricing Page
*/
get_header();
?>

<main>
  <h1>Paketat e çmimeve</h1>
  <p style="color:var(--muted-2)">Zgjidhni një paketë që i përshtatet nevojave tuaja. Çmimet janë baza dhe mund të ndryshojnë sipas modelit dhe gjendjes së automjetit.</p>

  <?php $packages = function_exists( 'projekti_get_packages' ) ? projekti_get_packages() : array(); ?>
  <?php
  $item_slug = isset( $_GET['item'] ) ? sanitize_text_field( wp_unslash( $_GET['item'] ) ) : '';
  if ( $item_slug && function_exists( 'projekti_get_package_by_slug' ) ) {
      $package = projekti_get_package_by_slug( $item_slug );
      if ( $package ) {
          ?>
          <article class="card">
            <h1><?php echo esc_html( $package['title'] ); ?></h1>
            <p><?php echo esc_html( $package['description'] ); ?></p>
      <div style="margin-top:12px">Nga <span class="price">€<?php echo esc_html( $package['price'] ); ?></span></div>
            <p style="margin-top:12px;color:var(--muted-2)">Contact us to schedule this package or request a quote.</p>
          </article>
          <?php
          get_footer();
          return;
      }
  }
  <div class="services">
    <?php if ( ! empty( $packages ) ): ?>
      <?php foreach ( $packages as $p ): ?>
        <div class="card">
          <h3><?php echo esc_html( $p['title'] ); ?></h3>
          <p><?php echo esc_html( $p['description'] ); ?></p>
          <div>From <span class="price">$<?php echo esc_html( $p['price'] ); ?></span></div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

</main>

<?php get_footer();
