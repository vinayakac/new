<?php
function healthkare_pricetable_outer( $atts, $content = null ) {

	extract( shortcode_atts( array( 'sc_title' => '', 'sc_desc' => '' ), $atts ) );
	
	$section_header = "";
	
	if($sc_title != "" || $sc_desc != "") {
		$section_header .= "<div class='section-header'>";
		$section_header .= "<h3>".wp_kses($sc_title, array( 'strong' => array() ) )."</h3>";
		$section_header .= wpautop($sc_desc);
		$section_header .= "</div>";
	}
	
	$result = "
	
	<!-- Pricing Section2 -->
	<div class='pricing-section pricing-section2 container-fluid no-left-padding no-right-padding'>
		<!-- Container -->
		<div class='container'>";
			$result .= "$section_header";
			$result .= "
			<!-- Row -->
			<div class='row'>
				".do_shortcode( $content )."
			</div><!-- Row /- -->
		</div><!-- Container /- -->
	</div><!-- Pricing Section2 /- -->";
	
	return $result;
}
add_shortcode( 'pricetable_outer', 'healthkare_pricetable_outer' );

function healthkare_pricetable_inner( $atts, $content = null ) {

	extract( shortcode_atts( array( 'sc_bg'=> '', 'price_curr'=> '','price'=> '', 'title'=> '', 'sc_btntxt'=> '', 'sc_btnurl'=> '' ), $atts ) );
	
	if( $sc_bg != "" ){
		$bg_style = " style='background-image: url(".wp_get_attachment_url( $sc_bg ).");'";
	}
	else{
		$bg_style = "";
	}
	
	$pricetxt = $titletxt = $buttontxt = "";
	
	if($price != "") {
		$pricetxt .= "<span>".esc_attr($price_curr).$price."</span>";
	}
	if($title != "") {
		$titletxt .= "<h3>".esc_attr($title)."</h3>";
	}
	
	if($sc_btntxt != "") {
		$buttontxt .= "<a href='".esc_url($sc_btnurl)."' title='".esc_attr($sc_btntxt)."'>".esc_attr($sc_btntxt)."</a>";
	}
	
	$result = "
	
	<div class='col-md-4 col-sm-6 col-xs-6 pricing-table'>
		<div class='pricing-box'>
			<div class='plane-price'>";
				$result .= "$pricetxt";
				$result .= "$titletxt";
				$result .= "
			</div>
			<div class='price-list-content'".html_entity_decode( $bg_style ).">
				<ul>";
					foreach( vc_param_group_parse_atts( $atts['plan_feature'] ) as $key => $value ) {

						if( !empty( $value['feature_name'] ) ) {
							$result .= "<li>".$value['feature_name']."</li>";
						}
						else {
							$result .= "";
						}
					}
					$result .= "
				</ul>
			</div>";
			$result .= "$buttontxt";
			$result .= "
		</div>
	</div>";
	
	return $result;
}
add_shortcode( 'pricetable_inner', 'healthkare_pricetable_inner' );

// Parent Element
function vc_pricetable_outer() {

	// Register "container" content element. It will hold all your inner (child) content elements
	vc_map( array(
		"name" => esc_html__("Price Table", "healthkare-toolkit"),
		"base" => "pricetable_outer",
		"category" => esc_html__('Healthkare Theme', 'healthkare-toolkit'),
		"as_parent" => array('only' => 'pricetable_inner'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
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
				"type" => "textarea",
				"heading" => esc_html__("Short Description", "healthkare-toolkit"),
				"param_name" => "sc_desc",
			),
		),
		"js_view" => 'VcColumnView'
	) );
}
add_action( 'vc_before_init', 'vc_pricetable_outer' );

// Nested Element
function vc_pricetable_inner() {

	vc_map( array(
		"name" => esc_html__("Price Table", "healthkare-toolkit"),
		"base" => "pricetable_inner",
		"category" => esc_html__('Healthkare Theme', 'healthkare-toolkit'),
		"content_element" => true,
		"as_child" => array('only' => 'pricetable_outer'), // Use only|except attributes to limit parent (separate multiple values with comma)
		"params" => array(
			// add params same as with any other content element
			array(
				"type" => "attach_image",
				"heading" => esc_html__("Background Image", "healthkare-toolkit"),
				"param_name" => "sc_bg",
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Currency", "healthkare-toolkit"),
				"param_name" => "price_curr",
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Price", "healthkare-toolkit"),
				"param_name" => "price",
			),
			array(
				"type" => "textfield",
				"heading" => esc_html__("Title", "healthkare-toolkit"),
				"param_name" => "title",
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
						'heading' => 'Feature Name',
						'param_name' => 'feature_name',
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
add_action( 'vc_before_init', 'vc_pricetable_inner' );

// Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {

    class WPBakeryShortCode_Pricetable_Outer extends WPBakeryShortCodesContainer {
	}
}

if ( class_exists( 'WPBakeryShortCode' ) ) {

    class WPBakeryShortCode_Pricetable_Inner extends WPBakeryShortCode {
    }
}
?>