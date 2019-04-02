<?php
if( !function_exists('healthkare_sc_setup') ) {

	function healthkare_sc_setup() {
		add_image_size( 'healthkare_84_84', 84, 84, true  ); /* Treatment Widget */
		
		add_image_size( 'healthkare_370_180', 370, 180, true  ); /* Best Offer Layout 1 */
		add_image_size( 'healthkare_400_683', 400, 683, true  ); /* Procedure */
		add_image_size( 'healthkare_104_104', 104, 104, true  ); /* Testimonial 2 */
		add_image_size( 'healthkare_370_250', 370, 250, true  ); /* Blog Section Style 1 && 3 */
		add_image_size( 'healthkare_370_290', 370, 290, true  ); /* Blog Section Style 3 */
		add_image_size( 'healthkare_390_390', 390, 390, true  ); /* Best Offer 2 */
		add_image_size( 'healthkare_400_483', 400, 483, true  ); /* Special Features */
		add_image_size( 'healthkare_419_276', 419, 276, true  ); /* Special Features 2 */
		add_image_size( 'healthkare_270_350', 270, 350, true  ); /* Team Layout 1 & 2 */
		add_image_size( 'healthkare_260_337', 260, 337, true  ); /* Team Layout 3 */
		add_image_size( 'healthkare_270_320', 270, 320, true  ); /* Team Layout 4 */
		add_image_size( 'healthkare_270_240', 270, 240, true  ); /* Treatment Gallary 1 && 4 column with Pagination */
		add_image_size( 'healthkare_373_373', 373, 373, true  ); /* Treatment Gallary 2 */
		add_image_size( 'healthkare_370_240', 370, 240, true  ); /* Treatment Gallary 3 && pagination */
		add_image_size( 'healthkare_370_248', 370, 248, true  ); /* Department */
		add_image_size( 'healthkare_850_350', 850, 350, true  ); /* Blog Page 1 */
		add_image_size( 'healthkare_335_310', 335, 310, true  ); /* Blog Page 2 */
		add_image_size( 'healthkare_720_436', 720, 436, true  ); /* QUALITY */
	}
	add_action( 'after_setup_theme', 'healthkare_sc_setup' );
}

function healthkare_currentYear() {
    return date('Y');
}
add_shortcode( 'year', 'healthkare_currentYear' );

if( function_exists('vc_map') ) {

	vc_add_param("vc_row", array(
		"type" => "dropdown",
		"group" => "Page Layout",
		"class" => "",
		"heading" => "Type",
		"param_name" => "type",
		'value' => array(
			esc_html__( 'Default', "healthkare-toolkit" ) => 'default-layout',
			esc_html__( 'Fixed', "healthkare-toolkit" ) => 'container',
		),
	));

	vc_add_param("vc_column", array(
		"type" => "dropdown",
		"group" => "Section Padding",
		"class" => "",
		"heading" => "Section Left Padding",
		"param_name" => "cnt_lspacing",
		'value' => array(
			esc_html__( 'Yes', "healthkare-toolkit" ) => 'yes',
			esc_html__( 'No', "healthkare-toolkit" ) => 'no',
		),
	));

	vc_add_param("vc_column", array(
		"type" => "dropdown",
		"group" => "Section Padding",
		"class" => "",
		"heading" => "Section Right Padding",
		"param_name" => "cnt_rspacing",
		'value' => array(
			esc_html__( 'Yes', "healthkare-toolkit" ) => 'yes',
			esc_html__( 'No', "healthkare-toolkit" ) => 'no',
		),
	));

	vc_add_param("vc_column", array(
		"type" => "dropdown",
		"group" => "Section Padding",
		"class" => "",
		"heading" => "Section Bottom Padding",
		"description" => "Required for Visual Composer Default Elements.",
		"param_name" => "cnt_spacing",
		'value' => array(
			esc_html__( 'Yes', "healthkare-toolkit" ) => 'yes',
			esc_html__( 'No', "healthkare-toolkit" ) => 'no',
		),
	));

	/* Include all individual shortcodes. */
	$prefix_sc = "sc_";

	require_once( $prefix_sc . "quality.php");	
	require_once( $prefix_sc . "ourmission.php");
	require_once( $prefix_sc . "features.php");	
	require_once( $prefix_sc . "newsletter.php");
	require_once( $prefix_sc . "procedure.php");
	require_once( $prefix_sc . "gallery.php");
	require_once( $prefix_sc . "work.php");
	require_once( $prefix_sc . "blog.php");
	require_once( $prefix_sc . "footer_cntdetail.php");
	require_once( $prefix_sc . "departments.php");
	require_once( $prefix_sc . "counter.php");
	require_once( $prefix_sc . "callout.php");
	require_once( $prefix_sc . "client.php");
	require_once( $prefix_sc . "appoinmentform.php");
	require_once( $prefix_sc . "pricetable.php");
	require_once( $prefix_sc . "contactform.php");
	require_once( $prefix_sc . "googlemap.php");
	require_once( $prefix_sc . "faq.php");
	require_once( $prefix_sc . "welcome.php");
	require_once( $prefix_sc . "blog_listing.php");
	require_once( $prefix_sc . "image.php");
	
	/***************************/
	require_once( $prefix_sc . "offer_one.php");
	require_once( $prefix_sc . "offer_two.php");
	require_once( $prefix_sc . "offer_three.php");
	require_once( $prefix_sc . "testimonial_one.php");
	require_once( $prefix_sc . "testimonial_two.php");
	require_once( $prefix_sc . "testimonial_three.php");
	require_once( $prefix_sc . "team_one.php");
	require_once( $prefix_sc . "team_two.php");
	require_once( $prefix_sc . "team_three.php");
	require_once( $prefix_sc . "team_four.php");
	require_once( $prefix_sc . "featuresthree.php");
	require_once( $prefix_sc . "features-two.php");
}