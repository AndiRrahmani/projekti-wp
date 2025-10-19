<?php
<?php
// ...existing code...
?>
<footer class="footer">
    <div class="container">
        <nav><?php wp_nav_menu( array( 'theme_location' => 'footer', 'container' => false ) ); ?></nav>
        <p>&copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?></p>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>