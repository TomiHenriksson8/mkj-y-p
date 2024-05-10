<?php
function generate_article($products): void {
    if ($products->have_posts()) :
        while ($products->have_posts()) :
            $products->the_post();
            $product_id = get_the_ID(); // Get the current product/post ID
            $price = get_post_meta($product_id, 'price', true); // Fetch the price from the custom field
            ?>

            <article class="product">
                <a class="product-link" href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('thumbnail'); ?>
                    <?php the_title('<h3>', '</h3>'); ?>
                    <p><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p> <!-- Better handling of excerpt -->
                    <?php if (!empty($price)): ?>
                        <p class="product-price">Price: $<?php echo esc_html($price); ?></p>
                    <?php endif; ?>
                </a>
                <div class="modal-button-wrapper">
                    <button type="button" class="btn btn-primary open-modal" data-id="<?php echo $product_id; ?>">Open in modal</button>
                </div>
            </article>

        <?php
        endwhile;
    else :
        echo '<p>Sorry, no posts matched your criteria.</p>';
    endif;

    wp_reset_postdata(); // Always reset the post data to avoid conflicts with global post variables
}

