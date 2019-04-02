<?php
function healthkare_teamfour_outer( $atts, $content = null ) {

	extract( shortcode_atts( array( 'sc_title' => '', 'sc_desc'=> '' ), $atts ) );
	
	$section_header = "";
	
	if($sc_title != "" || $sc_subtitle != "" || $sc_desc != "" ){
		$section_header .= "<div class='section-header'>";
		$section_header .= "<h3>".wp_kses($sc_title, array( 'strong' => array() ) )."</h3>";
		$section_header .= wpautop($sc_desc);
		$section_header .= "</div>";
	}
	
	$result = "
	
	<!-- Team Section -->
	<div class='team-section team-section4 container-fluid no-left-padding no-right-padding'>
		<!-- Container -->
		<div class='container'>";
			$result .= "$section_header";
			$result .= "
			<!-- Row -->
			<div class='row'>
				".do_shortcode( $content )."
			</div><!-- Row /- -->
		</div><!-- Container /- -->
	</div><!-- Team Section /- -->";
	
	return $result;
}
add_shortcode( 'teamfour_outer', 'healthkare_teamfour_outer' );

function healthkare_teamfour_inner( $atts, $content = null ) {

	extract( shortcode_atts( array( 'sc_image'=> '', 'team_title'=> '', 'team_desig'=> '', 'sc_btntxt'=> '', 'sc_btnurl'=> '' ), $atts ) );
	
	$titletxt = $designationtxt = $buttontxt = "";
	
	if($team_title != "") {
		$titletxt .= "<h5>".esc_attr($team_title)."</h5>";
	}
	
	if($team_desig != "") {
		$designationtxt .= "<span>".esc_attr($team_desig)."</span>";
	}
	if($sc_btntxt != "") {
		$buttontxt .= "<a href='".esc_url($sc_btnurl)."' title='".esc_attr($sc_btntxt)."' class='send-message'>".esc_attr($sc_btntxt)."</a>";
	}
	
	$result = "
	
	<div class='col-md-3 col-sm-4 col-xs-6'>
		<div class='team-box'>
			".wp_get_attachment_image($sc_image,"healthkare_270_320")."
			<div class='team-content'>";
				$result .= "$titletxt";
				$result .= "$designationtxt";
				$result .= "
				<div class='team-social'>
					<ul>";
						foreach( vc_param_group_parse_atts( $atts['plan_feature'] ) as $key => $value ) {

							if( !empty( $value['feature_url'] ) && !empty( $value['feature_icon'] ) ) {
								$result .= "<li><a href='".esc_attr( $value['feature_url'] )."' target='_blank'><i class='".esc_attr( $value['feature_icon'] )."'></i></a></li>";
							}
							else {
								$result .= "";
							}
						}
						$result .= "
					</ul>";
					$result .= "$buttontxt";
					$result .= "
				</div>
			</div>
		</div>
	</div>";
		
	return $result;
}
add_shortcode( 'teamfour_inner', 'healthkare_teamfour_inner' );

// Parent Element
function vc_teamfour_outer() {

	// Register "container" content element. It will hold all your inner (child) content elements
	vc_map( array(
		"name" => esc_html__("Team 4", "healthkare-toolkit"),
		"base" => "teamfour_outer",
		"category" => esc_html__('Healthkare Theme', 'healthkare-toolkit'),
		"as_parent" => array('only' => 'teamfour_inner'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
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
				"type" => "textfield",
				"heading" => esc_html__("Short Description", "healthkare-toolkit"),
				"param_name" => "sc_desc",
			),
		),
		"js_view" => 'VcColumnView'
	) );
}
add_action( 'vc_before_init', 'vc_teamfour_outer' );

// Nested Element
function vc_teamfour_inner() {

	vc_map( array(
		"name" => esc_html__("Team 4", "healthkare-toolkit"),
		"base" => "teamfour_inner",
		"category" => esc_html__('Healthkare Theme', 'healthkare-toolkit'),
		"content_element" => true,
		"as_child" => array('only' => 'teamfour_outer'), // Use only|except attributes to limit parent (separate multiple values with comma)
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
				"param_name" => "team_title",
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Designation", "healthkare-toolkit"),
				"param_name" => "team_desig",
			),
			array(
				'type' => 'param_group',
				'value' => '',
				'param_name' => 'plan_feature',
				// Note params is mapped inside param-group:
				'params' => array(
					array(
						'type' => 'textfield',
						'value' => '',
						'heading' => 'Feature URL',
						'param_name' => 'feature_url',
					),
					array(
						'type' => 'iconpicker',
						'value' => '',
						'heading' => 'Feature Icon',
						'param_name' => 'feature_icon',
					)
				)
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Button Text", "healthkare-toolkit"),
				"param_name" => "sc_btntxt",
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Button URL", "healthkare-toolkit"),
				"param_name" => "sc_btnurl",
			),
		)
	) );
}
add_action( 'vc_before_init', 'vc_teamfour_inner' );

// Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {

    class WPBakeryShortCode_Teamfour_Outer extends WPBakeryShortCodesContainer {
	}
}

if ( class_exists( 'WPBakeryShortCode' ) ) {

    class WPBakeryShortCode_Teamfour_Inner extends WPBakeryShortCode {
    }
}
?>