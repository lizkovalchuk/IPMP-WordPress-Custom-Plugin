<?php

add_action('wp_ajax_editlistingform', 'alumni_update_listing');
add_action('wp_ajax_deletelistingform', 'alumni_delete_listing');

function alumni_update_listing(){
 		
	global $wpdb;
    $user_ID = get_current_user_id();
    $post_ID = get_the_ID();

	//Variables from form

    $id = $_POST['alumni_edit_listing_post_id'];
	$title = $_POST['alumni_edit_listing_post_title'];
	$post_desc = $_POST['alumni_edit_listing_post_desc'];
	$category = $_POST['alumni_edit_listing_gd_placecategory'];
    $phone = $_POST['alumni_edit_listing_geodir_contact'];
    $email = $_POST['alumni_edit_listing_geodir_email'];
    $website = $_POST['alumni_edit_listing_geodir_website'];


    var_dump("1. ".$title);
    var_dump("2. ".$post_desc);
    var_dump("3. ".$category);
    var_dump("8. ".$phone);
    var_dump("9. ".$email);
    var_dump("10. ".$website);
    var_dump("POST ID: " . $id);

    
    global $wpdb;
    $wpdb->update( 
        '********* Table  ***********', 
        array( 
            'default_category' => $category,
            'geodir_contact' => $phone,
            'geodir_email' => $email,
            'geodir_website' => $website
        ), 
        array( 'post_id' => $id )
    );

    global $wpdb;
    $wpdb->update( 
        '********* Table  ***********', 
        array( 
            'post_title' => $title,	
        ), 
        array( 'ID' => $id )
    );
}

function alumni_delete_listing(){

    var_dump("common");

    $id = $_POST['alumni_delete_listing_post_id'];

    var_dump($id);

    global $wpdb;

    $wpdb->delete( '********* Table  ***********', 
        array( 'post_id' => $id ) 
    );

    $wpdb->delete( '********* Table  ***********', array( 'ID' => $id ) );

}