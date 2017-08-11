<?php
/**
 * Plugin Name: Responsive Email using Divi Builder
 * Version: 1.1
 * Description: Responsive Email Builder using the Divi Builder
 * Author: Outsource Appz
 * Author URI: https://outsourceappz.com
 * Plugin URI: https://www.outsourceappz.com/responsive-email-using-divi-builder-a-wordpress-plugin/
 * Text Domain: oa-responsive-email
 * Domain Path: /languages.
 */
define('OA_RESPONSIVE_EMAIL_DIR', __DIR__);
define('OA_RESPONSIVE_EMAIL_URL', plugins_url('/'.basename(__DIR__)));

require_once OA_RESPONSIVE_EMAIL_DIR.'/src/class-oa-responsive-email-activator.php';
register_activation_hook(__FILE__, array('OA_Responsive_Email_Activator', 'activate'));

//Clears Divi Cache while in development.
add_action('admin_head', 'oa_responsive_email_clear_local_storage');

function oa_responsive_email_clear_local_storage()
{
    //echo '<script>localStorage.clear();</script>';
}

require_once OA_RESPONSIVE_EMAIL_DIR.'/src/class-oa-responsive-email-plugin.php';
$plugin = new OA_Responsive_Email_Plugin();

//divi modules
add_action('et_builder_ready', array($plugin, 'register_divi_modules'), 999);
// Register Shortcodes
$plugin->add_shortcodes();
// add custom post type for divi
add_filter('et_builder_post_types', array($plugin, 'et_builder_post_types'));
// template filter
add_filter('single_template', array($plugin, 'filter_single_template'), 99);

// Register Custom Post Types
require_once OA_RESPONSIVE_EMAIL_DIR.'/src/class-oa-responsive-email-custom-post-types.php';

$custom_post_types = new OA_Responsive_Email_Custom_Post_Types();
add_action('init', array($custom_post_types, 'init'));

function oa_set_wp_email_content_type_html()
{
    return 'text/html';
}

require_once OA_RESPONSIVE_EMAIL_DIR.'/src/class-oa-responsive-email-overrides.php';
$overrides = new OA_Responsive_Email_Overrides();

add_filter('retrieve_password_message', array($overrides, 'filter_retrieve_password_message'), 10, 4);
add_filter('preview_post_link', array($plugin, 'filter_preview_post_link'), 9999);

// Settings Page

add_action('admin_menu', array($plugin, 'admin_menu'));
add_action('admin_init', array($plugin, 'admin_init'));
