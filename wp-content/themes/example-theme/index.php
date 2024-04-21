<?php
get_header();
?>


<section class="hero">
    <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <!-- Home Slide -->
            <div class="carousel-item active">
                <?php
                $products_page_id = 2;
                $products_page_url = get_permalink($products_page_id);
                ?>
                <a href="<?php echo esc_url($products_page_url); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/tiktok-logo-white.png" class="d-block w-100" alt="Home Slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Welcome to Our Site</h5>
                        <p>Discover our services and find out how we can help you achieve success.</p>
                    </div>
                </a>
            </div>

            <!-- Products Slide -->
            <div class="carousel-item">
                <?php
                $products_page_id = 33;
                $products_page_url = get_permalink($products_page_id);
                ?>
                <a href="<?php echo esc_url($products_page_url); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/tiktok-logo-white.png" class="d-block w-100" alt="Products Slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Explore Our Products</h5>
                        <p>Check out our latest products that can propel your business forward.</p>
                    </div>
                </a>
            </div>

            <!-- About Us Slide -->
            <div class="carousel-item">
                <?php
                $products_page_id = 25;
                $products_page_url = get_permalink($products_page_id);
                ?>
                <a href="<?php echo esc_url($products_page_url); ?>">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/tiktok-logo-white.png" class="d-block w-100" alt="Products Slide">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Learn More About Us</h5>
                        <p>Get to know our story, our values, and our commitment to quality.</p>
                    </div>
                </a>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="hero-text">
	    <?php
	    if ( have_posts() ) :
		    while ( have_posts() ) :
			    the_post();
			    // the_title('<h1>', '</h1>');
			    the_content();
		    endwhile;
	    else :
		    _e( 'Sorry, no posts matched your criteria.', 'esimerkki' );
	    endif;
	    ?>
    </div>

    <?php the_custom_header_markup(); ?>
    <!-- <img src="<?php echo get_stylesheet_directory_uri(); ?>/images/map.svg" alt="hero"> -->
</section>
<main>
    <section class="products">
        <h2>Featured Products</h2>
        <div>
        <?php
        $args = ['tag' => 'featured', 'posts_per_page' => 4];
        $products = new WP_Query($args);
        generate_article($products);
        ?>
        </div>
    </section>
</main>

<?php
get_sidebar();
get_footer();