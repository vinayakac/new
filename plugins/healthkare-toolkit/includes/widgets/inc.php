<?php
/* Widget Register / UN-register */
function healthkare_manage_widgets() {

	/* Contact Details */
	require_once("contact_details.php");
	register_widget( 'Healthkare_Widget_ContactDetails' );
	
	/* Working Time */
	require_once("working_time.php");
	register_widget( 'Healthkare_Widget_WorkingTime' );
	
	/* About Us */
	require_once("aboutus.php");
	register_widget( 'Healthkare_Widget_AboutUs' );
	
	/* Department */
	require_once("department.php");
	register_widget( 'Healthkare_Widget_Department' );
	
	/* Treatments */
	require_once("treatments.php");
	register_widget( 'Healthkare_Widget_Treatments' );
	
	/* Contact Link */
	require_once("contact_link.php");
	register_widget( 'Healthkare_Widget_ContactLink' );
	
}
add_action( 'widgets_init', 'healthkare_manage_widgets' );