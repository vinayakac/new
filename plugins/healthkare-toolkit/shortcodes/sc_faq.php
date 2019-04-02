<?php
function healthkare_faq_outer( $atts, $content = null ) {

	extract( shortcode_atts( array( 'sc_title' => '', 'sc_subtitle' => '' ), $atts ) );
	
	global $acc_count;
	
	$acc_count = 1;
	
	$result = "
	
	<!-- Faq Section -->
	<div class='faq-section container-fluid no-left-padding no-right-padding'>
		<!-- Container -->
		<div class='container no-padding'>
			<div class='faq-left'>
				<div class='faq-block'>
					<div class='panel-group' id='accordion-tab' role='tablist' aria-multiselectable='true'>
					".do_shortcode( $content )."
					</div>
				</div>
			</div>
		</div>
	</div>";
	
	return $result;
}
add_shortcode( 'faq_outer', 'healthkare_faq_outer' );

function healthkare_faq_inner( $atts, $content = null ) {

	extract( shortcode_atts( array( 'acc_title'=> '', 'acc_desc' => '' ), $atts ) );
	
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
					<a class='".esc_attr($acc_class)."' role='button' data-toggle='collapse' data-parent='#accordion-tab' href='#faqcontent-".esc_attr($randomcount)."' aria-expanded='true'>".esc_attr($acc_title)."</a>
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
add_shortcode( 'faq_inner', 'healthkare_faq_inner' );

// Parent Element
function vc_faq_outer() {

	// Register "container" content element. It will hold all your inner (child) content elements
	vc_map( array(
		"name" => esc_html__("FAQ", "healthkare-toolkit"),
		"base" => "faq_outer",
		"category" => esc_html__('Healthkare Theme', 'healthkare-toolkit'),
		"as_parent" => array('only' => 'faq_inner'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
		"content_element" => true,
		"show_settings_on_create" => true,
		"is_container" => true,
		"params" => array(
			// add params same as with any other content element
			array(
				"type" => "info",
				"heading" => esc_html__("No Need To setting", "healthkare-toolkit"),
				"param_name" => "label",
			),
		),
		"js_view" => 'VcColumnView'
	) );
}
add_action( 'vc_before_init', 'vc_faq_outer' );

// Nested Element
function vc_faq_inner() {

	vc_map( array(
		"name" => esc_html__("FAQ", "healthkare-toolkit"),
		"base" => "faq_inner",
		"category" => esc_html__('Healthkare Theme', 'healthkare-toolkit'),
		"content_element" => true,
		"as_child" => array('only' => 'faq_outer'), // Use only|except attributes to limit parent (separate multiple values with comma)
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
add_action( 'vc_before_init', 'vc_faq_inner' );

// Your "container" content element should extend WPBakeryShortCodesContainer class to inherit all required functionality
if ( class_exists( 'WPBakeryShortCodesContainer' ) ) {

    class WPBakeryShortCode_Faq_Outer extends WPBakeryShortCodesContainer {
	}
}

if ( class_exists( 'WPBakeryShortCode' ) ) {

    class WPBakeryShortCode_Faq_Inner extends WPBakeryShortCode {
    }
}
?>