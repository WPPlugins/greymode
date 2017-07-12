<?php
if (!defined( 'ABSPATH') && !defined('WP_UNINSTALL_PLUGIN') || class_exists('Hiro_Greymode_Settings')) {
    exit();
}
$currentFolder = plugin_dir_path(__FILE__);
require_once($currentFolder . '/configurations/environment.php');
delete_option( Hiro_Greymode_Settings::OPTION_NAME );
?>
