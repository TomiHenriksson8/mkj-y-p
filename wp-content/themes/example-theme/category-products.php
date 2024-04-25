<?php
global $wp_query;
get_header();
?>

    <section class="products-hero">
        <div class="hero-text">
            <?php
            echo '<h1>' . single_cat_title('', false) . '</h1>';
            echo '<p>' . category_description() . '</p>';
            ?>
        </div>
        <img class="random-product-img" src="<?php echo get_random_post_image(get_queried_object_id()); ?>" alt="hero">
    </section>
    <main>
        <div class="product-text-container">
            <p class="product-text">Discover the Perfect Find! Browse our exclusive collection and select from the finest products curated just for you. Elevate your lifestyle with our exceptional range, where quality meets desire. Start your journey with us today!</p>
        </div>



        <div class="category-filter">

            <select id="categoryFilter" name="category_filter">
                <option value="all">All Categories</option>
                <?php
                $subcategories = get_categories([
                    'child_of' => get_queried_object_id(),
                    'hide_empty' => true,
                ]);
                foreach ($subcategories as $subcategory) {
                    echo '<option value="' . $subcategory->slug . '">' . $subcategory->name . '</option>';
                }
                ?>
            </select>
        </div>


        <section class="products-page-products">
            <?php
            foreach ($subcategories as $subcategory):
                echo '<h2>' . $subcategory->name . '</h2>';

                // Add data-category attribute for filtering
                echo '<div class="products-container" data-category="' . $subcategory->slug . '">';

                $args = [
                    'post_type' => 'post',
                    'cat' => $subcategory->term_id,
                    'posts_per_page' => 3,
                ];

                $products = new WP_Query($args);
                generate_article($products);
                echo '</div>';
                ?>
                <div class="view-all-container">
                    <a href="<?php echo get_category_link($subcategory->term_id); ?>" class="view-all-button">View all</a>
                </div>
                <?php
                wp_reset_postdata();
            endforeach;
            ?>
        </section>
    </main>

<?php
get_footer();