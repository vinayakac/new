<?php
function healthkare_departments_outer( $atts, $content = null ) {

	extract( shortcode_atts( array( 'sc_bg'=> '', 'sc_title' => '', 'sc_desc' => '' ), $atts ) );
	
	$section_header = "";
	
	if($sc_title != "" || $sc_desc != "") {
		$section_header .= "<div class='section-header2'>";
			$section_header .= "<h3>".wp_kses($sc_title, array( 'strong' => array() ) )."</h3>";
		$section_header .= wpautop($sc_desc);
		$section_header .= "</div>";
	}
	
	if( $sc_bg != "" ){
		$style = " style='background-image: url(".wp_get_attachment_url( $sc_bg ).");'";
	}
	else{
		$style = "";
	}
	
	$result = "
	
	<!-- Department Section -->
	<div class='department-section container-fluid no-left-padding no-right-padding'".html_entity_decode($style).">
		<!-- Container -->
		<div class='container'>
			<div class='row'>";
				$result .= "$section_header";
				$result .= "
				<div class='department-carousel'>
					".do_shortcode( $content )."
				</div>
			</div>
		</div><!-- Container /- -->
	</div><!-- Department Section -->";
	
	return $result;
}
add_shortcode( 'departments_outer', 'healthkare_departments_outer' );

function healthkare_departments_inner( $atts, $content = null ) {

	extract( shortcode_atts( array( 'sc_image'=> '', 'dep_title'=> '' ), $atts ) );
	
	$title_txt = "";
	
	if($dep_title != ""){
		$title_txt .= "<h3>".esc_attr($dep_title)."</h3>";
	}
	
	$result = "
	
	<div class='col-md-12'>
		<div class='department-block'>
			".wp_get_attachment_image($sc_image,"healthkare_370_248")."
				";
			$result .= "$title_txt";
			$result .= "
		</div>
	</div>";
		
	return $result;
}
add_shortcode( 'departments_inner', 'healthkare_departments_inner' );

// Parent Element
function vc_departments_outer() {

	// Register "container" content element. It will hold all your inner (child) content elements
	vc_map( array(
		"name" => esc_html__("Departments", "healthkare-toolkit"),
		"base" => "departments_outer",
		"category" => esc_html__('Healthkare Theme', 'healthkare-toolkit'),
		"as_parent" => array('only' => 'departments_inner'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		"content_element" => true,
		"show_settings_on_create" => true,
		"is_container" => true,
		"params" => array(
			// add params same as with any other content element
			array(
				"type" => "attach_image",
				"heading" => esc_html__("Background Image", "healthkare-toolkit"),
				"param_name" => "sc_bg",
			),
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
add_action( 'vc_before_init', 'vc_departments_outer' );

// Nested Element
function vc_departments_inner() {

	vc_map( array(
		"name" => esc_html__("Departments", "healthkare-toolkit"),
		"base" => "departments_inner",
		"category" => esc_html__('Healthkare Theme', 'healthkare-toolkit'),
		"content_element" => true,
		"as_child" => array('only' => 'departments_outer'), // Use only|except attributes to limit parent (separate multiple values with comma)
		"params" => array(
			// add params same as with any other content element
			array(
				"type" => "attach_image",
				"heading" => esc_html__("Image", "healthkare-toolkit"),
				"param_name" => "sc_image",
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Title", "healthkare-toolkit"),
				"param_name" => "dep_title",
			),
		)
	) );
}
add_action( 'vc_before_init', 'vc_departments_inner' );

// Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {

    class WPBakeryShortCode_Departments_Outer extends WPBakeryShortCodesContainer {
	}
}

if ( class_exists( 'WPBakeryShortCode' ) ) {

    class WPBakeryShortCode_Departments_Inner extends WPBakeryShortCode {
    }
}
?>