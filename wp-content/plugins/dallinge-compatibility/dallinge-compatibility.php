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

function dallinge_compatibility_load_styles_and_scripts()
{
    dallinge_scss_register_file(plugin_dir_path(__FILE__) . 'dallinge-compatibility.scss');

    wp_enqueue_script('jquery');
    wp_enqueue_script('require', plugin_dir_url(__FILE__) . 'libs/require.js');
    wp_enqueue_script('bowser', plugin_dir_url(__FILE__) . 'libs/bowser.min.js');
    wp_enqueue_script('dallinge_fixes_script', plugin_dir_url(__FILE__) . 'dallinge-compatibility.js');

}

add_action('wp_enqueue_scripts', 'dallinge_compatibility_load_styles_and_scripts');

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
