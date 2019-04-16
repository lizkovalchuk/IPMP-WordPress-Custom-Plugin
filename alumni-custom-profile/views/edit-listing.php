<?php

$id = isset($_GET['post_id']) ? $_GET['post_id'] : "";

require_once plugin_dir_path( __FILE__ ) . '../actions/edit_listing.php';
require_once plugin_dir_path( __FILE__ ) . '../includes/class-alumni-custom-user-data.php';
$listing = Alumni_Custom_User_Data::listing($id);
$content = Alumni_Custom_User_Data::post_content($id);


if ($listing[0]->default_category == "27"){
    $category = "Student on Placement";
} elseif ($listing[0]->default_category == "28"){
    $category = "Humber Projects";
}  elseif ($listing[0]->default_category == "25"){
    $category = "Working";
}   

?>


<div id="geodir_wrapper" class="">
    <div class="clearfix geodir-common">
        <div id="geodir_content" class="unique-class-for-edit-listing-page" role="main"  >
            <form name="propertyform" id="editlistingform" action="<?php echo admin_url('admin-ajax.php'); ?>" method="post">
                <input type="hidden" name="action" value="alumni_update_listing"> 
                <input type="hidden" name="action" value="alumni_delete_listing">  
                <input type="hidden" name="data" value="alumni_update_listing_id">
                <input type="hidden" name="alumni_edit_listing_post_id" id="alumni_edit_listing_post_id" value="<?php echo $id ?>">
                <div id="geodir_post_title_row" class="required_field geodir_form_row clearfix gd-fieldset-details">
                    <label>Place Title</label>
                    <input type="text" field_type="text" name="post_title" id="alumni_edit_listing_post_title" class="geodir_textfield" value="<?php echo $content[0]->post_title; ?>"/>
                    <span class="geodir_message_error"></span>
                </div>
                <div id="geodir_post_desc_row" class="geodir_form_row clearfix gd-fieldset-details required_field">
                    <label>Place Description</label>
                    <textarea field_type="textarea" name="post_desc" id="alumni_edit_listing_post_desc" class="geodir_textarea" maxlength=""><?php echo $content[0]->post_content; ?></textarea>
                    <span class="geodir_message_error"></span>
                </div>
                <div id="gd_placecategory_row" class="required_field geodir_form_row clearfix gd-fieldset-details">
                    <label>Category</label>
                    <div id="gd_placecategory" class="geodir_taxonomy_field" style="float:left; width:70%;">
                        <div class="main_cat_list" style="  ">
                            <select field_type="select" id="alumni_edit_listing_gd_placecategory" class="chosen_select"   option-ajaxChosen="false" >                              
                                <option value="<?php echo $category; ?>"  ><?php echo $category; ?></option>
                                <option   alt="gd_placecategory" title="Humber Projects" value="28" _hc="f" >Humber Projects</option>
                                <option   alt="gd_placecategory" title="Student on Placement" value="27" _hc="f" >Student on Placement</option>
                                <option   alt="gd_placecategory" title="Working Alumni" value="25" _hc="f" >Working Alumni</option>
                            </select>        
                        </div>
                    </div>
                <span class="geodir_message_error"></span>
                </div>
                <div id="geodir_contact_row" class=" geodir_form_row clearfix gd-fieldset-details">
                    <label>Phone</label>
                    <input field_type="phone" name="geodir_contact" id="alumni_edit_listing_geodir_contact" value="<?php  echo $listing[0]->geodir_contact;?>" type="tel" class="geodir_textfield"/>                    
                </div>
                <div id="geodir_email_row" class=" geodir_form_row clearfix gd-fieldset-details">
                    <label>Email</label>
                    <input field_type="email" name="geodir_email" id="alumni_edit_listing_geodir_email" value="<?php  echo $listing[0]->geodir_email;?>" type="email" class="geodir_textfield"/>                    
                </div>
                <div id="geodir_website_row" class=" geodir_form_row clearfix gd-fieldset-details">
                    <label>Website</label>
                    <input field_type="url" name="geodir_website" id="alumni_edit_listing_geodir_website"
                        value="<?php  echo $listing[0]->geodir_website;?>" type="url" class="geodir_textfield"
                        oninvalid="setCustomValidity('Please enter a valid URL including http://')"
                        onchange="try{setCustomValidity('')}catch(e){}"
                    />                    
                </div>
                <div id="geodir_accept_term_condition_row" class="required_field geodir_form_row clearfix">
                    <span class="geodir_message_error"></span>
                </div>


                <div id="geodir-add-listing-submit" class="geodir_form_row clear_both" style="padding:2px;text-align:center;">
                    <input type="button" value="Update Listing" class="geodir_button" id="alumni_update_listing_submit"/>

                </div>
            </form>
            <form name="propertyform" id="deletelistingform" action="<?php echo admin_url('admin-ajax.php'); ?>" method="post">                
                <input type="hidden" name="action" value="alumni_delete_listing">  
                <input type="hidden" name="alumni_delete_listing_post_id" id="alumni_delete_listing_post_id" value="<?php echo $id ?>">
                <input type="button" value="Delete Listing" class="geodir_button" id="alumni_delete_listing_submit"/>
            </form>
        </div><!-- content ends here-->
    </div>
</div><!-- content ends here-->  
