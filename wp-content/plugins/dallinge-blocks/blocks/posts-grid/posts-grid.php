<?php



function dallinge_blocks_posts_grid_render($attributes, $content)
{
    $query = new WP_Query(array(
        'posts_per_page' => 5,
    ));
    ob_start();
    ?>
    <div class="posts">
        <?php
        if ($query->have_posts()) :
            while ($query->have_posts()) :
                $query->the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <?php dallinge_post_thumbnail(); ?>
                    <div class="infos">
                        <?php the_title('<h3 class="entry-title">', '</h3>'); ?>
                        <?php dallinge_post_author_simple(); ?>
                        <?php dallinge_post_date_simple(); ?>
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
    wp_enqueue_script(
        'dallinge-posts-grid',
        plugin_dir_url(__FILE__) . 'posts-grid.js',
        array('wp-editor', 'wp-blocks', 'wp-element'),
        true
    );

    wp_register_style(
        'dallinge-posts-grid',
        plugin_dir_url(__FILE__) . 'posts-grid.css',
        array('wp-edit-blocks'),
        filemtime(plugin_dir_path(__FILE__) . 'posts-grid.css')
    );

    register_block_type('dallinge/posts-grid', array(
        'editor_script' => 'dallinge-posts-grid',
        'editor_style' => 'dallinge-posts-grid',
        'style' => 'dallinge-posts-grid',
        'render_callback' => 'dallinge_blocks_posts_grid_render',
    ));
}

add_action('init', 'dallinge_blocks_posts_grid_register');
