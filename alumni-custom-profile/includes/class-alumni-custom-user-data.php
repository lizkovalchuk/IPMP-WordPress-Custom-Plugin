<?php

/**
 * Returns data needed for Custom Profile.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Alumni_Custom_Profile
 * @subpackage Alumni_Custom_Plugin/includes
 */

// Don't load directly
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

if ( class_exists( 'Alumni_Custom_User_Data' ) ) {
	return;
}

class Alumni_Custom_User_Data {
	/**
	 * Returns data list of user places 
	 *
	 * @since    1.0.0
	 */

	public static function places() {
        $user_id = get_current_user_id();
        $args = array(
            'post_type' => 'gd_place',
            'author' => $user_id
        );
		$query = new WP_Query( $args );
		return $query;
	}

	/**
	 * Returns data for selected single entry
	 *
	 * @since    1.0.0
	 */

	public static function listing($id){
		global $wpdb;
		$data = $wpdb->get_results( "SELECT * FROM `********* Table  ***********` 
									 WHERE post_id = " . $id .";");
		return $data;
	}

	/**
	 * Returns post content for selected single entry
	 *
	 * @since    1.0.0
	 */

	public static function post_content($id){
		global $wpdb;
		$data = $wpdb->get_results( "SELECT post_title, post_content FROM `********* Table  ***********` 
									 WHERE ID = " . $id .";");
		return $data;
	}

	/**
	 * Returns user data
	 *
	 * @since    1.0.0
	 */

	public static function linkedIn($id){
		global $wpdb;
		$data = $wpdb->get_results( "SELECT meta_value FROM `********* Table  ***********` 
									 WHERE user_id = " . $id ." " . 
									 "AND meta_key = 'linkedin' 
									 ;");
		return $data;
	}

	public static function first_name($id){
		global $wpdb;
		$data = $wpdb->get_results( "SELECT meta_value FROM `********* Table  ***********` 
									 WHERE user_id = " . $id ." " .
									 "AND meta_key = 'first_name'									  
									 ;");
		return $data;
	}

	public static function last_name($id){
		global $wpdb;
		$data = $wpdb->get_results( "SELECT meta_value FROM `********* Table  ***********` 
									 WHERE user_id = " . $id ." " .									 									  
									 "AND meta_key = 'last_name'
									 ;");
		return $data;
	}
}