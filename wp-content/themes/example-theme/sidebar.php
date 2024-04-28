<div class="side-content-wrapper">
            <?php
                echo do_shortcode('[wpgmza id="1"]');
            ?>
    <div class="utility-content">
        <section class="contact">
            <h2>Contact T Products</h2>
            <p>If you have any questions about our products or services, please reach out to us using the information below or visit our About Us page to learn more and use our contact form.</p>
            <ul class="contact-info">
                <li><strong>Phone:</strong> +358 20 123 4567</li>
                <li><strong>Address:</strong> Esimerkkikatu 123, 00100 Helsinki, Finland</li>
                <li><strong>Email:</strong> info@tproducts.fi</li>
            </ul>
            <?php
            $products_page_id = 25;
            $products_page_url = get_permalink($products_page_id);
            ?>
            <a href="<?php echo esc_url($products_page_url); ?>" class="contact-button">Contact Us</a>
        </section>
    </div>
</div>

<h4 class="latest-products-header">Recently Added Products</h4>
<div class="latest-articles-container">
    <?php
    $args = array(
        'post_type' => 'post',
        'posts_per_page' => 5,
        'orderby' => 'date',
        'order' => 'DESC'
    );

    $latest_articles = new WP_Query($args);

    if ($latest_articles->have_posts()) :
        while ($latest_articles->have_posts()) : $latest_articles->the_post();
            // Start the anchor tag before the article content
            echo '<a href="' . get_permalink() . '" class="latest-article-link">';
            echo '<div class="latest-article">';
            if (has_post_thumbnail()) {
                echo '<div class="article-thumbnail">';
                the_post_thumbnail('medium');
                echo '</div>';
            }
            echo '<h2 class="article-title">' . get_the_title() . '</h2>';
            echo '</div>';
            // Close the anchor tag after the article content
            echo '</a>';
        endwhile;
    else :
        echo '<p>No recent articles found</p>';
    endif;

    wp_reset_postdata();
    ?>
</div>