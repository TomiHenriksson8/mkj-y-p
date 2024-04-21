<?php
function generate_article( $products ): void {
    if ( $products->have_posts() ) :
		while ( $products->have_posts() ) :
			$products->the_post();
			?>

            <article class="product">
                <a class="product-link" href="<?php the_permalink(); ?>">
                <?php
                the_post_thumbnail( 'thumbnail' );
                the_title( '<h3>', '</h3>' );
                $excerpt = get_the_excerpt();
                ?>
                <p>
                    <?php
                    echo substr( $excerpt, 0, 100 );
                    ?>...
                </p>
                <div class="modal-button-wrapper">
                    <button type="button" class="btn btn-primary">
                        <a href="#" class="open-modal" data-id="<?php echo get_the_ID(); ?>">Open in modal</a>
                    </button>
                </div>
                </a>
            </article>

		<?php
		endwhile;
	else :
		_e( 'Sorry, no posts matched your criteria.', 'esimerkki' );
	endif;
}