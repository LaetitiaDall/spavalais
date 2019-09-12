<?php
/**
 * @package dallinge_vaf
 * @version 1.0.0
 */
/*
Plugin Name: Dallinge WP Export
Plugin URI: http://dev.dallinge.ch
Description: Allow to export wordpress database and files for another host.
Author: Laetitia Dallinge
Version: 1.0.0
Author URI: http://dev.dallinge.ch/
Text Domain: dallinge-export

*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}


function dallinge_wp_export_admin_menu()
{
    if (!current_user_can('manage_options')) return;

    add_menu_page('WP Export', 'WP Export
   ', 'manage_options',
        'dallinge-wp-export/wp-export.php',
        'dallinge_wp_export_admin_page',
        'dashicons-migrate', 1000);
}

add_action('admin_menu', 'dallinge_wp_export_admin_menu');


add_action('admin_init', 'dallinge_wp_export_actions');

function dallinge_wp_export_actions()
{

    if (!current_user_can('manage_options')) return;

    if (isset($_POST['export_files'])) {

        $result = preg_replace("/[^a-zA-Z0-9]+/", "", site_url());

        $filename = "wp-" . $result . "-backup-" . date("d-m-Y") . ".tar.gz";

        $tar = get_temp_dir() . bin2hex(random_bytes(30)) . '.tar';
        $gz = $tar . '.gz';
        $p = new PharData($gz);
        $p->compress(Phar::GZ);
        $p->buildFromDirectory(ABSPATH . './');


        // Create altered config
        $config = file_get_contents(ABSPATH . '/wp-config.php');
        $config = preg_replace('/define\(\s*\'DB_NAME\'\s*,\s*\'(.*)\'\s*\);/', 'define("DB_NAME", "' . $_POST['new-db-name'] . '");', $config);
        $config = preg_replace('/define\(\s*\'DB_USER\'\s*,\s*\'(.*)\'\s*\);/', 'define("DB_USER", "' . $_POST['new-db-user'] . '");', $config);
        $config = preg_replace('/define\(\s*\'DB_PASSWORD\'\s*,\s*\'(.*)\'\s*\);/', 'define("DB_PASSWORD", "' . $_POST['new-db-pass'] . '");', $config);
        $config = preg_replace('/define\(\s*\'DB_HOST\'\s*,\s*\'(.*)\'\s*\);/', 'define("DB_HOST", "' . $_POST['new-db-host'] . '");', $config);
        $config = preg_replace('/define\(\s*\'FS_METHOD\'\s*,\s*\'(.*)\'\s*\);/', '', $config);
        $config = preg_replace('/define\(\s*\'WP_DEBUG\'\s*,\s*true\s*\);/', 'define(\'WP_DEBUG\', false);', $config);
        file_put_contents(ABSPATH . 'wp-config-altered.php', $config);
        // ... end

        $p->addFile(ABSPATH . 'wp-config-altered.php', 'wp-config.php');
        unlink(ABSPATH . 'wp-config-altered.php');

        ob_end_clean();

        header("Content-Disposition:attachment;filename=$filename");
        header('Content-Type:application/x-gzip');
        header('Content-Length:' . filesize($gz));
        flush();
        readfile($gz);
        unlink($gz);
        exit(0);
    }

    if (isset($_POST['export_db'])) {


        $result = preg_replace("/[^a-zA-Z0-9]+/", "", site_url());

        $filename = "wp-" . $result . "-backup-" . date("d-m-Y") . ".sql";
        $mime = "application/text";

        header("Content-Type: " . $mime);
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        $cmd = "mysqldump -u " . DB_USER . " --password='" . DB_PASSWORD . "' " . DB_NAME . "";

        ob_start();

        passthru($cmd);

        $var = ob_get_contents();

        $toreplace = site_url();
        $new_host_name = $_POST['new-host-name'];

        $toreplace_no_http = str_replace('https://', '', $toreplace);
        $toreplace_no_http = str_replace('http://', '', $toreplace_no_http);

        $new_no_http = str_replace('https://', '', $new_host_name);
        $new_no_http = str_replace('http://', '', $new_no_http);

        $urlparts = parse_url(home_url());
        $domain_old = $urlparts['host'];

        $urlparts = parse_url($new_host_name);
        $domain_new = $urlparts['host'];


        $var = str_replace($toreplace, $new_host_name, $var);
        $var = str_replace($toreplace_no_http, $new_no_http, $var);
        $var = str_replace($domain_old, $domain_new, $var);

        ob_end_clean();

        echo $var;
        exit(0);
    }


}

function dallinge_wp_export_admin_page()
{
    if (!current_user_can('manage_options')) return;

    ?>

    <div class="wrap">
        <h1 class="wp-heading-inline">Export Database & Files</h1>

        <h3>
            Export database with new host name
        </h3>
        <form action="" method="post">
            <input type="hidden" value="dallinge-wp-export/wp-export.php" name="page">
            <input type="hidden" value="yes" name="export_db">
            <label><?= __('Specify new host name'); ?> :</label>
            <input type="text" name="new-host-name"
                   placeholder="https://host.name" value="https://example.com">
            <br/>
            <button type="submit" class="button media-button  select-mode-toggle-button"><?= __('Export db') ?>
            </button>
        </form>


        <h3>
            Export files with new database configuration
        </h3>

        <form action="" method="post">
            <input type="hidden" value="dallinge-wp-export/wp-export.php" name="page">
            <input type="hidden" value="yes" name="export_files">
            <label><?= __('Database name:'); ?> :</label>
            <input type="text" name="new-db-host"
                   placeholder="localhost" value="<?= DB_HOST ?>">
            <br/>
            <label><?= __('Database name:'); ?> :</label>
            <input type="text" name="new-db-name"
                   value="<?= DB_NAME ?>">
            <br/>
            <label><?= __('Database user:'); ?> :</label>
            <input type="text" name="new-db-user"
                   value="<?= DB_USER ?>">
            <br/>
            <label><?= __('Database password:'); ?> :</label>
            <input type="text" name="new-db-pass"
                   value="<?= DB_PASSWORD ?>">
            <br/>
            <button type="submit" class="button media-button  select-mode-toggle-button"><?= __('Export files') ?>
            </button>
        </form>
    </div>


    <?php
}
