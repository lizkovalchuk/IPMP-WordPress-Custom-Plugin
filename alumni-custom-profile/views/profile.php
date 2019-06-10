<?php

$user_id = get_current_user_id();
$user = new WP_User( $user_id ); 

require_once plugin_dir_path( __FILE__ ) . '../actions/update_details.php';
require_once plugin_dir_path( __FILE__ ) . '../includes/class-alumni-custom-user-data.php';
$results = Alumni_Custom_User_Data::places();
$linkedin = Alumni_Custom_User_Data::linkedIn($user_id);
$first_name = Alumni_Custom_User_Data::first_name($user_id);
$last_name = Alumni_Custom_User_Data::last_name($user_id);

?>

<h3 id="custom-profile-hello-message">Hello <?php echo $first_name[0]->meta_value?>!</h3>

<?php

if($results->have_posts() == true){
   echo "<h2>Listings</h2>";
}

while ( $results->have_posts() ) {
    $results->the_post();
    $id = get_the_ID();
    $post = get_post($id);
    $post_meta = get_post_meta($id, '', false);
    $title = get_the_title();

    global $wpdb;
    $listing_data = $wpdb->get_results( "SELECT gd_placecategory, post_city , post_region, post_country  FROM `*****table*****` 
                            WHERE post_id = $id;");

   $country = $listing_data[0]->post_country;
   $region = $listing_data[0]->post_region;
   $city = $listing_data[0]->post_city;

   $category_key = $listing_data[0]->gd_placecategory;
   $categories = array(",25," => "alumni_work", 
                     ",27," => "student",
                     ",28," => "humber_projects",
                     ",56," => "archive"
   );

   $category_value = array_key_exists($category_key, $categories) ? $categories[$category_key] : null;
?>

<fieldset>
    <h3>Title: <?php echo $title ?></h3>
    <p>Description: <?php echo get_the_excerpt()?></p>
    <a class="profile-edit-listing-button" href="<?php echo home_url('edit-listing') . "?post_id=" . $id ;?>">Edit</a>  
</fieldset> 

<?php
}

?>
<h2 style="margin-top: 55px;">Profile Details</h2>
<div id="comments" class="comments-area normal-comments">
    <div id="respond" class="comment-respond">  
         <form action="<?php echo admin_url('admin-ajax.php'); ?>"  method="post" id="commentform" class="comment-form">	              
            <input type="hidden" name="action" value="alumni_update_profile">  
            <input type="hidden" name="data" value="alumni_update_profile_id">
            <div class="input-group fixed-width">
               <span id="alumni_profile_user_firstname_span" class="input-group-addon">First Name:</span>
               <input name="alumni_profile_user_firstname" id="alumni_profile_user_firstname" type="text" value="<?php echo $first_name[0]->meta_value; ?>" />
            </div>     
            <div class="input-group fixed-width">
               <span id="alumni_profile_user_lastname_span" class="input-group-addon">Last Name:</span>
               <input name="alumni_profile_user_lastname" id="alumni_profile_user_lastname" type="text" value="<?php echo $last_name[0]->meta_value; ?>" />
            </div>      
            <div class="input-group fixed-width">
               <span id="alumni_profile_user_email_span" class="input-group-addon">Email:</span>
               <input name="alumni_profile_user_email" id="alumni_profile_user_email" type="text" value="<?php echo $user->user_email; ?>" />
            </div>   
            <div class="input-group fixed-width">
               <span id="alumni_profile_linkedin_span" class="input-group-addon">LinkedIn:</span>                 
               <input name="alumni_profile_linkedin" id="alumni_profile_linkedin" type="text" value="<?php echo $linkedin[0]->meta_value; ?>" />
            </div> 
            <div class="input-group fixed-width">
	      <div class="input-group-addon">				
		 <input name="alumni_profile_update_submit" type="submit" value="Update" id="alumni_profile_update_submit" />				    
	      </div>
	   </div>	                    
        </form>
    </div>
</div>








