jQuery('document').ready(function($){  
    $(".page-id-466 > #ds-container > .container > .row > .col-lg-8").removeClass("col-lg-8 col-md-9");
    $("#alumni_profile_update_submit").click(function(e){
        e.preventDefault();

        var validation = true;
        var emailValidation = pattern = new RegExp(/^(("[\w-\s]+")|([\w-]+(?:\.[\w-]+)*)|("[\w-\s]+")([\w-]+(?:\.[\w-]+)*))(@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][0-9]\.|1[0-9]{2}\.|[0-9]{1,2}\.))((25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\.){2}(25[0-5]|2[0-4][0-9]|1[0-9]{2}|[0-9]{1,2})\]?$)/i);
        var linkedinValidation = pattern = new RegExp(/www.linkedin.com/);
        
        if( $('#alumni_profile_user_firstname').val() == '' || $('#alumni_profile_user_firstname').val() == null ){
            validation = false;
            if(validation == false){
                $('#alumni_profile_user_firstname_span').append("<p style='color:red;'>This field cannot be left blank</p>");
            }
        }

        else if( $('#alumni_profile_user_lastname').val() == '' || $('#alumni_profile_user_lastname').val() == null ){
            validation = false;
            if(validation == false){
                $('#alumni_profile_user_lastname_span').append("<p style='color:red;'>This field cannot be left blank</p>");
            }
        }

        else if( $('#alumni_profile_user_email').val() == '' || $('#alumni_profile_user_email').val() == null || emailValidation.test($('#alumni_profile_user_email').val()) == false ){
            validation = false;
            if(validation == false){
                $('#alumni_profile_user_email_span').append("<p style='color:red;'>Please enter a valid email</p>");
            }
        }
        
        else if( $('#alumni_profile_linkedin').val() == '' || $('#alumni_profile_linkedin').val() == null || linkedinValidation.test($('#alumni_profile_linkedin').val()) == false ){
            validation = false;
            if(validation == false){
                $('#alumni_profile_linkedin_span').append("<p style='color:red;'>Please enter a valid LinkedIn URL</p>");
            }
        }

        if(validation == false){

        } else if (validation == true) {
            var data = {
                alumni_profile_user_firstname: $('#alumni_profile_user_firstname').val(),
                alumni_profile_user_lastname: $('#alumni_profile_user_lastname').val(),
                alumni_profile_user_email: $('#alumni_profile_user_email').val(),
                alumni_profile_linkedin: $('#alumni_profile_linkedin').val(),
                dataType: "json",
                action: 'commentform'
            }
        }
        $.post(ajax_object.ajax_url, data, function( response ) {
            location.reload();        
        });        
    });
});
  
  
  