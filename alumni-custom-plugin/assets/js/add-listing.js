
jQuery('document').ready(function($){
    $("#geodir_content > header > h1").replaceWith( "<h1>Add Listing</h1>" );

    if ($('.gd_place-template-default')[0]) {
        window.onbeforeunload = function () {
          window.scrollTo(0, 0);
        }
    } 
});