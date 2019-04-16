jQuery('document').ready(function($){ 
  if ($('.gd_place-template-default')[0]) {
      var url = document.location.href+"#post_map";
      document.location = url;
  }
});