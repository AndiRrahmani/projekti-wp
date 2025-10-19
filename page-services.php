<?php
/*
Template Name: Services Page
*/
get_header();

// get services from centralized include
$services = function_exists( 'projekti_get_services' ) ? projekti_get_services() : array();
// if item query provided, show detail
$item_slug = isset( $_GET['item'] ) ? sanitize_text_field( wp_unslash( $_GET['item'] ) ) : '';
if ( $item_slug && function_exists( 'projekti_get_service_by_slug' ) ) {
    $service = projekti_get_service_by_slug( $item_slug );
    if ( $service ) {
        ?>
        <article class="card">
          <h1><?php echo esc_html( $service['title'] ); ?></h1>
          <p style="color:var(--muted-2)"><?php echo esc_html( $service['description'] ); ?></p>
    <div style="margin-top:12px">Çmimi: <span class="price">€<?php echo esc_html( $service['price'] ); ?></span></div>
          <p style="margin-top:12px;color:var(--muted-2)">For more information, call us or use the contact form.</p>
        </article>
        <?php
        get_footer();
        return;
    }
}
?>

<main>
  <h1>Sherbimet tona</h1>
  <p style="color:var(--muted-2)">Ne ofrojmë një gamë të gjerë shërbimesh profesionale për automjetin tuaj. Më poshtë janë shërbimet tona më të njohura.</p>
  <div class="services">
    <?php if ( ! empty( $services ) ): ?>
      <?php foreach ( $services as $s ): ?>
        <article class="card">
          <h3><?php echo esc_html( $s['title'] ); ?></h3>
          <p style="color:var(--muted-2)"><?php echo esc_html( $s['description'] ); ?></p>
          <div style="margin-top:12px">Starting from <span class="price">$<?php echo esc_html( $s['price'] ); ?></span></div>
        </article>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>
</main>

<?php get_footer();
