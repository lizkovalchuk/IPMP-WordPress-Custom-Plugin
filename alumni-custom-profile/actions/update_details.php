<?php

add_action('wp_ajax_commentform', 'alumni_update_profile');

function alumni_update_profile(){
		
	global $wpdb;
	$user_ID = get_current_user_id();

	//Variables from form

	$first_name = $_POST['alumni_profile_user_firstname'];
	$last_name = $_POST['alumni_profile_user_lastname'];
	$email = $_POST['alumni_profile_user_email'];
	$linkedIn = $_POST['alumni_profile_linkedin'];

	update_user_meta( $user_ID, 'first_name', $first_name);
	update_user_meta( $user_ID, 'last_name', $last_name);
	wp_update_user( array('ID' => $user_ID, 'user_email' => $email) );
	update_user_meta( $user_ID, 'linkedin', $linkedIn);

	wp_redirect( home_url().'/profile' );

}


