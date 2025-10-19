    <footer class="footer" role="contentinfo">
  <div class="footer-grid">
        <div class="footer-col" itemprop="address" itemscope itemtype="http://schema.org/PostalAddress">
          <div style="font-weight:700">Projekti Riparime Auto</div>
          <div class="muted">Shërbim cilësor që nga 2025</div>
          <div style="margin-top:8px"><span itemprop="streetAddress">123 Repair Lane</span>, <span itemprop="addressLocality">Auto City</span></div>
          <div style="margin-top:6px">Tel: <a href="tel:+1555012345" itemprop="telephone">(555) 012-345</a></div>
        </div>

        <div class="footer-col">
          <div style="font-weight:700">Opening Hours</div>
          <div class="muted">Mon-Fri: 08:00 — 18:00</div>
          <div class="muted">Sat: 09:00 — 14:00</div>
          <div class="muted">Sun: Closed</div>
        </div>

        <div class="footer-col">
          <div style="font-weight:700">Quick Links</div>
          <ul class="footer-links">
            <?php
            // dynamically list top-level pages as a simple sitemap
            $pages = get_pages( array( 'sort_column' => 'menu_order', 'post_status' => 'publish' ) );
            foreach ( $pages as $pg ) {
                $link = get_permalink( $pg );
                echo '<li><a href="' . esc_url( $link ) . '">' . esc_html( get_the_title( $pg ) ) . '</a></li>';
            }
            ?>
          </ul>
        </div>

        <div class="footer-col">
          <div style="font-weight:700">Stay in Touch</div>
          <div class="muted">Email us for bookings and enquiries.</div>
          <div style="margin-top:8px"><a href="mailto:info@example.com">info@example.com</a></div>
          <div style="margin-top:12px">
            <a class="social" href="#" aria-label="Facebook" title="Facebook">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M22 12.07C22 6.48 17.52 2 11.93 2S2 6.48 2 12.07C2 17.09 5.66 21.19 10.44 22v-6.99H7.9v-2.94h2.54V9.41c0-2.5 1.49-3.88 3.77-3.88 1.09 0 2.24.2 2.24.2v2.46h-1.26c-1.24 0-1.63.77-1.63 1.56v1.88h2.78l-.44 2.94h-2.34V22C18.34 21.19 22 17.09 22 12.07Z"/></svg>
            </a>
            <a class="social" href="#" aria-label="Instagram" title="Instagram">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path d="M7 2C4.24 2 2 4.24 2 7v10c0 2.76 2.24 5 5 5h10c2.76 0 5-2.24 5-5V7c0-2.76-2.24-5-5-5H7Zm10 3.5a1.2 1.2 0 1 1 0 2.4 1.2 1.2 0 0 1 0-2.4ZM12 7.5a4.5 4.5 0 1 1 0 9 4.5 4.5 0 0 1 0-9Zm0 2a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5Z"/></svg>
            </a>
          </div>

          <form action="mailto:info@example.com" method="get" style="margin-top:12px">
            <label for="newsletter_email" style="display:block;font-size:13px">Newsletter</label>
            <input id="newsletter_email" name="to" type="email" placeholder="you@example.com" style="width:100%;padding:8px;margin-top:6px;border-radius:6px;border:1px solid rgba(15,23,42,0.06)">
            <div style="margin-top:8px"><button class="cta" type="submit">Subscribe</button></div>
          </form>
        </div>
      </div>

      <div style="margin-top:16px;color:var(--muted-2);font-size:13px;display:flex;justify-content:space-between;align-items:center">
        <div>Bërë me kujdes — redaktoni temën në <code>index.php</code> për të ndryshuar shërbimet dhe çmimet.</div>
        <div><a href="#top" class="muted">Kthehu sipër ↑</a></div>
      </div>
    </footer>

    <script>
    (function(){
      var menuToggle = document.querySelector('.menu-toggle');
      var menu = document.getElementById('projekti-menu');
      var searchToggle = document.querySelector('.search-toggle');
      var search = document.getElementById('projekti-search');

      if ( menuToggle && menu ) {
        menuToggle.addEventListener('click', function(){
          var open = menu.classList.toggle('open');
          menuToggle.setAttribute('aria-expanded', open);
        });
      }
      if ( searchToggle && search ) {
        searchToggle.addEventListener('click', function(){
          var visible = search.hasAttribute('hidden');
          if ( visible ) {
            search.removeAttribute('hidden');
            searchToggle.setAttribute('aria-expanded', true);
          } else {
            search.setAttribute('hidden', '');
            searchToggle.setAttribute('aria-expanded', false);
          }
        });
      }

      // smooth scroll for back to top
      var back = document.querySelector('a[href="#top"]');
      if ( back ) {
        back.addEventListener('click', function(e){
          e.preventDefault();
          window.scrollTo({ top: 0, behavior: 'smooth' });
        });
      }
    })();
    </script>
  </div>
  <?php wp_footer(); ?>
</body>
</html>
