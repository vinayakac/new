<?php
function healthkare_ourmission_outer( $atts, $content = null ) {

	extract( shortcode_atts( array( 'sc_title' => '', 'sc_bg' => '' ), $atts ) );
	
	if( $sc_bg != '' ) {
		$style = " style='background-image: url(".wp_get_attachment_url( $sc_bg ).");'";
	}
	else {
		$style = "";
	}
	
	$section_title = "";
	
	if($sc_title != "") {
		$section_title .= "<h5>".esc_attr($sc_title)."</h5>"; 
	}
	
	global $cnt_count;
	
	$cnt_count = 1;
	
	$str_slide = "";
	
	$cnt_active = "";
	
	for( $cnt=0; $cnt < substr_count($content, 'ourmission_inner'); $cnt++ ) {
		if( $cnt == 0 ) {
			$cnt_active = "class='active'";
		} else {
			$cnt_active = "";
		}
		$str_slide .= "<li data-target='#main-carousel' data-slide-to='$cnt' $cnt_active ></li>";
	}
	
	$result = "
	<!-- Mission Section -->
	<div class='mission-section container-fluid no-left-padding no-right-padding'>
		<div class='mission-img'".html_entity_decode($style).">
			<div class='mission-block'>";
				$result .= "$section_title";
				$result .= "
				<!-- Main Carousel -->
				<div id='main-carousel' class='carousel slide carousel-fade' data-ride='carousel'>
					<ol class='carousel-indicators'>";
						$result .= "$str_slide";
						$result .= "
					</ol>
					<div role='listbox' class='carousel-inner'>
						".do_shortcode( $content )."
					</div>
				</div><!-- Main Carousel /- -->
			</div>
		</div>
	</div>";
	return $result;
}
add_shortcode( 'ourmission_outer', 'healthkare_ourmission_outer' );

function healthkare_ourmission_inner( $atts, $content = null ) {

	extract( shortcode_atts( array( 'sc_desc'=> '' ), $atts ) );
	
	global $cnt_count;
	
	if($cnt_count == 1) {
		$active_class = " active";
	}
	else {
		$active_class = "";
	}
	
	$cnt_count++;
	
	$result = "
	
	<div class='item".esc_attr($active_class)."'>
		".wpautop($sc_desc)."
	</div>";
	
	return $result;
}
add_shortcode( 'ourmission_inner', 'healthkare_ourmission_inner' );

// Parent Element
function vc_ourmission_outer() {

	// Register "container" content element. It will hold all your inner (child) content elements
	vc_map( array(
		"name" => esc_html__("Our Mission", "healthkare-toolkit"),
		"base" => "ourmission_outer",
		"category" => esc_html__('Healthkare Theme', 'healthkare-toolkit'),
		"as_parent" => array('only' => 'ourmission_inner'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
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
				"type" => "attach_image",
				"heading" => esc_html__("Background Image", "healthkare-toolkit"),
				"param_name" => "sc_bg",
			),
		),
		"js_view" => 'VcColumnView'
	) );
}
add_action( 'vc_before_init', 'vc_ourmission_outer' );

// Nested Element
function vc_ourmission_inner() {

	vc_map( array(
		"name" => esc_html__("Our Mission", "healthkare-toolkit"),
		"base" => "ourmission_inner",
		"category" => esc_html__('Healthkare Theme', 'healthkare-toolkit'),
		"content_element" => true,
		"as_child" => array('only' => 'ourmission_outer'), // Use only|except attributes to limit parent (separate multiple values with comma)
		"params" => array(
			// add params same as with any other content element
			array(
				"type" => "textarea",
				"heading" => esc_html__("Description", "healthkare-toolkit"),
				"param_name" => "sc_desc",
			),
		)
	) );
}
add_action( 'vc_before_init', 'vc_ourmission_inner' );

// Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {

    class WPBakeryShortCode_Ourmission_Outer extends WPBakeryShortCodesContainer {
	}
}

if ( class_exists( 'WPBakeryShortCode' ) ) {

    class WPBakeryShortCode_Ourmission_Inner extends WPBakeryShortCode {
    }
}
?>