<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package spavalais
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <?php wp_head(); ?>

    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link href="https://fonts.googleapis.com/css?family=Barlow|Catamaran|Gentium+Book+Basic|Hind|Ropa+Sans|Titillium+Web" rel="stylesheet">
</head>

<body <?php body_class(); ?>>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'spavalais'); ?></a>

    <header id="masthead" class="site-header">
        <div class="inner inner-top">

            <nav id="site-navigation" class="main-navigation">

                <button class="floating-top-menu-toggle menu-toggle"
                        data-menu-id="primary-menu" aria-controls="primary-menu"
                        aria-expanded="false"><i class="fas fa-bars"></i></button>

                <?php
                wp_nav_menu(array(
                    'theme_location' => 'menu-1',
                    'menu_id' => 'primary-menu',
                    'menu_class' => 'floating-top-menu'
                ));
                ?>
            </nav><!-- #site-navigation -->
        </div>
        <?php dallinge_slides() ?>

        <div class="inner inner-bottom">
            <?php the_custom_logo(); ?>

            <?php if (is_front_page() && is_home()) : ?>
                <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
                                          rel="home"><?php bloginfo('name'); ?></a></h1>
            <?php else : ?>
                <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
                                         rel="home"><?php bloginfo('name'); ?></a></p>
            <?php endif; ?>

            <?php get_search_form(true) ?>

        </div>

        <div id="red-banner">
            <div class="inner">
                <?php
                $spavalais_description = get_bloginfo('description', 'display');
                if ($spavalais_description || is_customize_preview()) :
                    ?>
                    <p class="site-description"><?php echo $spavalais_description; /* WPCS: xss ok. */ ?></p>
                <?php endif; ?>

            </div>
        </div>


    </header><!-- #masthead -->

    <div id="content" class="site-content">
