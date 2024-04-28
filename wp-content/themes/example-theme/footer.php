<footer>
    <div class="footer-content">
        <p>&copy; 2024 TOMI</p>
        <nav class="footer-nav">
            <ul>
                <?php
                $products_page_id = 2;
                $products_page_url = get_permalink($products_page_id);
                ?>
                <a href="<?php echo esc_url($products_page_url); ?>">Home</a>
                <?php
                $category_id = get_cat_ID('Products');
                $category_link = get_category_link($category_id);
                ?>
                <a href="<?php echo esc_url($category_link); ?>">Products</a>
                <?php
                $products_page_id = 25;
                $products_page_url = get_permalink($products_page_id);
                ?>
                <a href="<?php echo esc_url($products_page_url); ?>">About Us</a>
                <li><a href="/privacy">Privacy Policy</a></li>
                <li><a href="/terms">Terms of Service</a></li>
            </ul>
        </nav>
        <div class="footer-social">
            <a href="https://twitter.com/TOMI">Twitter</a>
            <a href="https://facebook.com/TOMI">Facebook</a>
        </div>
    </div>
</footer>

<dialog id="single-post">
    <button id="close">Close</button>
    <article class="single" id="modal-content"></article>
</dialog>

<?php wp_footer(); ?>
</body>
</html>