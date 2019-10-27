<?php

function dallinge_blocks_section_register()
{
    wp_register_script(
        'dallinge-section',
        plugin_dir_url(__FILE__) . 'section.js',
        array('wp-editor', 'wp-blocks', 'wp-element'),
        true
    );

    wp_register_style(
        'dallinge-section-editor',
        plugin_dir_url(__FILE__) . 'section-editor.css',
        array('wp-edit-blocks'),
        filemtime(plugin_dir_path(__FILE__) . 'section.css')
    );

    wp_register_style(
        'dallinge-section-frontend',
        plugin_dir_url(__FILE__) . 'section.css',
        array(),
        filemtime(plugin_dir_path(__FILE__) . 'section.css')
    );

    register_block_type('dallinge/section', array(
        'editor_script' => 'dallinge-section',
        'editor_style' => 'dallinge-section-editor',
        'style' => 'dallinge-section-frontend',

    ));
}


add_action('init', 'dallinge_blocks_section_register');
