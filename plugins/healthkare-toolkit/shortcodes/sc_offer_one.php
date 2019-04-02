<?php
function healthkare_offerone_outer( $atts, $content = null ) {

	extract( shortcode_atts( array( 'sc_title' => '', 'sc_desc' => '' ), $atts ) );
	
	$section_header = "";
	
	if($sc_title != "" || $sc_desc != "") {
		$section_header .= "<div class='section-header'>";
		$section_header .= "<h3>".wp_kses($sc_title, array( 'strong' => array() ) )."</h3>";
		$section_header .= wpautop($sc_desc);
		$section_header .= "</div>";
	}
	
	$result = "
	
	<!-- Offer Section -->
	<div class='offer-section container-fluid no-left-padding no-right-padding'>
		<!-- Container -->
		<div class='container'>";
			$result .= "$section_header";
			$result .= "
			<!-- Row -->
			<div class='row'>
				".do_shortcode( $content )."
			</div><!-- Row /- -->
		</div><!-- Container /- -->
	</div><!-- Offer Section -->";
	return $result;
}
add_shortcode( 'offerone_outer', 'healthkare_offerone_outer' );

function healthkare_offerone_inner( $atts, $content = null ) {

	extract( shortcode_atts( array( 'sc_image' => '', 'sc_icon' => '', 'offer_title' => '' ), $atts ) );
	
	$iconclass = $offertext = "";
	
	if($sc_icon != "") {
		$iconclass .= "<i class='".esc_attr($sc_icon)."'></i>";
	}
	
	if($offer_title != "") {
		$offertext .= "<h5>".esc_attr($offer_title)."</h5>";
	}
	
	$result = "
	<div class='col-md-4 col-sm-6 col-xs-6'>
		<div class='offer-box'>
			".wp_get_attachment_image($sc_image,"healthkare_370_180")."
			<div class='offer-content'>";
				$result .= "$iconclass";
				$result .= "$offertext";
				$result .= "
			</div>
		</div>
	</div>";
	return $result;
}
add_shortcode( 'offerone_inner', 'healthkare_offerone_inner' );

// Parent Element
function vc_offerone_outer() {

	// Register "container" content element. It will hold all your inner (child) content elements
	vc_map( array(
		"name" => esc_html__("Offer 1", "healthkare-toolkit"),
		"base" => "offerone_outer",
		"category" => esc_html__('Healthkare Theme', 'healthkare-toolkit'),
		"as_parent" => array('only' => 'offerone_inner'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		"content_element" => true,
		"show_settings_on_create" => true,
		"is_container" => true,
		"params" => array(
			// add params same as with any other content element
			array(
				"type" => "textfield",
				"heading" => esc_html__("Title", "healthkare-toolkit"),
				"param_name" => "sc_title",
				"holder" => "div",
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
add_action( 'vc_before_init', 'vc_offerone_outer' );

// Nested Element
function vc_offerone_inner() {

	vc_map( array(
		"name" => esc_html__("Offer 1", "healthkare-toolkit"),
		"base" => "offerone_inner",
		"category" => esc_html__('Healthkare Theme', 'healthkare-toolkit'),
		"content_element" => true,
		"as_child" => array('only' => 'offerone_outer'), // Use only|except attributes to limit parent (separate multiple values with comma)
		"params" => array(
			// add params same as with any other content element
			array(
				"type" => "attach_image",
				"heading" => esc_html__("Image", "healthkare-toolkit"),
				"param_name" => "sc_image",
			),
			array(
				"type" => "iconpicker",
				"heading" => esc_html__("Select Icon", "healthkare-toolkit"),
				"param_name" => "sc_icon",
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Title", "healthkare-toolkit"),
				"param_name" => "offer_title",
			),
		)
	) );
}
add_action( 'vc_before_init', 'vc_offerone_inner' );

// Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {

    class WPBakeryShortCode_Offerone_Outer extends WPBakeryShortCodesContainer {
	}
}

if ( class_exists( 'WPBakeryShortCode' ) ) {

    class WPBakeryShortCode_Offerone_Inner extends WPBakeryShortCode {
    }
}
?>