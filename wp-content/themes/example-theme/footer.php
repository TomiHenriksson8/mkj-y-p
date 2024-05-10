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

<div class="modal fade" id="cartModal" tabindex="-1" aria-labelledby="cartModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cartModalLabel">Shopping Cart</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php display_cart_contents();?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <?php if (!empty($_SESSION['cart']) && array_sum(array_column($_SESSION['cart'], 'quantity')) > 0): ?>
                    <a href="<?php echo esc_url(home_url('/thank-you?action=clear_cart')); ?>" class="btn btn-primary">Proceed to Checkout</a>

                <?php else: ?>
                    <button class="btn btn-primary" disabled>Proceed to Checkout</button>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>