<?php
function healthkare_testimonialone_outer( $atts, $content = null ) {

	extract( shortcode_atts( array( 'sc_title' => '', 'sc_desc' => '','sc_bgleft' => '', 'sc_bgright' => '' ), $atts ) );
	
	if( $sc_bgleft != "" ){
		$bg_style = " style='background-image: url(".wp_get_attachment_url( $sc_bgleft ).");'";
	}
	else{
		$bg_style = "";
	}
	
	global $cnt_count;
	
	$cnt_count = 1;
	
	$section_header = $bgright= "";
	
	if($sc_title != "" || $sc_desc != "") {
		$section_header .= "<div class='section-header'>";
		$section_header .= "<h3>".wp_kses($sc_title, array( 'strong' => array() ) )."</h3>";
		$section_header .= wpautop($sc_desc);
		$section_header .= "</div>";
	}
	
	if($sc_bgright != "") {
		$bgright .= "<div class='col-md-5 col-sm-6 col-xs-6 testimonial-right-img'>";
		$bgright .= "<div data-image='".wp_get_attachment_url($sc_bgright,"full")."' class='testi-img'></div>";
		$bgright .= "</div>";
	}
	
	$uniqueid = esc_attr( uniqid( 'tesimonial-one-' ) );
	
	$result = "
	
	<!-- Testimonial Section3 -->
	<div class='testimonial-section3 container-fluid no-left-padding no-right-padding'>
		<div class='col-md-7 col-sm-6 col-xs-6 no-padding testimonial-left-img'".html_entity_decode($bg_style)."></div>
		<!-- Container -->
		<div class='container'>
			<div class='row'>
				<div class='col-md-7 col-sm-10 col-xs-7 testimonial-content'>";
					$result .= "$section_header";
					$result .= "
					<!-- testimonil-one -->
					<div id='".esc_attr($uniqueid)."' class='carousel slide carousel-fade' data-ride='carousel'>
						<div role='listbox' class='carousel-inner'>
							".do_shortcode( $content )."
						</div>
						<a class='left carousel-control' href='#".esc_attr($uniqueid)."' role='button' data-slide='prev'>
							<i class='fa fa-angle-left' aria-hidden='true'></i>
						</a>
						<a class='right carousel-control' href='#".esc_attr($uniqueid)."' role='button' data-slide='next'>
							<i class='fa fa-angle-right' aria-hidden='true'></i>
						</a>
					</div><!-- testimonil-one /- -->
				</div>
			</div>
		</div><!-- Container /- -->";
		$result .= "$bgright";
		$result .= "
	</div><!-- Testimonial Section3 -->";
	
	return $result;
}
add_shortcode( 'testimonialone_outer', 'healthkare_testimonialone_outer' );

function healthkare_testimonialone_inner( $atts, $content = null ) {

	extract( shortcode_atts( array( 'testi_title'=> '', 'testi_desig'=> '', 'testi_desc'=> '' ), $atts ) );
	
	$title_txt = $designation_txt = "";
	
	if($testi_title != "") {
		$title_txt .= "<h3>".esc_attr($testi_title)."</h3>";
	}
	
	if($testi_desig != "") {
		$designation_txt .= "<h5>".esc_attr($testi_desig)."</h5>";
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
		<div class='testi-header'>
			<i class='fa fa-quote-left'></i>";
			$result .= "$title_txt";
			$result .= "$designation_txt";
			$result .= "
		</div>
		".wpautop($testi_desc)."
	</div>";
	
	return $result;
}
add_shortcode( 'testimonialone_inner', 'healthkare_testimonialone_inner' );

// Parent Element
function vc_testimonialone_outer() {

	// Register "container" content element. It will hold all your inner (child) content elements
	vc_map( array(
		"name" => esc_html__("Testimonail 1", "healthkare-toolkit"),
		"base" => "testimonialone_outer",
		"category" => esc_html__('Healthkare Theme', 'healthkare-toolkit'),
		"as_parent" => array('only' => 'testimonialone_inner'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		"content_element" => true,
		"show_settings_on_create" => true,
		"is_container" => true,
		"params" => array(
			// add params same as with any other content element
			array(
				"type" => "attach_image",
				"heading" => esc_html__("Background Image Left", "healthkare-toolkit"),
				"param_name" => "sc_bgleft",
			),
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
			array(
				"type" => "attach_image",
				"heading" => esc_html__("Background Image Right", "healthkare-toolkit"),
				"param_name" => "sc_bgright",
			),
		),
		"js_view" => 'VcColumnView'
	) );
}
add_action( 'vc_before_init', 'vc_testimonialone_outer' );

// Nested Element
function vc_testimonialone_inner() {

	vc_map( array(
		"name" => esc_html__("Testimonail 1", "healthkare-toolkit"),
		"base" => "testimonialone_inner",
		"category" => esc_html__('Healthkare Theme', 'healthkare-toolkit'),
		"content_element" => true,
		"as_child" => array('only' => 'testimonialone_outer'), // Use only|except attributes to limit parent (separate multiple values with comma)
		"params" => array(
			// add params same as with any other content element
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
add_action( 'vc_before_init', 'vc_testimonialone_inner' );

// Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {

    class WPBakeryShortCode_Testimonialone_Outer extends WPBakeryShortCodesContainer {
	}
}

if ( class_exists( 'WPBakeryShortCode' ) ) {

    class WPBakeryShortCode_Testimonialone_Inner extends WPBakeryShortCode {
    }
}
?>