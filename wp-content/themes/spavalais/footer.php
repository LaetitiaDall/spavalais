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
                    Copyright &copy; 2018 - <?php echo date('Y') ?> SPA Valais. Tous droits réservés. <br/><a class='creator' href='https://dev.dallinge.ch'>Creation dallingedev</a></span>

                </div>

            </div><!-- .site-info -->

        </div><!-- .site-info -->
    </div>
</footer><!-- #colophon -->
</div><!-- #page -->



<?php wp_footer(); ?>


<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

</body>
</html>
