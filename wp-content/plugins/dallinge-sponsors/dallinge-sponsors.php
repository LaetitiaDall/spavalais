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

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}


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

    // Add new taxonomy, NOT hierarchical (like tags)
    $labels = array(
        'name' => _x('Sponsors Tags', 'taxonomy general name'),
        'singular_name' => _x('Sponsors Tag', 'taxonomy singular name'),
        'search_items' => __('Search Sponsors Tags'),
        'popular_items' => __('Popular Sponsors Tags'),
        'all_items' => __('All Sponsors Tags'),
        'parent_item' => null,
        'parent_item_colon' => null,
        'edit_item' => __('Edit Sponsors Tag'),
        'update_item' => __('Update Sponsors Tag'),
        'add_new_item' => __('Add New Sponsors Tag'),
        'new_item_name' => __('New Sponsors Tag Name'),
        'separate_items_with_commas' => __('Separate sponsors tags with commas'),
        'add_or_remove_items' => __('Add or remove sponsors tags'),
        'choose_from_most_used' => __('Choose from the most used sponsors tags'),
        'menu_name' => __('Sponsors Tags'),
    );

    register_taxonomy('dsponsorstag', 'dsponsors', array(
        'hierarchical' => false,
        'labels' => $labels,
        'show_ui' => true,
        'update_count_callback' => '_update_post_term_count',
        'query_var' => true,
        'rewrite' => array('slug' => 'tag'),
    ));

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
        'title' => esc_html__('Options', 'dallinge'),
        'object_types' => array('dsponsors'), // Post type


    ));
    $cmb_demo->add_field(array(
        'name' => esc_html__('Sponsor Position', 'dallinge'),
        'desc' => esc_html__('Enter a number', 'dallinge'),
        'id' => $prefix . 'position',
        'type' => 'text',
        'default' => '0',
        'column' => array(
            'name' => esc_html__('Position', 'dallinge'), // Set the admin column title
            'position' => 3,
        ),
    ));

    $cmb_demo->add_field(array(
        'name' => esc_html__('Sponsor URL', 'dallinge'),
        'desc' => esc_html__('Enter a url (http://example.com)', 'dallinge'),
        'id' => $prefix . 'url',
        'type' => 'text_url',
        'column' => array(
            'name' => esc_html__('Url', 'dallinge'), // Set the admin column title
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


function dallinge_sponsors($tag = 0)
{

    $sponsors = get_posts([
        'post_type' => 'dsponsors',
        'post_status' => 'publish',
        'numberposts' => -1,
        'order' => 'DESC',
        'orderby' => 'meta_value',
        'tax_query' => array(
            array(
                'taxonomy' => 'dsponsorstag',
                'field' => 'id',
                'terms' => $tag, // Where term_id of Term 1 is "1".
                'include_children' => false
            )
        ),
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
            $url = get_post_meta($sponsor->ID, 'dsponsors_url')[0];

            ?>
            <div class="sponsor position-<?php echo $key ?>">
                <a href="<?php echo $url ?>" target="_blank"><img src="<?php echo $thumbnail_url; ?>"
                                                                  alt="<?php echo $title ?>"
                                                                  title="<?php echo $title ?>"/>
                    <div class="message">
                        <?php echo $content; ?>
                        <?php edit_post_link(__('Edit'), '', '', $sponsor->ID) ?>
                    </div>
                </a>
            </div>
        <?php endforeach; ?>
    </div>
    <?php
}


// Register and load the widget
function dallinge_sponsors_load_widget()
{
    register_widget('DallingeSponsorsWidget');
}

add_action('widgets_init', 'dallinge_sponsors_load_widget');


class DallingeSponsorsWidget extends WP_Widget
{

    function __construct()
    {
        parent::__construct(
            'dallinge_sponsors',
            __('Dallinge Sponsors', 'dallinge'),
            array('description' => __('Display a list of sponsors', 'dallinge'),)
        );
    }

    public function widget($args, $instance)
    {
        $title = !empty($instance['title']) ? $instance['title'] : '';
        $tag = !empty($instance['tag']) ? $instance['tag'] : '';

        /** This filter is documented in wp-includes/widgets/class-wp-widget-pages.php */
        $title = apply_filters('widget_title', $title, $instance, $this->id_base);


        echo $args['before_widget'];

        if ($title) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        dallinge_sponsors($tag);

        echo $args['after_widget'];

    }

    public function form($instance)
    {
        $title = !empty($instance['title']) ? $instance['title'] : __('Our sponsors', 'dallinge');
        $tag = !empty($instance['tag']) ? $instance['tag'] : '';

        ?>
        <p>
            <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
                   name="<?php echo $this->get_field_name('title'); ?>" type="text"
                   value="<?php echo esc_attr($title); ?>"/>
        </p>
        <p>
            <select id="<?php echo $this->get_field_id('tag'); ?>" name="<?php echo $this->get_field_name('tag'); ?>"
                    class="widefat" style="width:100%;">
                <?php foreach (get_terms(array(
                    'taxonomy' => 'dsponsorstag',
                    'hide_empty' => false,
                )) as $term) { ?>
                    <option <?php selected($tag, $term->term_id); ?>
                            value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
                <?php } ?>
            </select>
        </p>
        <?php
    }

    public function update($new_instance, $old_instance)
    {
        $instance = array();
        $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
        $instance['tag'] = (!empty($new_instance['tag'])) ? strip_tags($new_instance['tag']) : '';

        return $instance;
    }
}