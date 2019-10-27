<?php


function dallinge_blocks_posts_grid_render($attributes, $content)
{

    $is_odd = !($attributes['maxPosts'] % 2 == 0) && ($attributes['maxColumns'] == 2);

    $query = new WP_Query(array(
        'posts_per_page' => $attributes['maxPosts'],
    ));

    ob_start();
    ?>
    <div class="wp-block-dallinge-posts-grid columns-<?php echo $attributes['maxColumns']; ?> <?php echo($is_odd ? 'odd' : '') ?>">
        <?php
        if ($query->have_posts()) :
            while ($query->have_posts()) :
                $query->the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <div class="article-wrapper">
                        <?php dallinge_post_thumbnail(); ?>
                        <div class="post-text-infos">
                            <div class="meta">
                                <?php dallinge_post_categories(); ?>
                                <?php dallinge_post_author_simple(); ?>
                                <?php dallinge_post_date_simple(); ?>

                            </div>
                            <div class="title">
                                <?php dallinge_edit_link(); ?>
                                <?php dallinge_post_title(); ?>
                            </div>
                        </div>
                    </div>
                </article>
            <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>

    <?php
    $data = ob_get_contents();
    ob_end_clean();
    return $data;
}

function dallinge_blocks_posts_grid_register()
{


    wp_register_script(
        'dallinge-posts-grid',
        plugin_dir_url(__FILE__) . 'posts-grid.js',
        array('wp-editor', 'wp-blocks', 'wp-element'),
        true
    );

    dallinge_scss_register_file(
        plugin_dir_path(__FILE__) . 'posts-grid.scss',
        'posts-grid-editor');

    wp_register_style(
        'dallinge-posts-grid-editor',
        dallinge_scss_build_url('posts-grid-editor'),
        array('wp-edit-blocks')
    );

    dallinge_scss_register_file(
        plugin_dir_path(__FILE__) . 'posts-grid.scss',
        'posts-grid-frontend');

    wp_register_style(
        'dallinge-posts-grid-frontend',
        dallinge_scss_build_url('posts-grid-frontend'),
        array()
    );

    register_block_type('dallinge/posts-grid', array(
        'editor_script' => 'dallinge-posts-grid',
        'editor_style' => 'dallinge-posts-grid-editor',
        'style' => 'dallinge-posts-grid-frontend',
        'render_callback' => 'dallinge_blocks_posts_grid_render',
        'attributes' => array(
            'maxPosts' => array(
                'type' => 'number',
                'default' => 5,
            ),
            'maxColumns' => array(
                'type' => 'number',
                'default' => 2,
            ),
        ),
    ));
}

add_action('init', 'dallinge_blocks_posts_grid_register');
