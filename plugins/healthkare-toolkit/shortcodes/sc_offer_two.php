<?php
function healthkare_offertwo_outer( $atts, $content = null ) {

	extract( shortcode_atts( array( 'sc_layout'=> 'one', 'sc_image' => '', 'sctitle' => '', 'sc_desc' => '' ), $atts ) );
	
	$section_header = $section_image = "";
	
	if($sc_layout == 'one') {
		$class_css = "section-header2";
	}
	elseif($sc_layout == 'two') {
		$class_css = "section-header";
	}
	else {
		$class_css = "section-header";
	}
	
	if($sctitle != "" || $sc_desc != "") {
		$section_header .= "<div class='".esc_attr($class_css)."'>";
		$section_header .= "<h3>".wp_kses($sctitle, array( 'strong' => array() ) )."</h3>";
		$section_header .= wpautop($sc_desc);
		$section_header .= "</div>";
	}
	
	if($sc_image != "") {
		$section_image .= "<div class='welcome-bg'>";
		$section_image .= "<i>".wp_get_attachment_image($sc_image,'healthkare_390_390')."</i>";
		$section_image .= "</div>";
	}
	
	global $cnt_count;
	
	$cnt_count = 1;
	
	$result = "
	
	<!-- Services Section -->
	<div class='service-section container-fluid no-left-padding no-right-padding'>
		<div class='container'>";
			$result .= "$section_header";
			$result .= "
			<div class='welcome-content'>";
				$result .= "$section_image";
				$result .= "
				<!-- Row -->
				<div class='row'>
					".do_shortcode( $content )."
				</div><!-- Row /- -->";
				$result .= "$str_slide";
				$result .= "
			</div>
		</div>
	</div>";
	
	return $result;
}
add_shortcode( 'offertwo_outer', 'healthkare_offertwo_outer' );

function healthkare_offertwo_inner( $atts, $content = null ) {

	extract( shortcode_atts( array( 'sc_icon'=> '', 'offer_title'=> '', 'offer_desc'=> '','read_layout'=> 'sc_popup', 'sc_btntxt'=> '', 'sc_btnurl'=> '' ), $atts ) );
	
	$iconclass = $offertxt = $popcontent = "";
	
	if($sc_icon != "") {
		$iconclass .= "<i class='".esc_attr($sc_icon)."'></i>";
	}
	if($offer_title != "") {
		$offertxt .= "<h3 class='tc_dark'>".esc_attr($offer_title)."</h3>";
	}
	
	global $cnt_count;
	
	if($cnt_count > 6 ){
		$md_class = "two_parts";
	}
	else {
		$md_class = "";
	}
	
	$cnt_count++;
	
	$uniqueid = esc_attr( uniqid( 'best-offefr-' ) );

	if($read_layout == "sc_popup") {
		$popcontent .= "<p>".wp_html_excerpt( $offer_desc, 55, '... ' )."<a href='#".esc_attr($uniqueid)."' class='mfp-content'>".esc_html__('Read More','healthkare-toolkit')."</a></p>";
		$popcontent .= "<div class='zoom-anim-dialog mfp-hide small-dialog' id='".esc_attr($uniqueid)."'>";
		$popcontent .= "<div class='popup-content-box'>";
		$popcontent .= "<i class='".esc_attr($sc_icon)."'></i>";
		$popcontent .= "<h3 class='tc_dark'>".esc_attr($offer_title)."</h3>";
		$popcontent .= wpautop($offer_desc);
		$popcontent .= "</div></div>";
	}
	elseif($read_layout == "sc_readmore") {
		$popcontent .= "<p>".wp_html_excerpt( $offer_desc, 55, '...' )."</p>";
		$popcontent .= "<a href='".esc_url($sc_btnurl)."' title='".esc_attr($sc_btntxt)."'>".esc_attr($sc_btntxt)."</a>";
	}

	$result = "
		<div class='col-md-6 col-xs-6 ".esc_attr($md_class)."'>
			<div class='welcome-box'>";
				$result .= "$iconclass";
				$result .= "$offertxt";
				$result .= "$popcontent";
				$result .= "
			</div>
		</div>";
	return $result;
}
add_shortcode( 'offertwo_inner', 'healthkare_offertwo_inner' );

// Parent Element
function vc_offertwo_outer() {

	// Register "container" content element. It will hold all your inner (child) content elements
	vc_map( array(
		"name" => esc_html__("Offer 2", "healthkare-toolkit"),
		"base" => "offertwo_outer",
		"category" => esc_html__('Healthkare Theme', 'healthkare-toolkit'),
		"as_parent" => array('only' => 'offertwo_inner'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		"content_element" => true,
		"show_settings_on_create" => true,
		"is_container" => true,
		"params" => array(
			// add params same as with any other content element
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Section Title Layout', "healthkare-toolkit" ),
				'param_name' => 'sc_layout',
				'description' => esc_html__( 'Default Layout 1 Set', 'healthkare-toolkit' ),
				'value' => array(
					esc_html__( 'Layout 1', "healthkare-toolkit" ) => 'one',
					esc_html__( 'Layout 2', "healthkare-toolkit" ) => 'two',
				),
			),
			array(
				"type" => "attach_image",
				"heading" => esc_html__("Image", "healthkare-toolkit"),
				"param_name" => "sc_image",
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Title", "healthkare-toolkit"),
				"param_name" => "sctitle",
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
add_action( 'vc_before_init', 'vc_offertwo_outer' );

// Nested Element
function vc_offertwo_inner() {

	vc_map( array(
		"name" => esc_html__("Offer 2", "healthkare-toolkit"),
		"base" => "offertwo_inner",
		"category" => esc_html__('Healthkare Theme', 'healthkare-toolkit'),
		"content_element" => true,
		"as_child" => array('only' => 'offertwo_outer'), // Use only|except attributes to limit parent (separate multiple values with comma)
		"params" => array(
			// add params same as with any other content element
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
			array(
				"type" => "textarea",
				"heading" => esc_html__("Description", "healthkare-toolkit"),
				"param_name" => "offer_desc",
			),
			array(
				'type' => 'dropdown',
				'heading' => esc_html__( 'Read More Text', "healthkare-toolkit" ),
				'param_name' => 'read_layout',
				'description' => esc_html__( 'Read More Text Options', 'healthkare-toolkit' ),
				'value' => array(
					esc_html__( 'Read More Text: Open To Popup Box', "healthkare-toolkit" ) => 'sc_popup',
					esc_html__( 'Read More Text: Link To Other Pages', "healthkare-toolkit" ) => 'sc_readmore',
				),
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Button Text", "healthkare-toolkit"),
				"param_name" => "sc_btntxt",
				"dependency" => Array('element' => "read_layout", 'value' => array( 'sc_readmore' ) ),
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Button URL", "healthkare-toolkit"),
				"param_name" => "sc_btnurl",
				"dependency" => Array('element' => "read_layout", 'value' => array( 'sc_readmore' ) ),
			),
		)
	) );
}
add_action( 'vc_before_init', 'vc_offertwo_inner' );

// Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {

    class WPBakeryShortCode_Offertwo_Outer extends WPBakeryShortCodesContainer {
	}
}

if ( class_exists( 'WPBakeryShortCode' ) ) {

    class WPBakeryShortCode_Offertwo_Inner extends WPBakeryShortCode {
    }
}
?>