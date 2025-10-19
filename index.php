<?php
// Simple single-file front page for Projekti Car Repair theme
get_header();

// Get services and packages from centralized include (options or defaults)
$services = function_exists( 'projekti_get_services' ) ? projekti_get_services() : array();
$packages = function_exists( 'projekti_get_packages' ) ? projekti_get_packages() : array();

// Show a compact subset on the homepage and link to full pages
$services_preview = array_slice( $services, 0, 4 );
$packages_preview = array_slice( $packages, 0, 3 );
// page links if available
$services_page = get_page_by_path( 'services' );
$pricing_page = get_page_by_path( 'pricing' );
$services_link = $services_page ? get_permalink( $services_page ) : '#services';
$pricing_link = $pricing_page ? get_permalink( $pricing_page ) : '#pricing';

?>

  <section class="hero" role="region" aria-label="Introduction">
    <div class="left">
      <h1>Riparime Auto</h1>
      <p>Riparime të besueshme, çmime transparente dhe teknikë të certifikuar — ne ju mbajmë në rrugë në siguri.</p>
      <p style="margin-top:12px"><a class="cta" href="#contact">Rezervo takim</a></p>
    </div>
    <div class="right" aria-hidden="true">
      <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/car.svg' ); ?>" alt="Illustration of a car" style="width:320px;height:auto;display:block;min-height:120px">
    </div>
  </section>

  <h2 id="services">Sherbimet tona</h2>
  <div class="services" aria-label="Our services">
    <?php foreach( $services_preview as $s ):
        $slug = function_exists( 'projekti_make_slug' ) ? projekti_make_slug( $s['title'] ) : sanitize_title( $s['title'] );
        $detail_link = add_query_arg( 'item', $slug, $services_link );
    ?>
      <article class="card" itemscope itemtype="http://schema.org/Service">
        <h3 itemprop="name"><a href="<?php echo esc_url( $detail_link ); ?>"><?php echo esc_html( $s['title'] ); ?></a></h3>
        <p itemprop="description" style="color:var(--muted-2)"><?php echo esc_html( $s['description'] ); ?></p>
  <div style="margin-top:12px">Çmimi: <span class="price" itemprop="offers" itemscope itemtype="http://schema.org/Offer"><span itemprop="priceCurrency">EUR</span> <span itemprop="price">€<?php echo esc_html( $s['price'] ); ?></span></span></div>
      </article>
    <?php endforeach; ?>
  </div>

  <h2 id="pricing">Paketat e çmimeve</h2>
  <div class="services">
    <?php if ( ! empty( $packages_preview ) ): ?>
      <?php foreach ( $packages_preview as $p ):
        $pslug = function_exists( 'projekti_make_slug' ) ? projekti_make_slug( $p['title'] ) : sanitize_title( $p['title'] );
        $pdetail = add_query_arg( 'item', $pslug, $pricing_link );
      ?>
        <div class="card">
          <h3><a href="<?php echo esc_url( $pdetail ); ?>"><?php echo esc_html( $p['title'] ); ?></a></h3>
          <p><?php echo esc_html( $p['description'] ); ?></p>
          <div>Nga <span class="price">€<?php echo esc_html( $p['price'] ); ?></span></div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

  <h2 id="contact">Kontakt & Rezervime</h2>
  <div style="display:flex;gap:16px;flex-wrap:wrap;align-items:flex-start">
    <div class="card" style="flex:1;min-width:280px">
  <p>Telefononi ne <strong>(555) 012-345</strong> ose na vizitoni në 123 Repair Lane, Auto City.</p>
  <p>Hap: e Hënë - e Premte 08:00 - 18:00</p>
  <p style="color:var(--muted)">Shënim: Kjo temë nuk ruan të dhëna në bazën e të dhënave. Për të ndryshuar shërbimet ose çmimet, redaktoni <code>index.php</code> në dosjen e temës ose përdorni panelin e parametrave.</p>
    </div>

    <div class="card" style="flex:1;min-width:320px">
      <?php if ( isset( $_GET['projekti_contact'] ) && 'success' === $_GET['projekti_contact'] ): ?>
        <div style="padding:12px;background:#ecfdf5;border:1px solid #bbf7d0;color:#064e3b;border-radius:6px;margin-bottom:12px">Thanks — your message was sent successfully.</div>
      <?php elseif ( isset( $_GET['projekti_contact'] ) && 'fail' === $_GET['projekti_contact'] ): ?>
        <div style="padding:12px;background:#fff7f0;border:1px solid #ffd8b5;color:#7c2d12;border-radius:6px;margin-bottom:12px">Sorry — we couldn't send your message. Please try again or call us.</div>
      <?php endif; ?>

      <form method="post" action="<?php echo esc_url( home_url( '/' ) ); ?>">
        <?php wp_nonce_field( 'projekti_contact', 'projekti_contact_nonce' ); ?>
  <label for="name">Emri</label><br>
        <input id="name" name="name" type="text" style="width:100%;padding:8px;margin:6px 0;border-radius:6px;border:1px solid #e6eef7" required>

  <label for="email">Email</label><br>
        <input id="email" name="email" type="email" style="width:100%;padding:8px;margin:6px 0;border-radius:6px;border:1px solid #e6eef7" required>

  <label for="message">Mesazhi</label><br>
        <textarea id="message" name="message" rows="4" style="width:100%;padding:8px;margin:6px 0;border-radius:6px;border:1px solid #e6eef7" required></textarea>

        <div style="text-align:right;margin-top:8px">
          <button type="submit" class="cta">Dërgo mesazh</button>
        </div>
      </form>
    </div>

    <div style="width:100%;display:flex;justify-content:center;margin-top:12px">
      <!-- sample image loaded from theme assets -->
      <img src="<?php echo esc_url( get_stylesheet_directory_uri() . '/assets/car.svg' ); ?>" alt="car" style="width:320px;max-width:100%;height:auto;">
    </div>
  </div>

<?php
get_footer();
