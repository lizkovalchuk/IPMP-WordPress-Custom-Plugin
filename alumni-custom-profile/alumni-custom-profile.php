<?php

/**
 *
 * @link              http://lizk.ca
 * @since             1.0.0
 * @package           Alumni Custom Plugin
 *
 * @wordpress-plugin
 * Plugin Name:       Alumni Custom Profiles
 * Plugin URI:        http://lizk.ca
 * Description:       Enable users to edit their posted listing via their profile.
 * Version:           1.0.0
 * Author:            Liz Kovalchuk.
 * Author URI:        http://lizk.ca
 * License:           
 * Copyright: 		  Liz Kovalchuk 
 */


require_once( plugin_dir_path(__FILE__).'actions/update_details.php' );
require_once( plugin_dir_path(__FILE__).'actions/edit_listing.php' );


// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Current plugin version.
 */
define( 'ALUMNI_CUSTOM_PROFILE', '1.0.0' );

/**
 * Plugin Basename
 */
define( 'ACP_BASENAME', plugin_basename(__FILE__));

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-alumni-custom-profile-activator.php
 */

function activate_alumni_custom_profile() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-alumni-custom-profile-activator.php';
	Alumni_Custom_Profile_Activator::activate();
}

register_activation_hook( __FILE__, 'activate_alumni_custom_profile' );
require_once plugin_dir_path( __FILE__ ) . 'includes/class-alumni-custom-profile-activator.php';


function add_custom_scriptsACP(){
	wp_enqueue_style('profile-css', plugins_url() . '/alumni-custom-profile/assets/css/profile.css', 10, 99);	
	wp_enqueue_script('profile-js', plugins_url() . '/alumni-custom-profile/assets/js/profile.js', array('jquery'));
}

add_action('wp_enqueue_scripts', 'add_custom_scriptsACP');



/*-----------------------------------------------------------*\
    *3. Enqueue AJAX
\*-----------------------------------------------------------*/

// This functions loads the javascript file
// as well as sends the AJAX object to the 
// corresponding back-end file which processes
// the AJAX object.


wp_register_script('profile-js', plugins_url( '/assets/js/profile.js', __FILE__ ) );

function enqueue_AJAX() {  

    wp_enqueue_script('profile-js', plugins_url( '/assets/js/profile.js', __FILE__ ), array('jquery') );
	wp_localize_script('profile-js', 'ajax_object', array( 'ajax_url' => admin_url("admin-ajax.php"), 'nonce' => wp_create_nonce('ajax-nonce')));

	wp_enqueue_script('edit-listing-js', plugins_url( '/assets/js/edit-listing.js', __FILE__ ), array('jquery') );
	wp_localize_script('edit-listing-js', 'ajax_object', array( 'ajax_url' => admin_url("admin-ajax.php"), 'nonce' => wp_create_nonce('ajax-nonce')));

}

add_action( 'wp_enqueue_scripts', 'enqueue_AJAX' );
