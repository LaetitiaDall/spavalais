<?php
/**
 * Plugin Name: LH Zero Spam
 * Plugin URI: https://lhero.org/portfolio/lh-zero-spam/
 * Description: This is a very lightweight anti spam plugin utilising JavaScript nonce security to prevent comment and registration spam.
 * Version: 1.10
 * Requires PHP: 5.6
 * Author: Peter Shaw
 * Author URI: https://shawfactor.com
 * Text Domain: lh_zero_spam
 * Domain Path: /languages
 */

if (!class_exists('LH_zero_spam_plugin')) {

    class LH_zero_spam_plugin
    {

        var $namespace = 'lh_zero_spam';

        private static $instance;


        static function return_input_text()
        {

            $return = '<input id="lh_zero_spam-nonce_value" name="lh_zero_spam-nonce_value" type="hidden" size="15" value="" />';

            return $return;


        }


        /**
         * Helper function for registering and enqueueing scripts and styles.
         *
         * @name    The    ID to register with WordPress
         * @file_path        The path to the actual file
         * @is_script        Optional argument for if the incoming file_path is a JavaScript source file.
         */
        private function load_file($name, $file_path, $is_script = false, $deps = array(), $in_footer = true, $atts = array())
        {
            $url = plugins_url($file_path, __FILE__);
            $file = plugin_dir_path(__FILE__) . $file_path;
            if (file_exists($file)) {
                if ($is_script) {
                    wp_register_script($name, $url, $deps, filemtime($file), $in_footer);
                    wp_enqueue_script($name);
                } else {
                    wp_register_style($name, $url, $deps, filemtime($file));
                    wp_enqueue_style($name);
                } // end if
            } // end if

            if (isset($atts) and is_array($atts) and isset($is_script)) {


                $atts = array_filter($atts);

                if (!empty($atts)) {

                    $this->script_atts[$name] = $atts;

                }


                add_filter('script_loader_tag', function ($tag, $handle) {


                    if (isset($this->script_atts[$handle][0]) and !empty($this->script_atts[$handle][0])) {

                        $atts = $this->script_atts[$handle];

                        $implode = implode(" ", $atts);

                        unset($this->script_atts[$handle]);

                        return str_replace(' src', ' ' . $implode . ' src', $tag);

                        unset($atts);
                        usent($implode);


                    } else {

                        return $tag;


                    }


                }, 10, 2);


            }

        } // end load_file


        public function add_custom_comment_fields($fields)
        {

            if (!is_user_logged_in()) {


                $fields['lh_zero_spam'] = "<noscript><p><strong>" . __('Please switch on Javascript to enable commenting', $this->namespace) . "</strong></p></noscript>";

                $fields['lh_zero_spam'] .= self::return_input_text();


                $nonce = wp_create_nonce("lh_zero_spam_nonce");

                $array = array('defer="defer"', 'data-nonce_holder="' . $nonce . '"');

// include the LH Zero Spam javascript
                $this->load_file($this->namespace . '-script', '/assets/lh-zero-spam.js', true, array(), true, $array);


                $GLOBALS['lh_zero_spam-input_included'] = true;

            }

            return $fields;

        }


        public function preprocess_comment($commentdata)
        {
            $valid = false;

            global $wp;

            if ((is_user_logged_in()) or (isset($_POST['lh_zero_spam-nonce_value']) and wp_verify_nonce($_POST['lh_zero_spam-nonce_value'], "lh_zero_spam_nonce")) or isset($wp->query_vars['rest_route']) or (defined('XMLRPC_REQUEST') && XMLRPC_REQUEST)) {

                return $commentdata;


            } else {

                print_r($_POST);

                die;


            }


        }


        public function comment_form($postid)
        {


            if (!isset($GLOBALS['lh_zero_spam-input_included'])) {

                echo "<noscript><strong>" . __('Please switch on Javascript to enable commenting', $this->namespace) . "</strong></noscript>\n";

                echo self::return_input_text();

                echo "

";

                $nonce = wp_create_nonce("lh_zero_spam_nonce");

                $array = array('defer="defer"', 'data-nonce_holder="' . $nonce . '"');

// include the LH Zero Spam javascript
                $this->load_file($this->namespace . '-script', '/assets/lh-zero-spam.js', true, array(), true, $array);


            }


        }

        public function add_custom_registration_fields($fields)
        {
            ?>
            <noscript>
                <strong><?php _e("Please switch on Javascript to enable registration", $this->namespace); ?></strong>
            </noscript>
            <input id="lh_zero_spam-nonce_value" name="lh_zero_spam-nonce_value" type="hidden" size="15" value=""/>
            <?php

            $nonce = wp_create_nonce("lh_zero_spam_nonce");

            $array = array('defer="defer"', 'data-nonce_holder="' . $nonce . '"');

// include the LH Zero Spam javascript
            $this->load_file($this->namespace . '-script', '/assets/lh-zero-spam.js', true, array(), true, $array);


        }


        public function preprocess_registration($errors, $sanitized_user_login, $user_email)
        {
            if (!wp_verify_nonce($_POST['lh_zero_spam-nonce_value'], "lh_zero_spam_nonce")) {

                $errors->add('spam_error', __('<strong>ERROR</strong>: Your comment may be spam or you need to activate javascript.', $this->namespace));

            }

            return $errors;


        }

        public function bp_signup_validate()
        {
            $valid = false;

            global $wp;

            if ((is_user_logged_in()) or (isset($_POST['lh_zero_spam-nonce_value']) and wp_verify_nonce($_POST['lh_zero_spam-nonce_value'], "lh_zero_spam_nonce")) or isset($wp->query_vars['rest_route']) or (defined('XMLRPC_REQUEST') && XMLRPC_REQUEST)) {

                return $commentdata;


            } else {

                print_r($_POST);

                die;


            }

        }


        public function wpmu_validate_user_signup($results)
        {


            if ((is_user_logged_in()) or (isset($_POST['lh_zero_spam-nonce_value']) and wp_verify_nonce($_POST['lh_zero_spam-nonce_value'], "lh_zero_spam_nonce")) or isset($wp->query_vars['rest_route']) or (defined('XMLRPC_REQUEST') && XMLRPC_REQUEST)) {


            } else {


                $error = new WP_Error('generic', __("Please enable Javascript to complete registration", $this->namespace));


                $results['errors'] = $error;

            }


            return $results;

        }


        public function plugins_loaded()
        {


            load_plugin_textdomain($this->namespace, false, basename(dirname(__FILE__)) . '/languages');

        }

        /**
         * Gets an instance of our plugin.
         *
         * using the singleton pattern
         */
        public static function get_instance()
        {
            if (null === self::$instance) {
                self::$instance = new self();
            }

            return self::$instance;
        }


        public function __construct()
        {

//Standard comment protection
            add_filter('comment_form_default_fields', array($this, "add_custom_comment_fields"));
            add_action('preprocess_comment', array($this, 'preprocess_comment'), 9, 1);
            add_action('comment_form', array($this, 'comment_form'), 10, 1);


//standard registration protection
            add_action('register_form', array($this, "add_custom_registration_fields"));
            add_filter('registration_errors', array($this, 'preprocess_registration'), 10, 3);

//Buddypress registration protection, this may not be the best hook
            add_action('bp_before_account_details_fields', array($this, "add_custom_registration_fields"));
            add_action('bp_signup_validate', array($this, 'bp_signup_validate'));


//wp-signup protection
            add_action('signup_extra_fields', array($this, 'add_custom_registration_fields'));
            add_filter('wpmu_validate_user_signup', array($this, 'wpmu_validate_user_signup'), 10, 1);


//run whatever on plugins loaded (currently just translations)
            add_action('plugins_loaded', array($this, "plugins_loaded"));


        }

    }


    $lh_zero_spam_instance = LH_zero_spam_plugin::get_instance();

}

?>