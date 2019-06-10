<?php
/*
Plugin Name:  Alumni Network Functions
Plugin URI:   https://ipmpalumninetwork.ca
Description:  Customize Theme
Version:      1.0.0
Author:       Liz Kovalchuk
Author URI:
*/

function add_custom_scripts(){
	wp_enqueue_style('alumni-home-page-css', plugins_url() . '/alumni-custom-plugin/assets/css/home-page.css', 10, 99);
	wp_enqueue_style('details-page', plugins_url() . '/alumni-custom-plugin/assets/css/single-listing.css', 10, 99);
	wp_enqueue_style('add-listing-css', plugins_url() . '/alumni-custom-plugin/assets/css/add-listing.css', 10, 99);
	wp_enqueue_style('edit-listing-css', plugins_url() . '/alumni-custom-plugin/assets/css/edit-listing.css', 10, 99);
	wp_enqueue_style('add-login-css', plugins_url() . '/alumni-custom-plugin/assets/css/login.css', 10, 99);
	wp_enqueue_style('alumni-registration-css', plugins_url() . '/alumni-custom-plugin/assets/css/registration.css', 10, 99);
	wp_enqueue_style('alumni-single-listing-css', plugins_url() . '/alumni-custom-plugin/assets/css/single-listing.css', 10, 99);
	wp_enqueue_style('alumni-search-css', plugins_url() . '/alumni-custom-plugin/assets/css/alumni-search.css', 10, 99);
	wp_enqueue_style('alumni-publish-listing-css', plugins_url() . '/alumni-custom-plugin/assets/css/publish-listing.css', 10, 99);
	wp_enqueue_script('alumni-add-listing-js', plugins_url() . '/alumni-custom-plugin/assets/js/add-listing.js', array('jquery'));
	wp_enqueue_script('alumni-edit-listing-js', plugins_url() . '/alumni-custom-plugin/assets/js/edit-listing.js', array('jquery'));
	wp_enqueue_script('alumni-registration-js', plugins_url() . '/alumni-custom-plugin/assets/js/registration.js', array('jquery'));
	wp_enqueue_script('alumni-login-js', plugins_url() . '/alumni-custom-plugin/assets/js/login.js', array('jquery'));
	wp_enqueue_script('alumni-home-page-js', plugins_url() . '/alumni-custom-plugin/assets/js/homepage.js', array('jquery'));
	wp_enqueue_script('single-place', plugins_url() . '/alumni-custom-plugin/assets/js/single-place.js', array('jquery'));
}

add_action('wp_enqueue_scripts', 'add_custom_scripts');

// Add extra data to Listing Details

function extra_data_function() {  

	$page_id = get_queried_object_id();
	$queried_object = get_queried_object();
	$author_id_string = $queried_object->post_author;
	$author_id = (int)$author_id_string;

	global $wpdb;
	$linkedIn_data = $wpdb->get_results( "SELECT meta_value FROM `********* Table  ***********` 
									WHERE meta_key = 'linkedin' AND user_id = " . $author_id . "									  									 
									;");

	$linkedIn_data2 = $linkedIn_data[0];
	$linkedIn_data3 = $linkedIn_data2->meta_value;

	// JOB FOCUS

	$job_focus_key = $queried_object->geodir_job_focus;
   	$job_focuses = array("1" => "Health", 
                     "2" => "WATSAN",
                     "3" => "Policy",
                     "4" => "Shelter",
		     "5" => "Refugees",
	             "6" => "Food Security - Agriculture",
		     "7" => "Logistics - Operations",
		     "8" => "Humanitarian Assistance",
		     "9" => "Advocary",
	 	     "10" => "Microfinance",
		     "11" => "Economic development"
   	);

      $job_focus_value = array_key_exists($job_focus_key, $job_focuses) ? $job_focuses[$job_focus_key] : null;

	// EPERTISE AREA

	$expertise_area_key = $queried_object->geodir_expertise;
	$expertise_areas = array("1" => "Finance - Accounting", 
                     "2" => "Project Management",
                     "3" => "Health",
                     "4" => "WATSAN",
		     "5" => "Policy",
	             "6" => "Advocacy",
		     "7" => "Shelter",
		     "8" => "Refugees",
		     "9" => "Logistics - Operations",
	 	     "10" => "Microfinance",
		     "11" => "Humanitarian Assistance",
		     "12" => "Advocacy",
		     "13" => "Microfinance",
		     "14" => "Ecomonic Development"
   	);
	
	$expertise_area_value = array_key_exists($expertise_area_key, $expertise_areas) ? $expertise_areas[$expertise_area_key] : null;

	// LISTING DESCRIPTION

	$listing_description = $queried_object->post_content;

	?>	

	<!-- EXPERTISE AREA -->

	<script> expertiseArea = document.createElement('p'); </script>
	<?php if($expertise_area_data !== null || $expertise_area_data == "0") : ?>
		<script> expertiseArea.innerHTML = 'Alumni Expertise Area: <?php echo $expertise_area_data; ?>';</script>
	<?php else : ?>
		<script>expertiseArea.innerHTML = 'Alumni Expertise Area: Alumni has not speficied expertise area';</script>
	<?php endif; ?>
	<script>document.querySelector("#geodir_content > article > .geodir_post_taxomomies > span").appendChild(expertiseArea);</script>
	
	<!-- JOB FOCUS -->

	<script>jobFocus = document.createElement('p');</script>
	<?php if($job_focus_data !== null || $job_focus_data == "0") :?>
		<script>jobFocus.innerHTML = 'Job Focus: <?php  echo $job_focus_value; ?>';</script>
	<?php else : ?>
		<script>jobFocus.innerHTML = 'Job Focus: Alumni has not speficied job focus'; </script>
	<?php endif; ?>
	<script>	
		jobFocus.style = "margin-top: -5px;"
		document.querySelector("#geodir_content > article > .geodir_post_taxomomies > span").appendChild(jobFocus);	
	</script>
	
	<!-- JOB DESCRIPTION -->
	
	<script>jobDescription = document.createElement('p');</script>
	<?php if($listing_description !== null || $listing_description !== '') :?>
		<script>jobDescription.innerHTML = 'Job Description: <?php  echo $listing_description; ?>';</script>
	<?php else : ?>
		<script>jobDescription.innerHTML = 'Job Description: Alumni has not speficied job description';</script>
	<?php endif; ?>	
	<script>
		jobDescription.style = "margin-top: -5px;"
		document.querySelector("#geodir_content > article > .geodir_post_taxomomies > span").appendChild(jobDescription);	
	</script>

	<!-- LINKEDIN -->

	<?php if($linkedIn_data3 !== null) : ?>
		<script>
			linkedInLink = document.createElement('a');
			linkedInLink.innerHTML = 'Click here to contact IPMP alumni on LinkedIn';
			linkedInLink.setAttribute('title', 'LinkedIn');
			linkedInLink.setAttribute('href', 'http://<?php echo $linkedIn_data3; ?>');			
			document.querySelector("#geodir_content > article > .geodir_post_taxomomies > span").appendChild(linkedInLink);
		</script>
	<?php endif;
}

add_action( 'wp_footer', 'extra_data_function' );
