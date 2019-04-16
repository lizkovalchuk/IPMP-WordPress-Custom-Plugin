<?php

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Alumni_Custom_Plugin
 * @subpackage Alumni_Custom_Plugin/includes
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if ( class_exists( 'Alumni_Custom_Profile_Activator' ) ) {
	return;
}
     
// create shortcodes for each view
function createComponent ( $component ) {
    if ( !$component ) { echo 'Must specify a component name'; return; }
    if ( file_exists( get_template_directory().'../acp/views/'.$component.'.php' ) ) {
        include( get_template_directory().'../acp/views/'.$component.'.php' );
    } elseif ( file_exists( plugin_dir_path(__FILE__).'../views/'.$component.'.php' ) ) {
        include( plugin_dir_path(__FILE__).'../views/'.$component.'.php' );
    } else {
        echo 'Component "'.$component.'" not found';
    }
}
function acpIncludeComponent ( $atts ) {
    extract( shortcode_atts( array(
        'component' => false
    ), $atts ) );
    ob_start();
    createComponent( $component );
    return ob_get_clean();
}
add_shortcode('acp_view', 'acpIncludeComponent');

