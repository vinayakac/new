<?php
function healthkare_counter_outer( $atts, $content = null ) {

	extract( shortcode_atts( array( 'sc_bg' => '' ), $atts ) );
	
	$styel = "";
	if( $sc_bg != "" ){
		$styel = " style='background-image: url(".wp_get_attachment_url( $sc_bg ).");'";
	}
	else{
		$styel = "";
	}
	
	global $cntcount;
	
	$cntcount = 0;
	
	$result = "
	
	<!-- Counter Section -->
	<div class='counter-section container-fluid no-left-padding no-right-padding'".html_entity_decode( $styel ).">
		<!-- Container -->
		<div class='container'>
			<!-- Row -->
			<div class='row'>
				".do_shortcode( $content )."
			</div><!-- Row /- -->
		</div><!-- Container /- -->
	</div><!-- Counter Section /- -->";
	
	return $result;
}
add_shortcode( 'counter_outer', 'healthkare_counter_outer' );

function healthkare_counter_inner( $atts, $content = null ) {

	extract( shortcode_atts( array( 'sc_icon' => '','sc_value' => '','sc_title' => '' ), $atts ) );
	
	$countertext = "";
	
	if($sc_title != ""){
		$countertext .= "<p>".esc_attr($sc_title)."</p>";
	}
	
	global $cntcount;
	
	$cntcount++;
	
	$result = "
	
	<div class='col-md-3 col-sm-4 col-xs-4'>
		<div class='counter-box'>
			<h3>
				<i class='".esc_attr($sc_icon)."'></i>
				<span class='count' id='statistics_count-".esc_attr($cntcount)."' data-statistics_percent='".esc_attr($sc_value)."'>".esc_html__(' &nbsp;','healthkare-toolkit')."</span>
				".esc_html__('+','healthkare-toolkit')."
			</h3>";
			$result .= "$countertext";
			$result .= "
		</div>
	</div>";
	return $result;
}
add_shortcode( 'counter_inner', 'healthkare_counter_inner' );

// Parent Element
function vc_counter_outer() {

	// Register "container" content element. It will hold all your inner (child) content elements
	vc_map( array(
		"name" => esc_html__("Counter", "healthkare-toolkit"),
		"base" => "counter_outer",
		"category" => esc_html__('Healthkare Theme', 'healthkare-toolkit'),
		"as_parent" => array('only' => 'counter_inner'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		"content_element" => true,
		"show_settings_on_create" => true,
		"is_container" => true,
		"params" => array(
			// add params same as with any other content element
			array(
				'type' => 'attach_image',
				'heading' => esc_html__( 'Background Image', "healthkare-toolkit" ),
				'param_name' => 'sc_bg',
			),
		),
		"js_view" => 'VcColumnView'
	) );
}
add_action( 'vc_before_init', 'vc_counter_outer' );

// Nested Element
function vc_counter_inner() {

	vc_map( array(
		"name" => esc_html__("Counter", "healthkare-toolkit"),
		"base" => "counter_inner",
		"category" => esc_html__('Healthkare Theme', 'healthkare-toolkit'),
		"content_element" => true,
		"as_child" => array('only' => 'counter_outer'), // Use only|except attributes to limit parent (separate multiple values with comma)
		"params" => array(
			// add params same as with any other content element
			array(
				"type" => "iconpicker",
				"heading" => esc_html__("Select Icon", "healthkare-toolkit"),
				"param_name" => "sc_icon",
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Counter Value", "healthkare-toolkit"),
				"param_name" => "sc_value",
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Title", "healthkare-toolkit"),
				"param_name" => "sc_title",
			),
		)
	) );
}
add_action( 'vc_before_init', 'vc_counter_inner' );

// Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {

    class WPBakeryShortCode_Counter_Outer extends WPBakeryShortCodesContainer {
	}
}

if ( class_exists( 'WPBakeryShortCode' ) ) {

    class WPBakeryShortCode_Counter_Inner extends WPBakeryShortCode {
    }
}
?>