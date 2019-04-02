<?php
function healthkare_testimonialtwo_outer( $atts, $content = null ) {

	extract( shortcode_atts( array( 'sc_bg'=> '', 'sc_subtitle' => '', 'sc_title' => '' ), $atts ) );
	
	if( $sc_bg != "" ){
		$bg_style = " style='background-image: url(".wp_get_attachment_url( $sc_bg ).");'";
	}
	else{
		$bg_style = "";
	}
	
	$section_header = "";
	
	if($sc_subtitle != "" || $sc_title != "") {
		$section_header .= "<div class='section-header2'>";
		$section_header .= "<h5>".esc_attr($sc_subtitle)."</h5>";
		$section_header .= "<h3>".wp_kses($sc_title, array( 'strong' => array() ) )."</h3>";
		$section_header .= "</div>";
	}
	
	$uniqueid = esc_attr( uniqid( 'tesimonial-two-' ) );
	
	global $cnt_count;
	
	$cnt_count = 1;
	
	$str_slide = "";
	
	$cnt_active = "";
	
	for( $cnt=0; $cnt < substr_count($content, 'testimonialtwo_inner'); $cnt++ ) {
		if( $cnt == 0 ) {
			$cnt_active = "class='active'";
		} else {
			$cnt_active = "";
		}
		$str_slide .= "<li data-target='#".esc_attr($uniqueid)."' data-slide-to='$cnt' $cnt_active ></li>";
	}
	
	$result = "
	
	<!-- Testimonial Section -->
	<div class='testimonial-section container-fluid no-left-padding no-right-padding'".html_entity_decode($bg_style).">
		<!-- Container -->
		<div class='container'>";
			$result .= "$section_header";
			$result .= "
			<!-- testimonil-two -->
			<div id='".esc_attr($uniqueid)."' class='carousel slide carousel-fade' data-ride='carousel'>
				<ol class='carousel-indicators'>";
					$result .= "$str_slide";
					$result .= "
				</ol>
				<div role='listbox' class='carousel-inner'>
					".do_shortcode( $content )."
				</div>
			</div><!-- testimonil-two /- -->
		</div><!-- Container /- -->
	</div><!-- Testimonial Section /- -->";
	
	return $result;
}
add_shortcode( 'testimonialtwo_outer', 'healthkare_testimonialtwo_outer' );

function healthkare_testimonialtwo_inner( $atts, $content = null ) {

	extract( shortcode_atts( array( 'sc_image'=> '','testi_title'=> '', 'testi_desig'=> '', 'testi_desc'=> '' ), $atts ) );
	
	$title_txt = $designation_txt = $desc_txt = "";
	
	if($testi_title != "") {
		$title_txt .= "<h3>".esc_attr($testi_title)."</h3>";
	}
	
	if($testi_desig != "") {
		$designation_txt .= "<h5>".esc_attr($testi_desig)."</h5>";
	}
	
	if($testi_desc != "") {
		$desc_txt .= "<div class='testimonial_content_block'>";
		$desc_txt .= wpautop($testi_desc);
		$desc_txt .= "</div>";
	}
	
	global $cnt_count;
	
	if($cnt_count == 1) {
		$testi_active = " active";
	}
	else {
		$testi_active = "";
	}
	
	$cnt_count++;
	
	$result = "
	
	<div class='item".esc_attr($testi_active)."'>
		".wp_get_attachment_image($sc_image,"healthkare_104_104")."
		";
		$result .= "$title_txt";
		$result .= "$designation_txt";
		$result .= "$desc_txt";
		$result .= "
	</div>";
	
	return $result;
}
add_shortcode( 'testimonialtwo_inner', 'healthkare_testimonialtwo_inner' );

// Parent Element
function vc_testimonialtwo_outer() {

	// Register "container" content element. It will hold all your inner (child) content elements
	vc_map( array(
		"name" => esc_html__("Testimonial 2", "healthkare-toolkit"),
		"base" => "testimonialtwo_outer",
		"category" => esc_html__('Healthkare Theme', 'healthkare-toolkit'),
		"as_parent" => array('only' => 'testimonialtwo_inner'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
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
				"heading" => esc_html__("Sub Title", "healthkare-toolkit"),
				"param_name" => "sc_subtitle",
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Title", "healthkare-toolkit"),
				"param_name" => "sc_title",
			),
		),
		"js_view" => 'VcColumnView'
	) );
}
add_action( 'vc_before_init', 'vc_testimonialtwo_outer' );

// Nested Element
function vc_testimonialtwo_inner() {

	vc_map( array(
		"name" => esc_html__("Testimonial 2", "healthkare-toolkit"),
		"base" => "testimonialtwo_inner",
		"category" => esc_html__('Healthkare Theme', 'healthkare-toolkit'),
		"content_element" => true,
		"as_child" => array('only' => 'testimonialtwo_outer'), // Use only|except attributes to limit parent (separate multiple values with comma)
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
				"param_name" => "testi_title",
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Designation", "healthkare-toolkit"),
				"param_name" => "testi_desig",
			),
			array(
				"type" => "textarea",
				"heading" => esc_html__("Description", "healthkare-toolkit"),
				"param_name" => "testi_desc",
			),
		)
	) );
}
add_action( 'vc_before_init', 'vc_testimonialtwo_inner' );

// Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {

    class WPBakeryShortCode_Testimonialtwo_Outer extends WPBakeryShortCodesContainer {
	}
}

if ( class_exists( 'WPBakeryShortCode' ) ) {

    class WPBakeryShortCode_Testimonialtwo_Inner extends WPBakeryShortCode {
    }
}
?>