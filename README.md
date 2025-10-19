# Projekti Car Repair Theme

This is a minimal WordPress theme for a car repair shop. It is intentionally simple and uses only PHP and CSS. No database storage is used for services or pricing — these are hardcoded in the theme files.

Files of interest:
- `style.css` — theme metadata and CSS styles.
- `index.php` — main page. Contains hardcoded `$services` array and pricing packages. Edit this file to change services or prices.
- `header.php`, `footer.php` — basic header and footer markup.
- `functions.php` — enqueues the stylesheet and sets minimal theme support.

How to install:
1. Place the `projekti-wp` folder inside `wp-content/themes/` (already located here).
2. In the WordPress admin, go to Appearance → Themes and activate "Projekti Car Repair".
3. Visit the site front page to see the theme.

Customization:
- To change services or prices, open `index.php` and modify the `$services` array or pricing cards.
- You can safely add images to the theme folder and update the `<img>` tag in `index.php`.

Notes:
- This theme is intended for demo or static sites. For a production site, integrate WordPress customizer or create proper templates and use the database for dynamic content.

Contact form and assets:
- The included contact form sends email using WordPress's `wp_mail` to the site admin email (set under Administration → Settings → General). No data is stored in the database.
- A sample SVG is available at `assets/car.svg`. Replace it with your own image files if you wish.

# projekti-wp

Professional polish:

- The theme now includes improved typography, spacing, card shadows, and responsive layout for a modern look.
- Support for a custom logo and a primary navigation menu has been added. Assign a menu in Appearance → Menus and set a logo in Appearance → Customize → Site Identity.
- Basic schema.org markup (LocalBusiness, Service) has been added to improve semantic structure.

Creating separate Services & Pricing pages:

- Two page templates are provided: `page-services.php` and `page-pricing.php`.
- To create separate pages in WordPress: go to Pages → Add New, title the page "Services" (or "Pricing"), and on the right under "Template" choose the corresponding template. Publish the page. The theme will link to these pages from the header/footer automatically (if the slug is `services` or `pricing`).

Footer & contact:
- The footer now contains columns for contact info, opening hours, quick links, and social links. Edit `footer.php` to update the displayed email address or social URLs.

Redaktimi i shërbimeve dhe paketave përmes panelit:

- Një faqe parametrash tani është e disponueshme nën Pamja → Parametrat Projekti.
- Përdorni këtë faqe për të shtuar, hequr ose redaktuar shërbimet dhe paketat e çmimeve. Klikoni "Ruaj ndryshimet" për t'i ruajtur. Ndryshimet ruhen në opsionet e WordPress dhe do të përdoren nga shabllonet e temës.
- UI e panelit mbështet shtimin/heqjen e rreshtave dhe përfshin nonce dhe kontrolle të të drejtave për siguri.

