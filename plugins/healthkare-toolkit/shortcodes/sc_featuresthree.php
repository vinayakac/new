<?php
function healthkare_featuresthree_outer( $atts, $content = null ) {

	extract( shortcode_atts( array(	'sc_image' => '', 'sc_title' => '', 'sc_desc' => '' ), $atts ) );
	
	$section_img = $section_header = "";
	
	if($sc_image != "") {
		$section_img .= "<div class='col-md-4 col-sm-6 col-xs-12 offer-best-left'>";
		$section_img .= "<div class='offer-best-img'>";
		$section_img .= wp_get_attachment_image($sc_image,"healthkare_400_483");
		$section_img .= "</div></div>";
	}
	
	if($sc_title != "" || $sc_desc != "" ){
		$section_header .= "<div class='section-header3'>";
			$section_header .= "<h3>".wp_kses($sc_title, array( 'strong' => array() ) )."</h3>";
		$section_header .= wpautop($sc_desc);
		$section_header .= "</div>";
	}
	
	if($sc_image != "") {
		$col_md = "col-md-8 col-sm-6 col-xs-12";
	}
	else {
		$col_md = "col-md-12 col-sm-12 col-xs-12";
	}
	
	$result = "
	
	<!-- Services Section2 -->
	<div class='service-section service-section2 container-fluid no-left-padding no-right-padding'>
		<!-- Container -->
		<div class='container'>
			<!-- Row -->
			<div class='row'>";
				$result .= "$section_img";
				$result .= "
				<div class='".esc_attr($col_md)." offer-best-right'>";
					$result .= "$section_header";
					$result .= "
					<div class='row'>
						".do_shortcode( $content )."
					</div>
				</div>
			</div><!-- Row /- -->
		</div><!-- Container /- -->
	</div><!-- Services Section2 /- -->";
	return $result;
}
add_shortcode( 'featuresthree_outer', 'healthkare_featuresthree_outer' );

function healthkare_featuresthree_inner( $atts, $content = null ) {

	extract( shortcode_atts( array( 'sc_icon'=> '', 'fea_title'=> '', 'fea_desc'=> '','read_layout'=> 'sc_popup', 'sc_btntxt'=> '', 'sc_btnurl'=> '' ), $atts ) );
	
	$iconclass = $listtitle = $popcontent = "";
	
	if($sc_icon != "") {
		$iconclass .= "<i class='".esc_attr($sc_icon)."'></i>";
	}
	
	if($fea_title != "") {
		$listtitle .= "<h3>".esc_attr($fea_title)."</h3>";
	}
	
	$uniqueid = esc_attr( uniqid( 'features-' ) );
	
	if($read_layout == "sc_popup") {
		$popcontent .= "<p>".wp_html_excerpt( $fea_desc, 55, '... ' )."<a class='mfp-content' href='#".esc_attr( $uniqueid )."'>".esc_html__('Read More','healthkare-toolkit')."</a></p>";
		$popcontent .= "<div class='zoom-anim-dialog mfp-hide small-dialog' id='".esc_attr( $uniqueid )."'>";
		$popcontent .= "<div class='popup-content-box'>";
		$popcontent .= "<i class='".esc_attr($sc_icon)."'></i>";
		$popcontent .= "<h3>".esc_attr($fea_title)."</h3>";
		$popcontent .= wpautop($fea_desc);
		$popcontent .= "</div></div>";
	}
	elseif($read_layout == "sc_readmore") {
		$popcontent .= "<p>".wp_html_excerpt( $fea_desc, 55, '...' )."</p>";
		$popcontent .= "<a href='".esc_url($sc_btnurl)."' title='".esc_attr($sc_btntxt)."'>".esc_attr($sc_btntxt)."</a>";
	}
	
	$result = "
		<div class='col-md-6 col-sm-12 col-xs-12'>
			<div class='services-box'>";
				$result .= "$iconclass";
				$result .= "$listtitle";
				$result .= "$popcontent";
				$result .=
				"
			</div>
		</div>";
	return $result;
}
add_shortcode( 'featuresthree_inner', 'healthkare_featuresthree_inner' );

// Parent Element
function vc_featuresthree_outer() {

	// Register "container" content element. It will hold all your inner (child) content elements
	vc_map( array(
		"name" => esc_html__("Features 3", "healthkare-toolkit"),
		"base" => "featuresthree_outer",
		"category" => esc_html__('Healthkare Theme', 'healthkare-toolkit'),
		"as_parent" => array('only' => 'featuresthree_inner'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		"content_element" => true,
		"show_settings_on_create" => true,
		"is_container" => true,
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
add_action( 'vc_before_init', 'vc_featuresthree_outer' );

// Nested Element
function vc_featuresthree_inner() {

	vc_map( array(
		"name" => esc_html__("Features 3", "healthkare-toolkit"),
		"base" => "featuresthree_inner",
		"category" => esc_html__('Healthkare Theme', 'healthkare-toolkit'),
		"content_element" => true,
		"as_child" => array('only' => 'featuresthree_outer'), // Use only|except attributes to limit parent (separate multiple values with comma)
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
				"param_name" => "fea_title",
				"holder" => "div",
			),
			array(
				"type" => "textarea",
				"heading" => esc_html__("Description", "healthkare-toolkit"),
				"param_name" => "fea_desc",
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
add_action( 'vc_before_init', 'vc_featuresthree_inner' );

// Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {

    class WPBakeryShortCode_Featuresthree_Outer extends WPBakeryShortCodesContainer {
	}
}

if ( class_exists( 'WPBakeryShortCode' ) ) {

    class WPBakeryShortCode_Featuresthree_Inner extends WPBakeryShortCode {
    }
}
?>