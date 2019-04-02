<?php
function healthkare_offerthree_outer( $atts, $content = null ) {

	extract( shortcode_atts( array( 'sc_title' => '', 'sc_desc' => '' ), $atts ) );
	
	$section_header = "";
	
	if($sc_title != "" || $sc_desc != ""){
		$section_header .= "<div class='section-header3'>";
		$section_header .= "<h3>".wp_kses($sc_title, array( 'strong' => array() ) )."</h3>";
		$section_header .= wpautop($sc_desc);
		$section_header .= "</div>";
	}
	
	$result = "
	
	<!-- Best Section -->
	<div class='best-section container-fluid no-left-padding no-right-padding'>
		<!-- Container -->
		<div class='container'>";
			$result .= "$section_header";
			$result .= "
			<!-- Row -->
			<div class='row'>
				".do_shortcode( $content )."
			</div><!-- Row /- -->
		</div><!-- Container -->
	</div><!-- Best Section /- -->";
	return $result;
}
add_shortcode( 'offerthree_outer', 'healthkare_offerthree_outer' );

function healthkare_offerthree_inner( $atts, $content = null ) {

	extract( shortcode_atts( array( 'sc_icon'=> '', 'offer_desc'=> '', 'offer_title'=> ''  ), $atts ) );
	
	$iconclass = $offertext = "";
	
	if($sc_icon != "") {
		$iconclass .= "<i class='".esc_attr($sc_icon)."'></i>";
	}
	
	if($offer_title != "") {
		$offertext .= "<span>".esc_attr($offer_title)."</span>";
	}
	
	$result = "
	
	<div class='col-md-3 col-sm-4 col-xs-6'>
		<div class='best-box'>";
			$result .= "$iconclass";
			$result .= "
			".wpautop($offer_desc)."
				";
			$result .= "$offertext";
			$result .= "
		</div>
	</div>";
	return $result;
}
add_shortcode( 'offerthree_inner', 'healthkare_offerthree_inner' );

// Parent Element
function vc_offerthree_outer() {

	// Register "container" content element. It will hold all your inner (child) content elements
	vc_map( array(
		"name" => esc_html__("Offer 3", "healthkare-toolkit"),
		"base" => "offerthree_outer",
		"category" => esc_html__('Healthkare Theme', 'healthkare-toolkit'),
		"as_parent" => array('only' => 'offerthree_inner'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		"content_element" => true,
		"show_settings_on_create" => true,
		"is_container" => true,
		"params" => array(
			// add params same as with any other content element
			array(
				"type" => "textfield",
				"heading" => esc_html__("Title", "healthkare-toolkit"),
				"param_name" => "sc_title",
			),
			array(
				"type" => "textarea",
				"heading" => esc_html__("Short Description", "healthkare-toolkit"),
				"param_name" => "sc_desc",
			),
		),
		"js_view" => 'VcColumnView'
	) );
}
add_action( 'vc_before_init', 'vc_offerthree_outer' );

// Nested Element
function vc_offerthree_inner() {

	vc_map( array(
		"name" => esc_html__("Offer 3", "healthkare-toolkit"),
		"base" => "offerthree_inner",
		"category" => esc_html__('Healthkare Theme', 'healthkare-toolkit'),
		"content_element" => true,
		"as_child" => array('only' => 'offerthree_outer'), // Use only|except attributes to limit parent (separate multiple values with comma)
		"params" => array(
			// add params same as with any other content element
			array(
				"type" => "iconpicker",
				"heading" => esc_html__("Select Icon", "healthkare-toolkit"),
				"param_name" => "sc_icon",
			),
			array(
				"type" => "textarea",
				"heading" => esc_html__("Description", "healthkare-toolkit"),
				"param_name" => "offer_desc",
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Title", "healthkare-toolkit"),
				"param_name" => "offer_title",
			),
		)
	) );
}
add_action( 'vc_before_init', 'vc_offerthree_inner' );

// Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {

    class WPBakeryShortCode_Offerthree_Outer extends WPBakeryShortCodesContainer {
	}
}

if ( class_exists( 'WPBakeryShortCode' ) ) {

    class WPBakeryShortCode_Offerthree_Inner extends WPBakeryShortCode {
    }
}
?>