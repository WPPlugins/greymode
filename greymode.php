<?php
/*
Plugin Name: Grey Mode
Plugin URI:  
Description: Plugin that change your website to grey scale, If user would like to change to normal color? easy! we provide toggle button to switch it!
Version:     2.0.0
Author:      Hiro
Author URI:  
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/
if (!function_exists('add_action') ||
    class_exists('Hiro_Greymode_Settings') ||
    class_exists('Hiro_Greymode_Admin') ||
    class_exists('Hiro_Greymode_Public')) {
    exit();
}
$currentFolder = plugin_dir_path(__FILE__);
require_once($currentFolder . '/configurations/environment.php');
require_once($currentFolder . '/public/greymode-public.php');
require_once($currentFolder . '/private/greymode-admin.php');
if (is_admin()) 
{
    add_action( 'admin_init', array('Hiro_Greymode_Admin', 'page_init') );
    add_action( 'admin_menu', array('Hiro_Greymode_Admin', 'menu_init') );
    add_action( 'admin_enqueue_scripts', array('Hiro_Greymode_Admin', 'assets_init') );
}
add_action( 'wp_enqueue_scripts', array('Hiro_Greymode_Public', 'assets_init') );
add_action( 'wp_head', array('Hiro_Greymode_Public', 'layout_init') );
?>
