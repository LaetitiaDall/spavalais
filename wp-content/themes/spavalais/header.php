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
    <link href="https://fonts.googleapis.com/css?family=Barlow|Catamaran|Gentium+Book+Basic|Hind|Ropa+Sans|Titillium+Web"
          rel="stylesheet">

    <link rel="apple-touch-icon" sizes="57x57" href="apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon-16x16.png">
    <link rel="manifest" href="manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
</head>

<body <?php body_class(); ?>>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'spavalais'); ?></a>

    <header id="masthead" class="site-header">

        <div class="fixed">
            <div class="inner inner-top">
                <?php the_custom_logo(); ?>

                <?php
                $spavalais_description = get_bloginfo('description', 'display');
                if ($spavalais_description || is_customize_preview()) :
                    ?>
                    <p class="site-description"><?php echo $spavalais_description; /* WPCS: xss ok. */ ?></p>
                <?php endif; ?>

                <?php if (is_front_page() && is_home()) : ?>
                    <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
                                              rel="home"><?php bloginfo('name'); ?></a></h1>
                <?php else : ?>
                    <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
                                             rel="home"><?php bloginfo('name'); ?></a></p>
                <?php endif; ?>

                <div class="right">
                    <?php get_search_form(true) ?>
                    <?php dallinge_facebook_icon('https://www.facebook.com/refugedelespoir'); ?>
                </div>
            </div>

            <div id="red-banner">
                <div class="inner">


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
            </div>
        </div>
        <div class="fixed-space"></div>
        <?php if (is_front_page()) dallinge_slides() ?>

    </header><!-- #masthead -->

    <div id="content" class="site-content">
        <div class="inner">
