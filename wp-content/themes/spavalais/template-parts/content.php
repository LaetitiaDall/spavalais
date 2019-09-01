<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package spavalais
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php dallinge_post_thumbnail(); ?>

    <header class="entry-header">
        <?php
        dallinge_post_title();

        if ('post' === get_post_type()) :
            ?>
            <div class="entry-meta">
                <?php
                dallinge_post_date_simple();
                dallinge_post_author_simple();
                dallinge_post_categories();
                dallinge_post_tags();
                ?>
            </div><!-- .entry-meta -->
        <?php endif; ?>
    </header><!-- .entry-header -->


    <div class="entry-content">
        <?php
        the_content(sprintf(
            wp_kses(
            /* translators: %s: Name of current post. Only visible to screen readers */
                __('Continue reading<span class="screen-reader-text"> "%s"</span>', 'spavalais'),
                array(
                    'span' => array(
                        'class' => array(),
                    ),
                )
            ),
            get_the_title()
        ));

        ?>

        <h3 style="padding-top:30px; margin-bottom:0px; padding-bottom:0px;">Partager</h3>

        <!-- Your share button code -->
        <div class="fb-share-button"
             data-href="<?php echo get_permalink() ?>"
             data-layout="button_count">
        </div>

        <?php
        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'spavalais'),
            'after' => '</div>',
        ));
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php

        dallinge_edit_link(); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
