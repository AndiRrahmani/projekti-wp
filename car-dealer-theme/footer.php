<?php
// Footer section of the car dealer theme
?>

<footer>
    <div class="footer-content">
        <p>&copy; <?php echo date("Y"); ?> Car Dealer. All rights reserved.</p>
        <nav>
            <ul>
                <li><a href="<?php echo esc_url(home_url('/')); ?>">Home</a></li>
                <li><a href="<?php echo esc_url(home_url('/about')); ?>">About Us</a></li>
                <li><a href="<?php echo esc_url(home_url('/contact')); ?>">Contact</a></li>
                <li><a href="<?php echo esc_url(home_url('/privacy-policy')); ?>">Privacy Policy</a></li>
            </ul>
        </nav>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>