<div class="sidebar">
    <h2>Car Listings</h2>
    <ul>
        <?php 
        if (is_active_sidebar('car-sidebar')) {
            dynamic_sidebar('car-sidebar');
        } else {
            echo '<li>No listings available.</li>';
        }
        ?>
    </ul>
</div>