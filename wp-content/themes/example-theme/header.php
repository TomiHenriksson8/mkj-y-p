<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div class="container">
    <nav class="navbar navbar-expand-lg navbar-custom-color">
        <div class="container-fluid">
            <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
                <?php
                if (function_exists('the_custom_logo')) {
                    the_custom_logo();
                } else {
                    bloginfo('name');
                }
                ?>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <?php
                if (class_exists('WP_Bootstrap_Navwalker')) {
                    wp_nav_menu(array(
                        'theme_location' => 'main-menu',
                        'depth' => 2,
                        'container' => false,
                        'menu_class' => 'navbar-nav ms-auto',
                        'fallback_cb' => 'WP_Bootstrap_Navwalker::fallback',
                        'walker' => new WP_Bootstrap_Navwalker(),
                    ));
                }
                ?>
            </div>
        </div>
    </nav>
    <section class="breadcrumbs">
        <?php if ( function_exists('bcn_display') ) {
            bcn_display();
        } ?>
    </section>