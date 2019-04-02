<?php
function healthkare_client_outer( $atts, $content = null ) {

	extract( shortcode_atts( array( 'sc_layout' => 'one', 'sc_bg' => '' ), $atts ) );
	
	if($sc_layout == "one") {
		$col_md = "clients clients2 clients-skyblue";
	}
	elseif($sc_layout == "two") {
		$col_md = "clients";
	}
	else {
		$col_md = "clients clients2 clients-skyblue";
	}
	
	if( $sc_bg != "" ){
		$style = " style='background-image: url(".wp_get_attachment_url( $sc_bg ).");'";
	}
	else{
		$style = "";
	}
	
	$result = "
	
	<!-- Clients -->
	<div class='".esc_attr($col_md)." container-fluid no-left-padding no-right-padding'".html_entity_decode( $style ).">
		<!-- Container -->
		<div class='container'>
			<div class='clients-carousel'>
				".do_shortcode( $content )."
			</div>
		</div><!-- Container -->
	</div><!-- Clients -->";
	return $result;
}
add_shortcode( 'client_outer', 'healthkare_client_outer' );

function healthkare_client_inner( $atts, $content = null ) {

	extract( shortcode_atts( array( 'sc_image'=> '', 'sc_url'=> ''  ), $atts ) );
	
	$partner_txt = "";
	
	if($sc_image != "" && $sc_url != "") {
		$partner_txt .= "<div class='col-md-12 item'>";
		$partner_txt .= "<a href='".esc_url($sc_url)."'>";
		$partner_txt .= wp_get_attachment_image($sc_image,"full");
		$partner_txt .= "</a>";
		$partner_txt .= "</div>";
	}
	elseif($sc_image != "") {
		$partner_txt .= "<div class='col-md-12 item'>";
		$partner_txt .= wp_get_attachment_image($sc_image,"full");
		$partner_txt .= "</div>";
	}
	
	$result = "
		";
		$result .= "$partner_txt";
		$result .= "
		";
	return $result;
}
add_shortcode( 'client_inner', 'healthkare_client_inner' );

// Parent Element
function vc_client_outer() {

	// Register "container" content element. It will hold all your inner (child) content elements
	vc_map( array(
		"name" => esc_html__("Partner", "healthkare-toolkit"),
		"base" => "client_outer",
		"category" => esc_html__('Healthkare Theme', 'healthkare-toolkit'),
		"as_parent" => array('only' => 'client_inner'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		"content_element" => true,
		"show_settings_on_create" => true,
		"is_container" => true,
		"params" => array(
			// add params same as with any other content element
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Select a Layout', "healthkare-toolkit" ),
				'param_name' => 'sc_layout',
				'description' => esc_html__( 'Default Without Background Image', 'healthkare-toolkit' ),
				'value' => array(
					esc_html__( 'Default Without Background Image', "healthkare-toolkit" ) => 'one',
					esc_html__( 'Default With Background Image', "healthkare-toolkit" ) => 'two',
				),
			),
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Background Image', "healthkare-toolkit" ),
				'param_name' => 'sc_bg',
				"dependency" => Array('element' => "sc_layout", 'value' => array( 'two' ) ),
			),
		),
		"js_view" => 'VcColumnView'
	) );
}
add_action( 'vc_before_init', 'vc_client_outer' );

// Nested Element
function vc_client_inner() {

	vc_map( array(
		"name" => esc_html__("Partner", "healthkare-toolkit"),
		"base" => "client_inner",
		"category" => esc_html__('Healthkare Theme', 'healthkare-toolkit'),
		"content_element" => true,
		"as_child" => array('only' => 'client_outer'), // Use only|except attributes to limit parent (separate multiple values with comma)
		"params" => array(
			// add params same as with any other content element
			array(
				"type" => "attach_image",
				"heading" => esc_html__("Image", "healthkare-toolkit"),
				"param_name" => "sc_image",
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("URL", "healthkare-toolkit"),
				"param_name" => "sc_url",
			),
		)
	) );
}
add_action( 'vc_before_init', 'vc_client_inner' );

// Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {

    class WPBakeryShortCode_Client_Outer extends WPBakeryShortCodesContainer {
	}
}

if ( class_exists( 'WPBakeryShortCode' ) ) {

    class WPBakeryShortCode_Client_Inner extends WPBakeryShortCode {
    }
}
?>