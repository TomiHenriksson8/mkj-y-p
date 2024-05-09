<?php
get_header();
?>
<main class="full-width">
    <section class="products">
        <article class="single">
            <?php
            if ( have_posts() ) :
                while ( have_posts() ) :
                    the_post();
                    the_title( '<h1>', '</h1>' );
                    the_content();

                    // Fetch and display the price from the custom field
                    $price = get_post_meta(get_the_ID(), 'price', true);
                    if (!empty($price)) {
                        echo '<p>Price: $' . esc_html($price) . '</p>';
                    }

                    // Add to Cart form
                    echo '<form action="" method="post">';
                    echo '<input type="hidden" name="product_id" value="' . get_the_ID() . '">';
                    echo '<input type="hidden" name="product_price" value="' . esc_attr($price) . '">';
                    echo '<input type="submit" name="add_to_cart" value="Add to Cart">';
                    echo '</form>';

                endwhile;
            else :
                _e('Sorry, no posts matched your criteria.', 'esimerkki');
            endif;
            ?>
            <?php echo do_shortcode('[like_button]'); ?>
        </article>
    </section>
</main>

<?php
get_footer();
?>
