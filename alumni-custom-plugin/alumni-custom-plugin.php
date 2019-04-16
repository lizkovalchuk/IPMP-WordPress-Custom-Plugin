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

	$job_focus_data = $queried_object->geodir_job_focus;

	if($job_focus_data == "1"){
		$job_focus_data = "Health";
	}
	if($job_focus_data == "2"){
		$job_focus_data = "WATSAN";
	}
	if($job_focus_data == "3"){
		$job_focus_data = "Policy";
	}
	if($job_focus_data == "4"){
		$job_focus_data = "Shelter";
	}
	if($job_focus_data == "5"){
		$job_focus_data = "Refugees";
	}
	if($job_focus_data == "6"){
		$job_focus_data = "Food Security - Agriculture";
	}
	if($job_focus_data == "7"){
		$job_focus_data = "Logistics - Operations";
	}
	if($job_focus_data == "8"){
		$job_focus_data = "Humanitarian Assistance";
	}
	if($job_focus_data == "9"){
		$job_focus_data = "Advocacy";
	}
	if($job_focus_data == "10"){
		$job_focus_data = "Microfinance";
	}
	if($job_focus_data == "11"){
		$job_focus_data = "Economic development";
	}

	// EPERTISE AREA

	$expertise_area_data = $queried_object->geodir_expertise;

	if($expertise_area_data == "1"){
		$expertise_area_data = "Finance - Accounting";
	}
	if($expertise_area_data == "2"){
		$expertise_area_data = "Project Management";
	}
	if($expertise_area_data == "3"){
		$expertise_area_data = "Health";
	}	
	if($expertise_area_data == "4"){
		$expertise_area_data = "WATSAN";
	}
	if($expertise_area_data == "5"){
		$expertise_area_data = "Policy";
	}
	if($expertise_area_data == "6"){
		$expertise_area_data = "Advocacy";
	}
	if($expertise_area_data == "7"){
		$expertise_area_data = "Shelter";
	}
	if($expertise_area_data == "8"){
		$expertise_area_data = "Refugees";
	}
	if($expertise_area_data == "9"){
		$expertise_area_data = "Food Security - Agriculture";
	}
	if($expertise_area_data == "10"){
		$expertise_area_data = "Logistics - Operations";
	}
	if($expertise_area_data == "11"){
		$expertise_area_data = "Humanitarian Assistance";
	}
	if($expertise_area_data == "12"){
		$expertise_area_data = "Advocacy";
	}
	if($expertise_area_data == "13"){
		$expertise_area_data = "Microfinance";
	}
	if($expertise_area_data == "14"){
		$expertise_area_data = "Economic Development";
	}

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
		<script>jobFocus.innerHTML = 'Job Focus: <?php  echo $job_focus_data; ?>';</script>
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
