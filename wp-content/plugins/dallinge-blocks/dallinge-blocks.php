<?php
/**
 * @package Dallinge_Blocks
 * @version 1.0.0
 */
/*
Plugin Name: Dallinge Blocks
Plugin URI: http://dev.dallinge.ch/
Description: Add custom & useful blocks
Author: Laetitia Dallinge
Version: 1.0.0
Author URI: http://dev.dallinge.ch/
*/


require_once('blocks/posts-grid/posts-grid.php');
require_once('blocks/alert/alert.php');



function dallinge_blocks_register_category( $categories, $post ) {
    return array_merge(
        $categories,
        array(
            array(
                'slug' => 'dallinge-blocks',
                'title' => __( 'Dallinge Blocks', 'dallinge-blocks' ),
            ),
        )
    );
}
add_filter( 'block_categories', 'dallinge_blocks_register_category', 10, 2);