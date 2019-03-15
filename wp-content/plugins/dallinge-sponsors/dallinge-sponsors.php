<?php
/**
 * @package Dallinge_Sponsors
 * @version 1.0.0
 */
/*
Plugin Name: Dallinge Sponsors
Plugin URI: http://wordpress.org/plugins/dsponsors/
Description: Allows you to add sponsors to your website and display them in a widget.
Author: Laetitia Dallinge
Version: 1.0.0
Author URI: http://dev.dallinge.ch/
*/


function dallinge_sponsors_create_post_type()
{
    register_post_type('dsponsors',
        array(
            'labels' => array(

                'name' => __('Sponsors'),
                'singular_name' => __('Sponsor'),
                'featured_image' => __('Sponsor image'),
                'add_new' => __('Add New Sponsor'),
                'add_new_item' => __('Add New Sponsor'),
                'edit_item' => __('Edit Sponsor'),
                'new_item' => __('New Sponsor'),
                'view_item' => __('View Sponsor'),
                'view_items' => __('View Sponsors'),
                'search_items' => __('Search Sponsors'),
                'not_found' => __('Sponsor not found'),
                'not_found_in_trash' => __('No Sponsor found in trash')
            ),
            'public' => true,
            'has_archive' => false,
            'supports' => array('title', 'thumbnail', 'editor'),
            'menu_icon' => plugin_dir_url(__FILE__) . 'imgs/sponsors-icon.png',

        )
    );
}

add_action('init', 'dallinge_sponsors_create_post_type');

function dallinge_sponsors_add_img_column($columns)
{
    $columns = array_slice($columns, 0, 1, true) + array("img" => "Sponsor Image") + array_slice($columns, 1, count($columns) - 1, true);
    return $columns;
}

add_filter('manage_dsponsors_posts_columns', 'dallinge_sponsors_add_img_column');

function dallinge_sponsors_display_img_column($column_name, $post_id)
{
    if ($column_name == 'img') {
        echo get_the_post_thumbnail($post_id, 'thumbnail');
    }
    return $column_name;
}

add_filter('manage_dsponsors_posts_custom_column', 'dallinge_sponsors_display_img_column', 10, 2);

function dallinge_sponsors_register_sponsors_metabox()
{
    $prefix = 'dsponsors_';
    $cmb_demo = new_cmb2_box(array(
        'id' => $prefix . 'options',
        'title' => esc_html__('Options', 'cmb2'),
        'object_types' => array('dsponsors'), // Post type


    ));
    $cmb_demo->add_field(array(
        'name' => esc_html__('Sponsor Position', 'cmb2'),
        'desc' => esc_html__('Enter a number', 'cmb2'),
        'id' => $prefix . 'position',
        'type' => 'text',
        'default' => '0',
        'column' => array(
            'name' => esc_html__('Position', 'cmb2'), // Set the admin column title
            'position' => 3,
        ),
    ));

    $cmb_demo->add_field(array(
        'name' => esc_html__('Sponsor URL', 'cmb2'),
        'desc' => esc_html__('Enter a url (http://example.com)', 'cmb2'),
        'id' => $prefix . 'url',
        'type' => 'text_url',
        'column' => array(
            'name' => esc_html__('Url', 'cmb2'), // Set the admin column title
            'position' => 3,
        ),
    ));
}

add_action('cmb2_admin_init', 'dallinge_sponsors_register_sponsors_metabox');

function dallinge_sponsors_load_my_scripts()
{
    dallinge_scss_register_variables(plugin_dir_path(__FILE__) . 'dallinge-sponsors-variables.scss');
    dallinge_scss_register_file(plugin_dir_path(__FILE__) . 'dallinge-sponsors.scss');
    wp_enqueue_script('jquery');
    wp_enqueue_script('dallinge_sponsors_script', plugin_dir_url(__FILE__) . 'dallinge-sponsors.js');
}

add_action('wp_enqueue_scripts', 'dallinge_sponsors_load_my_scripts');


function dallinge_sponsors($speed = 5000)
{

    $sponsors = get_posts([
        'post_type' => 'dsponsors',
        'post_status' => 'publish',
        'numberposts' => -1,
        'order' => 'DESC',
        'orderby' => 'meta_value',
        'meta_query' => array(
            array('key' => 'dsponsors_position'))
    ]);

    ?>

    <div class="dallinge-sponsors">
        <?php foreach ($sponsors as $key => $sponsor):
            $thumbnail_url = get_the_post_thumbnail_url($sponsor->ID, 'full');
            $content = apply_filters('the_content', $sponsor->post_content);
            $content = str_replace(']]>', ']]&gt;', $content);
            $title = apply_filters('the_title', $sponsor->post_title);
            $title = str_replace(']]>', ']]&gt;', $title);

            ?>
            <div class="sponsor position-<?php echo $key ?>">
                <img src="<?php echo $thumbnail_url; ?>" alt="<?php echo $title ?>"/>
                <div class="message">
                    <?php echo $content; ?>
                    <?php edit_post_link(__('Edit'), '', '', $sponsor->ID) ?>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    <?php
}