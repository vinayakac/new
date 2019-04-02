<?php
function healthkare_testimonialthree_outer( $atts, $content = null ) {

	extract( shortcode_atts( array( 'sc_bg' => '', 'sc_subtitle' => '', 'sc_title' => '', 'sc_desc' => '' ), $atts ) );
	
	if( $sc_bg != "" ){
		$bg_style = " style='background-image: url(".wp_get_attachment_url( $sc_bg ).");'";
	}
	else{
		$bg_style = "";
	}
	
	$section_header = "";
	
	if($sc_subtitle != "" || $sc_title != "" || $sc_desc != "" ){
		$section_header .= "<div class='section-header3'>";
		$section_header .= "<h5>".esc_attr($sc_subtitle)."</h5>";
		$section_header .= "<h3>".wp_kses($sc_title, array( 'strong' => array() ) )."</h3>";
		$section_header .= wpautop($sc_desc);
		$section_header .= "</div>";
	}
	
	$uniqueid = esc_attr( uniqid( 'tesimonial-three-' ) );
	
	global $cnt_count;
	
	$cnt_count = 1;
	
	$result = "
	
	<!-- Testimonial Section2 -->
	<div class='testimonial-section testimonial-section2 red-bg container-fluid no-left-padding no-right-padding'".html_entity_decode($bg_style).">
		<!-- Container -->
		<div class='container'>";
			$result .= "$section_header";
			$result .= "
			<!-- Main Carousel -->
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
			</div><!-- Main Carousel /- -->
		</div><!-- Container /- -->
	</div><!-- Testimonial Section2 /- -->";
	
	return $result;
}
add_shortcode( 'testimonialthree_outer', 'healthkare_testimonialthree_outer' );

function healthkare_testimonialthree_inner( $atts, $content = null ) {

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
		<span><i class='fa fa-quote-left'></i></span>";
		$result .= "$title_txt";
		$result .= "$designation_txt";
		$result .= "
		".wpautop($testi_desc)."
	</div>";
	
	return $result;
}
add_shortcode( 'testimonialthree_inner', 'healthkare_testimonialthree_inner' );

// Parent Element
function vc_testimonialthree_outer() {

	// Register "container" content element. It will hold all your inner (child) content elements
	vc_map( array(
		"name" => esc_html__("Testimonial 3", "healthkare-toolkit"),
		"base" => "testimonialthree_outer",
		"category" => esc_html__('Healthkare Theme', 'healthkare-toolkit'),
		"as_parent" => array('only' => 'testimonialthree_inner'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
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
			array(
				"type" => "textarea",
				"heading" => esc_html__("Description", "healthkare-toolkit"),
				"param_name" => "sc_desc",
			),
		),
		"js_view" => 'VcColumnView'
	) );
}
add_action( 'vc_before_init', 'vc_testimonialthree_outer' );

// Nested Element
function vc_testimonialthree_inner() {

	vc_map( array(
		"name" => esc_html__("Testimonial 3", "healthkare-toolkit"),
		"base" => "testimonialthree_inner",
		"category" => esc_html__('Healthkare Theme', 'healthkare-toolkit'),
		"content_element" => true,
		"as_child" => array('only' => 'testimonialthree_outer'), // Use only|except attributes to limit parent (separate multiple values with comma)
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
add_action( 'vc_before_init', 'vc_testimonialthree_inner' );

// Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {

    class WPBakeryShortCode_Testimonialthree_Outer extends WPBakeryShortCodesContainer {
	}
}

if ( class_exists( 'WPBakeryShortCode' ) ) {

    class WPBakeryShortCode_Testimonialthree_Inner extends WPBakeryShortCode {
    }
}
?>