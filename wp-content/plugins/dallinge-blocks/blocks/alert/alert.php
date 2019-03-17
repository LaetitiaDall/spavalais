<?php

function dallinge_blocks_alert_register()
{
    wp_register_script(
        'dallinge-alert',
        plugin_dir_url(__FILE__) . 'alert.js',
        array('wp-editor', 'wp-blocks', 'wp-element'),
        true
    );

    wp_register_style(
        'dallinge-alert',
        plugin_dir_url(__FILE__) . 'alert.css',
        array('wp-edit-blocks'),
        filemtime(plugin_dir_path(__FILE__) . 'alert.css')
    );

    wp_register_style(
        'dallinge-alert-frontend',
        plugin_dir_url(__FILE__) . 'alert.css',
        array(),
        filemtime(plugin_dir_path(__FILE__) . 'alert.css')
    );

    register_block_type('dallinge/alert', array(
        'editor_script' => 'dallinge-alert',
        'editor_style' => 'dallinge-alert',
        'style' => 'dallinge-alert-frontend',

    ));
}


add_action('init', 'dallinge_blocks_alert_register');
