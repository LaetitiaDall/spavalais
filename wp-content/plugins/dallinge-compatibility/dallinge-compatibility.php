<?php
/**
 * @package dallinge_compatibility
 * @version 1.0.0
 */
/*
Plugin Name: Dallinge Compatibility
Plugin URI: http://dev.dallinge.ch/
Description: Show a message on too old browsers (IE6 + IE7) and apply specific styles depending on browser version.
Author: Laetitia Dallinge
Version: 1.0.0
Author URI: http://dev.dallinge.ch/
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}


function dallinge_compatibility_load_styles_and_scripts()
{
    dallinge_scss_register_file(plugin_dir_path(__FILE__) . 'dallinge-compatibility.scss');

    wp_enqueue_script('jquery');
    wp_enqueue_script('bowser', plugin_dir_url(__FILE__) . 'libs/bowser.min.js');
    wp_enqueue_script('dallinge_fixes_script', plugin_dir_url(__FILE__) . 'dallinge-compatibility.js');

}

add_action('wp_enqueue_scripts', 'dallinge_compatibility_load_styles_and_scripts', 999);

function dallinge_compatibility_wp_head_end()
{
    ?>
    <script type="text/javascript">
        dallinge_compatibility_check_browser();
    </script>
    <?php
}

add_action('wp_head', 'dallinge_compatibility_wp_head_end', 999);

function dallinge_compability_first_in_head()
{
    ?>
    <meta http-equiv="X-UA-Compatible" content="IE=9">

    <!--[if lt IE 9]>
    <script src="<?php echo plugin_dir_url(__FILE__) . 'libs/ie9.min.js'; ?>"></script>
    <script src="<?php echo plugin_dir_url(__FILE__) . 'libs/html5-printshiv.min.js'; ?>"></script>
    <![endif]-->

    <?php

}

add_action('wp_head', 'dallinge_compability_first_in_head', -999);


function dallinge_compatibility_prefered_language(array $available_languages, $http_accept_language)
{

    $available_languages = array_flip($available_languages);

    $langs = [];
    preg_match_all('~([\w-]+)(?:[^,\d]+([\d.]+))?~', strtolower($http_accept_language), $matches, PREG_SET_ORDER);
    foreach ($matches as $match) {

        list($a, $b) = explode('-', $match[1]) + array('', '');
        $value = isset($match[2]) ? (float)$match[2] : 1.0;

        if (isset($available_languages[$match[1]])) {
            $langs[$match[1]] = $value;
            continue;
        }

        if (isset($available_languages[$a])) {
            $langs[$a] = $value - 0.1;
        }

    }
    arsort($langs);

    return $langs;
}

function dallinge_compatibility_kill_old_browsers()
{
    if (isset($_GET['outdated'])) {
        require_once('warning/outdated.php');
        die();
    }
}

add_action('init', 'dallinge_compatibility_kill_old_browsers', -999);


function dallinge_compatibility_outdated_browser_check()
{
    ?>
    <!--[if lt IE 9]>
    <script type="text/javascript">
        location.href = '?outdated=1';
    </script>
    <![endif]-->
    <?php
}