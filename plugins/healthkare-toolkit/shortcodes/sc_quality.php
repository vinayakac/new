<?php
function healthkare_quality_outer( $atts, $content = null ) {

	extract( shortcode_atts( array( 'sc_title' => '', 'sc_desc' => '', 'sc_image'=> '' ), $atts ) );
	
	if($sc_title != "" || $sc_desc != "") {
		$section_header .= "<div class='section-header quality-content'>";
		$section_header .= "<h3>".wp_kses($sc_title, array( 'strong' => array() ) )."</h3>";
		$section_header .= wpautop($sc_desc);
		$section_header .= "</div>";
	}

	if($sc_image != "") {
		$section_img .= "<div class='quality-img'>";
		$section_img .= wp_get_attachment_image($sc_image,"healthkare_720_436");
		$section_img .= "</div>";
	}
	
	if($sc_image != "") {
		$col_md = "col-md-8 col-sm-12 col-xs-12";
	}
	else {
		$col_md = "col-md-12 col-sm-12 col-xs-12";
	}
	
	$result = "
	<!-- Quality Section -->
	<div class='quality-section container-fluid no-left-padding no-right-padding'>
		<!-- Container -->
		<div class='container'>
			<div class='quality-main-box'>
				<div class='".esc_attr($col_md)."'>";
					$result .= "$section_header";
					$result .= "
					".do_shortcode( $content )."
				</div>	
			</div>
		</div><!-- Container /- -->";
		$result .= "$section_img";
		$result .= "
	</div><!-- Quality Section /- -->";
	return $result;
}
add_shortcode( 'quality_outer', 'healthkare_quality_outer' );

function healthkare_quality_inner( $atts, $content = null ) {

	extract( shortcode_atts( array('sc_icon' => '', 'qul_title' => '', 'desc' => '', 'read_layout'=> 'sc_popup', 'sc_btntxt'=> '', 'sc_btnurl'=> '' ), $atts ) );
	
	$icon_class = $icon_class = $read_more = "";
	
	if($sc_icon != "" || $qul_title != ""){
		$icon_class .= "<span><i class='".esc_attr($sc_icon)."'></i>".esc_attr($qul_title)."</span>";
	}

	$uniqueid = esc_attr( uniqid( 'quality-' ) );

	if($read_layout == "sc_popup") {
		$popcontent .= "<p>".wp_html_excerpt( $desc, 55, '... ' )."<a href='#".esc_attr($uniqueid)."' class='mfp-content'>".esc_html__('Read More','healthkare-toolkit')."</a></p>";
		$popcontent .= "<div class='zoom-anim-dialog mfp-hide small-dialog' id='".esc_attr($uniqueid)."'>";
		$popcontent .= "<div class='quality-popup popup-content-box'>";
		$popcontent .= "<span><i class='".esc_attr($sc_icon)."'></i>".esc_attr($qul_title)."</span>";
		$popcontent .= wpautop($desc);
		$popcontent .= "</div></div>";
	}
	elseif($read_layout == "sc_readmore") {
		$popcontent .= "<p>".wp_html_excerpt( $desc, 55, '...' )."</p>";
		$popcontent .= "<a href='".esc_url($sc_btnurl)."' title='".esc_attr($sc_btntxt)."'>".esc_attr($sc_btntxt)."</a>";
	}

	$result = "

	<div class='quality-content col-md-6 col-sm-6 col-xs-12'>
		<div class='quality-box'>";
			$result .= "$icon_class";
			$result .= "$popcontent";
			$result .= "
		</div>
	</div>";

	return $result;
}
add_shortcode( 'quality_inner', 'healthkare_quality_inner' );

// Parent Element
function vc_quality_outer() {

	// Register "container" content element. It will hold all your inner (child) content elements
	vc_map( array(
		"name" => esc_html__("Quality", "healthkare-toolkit"),
		"base" => "quality_outer",
		"category" => esc_html__('Healthkare Theme', 'healthkare-toolkit'),
		"as_parent" => array('only' => 'quality_inner'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
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
			array(
				"type" => "attach_image",
				"heading" => esc_html__("Image", "healthkare-toolkit"),
				"param_name" => "sc_image",
			),
		),
		"js_view" => 'VcColumnView'
	) );
}
add_action( 'vc_before_init', 'vc_quality_outer' );

// Nested Element
function vc_quality_inner() {

	vc_map( array(
		"name" => esc_html__("Quality", "healthkare-toolkit"),
		"base" => "quality_inner",
		"category" => esc_html__('Healthkare Theme', 'healthkare-toolkit'),
		"content_element" => true,
		"as_child" => array('only' => 'quality_outer'), // Use only|except attributes to limit parent (separate multiple values with comma)
		"params" => array(
			// add params same as with any other content element
			array(
				"type" => "iconpicker",
				"heading" => esc_html__("Selec Icon", "healthkare-toolkit"),
				"param_name" => "sc_icon",
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Title", "healthkare-toolkit"),
				"param_name" => "qul_title",
			),
			array(
				"type" => "textarea",
				"heading" => esc_html__("Description", "healthkare-toolkit"),
				"param_name" => "desc",
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
add_action( 'vc_before_init', 'vc_quality_inner' );

// Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {

    class WPBakeryShortCode_Quality_Outer extends WPBakeryShortCodesContainer {
	}
}

if ( class_exists( 'WPBakeryShortCode' ) ) {

    class WPBakeryShortCode_Quality_Inner extends WPBakeryShortCode {
    }
}
?>