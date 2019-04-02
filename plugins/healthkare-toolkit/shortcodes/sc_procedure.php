<?php
function healthkare_procedure_outer( $atts, $content = null ) {

	extract( shortcode_atts( array( 'sc_image' => '', 'sc_title' => '', 'sc_desc' => '' ), $atts ) );
	
	$sectionimg = $section_header = "";
	
	if($sc_image != "") {
		$sectionimg .= "<div class='col-md-4 col-sm-5 col-xs-12'>";
		$sectionimg .= "<div class='procedure-img'>";
		$sectionimg .= wp_get_attachment_image($sc_image,"healthkare_400_683");
		$sectionimg .= "</div></div>";
	}
	
	if($sc_title != "" || $sc_desc != "") {
		$section_header .= "<div class='section-header'>";
		$section_header .= "<h3>".wp_kses($sc_title, array( 'strong' => array() ) )."</h3>";
		$section_header .= wpautop($sc_desc);
		$section_header .= "</div>";
	}
	
	if($sc_image != "") {
		$col_md = "col-md-8 col-sm-7 col-xs-12";
	}
	else {
		$col_md = "col-md-12 col-sm-12 col-xs-12";
	}
	
	global $acc_count;
	
	$acc_count = 1;
	
	$result = "
	
	<!-- Procedure Section -->
	<div class='procedure-section container-fluid no-left-padding no-right-padding'>
		<!-- Container -->
		<div class='container'>
			<div class='row'>";
				$result .= "$sectionimg";
				$result .= "
				<div class='".esc_attr($col_md)." procedure-right'>";
					$result .= "$section_header";
					$result .= "
					<div class='faq-block'>
						<div class='panel-group' id='accordion' role='tablist' aria-multiselectable='true'>
							".do_shortcode( $content )."
						</div>
					</div>
				</div>
			</div>
		</div><!-- Container /- -->
	</div><!-- Procedure Section /- -->";
	
	return $result;
}
add_shortcode( 'procedure_outer', 'healthkare_procedure_outer' );

function healthkare_procedure_inner( $atts, $content = null ) {

	extract( shortcode_atts( array( 'acc_title'=> '', 'acc_desc'=> '' ), $atts ) );
	
	
	global $acc_count;
	
	if($acc_count == 2) {
		$acc_active = " in";
		$acc_class = "collapsed";
	}
	else {
		$acc_active = "";
		$acc_class = "";
	}
	
	$acc_count++;
	
	$randomcount = "";
	$randomcount = rand(0,10000);
	
	$result = "
	<div class='panel panel-default'>
		<div class='panel-heading' role='tab' id='faqheading-".esc_attr($randomcount)."'>
			<h4 class='panel-title'>
				<a class='".$acc_class."' role='button' data-toggle='collapse' data-parent='#accordion' href='#faqcontent-".esc_attr($randomcount)."' aria-expanded='true'>".esc_attr($acc_title)."</a>
			</h4>
		</div>
		<div id='faqcontent-".esc_attr($randomcount)."' class='panel-collapse collapse".esc_attr($acc_active)."' role='tabpanel' aria-labelledby='faqheading-".esc_attr($randomcount)."'>
			<div class='panel-body'>
				".wpautop($acc_desc)."
			</div>
		</div>
	</div>";
	return $result;
}
add_shortcode( 'procedure_inner', 'healthkare_procedure_inner' );

// Parent Element
function vc_procedure_outer() {

	// Register "container" content element. It will hold all your inner (child) content elements
	vc_map( array(
		"name" => esc_html__("Procedure", "healthkare-toolkit"),
		"base" => "procedure_outer",
		"category" => esc_html__('Healthkare Theme', 'healthkare-toolkit'),
		"as_parent" => array('only' => 'procedure_inner'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
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
add_action( 'vc_before_init', 'vc_procedure_outer' );

// Nested Element
function vc_procedure_inner() {

	vc_map( array(
		"name" => esc_html__("Procedure", "healthkare-toolkit"),
		"base" => "procedure_inner",
		"category" => esc_html__('Healthkare Theme', 'healthkare-toolkit'),
		"content_element" => true,
		"as_child" => array('only' => 'procedure_outer'), // Use only|except attributes to limit parent (separate multiple values with comma)
		"params" => array(
			// add params same as with any other content element
			array(
				"type" => "textfield",
				"heading" => esc_html__("Title", "healthkare-toolkit"),
				"param_name" => "acc_title",
			),
			array(
				"type" => "textarea",
				"heading" => esc_html__("Description", "healthkare-toolkit"),
				"param_name" => "acc_desc",
			),
		)
	) );
}
add_action( 'vc_before_init', 'vc_procedure_inner' );

// Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {

    class WPBakeryShortCode_Procedure_Outer extends WPBakeryShortCodesContainer {
	}
}

if ( class_exists( 'WPBakeryShortCode' ) ) {

    class WPBakeryShortCode_Procedure_Inner extends WPBakeryShortCode {
    }
}
?>