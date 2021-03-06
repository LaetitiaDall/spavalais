<?php
/**
 * spavalais functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package spavalais
 */

if (!function_exists('spavalais_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function spavalais_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on spavalais, use a find and replace
         * to change 'spavalais' to the name of your theme in all the template files.
         */
        load_theme_textdomain('spavalais', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'menu-1' => esc_html__('Primary', 'spavalais'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        /*add_theme_support('custom-background', apply_filters('spavalais_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));*/

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        /**
         * Add support for core custom logo.
         *
         * @link https://codex.wordpress.org/Theme_Logo
         */
        add_theme_support('custom-logo', array(
            'height' => 250,
            'width' => 250,
            'flex-width' => true,
            'flex-height' => true,
        ));


        if ( function_exists( 'add_image_size' ) ) {
            add_image_size( 'animal-image', 1200, 9999 ); //300 pixels wide (and unlimited height)
            add_image_size( 'animal-thumb', 220, 180, true ); //(cropped)
        }
    }
endif;
add_action('after_setup_theme', 'spavalais_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function spavalais_content_width()
{
    // This variable is intended to be overruled from themes.
    // Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
    // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
    $GLOBALS['content_width'] = apply_filters('spavalais_content_width', 640);
}

add_action('after_setup_theme', 'spavalais_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function spavalais_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Footer Sidebar', 'spavalais'),
        'id' => 'sidebar-footer',
        'description' => esc_html__('Add widgets here.', 'spavalais'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}

add_action('widgets_init', 'spavalais_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function spavalais_scripts()
{
    wp_enqueue_script('jquery');

    wp_enqueue_style('spavalais-style', get_stylesheet_uri());

    dallinge_scss_register_variables(get_template_directory() . '/css/variables.scss');

    dallinge_scss_register_file(get_template_directory() . '/css/custom.scss');

    dallinge_scss_register_file(get_template_directory() . '/css/media.scss');

    wp_enqueue_script('spavalais-script-custom', get_template_directory_uri() . '/js/custom.js', array(), '20151215', true);

    wp_enqueue_script('spavalais-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true);

    /*if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }*/
}

add_action('wp_enqueue_scripts', 'spavalais_scripts');


/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


function hide_menu() {

    if (current_user_can('editor')) {

        remove_submenu_page( 'themes.php', 'themes.php' ); // hide the theme selection submenu
        remove_submenu_page( 'themes.php', 'widgets.php' ); // hide the widgets submenu
        remove_submenu_page( 'themes.php', 'customize.php?return=%2Fwp-admin%2Ftools.php' ); // hide the customizer submenu
        remove_submenu_page( 'themes.php', 'customize.php?return=%2Fwp-admin%2Ftools.php&#038;autofocus%5Bcontrol%5D=background_image' ); // hide the background submenu

        // these are theme-specific. Can have other names or simply not exist in your current theme.
        remove_submenu_page( 'themes.php', 'spavalais' );
        remove_submenu_page( 'themes.php', 'custom-header' );
        remove_submenu_page( 'themes.php', 'custom-background' );

    }
}

add_action('admin_head', 'hide_menu');

add_action( 'admin_bar_menu', 'remove_some_nodes_from_admin_top_bar_menu', 999 );
function remove_some_nodes_from_admin_top_bar_menu( $wp_admin_bar ) {
    $wp_admin_bar->remove_menu( 'customize' );
}
// Remove WP admin dashboard widgets
function isa_disable_dashboard_widgets() {
    //dremove_meta_box('dashboard_right_now', 'dashboard', 'normal');// Remove "At a Glance"
    //remove_meta_box('dashboard_activity', 'dashboard', 'normal');// Remove "Activity" which includes "Recent Comments"
   // remove_meta_box('dashboard_quick_press', 'dashboard', 'side');// Remove Quick Draft
    remove_meta_box('dashboard_primary', 'dashboard', 'core');// Remove WordPress Events and News
}
add_action('admin_menu', 'isa_disable_dashboard_widgets');

function tatwerat_startSession() {
    if(!session_id()) {
        session_start();
    }
}

add_action('init', 'tatwerat_startSession', 1);

