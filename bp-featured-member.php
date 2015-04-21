<?php
/* plugin name: BuddyPress Featured Members
 * Plugin URI: http://rimonhabib.com/buddypress-featured-member-plugin-released
 * Description: BuddyPress Featured members plugin allows you to make fetured members in you BuddyPress community and show them using shortcodes
 * Author: Rimon_Habib
 * Version: 1.0
 * Author URI: http://rimonhabib.com
 * Tags: buddypress
 */


define('BFM_VERSION','1.0');
define('BFM_ROOT',dirname(__FILE__).'/');
define('BFM_INC',BFM_ROOT.'include/');
define('BFM_LIB',BFM_ROOT.'lib/');
define('BFM_TEMPLATE',BFM_ROOT.'templates/');
define('BFM_DIR',basename(dirname(__FILE__)));

define('BFM_LIB_URL',  trailingslashit(plugins_url('/lib/', __FILE__) ));

register_activation_hook( __FILE__,'bfm_activate');
register_deactivation_hook( __FILE__,'bfm_deactivate');

function bfm_activate() { }
function bfm_deactivate() { }

/*
 * Check if buddypress is installed or not
 */
function bfm_checker() {
    if(!is_plugin_active('buddypress/bp-loader.php')):
        echo '<div class="error"><p>';
        echo __('You must need to install and active <b><a href="'.site_url().'/wp-admin/plugin-install.php?tab=search&type=term&s=buddypress&plugin-search-input=Search+Plugins">
        Buddypress</strong></a> to use <strong>Buddypress Featured Member</b> plugin','bfm');
        echo '</p></div>';
    endif;
}
add_action('admin_notices', 'bfm_checker');

/*
 * Loads all BuddyPress User Account type PRO files only if BuddyPress is installed
*/
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if(is_plugin_active('buddypress/bp-loader.php')):

require_once (  BFM_INC.'bfm-functions.php'  );
require_once (  BFM_INC.'bfm-hooks.php'  );
require_once (  BFM_INC.'bfm-ajax.php'  );

// Including admin settings files
if(is_admin()) {
    require_once (  BFM_INC.'admin/admin-functions.php'   );
    require_once (  BFM_INC.'admin/admin-pages.php'     );   
}

function bfm_script_loader(){
    if(is_admin()):
        wp_enqueue_script(
                    'bfm-admin-script-js',
                    plugins_url('/lib/js/bfm-admin-script.js', __FILE__),
                    array('jquery','jquery-ui-slider')
        );
    else:
        wp_enqueue_script(
            'bfm-carouFredSel-js',
            plugins_url('/lib/js/jquery.carouFredSel-6.2.1-packed.js', __FILE__),
            array('jquery'),
            null,
            true
        );
        wp_enqueue_script(
                    'bfm-script-js',
                    plugins_url('/lib/js/bfm-script.js', __FILE__),
                    array('jquery','bfm-carouFredSel-js'),
            null,
            true
        );
    

    endif;
}
add_action('wp_enqueue_scripts', 'bfm_script_loader');
add_action('admin_enqueue_scripts','bfm_script_loader');

function bfm_style_loader(){
    wp_register_style( 'bfm-style', BFM_LIB_URL.'/css/bfm-style.css' );
    wp_enqueue_style( 'bfm-style' );
}
add_action( 'wp_enqueue_scripts', 'bfm_style_loader' );
endif;  
