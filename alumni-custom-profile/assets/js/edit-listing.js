jQuery('document').ready(function($){  
    $("#alumni_update_listing_submit").click(function(e){
        e.preventDefault();
        var data = {
            alumni_edit_listing_post_id: $('#alumni_edit_listing_post_id').val(),
            alumni_edit_listing_post_title: $('#alumni_edit_listing_post_title').val(),
            alumni_edit_listing_post_desc: $('#alumni_edit_listing_post_desc').val(),
            alumni_edit_listing_gd_placecategory: $('#alumni_edit_listing_gd_placecategory').val(),
            alumni_edit_listing_geodir_contact: $('#alumni_edit_listing_geodir_contact').val(),            
            alumni_edit_listing_geodir_email: $('#alumni_edit_listing_geodir_email').val(),
            alumni_edit_listing_geodir_website: $('#alumni_edit_listing_geodir_website').val(),

            dataType: "json",
            action: 'editlistingform'  
        }
        console.log(data);
        $.post(ajax_object.ajax_url, data, function( response ) {
            console.log(response);
            location.reload();        
        });
    });

    $("#alumni_delete_listing_submit").click(function(e){
        e.preventDefault();
        var data = {
            alumni_delete_listing_post_id: $('#alumni_delete_listing_post_id').val(),
            dataType: "json",
            action: 'deletelistingform'
        }
        console.log(ajax_object);
        $.post(ajax_object.ajax_url, data, function( response ) {
            console.log(response); 
            window.location.href = '********* hardcoded  ***********';
        });
    });
});