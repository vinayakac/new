<?php
function healthkare_teamthree_outer( $atts, $content = null ) {

	extract( shortcode_atts( array( 'sc_subtitle' => '', 'sc_title' => '', 'sc_desc'=> '' ), $atts ) );
	
	$section_header = "";
	
	if($sc_title != "" || $sc_subtitle != "" || $sc_desc != "" ){
		$section_header .= "<div class='section-header'>";
		$section_header .= "<h5>".esc_attr($sc_subtitle)."</h5>";
		$section_header .= "<h3>".wp_kses($sc_title, array( 'strong' => array() ) )."</h3>";
		$section_header .= wpautop($sc_desc);
		$section_header .= "</div>";
	}
	
	$result = "
	
	<!-- Team Section3 -->
	<div class='team-section team-section3 container-fluid no-left-padding no-right-padding'>
		<!-- Container -->
		<div class='container'>
			<!-- Row -->
			<div class='row'>
				<div class='col-md-3 col-sm-4 col-xs-4 team-header'>";
					$result .= "$section_header";
					$result .= "
					<div class='custom-nav'>
						<a class='btn prev'><i class='fa fa-long-arrow-left' aria-hidden='true'></i></a>
						<a class='btn next'><i class='fa fa-long-arrow-right' aria-hidden='true'></i></a>
					</div>
				</div>
				<div class='col-md-9 col-sm-8 col-xs-8 team-member'>
					<div class='team-carousel'>
						".do_shortcode( $content )."
					</div>
				</div>
			</div><!-- Row /- -->
		</div><!-- Container -->
	</div><!-- Team Section3 -->";
	
	return $result;
}
add_shortcode( 'teamthree_outer', 'healthkare_teamthree_outer' );

function healthkare_teamthree_inner( $atts, $content = null ) {

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
	
	<div class='col-md-12 col-sm-12 col-xs-12'>
		<div class='team-box'>
			".wp_get_attachment_image($sc_image,"healthkare_260_337")."
			<div class='team-content'>";
				$result .= "$titletxt";
				$result .= "$designationtxt";
				$result .= "
				<div class='team-social'>
					<ul>";
						foreach( vc_param_group_parse_atts( $atts['plan_feature'] ) as $key => $value ) {

							if( !empty( $value['feature_url'] ) && !empty( $value['feature_icon'] ) ) {
								$result .= "<li><a href='".esc_url( $value['feature_url'] )."' target='_blank'><i class='".esc_attr( $value['feature_icon'] )."'></i></a></li>";
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
add_shortcode( 'teamthree_inner', 'healthkare_teamthree_inner' );

// Parent Element
function vc_teamthree_outer() {

	// Register "container" content element. It will hold all your inner (child) content elements
	vc_map( array(
		"name" => esc_html__("Team 3", "healthkare-toolkit"),
		"base" => "teamthree_outer",
		"category" => esc_html__('Healthkare Theme', 'healthkare-toolkit'),
		"as_parent" => array('only' => 'teamthree_inner'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		"content_element" => true,
		"show_settings_on_create" => true,
		"is_container" => true,
		"params" => array(
			// add params same as with any other content element
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
				"heading" => esc_html__("Short Description", "healthkare-toolkit"),
				"param_name" => "sc_desc",
			),
		),
		"js_view" => 'VcColumnView'
	) );
}
add_action( 'vc_before_init', 'vc_teamthree_outer' );

// Nested Element
function vc_teamthree_inner() {

	vc_map( array(
		"name" => esc_html__("Team 3", "healthkare-toolkit"),
		"base" => "teamthree_inner",
		"category" => esc_html__('Healthkare Theme', 'healthkare-toolkit'),
		"content_element" => true,
		"as_child" => array('only' => 'teamthree_outer'), // Use only|except attributes to limit parent (separate multiple values with comma)
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
add_action( 'vc_before_init', 'vc_teamthree_inner' );

// Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {

    class WPBakeryShortCode_Teamthree_Outer extends WPBakeryShortCodesContainer {
	}
}

if ( class_exists( 'WPBakeryShortCode' ) ) {

    class WPBakeryShortCode_Teamthree_Inner extends WPBakeryShortCode {
    }
}
?>