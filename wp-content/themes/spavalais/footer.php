<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package spavalais
 */

?>
</div><!-- inner -->
</div><!-- #content -->

<footer id="colophon" class="site-footer">
    <div class="inner">
        <div class="site-info">

            <div class="footer-sidebar">
                <?php dynamic_sidebar('sidebar-footer'); ?>
            </div>

            <div class="site-info">
                <div class="copyright">
                    Copyright &copy; 2018 - <?php echo date('Y') ?> SPA Valais. Tous droits réservés. <a class='creator' href='http://laetitia.dallinge.ch'>Création LD</a></span>.

                </div>

            </div><!-- .site-info -->

        </div><!-- .site-info -->
    </div>
</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
